@extends('app')

@section('title', 'Masukan')

@section('link')
<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')

<!-- End of Topbar -->
<div class="container-fluid">
   <form method="post" action="{{route('updateadmin')}}">
      @csrf
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between">
         <h2 class="h5 mb-2 text-gray-800">
            <a href="{{$back['url']}}" class="text-decoration-none">
               <i class="fa fa-chevron-left"></i> Kembali ke {{$back['title']}}</a>
         </h2>
         <button type="submit" class="mb-2 btn btn-primary">Update Akun</button>
      </div>
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Accont</h6>
         </div>
         <div class="card-body">
            <div class="form-group">
               <label for="inputEmail4">Email</label>
               <input type="email" name="nohp" class="form-control" id="inputEmail4" placeholder="Email" required value="{{$data['email']}}" readonly>
            </div>
            <div class="form-group">
               <label for="inputusername">Username</label>
               <input type="text" name="username" class="form-control" id="inputusername" placeholder="Username" required value="{{$data['username']}}">
            </div>
            <div class="form-group">
               <label for="inputState1">Role</label>
               <input type="text" name="role" class="form-control" id="inputState1" placeholder="Role" required value="{{$data['role']}}" readonly>
               </select>
            </div>
         </div>
      </div>
   </form>
   <form method="post" action="{{route('gantipasswordakun')}}">
      <div class="accordion" id="accordionExample">
         <div class="card shadow mb-4">
            @csrf
            <div class="card-header py-3" id="headingOne">
               <h6 class="m-0 font-weight-bold text-primary">
                  <a class="text-justify btn-collapse" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="text-decoration: none;">
                     Ganti Password
                     <i class="fa fa-chevron-down"></i>
                  </a>
               </h6>
            </div>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
               <div class="card-body">
                  <input type="hidden" name="email" class="form-control" id="inputPassword40" placeholder="Password" required value="{{$data['email']}}">
                  <div class="form-group">
                     <label for="inputPassword4">Password Sebelumnya</label>
                     <input type="password" name="l-password" class="form-control" id="inputPassword4" placeholder="Password" required value="123">
                  </div>
                  <div class="form-group">
                     <label for="inputPassword41">Password Baru</label>
                     <input type="password" name="password" class="form-control" id="inputPassword41" placeholder="Konfirmasi Password" required value="123">
                  </div>
                  <div class="form-group">
                     <label for="inputPassword42">Konfirmasi Password Baru</label>
                     <input type="password" name="c-password" class="form-control" id="inputPassword42" placeholder="Konfirmasi Password" required value="123">
                  </div>
                  <button type="submit" class="float-right mb-3 btn btn-primary">Reset Password Akun</button>
               </div>
            </div>
         </div>
      </div>
   </form>
</div>


@endsection

@section('script')

<!-- Page level custom scripts -->
<script src="js/demo/form-account.js"></script>
<!-- script -->
@endsection