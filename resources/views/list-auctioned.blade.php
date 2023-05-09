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
    <div class="main-content">
        <div class="post-container">  
            <div class="manager-product">
            <input id="search-list" type="text" placeholder="Tìm kiếm...">   
            <table class="show-list-auction">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Giá đã đấu giá</th>
                        <th>Số lượng</th>
                        <th>Trạng thái</th>
                        <th>Tên người bán</th>
                    </tr>
                </thead>
            @foreach ($getAllListAuctioned as $ListAuctioned)
                <tbody>
                    <tr>
                        <td><a href="{{route('product-info', ['id' => $ListAuctioned['idProduct']])}}">{{$ListAuctioned['product_name']}}</a></td>
                        <td>{{$ListAuctioned['order_price']}}đ</td>
                        <td>{{$ListAuctioned['order_quantity']}}</td>
                        <td>{{$ListAuctioned['order_status']}}</td>
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

</script>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</html>