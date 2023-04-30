@extends('index')
@section('content')
<div class="tab-content" id="ex2-content">
    <div  class="tab-pane fade show active" id="ex3-tabs-1" role="tabpanel" aria-labelledby="ex3-tab-1">
        <div class="col">

            @foreach ($recommobe2 as $value)
            <div class="card mb-4">
                <div class="d-flex justify-content-center p-1">
                    <img src="{{ $value['img'] }}"
                    class="rounded-circle shadow-1-strong" width="100" height="100" />
                </div>
            </div>
            @endforeach

        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                            class="rounded-circle img-fluid" style="width: 150px;">
                        {{-- <h5 class="my-3">{{ $user['username'] }}</h5> --}}
                        <p class="text-muted mb-1">Full Stack Developer</p>
                        <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
                        <div class="d-flex justify-content-center mb-2">
                            <button type="button" class="btn btn-primary">Follow</button>
                            <button type="button" class="btn btn-outline-primary ms-1">Message</button>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <lord-icon
                                    src="https://cdn.lordicon.com/gigfpovs.json"
                                    trigger="hover"
                                    >

                                </lord-icon>
                                <p class="mb-0">statistical

                                </p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                                <p class="mb-0">mdbootstrap</p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                                <p class="mb-0">@mdbootstrap</p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                                <p class="mb-0">mdbootstrap</p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                                <p class="mb-0">mdbootstrap</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                            <p class="mb-0">Full Name</p>
                            </div>
                            <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $user['name'] }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                            <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $user['email'] }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                            <p class="mb-0">Phone</p>
                            </div>
                            <div class="col-sm-9">
                            <p class="text-muted mb-0">(097) 234-5678</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                            <p class="mb-0">Mobile</p>
                            </div>
                            <div class="col-sm-9">
                            <p class="text-muted mb-0">(098) 765-4321</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                            <p class="mb-0">Address</p>
                            </div>
                            <div class="col-sm-9">
                            <p class="text-muted mb-0">Bay Area, San Francisco, CA</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row scrollspy" id="scrollspy">
                    @foreach ($product_user as $product)
                        <div class="col-md-6 mb-4" id="product_user">
                            <div class="card mb-4 mb-md-0">
                                <div class="card-body">
                                    <div class="card">
                                        <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                            <img src="{{ $product['product']['img'] }}" class="img-fluid" alt="Fissure in Sandstone"/>
                                            <a href="#!">
                                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                        <p class="card-text" style="overflow: hidden;text-overflow: ellipsis; white-space: nowrap; ">
                                            {{ $product['product']['detail'] }}
                                        </p>
                                        <div style="float:left;"><a href="#!" class="btn btn-success">Buy</a></div>
                                        <div style="float:right;">{{number_format($product['product']['price'], 0, ',', '.')  }} VNĐ</div>
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
    <div class="tab-pane fade" id="ex3-tabs-2" role="tabpanel" aria-labelledby="ex3-tab-2">
        <div  class="tab-pane fade show active" id="ex3-tabs-1" role="tabpanel" aria-labelledby="ex3-tab-1">

            <div class="row">
                <div class="col-lg-2 vertical carousel slide scrollspy" data-ride="carousel">
                    @foreach ($recommobe as $key)
                        <div class="card-body mb-1">
                            <div class="card">
                                <div class="d-flex p-1">
                                    <div class="d-flex justify-content-center">
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(1).webp"
                                        class="rounded-circle shadow-1-strong" width="40" height="40" />
                                    </div>
                                    <div style="margin-left: 5px;">
                                        <div style="font-size: 15px;">{{ $key['name'] }}</div>
                                        <ul class="list-unstyled d-flex p-0 mb-0" style="font-size:12px;">
                                            <?php
                                                $numStars = $key['rating'];
                                                $numFullStars = floor($numStars); // Số sao nguyên
                                                $numHalfStars = $numStars - $numFullStars; // Số sao nửa
                                            ?>
                                            @for ($i = 0; $i < $numFullStars; $i++)
                                                <li>
                                                    <i class="fas fa-star fa-sm text-warning"></i>
                                                </li>
                                            @endfor
                                            @if ($numHalfStars > 0)
                                                <li>
                                                    <i class="fas fa-star-half-alt fa-sm text-warning"></i>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <div class=" hover-overlay ripple" data-mdb-ripple-color="light">
                                    <img src="{{ $key['img'] }}" class="img-fluid" alt="Fissure in Sandstone"/>
                                    <a href="#!">
                                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                    </a>
                                </div>
                                    {{-- <p class="card-text" style="overflow: hidden;text-overflow: ellipsis; white-space: nowrap;display:none;">
                                        {{ $product['product']['detail'] }}
                                        </p> --}}

                                <div class="p-1">
                                    <div class="card-title"  style="font-size:15px;text-align:left;">{{ $key['title'] }}</div>
                                    <div style="text-align:right;font-size:13px;color:red;">{{number_format($key['price'], 0, ',', '.')  }} VNĐ/KG</div>
                                </div>
                                <p style="position: relative;font-size:10px;text-align:center;">Time: 10:10 20/4/2023 - 20:10 21/04/2023</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-10 scrollspy">
                    <div class="row">
                        @foreach ($products as $product)
                        <div class="col-md-4 mb-3">
                            <div class="card mb-md-0" style="float: right;">
                                <button  onclick="detail(event)" data-title="{{ $product['product']['title'] }}" data-img="{{ $product['product']['img'] }}" data-provider="{{ $product['product']['title'] }}" data-detail="{{ $product['product']['detail'] }}" type="button" class="btn p-0" data-mdb-toggle="modal" data-mdb-target="#exampleModal">

                                    <div class="card-body p-3">
                                        <div class="card">
                                            <div class="d-flex p-2">
                                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(1).webp" class="rounded-circle shadow-1-strong"style="max-width: 30px;height:30px;" />
                                                <div class="ms-2">
                                                    <p style="font-size:15px;margin-bottom:0px;">{{ $product['provider'] }}</p>
                                                    <ul class="list-unstyled d-flex mb-0">
                                                        <?php
                                                            $numStars = $product['rating'];
                                                            $numFullStars = floor($numStars); // Số sao nguyên
                                                            $numHalfStars = $numStars - $numFullStars; // Số sao nửa
                                                        ?>
                                                        @for ($i = 0; $i < $numFullStars; $i++)
                                                            <li>
                                                                <i class="fas fa-star fa-sm text-warning"></i>
                                                            </li>
                                                        @endfor
                                                        @if ($numHalfStars > 0)
                                                            <li>
                                                                <i class="fas fa-star-half-alt fa-sm text-warning"></i>
                                                            </li>
                                                        @endif
                                                        @if ($numHalfStars == 0)
                                                            <br>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                                <img src="{{ $product['product']['img'] }}" class="img-fluid" alt="Fissure in Sandstone"/>
                                                <a href="#!">
                                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text" style="overflow: hidden;text-overflow: ellipsis; white-space: nowrap;display:none;">
                                                    {{ $product['product']['detail'] }}
                                                  </p>

                                              <div>
                                                <h5 class="card-title"  style="font-size:20px;text-align:left;">{{ $product['product']['title'] }}</h5>
                                                <div style="text-align:right;font-size:20px">{{number_format($product['product']['price'], 0, ',', '.')  }} VNĐ/KG</div>
                                              </div>

                                            </div>
                                            <p style="position: relative;">Time: 10:10 20/4/2023 - 20:10 21/04/2023</p>
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->


  <!-- Modal -->
  {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="card mb-4 mb-md-0" data-mdb-ripple-centered="true">
            <div class="card-body">
                <div class="card">
                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                    <img id="myImage" src="https://mdbcdn.b-cdn.net/img/new/standard/nature/111.webp" class="img-fluid"/>
                    <a href="#!">
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                    </a>
                    </div>
                    <div class="card-body">
                    <h5 id="provider" class="card-title">Card title</h5>
                    <p id="detail" class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#!" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#exampleModal1">Button</a>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div> --}}

<!-- Modal2 -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="card mb-4 mb-md-0" data-mdb-ripple-centered="true">
            <div class="container">
                <div class="post">
                  <div class="text">Đánh Giá Sản Phẩm</div>
                  <div class="edit"><i class="fas fa-edit"></i></div>
                </div>
                    <form action="#" id="form-request">
                        @csrf
                        <div class="star-rating" style="text-align: center;direction: rtl;">
                                <input type="text" name="title" id="title">
                                <input type="radio" name="rate" id="rate-1"value="5">
                                <label for="rate-1" class="fas fa-star"></label>
                                <input type="radio" name="rate" id="rate-2"value="4">
                                <label for="rate-2" class="fas fa-star"></label>
                                <input type="radio" name="rate" id="rate-3" value="3">
                                <label for="rate-3" class="fas fa-star"></label>
                                <input type="radio" name="rate" id="rate-4" value="2">
                                <label for="rate-4" class="fas fa-star"></label>
                                <input type="radio" name="rate" id="rate-5" value="1">
                                <label for="rate-5" class="fas fa-star"></label>
                                <div class="textarea" style="direction: ltr;">
                                <textarea name="text" cols="30" id="form6Example7" rows="4"></textarea>
                                <label class="form-label" for="form6Example7">Additional information</label>
                        </div>
                        <div class="btn">
                        <button class="btn btn-warning" type="submit"> Đánh Giá</button>
                        </div>
                    </form>
                </div>
              </div>
        </div>
      </div>
    </div>
  </div>
<script>
    if(!$('#product_user').length){
        $('#scrollspy').removeClass('scrollspy')
    }
    /* function detail(event) {
        const provider = event.target.getAttribute("data-provider");
        var outputElement = document.getElementById("modal-text");
        console.log(provider);
		outputElement.innerHTML = provider;

    } */

</script>
<script>
    $('#form-request').submit(function(event) {
    event.preventDefault();
    var formData = $(this).serialize();

    $.ajax({
        type: 'POST',
        url: "{{ route('eval') }}",
        data: formData,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            $('#exampleModal').hide()
            console.log(response)
        },
        error: function(xhr) {
            // xử lý lỗi
        }
    });
});
</script>
<script>
    function detail(event) {
/*     const provider = event.currentTarget.getAttribute("data-provider");
    const detail = event.currentTarget.getAttribute("data-detail"); */
    const title = event.currentTarget.getAttribute("data-title");
/*     const new_img = event.currentTarget.getAttribute("data-img"); */
/*     var outputElement = document.getElementById("provider");
    var outputElement1 = document.getElementById("detail"); */
/*     var img = document.getElementById("myImage"); */
    /* outputElement.innerHTML = provider;
    outputElement1.innerHTML = detail; */
    document.getElementById("title").value = title;
/*     img.setAttribute("src", new_img);
    console.log(var1, var2); */
    }
</script>
@endsection

