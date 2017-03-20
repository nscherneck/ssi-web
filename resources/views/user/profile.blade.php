@extends('layout')

@section('title', 'SSI-Extranet | User Profile')

@section('content')

@include('partials.nav')

<div class="container">

@include('partials.flash')

<div class="row">
	<div class="col-lg-12">
		
		<div class="panel panel-primary text-center" style="margin-top: 15px">
			<div class="panel-heading"><h4>{{ Auth::user()->full_name }}</h4></div>
		</div> <!-- END OF PANEL -->

	</div> <!-- END OF COLUMN -->

</div> <!-- END OF ROW -->

<div class="row">
	
		<div class="col-lg-3 no-gutter-right">

		<div class="panel panel-default">
		  <!-- Default panel contents -->
		  <div class="panel-heading">Account Settings</div>

		  <!-- List group -->
		  <ul class="list-group">
		    <li class="list-group-item"><small><a href="/changepassword">Change Password</a></small></li>
		  </ul>
		</div>

		
	</div> <!-- END OF COLUMN -->

	<div class="col-lg-9">

	<h4>Recent Activity</h4>
	@include('user.activity_feed.feed')

	</div> <!-- END OF COLUMN -->

</div>


</div> <!-- END OF CONTAINER -->

@stop
