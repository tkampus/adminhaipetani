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
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-2 text-gray-800">Table Account</h1>
      <a href="{{route('createakun')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-user-plus fa-sm text-white-50"></i> Create New Account</a>
   </div>

   <!-- DataTales Example -->
   <div class="card shadow mb-4">
      <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary">DataTables Accont</h6>
      </div>
      <div class="card-body">
         <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                  <tr>
                     <th>Username</th>
                     <th>Email</th>
                     <th>Role</th>
                     <th>Telp</th>
                     <th>NIK</th>
                     <th>Jenis Kelamin</th>
                     <th>Alamat</th>
                  </tr>
               </thead>
               <tfoot>
                  <tr>
                     <th>Username</th>
                     <th>Email</th>
                     <th>Role</th>
                     <th>Telp</th>
                     <th>NIK</th>
                     <th>Jenis Kelamin</th>
                     <th>Alamat</th>
                  </tr>
               </tfoot>
               <tbody>
                  @foreach($akun as $item)
                  <tr>
                     <td>{{$item->username}}</td>
                     <td>{{$item->email}}</td>
                     <td>
                        <a href="{{route('read'.$item->role)}}">{{$item->role}}</a>
                     </td>
                     <td>{{$item->telp}}</td>
                     <td>{{$item->nik}}</td>
                     <td>{{$item->jeniskelamin}}</td>
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