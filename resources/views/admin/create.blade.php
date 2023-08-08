@extends('app')

@section('title', 'Masukan')

@section('link')
<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')

<!-- End of Topbar -->
<div class="container-fluid">
   <form method="post" action="{{route('actioncreateadmin')}}">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-2 text-gray-800">Buat Akun Admin</h1>
         <button type="submit" class=" btn btn-primary">Daftarkan Akun</button>
      </div>
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Accont</h6>
         </div>
         <div class="card-body">
            @csrf
            <div class="form-group">
               <label for="inputEmail4">Email</label>
               <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Email" required value="tasim@gmail.com">
            </div>
            <div class="form-group">
               <label for="inputusername">Username</label>
               <input type="text" name="username" class="form-control" id="inputusername" placeholder="Username" required value="tasim">
            </div>
            <div class="form-row">
               <div class="form-group col-md-6">
                  <label for="inputPassword4">Password</label>
                  <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="Password" required value="123">
               </div>
               <div class="form-group col-md-6">
                  <label for="inputPassword41">konfirmai Password</label>
                  <input type="password" name="c-password" class="form-control" id="inputPassword41" placeholder="Konfirmasi Password" required value="123">
               </div>
            </div>
            <div class="form-group">
               <label for="inputState1">Role</label>
               <input type="text" name="role" class="form-control" id="inputState1" required value="admin" readonly>
            </div>
         </div>
      </div>
   </form>
</div>

@endsection

@section('script')

<!-- Page level custom scripts -->
<script src="js/demo/form-account.js"></script>
@endsection