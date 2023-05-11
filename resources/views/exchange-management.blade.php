@extends('header')
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="container">
    @if ($user->email == 'minhhieu@gmail.com' || $user->email == 'xuandanh@gmail.com')
        <div class="left-sidebar">
            <div class="link">
                <a href={{route('home')}}>Trang chủ</a>
                <a href={{route('exchanges')}}>Sàn giao dịch</a>
                <a href="#">Tin nhắn</a>
                <a href={{route('exchanges-management')}} style="color:rgb(3, 183, 0);">Tạo phiên giao dịch</a>
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
                <a href={{route('exchanges')}}>Sàn giao dịch</a>
                <a href="#">Tin nhắn</a>
                <a href={{route('exchanges-management')}} style="color:rgb(3, 183, 0);">Tạo phiên giao dịch</a>
                <a href={{route('list-auctioned', ['id' => $id])}}>Xem sản phẩm đấu giá</a>
                <a href={{route('statistics', ['id' => $id])}}>Xem thống kê phiên giao dịch</a>
            </div>
        </div>   
        @endif
    <div class="main-content">

        <div class="post-container">
            <div class="manager-product">
                <h1>Quản lý sản phẩm</h1>
                <form action="{{route('create-product')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="name">Tên sản phẩm:</label>
                    <input type="text" id="name" name="product_name" required>
        
                    <label for="description">Mô tả sản phẩm:</label>
                    <textarea  style="width: 100%; height: 100px"id ="description" name="desc" required></textarea>
                    <label for="description">Hình ảnh</label>
                    <input type="file" name="img" > 
                    <label for="category">Danh mục:</label>
                    <select id="category" name="category_name">
                    @foreach ($namecategory as $value)
                        <option value="{{$value['category_name']}}">{{$value['category_name']}}</option>
                    @endforeach
                    </select>
                    <label for="price">Giá:</label>
                    <input type="number" id="price" name="price" required>
            
                    <label for="quantity">Số lượng:</label>
                    <input type="number" id="quantity" name="quantity" required>
                    <label for="datetime">Ngày kết thúc</label>
                    <input type="datetime-local" id="datetime" min="{{ \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d\TH:i') }}"name="Session_endtime">
            
                    <input type="submit" onclick="startCountdown()" value="Thêm sản phẩm">
                </form>
                @php
                $current_time= \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y H:i');
              @endphp
            <table class="table-session">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Mô tả sản phẩm</th>
                        <th>Hình Ảnh</th>
                        <th>Danh mục</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thời gian kết thúc</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
            @foreach ($products as $product)
                <tbody>
                    <tr>
                        <td><a href="{{route('product-info', ['id' => $product['idProduct']])}}">{{$product['product_name']}}</a></td>
                        <td>{{$product['desc']}}</td>
                        <td><img style="width: 75%; heigth:30%" src="{{url('/uploads')}}/{{$product['img']}}" alt="" srcset=""></td>
                        <td>{{$product['category_name']}}</td>
                        <td>{{$product['price']}}đ</td>
                        <td>{{$product['quantity']}}</td>
                        <td class="time-cd">{{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $product['Session_endtime'])->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{route('delete-product',['id'=>$product['idProduct']])}}"><button class="delete">Xoá</button></a>
                        </td>
                    </tr>
                </tbody>
            @endforeach
            </table>
            </div>
        </div>
    </div>
    
</div>
</body>
<script>
    currentTime = new Date('{{ $current_time }}').getTime();
// Lấy tất cả các thẻ td có class "time-cd"
var tdList = document.getElementsByClassName("time-cd");

// Lặp qua từng thẻ td và kiểm tra thời gian kết thúc
for (var i = 0; i < tdList.length; i++) {
  var td = tdList[i];
  var sessionEndtime = td.textContent.trim();
  var sessionEndDateTime = new Date(sessionEndtime.replace(/(\d{2})\/(\d{2})\/(\d{4}) (\d{2}):(\d{2})/, "$3/$2/$1 $4:$5"));
  var currentTime = new Date();
  var oneDayAgo = new Date(currentTime);
  oneDayAgo.setDate(currentTime.getDate() - 1);

  // Nếu thời gian kết thúc bé hơn thời gian hiện tại 1 ngày
  if (sessionEndDateTime < oneDayAgo) {
    // Ẩn thẻ tr chứa thẻ td đó
    td.parentElement.style.display = "none";
  }
}

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