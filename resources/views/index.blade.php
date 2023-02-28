<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
<script src="https://code.jquery.com/jquery-3.6.3.js"></script>

<style>

.scrollspy {
    height: 800px;
    overflow: auto;
    }

</style>
</head>
<body>
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
                    <input type="search" id="form1" class="form-control" />
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
            <div style="position:fixed; right:20px;z-index:1;top:65px;">
                <button type="button" class="rounded-circle btn btn-success p-1 text-center"><i class="fas fa-plus-circle" style="font-size: 60px;padding:0%"></i></button>
            </div>
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
                    <div class="tab-content" id="ex2-content">
                        <div  class="tab-pane fade show active" id="ex3-tabs-1" role="tabpanel" aria-labelledby="ex3-tab-1">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card mb-4">
                                        <div class="card-body text-center">
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                                                class="rounded-circle img-fluid" style="width: 150px;">
                                            <h5 class="my-3">{{ $user['username'] }}</h5>
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
                                                    <i class="fas fa-globe fa-lg text-warning"></i>
                                                    <p class="mb-0">https://mdbootstrap.com</p>
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
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                <p class="mb-0">Full Name</p>
                                                </div>
                                                <div class="col-sm-9">
                                                <p class="text-muted mb-0">Johnatan Smith</p>
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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card mb-4 mb-md-0">
                                                <div class="card-body">
                                                    <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                                                    </p>
                                                    <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                                    <div class="progress rounded" style="height: 5px;">
                                                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                                    <div class="progress rounded" style="height: 5px;">
                                                        <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                                    <div class="progress rounded" style="height: 5px;">
                                                        <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                                    <div class="progress rounded" style="height: 5px;">
                                                        <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                                    <div class="progress rounded mb-2" style="height: 5px;">
                                                        <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card mb-4 mb-md-0">
                                                <div class="card-body">
                                                    <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                                                    </p>
                                                    <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                                    <div class="progress rounded" style="height: 5px;">
                                                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                                    <div class="progress rounded" style="height: 5px;">
                                                        <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                                    <div class="progress rounded" style="height: 5px;">
                                                        <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                                    <div class="progress rounded" style="height: 5px;">
                                                        <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                                    <div class="progress rounded mb-2" style="height: 5px;">
                                                        <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                                                        aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ex3-tabs-2" role="tabpanel" aria-labelledby="ex3-tab-2">
                            <div  class="tab-pane fade show active" id="ex3-tabs-1" role="tabpanel" aria-labelledby="ex3-tab-1">

                                <div class="row">
                                    <div class="col-lg-2 vertical carousel slide" data-ride="carousel">
                                        <div class="card mb-4">
                                            <div class="card-body text-center">
                                                <div class="d-flex justify-content-center mb-4">
                                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(1).webp"
                                                    class="rounded-circle shadow-1-strong" width="100" height="100" />
                                                </div>
                                                <h5 class="mb-3">Maria Smantha</h5>
                                                <h6 class="text-primary mb-3">Web Developer</h6>
                                                <ul class="list-unstyled d-flex justify-content-center mb-0">
                                                    <li>
                                                    <i class="fas fa-star fa-sm text-warning"></i>
                                                    </li>
                                                    <li>
                                                    <i class="fas fa-star fa-sm text-warning"></i>
                                                    </li>
                                                    <li>
                                                    <i class="fas fa-star fa-sm text-warning"></i>
                                                    </li>
                                                    <li>
                                                    <i class="fas fa-star fa-sm text-warning"></i>
                                                    </li>
                                                    <li>
                                                    <i class="fas fa-star-half-alt fa-sm text-warning"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card mb-4">
                                            <div class="card-body text-center">
                                                <div class="d-flex justify-content-center mb-4">
                                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(1).webp"
                                                    class="rounded-circle shadow-1-strong" width="100" height="100" />
                                                </div>
                                                <h5 class="mb-3">Maria Smantha</h5>
                                                <h6 class="text-primary mb-3">Web Developer</h6>
                                                <ul class="list-unstyled d-flex justify-content-center mb-0">
                                                    <li>
                                                    <i class="fas fa-star fa-sm text-warning"></i>
                                                    </li>
                                                    <li>
                                                    <i class="fas fa-star fa-sm text-warning"></i>
                                                    </li>
                                                    <li>
                                                    <i class="fas fa-star fa-sm text-warning"></i>
                                                    </li>
                                                    <li>
                                                    <i class="fas fa-star fa-sm text-warning"></i>
                                                    </li>
                                                    <li>
                                                    <i class="fas fa-star-half-alt fa-sm text-warning"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card mb-4">
                                            <div class="card-body text-center">
                                                <div class="d-flex justify-content-center mb-4">
                                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(1).webp"
                                                    class="rounded-circle shadow-1-strong" width="100" height="100" />
                                                </div>
                                                <h5 class="mb-3">Maria Smantha</h5>
                                                <h6 class="text-primary mb-3">Web Developer</h6>
                                                <ul class="list-unstyled d-flex justify-content-center mb-0">
                                                    <li>
                                                    <i class="fas fa-star fa-sm text-warning"></i>
                                                    </li>
                                                    <li>
                                                    <i class="fas fa-star fa-sm text-warning"></i>
                                                    </li>
                                                    <li>
                                                    <i class="fas fa-star fa-sm text-warning"></i>
                                                    </li>
                                                    <li>
                                                    <i class="fas fa-star fa-sm text-warning"></i>
                                                    </li>
                                                    <li>
                                                    <i class="fas fa-star-half-alt fa-sm text-warning"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 scrollspy">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card mb-4 mb-md-0">
                                                    <div class="card-body">
                                                        <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                                                        </p>
                                                        <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                                        <div class="progress rounded mb-2" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card mb-4 mb-md-0">
                                                    <div class="card-body">
                                                        <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                                                        </p>
                                                        <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                                        <div class="progress rounded mb-2" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                                                            aria-valuemin="0" aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card mb-4 mb-md-0">
                                                    <div class="card-body">
                                                        <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                                                        </p>
                                                        <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                                        <div class="progress rounded mb-2" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card mb-4 mb-md-0">
                                                    <div class="card-body">
                                                        <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                                                        </p>
                                                        <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                                        <div class="progress rounded mb-2" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                                                            aria-valuemin="0" aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card mb-4 mb-md-0">
                                                    <div class="card-body">
                                                        <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                                                        </p>
                                                        <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                                        <div class="progress rounded mb-2" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card mb-4 mb-md-0">
                                                    <div class="card-body">
                                                        <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                                                        </p>
                                                        <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                                        <div class="progress rounded" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                                        <div class="progress rounded mb-2" style="height: 5px;">
                                                            <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                                                            aria-valuemin="0" aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
</html>
