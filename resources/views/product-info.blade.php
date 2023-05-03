<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href={{url('/css/main.css')}}>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Social Network</title>
</head>
<body>
    <header>
        <div class="navbar">

            <div class="nav-left">
                <a href="#">Social Network</a>
                <ul>
                    <li><i class="fa-sharp fa-regular fa-bell"></i></li>
                    <li><i class="fa-solid fa-inbox"></i></li>
                </ul>
            </div>

            <div class="nav-right">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Tìm kiếm...">
                </div>
                <div class="nav-user-icon" onclick="settingsMenuToggle()">
                    <img src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="" srcset="">
                </div>
            </div>

            <div class="settings-menu">
                <div class="settings-menu-inner">
                    <div class="user-profile">
                        <img src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                        <div>
                            <p>Minh Hieu</p>
                            <a href="#">Xem trang cá nhân</a>
                        </div>
                    </div>
                    <hr>
                    <div class="setting-link">
                        <div class="setting-icon"><i class="fa fa-gear"></i></div>
                        <div>
                            <a href="#">Cài đặt</a>
                        </div>
                    </div>
                    <div class="setting-link">
                        <div class="setting-icon"><i class="fa-regular fa-user"></i></div>
                        <div>
                            <a href="#">Cập nhật thông tin cá nhân</a>
                        </div>
                    </div>
                    <div class="setting-link">
                        <div class="setting-icon"><i class="fa-solid fa-right-from-bracket"></i></div>
                        <div>
                            <a href="#">Đăng xuất</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

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
            <div class="product-info-container">
                <div class="product-imgs">
                    <img src="https://photo-cms-tpo.epicdn.me/w890/Uploaded/2023/rwbvhvobvvimsb/2021_09_26/cacc80-rocc82cc81t-8919.jpg" alt="">
                </div>
                <div class="product-content">
                    <h2 class="product-title">Ca rot</h2>
                    <div class="user-profile">
                        <img src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                        <div class="product-rating">
                            <p>Minh Hieu</p>
                            <i class="fa fa-star"></i>
                            <span>5</span>
                        </div>
                    </div>
                    <div class="product-price"><span>10000VND</span></div>
                    <div class="count-product"><span>So luong: 10</span></div>
                    <div class="product-detail">
                        <h2>Ve san pham</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum dolores necessitatibus ut quia cumque repudiandae consequuntur officia porro molestias laboriosam, veritatis non atque fuga maiores dignissimos facere reprehenderit doloribus nemo!</p>
                    </div>
                    <div class="purchase-info">
                        <input type="number" min = "10000">VND
                    </div>
                    <div class="purchase-info">
                        So luong <input type="number" min = "1">
                    </div>
                    <div class="purchase-info">
                        <button type="button" class="btn-purchase">Mua</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</html>