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
        $arr = $this->get_list();
        echo '<script>var data = ' . json_encode($arr) . ';</script>';
        usort($arr, function($a, $b) {
            return $b['rating'] <=> $a['rating'];
        });
        $request['username'] = Auth::id();
        $list = $this->Recommodater($request);
        $recommobe = $this->filter_user($list);
        $recommobe2 = $this->recommobe_prov($list);
        // Lấy ra các gía trị của user
        //return response();
        return view ('home',['user'=>$user, 'id' => $user['id']]);

        // if(!$recommobe)
        //     return view('content',['recommobe2' => $recommobe2,'user' => $user,'product_user'=>$this->List_product(),'products' => $arr,'recommobe' => $recommobe = array()/* $this->List_top() */]);
        // /* foreach ($this->List_top() as $elem2) {
        //     $found = false;
        //     foreach ($recommobe as $elem1) {
        //         if ($elem1['user'] === $elem2['user']) {
        //             $found = true;
        //             break;
        //         }
        //     }
        //     if (!$found) {
        //         $recommobe[] = $elem2;
        //     }
        // } */
        // return view('content',['recommobe2' => $recommobe2,'user' => $user,'product_user'=>$this->List_product(),'products' => $arr,'recommobe' => $recommobe]);
    }





    public function List_top(){
        $arr_recom1 = array();
        $arr_recom2 = array();
        $recommodation = $this->session->run(<<<'CYPHER'
            MATCH (p:Person)-[r:PROVIDER]->() RETURN p
        CYPHER);
        foreach($recommodation as $item){
            $propertie_p = $item['p']['properties']['name'];
            if (!in_array($propertie_p, $arr_recom1)) {
                $arr_recom1[] = $propertie_p;
            }
        }

        foreach($arr_recom1 as $name){
            $rate = $this->session->run(<<<'CYPHER'
            MATCH p=()-[r:REVIEWED]->(:Person{name:$name}) RETURN p
            CYPHER,['name'=>$name]);
            $rating = 0;
            $i=0;
            foreach($rate as $item){
                $rating = $rating+$item['p']['relationships'][0]['properties']['rating'];
                $i++;
            }
            if($i)
                $arr_recom2[] = ['user'=>$name,'rating'=> round($rating/$i, 0, PHP_ROUND_HALF_UP)*5/100];
        }

        usort($arr_recom2, function($a, $b) {
            return $b['rating'] <=> $a['rating'];
        });
        return $arr_recom2;
    }
    public function Recommodater($request)
    {
        $result_2 = $this->session->run(<<<'CYPHER'
        MATCH p=()-[r:REVIEWED]->() RETURN p
        CYPHER);
        $result_array2 = array();
        foreach ($result_2 as $result) {
            $user = $result['p']['nodes'][0]['properties']['email'];
            $rating = $result['p']['relationships'][0]['properties']['rating'];

            if($rating ==""){
                $rating = -1;
            }
            $result_array2[] = array([
                $result['p']['nodes'][1]['properties']['title'] =>[
                    'user' => $user, 'rating' => $rating
                ]
            ]);
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
        $user = Auth::id();
        $filteredRatings = [];
        foreach ($array_normal as $item => $itemRatings) {
            if (isset($itemRatings[$user])) {
                $filteredRatings[$item] = $itemRatings[$user];
            }
        }
        $array_recommodation = array();
        foreach ($filteredRatings as $item => $rating){
            if($rating > 2.5){
                $result = $this->session->run(<<<'CYPHER'
                MATCH (p:Person)-[prd:PROVIDER]->(pr:Production {title: $item})
                RETURN p,pr,prd
                CYPHER,['item' => $item]);
                foreach($result as $value){
                    $email = $value['p']['properties']['email'];
                    $name = $value['p']['properties']['name'];
                    $title = $value['pr']['properties']['title'];
                    $img = $value['pr']['properties']['img'];
                    $price = $value['prd']['properties']['price'];
                    $result1 = $this->session->run(<<<'CYPHER'
                    match (:Person{email:$email})-[:PROVIDER]->(:Production)<-[r:REVIEWED]-(:Person)
                    return r
                    CYPHER,['email' => $email]);
                    $array_recommodation[] =[
                        'name' => $name,
                        'rating' => $this->avg_rating($result1),
                        'title' => $title,
                        'img' => $img,
                        'price' => $price

                    ];
                }
            }
        }
        usort($array_recommodation, function($a, $b) {
            return $b['rating'] - $a['rating'];
        });
        return $array_recommodation;
    }
    public function recommobe_prov($array_normal){
        $filtered_recomm = array_map(function($food) {
            return array_filter($food, function($rating) {
                return $rating > 2.5;
            });
        }, $array_normal);
        $result_array = array();
        foreach ($filtered_recomm as $item => $value){
                $result = $this->session->run(<<<'CYPHER'
                MATCH (p:Person)-[prd:PROVIDER]->(pr:Production {title: $item})
                RETURN p,pr,prd
                CYPHER,['item' => $item]);
                foreach($result as $value){
                    $email = $value['p']['properties']['email'];
                    $name = $value['p']['properties']['name'];
                    $title = $value['pr']['properties']['title'];
                    $img = $value['pr']['properties']['img'];
                    $price = $value['prd']['properties']['price'];
                    $result_array[] =[
                        'name' => $name,
                        'title' => $title,
                        'img' => $img,
                        'price' => $price

                    ];
                }
        }
        return $result_array;
    }
    public function avg_rating($request){

        $array = array();
        foreach($request as $value){
            $rating = $value['r']['properties']['rating'];
            $summary = $value['r']['properties']['summary'];
            $array[] = [$rating,$summary];
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
    public function List_product(){
        $result = $this->session->run(<<<'CYPHER'
        MATCH p=(:Person{email:$name})-[r:PROVIDER]->() RETURN p
        CYPHER,['name' => Auth::id()]);
        $arr = array();
        foreach($result as $item){
            $provider = $item['p']['nodes'][0]['properties']['name'];
            $title = $item['p']['nodes'][1]['properties']['title'];
            $img = $item['p']['nodes'][1]['properties']['img'];
            $detail = $item['p']['nodes'][1]['properties']['detail'];
            $price = $item['p']['relationships'][0]['properties']['price'];
            $amount = $item['p']['relationships'][0]['properties']['amount'];
            $rate = $this->session->run(<<<'CYPHER'
            MATCH p=()-[r:REVIEWED]->(:Person{name:$name}) RETURN p
            CYPHER,['name'=>$provider]);
            $rating = 0;
            $i=0;
            foreach($rate as $item){
                $rating = $rating+$item['p']['relationships'][0]['properties']['rating'];
                $i++;
            }
            if($rating == 0)
                $point = 0;
            else
                $point = round($rating/$i, 0, PHP_ROUND_HALF_UP)*5/100;
            $arr[] = [
                'provider' => $provider,
                'product' => [
                    'title' => $title,
                    'detail' => $detail,
                    'img' => $img,
                    'price' => $price,
                    'amount' => $amount
                ],
                'rating' => $point
            ];

        }
        return $arr;
    }
    public function get_list(){
        $result = $this->session->run(<<<'CYPHER'
        MATCH p=()-[r:PROVIDER]->() RETURN p
        CYPHER);
        $arr = array();
        foreach($result as $item){
            $provider = $item['p']['nodes'][0]['properties']['name'];
            $email = $item['p']['nodes'][0]['properties']['email'];
            $title = $item['p']['nodes'][1]['properties']['title'];
            $id = $item['p']['nodes'][1]['id'];
            $img = $item['p']['nodes'][1]['properties']['img'];
            $detail = $item['p']['nodes'][1]['properties']['detail'];
            $price = $item['p']['relationships'][0]['properties']['price'];
            $amount = $item['p']['relationships'][0]['properties']['amount'];
            $rate = $this->session->run(<<<'CYPHER'
            MATCH p=()-[r:REVIEWED]->(:Person{name:$name}) RETURN p
            CYPHER,['name'=>$provider]);
            $rating = 0;
            $i=0;
            foreach($rate as $item){
                $rating = $rating+$item['p']['relationships'][0]['properties']['rating'];
                $i++;
            }
            if($rating == 0)
                $point = 0;
            else
                $point = round($rating/$i, 0, PHP_ROUND_HALF_UP)*5/100;
            $arr[] = [
                'provider' => $provider,
                'email' => $email,
                'product' => [
                    'title' => $title,
                    'detail' => $detail,
                    'img' => $img,
                    'price' => $price,
                    'amount' => $amount,
                    'id' => $id,

                ],
                'rating' => $point
            ];

        }
        return $arr;
    }
    public function evalution(Request $request){
        $result = $this->session->run(<<<'CYPHER'
        MATCH (p1:Person)-[r:REVIEWED]->(pr:Production)
        WHERE p1.email = $reviewer AND pr.title = $reviewed
        RETURN r
        CYPHER,['reviewer' => Auth::id(),'reviewed' => $request->title]);
        if($request->rate === null){$request['rate'] = ' ';}
        if($request->text === null){$request['text'] = ' ';}
        if(count($result) != 0){
            $result1 = $this->session->run(<<<'CYPHER'
            MATCH (u1)-[r:REVIEWED]->(prod)
            WHERE u1.email = $reviewer AND prod.title = $reviewed
            SET r.rating = $rating, r.summary = $summary
            RETURN r
            CYPHER,['reviewer' => Auth::id(),'reviewed' => $request->title,'rating' => $request->rate,'summary' => $request->text]);
            return response()->json( $result1);
        }
            $result1 = $this->session->run(<<<'CYPHER'
            MATCH (p:Person),(prd:Production)
            WHERE p.email = $reviewer
            create (p)-[:REVIEWED{rating:'', summary:''}]->(prd)
            CYPHER,['reviewer' => Auth::id()]);
            $result1 = $this->session->run(<<<'CYPHER'
            MATCH (u1)-[r:REVIEWED]->(prod)
            WHERE u1.email = $reviewer AND prod.title = $reviewed
            SET r.rating = $rating, r.summary = $summary
            RETURN r
            CYPHER,['reviewer' => Auth::id(),'reviewed' => $request->title,'rating' => $request->rate,'summary' => $request->text]);
            return response()->json( $result1);
    }
}

