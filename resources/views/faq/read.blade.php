@extends('app')

@section('title', 'Daftar FAQ')

@section('link')
<!-- Custom styles for this page -->
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> -->
<link href="vendor/quill/css/cdn.quilljs.com.css" rel="stylesheet">
<style>
   .tabel-kolom-text {
      display: block;
      max-width: 30rem;
      width: max-content;
      max-height: 10rem;
      overflow-y: hidden;
      overflow-x: hidden;
      white-space: normal;
      word-wrap: break-word;
   }
</style>
@endsection

@section('content')

<!-- End of Topbar -->
<div class="container-fluid">

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-2 text-gray-800">Table FAQ</h1>
      <a href="{{route('createfaq')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-user-plus fa-sm text-white-50"></i> Create New FAQ</a>
   </div>

   <!-- DataTales Example -->
   <div class="card shadow mb-4">
      <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">DataTables FAQ</h6>
      </div>
      <div class="card-body">
         <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
               <thead>
                  <tr>
                     <th>No</th>
                     <th>Judul</th>
                     <th>Kategori</th>
                     <th>Ciri - ciri</th>
                     <th>Solusi</th>
                     <th>Created At</th>
                     <th>Updated At</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tfoot>
                  <tr>
                     <th>No</th>
                     <th>Judul</th>
                     <th>Kategori</th>
                     <th>Ciri - ciri</th>
                     <th>Solusi</th>
                     <th>Created At</th>
                     <th>Updated At</th>
                     <th>Action</th>
                  </tr>
               </tfoot>
               <tbody>
                  @foreach($faq as $key => $item)
                  <tr>
                     <td>{{ $key + 1 }}</td>
                     <td>{{$item->judul}}</td>
                     <td class="tabel-kolom-text">{!! $item->ciri2 !!}</td>
                     <td>{{$item->kategori}}</td>
                     <td class="tabel-kolom-text">{!! $item->solusi !!}</td>
                     <td>{{$item->created_at}}</td>
                     <td>{{$item->updated_at}}</td>
                     <td>
                        <a href="/Detail_FAQ:{{$item->id}}" class="btn btn-info btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="Detail : {{$item->judul}}">
                           <i class="fas fa-info-circle"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-circle btn-sm btn-delete" data-id="{{$item->id}}" data-toggle="modal" title="Hapus : {{$item->judul}}" data-target="#staticBackdrop" data-toggle="tooltip" data-placement="top" data-username="{{$item->judul}}" data-email="{{$item->judul}}">
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
            <h5 class="modal-title" id="staticBackdropLabel">Menghapus FAQ :</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <p>Apakah anda yakin akan menghapus FAQ dengan judul : <b><span id="usernameToDelete"></span></b>?</p>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <form method="post" action="{{Route('deletefaq')}}">
               @csrf
               <input class="form-confirm-delete" type="hidden" name="id" value="">
               <button type="submit" data-id="" class="btn btn-danger">Delete</button>
            </form>
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

         $("#usernameToDelete").text(email);

         // Set action untuk tombol delete pada modal
         $(".form-confirm-delete").attr("value", idToDelete);
      });
   });
</script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
@endsection