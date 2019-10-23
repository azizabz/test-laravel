@extends('layouts/main')

@section('title', 'Pengumuman')

@section('page', 'Halaman Pengumuman')
    
@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="content">

                    <div class="panel panel-default">
                    <div class="panel-body">
                    
                    @if (count($announces) > 0)

                    @foreach ($announces as $announce)

                    <h3>{{ $announce->judul_pgmn }}</h3>
                    <div class="info-meta">
                        <ul class="list-inline">
                            <li><i class="fa fa-clock-o"></i> {{ $announce->tgl_pgmn }} </li>
                            <li><i class="fa fa-user"></i> Dikirim oleh {{ $announce->nama_admin }} </li>
                        </ul>
                    </div>
                    <!--<div class = "media">
                    <a class = "pull-left" href = "#">
                      <img class = "media-object " src = "images/education.jpg" width="100%" height="200px" >
                    </a>-->
                    <div class = "media-body">
                        <p style="text-align:justify;">
                        {{ $announce->isi_pgmn }}
                        </p>  
                    </div>
                        <p style="text-align:right;">
                        <a href="" class="btn btn-primary" role="button">Baca Lebih Lanjut</a>
                        </p>
                    <hr>
                                            
                    @endforeach

                    <div class="text-center">
                    {{ $announces->render() }}
                    </div>
                    
                    @else

                    <div class="text-center">
                    <p>Belum ada Pengumuman</p>
                    </div>
                    
                    @endif

                    </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection