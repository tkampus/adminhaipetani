@extends('app')

@section('title', 'Masukan')

@section('link')
<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
   .event-gambar-mini {
      max-height: 4rem;
   }

   .event-gambar-max {
      width: -webkit-fill-available;
      max-width: -webkit-fill-available;
   }
</style>
@endsection

@section('content')

<!-- End of Topbar -->
<div class="container-fluid">

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-2 text-gray-800">Table Event</h1>
      <a href="{{route('createevent')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
         <i class="fas fa-user-plus fa-sm text-white-50"></i> Create New Event</a>
   </div>

   <!-- DataTales Example -->
   <div class="card shadow mb-4">
      <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">DataTables Event</h6>
      </div>
      <div class="card-body">
         <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
               <thead>
                  <tr>
                     <th>No</th>
                     <th>Judul</th>
                     <th>Gambar</th>
                     <th>Content</th>
                     <th>link</th>
                     <th>Created At</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tfoot>
                  <tr>
                     <th>No</th>
                     <th>Judul</th>
                     <th>Gambar</th>
                     <th>Content</th>
                     <th>link</th>
                     <th>Created At</th>
                     <th>Action</th>
                  </tr>
               </tfoot>
               <tbody>
                  @foreach($event as $key => $item)
                  <tr>
                     <td>{{ $key + 1 }}</td>
                     <td>{{ $item->judul }}
                        @if($key === count($event) - 1)
                        <span class="badge badge-success">Active</span>
                        @endif
                     </td>
                     <td class="text-center">
                        <a class="btn-image-event" data-toggle="modal" data-target="#modalgambar" data-id="{{ $item->id }}">
                           <img class="event-gambar-mini" src="{{ route('getimage', ['id' => $item->id]) }}" alt="">
                        </a>
                     </td>
                     <td>{{ $item->conten }}</td>
                     <td>{{ $item->link }}</td>
                     <td>{{ $item->created_at }}</td>
                     <td>
                        <a href="/Detail_Event:{{ $item->id }}" class="btn btn-info btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="Detail : {{ $item->judul }}">
                           <i class="fas fa-info-circle"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-circle btn-sm btn-delete" data-id="{{ $item->id }}" data-toggle="modal" title="Hapus : {{ $item->judul }}" data-target="#staticBackdrop" data-toggle="tooltip" data-placement="top" data-username="{{ $item->judul }}" data-email="{{ $item->judul }}">
                           <i class="fas fa-trash"></i>
                        </a>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>

</div>

<!-- modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Menghapus Account :</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <p>Apakah anda yakin akan menghapus akun <b><span id="usernameToDelete"></span></b>?</p>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <form method="post" action="{{Route('deleteevent')}}">
               @csrf
               <input class="form-confirm-delete" type="hidden" name="id" value="">
               <button type="submit" data-id="" class="btn btn-danger">Delete</button>
            </form>
         </div>
      </div>
   </div>
</div>


<div class="modal fade" id="modalgambar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Event ID : </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <img class="event-gambar-max" src="{{ route('getimage', $item->id) }}" alt="">
         </div>
      </div>
   </div>
</div>


@endsection

@section('script')
<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- script -->
<script>
   $(document).ready(function() {
      // Tangkap event klik tombol delete
      $(".btn-delete").on("click", function() {
         var idToDelete = $(this).data("id"); // Ambil ID item dari data-id
         var username = $(this).data('username');
         var email = $(this).data('email');

         // Isi modal dengan informasi detail pengguna
         $("#staticBackdropLabel").text("Menghapus Account : " + username);
         $("#usernameToDelete").text(email);

         // Set action untuk tombol delete pada modal
         $(".form-confirm-delete").attr("value", idToDelete);
      });
      $(".btn-image-event").on("click", function() {
         var idimage = $(this).data("id");
         var newSrc = "/Image_Event:" + idimage;
         $(".event-gambar-max").attr("src", newSrc);
         $(".modal-title").text("Event ID : " + idimage);
      });
   });
</script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
@endsection