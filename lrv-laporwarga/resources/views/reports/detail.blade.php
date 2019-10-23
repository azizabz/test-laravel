@extends('layouts/main')

@section('title', 'Lapor')

@section('custom')

    <script type="text/javascript">
    function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
    oFReader.onload = function (oFREvent)
     {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
    };
    };
    </script>
    
    <style>
        #mapid{
          height: 300px;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
    <script src="{{ url('assets/leaflet/leaflet.ajax.min.js') }}"></script>

@endsection

@section('page', 'Halaman Lapor')
    
@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="content">

                <div class="text-right" style="padding-bottom:15px;">
                    <a href="/reports/log" class="btn btn-default" role="button">&laquo; Kembali</a>
                </div>

                <div class="panel panel-default">
                <div class="panel-body">
                    <h3>{{$report->judul_laporan}}</h3>
                    <div class="info-meta">
                        <ul class="list-inline">
                            <li><i class="fa fa-clock-o"></i>{{ date('d/m/Y', strtotime($report->created_at)) }}</li>
                            <li><i class="fa fa-user"></i> Dikirim oleh {{$report->user->name}}</li>
                        </ul>
                        <ul class="list-inline"><li>Status Laporan : <span class="label label-info" style="text-transform: capitalize;">{{$report->status_laporan}}</span></li>
                        </ul>
                    </div>
                    <hr>
                    <div class = "media">
                        <a class = "pull-left" href = "#">
                        <img class = "media-object " src = "/storage/foto_laporan/{{$report->foto_laporan}}" width="300px" height="300px" >
                        </a>
                    <div class = "media-body">
                        <p style="text-align:justify;">
                            {{$report->isi_laporan}}
                        </p>  
                    </div>
                    <hr>
                        <div class="pull-right">
                            <a class="btn btn-success" data-toggle="modal" href="#myModal" role="button">Lihat Lokasi</a>
                        </div>
                        <div class="pull-left">
                            <a class="btn btn-info" href="/reports/{{$report->id}}/edit">Edit</a>
                        </div>
                        <form action="/students/{{$report->id}}" method="POST" class="pull-left">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
                </div>
                </div>     
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('modal')

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Lokasi Laporan</h4>
            </div>
            <div class="modal-body">
              <div id="leaflet"></div>
        <script type="text/javascript">
        var map = L.map('leaflet', {
      layers: [
        L.tileLayer('//{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          'attribution': 'Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
        })
      ],
      center: [0, 0],
      zoom: 0
    });
    
        $('#myModal').on('shown.bs.modal', function(e){
        setTimeout(function() {
        map.invalidateSize();
    
    var router = L.routing.osrmv1()
    
    router.route([
      L.routing.waypoint([-6.374509, 106.803396]),
      L.routing.waypoint([<?php echo substr($report->lat,0,17);?>, <?php echo substr($report->lon,0,16);?>])
    ], function(err, routes) {
      if (err || routes.length < 1) {
        return console.error(err)
      }
      
      var line = L.routing.line(routes[0]).addTo(map)
      map.fitBounds(line.getBounds())
    })
    
        }, 10);
        })
    
        //Add a marker
        kelurahan = L.marker([-6.374509, 106.803396]).addTo(map)
              .bindPopup("Kelurahan Tanah Baru").openPopup();
        marker = L.marker([<?php echo substr($report->lat,0,17);?>, <?php echo substr($report->lon,0,16);?>]).addTo(map)
              .bindPopup("Lokasi Laporan").openPopup();
    
      </script> 
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
            </div>
          </div>
        </div>
      </div>
    
@endsection