
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href={{url('/css/main.css')}}>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Social Network</title>
</head>
<body>
    <header>
        <div class="navbar">

            <div class="nav-left">
                <a href={{route('home')}}>Social Network</a>
                <ul>
                    <li><i class="fa-sharp fa-regular fa-bell"></i></li>
                </ul>
            </div>

            <div class="nav-right">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <form action="{{route('search')}}" method="post">
                        @csrf
                        <input type="text" name="username" placeholder="Tìm kiếm...">
                    </form>
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
                            {{-- <p>{{$user->Username}}</p> --}}
                            <a href="{{route('profile')}}">Xem trang cá nhân</a>
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
                            <a href="{{route('update-profile-view')}}">Cập nhật thông tin cá nhân</a>
                        </div>
                    </div>
                    <div class="setting-link">
                        <div class="setting-icon"><i class="fa-solid fa-right-from-bracket"></i></div>
                        <div>
                            <a href="{{route('logout')}}">Đăng xuất</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header> 


    <script>
        //dropdown menu
        const settingMenu = document.querySelector('.settings-menu');

        function settingsMenuToggle(){
        settingMenu.classList.toggle('settings-menu-height')
        }
    </script>