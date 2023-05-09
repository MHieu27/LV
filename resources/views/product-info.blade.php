@extends('header')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="container">
        <div class="left-sidebar">
            <div class="link">
                <a href={{route('home')}}>Trang chủ</a>
                <a href={{route('exchanges')}}>Sàn giao dịch</a>
                <a href="#">Tin nhắn</a>
                <a href={{route('exchanges-management')}}>Tạo phiên giao dịch</a>
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
                            <a href="{{route('profile2', ['id'=> $productinfo['id']])}}"><p>{{$productinfo['username']}}</p></a>
                            <i class="fa fa-star"></i>
                            <span>5</span>
                        </div>
                    </div>
                    <div class="product-price"><span>Giá: {{$productinfo['price']}}đ</span></div>
                    <div class="count-product"><span>Số lượng: {{$productinfo['quantity']}}</span></div>
                    @php
                        $current_time= \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y H:i');
                        $username_counts = array_count_values(array_column($getOrderUsers, 'username'));
                    @endphp
                    @if(\Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $productinfo['Session_endtime'])->format('d/m/Y H:i') < $current_time)
                        <div class="endtime-product" ><span>Thời gian kết thúc: Đã kết thúc thời gian đấu giá</span></div>
                  @else
                        <div class="endtime-product"><span>Thời gian kết thúc: {{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $productinfo['Session_endtime'])->format('d/m/Y H:i') }}</span></div>
                    @endif
                    <div class="product-detail">
                        <h2>Giới thiệu sản phẩm</h2>
                        <p>{{$productinfo['desc']}}</p>
                    </div>

                    <form action="{{route('order-by-user' ,['id' => $productinfo['idProduct']])}}" method="post">
                        @csrf
                        <div class="purchase-info">
                            <input id="order_price" type="number" name ="order_price" placeholder="Giá" min = "<?= $productinfo['price']?>">
                        </div>
                        <div class="purchase-info">
                           <input id="order_quantity" type="number" name="order_quantity" placeholder="Số lượng" max ="<?= $productinfo['quantity'] ?>">
                        </div>
                        <div class="purchase-info">
                            @php
                                $current_time= \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y H:i');
                                $username_counts = array_count_values(array_column($getOrderUsers, 'username'));
                            @endphp
                            @if(\Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $productinfo['Session_endtime'])->format('d/m/Y H:i') > $current_time)
                            <!-- Thông báo sản phẩm đã hết hạn bán -->
                            <div class="purchase-info">
                                <div class="purchase-info">
                                    <button type="submit" class="btn-purchase">Đấu giá</button>
                                    <p class="noti-purchase" style="display: none">Đã hết số lượng đấu giá</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </form>
                    @endforeach
                    <button style="display: none;width: 210px;height: 30px;background: #4b9372;;border: 0;border-radius: 15px;" class="updateBtn">Cập nhật giá và số lượng</button>
                    <div id="myModal" class="modal">
                        <!-- Modal update order content -->
                        <div class="modal-content">
                          <span class="close">&times;</span>
                          <h2>Cập nhật đấu giá và số lượng</h2>
                          <form action="{{route('update-by-user', ['id' => $productinfo['idProduct']])}}" method="post">
                            @csrf
                            <label>Giá:</label>
                            <input type="number" name="update_price" value="" required>
                      
                            <label >Số lượng:</label>
                            <input type="number"  name="update_quantity" value="" required>
                      
                            <button type="submit">Cập nhật</button>
                          </form>
                        </div>
                    </div>


                    <!--Lấy ra user đang đang nhập-->
                    <input type="hidden" id="username" value="{{ $username }}">
                </div>
            </div>
            @if($checkSeller == $username)
            <button class="suggestBtn"><a style="color: black" href="{{route('suggest', ['id' => $productinfo['idProduct']])}}">Gợi ý bán sản phẩm</a></button>
                <div class="auction-table">
                    <div class="table-header">
                    <div class="header-item">STT</div>
                    <div class="header-item">Tên</div>
                    <div class="header-item">Giá</div>
                    <div class="header-item">Số Lượng</div>
                    <div class="header-item">Trạng thái</div>
                    <div class="header-item">Thao tác</div>
                    </div>
                <div class="table-body">
                    @foreach(collect($getOrderUsers)->sortByDesc(function($user){
                        return $user['order_price'] * $user['order_quantity'];}) as $index => $getOrderUser)
                      {{-- View của chủ sản phẩm --}}
                            <div class="table-row">
                            <div class="table-item">{{$index + 1}}</div>
                            <div class="table-item"><a href="{{route('profile2', ['id'=> $getOrderUser['id']])}}">{{$getOrderUser['username']}}</a></div>
                            <div class="table-item">{{$getOrderUser['order_price']}}</div>
                            <div class="table-item">{{$getOrderUser['order_quantity']}}</div>
                            <div class="table-item order_status">{{$getOrderUser['order_status']}}</div>
                            <div class="table-item">
                                @php
                                    $current_time= \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y H:i');
                                    $username_counts = array_count_values(array_column($getOrderUsers, 'username'));
                                @endphp
                                @if(\Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $productinfo['Session_endtime'])->format('d/m/Y H:i') < $current_time)
                                    <div>
                                        <a href="{{route('order-details', ['id' => $getOrderUser['orderID']])}}"><button class="orderButton sellButton">Bán</button></a>
                                        
                                    </div>
                                @else
                                    <p>Chưa kết thúc thời gian đấu giá</p>
                                @endif
                            </div>
                            </div>
                    @endforeach
                </div>

                {{-- View của khách --}}
                @else
                    <div class="auction-table">
                        <div class="table-header">
                        <div class="header-item">STT</div>
                        <div class="header-item">Tên</div>
                        <div class="header-item">Giá</div>
                        <div class="header-item">Số Lượng</div>
                        {{-- <div class="header-item">Thời gian kết thúc</div> --}}
                    </div>
                    <div class="table-body">
                        @foreach(collect($getOrderUsers)->sortByDesc(function($user){
                            return $user['order_price'] * $user['order_quantity'];}) as $index => $getOrderUser)
                            <div class="table-row">
                            <div class="table-item">{{$index + 1}}</div>
                            <div class="table-item"><a href="{{route('profile2', ['id'=> $getOrderUser['id']])}}">{{$getOrderUser['username']}}</a></div>
                            <div class="table-item">{{$getOrderUser['order_price']}}</div>
                            <div class="table-item">{{$getOrderUser['order_quantity']}}</div>

                            {{-- <div class="table-item">{{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $getOrderUser['session_endtime'])->format('d/m/Y H:i') }}</div> --}}
                    </div>
                        @endforeach
                    </div>
                @endif
            </div>
              
        </div>
    </div>
</body>
<script>

document.addEventListener('keydown', function(event) {
  if (event.key === 'Enter') {
    event.preventDefault();
        }
    });
    const username = document.getElementById('username').value;
    const rows = document.querySelectorAll('.table-row');
    let count = 0;
    let totalCount = 0;
    rows.forEach((row) => {
        const name = row.querySelector('.table-item a').textContent;
        if (name === username) {
            count++;
        }
        if (name) {
            totalCount++;
        }
    });

    if (count >= 1) {
        const purchaseBtn = document.querySelector('.btn-purchase');
        const updateBtn = document.querySelector('.updateBtn');
        const orderPrice = document.getElementById('order_price');
        const orderQuantity = document.getElementById('order_quantity');
    if (purchaseBtn) {
            purchaseBtn.style.display = 'none';
            updateBtn.style.display='block';
            orderPrice.style.display='none';
            orderQuantity.style.display='none';
    }
}
    if (totalCount >= 50){
        const purchaseBtn = document.querySelector('.btn-purchase');
        const notiPurchase = document.querySelector('.noti-purchase');
    if (purchaseBtn){
        purchaseBtn.style.display = 'none';
        notiPurchase.style.display='block';
    }
}

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.querySelector('.updateBtn');

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

const rowss = document.querySelectorAll('.table-row');
    rowss.forEach(row => {
        // Tìm phần tử có lớp CSS "sellButton"
        const sellButton = row.querySelector('.sellButton');
        // Nếu trạng thái là "Đã bán", ẩn nút "Bán"
        if (row.querySelector('.order_status').textContent.trim() === 'Hoàn Thành') {
            sellButton.style.display = 'none';
        }
    });
    $(document).ready(function() {
  var rowsPerPage = 5;
  var table = $('.auction-table .table-body');
  var rows = table.children('.table-row');
  var numPages = Math.ceil(rows.length / rowsPerPage);

  // Add pagination buttons
  var pagination = $('<div style="padding: 20px" class="pagination"></div>');
  for (var i = 1; i <= numPages; i++) {
    $('<button style="width:20px; margin-right: 5px" class="page-button">' + i + '</button>').appendTo(pagination);
  }
  pagination.insertAfter(table);

  // Hide all rows except the first page
  rows.slice(rowsPerPage).hide();

  // Add click event to pagination buttons
  $('.page-button').on('click', function() {
    var page = parseInt($(this).text());
    var start = (page - 1) * rowsPerPage;
    var end = start + rowsPerPage;

    // Show/hide rows based on page number
    rows.hide().slice(start, end).show();
  });
});


</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</html>