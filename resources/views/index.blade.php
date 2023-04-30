<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Social network</title>
<link rel="icon" type="image/gif" href="icon.gif"  >
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css"
  rel="stylesheet"
/>
<link rel="stylesheet" href="/rating.css">
<link rel="stylesheet" href="/rating.js">
<script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>

.scrollspy {
    height: 800px;
    overflow: auto;
    }
#draggable {
  position: absolute;
  top: 50px;
  left: 50px;
  z-index: 1000;
}

</style>
</head>
<body id="container">
    <header>
        <!-- Navbar -->



        <nav class="navbar navbar-expand-lg navbar-light bg-white">
          <div class="container-fluid">
            <button
              class="navbar-toggler"
              type="button"
              data-mdb-toggle="collapse"
              data-mdb-target="#navbarExample01"
              aria-controls="navbarExample01"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarExample01">
                <h3 style="font-family: "Times New Roman", Times, serif;">Social Network Agriculture</h3>
                <div class="input-group" style="margin:auto;width:40%;">
                    <div class="form-outline">
                    <input type="search" id="search" name="search" class="form-control" autocomplete="search">
                    <table id="table" align="center" class="table" style="position: absolute;background:#FBFBFB;z-index:1000;">

                    </table>
                    <label class="form-label" for="form1">Search</label>

                    </div>
                    <button type="button" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                    </button>
                </div>

                <a class="nav-link" href={{route('logout')}} style="position:absolute;right:0px;padding:10px;">Logout</a>
            </div>
          </div>
        </nav>
        <div>
            <a id="draggable" class="bg-image ripple" data-mdb-ripple-color="light">
                <lord-icon src="https://cdn.lordicon.com/jfhbogmw.json"  colors="primary:#109121" trigger="hover" style="width:80px;height:80px;padding:5px;"></lord-icon>
            </a>
            <section style="background-color: #eee;">
                <div class="container-fluid py-5" style="width:100%;">
                    <div class=" row">
                        <div class="col">
                            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-2 mb-4">
                                <ul class="nav nav-tabs nav-justified mb-3" id="ex1" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a  class="nav-link active" id="ex3-tab-1" data-mdb-toggle="tab" href=" #ex3-tabs-1" role="tab" aria-controls="ex3-tabs-1" aria-selected="true">
                                            Profile
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="ex3-tab-2" data-mdb-toggle="tab" href="#ex3-tabs-2" role="tab" aria-controls="ex3-tabs-2" aria-selected="false">
                                            Session
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    @yield('content')
                </div>
            </section>
        </div>
        <footer class="text-center text-white" style="background-color: #caced1;">
            <!-- Grid container -->
            <!-- Grid container -->

            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);" >
              © 2020 Copyright:
              <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
            </div>
            <!-- Copyright -->
          </footer>
    </header>
</body>
<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"
></script>
<script>
    $(function() {
  $('#draggable').draggable({
    containment: "#container",
    scroll: true,
    scrollSensitivity: 50,
    scrollSpeed: 10
  });
});
//search

    console.log(data);
    let element = `
		`
		data.map(value=>{
			element += `<tr id="myElement" style="display:none;">
				<td style="width:40%;">${value.product.title}</td>
				<td><span onclick="detail('${value.hinhanh}','${value.idsp}')"><img src="${value.product.img}" style="max-width:100%;height:100%;"/></span></td>
				</tr>
			`

		})
    document.getElementById("table").innerHTML = element
</script>
<script>
  $(document).ready(function(){
    $('#search').on('keyup', function() {
      var value1 = $(this).val().toLowerCase();
      var value2 = $(this).val().toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '');
      $('tr').filter(function() {
        let List = $(this).text().normalize('NFD').replace(/[\u0300-\u036f]/g, '');
        $(this).toggle(List.toLowerCase().indexOf(value2) > -1)
/*         $(this).toggle($(this).text().toLowerCase().indexOf(value1) > -1) */
      });
      if($(this).val()=="")
        $('tr').hide();
    });
  });
</script>
</html>
