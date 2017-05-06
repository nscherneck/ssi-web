@extends('layout')

@section('title', 'SSI-Extranet | Work Orders')

@section('content')

@include('partials.nav')

<div class="container-fluid">

  @include('partials.flash')

  <div class="row">
    <div class="col-lg-10 col-lg-offset-1">
      


  	<div class="titleBar" style="margin-top: 015px">
  	    <p>Work Orders ({{ $workOrders->count() }})</p>
  	</div>
  	
  	<div class="table-responsive">

  	  <table class="table table-condensed">
  	  <thead>
  	    <tr>
          <th><small>WO #</small></th>
  	      <th><small>Customer</small></th>
  	      <th><small>Site</small></th>
  	      <th><small>Work Order Title</small></th>
          <th><small>Assigned To</small></th>
  	      <th><small>Type</small></th>
          <th><small>Status</small></th>
  	      <th><small>Billing</small></th>
  	      <th><small>Created</small></th>
  	      <th><small>Created By</small></th>
  	    </tr>
  	  </thead>

  	  <tbody>
  	    @foreach($workOrders as $workOrder)
  	      <tr>

            <td><small>
            <a href="{{ $workOrder->path() }}">
            {{ $workOrder->work_order_number }} 
            </a>
            </small></td>

  	        <td><small>
  	        <a href="/customer/{{ $workOrder->site->customer->id }}">
  	        {{ $workOrder->site->customer->name }} 
  	        </a>
  	        </small></td>

  	        <td><small>
  	        <a href="/site/{{ $workOrder->site->id }}">
  	        {{ $workOrder->site->name }}
  	        </a>
  	        </small></td>

  	        <td><small>
  	        {{ $workOrder->title }}
  	        </small></td>

            <td><small>
            {{ $workOrder->assignedTechnician->first_name }}
            </small></td>

  	        <td><small>
  	        {{ $workOrder->type->name }}
  	        </small></td>

            <td><small>
            {{ $workOrder->status->status }}
            </small></td>

  	        <td><small>
  	        {{ $workOrder->billingStatus->status }}
  	        </small></td>

  	        <td><small>
  	        {{ $workOrder->created_at->diffForHumans() }}
  	        </small></td>

  	        <td class="text-center"><small>
  	        {{ $workOrder->createdBy->first_name }}
  	        </small></td>

  	      </tr>
  	    @endforeach
  	  </tbody>

  	  </table>
  	</div> <!-- END OF RESPONSIVE TABLE -->

    </div>
  </div>    

</div> <!--          END OF CONTAINER         -->


@stop
