<meta name="_token" content="{!! csrf_token() !!}"/>
@extends('layouts.backend')
<script src="{{url('/assets/jQuery/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
@section('breadcrumb')
<a class="navbar-brand" href="#">USER LIST</a>
<i class="now-ui-icons arrows-1_minimal-right"></i>
<a class="navbar-brand" href="#" style="margin-left:10px;">Create User</a>	
@endsection('breadcrumb')
@section('content')
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
                <!-- TEXT -->
              </div>
              <div class="card-body ">
              <table id="event-datatable" class="table datatable-selection-single" >
                <thead>
                    <tr>
                        <th>Profile img</th>
                        <th>Name</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @if(count($list)>0)
                <tbody>
                @foreach($list as $info)
                  <tr>
                    <td width="100px;">
                    <img src="{{$info->mpic}}" class="c_column-images" onerror="imgError(this);">
                    </td>
                    <td>
                      {{$info->mname}}
                    </td>
                    <td>
                      {{$info->mlastname}}
                    </td>
                    <td>
                      {{$info->memail}}
                    </td>
                    <td>
                      @if($info->mstatus == 1)
                      ADMIN
                      @else
                      USER
                      @endif
                    </td>
                    <td width="120px;">
                    <a href='{{Route("users/info",["id"=>$info->mid])}}' class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						        <a href="#" class="btn btn-danger" onclick="deletedata({{$info->mid}})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              @endif
	            </table>
              </div>
            </div>
          </div>
        </div>
@endsection('content')
<style>
.c_column-images{
  width: 100%;
  border-radius: 20%;
}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
	var j = jQuery.noConflict();
	j(document).ready(function() {
		j("#event-datatable").DataTable();	
	} );	
	function deletedata(id) {
		if(confirm("Please Confirm to delete data")){
			j("#del_exhid").val(id);
			j("#delete").submit();
		}
	}
  function imgError(image) {
				image.onerror = "";
				image.src = "../images/default-user-image.png";
			  image.style = "padding-right:10px";
				return true;
	}
</script>
