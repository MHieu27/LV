@extends('header')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
    .post-container a.active {
        color:rgb(3, 183, 0);
        margin: 0 10px;
    }
    .input-group[type=number], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        }
        .input-group[type=text], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        }

        .input-group[type=submit] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        }

        .input-group[type=submit]:hover {
        background-color: #45a049;
        }

</style>
<div class="container">
    @if ($user->email == 'minhhieu@gmail.com' || $user->email == 'xuandanh@gmail.com')
        <div class="left-sidebar">
            <div class="link">
                <a href={{route('home')}}>Trang chủ</a>
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
                    <a href="{{route('listUsers')}}" style="color:rgb(3, 183, 0);">Danh sách người dùng</a>
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
                <a href={{route('list-auctioned', ['id' => $id])}}>Xem sản phẩm đấu giá</a>
                <a href={{route('statistics', ['id' => $id])}}>Xem thống kê phiên giao dịch</a>
            </div>
        </div>   
        @endif
    <div class="main-content">
        <div class="post-container">  
            <div class="manager-product">
            <input id="search-list" type="text" placeholder="Tìm kiếm..."> 
            <a style="border-radius:5px;padding: 5px 10px;" class="w3-button w3-red" href={{route('delete-criteria')}}>Xóa</a> 
            <button class="w3-button w3-green" onclick="eval(event)">Tạo</button>   
            <table class="show-list-auction">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên tiêu chí</th>
                        <th>Tỷ lệ ưu tiên</th>
                    </tr>
                </thead>
            @foreach ($array_criteria as $item => $value)
                <tbody>
                    <tr>
                        <td>#</td>
                        <td>{{$value['title']}}</td>
                        <td>{{$value['percent']}}</td>
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
        <div class="w3-container" >
            <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
            <div class="rating-title" style="text-align:center;">Tạo tiêu chí đánh giá</div>
            <form action="{{route('create-criteria')}}" method="POST">
            @csrf
                <div id="inputs-container">
                    <div class="input-group">
                    </div>
                    <div class="input-group">
                        <div id="input-container">
                        </div>
                    </div>
                </div>

                <a id="add-button" class="w3-button w3-green" style="margin: 8 170 8 160;"><i class="fa-solid fa-plus"></i></a>
                            
                <input class="input-group" type="submit" value="Submit">
            </form>
        </div>
    </div>
</div>
</body>
<script>
  let inputCount = 0;
// Lấy thẻ a với id là "add-button"
const addButton = document.querySelector('#add-button');

// Lấy div chứa các phần tử cần thêm mới
const inputContainer = document.querySelector('#inputs-container');

// Đăng ký sự kiện "click" cho thẻ a
addButton.addEventListener('click', () => {
    inputCount++;
  // Tạo một div mới để chứa nhóm input
  const inputGroup = document.createElement('div');
  inputGroup.classList.add('input-group');
    // Tạo một div mới để chứa nhóm input
const inputGroup1 = document.createElement('div');
inputGroup1.classList.add('input-group');
  
// Tạo một nhãn mới cho input
const label1 = document.createElement('label1');
label1.textContent = 'Tên tiêu chí';
label1.setAttribute('for', 'firstname');

// Tạo một input mới với các thuộc tính tương tự như input đã có
const input1 = document.createElement('input');
input1.type = 'text';
input1.classList.add('input-group');
input1.name = 'ten'+inputCount;

// Thêm nhãn và input vào div chứa nhóm input
inputGroup1.appendChild(label1);
inputGroup1.appendChild(input1);
  
// Thêm div chứa nhóm input vào div chứa tất cả các input
inputContainer.appendChild(inputGroup1);
  // Tạo một nhãn mới cho input
  const label = document.createElement('label');
  label.textContent = 'Tỉ lệ ưu tiên';
  // Tạo một input mới với các thuộc tính tương tự như input đã có
  const input = document.createElement('input');
  input.type = 'number';
  input.name = 'tyle'+inputCount;
  input.classList.add('input-number', 'input-group');
  input.min = 0;
  input.max = 100;
  input.step = 1;
  
  // Thêm nhãn và input vào div chứa nhóm input
  inputGroup.appendChild(label);
  inputGroup.appendChild(input);
  
  // Thêm div chứa nhóm input vào div chứa tất cả các input
  inputContainer.appendChild(inputGroup);
  //

  // Lấy tất cả các thẻ input có class là 'input-number'
  const inputNumbers = document.querySelectorAll('.input-number');

  // Đăng ký sự kiện input cho tất cả các thẻ input
  inputNumbers.forEach(input => {
    input.addEventListener('input', () => {
      let total = 0;
    
      // Tính tổng giá trị của tất cả các thẻ input
      inputNumbers.forEach(input => {
        const value = parseInt(input.value) || 0;
      
        if (value > 100) {
          // Hiển thị thông báo khi giá trị nhập âm
          alert('Giá trị nhập không đúng');
          input.value = '';
        } else {
          total += value;
        }
      });
    
      // Nếu tổng giá trị vượt quá 100 thì cập nhật lại giá trị các thẻ input
      if (total > 100) {
        inputNumbers.forEach(input => {
          input.value = Math.floor((parseInt(input.value) / total) * 100);
        });
      // Nếu tổng giá trị bằng 100 thì bỏ qua
      } else if (total === 100) {
        addButton.style.display = 'none';
      // Nếu tổng giá trị nhỏ hơn 100 thì đặt lại giá trị của thẻ input cuối cùng
      } 
    });
  });
});

</script>
<script>
function eval(event) {
    document.getElementById('id01').style.display='block'
}
    // Lấy tất cả các dòng trong bảng
    var rows = document.querySelectorAll(".show-list-auction tbody tr");
    // Tính tổng số trang
    var pages = Math.ceil(rows.length / 5);
    // Tạo một danh sách các nút phân trang
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