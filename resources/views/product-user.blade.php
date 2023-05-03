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

    <div class="profile-container">
        <img class="cover-img" src="https://i.pinimg.com/originals/40/26/9f/40269f838e7294a13559ce7183f54b1f.jpg" alt="" srcset="">
        <div class="profile-detais">
            <div class="pd-left">
                <div class="pd-row">
                    <img class="pd-img" src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                   <div>
                        <h3>Minh Hieu</h3>
                        <p>100 Lượt theo dõi</p>
                   </div>
                </div>
            </div>
            <div class="pd-right">
                <button class="follow-btn" type="button">Theo dõi</button>
                <button type="button"><i class="fa-regular fa-message"></i>Nhắn tin</button>
            </div>
        </div>  
        
        <div class="profile-info">
            <div class="info-col">
                <div class="profile-intro">
                    <h3>Giới thiệu</h3>
                    <p class="intro-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel, mollitia? Magni quia veniam deleniti illo numquam ab ratione minima? Laborum quis quos voluptates veniam quidem illum nam ad vero! Eius.</p>
                    <hr>
                    <ul>
                        <li><i class="fa fa-home"></i>Sống tại Cần Thơ</li>
                        <li><i class="fa fa-briefcase"></i>Làm việc tại Cần Thơ</li>
                    </ul>
                </div>

                <div class="profile-intro">
                    <div class="link">
                        <a href="#">Trang cá nhân</a>
                        <a href="#">Sản phẩm</a>
                    </div>
                </div>
            </div>
            <div class="post-col">
                <!--product1-->
                <div class="product-container">
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
<script src="./main.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</html>