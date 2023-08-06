@extends('app')

@section('title', 'Masukan')

@section('link')
<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')

<!-- End of Topbar -->
<div class="container-fluid">
   <!-- Page Heading -->
   <h1 class="h3 mb-2 text-gray-800">Buat Akun</h1>

   <!-- DataTales Example -->
   <div class="card shadow mb-4">
      <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary title-user-role">New Accont</h6>
      </div>
      <div class="card-body">
         <form method="post" action="{{route('actioncreateakun')}}">
            @csrf
            <div class="form-group">
               <label for="inputEmail4">Email</label>
               <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Email" required>
            </div>
            <div class="form-group">
               <label for="inputusername">Username</label>
               <input type="text" name="username" class="form-control" id="inputusername" placeholder="Username" required>
            </div>
            <div class="form-row">
               <div class="form-group col-md-6">
                  <label for="inputPassword4">Password</label>
                  <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="Password" required>
               </div>
               <div class="form-group col-md-6">
                  <label for="inputPassword41">konfirmai Password</label>
                  <input type="password" name="c-password" class="form-control" id="inputPassword41" placeholder="Konfirmasi Password" required>
               </div>
            </div>
            <div class="form-group">
               <label for="inputState1">Role</label>
               <select id="inputState1" class="form-control" name="role">
                  <option value="petani">Petani</option>
                  <option selected value="ahli">Ahli</option>
               </select>
            </div>
            <div class="form-group">
               <label for="inputtelp">No Telp</label>
               <input type="number" name="telp" class="form-control" id="inputtelp" placeholder="08.....">
            </div>
            <div class="form-group">
               <label for="inputnik">NIK</label>
               <input type="text" name="nik" class="form-control" id="inputnik" placeholder="13..........">
            </div>
            <div class="form-row">
               <div class="form-group col-md-8">
                  <label for="inputjeniskelamin">Jenis kelamin</label>
                  <select id="inputjeniskelamin" name="jeniskelamin" class="form-control">
                     <option selected value="laki-laki">Laki-laki</option>
                     <option value="perempuan">perempuan</option>
                  </select>
               </div>
               <div class="form-group col-md-4">
                  <label for="inputtanggal">Tanggal Lahir</label>
                  <input type="date" name="tanggallahir" class="form-control" id="inputtanggal" placeholder="date">
               </div>
            </div>
            <div class="form-group user-role-ahli">
               <label for="inputnip">NIP</label>
               <input type="number" name="tanggallahir" class="form-control" id="inputnip" placeholder="13......">
            </div>
            <div class="form-row">
               <div class="form-group col-md-6 user-role-ahli">
                  <label for="inputkeahlian1">Keahlian 1</label>
                  <select id="inputkeahlian1" name="keahlian1" class="form-control">
                     <option selected value="pertanian">Bidang Pertanian</option>
                     <option value="perternakan">Bidang Perternakan</option>
                     <option value="teknologi">Teknologi Pertanian dan Perternakan</option>
                     <option value="pasar">Pemasaran Pertanian dan Perternakan</option>
                     <option value="lingkungan">konservasi dan lingkungan</option>
                  </select>
               </div>
               <div class="form-group col-md-6 user-role-ahli">
                  <label for="inputkeahlian2">Keahlian 2</label>
                  <select id="inputkeahlian2" name="keahlian2" class="form-control">
                     <option value="pertanian">Bidang Pertanian</option>
                     <option selected value="perternakan">Bidang Perternakan</option>
                     <option value="teknologi">Teknologi Pertanian dan Perternakan</option>
                     <option value="pasar">Pemasaran Pertanian dan Perternakan</option>
                     <option value="lingkungan">konservasi dan lingkungan</option>
                  </select>
               </div>
            </div>
            <div class="form-group user-role-ahli">
               <label for="inputkantor">Kantor</label>
               <input type="text" name="kantor" class="form-control" id="inputkantor" placeholder="PT.HaiPetani">
            </div>
            <button type="submit" class="float-right btn btn-primary">Daftarkan Akun</button>
         </form>
      </div>
   </div>
</div>

@endsection

@section('script')

<!-- Page level custom scripts -->
<script src="js/demo/form-account.js"></script>
@endsection