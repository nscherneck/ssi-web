@extends('layout')

@section('title', 'SSI-Extranet | Work Order')

@section('content')

@include('partials.nav')

<div class="container">

  @include('partials.flash')

  <br>
  <ol class="breadcrumb small">
    <li><a href="/workorders">Work Order Queue</a></li>
    <li>{{ $workOrder->work_order_number }}</li>
  </ol>

<div class="row">

    <div class="col-lg-8 col-lg-offset-2">

	    <div class="panel panel-default">
	      <div class="panel-heading text-center">

		      <div class="row">

		      	<div class="col-lg-4 text-left">
			      	<i class="fa fa-circle" aria-hidden="true"></i>
		      	</div>

		      	<div class="col-lg-4 text-center">
		      		Work Order | <strong>{{ $workOrder->work_order_number }}</strong>

		      	</div>
		      	
		      	<div class="col-lg-4">
		      		
		      	</div>

		      </div>
	      </div>

	      <div class="panel-body">

		      <div class="row">

			      <div class="col-lg-6 text-center">
				      <strong>Customer - </strong>
				      <a href="/customer/{{ $workOrder->site->customer->id }}">
				      {{ $workOrder->site->customer->name }} 
				      </a>
				      <br>
				      <strong>Site - </strong>
				      <a href="/site/{{ $workOrder->site->id }}">
				      {{ $workOrder->site->name }}
				      </a>
		          </div>

			      <div class="col-lg-6 text-center">
				      {{ $workOrder->site->address1 }} 
				      <br>
				      {{ $workOrder->site->city }}, {{ $workOrder->site->state->abbreviated }} {{ $workOrder->site->zip }}
				      <br>
				      {!! $workOrder->site->getGoogleMapsHyperlink('Google Map') !!}
		          </div>

	          </div>

	          <hr>

	          <div class="row">

	          	<div class="col-lg-6 text-center">
	          		<strong>Assigned To - </strong>{{ $workOrder->assignedTechnician->full_name }}
	          	</div>

	          	<div class="col-lg-6 text-center">
	          		<strong>Created - </strong>
	          		{{ $workOrder->created_at->timezone('America/Los_Angeles')->format('l, F j, Y - g:ha') }}
	          		<br>
	          		<strong>By - </strong>
	          		{{ $workOrder->createdBy->full_name }}
	          		<br>
	          	</div>
	          	
	          </div>
	          <hr>
	          <div class="row">

	          	<div class="col-lg-6 text-center">
	          		<strong>Status - </strong>
	          		{{ $workOrder->status->status }}
	          	</div>

	          	<div class="col-lg-6 text-center">
	          		<strong>Billing - </strong>
	          		{{ $workOrder->billingStatus->status }}
	          		<br>
	          	</div>

	          </div>

	          <hr class="doc">
	          <div class="level">
	          	<span class="flex">
	          		<i>Task</i>
	          	</span>
	          </div>
	          <div class="doc-content text-center">
		          {{ $workOrder->title }}
	          </div>

	          <hr class="doc">
	          <div class="level">
	          	<span class="flex">
	          		<i>Scope of Work</i>
	          	</span>
	          </div>
	          <div class="doc-content text-center">
		          {!! nl2br(e($workOrder->scope_of_work)) !!}
	          </div>
	          <hr>

	      </div>
	    </div>

        <div class="text-center">
            <small>
        	<a href="#">Edit Work Order</a> | <a href="#">Close Work Order</a>
        	</small>
        </div>

    </div>
</div>

</div> <!--          END OF CONTAINER         -->


@stop
