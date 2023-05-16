<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Laudis\Neo4j\Basic\Session;
use OpenCF\RecommenderService;

class HomeController extends Controller
{
    private Session $session;
    public function __construct(Session $session)
    {
        $this->session = $session;
    }
    public function index()
    {
        $user = new UserResource(User::findOrFail(Auth::id()));
        // Lấy ra các gía trị của user
        //return response();

        $myID = intval($user->id);
        $queryShowHome = $this->session->run(<<<'CYPHER'
        MATCH (u:User{id: $myID}) - [:`Theo dõi`] -> (u2:User)
        OPTIONAL MATCH (u2) - [:`Đăng bài`] -> (p:Post)
        OPTIONAL MATCH (p) <- [:`Thích`] - (liked:User)
        RETURN u2.Username as username, p.post_nowtime as post_nowtime, p.post_content as post_content, p.post_img as post_img,count(liked) as liked, p.id as postID
        CYPHER,
        [
            'myID' => $myID,
        ]);

        $showHomePages = [];
        foreach ($queryShowHome as $value)
        {
            array_push($showHomePages, $value);
        }

        $value_rcd = $this->Recommodater();
        $recommodation = $this->filter_user($value_rcd);
        return view ('home',['recommodation' => $recommodation,'user'=>$user, 'id' => $user['id'], 'showHomePages' => $showHomePages]);

        
    }
    public function Recommodater()
    {
        $result_2 = $this->session->run(<<<'CYPHER'
        MATCH p=()-[r:REVIEWED]->()<-[:`Phiên giao dịch`]-() RETURN p
        CYPHER);
        $result_array2 = array();
        
        foreach ($result_2 as $result) {
            $user = $result['p']['nodes'][0]['properties']['email'];
            $rating = $result['p']['relationships'][0]['properties']['rating'];
            
            if($rating ===" "){
                $rating = -1;
            }
            if($user !== "Keanu@gmail.com" && $result['p']['nodes'][2]['properties']['name'] !== "Nấm kim châm Hàn Quốc"){
                $result_array2[] = array([
                    $result['p']['nodes'][2]['properties']['name'] =>[
                        'user' => $user, 'rating' => $rating
                    ]
                ]);
            }
        } 
        $product_ratings = array();
        $matrix = array();
        foreach ($result_array2 as $rating) {
            $product = key($rating[0]);
            $user = $rating[0][$product]['user'];
            $rating_value = ((int)$rating[0][$product]['rating']);

            if (!array_key_exists($product, $product_ratings)) {
                $product_ratings[$product] = array();
            }
            $product_ratings[$product][] = [
                $user => $rating_value,
            ];
            $newArray = array();
            foreach ($product_ratings[$product] as $item) {
                $newArray = array_merge($newArray, $item);
            }
            $matrix[$product] = $newArray;
        }
        
        $matrix_normalized = [];
        $matrix_normalized1 = [];
        $averageRatings = [];
        $averageRatings1 = [];
        
        foreach ($matrix as $item => $ratings) {
            foreach ($ratings as $user => $rating) {
                if ($rating == -1){
                    continue;
                }
                if ($rating !== null) {
                    if (!isset($averageRatings1[$user])) {
                        $averageRatings1[$user] = [];
                    }
                    $averageRatings1[$user][$item] = $rating;
                }
                if (!isset($matrix_normalized1[$user])) {
                    $matrix_normalized1[$user] = [];
                }

                $matrix_normalized1[$user][$item] = $rating;

            }
        }
        foreach ($matrix as $item => $ratings) {
            foreach ($ratings as $user => $rating) {
                if ($rating !== null) {
                    if (!isset($averageRatings[$user])) {
                        $averageRatings[$user] = [];
                    }
                    $averageRatings[$user][$item] = $rating;
                }
                if (!isset($matrix_normalized[$user])) {
                    $matrix_normalized[$user] = [];
                }
                $matrix_normalized[$user][$item] = $rating;

            }
        }
        $averrageRating = array();
        foreach ($averageRatings1 as $user => $ratings) {
            $averrageRating[$user] = array_sum($ratings) / count($ratings);
        }
        foreach ($matrix_normalized as $item => $ratings) {
            foreach ($ratings as $user => $rating) {
                if (!is_null($rating) && isset($averrageRating[$item])) {

                    $matrix_normalized[$item][$user] = round($rating-$averrageRating[$item],2);
                }
                if ($rating == -1){
                    $matrix_normalized[$item][$user] = 0;
                }
            }
        }
        $matrix_normalized2 = array();
        foreach ($matrix_normalized as $item => $ratings) {
            foreach ($ratings as $user => $rating) {

                $matrix_normalized2[$item][] = $rating;
            }
        }
        $newRatings = [];
        foreach ($matrix_normalized as $item => $values) {
            foreach ($values as $user => $rating) {
                    $newRatings[$user][$item] = $rating;
            }
        }
     
        $matrix_preduct = array_merge([], $newRatings);
        foreach ($newRatings as $item => $ratings) {
            foreach ($ratings as $user => $rating) {
                if($rating==0){
                    $result_preduct = 0;
                    $similarities = array();
                    $ai = 0;
                    $normalizedRatings = array();
                    foreach ($ratings as $user1 => $rating1) {
                        if($rating1!=0){
                            $similarities[$ai] = $this->cosineSimilarity($matrix_normalized2[$user], $matrix_normalized2[$user1]);;
                            $normalizedRatings[$ai] = $rating1;
                            $ai++;
                        }
                    }
                    $swapp = 0;
                    $swapp1 = 0;
                    for($b = 0; $b <count($similarities)-1; $b++){
                        for($c = $b+1; $c < count($similarities); $c++){
                            if($similarities[$b]<$similarities[$c]){
                                $swapp = $similarities[$b];
                                $similarities[$b] = $similarities[$c];
                                $similarities[$c] =  $swapp;
                                $swapp1 = $normalizedRatings[$b];
                                $normalizedRatings[$b] = $normalizedRatings[$c];
                                $normalizedRatings[$c] =  $swapp1;
                            }
                        }
                    }
                    $k = 2;
                    $selectedSimilarities = array_slice($similarities, 0, $k);
                    $selectedNormalizedRatings = array_slice($normalizedRatings, 0, $k);
                    $weightedSum = 0;
                    $totalWeight = 0;
                    for ($l = 0; $l < $k; $l++) {
                        if(isset($selectedSimilarities[$l]) && isset($selectedNormalizedRatings[$l])){
                            $weightedSum += $selectedSimilarities[$l] * $selectedNormalizedRatings[$l];
                            $totalWeight += abs($selectedSimilarities[$l]);
                        }
                    }
                    if($totalWeight == 0){
                        $matrix_preduct[$item][$user] = 0;
                    }else{
                        $result_preduct = $weightedSum / $totalWeight;
                    }
                    $matrix_preduct[$item][$user] = round($result_preduct,2);
                }
            }
        }
        $array_normal = array();
        foreach ($matrix_preduct as $item => $ratings) {
            foreach ($ratings as $user => $rating) {
                if(isset($averrageRating[$user]))
                    $array_normal[$item][$user] = round($rating+$averrageRating[$user],2);
            }
        }
        return $array_normal;
        
    }
    public function filter_user($array_normal){
        $user = new UserResource(User::findOrFail(Auth::id()));
        $myID = $user->email;
        $filteredRatings = [];
        foreach ($array_normal as $item => $itemRatings) {
            if (isset($itemRatings[$myID])) {
                $filteredRatings[$item] = $itemRatings[$myID];
            }
        }

        $array_recommodation = array();
        foreach ($filteredRatings as $item => $rating){
            if($rating > 2.5){
                $result = $this->session->run(<<<'CYPHER'
                MATCH (p:User)-[prd:`Đăng bán`]->(pr:Product {name: $item})-[pdg:`Phiên giao dịch`]->(:Session)
                return p.email as email,pr.img as img, pr.name as name, p.Username as Username, pdg.price as price, pdg.quantity as amount
                CYPHER,['item' => $item]);
                foreach($result as $value){
                    $result1 = $this->session->run(<<<'CYPHER'
                    match (u:User{email:$email})-[db:`Đăng bán`]->(:Product)-[:`Phiên giao dịch`]->(:Session)<-[r:REVIEWED]-(:User)
                    return r.rating as rating
                    CYPHER,['email' => $value['email']]);
                    $array_recommodation[] =[
                        'name' => $value['Username'],
                        'rating' => $this->avg_rating($result1),
                        'title' => $value['name'],
                        'img' => $value['img'],
                        'price' => $value['price'],
                        'amount' => $value['amount']

                    ];
                }
            }
        }
        return $array_recommodation;

    }
    public function recommobe_prov($array_normal){
        $filtered_recomm = array_map(function($food) {
            return array_filter($food, function($rating) {
                return $rating > 2.5;
            });
        }, $array_normal);
        $result_array = array();
        $array_user = array();
        foreach ($filtered_recomm as $item => $value){
                $array_user = $value;
            $result = $this->session->run(<<<'CYPHER'
            MATCH (p:User)-[prd:PROVIDER]->(pr:Production {name: $item})
            RETURN p,pr,prd
            CYPHER,['item' => $item]);
            $img = null;
            foreach($result as $value){
                $img = $value['pr']['properties']['img'];
                $price = $value['prd']['properties']['price'];
                $amount = $value['prd']['properties']['amount'];
            }
            $result_array[$item] = [
                'user' => $array_user,
                'img' => $img,
                'price' => $price,
                'amount' => $amount,
            ];
        }
        return $result_array;
    }
    public function avg_rating($request){

        $array = array();
        foreach($request as $value){
            $rating = $value['rating'];
            $array[] = [$rating];
        }
        $sum = 0;
        $count = 0;

        foreach ($array as $rating) {
            if (is_numeric($rating[0])) {
                $sum += $rating[0];
                $count++;
            }
        }
        if($count==0)return 0;
        return $sum / $count;;
    }
    function cosineSimilarity($vec1, $vec2) {
        $dotProduct = 0;
        $magnitude1 = 0;
        $magnitude2 = 0;

        for ($i = 0; $i < count($vec1); $i++) {
            $dotProduct += $vec1[$i] * $vec2[$i];
            $magnitude1 += $vec1[$i] * $vec1[$i];
            $magnitude2 += $vec2[$i] * $vec2[$i];
        }

        $magnitude1 = sqrt($magnitude1);
        $magnitude2 = sqrt($magnitude2);

        if ($magnitude1 == 0 || $magnitude2 == 0) {
            return 0;
        } else {
            $result  = $dotProduct / ($magnitude1 * $magnitude2);
            return round($result,2);
        }
    }
}

