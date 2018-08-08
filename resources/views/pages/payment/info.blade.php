<meta name="_token" content="{!! csrf_token() !!}"/>
@extends('layouts.backend')
<script src="{{url('/assets/jQuery/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
@section('breadcrumb')
<a class="navbar-brand" href="{{route('payment/list')}}">Payment LIST</a>
<i class="now-ui-icons arrows-1_minimal-right"></i>
<a class="navbar-brand" href="{{route('payment/create')}}" style="margin-left:10px;color:#fd7e14;">Payment Information</a>
@endsection('breadcrumb')
@section('content')
        <div class="row">
          <div class="col-md-12">
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
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs justify-content-left" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" data-toggle="tab" href="#detail" role="tab" aria-selected="true">
                                    <i class="fa fa-book"></i>
                                    ข้อมูลของวันนี้
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
              </div>
              <div class="card-body ">
              {{ Form::open(['url'=>'payment/update','class'=>'form-horizontal','files'=>true,'style'=>'font-size:12px;','id'=>'updateform']) }}
		      {{ Form::hidden('package_id',$data->package_id)}}
                    <div class="tab-content">
						<div class="tab-pane active show" id="detail" role="tabpanel">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <label>Date :</label>
                                        {{ Form::text('packagedate',date('m/d/Y', strtotime($data->package_date)),array('id'=>'datepicker','class'=>'form-control span6','placeholder' => 'กรอกวันที่','maxlength'=>'120' , )) }}				
                                    </div> 
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-feedback">
                                        <label>Comment :</label>
                                        <!-- <textarea class="form-control"></textarea>			 -->
                                        <input type="text" name="comment" id="comment" value="{{$data->comment}}" class="form-control" placeholder="Please input your comment.">
                                    </div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                <table class="table table-hover" >
                                <thead>
                                    <tr >
                                        <th>
                                            รายการ
                                        </th>
                                        <th>
                                            รายละเอียด
                                        </th>
                                        <th>
                                            ราคา / บาท
                                        </th>
                                        <th>
                                            <a class="btn btn-success" onclick="addfield2()" id="circle_btn"><i class="fa fa-plus"></i></a>
                                        <th>
                                    </tr>
                                </thead>
                                <tbody id="property_body2">
                                @if(count($attributes)==0)
                                    <tr>
                                        <td>
                                            <select class="form-control" name="attrtype[]" id="attrtype[]" required="true">
												<option value="0">Please selected type list</option>
												@foreach($type as $t)
													<option value="{{$t->tp_id}}">{{$t->tp_name}}</option>
												@endforeach 
											</select>
                                        </td>
                                        <td>
                                            {{ Form::text("attrname[]","",array("class"=>"form-control span6","placeholder" => "ชื่อคุณสมบัติ")) }}
                                        </td>
                                        <td>
                                            {{ Form::text("attrvalue[]","",array("class"=>"form-control span6","placeholder" => "ค่าคุณสมบัติ")) }}
                                        </td>

                                        <td>

                                        </td>
                                    </tr>
                                @elseif(count($attributes)>0)
                                @foreach($attributes as $p)
                                    <?php  $id = date("Ymdhis")


                                    ."-".$p->Pay_id ?>
                                    <tr id="{{ $id }}" val-attr = "{{$p->Pay_id}}">
                                        <td>
                                            <select class="form-control" name="old_attrtype[{{ $id }}]" id="old_attrtype[{{ $id }}]" required="true">
												<option value="0">Please selected type list</option>
                                                @foreach($type as $t)
                                                    <option value="{{$t->tp_id}}" {{$p->Pay_type == $t->tp_id ? 'selected="selected"' : '' }}>{{$t->tp_name}}</option>
												@endforeach 
											</select>
                                        </td>
                                        <td>
                                            {{ Form::text("old_attrname[$id]",$p->	Payname,array("class"=>"form-control span6","placeholder" => "ชื่อคุณสมบัติ")) }}
                                        </td>
                                        <td>
                                            {{ Form::text("old_attrvalue[$id]",$p->Pay_money,array("class"=>"form-control span6","placeholder" => "ค่าคุณสมบัติ")) }}
                                        </td>

                                        <td>
                                            <a href="#" class="btn btn-danger" id="circle_btn" onclick="deletefield2('{{ $id }}',{{$p->Pay_id}})" ><span class="fa fa-minus"></span></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif

                                    {{Form::hidden('delete_package_attr','',array('id'=>'delete_package_attr'))}}
                                </tbody>
                            </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="padding-right: 100px;">
                                    <div class="pull-right">
                                    <a href="{{url('payment/list')}}" class="btn btn-default" >Cancel</a>
                                    <a href="#" class="btn btn-danger" onclick="validateform()">Save</a>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
                {{ Form::close() }}
              </div>
            </div>
          </div>
        </div>
@endsection('content')

<style type="text/css">
    .table-hover tbody tr:hover {
        background-color: none;
    }
    #circle_btn{
        border-radius: 50%;
        padding: 8px 10px 8px 10px;
        color:#fff;
    }
</style>

<script type="text/javascript">
	function validateform() {	
		$("#updateform").submit();
	}
	function addfield2() {
		var id = '{!! date("ymdhis") !!}';
		var html = "<tr id='"+id+"'>"
        +'<td>'
        +'<select class="form-control" name="attrtype[]" id="attrtype[]" required="true">'
		+'<option value="0">Please selected type list</option>'
		+'@foreach($type as $t)'
		+'	<option value="{{$t->tp_id}}">{{$t->tp_name}}</option>'
		+'@endforeach' 
		+'</select>'
        +'</td>'
		+'<td>'
		+'	{{ Form::text("attrname[]","",array("class"=>"form-control span6","placeholder" => "รายละเอียด")) }}'
		+'</td>'
		+'<td>'
		+'	{{ Form::text("attrvalue[]","",array("class"=>"form-control span6","placeholder" => "ราคา / บาท")) }}'
		+'</td>'
		+'<td>'
		+'<a href="#" class="btn btn-danger" id="circle_btn" onclick="deletefield2('+id+',0)" ><span class="fa fa-minus"></span></a>'
		+'</td>'
		+"</tr>";

		$("#property_body2").append(html);
		
		return false;
	}
	function deletefield2(div,id) {
		$("#"+div+"").remove();
		var deletes = $("#delete_package_attr").val();
		if(id!=0) {
			if(deletes == null || deletes =="") {
				var inputval = id;	
			} else {
				var inputval = deletes+","+id;	
			}
			$("#delete_package_attr").val(inputval);
		}
	}
	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}

</script>