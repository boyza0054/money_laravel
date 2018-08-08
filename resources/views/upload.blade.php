<meta name="_token" content="{!! csrf_token() !!}"/>
@extends('layouts.backend')
<script src="{{url('/assets/jQuery/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
<link href="/money_system/assets/css/bootstrap.min.css" rel="stylesheet" />
@section('breadcrumb')
<a class="navbar-brand" href="#">Home</a>
@endsection('breadcrumb')
@section('content')
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
                <!-- TEXT -->
              </div>
              <div class="card-body ">
                <div id="map" class="map">
                <div class="container">
                    <div class="card">
                    <div class="card-header">
                        <h2>Laravel 5.4 - File upload with progress bar</h2>
                    </div>
                    <div class="card-body">
                            <form method="POST" action="{{ route('fileUploadPost') }}" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input name="file" id="poster" type="file" class="form-control"><br/>
                                    <div class="progress">
                                        <div class="bar"></div >
                                        <div class="percent">0%</div >
                                    </div>
                                    <input type="submit"  value="Submit" class="btn btn-success">
                                </div>
                            </form>    
                    </div>
                    </div>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection('content')
<style>
        .progress { position:relative; width:100%; border: 1px solid #7F98B2; padding: 13px; border-radius: 3px; }
        .bar { background-color: #B4F5B4; width:0%; height:25px; border-radius: 3px; }
        .percent { position:absolute; display:inline-block; top:3px; left:48%; color: #7F98B2;}
    </style>
<script>
    $(document).ready(function() {
      $("#upload").addClass("active");
    });
</script>
