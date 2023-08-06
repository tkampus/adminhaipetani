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
                     <th>username</th>
                     <th>email</th>
                     <th>role</th>
                     <th>password</th>
                     <th>telp</th>
                     <th>nik</th>
                     <th>jeniskelamin</th>
                     <th>tanggallahir</th>
                     <th>alamat</th>
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
                  @foreach($akun as $item)
                  <tr>
                     <td>{{$item->username}}</td>
                     <td>{{$item->email}}</td>
                     <td>{{$item->role}}</td>
                     <td>{{$item->password}}</td>
                     <td>{{$item->telp}}</td>
                     <td>{{$item->nik}}</td>
                     <td>{{$item->jeniskelamin}}</td>
                     <td>{{$item->tanggallahir}}</td>
                     <td>{{$item->alamat}}</td>
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