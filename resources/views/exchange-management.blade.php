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

        <div class="post-container">
            <div class="manager-product">
                <h1>Quản lý sản phẩm</h1>
                <form action="{{route('create-product')}}" method="POST">
                    @csrf
                    <label for="name">Tên sản phẩm:</label>
                    <input type="text" id="name" name="product_name" required>
        
                    <label for="description">Mô tả sản phẩm:</label>
                    <textarea  id ="description" name="desc" required></textarea>
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
            
                    <input type="submit" value="Thêm sản phẩm">
                </form>
            
            <table>
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Mô tả sản phẩm</th>
                        <th>Hình Ảnh</th>
                        <th>Danh mục</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
            @foreach ($products as $product)
                <tbody>
                    <tr>
                        <td>{{$product['product_name']}}</td>
                        <td>{{$product['desc']}}</td>
                        <td><img style="width: 100%; heigth:30%" src="{{$product['img']}}" alt="" srcset=""></td>
                        <td>{{$product['category_name']}}</td>
                        <td>{{$product['price']}}đ</td>
                        <td>{{$product['quantity']}}</td>
                        <td>
                            <a href="{{route('delete-product',['name'=>$product['product_name']])}}"><button class="delete">Xóa</button></a>
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</html>