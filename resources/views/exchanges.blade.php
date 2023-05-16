@extends('header')
<style>
  .product-title {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 300px;
  }
</style>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="container">
  @if ($user->email == 'minhhieu@gmail.com' || $user->email == 'xuandanh@gmail.com')
  <div class="left-sidebar">
      <div class="link">
          <a href={{route('home')}}>Trang chủ</a>
          <a href={{route('exchanges')}} style="color:rgb(3, 183, 0);">Sàn giao dịch</a>
          <a href="#">Tin nhắn</a>
          <a href={{route('exchanges-management')}}>Tạo phiên giao dịch</a>
          <a href={{route('list-auctioned', ['id' => $id])}}>Xem sản phẩm đấu giá</a>
          <a href={{route('statistics', ['id' => $id])}}>Xem thống kê phiên giao dịch</a>
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
          <a href={{route('exchanges')}} style="color:rgb(3, 183, 0);">Sàn giao dịch</a>
          <a href="#">Tin nhắn</a>
          <a href={{route('exchanges-management')}}>Tạo phiên giao dịch</a>
          <a href={{route('list-auctioned', ['id' => $id])}}>Xem sản phẩm đấu giá</a>
          <a href={{route('statistics', ['id' => $id])}}>Xem thống kê phiên giao dịch</a>
      </div>
  </div>   
  @endif
    <div class="main-content">
        <div class="filter" style="display: flex">
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

        <div class="post-container">
            <div class="product-container">
              @php
                $current_time= \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y H:i');
              @endphp
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
    <div class="right-sidebar" style="height: 800px;overflow:auto;">
            <div class="card-title">
                <div class="container-card-title">
                    <p>Có thể bạn quan tâm</p>
                </div>
            </div>
            <div class="card">
                <img src="https://cdn.tgdd.vn/Products/Images/8779/226959/bhx/nam-kim-cham-han-quoc-tui-150g-202202151015334518.jpg" alt="Avatar" style="width:100%;  border-radius: 8px 8px 0 0;">
                <div class="card-name">Nâm kim châm</div>
                <div class="container-card">
                <div class="flex-btm"  style="padding:5px;border-right:solid 2px black;">
                    SL: 100KG
                </div>

                <div class="flex-btm" style="padding:5px;">
                    Giá: 10.000
                </div>
                </div>
            </div>
            <div class="card">
                <img src="https://cdn.tgdd.vn/Products/Images/8785/275320/bhx/bong-cai-trang-tui-500g-600g-1-bong-202303110829571023.jpg" alt="Avatar" style="width:100%;  border-radius: 8px 8px 0 0;">
                <div class="card-name">Bông cải trắng</div>
                <div class="container-card">
                <div class="flex-btm"  style="padding:5px;border-right:solid 2px black;">
                    SL: 200KG
                </div>

                <div class="flex-btm" style="padding:5px;">
                    Giá: 12.000
                </div>
                </div>
            </div>
            <div class="card">
                <img src="https://cdn.tgdd.vn/Products/Images/8785/303829/bhx/ca-rot-tui-500g-2-5-cu-202303031529108121.jpg" alt="Avatar" style="width:100%;  border-radius: 8px 8px 0 0;">
                <div class="card-name">Cà rốt</div>
                <div class="container-card">
                <div class="flex-btm"  style="padding:5px;border-right:solid 2px black;">
                    SL: 80KG
                </div>

                <div class="flex-btm" style="padding:5px;">
                    Giá: 22.000
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

  function convertTimeStringToTimestamp(timeString) {
  const dateTimeParts = timeString.split(" ");
  const dateParts = dateTimeParts[0].split("/");
  const timeParts = dateTimeParts[1].split(":");
  const day = parseInt(dateParts[0], 10);
  const month = parseInt(dateParts[1], 10) - 1; 
  const year = parseInt(dateParts[2], 10);
  const hour = parseInt(timeParts[0], 10);
  const minute = parseInt(timeParts[1], 10);

  const dateObject = new Date(year, month, day, hour, minute);
  const timestamp = dateObject.getTime();

  return timestamp;
}
  const currentTime = convertTimeStringToTimestamp('{{$current_time }}');
  //const currentTime = new Date('{{$current_time }}').getTime();
  //console.log(currentTime);
  const productBoxes = document.querySelectorAll('.product-box');
  productBoxes.forEach((box) => {
    const sessionEndTime = Date.parse(box.querySelector('.time-cd').textContent.replace('Thời gian kết thúc: ', ''));
    //console.log(sessionEndTime);
    //console.log(currentTime);

    if (sessionEndTime > currentTime) {
        box.style.display = 'none';
    }
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
</html>
