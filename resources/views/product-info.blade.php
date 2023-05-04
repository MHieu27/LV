@extends('header')

    <div class="container">
        <div class="left-sidebar">
            <div class="link">
                <a href={{route('home')}}>Trang chủ</a>
                <a href={{route('exchanges')}}>Sàn giao dịch</a>
                <a href="#">Tin nhắn</a>
                <a href={{route('exchanges-management')}}>Quản lý sàn giao dịch</a>
            </div>
        </div>

        <div class="main-content">
            <div class="product-info-container">
                @foreach ($productInfos as $productinfo)
                <div class="product-imgs">
                    <img src="{{url('/uploads')}}/{{$productinfo['img']}}" alt="">
                </div>
                <div class="product-content">
                    <h2 class="product-title">{{$productinfo['product_name']}}</h2>
                    <div class="user-profile">
                        <img src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                        <div class="product-rating">
                            <a href="#"><p>{{$productinfo['username']}}</p></a>
                            <i class="fa fa-star"></i>
                            <span>5</span>
                        </div>
                    </div>
                    <div class="product-price"><span>{{$productinfo['price']}} VND</span></div>
                    <div class="count-product"><span>So luong: {{$productinfo['quantity']}}</span></div>
                    <div class="product-detail">
                        <h2>Giới thiệu sản phẩm</h2>
                        <p>{{$productinfo['desc']}}</p>
                    </div>

                    <form action="{{route('order-by-user' ,['id' => $productinfo['idProduct']])}}" method="post">
                        @csrf
                        <div class="purchase-info">
                            <input type="number" name ="order_price"min = "<?= $productinfo['price'] ?>">VND
                        </div>
                        <div class="purchase-info">
                            So luong <input type="number" name="order_quantity"max ="<?= $productinfo['quantity'] ?>">
                        </div>
                        <div class="purchase-info">
                            <button type="submit" class="btn-purchase">Mua</button>
                        </div>
                        @endforeach
                    </form>
                </div>
            </div>
            <div class="auction-table">
                <div class="table-header">
                  <div class="header-item">STT</div>
                  <div class="header-item">Tên</div>
                  <div class="header-item">Giá</div>
                  <div class="header-item">Số Lượng</div>
                  <div class="header-item">Thời gian kết thúc</div>
                </div>
                <div class="table-body">
                @foreach(collect($getOrderUsers)->sortByDesc(function($user){
                    return $user['order_price'] * $user['order_quantity'];}) as $getOrderUser)
                <div class="table-row">
                    <div class="table-item">1</div>
                    <div class="table-item"><a href="">{{$getOrderUser['username']}}</a></div>
                    <div class="table-item">{{$getOrderUser['order_price']}}</div>
                    <div class="table-item">{{$getOrderUser['order_quantity']}}</div>
                    <div class="table-item">{{$getOrderUser['session_endtime']}}</div>
                </div>
                @endforeach
                </div>
            </div>
              
        </div>
    </div>
</body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</html>