@extends('header')
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <div class="container">
        @if ($user->email == 'minhhieu@gmail.com' || $user->email == 'xuandanh@gmail.com')
        <div class="left-sidebar">
            <div class="link">
                <a href={{route('home')}} style="color:rgb(3, 183, 0);">Trang chủ</a>
                <a href={{route('exchanges')}}>Sàn giao dịch</a>
                <a href="#">Tin nhắn</a>
                <a href={{route('exchanges-management')}}>Tạo phiên giao dịch</a>
                <a href={{route('list-auctioned', ['id' => $id])}}>Xem sản phẩm đấu giá</a>
                <a href={{route('statistics', ['id' => $id])}}>Xem thống kê phiên giao dịch</a>
                <button class="dropdown-btn">Quản lý 
                    <i class="fa fa-caret-down"></i>
                  </button>
                  <div class="dropdown-container">

                    <a href={{route('criteria')}}>Tiêu chí đánh giá</a>
                    <a href="{{route('listUsers')}}">Danh sách người dùng</a>
                    <a href="{{route('listSession')}}">Danh sách phiên giao dịch</a>
                  </div>
            </div>
        </div>   
        @else
        <div class="left-sidebar">
            <div class="link">
                <a href={{route('home')}} style="color:rgb(3, 183, 0);">Trang chủ</a>
                <a href={{route('exchanges')}}>Sàn giao dịch</a>
                <a href="#">Tin nhắn</a>
                <a href={{route('exchanges-management')}}>Tạo phiên giao dịch</a>
                <a href={{route('list-auctioned', ['id' => $id])}}>Xem sản phẩm đấu giá</a>
                <a href={{route('statistics', ['id' => $id])}}>Xem thống kê phiên giao dịch</a>
            </div>
        </div>   
        @endif

        
        <div class="main-content">
            <div class="create-post-container">

                <div class="user-profile">
                    <img src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                    <div>
                        <p>{{$user->Username}}</p>
                    </div>
                </div>
                    <div class="post-input-container">
                        <textarea name="post_content" id="" rows="3" placeholder="Bạn đang nghĩ gì...?"></textarea>
                    </div>
                
                    <div class="add-post-link">
                        <div class="file-upload">
                            <img src="https://cdn1.vectorstock.com/i/1000x1000/65/00/upload-file-data-icon-isolated-on-transparent-vector-35906500.jpg" alt="Upload icon">
                            <input type="file" name="post_img" > 
                        </div>
                    <button type="submit" class="btn-create-post" >Đăng bài</button>
                    </div>
            </div>

            <!--Post1-->
            @foreach($showHomePages as $showHomePage)
            <div class="post-container">
                <div class="user-profile">
                    <img src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                    <div>
                        <p>{{$showHomePage['username']}}</p>
                        @php
                            $timestamp = $showHomePage['post_nowtime'] ? ['seconds' => $showHomePage['post_nowtime']->seconds, 'nanoseconds' => $showHomePage['post_nowtime']->nanoseconds] : null;
                            $date = $timestamp ? \Carbon\Carbon::createFromTimestamp($timestamp['seconds'])->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i') : null;
                        @endphp
                        <span>{{$date}}</span>
                    </div>
                </div>
                <p class="post-text">{{$showHomePage['post_content']}}</p>
                <img src="{{url('/uploads')}}/{{$showHomePage['post_img']}}" class="post-img" alt="">

                <div class="post-row">
                    <div class="activity-icons">
                        <div class="heart-post">
                            <i class="fa-regular fa-heart"></i>
                            <small id="count-heart">{{$showHomePage['liked']}}</small>
                        </div>
                        <div class="show-comments"><i class="fa-regular fa-comment"></i>10</div>
                        <div><i class="fa-light fa-share"></i>3</div>
                    </div>
                </div>

                <div class="comments-post">
                  <div class="comment-box">
                    <div class="user-profile">
                        <img src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                        <div>
                            <a class="user-name-comment" href="#"> Minh Hieu</a>
                        </div>
                    </div>
                    <div class="comments-input-container">
                        <textarea name="" id="" rows="3" placeholder="Bạn đang nghĩ gì...?"></textarea>
                    </div>
                    <div class="add-post-link">
                        <button class="btn-create-comment" >Bình luận</button>
                    </div>
                  </div>

                    <div class="comments-info">
                        <div class="user-profile">
                            <img src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                            <div>
                                <a class="user-name" href="#"> Minh Hieu</a>
                            </div>
                        </div>
                        <div class="comment">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius ea fugit quia natus quam totam perferendis eaque praesentium ut, nesciunt alias consectetur, eveniet dolorum est fugiat. Doloremque enim quidem laudantium.</p>
                        </div>
                    </div>

                    <div class="comments-info">
                        <div class="user-profile">
                            <img src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                            <div>
                                <a class="user-name" href="#"> Minh Hieu</a>
                            </div>
                        </div>
                        <div class="comment">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius ea fugit quia natus quam totam perferendis eaque praesentium ut, nesciunt alias consectetur, eveniet dolorum est fugiat. Doloremque enim quidem laudantium.</p>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>
        <div class="right-sidebar" style="height: 800px;overflow:auto;">
            <div class="card-title">
                <div class="container-card-title">
                    <p>Có thể bạn quan tâm</p>
                </div>
            </div>
            <div class="card">
                <img src="https://cdn.tgdd.vn/Products/Images/8779/226959/bhx/nam-kim-cham-han-quoc-tui-150g-202202151015334518.jpg" alt="Avatar" style="width:100%;  border-radius: 8px 8px 0 0;">
                <div class="card-name">Nâm kim châm</div>
                <div class="container-card">
                <div class="flex-btm"  style="padding:5px;border-right:solid 2px black;">
                    SL: 100KG
                </div>

                <div class="flex-btm" style="padding:5px;">
                    Giá: 10.000
                </div>
                </div>
            </div>
            <div class="card">
                <img src="https://cdn.tgdd.vn/Products/Images/8785/275320/bhx/bong-cai-trang-tui-500g-600g-1-bong-202303110829571023.jpg" alt="Avatar" style="width:100%;  border-radius: 8px 8px 0 0;">
                <div class="card-name">Bông cải trắng</div>
                <div class="container-card">
                <div class="flex-btm"  style="padding:5px;border-right:solid 2px black;">
                    SL: 200KG
                </div>

                <div class="flex-btm" style="padding:5px;">
                    Giá: 12.000
                </div>
                </div>
            </div>
            <div class="card">
                <img src="https://cdn.tgdd.vn/Products/Images/8785/303829/bhx/ca-rot-tui-500g-2-5-cu-202303031529108121.jpg" alt="Avatar" style="width:100%;  border-radius: 8px 8px 0 0;">
                <div class="card-name">Cà rốt</div>
                <div class="container-card">
                <div class="flex-btm"  style="padding:5px;border-right:solid 2px black;">
                    SL: 80KG
                </div>

                <div class="flex-btm" style="padding:5px;">
                    Giá: 22.000
                </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
     $(document).ready(function(){
        $('.show-comments').on('click', function(){
            $(this).parents('.post-row').siblings('.comments-post').slideToggle();
        });
    });

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


  $(document).ready(function() {
   $('.heart-btn').click(function() {
    var postId = $(this).data('post-id');
    var postId = postId.toString();

    $.ajax({
        url: "{{ route('like-post') }}",
        method: "POST",
        data: {
            postId: postId,
            _token: "{{ csrf_token() }}"
        },
        success: function(response) {
            if (response.success) {
                $('#count-heart').text(response.liked);
            }
        }
    });
});
$('.unheart-btn').click(function() {
    var postId = $(this).data('post-id');
    var postId = postId.toString();

    $.ajax({
        url: "{{ route('unlike-post') }}",
        method: "POST",
        data: {
            postId: postId,
            _token: "{{ csrf_token() }}"
        },
        success: function(response) {
            if (response.success) {
                $('#count-heart').text(response.liked);
            }
        }
    });
});
});
}
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</html>