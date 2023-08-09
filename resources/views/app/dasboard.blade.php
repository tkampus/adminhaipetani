@extends('app')

@section('title', 'Dasboard')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-9 col-lg-8 container-fluid mb-3">
            <h1>Selamat datang di AdminHaiPetani</h1>
            <p class="lead">Mari bersama-sama menjelajahi informasi terbaru dan mengelola aktivitas Anda di platform kami.</p>
            <hr class="my-4">
            <p>Jangan ragu untuk menggunakan menu dan fitur yang tersedia untuk menjalankan tugas Anda dengan lebih efisien dan efektif.</p>
            <a href="{{route('readakun')}}" class="btn btn-primary">Mulai Sekarang</a>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-3 col-lg-4">
            <div class="row">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-12 col-lg-12 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Jumlah User Ahli</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data['ahli']}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-12 col-lg-12 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Jumlah User Petani</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data['petani']}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-12 col-lg-12 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Jumlah yang login hari ini</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data['loginnow']}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Pending Requests Card Example -->
                <div class="col-xl-12 col-lg-12 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Jumlah yang menggunakan fitur chat hari ini</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data['chatnow']}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Account Pemgguna</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart" data-admin="{{$data['admin']}}" data-ahli="{{$data['ahli']}}" data-petani="{{$data['petani']}}"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Admin
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Ahli
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Petani
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection

@section('script')
<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>
<!-- Page level custom scripts -->
<script src="js/demo/chart-pie-demo.js"></script>
@endsection