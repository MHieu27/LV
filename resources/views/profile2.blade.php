@extends('header')
    <div class="profile-container">
        <img class="cover-img" src="https://i.pinimg.com/originals/40/26/9f/40269f838e7294a13559ce7183f54b1f.jpg" alt="" srcset="">
        <div class="profile-detais">
            <div class="pd-left">
                <div class="pd-row">
                    <img class="pd-img" src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                   <div>
                        <h3>{{$username}}</h3>
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
                        <li><i class="fa fa-home"></i>{{$address}}</li>
                        <li><i class="fa fa-briefcase"></i>Làm việc tại {{$address}}</li>
                        <li><i class="fa fa-birthday-cake"></i>{{$birthday}}</li>
                        <li><i class='fas fa-user-circle'></i>{{$gender}}</li>
                    </ul>
                </div>

                <div class="profile-intro">
                    <div class="link">
                        <a href="{{route('profile2',['username'=>$username])}}">Trang cá nhân</a>
                        <a href="#">Sản phẩm</a>
                    </div>
                </div>
            </div>
            <div class="post-col">
                           <!--Post1-->
            <div class="post-container">
                <div class="user-profile">
                    <img src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                    <div>
                        <p>Minh Hieu</p>
                        <span>20/10/2023, 13:40</span>
                    </div>
                </div>
                <p class="post-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit hic molestias fugiat voluptatum perspiciatis dignissimos repellat magnam animi rerum velit eveniet unde recusandae dicta libero obcaecati eos, inventore ipsum atque!</p>
                <img src="https://product.hstatic.net/200000271661/product/ca_rot_vi_thuoc_chua_2_f08a9353829c4723a468f1a0cb29bb65.jpg" class="post-img" alt="">

                <div class="post-row">
                    <div class="activity-icons">
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
            <!--Post2-->
            <div class="post-container">
                <div class="user-profile">
                    <img src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                    <div>
                        <p>Minh Hieu</p>
                        <span>20/10/2023, 13:40</span>
                    </div>
                </div>
                <p class="post-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit hic molestias fugiat voluptatum perspiciatis dignissimos repellat magnam animi rerum velit eveniet unde recusandae dicta libero obcaecati eos, inventore ipsum atque!</p>
                <img src="https://cdn.tgdd.vn/2021/06/CookProductThumb/cu-2-620x620.jpg" class="post-img" alt="">

                <div class="post-row">
                    <div class="activity-icons">
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
        </div>
    </div>
</body>
<script>
    const commentPost = document.querySelector('.comments-post');
    const showComments = document.querySelector('.show-comments');

    showComments.addEventListener('click', () => {
        commentPost.classList.toggle('active');
    })
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</html>