<meta name="_token" content="{!! csrf_token() !!}"/>
@extends('layouts.backend')
<script src="{{url('/assets/jQuery/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
@section('breadcrumb')
<a class="navbar-brand" href="{{route('users/list')}}">USER LIST</a>
<i class="now-ui-icons arrows-1_minimal-right"></i>
<a class="navbar-brand" href="#" style="margin-left:10px;color:#fd7e14;">User Information</a>
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
              </div>
              <div class="card-body ">
			  <div class="row">
					<div class="col-lg-12">
						<div class="panel registration-form">
							<div class="panel-body">
								<div class="text-center">
									<div class="icon-object border-success text-success"><i class="now-ui-icons users_single-02"></i></div>
									<h5 class="content-group-lg">User Information<small class="display-block">All fields are required</small></h5>
								</div>
								<form action="{{route('users/update')}}" method="POST">
                                <input type="hidden" name="id" id="id" value="{{$list->mid}}">
									<div class="row">
										<div class="col-sm-12">
											<div class="row">
												<div class="col-md-4">
													<div class="row" id="profileimg_div">
													<img src="../{{$list->mpic}}" id="profileimg" onerror="imgError(this);">
													</div>
													<div class="form-group has-feedback">
														<label>your profile :</label>
														<input type="file" class="form-control" name="fileimg" id="fileimg" onChange="return submitForm();">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group has-feedback">
														<label>Firstname :</label>
														<input type="text" class="form-control" placeholder="Please input Firstname" name="firstname" id="firstname" required="true" value="{{$list->mname}}">
														<div class="form-control-feedback">
															<i class="icon-user-check text-muted"></i>
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group has-feedback">
														<label>Lastname :</label>
														<input type="text" class="form-control" placeholder="Please input Lastname" name="lastname" id="lastname" required="true"  value="{{$list->mlastname}}">
														<div class="form-control-feedback">
															<i class="icon-user-check text-muted"></i>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group has-feedback">
														<label>Email :</label>
														<input type="email" class="form-control" name="email" id="email" placeholder="Please input Email address" required="true"  value="{{$list->memail}}">
														<div class="form-control-feedback">
															<i class="icon-mention text-muted" id="icon-email"></i>
														</div>
														<span id="error_email"></span>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group has-feedback">
														<label>Tel :</label>
														<input type="number"  class="form-control" required="true" placeholder="Please input your number phone" name="phonenumber" id="phonenumber" min="8"  value="{{$list->mtel}}">
														<div class="form-control-feedback">

														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group has-feedback">
														<label>ID Card :</label>
														<input type="number"  class="form-control" placeholder="Please input your ID Card" name="midcard" id="midcard" min="13"  value="{{$list->midcard}}">
														<div class="form-control-feedback">

														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group has-feedback">
														<label>Role :</label>
														<select class="form-control" name="role_id" id="role_id" required="true">
															<option>Please selected type user</option>
															<option value="1" {{$list->mstatus == 1 ? 'selected="selected"' : '' }}>Admin</option>
															<option value="2" {{$list->mstatus == 2 ? 'selected="selected"' : '' }}>User</option>
														</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group has-feedback">
														<label>Brith date :</label>
														<input type="date" name="brithdate" id="brithdate" class="form-control" value="{{$list->mbirthday}}">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group has-feedback">
														<label>Gender :</label>
														<select class="form-control" name="gender" id="gender" required="true">
															<option>Please selected gender user</option>
															<option value="0" {{$list->msex == 0 ? 'selected="selected"' : '' }}>Female</option>
															<option value="1" {{$list->msex == 1 ? 'selected="selected"' : '' }}>Male</option>
														</select>
													</div>
												</div>
											</div>
											<div class="row">
											    <div class="col-md-12">
													<div class="form-group has-feedback">
														<label>Address :</label>
														<textarea class="form-control" name="address">{{$list->maddress}}</textarea>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group has-feedback">
														<label>Reset Password :</label>
														<button class="btn btn-primary">RESET</button>
													</div>
												</div>
												<div class="col-md-8">
													<div class="form-group has-feedback">
                                                        <div class="g-recaptcha" data-sitekey="6LfmDTcUAAAAAJ6Dcq8lsQTnMdbQoot0JDq_ziEZ"></div>
													</div>
												</div>
											</div>
											
											<div class="text-right">
												<!-- <button type="submit" class="btn btn-link"><i class="icon-arrow-left13 position-left"></i> Back to login form</button> -->
												<button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-10"><b><i class="icon-plus3"></i></b> Save</button>
											</div>
										</div>
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
#profileimg{position: absolute;bottom: 110px;left: 73px;width: 30%;}
</style>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
$(document).ready(function()
{	
	// Check email
	$("input[name='email']").on('keyup',function()
	{
	var email = $('#email').val();
	if(email.length > 6)
	$.ajax({
	url:'{{route("users/checkemail")}}',
	type:'POST',
	data:'email='+email,
	success:function(data){
	if (data == "1") {
		$("#error_email").html("There is already a user with that email !");
		$("#error_email").show();
		$("#email").css("border","1px solid #F90A0A");
		$(".bg-teal-400").prop("disabled", true);
		$("#icon-email").css("paddingTop","0px");
	}
	else{
		$("#error_email").hide();
		$("#email").css("border","1px solid #009900");
		$(".bg-teal-400").prop("disabled", false);
		$("#icon-email").css("paddingTop","10px");
	}	
	},
	});
	});
});
	function submitForm(){
		// Upload image 
		data = new FormData();
		data.append('file', $('#fileimg')[0].files[0]);
		var imgname  =  $('input[type=file]').val();
		var size  =  $('#fileimg')[0].files[0].size;
		var ext =  imgname.substr( (imgname.lastIndexOf('.') +1) );
		if(ext=='jpg' || ext=='jpeg' || ext=='png' || ext=='gif' || ext=='PNG' || ext=='JPG' || ext=='JPEG'){
			if(size<=1000000){
			$.ajax({
			url: "{{route('fileUploadPost')}}",
			type: "POST",
			data: data,
			enctype: 'multipart/form-data',
			processData: false,  // tell jQuery not to process the data
			contentType: false   // tell jQuery not to set contentType
			}).done(function(data) {
			console.log(data.path)
			$('#profileimg_div').html('<img src="../'+data.path+'" id="profileimg"><input type="hidden" name="mpic" value="'+data.path+'">')
			});
			return false;
			}//end size
			else
			{
				imgclean.replaceWith( imgclean = imgclean.clone( true ) );//Its for reset the value of file type
				alert('Sorry File size exceeding from 1 Mb');
			}
		}//end FILETYPE
		else
		{
			imgclean.replaceWith( imgclean = imgclean.clone( true ) );
			alert('Sorry Only you can uplaod JPEG|JPG|PNG|GIF file type ');
		}
    }
    function imgError(image) {
				image.onerror = "";
				image.src = "../images/default-user-image.png";
			  image.style = "padding-right:10px";
				return true;
	}
</script>
