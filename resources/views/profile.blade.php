@extends('header')
<style>
.dropdown {
    position: relative;
    display: inline-block;
}

.dropbtn {
    background-color: #fff;
    color: #000;
    font-size: 16px;
    border: none;
    cursor: pointer;
    margin-left: 568px;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    margin-left: 568px;
}

.dropdown-content a {
    color: #000;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #f1f1f1;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.btn-update {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.btn-update:hover {
    background-color: #45a049;
}
</style>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <div class="profile-container">
        <img class="cover-img" src="https://i.pinimg.com/originals/40/26/9f/40269f838e7294a13559ce7183f54b1f.jpg" alt="" srcset="">
        <div class="profile-detais">
            <div class="pd-left">
                <div class="pd-row">
                    <img class="pd-img" src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                   <div>
                        <h3>{{$user->Username}}</h3>
                        <a href="#">{{$myFollower}} Lượt theo dõi</a>
                   </div>
                </div>
            </div>
        </div>  
        
        <div class="profile-info">
            <div class="info-col">
                <div class="profile-intro">
                    <h3>Giới thiệu</h3>
                    @if (!$user->bio)
                        <p class="intro-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel, mollitia? Magni quia veniam deleniti illo numquam ab ratione minima? Laborum quis quos voluptates veniam quidem illum nam ad vero! Eius.</p>
                    @else
                        <p class="intro-text">{{$user->bio}}</p>
                    @endif
                    <hr>
                    <ul>
                        <li><i class="fa fa-home"></i>{{$user->address}}</li>
                        <li><i class="fa fa-briefcase"></i>Làm việc tại {{$user->address}}</li>
                        <li><i class="fa fa-birthday-cake"></i>{{$user->birthday}}</li>
                        <li><i class='fas fa-user-circle'></i>{{$user->gender}}</li>
                    </ul>
                </div>

                <div class="profile-intro">
                    <div class="link">
                        <a href={{route('profile')}}>Trang cá nhân</a>
                        <a href="#">Sản phẩm</a>
                    </div>
                </div>
            </div>
            <div class="post-col">
                <div class="create-post-container">
                    <div style="width: 100%">
                        <div class="user-profile">
                            <img src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                            <div>
                                <p>{{$user->Username}}</p>
                            </div>
                        </div>
                        <form action="{{route('create-post')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="post-input-container"></div>
                                <textarea name="post_content" style="width: 100%" rows="3" placeholder="Bạn đang nghĩ gì...?"></textarea>
                            <div class="add-post-link">
                                <div class="file-upload">
                                    <img src="https://cdn1.vectorstock.com/i/1000x1000/65/00/upload-file-data-icon-isolated-on-transparent-vector-35906500.jpg" alt="Upload icon">
                                    <input type="file" name="post_img" > 
                                </div>
                            <button type="submit" class="btn-create-post" >Đăng bài</button>
                            </div>
                        </form>
                    </div>
                @foreach ($myProfiles as $myProfile)
                <div class="post-container">
                    <div>
                    <div class="user-profile">
                        <img src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                        <div>
                            <p>{{$myProfile['username']}}</p>
                            @php
                                $timestamp = $myProfile['post_nowtime'] ? ['seconds' => $myProfile['post_nowtime']->seconds, 'nanoseconds' => $myProfile['post_nowtime']->nanoseconds] : null;
                                $date = $timestamp ? \Carbon\Carbon::createFromTimestamp($timestamp['seconds'])->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i') : null;
                            @endphp
                            <span>{{$date}}</span>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropbtn">⋮</button>
                        <div class="dropdown-content">
                            <a href="#" onclick="openUpdateModal({{$myProfile['postID']}})">Cập nhật bài viết</a>
                            @if($myProfile['postID'])
                            <a href="{{route('delete-post' , ['id' => $myProfile['postID']])}}">Xoá bài viết</a>@endif
                        </div>
                    </div>
                    @if($myProfile['postID'])
                    <div id="updateModal{{$myProfile['postID']}}" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeUpdateModal({{$myProfile['postID']}})">&times;</span>
                            <h2>Cập nhật bài viết</h2>
                            <form id="updateForm{{$myProfile['postID']}}" action="{{route('update-post', ['id' => $myProfile['postID']])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="postId{{$myProfile['postID']}}" name="postId" value="{{$myProfile['postID']}}">
                                <label>Nội dung:</label>
                                <input type="text" name="update_content" value="{{$myProfile['post_content']}}" required>
                
                                <label>Hình ảnh:</label>
                                <input type="file" name="update_file" value="" required>
                                <button type="submit" class="btn-update">Cập nhật</button>
                            </form>
                        </div>
                    </div>@endif
                <p class="post-text">{{$myProfile['post_content']}}</p>
                <img src="{{url('/uploads')}}/{{$myProfile['post_img']}}" class="post-img" alt="">

                <div class="post-row">
                    <div class="activity-icons" style="margin-bottom: 70px">
                        <div class="heart-post"><i class="fa-regular fa-heart"></i>
                            <small class="count-heart">{{$myProfile['liked']}}</small>
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
                </div>           
                    </div> 
            </div>
            @endforeach   
            </div>
        </div>
        </div>
    </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('.show-comments').on('click', function(){
            $(this).parents('.post-row').siblings('.comments-post').slideToggle();
        });
    });

    document.addEventListener("DOMContentLoaded", function(event) {
                var dropdown = document.getElementsByClassName("dropdown");
                var i;

                for (i = 0; i < dropdown.length; i++) {
                    dropdown[i].addEventListener("click", function() {
                        this.classList.toggle("active");
                        var dropdownContent = this.getElementsByClassName("dropdown-content")[0];
                        if (dropdownContent.style.display === "block") {
                            dropdownContent.style.display = "none";
                        } else {
                            dropdownContent.style.display = "block";
                        }
                    });
                }
            });

    function openUpdateModal(postId) {
    var updateModal = document.getElementById("updateModal" + postId);
    var postIdField = document.getElementById("postId" + postId);
    postIdField.value = postId;
    updateModal.style.display = "block";
}

function closeUpdateModal(postId) {
    var updateModal = document.getElementById("updateModal" + postId);
    updateModal.style.display = "none";
}

window.onclick = function (event) {
    var updateModals = document.getElementsByClassName("modal");
    for (var i = 0; i < updateModals.length; i++) {
        if(event.target == updateModals[i]) {
updateModals[i].style.display = "none";
}
}
};
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</html>