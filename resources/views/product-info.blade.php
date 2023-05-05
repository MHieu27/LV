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

        <div class="main-content" style="background: #fff";
    >
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
                    <div class="product-price"><span>Giá: {{$productinfo['price']}}đ</span></div>
                    <div class="count-product"><span>Số lượng: {{$productinfo['quantity']}}</span></div>
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
                           Số lượng: <input type="number" name="order_quantity"max ="<?= $productinfo['quantity'] ?>">
                        </div>
                        <div class="purchase-info">
                            @php
                                $current_time= \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y H:i');
                                $username_counts = array_count_values(array_column($getOrderUsers, 'username'));
                            @endphp
                            @if(\Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $productinfo['Session_endtime'])->format('d/m/Y H:i') < $current_time)
                            <!-- Thông báo sản phẩm đã hết hạn bán -->
                            <div class="purchase-info">
                                <p>Sản phẩm đã hết hạn đấu giá</p>
                            </div>
                            @else
                            <div class="purchase-info">
                                <button type="submit" class="btn-purchase">Mua</button>
                            </div>
                            @endif
                        </div>
                        {{$current_time}}
                        @endforeach
                    </form>
                    <input type="hidden" id="username" value="{{ $username }}">
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
                    return $user['order_price'] * $user['order_quantity'];}) as $index => $getOrderUser)
                <div class="table-row">
                    <div class="table-item">{{$index + 1}}</div>
                    <div class="table-item"><a href="{{route('profile2', ['id'=> $getOrderUser['id']])}}">{{$getOrderUser['username']}}</a></div>
                    <div class="table-item">{{$getOrderUser['order_price']}}</div>
                    <div class="table-item">{{$getOrderUser['order_quantity']}}</div>
                    <div class="table-item">{{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $getOrderUser['session_endtime'])->format('d/m/Y H:i') }}</div>
                </div>
                @endforeach
                </div>
            </div>
              
        </div>
    </div>
</body>
<script>

const username = document.getElementById('username').value;
    const rows = document.querySelectorAll('.table-row');
    let count = 0;
    console.log(username);
    rows.forEach((row) => {
        const name = row.querySelector('.table-item a').textContent;
        if (name === username) {
            count++;
        }
    });

    if (count >= 3) {
        const purchaseBtn = document.querySelector('.btn-purchase');
        if (purchaseBtn) {
            purchaseBtn.style.display = 'none';
        }
    }
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</html>