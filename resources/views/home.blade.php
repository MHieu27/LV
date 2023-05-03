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
            <div class="create-post-container">

                <div class="user-profile">
                    <img src="https://static.toiimg.com/thumb/resizemode-4,msid-76729750,imgsize-249247,width-720/76729750.jpg" alt="">
                    <div>
                        <p>{{$user->Username}}</p>
                    </div>
                </div>

                <div class="post-input-container">
                    <textarea name="" id="" rows="3" placeholder="Bạn đang nghĩ gì...?"></textarea>
                </div>
                <div class="add-post-link">
                    <input type="file">
                    <button class="btn-create-post" >Đăng bài</button>
                </div>
            </div>

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