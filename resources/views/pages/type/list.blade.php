<meta name="_token" content="{!! csrf_token() !!}"/>
@extends('layouts.backend')
<script src="{{url('/assets/jQuery/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
@section('breadcrumb')
<a class="navbar-brand" href="#" style="color:#fd7e14;">Type LIST</a>
<i class="now-ui-icons arrows-1_minimal-right"></i>
<a class="navbar-brand" href="{{route('type/create')}}" style="margin-left:10px;">Create type</a>	
@endsection('breadcrumb')
@section('content')
        <div class="row" align="center">
          <div class="offset-md-2 col-md-8">
            <div class="card ">
              <div class="card-header ">
              @if (session('status'))
              <div class="alert alert-success" role="alert">
                <div class="container">
                  {{ session('status') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">
                      <i class="now-ui-icons ui-1_simple-remove"></i>
                    </span>
                  </button>
                </div>
              </div>
              @endif
              @if (session('error'))
              <div class="alert alert-danger" role="alert">
                <div class="container">
                {{ session('error') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">
                      <i class="now-ui-icons ui-1_simple-remove"></i>
                    </span>
                  </button>
                </div>
              </div>
              @endif
              </div>
              <div class="card-body ">
              <table id="type-datatable" class="table datatable-selection-single" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th width="80%">Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @if(count($list)>0)
                <tbody>
                <?php $i = 1;?>
                @foreach($list as $info)
                  <tr>
                    <td>
                        {{$i}}
                    </td>
                    <td>
                      {{$info->tp_name}}
                    </td>
                    <td>
                    <a href='{{Route("payment/info",["id"=>$info->package_id])}}' class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						        <a href="#" class="btn btn-danger" onclick="deletedata({{$info->package_id}})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                  </tr>
                  <?php $i++?>
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
        j("#type").addClass("active");
		j("#type-datatable").DataTable({
				'order':[[2,'DESC']]
			});	
	} );	
	function deletedata(id) {
		if(confirm("Please Confirm to delete data")){
			j("#type_id").val(id);
			j("#delete").submit();
		}
	}
</script>

<form id="delete" method="POST" action='{{Route("type/delete")}}'>
	<input type="hidden" name="type_id" id="type_id">
</form>
