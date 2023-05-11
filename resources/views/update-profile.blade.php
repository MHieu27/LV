@extends('header')
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="container">
  <div class="main-content">
    <div class="update-profile-form">
        <form action="{{route('update-profile')}}" method="post">
          @csrf
          <div class="form-group">
            <label for="name">Họ và tên</label>
            <input type="text" id="name" name="update_name" placeholder="Nhập họ và tên" required>
          </div>
          <div class="form-group">
            <label for="birthdate">Ngày sinh</label>
            <input type="date" id="birthdate" name="update_birthday" required>
          </div>
          <div class="form-group">
            <label for="gender">Giới tính</label>
            <select id="gender" name="update_gender" required>
              <option value="" selected disabled hidden>Chọn giới tính</option>
              <option value="Nam">Nam</option>
              <option value="Nữ">Nữ</option>
            </select>
          </div>
          <div class="form-group">
            <label for="introduction">Giới thiệu</label>
            <textarea id="introduction" name="update_bio" rows="5" placeholder="Nhập giới thiệu của bạn"></textarea>
          </div>
          <div class="form-group">
            <label for="address">Địa chỉ</label>
            <input type="text" id="address" name="update_address" placeholder="Nhập địa chỉ của bạn">
          </div>
          <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input type="tel" id="phone" name="update_phone" placeholder="Nhập số điện thoại của bạn">
          </div>
          <div class="form-group">
            <button type="submit">Cập nhật</button>
          </div>
        </form>
      </div>
  </div>
</div>