@extends('header')
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <div class="profile-container">
        <img class="cover-img" src="https://i.pinimg.com/originals/40/26/9f/40269f838e7294a13559ce7183f54b1f.jpg" alt="" srcset="">
        <div class="profile-detais">
            <div class="pd-left">
                <div class="pd-row">
                    @foreach($profileUsers as $profileUser)
                    <img class="pd-img" src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                   <div>
                        <h3>{{$profileUser['username']}}</h3>
                        <a href="#"><p>{{$profileUser['totalFollower']}} người theo dõi</p></a>
                   </div>
                </div>
            </div>
            <div class="pd-right">
                <form action="{{route('follow', ['id' => $profileUser['id']])}}" method="post">
                    @csrf
                    @if(!$profileUser['follow'])
                        <button class="follow-btn" type="submit">Theo dõi</button>
                        <button type="button"><i class="fa-regular fa-message"></i>Nhắn tin</button>
                    {{-- @else
                        <button class="follow-btn" type="submit">Huy theo doi</button>
                        <button type="button"><i class="fa-regular fa-message"></i>Nhắn tin</button> --}}
                    @endif
                </form>
                <form action="{{route('un-follow', ['id' => $profileUser['id']])}}" method="post">
                    @csrf
                    @if($profileUser['follow'])
                        <button class="follow-btn" type="submit">Huỷ theo dõi</button>
                        <button type="button"><i class="fa-regular fa-message"></i>Nhắn tin</button>
                    @endif
                </form>
            </div>
        </div>  
        
        <div class="profile-info">
            <div class="info-col">
                <div class="profile-intro">
                    <h3>Giới thiệu</h3>
                    <p class="intro-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel, mollitia? Magni quia veniam deleniti illo numquam ab ratione minima? Laborum quis quos voluptates veniam quidem illum nam ad vero! Eius.</p>
                    <hr>
                    <ul>
                        <li><i class="fa fa-home"></i>{{$profileUser['address']}}</li>
                        <li><i class="fa fa-briefcase"></i>Làm việc tại {{$profileUser['address']}}</li>
                        <li><i class="fa fa-birthday-cake"></i>{{$profileUser['birthday']}}</li>
                        <li><i class='fas fa-user-circle'></i>{{$profileUser['gender']}}</li>
                    </ul>
                </div>

                <div class="profile-intro">
                    <div class="link">
                        <a href="{{route('profile2',['id'=>$profileUser['id']])}}">Trang cá nhân</a>
                        <a href="#">Sản phẩm</a>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="post-col">
                <div class="create-post-container">
            @foreach ($postViews as $postView)
            <div class="post-container">
                <div>
                <div class="user-profile">
                    <img src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                    <div>
                        <p>{{$postView['username']}}</p>
                        @php
                            $timestamp = $postView['post_nowtime'] ? ['seconds' => $postView['post_nowtime']->seconds, 'nanoseconds' => $postView['post_nowtime']->nanoseconds] : null;
                            $date = $timestamp ? \Carbon\Carbon::createFromTimestamp($timestamp['seconds'])->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i') : null;
                        @endphp
                        <span>{{$date}}</span>
                    </div>
                </div>
                <p class="post-text">{{$postView['post_content']}}</p>
                <img src="{{url('/uploads')}}/{{$postView['post_img']}}" class="post-img" alt="">

                <div class="post-row">
                    <div class="activity-icons" style="margin-bottom: 70px">
                        <div class="heart-post">
                            @if(!$checkLiked)
                            <button class="heart-btn" style="border: 0; cursor: pointer; background:#fff; " data-post-id="{{$postView['postID']}}"><i class="fa-regular fa-heart"></i></button>
                            @else
                            <button class="unheart-btn" style="border: 0; cursor: pointer; background:#fff; " data-post-id="{{$postView['postID']}}"><i style="color: red" class="fa-regular fa-heart"></i></button>
                            @endif
                            <small id="count-heart">{{$postView['liked']}}</small>
                        </div>
                        <div class="show-comments"><i class="fa-regular fa-comment"></i>{{$postView['totalComment']}}</div>
                        <div><i class="fa-light fa-share"></i>3</div>
                    </div>
                </div>
                <div class="comments-post">
                    <div class="comment-box">
                      <div class="user-profile">
                          <img src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                          <div>
                              <a class="user-name-comment" href="#">{{$user->Username}}</a>
                          </div>
                      </div>
                      @if($postView['postID'])
                      <form action={{route('comment-post', ['id' => $postView['postID']])}} method="post">
                        @csrf
                        <div class="comments-input-container">
                            <textarea name="content_comment" id="" rows="3" placeholder="Bạn đang nghĩ gì...?"></textarea>
                        </div>
                        <div class="add-post-link">
                            <button type="submit" class="btn-create-comment" >Bình luận</button>
                        </div>
                      </form>
                      @endif
                    </div>

                      <div class="comments-info">
                          <div class="user-profile">
                              <img src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                              <div>
                                  <a class="user-name" href="#"></a>
                              </div>
                          </div>
                          <div class="comment">
                              <p>{{$postView['comment']}}</p>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });


    $(document).ready(function(){
        $('.show-comments').on('click', function(){
            $(this).parents('.post-row').siblings('.comments-post').slideToggle();
        });
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


</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</html>