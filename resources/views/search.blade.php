@extends('header')
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
                <a href={{route('exchanges-management')}}>Tạo phiên giao dịch</a>
                <a href={{route('list-auctioned', ['id' => $id])}}>Xem sản phẩm đấu giá</a>
                <a href={{route('statistics', ['id' => $id])}}>Xem thống kê phiên giao dịch</a>
            </div>
        </div>   
        @endif
    <div class="main-content">
        <div class="search-container">
            <div class="search-details">
                @foreach ($search_users as $search_user)
                <div class="pd-left">
                    <div class="pd-row">
                        <img class="pd-img" src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                       <div>
                       
                            <h3><a href="{{route('profile2', ['id'=> $search_user['id']])}}">{{$search_user['username']}}</a></h3>
                       </div>
                    </div>
                </div>
                @endforeach
            </div>

            
        </div>
    </div>
<script>
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