@extends('header')
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@php
    function extractList($array, &$list, $temp = array()) {
    if(count($temp) > 0 && ! in_array($temp, $list))
        $list[] = $temp;
    for($i = 0; $i < sizeof($array); $i ++) {
        $copy = $array;
        $elem = array_splice($copy, $i, 1);
        if (sizeof($copy) > 0) {
            $add = array_merge($temp, array($elem[0]));
            sort($add);
            extractList($copy, $list, $add);
        } else {
            $add = array_merge($temp, array($elem[0]));
            sort($add);
            if (! in_array($temp, $list)) {
                $list[] = $add;
            }
        }
    }
    }
    $list = array();
    extractList($suggests, $list);
    //print_r($list);

    foreach ($suggests as $item)
    {
        $sum = $item['quantity'];
        break;
    }

    //print_r($suggests);
    //var_dump($list);
    
    #Filter By SUM = $sum 
    $suggests = array_filter($list,function($var) use($sum) {
        return(array_sum(array_map(fn($item) => $item['order_quantity'], $var)) <= $sum   );});
    //print_r($suggests);
    // #Return Output
    function cmp($a, $b)
    {
    $quanity_a = 0;
    $price_a = 0;
    $weight_a = 0;
    $quanity_b = 0;
    $price_b = 0;
    $weight_b = 0;
    $totalPrice_a = 0;
    $totalPrice_b = 0;
        // foreach ($a as $getUser){
        // $quanity_a += $getUser['order_quantity'];
        // $price_a += $getUser['order_price'];
        // }
        // $weight_a = $quanity_a * $price_a;
        // foreach ($b as $getUser){
        // $quanity_b += $getUser['order_quantity'];
        // $price_b += $getUser['order_price'];
        // }
        // $weight_b = $quanity_b * $price_b;
        // if ($weight_a === $weight_b ) {
        //     return 0;
        // }
        // return ($weight_a > $weight_b) ? -1 : 1;

        foreach ($a as $getUser){
        $price_a = $getUser['order_price'] * $getUser['order_quantity'];
        $totalPrice_a += $price_a;
        }
        //$weight_a = $quanity_a * $price_a;
        foreach ($b as $getUser){
        $price_b = $getUser['order_price'] * $getUser['order_quantity'];
        $totalPrice_b += $price_b;
        }
        // $weight_b = $quanity_b * $price_b;
        if ($totalPrice_a === $totalPrice_b ) {
            return 0;
        }
        return ($totalPrice_a > $totalPrice_b) ? -1 : 1;
    }

    usort($suggests, "cmp");
@endphp
<div class="Modal-suggest">
    <div class="modal-suggest-order">
      <span class="close-modal">&times;</span>
        <h1>A Fancy Table</h1>

        <table class="infoOrder">
            <?php $count = 0;?>          
            @foreach($suggests as $index => $getOrderUser)
            <div class="table-item"> Ưu tiên {{$count}}</div>
            @foreach ($getOrderUser as $index => $getUser)
            <div class="table-body">
                    <div class="table-row">
                    <div class="table-item"><a href="{{route('profile2', ['id'=> $getUser['id']])}}">{{$getUser['username']}}</a></div>
                    <div class="table-item">Giá: {{$getUser['order_price']}}</div>
                    <div class="table-item">Số lượng: {{$getUser['order_quantity']}}</div>
                    {{-- <div class="table-item">{{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $getOrderUser['session_endtime'])->format('d/m/Y H:i') }}</div> --}}
            </div>
             @endforeach
            <?php $count += 1; ?>
            <br>
            @endforeach
          </tr>
        </table>
      
    </div>
  </div>