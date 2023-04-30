<?php

namespace App\Console\Commands;

use App\Http\Resources\UserResource;
use App\Http\Resources\UserTest as ResourcesUserTest;
use App\Models\User;
use App\Models\UserTest;
use Illuminate\Console\Command;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Laudis\Neo4j\Basic\Session;
use OpenCF\RecommenderService;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'Test1';
    private Session $session;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Session $session)
    {

        /* $val = array(60, 100, 120); //gia
        $wt = array(10, 20, 30);//so lg
        $W = 50;
        $n = count($val);
        $result = $this->knapsack($W, $wt, $val, $n);

        // In kết quả
        echo "Đồ vật được đựng trong ba lô là: ";
        foreach ($result as $item) {
            echo $item . " ";
        } */
        $result = $session->run(<<<'CYPHER'
        Create(n:Person{name:$name})
        CYPHER,['name'=>'Lana Wachowski']);
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

        }print_r($arr);
    }

    function knapsack($W, $wt, $val, $n) {
        // Khởi tạo mảng tối ưu
        $K = array();
        for ($i = 0; $i <= $n; $i++) {
            for ($w = 0; $w <= $W; $w++) {
                if ($i == 0 || $w == 0) {
                    $K[$i][$w] = 0;
                } else if ($wt[$i-1] <= $w) {
                    $K[$i][$w] = max($val[$i-1] + $K[$i-1][$w-$wt[$i-1]], $K[$i-1][$w]);
                } else {
                    $K[$i][$w] = $K[$i-1][$w];
                }
            }
        }

        // Truy vết lại các đồ vật đã chọn
        $res = array();
        $w = $W;
        for ($i = $n; $i > 0 && $w > 0; $i--) {
            if ($K[$i][$w] != $K[$i-1][$w]) {
                $res[] = $i-1;
                $w -= $wt[$i-1];
            }
        }

        return $res;
    }

}
