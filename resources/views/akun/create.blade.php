@extends('app')

@section('title', 'Tambah Account')

@section('link')
<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')

<!-- End of Topbar -->
<div class="container-fluid">
   <form method="post" action="{{route('actioncreateakun')}}">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-2 text-gray-800">Buat Akun</h1>
         <button type="submit" class=" btn btn-primary">Daftarkan Akun</button>
      </div>
      <!-- DataTales Example -->
      <div class="row">
         <div class="col-lg-6">
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
                     <select id="inputState1" class="form-control" name="role">
                        <option value="petani">Petani</option>
                        <option selected value="ahli">Ahli</option>
                     </select>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="card shadow mb-4">
               <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary title-user-role">Detail Accont</h6>
               </div>
               <div class="card-body">
                  <div class="form-group">
                     <label for="inputtelp">No Telp</label>
                     <input type="number" name="telp" class="form-control" id="inputtelp">
                  </div>
                  <div class="form-group">
                     <label for="inputnik">NIK</label>
                     <input type="number" name="nik" class="form-control" id="inputnik">
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
                        <input type="date" name="tanggallahir" class="form-control" id="inputtanggal">
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="inputalamat">Alamat</label>
                     <input type="text" name="alamat" class="form-control" id="inputalamat">
                  </div>
                  <div class="form-group user-role-ahli">
                     <label for="inputnip">NIP</label>
                     <input type="number" name="nip" class="form-control" id="inputnip">
                  </div>
                  <div class="form-row">
                     <div class="form-group col-md-6 user-role-ahli">
                        <label for="inputkeahlian1">Keahlian 1</label>
                        <select id="inputkeahlian1" name="keahlian1" class="form-control">
                           <option value="">Bidang Keahlian 1</option>
                           <option value="pertanian">Bidang Pertanian</option>
                           <option value="perternakan">Bidang Perternakan</option>
                           <option value="teknologi">Teknologi Pertanian dan Perternakan</option>
                           <option value="pasar">Pemasaran Pertanian dan Perternakan</option>
                           <option value="lingkungan">konservasi dan lingkungan</option>
                        </select>
                     </div>
                     <div class="form-group col-md-6 user-role-ahli">
                        <label for="inputkeahlian2">Keahlian 2</label>
                        <select id="inputkeahlian2" name="keahlian2" class="form-control">
                           <option value="">Bidang Keahlian 2</option>
                           <option value="pertanian">Bidang Pertanian</option>
                           <option value="perternakan">Bidang Perternakan</option>
                           <option value="teknologi">Teknologi Pertanian dan Perternakan</option>
                           <option value="pasar">Pemasaran Pertanian dan Perternakan</option>
                           <option value="lingkungan">konservasi dan lingkungan</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group user-role-ahli">
                     <label for="inputkantor">Kantor</label>
                     <input type="text" name="kantor" class="form-control" id="inputkantor">
                  </div>
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
@endsection