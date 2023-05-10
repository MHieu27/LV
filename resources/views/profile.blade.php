@extends('header')
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

                    <div class="user-profile">
                        <img src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                        <div>
                            <p>{{$user->Username}}</p>
                        </div>
                    </div>
                    <form action="{{route('create-post')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="post-input-container">
                            <textarea name="post_content"  rows="3" placeholder="Bạn đang nghĩ gì...?"></textarea>
                        </div>
                        <div class="add-post-link">
                            <div class="file-upload">
                                <img src="https://cdn1.vectorstock.com/i/1000x1000/65/00/upload-file-data-icon-isolated-on-transparent-vector-35906500.jpg" alt="Upload icon">
                                <input type="file" name="post_img" > 
                                <button type="submit" class="btn-create-post" >Đăng bài</button>
                            </div>
                        </div>
                    </form>
                </div>

                           <!--Post1-->
            <div class="post-container">
                <div>
                @foreach ($myProfiles as $myProfile)
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
                <p class="post-text">{{$myProfile['post_content']}}</p>
                <img src="{{url('/uploads')}}/{{$myProfile['post_img']}}" class="post-img" alt="">

                <div class="post-row">
                    <div class="activity-icons" style="margin-bottom: 70px">
                        <div class="heart-post"><i class="fa-regular fa-heart"></i>
                            <small class="count-heart">0</small>
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
                @endforeach
                {{-- comment --}}
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
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</html>