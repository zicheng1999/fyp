@extends('frontend.main_master')
@section('content')
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Register</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
			<div class="col-md-2 col-sm-3 sign-in"></div>

<!-- create a new account -->
<div class="col-md-8 col-sm-6 create-new-account">
	<h4 class="checkout-subtitle">Create a new account</h4>
	<p class="text title-tag-line">Create your new account.</p>

    <form method="POST" action="{{ route('register') }}" 	>
        @csrf
        <div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">Name <span>*</span></label>
		    <input type="text" id="name" name="name" class="form-control unicase-form-control text-input" >
			<span class="feedback-name">
				<strong></strong>
			</span>
		</div>
		<div class="form-group">
	    	<label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
	    	<input type="email" id="email" name="email" class="form-control unicase-form-control text-input" >
			<span class="feedback-email" style="color: limegreen;">
				<strong></strong>
			</span>
	  	</div>

        <div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">Own Phone Number <span>*</span></label>
		    <input type="text" id="phone" name="phone" class="form-control unicase-form-control text-input" >
			@error('phone')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
		</div>

		<div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">Referral's Phone Number <span>*</span></label>
		    <input type="text" id="referral_phone" name="referral_phone" class="form-control unicase-form-control text-input" >
			@error('referral_phone')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
		</div>

        <div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">Password <span>*</span></label>
		    <input type="password" id="password" name="password" class="form-control unicase-form-control text-input">
			@error('password')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
		</div>
         <div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">Confirm Password <span>*</span></label>
		    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control unicase-form-control text-input">
			@error('password_confirmation')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
		</div>
	  	<button id="btn_register" type="submit" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
	</form>
	
	
</div>	
<div class="col-md-2 col-sm-3 sign-in"></div>

<!-- create a new account -->			</div><!-- /.row -->
		</div><!-- /.sigin-in-->

</div><!-- /.body-content -->

<h1 id="result">Result</h1>

<script>
$(document).ready(function() {

$("#email").focusout(function(event){
	console.log('email focusout');

	let email = $("input[name=email]").val();
	let _token   = $('meta[name="csrf-token"]').attr('content');

	if(email == ""){
		$(".feedback-email").css("color", "red");
		$('.feedback-email').text('Email must be filled in.').show();
		//$("#btn_register").prop("disabled",true);
		return;
	} // end if-1

	if( !validateEmail(email)) { 
		$('#result').text('Result: ' + validateEmail(email))
		$(".feedback-email").css("color", "red");
		$('.feedback-email').text('Invalid Email').show();
		return;
	} // end if-2

	$('.feedback-email').text('').hide();

	$.ajax({
		url: "/register/checkemail",
        type:"POST",
        data:{
          email:email,
          _token: _token
        },
        success:function(response){
			$('#result').text('Result: ' + response.msg);

          if(response.msg == "duplicated") {
			$(".feedback-email").css("color", "red");
			$('.feedback-email').text('This email has been registered before, please use another email.').show();
			$("#btn_register").prop("disabled",true);
          }else{
			$(".feedback-email").css("color", "limegreen");
			$('.feedback-email').text('Email address is acceptable.').show();
		  } // end else
		} // end success
	}); // end ajax

}); // end email focusout

}); // end doc

function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test($email);
}
</script>

@endsection