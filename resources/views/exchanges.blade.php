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
        <div class="filter">
            <label for="sort-by-alphabet">Sắp xếp theo bảng chữ c&aacute;i:</label>
            <select id="sort-by-alphabet">
            <option value="asc">A - Z</option>
            <option value="desc">Z - A</option>
            </select>

            <input type="search" placeholder="Tìm kiếm sản phẩm..." style="
            margin-left: 300px;
            padding: 4 30px;"  id="search-input">
        </div>
          
          <div class="product-list">
            <!-- Danh sách sản phẩm sẽ được hiển thị ở đây -->
          </div>
          
        <!--Post1-->
        <div class="post-container">
            <div class="product-container">
                @foreach ($getAllProducts as $getAllProduct)
                <div class="product-box">
                    <img class="product-img" src="{{url('/uploads')}}/{{$getAllProduct['img']}}"alt="">
                    <h2 class="product-title"><a href="{{route('product-info', ['id' => $getAllProduct['idProduct']])}}">{{$getAllProduct['product_name']}}</a></h2>
                    <span class="price">{{$getAllProduct['price']}}VND</span>
                    <div>
                        <span class="time-cd">Thời gian kết thúc: {{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $getAllProduct['Session_endtime'])->format('d/m/Y H:i') }}</span>
                    </div>
                    <hr>
                    <div class="user-profile">
                        <img src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                        <div class="product-rating">
                            <a href="{{route('profile2',['id'=>$getAllProduct['id']])}}">{{$getAllProduct['username']}}</a>
                            <i class="fa fa-star"></i>
                            <span>5</span>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
</body>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
    // Lấy danh sách sản phẩm và lưu vào biến products
    var getAllProducts = <?php echo json_encode($getAllProducts); ?>;

    // Lấy các phần tử cần thiết từ HTML
    const selectSort = document.getElementById('sort-by-alphabet');
    const productList = document.querySelector('.product-container');
    var searchInput = document.getElementById("search-input");

    // Hàm để sắp xếp sản phẩm theo bảng chữ cái
    function sortProductsAlphabetically(order) {
        // Sắp xếp danh sách sản phẩm
        getAllProducts.sort((a, b) => {
            let nameA = a.product_name.toUpperCase();
            let nameB = b.product_name.toUpperCase();
            if (nameA < nameB) {
                return order === 'asc' ? -1 : 1;
            }
            if (nameA > nameB) {
                return order === 'asc' ? 1 : -1;
            }
            return 0;
        });
        displayProducts();
        }
        function displayProducts() {
  // Xóa các sản phẩm hiện có trong danh sách
  productList.innerHTML = '';

  // Lặp qua từng sản phẩm trong danh sách sản phẩm
  getAllProducts.forEach(product => {
    // Tạo một phần tử sản phẩm HTML mới
    const productBox = document.createElement('div');
    productBox.classList.add('product-box');

    // Thêm ảnh sản phẩm
    const productImg = document.createElement('img');
    productImg.classList.add('product-img');
    productImg.src = `/uploads/${product.img}`;
    productBox.appendChild(productImg);

    // Thêm tiêu đề sản phẩm
    const productTitle = document.createElement('h2');
    const productLink = document.createElement('a');
    productLink.href = `/product-info/${product.idProduct}`;
    productLink.innerText = product.product_name;
    productTitle.appendChild(productLink);
    productBox.appendChild(productTitle);

    // Thêm giá sản phẩm
    const productPrice = document.createElement('span');
    productPrice.classList.add('price');
    productPrice.innerText = `${product.price} VND`;
    productBox.appendChild(productPrice);

    // Thêm thời gian kết thúc phiên đấu giá
    const productSessionEndtime = document.createElement('div');
    const sessionEndtime = new Date(product.Session_endtime).toLocaleString();
    productSessionEndtime.classList.add('time-cd');
    productSessionEndtime.innerText = `Thời gian kết thúc: ${sessionEndtime}`;
    productBox.appendChild(productSessionEndtime);

    // Thêm phân cách
    const productHr = document.createElement('hr');
    productBox.appendChild(productHr);

    // Thêm thông tin người đăng
    const userProfile = document.createElement('div');
    userProfile.classList.add('user-profile');

    const userImg = document.createElement('img');
    userImg.src = 'https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg';
    userProfile.appendChild(userImg);

    const productRating = document.createElement('div');
    productRating.classList.add('product-rating');

    const userLink = document.createElement('a');
    userLink.href = `/profile2/${product.id}`;
    userLink.innerText = product.username;
    productRating.appendChild(userLink);

    const ratingIcon = document.createElement('i');
    ratingIcon.classList.add('fa', 'fa-star');
    productRating.appendChild(ratingIcon);

    const ratingNumber = document.createElement('span');
    ratingNumber.innerText = '5';
    productRating.appendChild(ratingNumber);

    userProfile.appendChild(productRating);
    productBox.appendChild(userProfile);

    // Thêm sản phẩm vào danh sách sản phẩm
    productList.appendChild(productBox);
  });
}
// Gọi hàm sắp xếp sản phẩm khi người dùng chọn giá trị mới
    selectSort.addEventListener('change', (event) => {
    sortProductsAlphabetically(event.target.value);
});


searchInput.addEventListener("keyup", function(event) {
    // Kiểm tra nếu người dùng ấn phím Enter thì không tìm kiếm
    if (event.keyCode === 13) {
      event.preventDefault();
      return false;
    }

    // Lấy giá trị của ô search
    var searchText = event.target.value.toLowerCase();

    // Lấy tất cả các sản phẩm
    var products = document.querySelectorAll(".product-box");

    // Lặp qua từng sản phẩm
    products.forEach(function(product) {
      // Lấy tên sản phẩm của sản phẩm đó
      var productName = product.querySelector(".product-title").textContent.toLowerCase();

      // Kiểm tra nếu tên sản phẩm chứa từ khóa tìm kiếm thì hiển thị sản phẩm đó
      if (productName.includes(searchText)) {
        product.style.display = "block";
      } else {
        product.style.display = "none";
      }
    });

    function searchProduct() {
        let input = searchInput.value;
        let products = document.getElementsByClassName('product-box');
        if (input === '') {
            for (let i = 0; i < products.length; i++) {
                products[i].style.display = 'block';
            }
        } else {
                for (let i = 0; i < products.length; i++) {
                    let productName = products[i].getElementsByClassName('product-title')[0].innerText.toLowerCase();
                    if (productName.indexOf(input.toLowerCase()) > -1) {
                    products[i].style.display = 'block';
        } else {
                products[i].style.display = 'none';
      }
    }
  }
}
  });

</script>
</html>