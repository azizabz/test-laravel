@extends('layouts/main')

@section('title', 'Log Laporan')

@section('page', 'Halaman Log Laporan')
    
@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="content">

        <div class="row">
        @if (count($reports) > 0)
        @foreach ($reports as $report)
        <div class="col-sm-2 col-xs-4">
            <a class = "pull-left" href = "#">
            <img class = "media-object " src = "/storage/foto_laporan/{{$report->foto_laporan}}" width="150px" height="150px" >
            </a>
        </div>
        <div class="col-sm-10 col-xs-8" style="margin-top: -20px;">
          <h3>{{$report->judul_laporan}}</h3>
            <div class="info-meta">
                <ul class="list-inline">
                    <li><i class="fa fa-clock-o"></i> {{ date('d/m/Y', strtotime($report->created_at)) }} </li>
                <li><i class="fa fa-user"></i> Dikirim oleh {{ $report->user->name }}</li>
                </ul>
            </div>
               <div class = "media-body">
                  <p style="text-align:justify;">
                  {{ substr($report->isi_laporan,0,100) }}...
                  </p>  
               </div>
                <p style="text-align:right;">
                    <a href="/reports/{{$report->id}}" class="btn btn-primary" role="button">Detail</a>
                </p>
            </div> 
            <hr>           
            @endforeach
            @else
             <div class="col-sm-12 col-xs-12 text-center">
                <h3>Anda belum membuat laporan.</h3>
            </div>
            @endif  
            </div>

                    <div class="text-center">
                    {{ $reports->render() }}
                    </div>
        
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection