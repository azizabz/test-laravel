@extends('layouts/main')

@section('title', 'Aplikasi Lapor Warga')

@section('page', 'Halaman Utama')
    
@section('content')   

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('inc/message')
                <div class="card">
                    
                @guest
                @if (Route::has('register'))
                <div class="content text-center simple-text pb-50" style="padding-bottom:50px;">
                    <h4>Selamat Datang</h4>
                    <p>Hallo User<br>Silahkan login atau register terlebih dahulu untuk dapat menggunakan fitur yang ada pada Aplikasi Lapor Warga.</p>
                </div>
                @endif
                @else
                <div class="content text-center simple-text">
                    <h4>Selamat Datang</h4>
                <p>Hallo <br>Selamat datang di Aplikasi Lapor Warga. Anda dapat menggunakan fitur yang tersedia pada aplikasi.</p>
                </div>
    
    <!-- Main content -->
      <section class="content">
          <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-xs-6 col-md-offset-3">
            <!-- small box -->
            <div style="background-color:#e0e01f;color:#fff" class="small-box">
              <div class="inner">
                
              <h3>{{count($reports)}}</h3>
                <p>Data<br>Log Laporan</p>
            </div>
              <div class="icon">
                  <i class="fa fa-file-text"></i>
              </div>
                <a href="loglaporan.php" class="small-box-footer" title="Lihat Log Laporan" data-toggle="tooltip"><i class="fa fa-pencil-square-o"></i></a>
            </div>
          </div><!-- ./col -->
          
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div style="background-color:#00c0ef;color:#fff" class="small-box">
                    <div class="inner">
                
                    <h3>{{count($announces)}}</h3>
                <p>Data<br>Pengumuman</p>
              </div>
              <div class="icon">
                  <i class="fa fa-bullhorn"></i>
              </div>
                <a href="pengumuman.php" class="small-box-footer" title="Lihat Pengumuman" data-toggle="tooltip"><i class="fa fa-pencil-square-o"></i></a>
            </div>
        </div><!-- ./col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
      @endguest
                
                </div>
            </div>
        </div>
    </div>
</div>

@endsection