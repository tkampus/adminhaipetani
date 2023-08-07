<!DOCTYPE html>
<html lang="en">

<head>

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="">

   <title>@yield('title', 'My App')</title>
   <link rel="icon" href="img/vector.svg" type="image/png">

   @yield('link')
   <!-- Custom fonts for this template-->
   <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
   <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

   <!-- Custom styles for this template-->
   <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

   <!-- Page Wrapper -->
   <div id="wrapper">

      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

         <!-- Sidebar - Brand -->
         <li class="sidebar-brand d-flex align-items-center justify-content-center">
            <div class="sidebar-brand-icon rotate-n-15">
               <img src="img/vector.svg" alt="">
            </div>
            <div class="sidebar-brand-text mx-3">Admin <sup>Hai Petani</sup></div>
         </li>

         <!-- Divider -->
         <hr class="sidebar-divider my-0">

         <!-- Nav Item - Dashboard -->
         <li class="nav-item active">
            <a class="nav-link" href="{{Route('dasboard')}}">
               <i class="fas fa-fw fa-tachometer-alt"></i>
               <span>Dashboard</span></a>
         </li>

         <!-- Divider -->
         <hr class="sidebar-divider">

         <!-- Heading -->
         <div class="sidebar-heading">
            Interface
         </div>

         <!-- Nav Item -->
         <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
               <i class="fas fa-user"></i>
               <span>Account</span>
            </a>
            <div id="collapse1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
               <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Custom Account:</h6>
                  <a class="collapse-item" href="{{route('readakun')}}">Table Account</a>
                  <a class="collapse-item" href="{{route('readahli')}}">Table Ahli</a>
                  <a class="collapse-item" href="{{route('readpetani')}}">Table Petani</a>
                  <a class="collapse-item" href="{{route('createakun')}}">New Account</a>
               </div>
            </div>
         </li>

         <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
               <i class="fas fa-user-shield"></i>
               <span>Admin</span>
            </a>
            <div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
               <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Custom Admin:</h6>
                  <a class="collapse-item" href="">Table Admin</a>
                  <a class="collapse-item" href="cards.html">New Admin</a>
               </div>
            </div>
         </li>

         <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
               <i class="fas fa-question-circle"></i>
               <span>FAQ</span>
            </a>
            <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
               <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Custom FAQ:</h6>
                  <a class="collapse-item" href="buttons.html">Table FAQ</a>
                  <a class="collapse-item" href="cards.html">New FAQ</a>
               </div>
            </div>
         </li>

         <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
               <i class="fas fa-calendar-day"></i>
               <span>Event</span>
            </a>
            <div id="collapse4" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
               <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Custom Event:</h6>
                  <a class="collapse-item" href="buttons.html">Table Event</a>
                  <a class="collapse-item" href="cards.html">New Event</a>
               </div>
            </div>
         </li>

         <!-- Divider -->
         <hr class="sidebar-divider">
         <!-- Nav Item -->

         <li class="nav-item">
            <a class="nav-link" href="{{route('readmasukan')}}">
               <i class="fa fa-envelope-open-text"></i>
               <span>Masukan</span></a>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="{{route('readactivity')}}">
               <i class="fas fa-list"></i>
               <span>Users Activity</span></a>
         </li>
      </ul>
      <!-- End of Sidebar -->
      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
         <!-- Main Content -->
         <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

               <!-- Sidebar Toggle (Topbar) -->
               <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                  <i class="fa fa-bars"></i>
               </button>

               <!-- Topbar Navbar -->
               <ul class="navbar-nav ml-auto">

                  <div class="topbar-divider d-none d-sm-block"></div>

                  <!-- Nav Item - User Information -->
                  <li class="nav-item dropdown no-arrow">
                     <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 text-gray-600 small">{{$user['role']}} - {{$user['username']}}</span>
                        <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                     </a>
                     <!-- Dropdown - User Information -->
                     <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                           <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                           Profile
                        </a>
                        <a class="dropdown-item" href="#">
                           <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                           Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('login') }}" data-toggle="modal" data-target="#logoutModal">
                           <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                           Logout
                        </a>
                     </div>
                  </li>
               </ul>
            </nav>

            <!-- End of Topbar -->


            <!-- alert  -->
            <div style="position: absolute; z-index:999; right: 0rem; top:5rem;">
               <div class="container-fluid notif-1">
                  @if(session('error'))
                  @foreach(session('error') as $key => $message)
                  <!-- cek apakah $message dalam bentuk array ap string -->
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                     @if(is_array($message))
                     <strong>{{$key}} : </strong> {{$message[0]}}
                     @else
                     <strong>{{$key}} : </strong> {{$message}}
                     @endif
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  @endforeach
                  @endif

                  @if(session('success'))
                  @foreach(session('success') as $key => $message)
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                     <strong>{{$key}} : </strong> {{$message}}
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  @endforeach
                  @endif
               </div>
            </div>
            <!-- end alert -->
            @yield('content')
         </div>
         <!-- End of Main Content -->

         <!-- Footer -->
         <footer class="sticky-footer bg-white">
            <div class="container my-auto">
               <div class="copyright text-center my-auto">
                  <span>Copyright &copy; Hai Petani 2023</span>
               </div>
            </div>
         </footer>
         <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

   </div>
   <!-- End of Page Wrapper -->

   <!-- Scroll to Top Button-->
   <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
   </a>

   <!-- Logout Modal-->
   <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
               <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
               </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
               <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
               <a class="btn btn-primary" href="{{Route('logout')}}">Logout</a>
            </div>
         </div>
      </div>
   </div>

   <!-- script -->
   <!-- Bootstrap core JavaScript-->
   <script src="vendor/jquery/jquery.min.js"></script>
   <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

   <!-- Core plugin JavaScript-->
   <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

   <!-- Custom scripts for all pages-->
   <script src="js/sb-admin-2.min.js"></script>
   @yield('script')

</body>

</html>