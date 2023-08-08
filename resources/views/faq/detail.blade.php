@extends('app')

@section('title', 'Detail FAQ')

@section('link')
<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')

<!-- End of Topbar -->
<div class="container-fluid">
   <form method="post" action="{{route('updatefaq')}}">
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
         <input type="hidden" name="id" value="{{$data->id}}">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Accont</h6>
         </div>
         <div class="card-body">
            <div class="form-group">
               <label for="inputjudul">Judul</label>
               <input type="text" name="judul" class="form-control" id="inputjudul" placeholder="Judul : " required value="{{$data->judul}}">
            </div>
            <div class="form-group">
               <label for="inputkategori">Kategori</label>
               <select id="inputkategori" name="kategori" class="form-control">
                  <option @if($data['kategori']=='pertanian' ) selected @endif value="pertanian">Bidang Pertanian</option>
                  <option @if($data['kategori']=='perternakan' ) selected @endif value="perternakan">Bidang Perternakan</option>
                  <option @if($data['kategori']=='teknologi' ) selected @endif value="teknologi">Teknologi Pertanian dan Perternakan</option>
                  <option @if($data['kategori']=='pasar' ) selected @endif value="pasar">Pemasaran Pertanian dan Perternakan</option>
                  <option @if($data['kategori']=='lingkungan' ) selected @endif value="lingkungan">konservasi dan lingkungan</option>
               </select>
            </div>
            <div class="form-group">
               <label for="inputciri2">Ciri - ciri</label>
               <input type="text" name="ciri2" class="form-control" id="inputciri2" placeholder="Ciri-ciri : " required value="{{$data->ciri2}}">
            </div>
            <div class="form-group">
               <label for="inputsolusi">Solusi</label>
               <input type="text" name="solusi" class="form-control" id="inputsolusi" placeholder="Solusi : " required value="{{$data->solusi}}">
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