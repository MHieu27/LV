@extends('header')
<div class="container">
    <div class="left-sidebar">
        <div class="link">
            <a href={{route('home')}}>Trang chủ</a>
            <a href={{route('exchanges')}}>Sàn giao dịch</a>
            <a href="#">Tin nhắn</a>
            <a href={{route('exchanges-management')}}>Quản lý sàn giao dịch</a>
            <a href={{route('list-auctioned')}}>Xem sản phẩm đấu giá</a>
        </div>
    </div>
    <div class="main-content">
        <div class="search-container">
            <div class="search-details">
                @foreach ($search_user as $user)
                <div class="pd-left">
                    <div class="pd-row">
                        <img class="pd-img" src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                       <div>
                       
                            <h3><a href="{{route('profile2', ['id'=> $user['id']])}}">{{$user['username']}}</a></h3>
                            <p>100 Lượt theo dõi</p>
                       </div>
                    </div>
                </div>
                @endforeach
            </div>

            
        </div>
    </div>