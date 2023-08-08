@extends('app')

@section('title', 'Masukan')

@section('link')
<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')

<!-- End of Topbar -->
<div class="container-fluid">
   <form method="post" action="{{route('actioncreatefaq')}}">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-2 text-gray-800">Buat FAQ</h1>
         <button type="submit" class=" btn btn-primary">Daftarkan FAQ</button>
      </div>
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">FAQ : </h6>
         </div>
         <div class="card-body">
            @csrf
            <div class="form-group">
               <label for="inputjudul">Judul</label>
               <input type="text" name="judul" class="form-control" id="inputjudul" placeholder="Judul : " required value="pertanyaan 12">
            </div>
            <div class="form-group">
               <label for="inputkategori">Kategori</label>
               <select id="inputkategori" name="kategori" class="form-control">
                  <option value="pertanian">Bidang Pertanian</option>
                  <option value="perternakan">Bidang Perternakan</option>
                  <option value="teknologi">Teknologi Pertanian dan Perternakan</option>
                  <option value="pasar">Pemasaran Pertanian dan Perternakan</option>
                  <option value="lingkungan">konservasi dan lingkungan</option>
               </select>
            </div>
            <div class="form-group">
               <label for="inputciri2">Ciri - ciri</label>
               <input type="text" name="ciri2" class="form-control" id="inputciri2" placeholder="Ciri-ciri : " required value="ciri - ciri 12">
            </div>
            <div class="form-group">
               <label for="inputsolusi">Solusi</label>
               <input type="text" name="solusi" class="form-control" id="inputsolusi" placeholder="Solusi : " required value="solusi 12">
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