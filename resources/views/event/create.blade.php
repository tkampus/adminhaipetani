@extends('app')

@section('title', 'Masukan')

@section('link')
<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

@endsection

@section('content')

<!-- End of Topbar -->
<div class="container-fluid">
   <form method="post" action="{{route('actioncreateevent')}}" enctype="multipart/form-data">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-2 text-gray-800">Buat Event Baru</h1>
         <button type="submit" class=" btn btn-primary">Buat Event</button>
      </div>
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Event</h6>
         </div>
         <div class="card-body">
            @csrf
            <div class="form-group">
               <label for="inputjudul4">Judul</label>
               <input type="text" name="judul" class="form-control" id="inputjudul4" placeholder="judul" required>
            </div>
            <div class="form-group">
               <label for="inputgambar">Gambar</label>
               <input type="file" name="gambar" class="form-control" accept="image/*" id="inputgambar" placeholder="gambar" required>
            </div>
            <div class="form-group">
               <label for="inputcontent">Content</label>
               <input type="text" name="content" class="form-control" id="inputcontent" placeholder="content" required>
            </div>
            <div class="form-group">
               <label for="inputlink">Link</label>
               <input type="text" name="link" class="form-control" id="inputlink" placeholder="link" required>
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