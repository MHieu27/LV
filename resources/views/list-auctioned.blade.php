@extends('header')

<div class="container">
    <div class="left-sidebar">
        <div class="link">
            <a href={{route('home')}}>Trang chủ</a>
            <a href={{route('exchanges')}}>Sàn giao dịch</a>
            <a href="#">Tin nhắn</a>
            <a href={{route('exchanges-management')}}>Quản lý sàn giao dịch</a>
            <a href={{route('list-auctioned', ['id' => $id])}}>Xem sản phẩm đấu giá</a>
        </div>
    </div>
    <div class="main-content">
        <div class="post-container">  
            <div class="manager-product">   
            <table>
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Giá đã đấu giá</th>
                        <th>Số lượng</th>
                        <th>Tên người bán</th>
                    </tr>
                </thead>
            @foreach ($getAllListAuctioned as $ListAuctioned)
                <tbody>
                    <tr>
                        <td><a href="{{route('product-info', ['id' => $ListAuctioned['idProduct']])}}">{{$ListAuctioned['username']}}</a></td>
                        <td>{{$ListAuctioned['order_price']}}đ</td>
                        <td>{{$ListAuctioned['order_quantity']}}</td>
                        <td><a href="{{route('profile2',['id'=>$ListAuctioned['idSeller']])}}">{{$ListAuctioned['seller']}}</a></td>
                    </tr>
                </tbody>
            @endforeach
            </table>
            </div>
        </div>
        </div>
    </div>
</div>
</body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</html>