<meta name="_token" content="{!! csrf_token() !!}"/>
@extends('layouts.backend')
<script src="{{url('/assets/jQuery/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
@section('breadcrumb')
<a class="navbar-brand" href="{{route('payment/list')}}">Payment LIST</a>
<i class="now-ui-icons arrows-1_minimal-right"></i>
<a class="navbar-brand" href="{{route('payment/create')}}" style="margin-left:10px;color:#fd7e14;">Create Payment</a>
@endsection('breadcrumb')
@section('content')
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
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
                {{ Form::open(['url'=>'payment/insert','class'=>'form-horizontal','files'=>true,'id'=>'createform','style'=>'font-size:12px;']) }}
                    <div class="tab-content">
						<div class="tab-pane active show" id="detail" role="tabpanel">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <label>Date :</label>
                                        <input type="date" name="date1" id="date1" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-feedback">
                                        <label>Comment :</label>
                                        <!-- <textarea class="form-control"></textarea>			 -->
                                        <input type="text" name="comment" id="comment" class="form-control" placeholder="Please input your comment.">
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
                                            <tr id='defalut'>
                                                <td>
                                                        <select class="form-control" name="attrtype[]" id="attrtype[]" required="true">
															<option value="0">Please selected type list</option>
															<option value="1">Food</option>
															<option value="2">ของใช้</option>
														</select>
                                                </td>
                                                <td>
                                                    {{ Form::text("attrname[]","",array("class"=>"form-control span6","placeholder" => "รายละเอียด")) }}
                                                </td>
                                                <td>
                                                    {{ Form::number("attrvalue[]","",array("class"=>"form-control span6","placeholder" => "ราคา / บาท")) }}
                                                </td>
                                                <td>
                                                    <a class="btn btn-danger" id="circle_btn" onclick="deletefield2('defalut')" ><i class="fa fa-minus" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>;
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="padding-right: 100px;">
                                    <div class="pull-right">
                                        <a href="{{url('payment/list')}}" class="btn btn-default" >Cancel</a>
                                        <a href="#" class="btn btn-danger" onclick="validateform()">Submit</a>
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
<script type="text/javascript">
    $(document).ready(function() {
      $("#payment").addClass("active");
    });
	var totalfield = 0;
	function validateform() {
		var ins_date = $("#date1").val();
		if(ins_date==""||ins_date ==null){
			alert("กรุณากรอกวันที่");
		} else {
			$("#createform").submit();
		}
	}
	function addfield2() {
		var id = getDateTime();
		var html = "<tr id='"+id+"'>"
        +'<td>'
        +'<select class="form-control" name="attrtype[]" id="attrtype[]" required="true">'
		+'<option value="0">Please selected type list</option>'
		+'<option value="1">Food</option>'
		+'<option value="2">ของใช้</option>'
		+'</select>'
        +'</td>'
		+'<td>'
		+'	{{ Form::text("attrname[]","",array("class"=>"form-control span6","placeholder" => "รายละเอียด")) }}'
		+'</td>'
		+'<td>'
		+'	{{ Form::number("attrvalue[]","",array("class"=>"form-control span6","placeholder" => "ราคา / บาท")) }}'
		+'</td>'
		+'<td>'
		+'<a class="btn btn-danger" id="circle_btn" onclick="deletefield2(\''+id+'\')" ><i class="fa fa-minus" aria-hidden="true"></i></a>'
		+'</td>'
		+"</tr>";

		$("#property_body2").append(html);

		return false;
	}
	function deletefield2(div) {
		$("#"+div).empty();
	}
	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}
	function getDateTime() {
		var now     = new Date();
		var year    = now.getFullYear();
		var month   = now.getMonth()+1;
		var day     = now.getDate();
		var hour    = now.getHours();
		var minute  = now.getMinutes();
		var second  = now.getSeconds();
		var milisecond = now.getMilliseconds();
		if(month.toString().length == 1) {
			var month = '0'+month;
		}
		if(day.toString().length == 1) {
			var day = '0'+day;
		}
		if(hour.toString().length == 1) {
			var hour = '0'+hour;
		}
		if(minute.toString().length == 1) {
			var minute = '0'+minute;
		}
		if(second.toString().length == 1) {
			var second = '0'+second;
		}
		var dateTime = year+''+month+''+day+''+hour+''+minute+''+second+""+milisecond;
		return dateTime;
	}

	var totalfield = 0;

	function deletefield(div) {
		$("#"+div).remove();
	}

	function callfunc(div){
		var getnumber = $(div).attr('class');
		var lastnumber = getnumber.slice(-1);
		var discount = $('.discount_price_'+lastnumber).val();
		var normalprice = $('.normal_price_'+lastnumber).val();
		if(normalprice === '') {
			normalprice = 0;
		} else {
			normalprice = normalprice;
		}
		if(discount ==='') {
			discount = 0;
		} else {
			discount = discount;
		}
		var total = Math.ceil(parseFloat(normalprice) - parseFloat(discount));

		$('.web_price_'+lastnumber).val(total);
	}
	function callfunc2(div){
		var getnumber = $(div).attr('class');
		var lastnumber = getnumber.slice(-1);
		var discount = $('.discount_price_'+lastnumber).val();
		var normalprice = $('.normal_price_'+lastnumber).val();
		if(normalprice === '') {
			normalprice = 0;
		} else {
			normalprice = normalprice;
		}
		if(discount ==='') {
			discount = 0;
		} else {
			discount = discount;
		}

		var total = parseFloat(normalprice) - parseFloat(discount);

		var grtotal = Math.ceil(total);

		$('.web_price_'+lastnumber).val(grtotal);
	}

	$.noConflict();
	jQuery( document ).ready(function($) {
		var imagearr = ['imgupload','img_brand','img_screenshot1','img_screenshot2','img_screenshot3','img_screenshot4','img_screenshot5'];
		checkarr(imagearr);
		function checkarr(arr) {
			for (var i = 0; i < arr.length; i++) {

				var val = $("#"+arr[i]).val();
				if(val!=null&&val!=''){
					var image = "<img src='"+val+"' class='img-responsive' width='150' height='150'>";
					$("#preview_"+arr[i]).html(image);
				}

			}
		}
		$(".form_uploadimage").change(function(evt){
			evt.preventDefault();

			var formData = new FormData($(this)[0]);

			$.ajax({
				url: '{{ url("image/upload")}}',
				type: 'POST',
				data: formData,
				async: false,
				cache: false,
				contentType: false,
				enctype: 'multipart/form-data',
				processData: false,
				success: function (response,data) {
					console.log(response);
					$("#"+response.Fieldname).val(response.Data);
					var image = "<img src='"+response.Data+"' class='img-responsive' width='150' height='150'>";
					$("#preview_"+response.Fieldname).html(image);
				},error:function(response) {
					console.log(response.responseText);
				}
			});
		});
	});
</script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>

	function rendercheckbox() {
		var checked = $('input[name="istemplate"]:checked').val();
		// console.log(checked);
		if(checked == "1") {
			var html_template = $("#template1").html();

			tinymce.get("fulldesc").execCommand('mceSetContent', false, html_template);

		} else {
			tinymce.get("fulldesc").execCommand("mceSetContent",false,'กรอกรายละเอียด');
		}
	}
</script>
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
