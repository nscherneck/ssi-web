@extends('layout')

@section('title', 'SSI-Extranet | User Profile')

@section('content')

@include('partials.nav')

<div class="container">

@include('partials.flash')

<ol class="breadcrumb small" style="margin-top: 15px">
  <li><a href="/profile">Profile</a></li>
  <li>Change Password</li>
</ol>

<div class="row">

	<div class="col-lg-3">

	</div> <!-- END OF COLUMN -->

	<div class="col-lg-6">

		<div class="panel panel-default">
		  <div class="panel-body">
		  	
		    <form method="POST" action="/changepassword">
		    {{ csrf_field() }}

			  <div class="form-group">
			    <input type="password" class="form-control" name="password" id="password" aria-describedby="passwordHelp" placeholder="Current Password">
			  </div>

			  <div class="form-group">
			    <input type="password" class="form-control" name="new_password" id="new_password" aria-describedby="new_passwordHelp" placeholder="New Password">
			  </div>

			  <div class="form-group">
			    <input type="password" class="form-control" name="new_password_confirmation" id="new_password_confirmation" aria-describedby="new_password_confirmation_help" placeholder="Confirm New Password">
			  </div>

			  <button type="submit" class="btn btn-primary">Submit</button>
			</form>

		  </div> <!-- END OF PANEL BODY -->
		</div> <!-- END OF PANEL -->

		@if(isset($errors))
			@foreach ($errors->all() as $message)
			    <span style="color: #C80000"><small>{{ $message }}</small></span>
			@endforeach
		@endif


	</div> <!-- END OF COLUMN -->

	<div class="col-lg-4">

	</div> <!-- END OF COLUMN -->

</div> <!-- END OF ROW -->

</div> <!-- END OF CONTAINER -->

@stop
