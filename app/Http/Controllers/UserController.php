<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use PHPJuice\Slopeone\Algorithm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use OpenCF\RecommenderService;
use Laudis\Neo4j\Basic\Session as BasicSession;
use SebastianBergmann\Type\NullType;
use Tigo\Recommendation\Recommend;

class UserController extends Controller
{
    private BasicSession $session;
    public function __construct(BasicSession $session)
    {
        $this->session = $session;
    }
    public function getlogin(){
        if(Auth::id()){
            return redirect()->route('home');
        }
        return view('login');
    }
    public function create(Request $request)
    {

        $user = $request->all();
        $hashed_password = bcrypt($user['password']);
        // $user['passwordHash'] = Hash::make($user['password']);
        $check_username = User::query()->where('username', $user['username'])->first();
        if($check_username != null){
            Session::flash('message', 'Ten da ton tai!');
            return redirect()->back();
        }
        // $user = $this->session->run(<<<'CYPHER'
        // MATCH p=()-[r:PROVIDER]->() RETURN p
        // CYPHER,['']);
        // return redirect()->route('login');
        
        $result = $this->session->run(<<<'CYPHER'
        CREATE (n:User{Username: $username,
                        email: $email,
                        password: $password,
                        phonenumber: $phonenumber,
                        address: $address,
                        birthday: $birthday,
                        gender: $gender
                    })RETURN n
        CYPHER, [
            'email' => $user['email'],
            'username' => $user['username'],
            'password' => $hashed_password,
            'phonenumber' => $user['phonenumber'],
            'address' => $user['address'],
            'birthday' => $user['birthday'],
            'gender' => $user['gender'],
        ]);

        return redirect()->route('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->all();
        $user = User::query('limit',20)->where('email', $credentials['email'])->first();
        //$user trả về đối tượng
        if ($user === null || !Hash::check($credentials['password'], $user->getAttribute('password'))) {
            Session::flash('message', 'This is a message!');
            return redirect()->back();
        }
/*         new UserResource($user); */
        Auth::login($user);
        new UserResource($user);
     /*    return  $result; */
        return redirect()->route('home');
    }

    public function search (Request $request)
    {
        $search_user = $request->all();
        $user = new UserResource(User::findOrFail(Auth::id()));
        //return response($search_user);
        $result2 = $this->session->run(<<<'CYPHER'
        MATCH (u:User)
        WHERE u.Username STARTS WITH $username
        RETURN u.Username as username
        CYPHER, [
            'username' => $search_user['username']
        ]);
        $search_users = [];
        foreach($result2 as $result){
            array_push($search_users, $result);
            //$username = $result['n']['properties']['Username'];
        }

        //return response($user);
       return view ('search', ['search_user' => $search_users, 'user' => $user]);
    }

    public function getUser(Request $request){
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
        $user = 'MikeN@gmail.com';
        $filteredRatings = [];
        foreach ($array_normal as $item => $itemRatings) {
            if (isset($itemRatings[$user])) {
                $filteredRatings[$item] = $itemRatings[$user];
            }
        }
        $array_recommodation = array();
        foreach ($filteredRatings as $item => $rating){
            if($rating > 2.5){
                $array_recommodation1[] = $item;
                $result = $this->session->run(<<<'CYPHER'
                MATCH (p:Person)-[prd:PROVIDER]->(pr:Production {title: $item})
                RETURN p,pr,prd
                CYPHER,['item' => $item]);
                return response($result);
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
                        $name => $this->avg_rating($result1),
                        'title' => $title,
                        'img' => $img,
                    ];
                }
            }
        }
        $nonZeroRatings = array();
        foreach ($array_recommodation as $key => $value) {
            if ($value != 0) {
                $nonZeroRatings[$key] = $value;
            }
        }
        return $nonZeroRatings;
    }
    public function re_eval($request){
        return response($request);
        $result1 = $this->session->run(<<<'CYPHER'
        MATCH (u1)-[r:REVIEWED]->(prod)
        WHERE u1.email = $reviewer AND prod.title = $reviewed
        SET r.rating = $rating, r.summary = $summary
        RETURN r
        CYPHER,['reviewer' => $request->title,'reviewed' => $request->title,'rating' => $request->rate,'summary' => $request->text]);
        return $result1;
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
}
