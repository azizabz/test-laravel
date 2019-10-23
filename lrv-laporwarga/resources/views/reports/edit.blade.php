@extends('layouts/main')

@section('title', 'Edit Laporan')

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

@section('page', 'Halaman Edit Laporan')
    
@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="content">

<form class="form-horizontal" method="post" action="/reports/{{$report->id}}" enctype="multipart/form-data">
@method('patch')
@csrf

{{-- <input type="hidden" name="id_lpr" value="" />
<input type="hidden" name="id_user" value="" /> --}}
<div class="form-group" style="padding-top: 20px;">
<h4 class="text-center" style="margin-top:0px; margin-bottom: 20px;">Form Edit Laporan</h4>
</div>
<div class="form-group">
<div class="col-sm-12 text-center">
<img id="uploadPreview" src="/storage/foto_laporan/{{$report->foto_laporan}}" style="width: 250px; height: 250px;"/>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Foto Laporan</label>
<div class="col-sm-9">
<input id="uploadImage" type="file" name="foto_laporan" class="form-control @error('foto_laporan') is-invalid @enderror" onchange="PreviewImage();" value="{{$report->foto_laporan}}"/>
@error('foto_laporan')
<div class="invalid-feedback">{{$message}}</div>
@enderror
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Judul Laporan</label>
<div class="col-sm-9">
<input type="text" name="jdl_lpr" placeholder="Judul Laporan" maxlength="50" class="form-control @error('foto_laporan') is-invalid @enderror" value="{{$report->judul_laporan}}"/>
@error('jdl_lpr')
<div class="invalid-feedback">{{$message}}</div>
@enderror
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Isi Laporan</label>
<div class="col-sm-9">
<textarea name="isi_lpr" rows="10" placeholder="Isi Laporan" class="form-control @error('isi_lpr') is-invalid @enderror">{{$report->isi_laporan}}</textarea>
@error('isi_lpr')
<div class="invalid-feedback">{{$message}}</div>
@enderror
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Kategori Laporan</label>
<div class="col-sm-9">
<select class="form-control" name="kategori" placeholder="Pilih Kategori" value="{{$report->id_kategori}}">
<option value="1" @if($report->id_kategori == '1') selected='selected' @endif>Keamanan dan Ketertiban</option>
<option value="2" @if($report->id_kategori == '2') selected='selected' @endif>Kebersihan Lingkungan</option>
<option value="4" @if($report->id_kategori == '4') selected='selected' @endif>Dampak Lingkungan</option>
<option value="3" @if($report->id_kategori == '3') selected='selected' @endif>Kesehatan</option>
<option value="5" @if($report->id_kategori == '5') selected='selected' @endif>Lain-Lain</option>
</select>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Lapor Sebagai</label>
<div class="col-sm-9">
<select class="form-control" name="pelapor" placeholder="Pilih Kategori" value="{{$report->status_pelapor}}">
<option value="Warga Asli" @if($report->status_pelapor == 'Warga Asli') selected='selected' @endif>Warga Asli</option>
<option value="Bukan Warga Asli" @if($report->status_pelapor == 'Bukan Warga Asli') selected='selected' @endif>Bukan Warga Asli</option>
</select>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Pilih Lokasi</label>
<div class="col-sm-3">
<input id="lat" type="text" name="lat" class="form-control @error('lat') is-invalid @enderror" placeholder="Latitude" value="{{$report->lat}}"/>
@error('lat')
<div class="invalid-feedback">{{$message}}</div>
@enderror
</div>
<div class="col-sm-3">
<input id="lng" type="text" name="lng" class="form-control @error('lng') is-invalid @enderror" placeholder="Longitude" value="{{$report->lon}}"/>
@error('lng')
<div class="invalid-feedback">{{$message}}</div>
@enderror
</div>
<div class="col-sm-3">
<a class="btn btn-success" data-toggle="modal" href="#myModal" role="button"><i class="pe-7s-map-marker"></i> Buka map</a>
</div>
</div>
<br>
<div class="form-group text-center" style="margin-bottom: 20px;">
<button type="submit" name="kirim" class="btn btn-primary btn-lg">Ubah Laporan</button>
</div>
</form>
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
          <h4 class="modal-title">Pilih Lokasi</h4>
        </div>
        <div class="modal-body">
          <div id="mapid"></div>
    <script type="text/javascript">
    var map = L.map('mapid').setView([-6.4061284,106.8125453], 12);
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
      attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
      maxZoom: 18,
      id: 'mapbox.streets',
      accessToken: 'pk.eyJ1Ijoicnlhbjkzc3AiLCJhIjoiY2pkMDJxZ2xpMGxjYTJxbzRtd3EzZnRzcCJ9.WsRQpljGbYjxw7za2_cPtA'
    }).addTo(map);
    
    $('#myModal').on('shown.bs.modal', function(e){
    setTimeout(function() {
    map.invalidateSize();
    map.locate({setView: true, maxZoom: 16});
    }, 10);
    });
    
    function onLocationFound(e) {
    user = L.marker(e.latlng).addTo(map)
        .bindPopup("Lokasi anda saat ini").openPopup();

    /*marker.on('move', function (e) {
    document.getElementById('latlong').value = marker.getLatLng().lat + ',' + marker.getLatLng().lng;
    });*/
    }

    map.on('locationfound', onLocationFound);

    function onLocationError(e) {
    alert(e.message);
    }

    map.on('locationerror', onLocationError);

    var marker = {};

    function onMapClick(e) {
    lat = e.latlng.lat;
    lon = e.latlng.lng;

    //console.log("You clicked the map at LAT: "+ lat+" and LONG: "+ lon );
        //Clear existing marker, 

        if (marker != undefined) {
              map.removeLayer(marker);
        };

    //Add a marker to show where you clicked.
     marker = L.marker(e.latlng, {
      draggable: true
     }).addTo(map)
          .bindPopup("Lokasi yang dipilih").openPopup(); 

    document.getElementById('lat').value = marker.getLatLng().lat;
    document.getElementById('lng').value = marker.getLatLng().lng;

    marker.on('dragend', function (e) {
    var chagedPos = e.target.getLatLng();
    this.bindPopup("Lokasi yang dipilih").openPopup();
    document.getElementById('lat').value = marker.getLatLng().lat;
    document.getElementById('lng').value = marker.getLatLng().lng;
    //console.log("You drag: "+ chagedPos);
    });
};

  map.on('click', onMapClick);
   
  </script> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
        </div>
      </div>
    </div>
  </div>
    
@endsection