@extends('header')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="container">
    @if ($user->email == 'minhhieu@gmail.com' || $user->email == 'xuandanh@gmail.com')
        <div class="left-sidebar">
            <div class="link">
                <a href={{route('home')}}>Trang chủ</a>
                <a href={{route('exchanges')}}>Sàn giao dịch</a>
                <a href="#">Tin nhắn</a>
                <a href={{route('exchanges-management')}}>Tạo phiên giao dịch</a>
                <a href={{route('list-auctioned', ['id' => $id])}}>Xem sản phẩm đấu giá</a>
                <a href={{route('statistics', ['id' => $id])}} style="color:rgb(3, 183, 0);">Xem thống kê phiên giao dịch</a>
                <button class="dropdown-btn">Quản lý 
                    <i class="fa fa-caret-down"></i>
                  </button>
                  <div class="dropdown-container">
                    <a href="{{route('listUsers')}}">Danh sách người dùng</a>
                    <a href="{{route('listSession')}}">Danh sách phiên giao dịch</a>
                  </div>
            </div>
        </div>   
        @else
        <div class="left-sidebar">
            <div class="link">
                <a href={{route('home')}}>Trang chủ</a>
                <a href={{route('exchanges')}}>Sàn giao dịch</a>
                <a href="#">Tin nhắn</a>
                <a href={{route('exchanges-management')}}>Tạo phiên giao dịch</a>
                <a href={{route('list-auctioned', ['id' => $id])}}>Xem sản phẩm đấu giá</a>
                <a href={{route('statistics', ['id' => $id])}} style="color:rgb(3, 183, 0);">Xem thống kê phiên giao dịch</a>
            </div>
        </div>   
        @endif
    <div class="main-content">
        <div class="post-container">  
            <div class="manager-product">
            <input id="search-list" type="text" placeholder="Tìm kiếm...">   
            <table class="show-list-auction">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Phiên giao dịch</th>
                        <th>Tổng tiền trong phiên giao dịch</th>
                    </tr>
                </thead>
            @foreach ($getStatistics as $getStatistic)
                <tbody>
                    <tr>
                        <td><a href="{{route('product-info', ['id' => $getStatistic['idProduct']])}}">{{$getStatistic['product_name']}}</a></td>
                        <td>{{$getStatistic['price']}}đ</td>
                        <td>{{$getStatistic['quantity']}}</td>
                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $getStatistic['session_endtime'])->format('d/m/Y H:i') }}</td>
                        <td>{{$getStatistic['totalPrice']}}đ</td>
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

<script>
    // Lấy tất cả các dòng trong bảng
    var rows = document.querySelectorAll(".show-list-auction tbody tr");
    // Tính tổng số trang
    var pages = Math.ceil(rows.length / 5);
    // Tạo một danh sách các nút phân trang
    var pagination = document.createElement("div");
    for (var i = 1; i <= pages; i++) {
        var link = document.createElement("a");
        link.href = "#";
        link.innerHTML = i;
        link.onclick = function() {
            // Lấy số trang hiện tại
            var page = parseInt(this.innerHTML);
            // Tính vị trí bắt đầu và kết thúc của các dòng trong trang này
            var start = (page - 1) * 5;
            var end = start + 5;
            // Ẩn tất cả các dòng trong bảng
            for (var j = 0; j < rows.length; j++) {
                rows[j].style.display = "none";
            }
            // Hiển thị các dòng trong trang này
            for (var j = start; j < end && j < rows.length; j++) {
                rows[j].style.display = "";
            }
            // Đặt lại trạng thái của nút phân trang
            var links = pagination.querySelectorAll("a");
            for (var j = 0; j < links.length; j++) {
                links[j].classList.remove("active");
            }
            this.classList.add("active");
            return false;
        };
        pagination.appendChild(link);
    }
    // Thêm danh sách nút phân trang vào trang HTML
    var container = document.querySelector(".post-container");
    container.appendChild(pagination);
    // Mặc định hiển thị trang đầu tiên
    pagination.querySelector("a").click();

    const searchInput = document.getElementById('search-list');
    const tableRows = document.querySelectorAll('.show-list-auction tbody tr');

    searchInput.addEventListener('input', function() {
        const searchTerm = searchInput.value.toLowerCase();

        tableRows.forEach(function(row) {
            const productName = row.querySelector('td:first-child').textContent.toLowerCase();
            const sellerName = row.querySelector('td:last-child').textContent.toLowerCase();

            if (productName.includes(searchTerm) || sellerName.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });


    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active-dropdown-nav");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</html>