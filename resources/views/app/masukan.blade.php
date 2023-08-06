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
   <h1 class="h3 mb-2 text-gray-800">Table Masukan</h1>

   <!-- DataTales Example -->
   <div class="card shadow mb-4">
      <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
      </div>
      <div class="card-body">
         <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                  <tr>
                     <th style="width: 90px; word-wrap: break-word;">Email</th>
                     <th>Masukan</th>
                     <th style="width: 150px; word-wrap: break-word;">tanggal</th>
                  </tr>
               </thead>
               <tfoot>
                  <tr>
                     <th>Email</th>
                     <th>Masukan</th>
                     <th>tanggal</th>
                  </tr>
               </tfoot>
               <tbody>
                  @foreach($masukan as $item)
                  <tr>
                     <td>{{$item->email_pengirim}}</td>
                     <td>{{$item->text_pesan}}</td>
                     <td>{{$item->created_at}}</td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>

</div>


@endsection

@section('script')
<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
@endsection