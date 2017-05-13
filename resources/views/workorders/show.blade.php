@extends('layout')

@section('title', 'SSI-Extranet | Work Order')

@section('content')

@include('partials.nav')

<div class="container" id="app">

  @include('partials.flash')

  <br>
  <ol class="breadcrumb small">
    <li><a href="/workorders">Work Order Queue</a></li>
    <li>{{ $workOrder->work_order_number }}</li>
  </ol>

<div class="row">

    <div class="col-lg-8 col-lg-offset-2">

    <workorder :attributes="{{ $workOrder }}" inline-template v-cloak>

		<div>
			<div class="panel panel-primary">
			  <div class="panel-heading text-center">

	      		Work Order | <strong>{{ $workOrder->work_order_number }}</strong>
			
			  </div>
			
			  <div class="panel-body" style="padding-top: 0px">

				<div class="row" style="background-color: #F8F8F8">

					  <div class="row">
					  	<div class="col-lg-4 text-center pt-05 pb-05">
					  		<strong class="text-primary">Customer</strong>
					  	</div>
					  	<div class="col-lg-4 text-center pt-05 pb-05">
					  		<strong class="text-primary">Site</strong>
					  	</div>
					  	<div class="col-lg-4 text-center pt-05 pb-05">
					  		<strong class="text-primary">Created</strong>
					  	</div>
					  </div>

				</div>
			
		      <div class="row pb-1">


			      <div class="col-lg-4 text-center mt-1">

					<a href="/customer/{{ $workOrder->site->customer->id }}" target="blank">
					{{ $workOrder->site->customer->name }} 
					</a>

			      </div>

			      <div class="col-lg-4 text-center mt-1">

			      	<a href="/site/{{ $workOrder->site->id }}" target="blank">
			      	{{ $workOrder->site->name }}
			      	</a>
			      	<br>
			      	{{ $workOrder->site->address1 }}
			      	<br>
			      	{{ $workOrder->site->city }}, {{ $workOrder->site->state->abbreviated }} {{ $workOrder->site->zip }}
			      	<br><br>
			      	{!! $workOrder->site->getGoogleMapsHyperlink('Google Map') !!}

			      </div>

			      <div class="col-lg-4 text-center mt-1">

			      	{{ $workOrder->created_at->timezone('America/Los_Angeles')->format('l, F j, Y - g:ha') }}

			      </div>

			
		      </div>

		      <div class="row" style="background-color: #F8F8F8">

		      	  <div class="row">
		      	  	<div class="col-lg-4 text-center pt-05 pb-05">
		      	  		<strong class="text-primary">Assigned To</strong>
		      	  	</div>
		      	  	<div class="col-lg-4 text-center pt-05 pb-05">
		      	  		<strong class="text-primary">Status</strong>
		      	  	</div>
		      	  	<div class="col-lg-4 text-center pt-05 pb-05">
		      	  		<strong class="text-primary">Billing</strong>
		      	  	</div>
		      	  </div>

		      </div>
			
			      <div class="row pt-1">
			      	<div class="col-lg-4 text-center mb-1">
			      		{{ $workOrder->assignedTechnician->full_name }}
			      	</div>
			      	<div class="col-lg-4 text-center mb-1">
				      	{{ $workOrder->status->status }}
			      	</div>
			      	<div class="col-lg-4 text-center mb-1">
			      		{{ $workOrder->billingStatus->status }}
			      	</div>
			      </div>

			      <div class="row" style="background-color: #F8F8F8">
	      	  		<div class="text-center pt-05 pb-05">
	      	  			<strong class="text-primary">Task</strong>
	      	  		</div>
			      </div>

			      <div class="pt-1 pb-1" v-if="editing">
			      	<div class="form-group">
			      		<input type="text" class="form-control" v-model="title">
			      	</div>
			      </div>

			      <div class="doc-content pt-1 pb-1" v-else v-text="title">
			          {{ $workOrder->title }}
			      </div>

			      <div class="row" style="background-color: #F8F8F8">
	      	  		<div class="text-center pt-05 pb-05">
	      	  			<strong class="text-primary">Scope of Work</strong>
	      	  		</div>
			      </div>

					<div class="pt-1 pb-1" v-if="editing">
						<div class="form-group">
							<textarea class="form-control" v-model="scope_of_work" style="resize: none;"></textarea>
						</div>
					</div>


			      <div class="doc-content pt-1 pb-1" v-else v-text="scope_of_work">
			          {!! nl2br(e($workOrder->scope_of_work)) !!}
			      </div>
						
			  </div>
			</div>
			
			<div class="text-center" v-if="editing">

				<div class="flex">
					<button class="btn btn-sm btn-primary pr-05" @click="update">Save</button>
					<button class="btn btn-sm btn-default" @click="editing = false">Cancel</button>
				</div>

			</div>
			<div class="text-center" v-else>
				<button class="btn btn-sm btn-primary" @click="editing = true">Edit Work Order</button>
			</div>

		</div>

    </workorder>

    </div>
</div>

</div> <!--          END OF CONTAINER         -->


@stop
