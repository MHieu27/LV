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
        <div class="create-post-container">

            <div class="user-profile">
                <img src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                <div>
                    <p>{{$user->Username}}</p>
                </div>
            </div>

            <div class="post-input-container">
                <textarea name="" id="" rows="3" placeholder="Bạn đang nghĩ gì...?"></textarea>
            </div>
            <div class="add-post-link">
                <input type="file">
                <button class="btn-create-post" >Đăng bài</button>
            </div>
        </div>

        <!--Post1-->
        <div class="post-container">
            <div class="product-container">
                <div class="product-box">
                    <img class="product-img" src="https://photo-cms-tpo.epicdn.me/w890/Uploaded/2023/rwbvhvobvvimsb/2021_09_26/cacc80-rocc82cc81t-8919.jpg" alt="">
                    <h2 class="product-title"><a href="#">Ca rot</a></h2>
                    <span class="price">10000VND</span>
                    <span class="price">Thời gian còn lại: 24H</span>
                    <div class="user-profile">
                        <img src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                        <div class="product-rating">
                            <p>Minh Hieu</p>
                            <i class="fa fa-star"></i>
                            <span>5</span>
                        </div>
                    </div>
                </div>

                <div class="product-box">
                    <img class="product-img" src="https://photo-cms-tpo.epicdn.me/w890/Uploaded/2023/rwbvhvobvvimsb/2021_09_26/cacc80-rocc82cc81t-8919.jpg" alt="">
                    <h2 class="product-title"><a href="#">Ca rot</a></h2>
                    <span class="price">10000VND</span>

                </div>

                <div class="product-box">
                    <img class="product-img" src="https://photo-cms-tpo.epicdn.me/w890/Uploaded/2023/rwbvhvobvvimsb/2021_09_26/cacc80-rocc82cc81t-8919.jpg" alt="">
                    <h2 class="product-title"><a href="#">Ca rot</a></h2>
                    <span class="price">10000VND</span>
                </div>

                <div class="product-box">
                    <img class="product-img" src="https://photo-cms-tpo.epicdn.me/w890/Uploaded/2023/rwbvhvobvvimsb/2021_09_26/cacc80-rocc82cc81t-8919.jpg" alt="">
                    <h2 class="product-title"><a href="#">Ca rot</a></h2>
                    <span class="price">10000VND</span>
                </div>

                <div class="product-box">
                    <img class="product-img" src="https://photo-cms-tpo.epicdn.me/w890/Uploaded/2023/rwbvhvobvvimsb/2021_09_26/cacc80-rocc82cc81t-8919.jpg" alt="">
                    <h2 class="product-title"><a href="#">Ca rot</a></h2>
                    <span class="price">10000VND</span>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</html>