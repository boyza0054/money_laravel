<meta name="_token" content="{!! csrf_token() !!}"/>
@extends('layouts.backend')
<script src="{{url('/assets/jQuery/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
@section('breadcrumb')
<a class="navbar-brand" href="#" style="color:#fd7e14;">Type LIST</a>
<i class="now-ui-icons arrows-1_minimal-right"></i>
<a class="navbar-brand" href="#" data-toggle="modal" data-target="#CreateModal" style="margin-left:10px;">Create type</a>
@endsection('breadcrumb')
@section('content')
        <div class="row">
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
                    <a href='#' class="btn btn-success" onclick="editdata({{$info->tp_id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						        <a href="#" class="btn btn-danger" onclick="deletedata({{$info->tp_id}})"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
  function editdata(id) {
    var settings = {
      "url": "{{route('type/info')}}",
      "method": "GET",
      "data": {id}
    }
    $.ajax(settings).done(function (response) {
      console.log(response.tp_name)
      $("#InfoModal").modal();
      $('#type_id_edit').val(response.tp_id);
      $('#type_name_edit').val(response.tp_name);
    });

	}
</script>

<form id="delete" method="POST" action='{{Route("type/delete")}}'>
	<input type="hidden" name="type_id" id="type_id">
</form>

<!-- Modal -->
<div class="modal fade" id="CreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create type list</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{route('type/insert')}}" style="margin-botton:0px;">
      <div class="modal-body">
      <div class="row">
					<div class="col-md-12">
						<div class="form-group has-feedback">
							<label>Type name :</label>
								<input type="text" class="form-control" name="type_name" id="type_name" placeholder="Please input Type name" required="true">
              </div>
					</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="InfoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Info type list</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{route('type/update')}}" style="margin-botton:0px;">
      <div class="modal-body">
      <div class="row">
					<div class="col-md-12">
            <input type="hidden" name="id" id="type_id_edit">
						<div class="form-group has-feedback">
							<label>Type name :</label>
								<input type="text" class="form-control" name="type_name" id="type_name_edit" placeholder="Please input Type name" required="true">
              </div>
					</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
