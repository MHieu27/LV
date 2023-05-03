<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href={{url('/css/main.css')}}>
    <title>Social Network</title>
</head>
<body>
    <div class="bg">
    </div>
    <header>
        <div class="navbar">
            <a href="#">Social Network</a>
        </div>
    </header>
    <section>
        <div class="wrapper">
                <!--SIGN UP-->
            <div class="form-box sign-up">
                <h2>Đăng ký</h2>
                <form action="{{ route('create') }}" method="post">
                    @csrf
                    <div class="input-box">
                        <input type="text" name="username"placeholder="Tên">
                    </div>
                    <div class="input-box">
                        <input type="email" name="email"placeholder="Email">
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" placeholder="Mật Khẩu">
                    </div>
                    <div class="input-box">
                        <input type="text" name="phonenumber" placeholder="Số điện thoại">
                    </div>
                    <div class="input-box">
                        <input type="text" name="address" placeholder="Địa chỉ">
                    </div>
                    <div class="input-box">
                        <input type="text" name="birthday" placeholder="Ngày sinh">
                    </div>
                    <div class="input-box">
                        <input type="text" name="gender" placeholder="Giới tính">
                    </div>
                    <button type="submit" class="btn-sign-in-up">Đăng ký</button>
                    <div class="register-login">
                        <p>Đã có tài khoản?<a class="login-link" href="#">Đăng nhập ngay!</a></p>
                    </div>
                </form>
            </div>
            <!--SIGN IN-->
            <div class="form-box sign-in">
                <h2>Đăng nhập</h2>
                <form action="{{ route('check-login') }}" method="post">
                    @csrf
                    <div class="input-box">
                        <input type="email" name="email" placeholder="Email">
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" placeholder="Mật Khẩu">
                    </div>
                    <button type="submit" class="btn-sign-in-up" name="login">Đăng nhập</button>
                    <div class="register-login">
                        <p>Chưa có tài khoản?<a class="register-link" href="#">Đăng ký ngay!</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
<script>
    // login logout
const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');

registerLink.addEventListener('click', ()=> {
    wrapper.classList.add('active');
})

loginLink.addEventListener('click', ()=> {
    wrapper.classList.remove('active');
})
</script>
</html>