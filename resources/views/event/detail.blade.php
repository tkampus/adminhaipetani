@extends('app')

@section('title', 'Detail FAQ')

@section('link')
<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
   .event-gambar-max {
      width: -webkit-fill-available;
      max-width: -webkit-fill-available;
   }
</style>
@endsection

@section('content')

<!-- End of Topbar -->
<div class="container-fluid">
   <form method="post" action="{{route('updateevent')}}" enctype="multipart/form-data">
      @csrf
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between">
         <h2 class="h5 mb-2 text-gray-800">
            <a href="{{$back['url']}}" class="text-decoration-none">
               <i class="fa fa-chevron-left"></i> Kembali ke {{$back['title']}}</a>
         </h2>
         <div>
            <button type="submit" class="mb-2 btn btn-primary">Update Event</button>
            <a href="{{route('updateeventactive', ['id' => $data->id])}}" class="mb-2 btn btn-info">Jadikan Active</a>
         </div>
      </div>
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
         <input type="hidden" name="id" value="{{$data->id}}">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Event</h6>
         </div>
         <div class="card-body">
            <input type="hidden" name="id" value="{{$data->id}}">
            <div class="row">
               <div class="col-lg-8">
                  <div class="form-group">
                     <label for="inputjudul">Judul</label>
                     <input type="text" name="judul" class="form-control" id="inputjudul" placeholder="Judul : " required value="{{$data->judul}}">
                  </div>
                  <div class="form-group">
                     <label for="inputgambar">Gambar</label>
                     <input type="file" name="gambar" class="form-control" accept="image/*" id="inputgambar" placeholder="gambar">
                  </div>
               </div>
               <div class="col-lg-4 text-center border align-middle">
                  <img class="event-gambar-max" for="inputgambar" src="{{ route('getimage', ['id' => $data->id]) }}" alt="">
               </div>
            </div>
            <div class="form-group">
               <label for="inputciri2">Content</label>
               <input type="text" name="content" class="form-control" id="inputciri2" placeholder="Content : " required value="{{$data->conten}}">
            </div>
            <div class="form-group">
               <label for="inputsolusi">Link</label>
               <input type="text" name="link" class="form-control" id="inputsolusi" placeholder="Link : " required value="{{$data->link}}">
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