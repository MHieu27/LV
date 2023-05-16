@extends('header')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
    .post-container a.active {
        color:rgb(3, 183, 0);
        margin: 0 10px;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="container">
    @if ($user->email == 'minhhieu@gmail.com' || $user->email == 'xuandanh@gmail.com')
        <div class="left-sidebar">
            <div class="link">
                <a href={{route('home')}}>Trang chủ</a>
                <a href={{route('exchanges')}}>Sàn giao dịch</a>
                <a href="#">Tin nhắn</a>
                <a href={{route('exchanges-management')}}>Tạo phiên giao dịch</a>
                <a href={{route('list-auctioned', ['id' => $id])}} style="color:rgb(3, 183, 0);">Xem sản phẩm đấu giá</a>
                <a href={{route('statistics', ['id' => $id])}}>Xem thống kê phiên giao dịch</a>
                <button class="dropdown-btn">Quản lý 
                    <i class="fa fa-caret-down"></i>
                  </button>
                  <div class="dropdown-container">
                    <a href="{{route('listUsers')}}">Danh sách người dùng</a>
                    <a href="{{route('listSession')}}">Danh sách phiên giao dịch</a>
                  </div>
            </div>
        </div>   
        @else
        <div class="left-sidebar">
            <div class="link">
                <a href={{route('home')}}>Trang chủ</a>
                <a href={{route('exchanges')}}>Sàn giao dịch</a>
                <a href="#">Tin nhắn</a>
                <a href={{route('exchanges-management')}}>Tạo phiên giao dịch</a>
                <a href={{route('list-auctioned', ['id' => $id])}} style="color:rgb(3, 183, 0);">Xem sản phẩm đấu giá</a>
                <a href={{route('statistics', ['id' => $id])}}>Xem thống kê phiên giao dịch</a>
            </div>
        </div>   
    @endif
    <div class="main-content">
        <div class="post-container">  
            <div class="manager-product">
            <input id="search-list" type="text" placeholder="Tìm kiếm...">   
            <table class="show-list-auction">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Giá đã đấu giá</th>
                        <th>Số lượng</th>
                        <th>Trạng thái</th>
                        <th>Tên người bán</th>
                        <th colspan="2">Đánh giá</th>
                    </tr>
                </thead>
                
                    @foreach ($getAllListAuctioned as $ListAuctioned)
                        <tbody>
                            <tr></tr>
                                <td><a href="{{route('product-info', ['id' => $ListAuctioned['idProduct']])}}">{{$ListAuctioned['product_name']}}</a></td>
                                <td>{{$ListAuctioned['order_price']}}đ</td>
                                <td>{{$ListAuctioned['order_quantity']}}</td>
                                <td>{{$ListAuctioned['order_status']}}</td>
                                <td><a href="{{route('profile2',['id'=>$ListAuctioned['idSeller']])}}">{{$ListAuctioned['seller']}}</a></td>
                                <td>
                                    @if($ListAuctioned['order_status']==="Hoàn Thành")
                                        <button data-idprd = "{{$ListAuctioned['id_session']}}" onclick="eval(event)">
                                            <div><i class="fa-solid fa-pen-nib" style="float: right;"></i></div>
                                        </button>                                       
                                    @endif 
                                </td>
                                <td style="width: 33px;">
                                  {{--   @if (count($getAllListAuctioned1) == 0 )
                                        <i class="fa-solid fa-check"></i>
                                    @else --}}
                                    <?php $i=0; ?>
                                        @foreach ($getAllListAuctioned1 as $value)
                                            @if($value === $ListAuctioned['id_session'])                                             
                                                <?php $i++ ?>
                                            @endif                                           
                                        @endforeach
                                    @if($i == 0)
                                    <div><i class="fa-solid fa-check"></i></div>
                                    @endif
                                   {{--  @endif --}}                                  
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
            </table>
            </div>
        </div>
        </div>
    </div>
</div>
  <div id="id01" class="w3-modal">
    <div class="w3-modal-content" style="width: 400px;">
      <div class="w3-container">
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        
        <form action="" id="form-request" style="text-align: center;">
        @csrf
            <div class="rating-title">Đánh giá</div>
            <div class="container-card">
                <input class="mt-3"  id="print-idprd" name="print-idprd" style="border: none;">
                <div class="flex-btm" style="padding:5px;border-right:solid 2px black;">
                    Tiêu chí đánh giá
                </div>
                <div class="flex-btm" style="padding:5px;">
                    Điểm
                </div>
            </div>
            @foreach ($criteria as $item => $p)
            <div class="container-card">
              <div class="flex-btm" style="padding:5px;border-right:solid 2px black;">
                <p id="abc" data-p="{{$p}}" data-name="{{$item}}" onclick="detail(event)" class="hove-criteria">{{$item}}</p>
              </div>

              <div class="flex-btm" style="padding:5px;">
                <div style="position: relative;z-index: 1;" id="{{$item}}1"></div>
                <input class="mt-3" name="{{$item}}" id="{{$item}}" style="position: absolute;top: 0;left: 0;z-index: 0;visibility: hidden;">
              </div>
            </div>
            @endforeach
            <button class="w3-button w3-amber" style="margin: 5px;">Đánh giá</button>
      </form>
      </div>
    </div>
  </div>
</body>

<div id="modal01" class="w3-modal w3-animate-zoom" onclick="this.style.display='none'">
    <div class="container w3-modal-content" style="width: 400;height: 150px;text-align: center;display:block;padding:0;">
            <div id="print-name" class="rating-title" data-name2></div>
            <div id="print-p" class="rating-title" data-p2></div>
            <div class="rate" style="padding-left: 80px;">
                <input type="radio" id="star5" name="rate" value="5" />
                <label for="star5" title="text">5 stars</label>
                <input type="radio" id="star4" name="rate" value="4" />
                <label for="star4" title="text">4 stars</label>
                <input type="radio" id="star3" name="rate" value="3" />
                <label for="star3" title="text">3 stars</label>
                <input type="radio" id="star2" name="rate" value="2" />
                <label for="star2" title="text">2 stars</label>
                <input type="radio" id="star1" name="rate" value="1" />
                <label for="star1" title="text">1 star</label>
            </div>
    </div>
</div>

<script>
function eval(event) {
    document.getElementById('id01').style.display='block'
    const idprd = event.currentTarget.getAttribute("data-idprd");
       console.log(idprd)
    document.getElementById('print-idprd').value = idprd;
}
function detail(event) {
    const name = event.currentTarget.getAttribute("data-name");
    const p = event.currentTarget.getAttribute("data-p");
    
    document.getElementById('modal01').style.display='block'
    document.getElementById('print-name').innerHTML = name;
    document.getElementById('print-p').innerHTML = p;
    $('#print-name').data('name2', name);
    $('#print-p').data('p2', p);
}
$('input[name=rate]').click(function() {
   var name = $('#print-name').data('name2');
   var p = $('#print-p').data('p2');
   console.log(name)
  var rating = $('input[name=rate]:checked').val();
    const rate = rating*p/100;
  document.getElementById(name).value = rate;
  document.getElementById(name+'1').innerHTML = rating;
});
</script>

<script>
    var rows = document.querySelectorAll(".show-list-auction tbody tr");
    var pages = Math.ceil(rows.length / 5);
    var pagination = document.createElement("div");
    for (var i = 1; i <= pages; i++) {
        var link = document.createElement("a");
        link.href = "#";
        link.innerHTML = i;
        link.onclick = function() {
            // Lấy số trang hiện tại
            var page = parseInt(this.innerHTML);
            // Tính vị trí bắt đầu và kết thúc của các dòng trong trang này
            var start = (page - 1) * 5;
            var end = start + 5;
            // Ẩn tất cả các dòng trong bảng
            for (var j = 0; j < rows.length; j++) {
                rows[j].style.display = "none";
            }
            // Hiển thị các dòng trong trang này
            for (var j = start; j < end && j < rows.length; j++) {
                rows[j].style.display = "";
            }
            // Đặt lại trạng thái của nút phân trang
            var links = pagination.querySelectorAll("a");
            for (var j = 0; j < links.length; j++) {
                links[j].classList.remove("active");
            }
            this.classList.add("active");
            return false;
        };
        pagination.appendChild(link);
    }
    // Thêm danh sách nút phân trang vào trang HTML
    var container = document.querySelector(".post-container");
    container.appendChild(pagination);
    // Mặc định hiển thị trang đầu tiên
    const checkNull = pagination.querySelector("a");
    if (checkNull) {
    pagination.querySelector("a").click();}

    const searchInput = document.getElementById('search-list');
    const tableRows = document.querySelectorAll('.show-list-auction tbody tr');

    searchInput.addEventListener('input', function() {
        const searchTerm = searchInput.value.toLowerCase();

        tableRows.forEach(function(row) {
            const productName = row.querySelector('td:first-child').textContent.toLowerCase();
            const sellerName = row.querySelector('td:last-child').textContent.toLowerCase();

            if (productName.includes(searchTerm) || sellerName.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
    $('#form-request').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        console.log(formData)
        $.ajax({
            type: 'POST',
            url: "{{ route('eval') }}",
            data: formData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response)
                location.reload()
            },
            error: function(xhr) {
                // xử lý lỗi
            }
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
}
</script>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</html>