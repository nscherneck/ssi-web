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

	<div class="col-lg-10 col-lg-offset-1">

			<legend>Work Order | <strong>{{ $workOrder->work_order_number }}</strong></legend>

			<div class="row">
				<div class="col-lg-8">

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="customer_id" class="work-order-label">Customer</label>
								<input type="text" id="customer_id" class="form-control"
									value="{{ $workOrder->site->customer->name }}" disabled>
							</div>
						</div> <!-- /6-COLUMN -->
						<div class="col-lg-6">
							<div class="form-group">
								<label for="site_id" class="work-order-label">Site</label>
								<input type="text" id="site_id" class="form-control" value="{{ $workOrder->site->name }}" disabled>
							</div>
						</div> <!-- /6-COLUMN -->
					</div> <!-- /ROW -->

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="assigned_to" class="work-order-label">Assigned Technician</label>
								<input type="text" id="assigned_to" class="form-control" value="{{ $workOrder->assignedTechnician->full_name }}" disabled>
							</div>
						</div> <!-- /6-COLUMN -->
						<div class="col-lg-6">
							<div class="form-group">
								<label for="work_order_type_id" class="work-order-label">Work Order Type</label>
								<input type="text" class="form-control" value="{{ $workOrder->type->name }}" disabled>
							</div>
						</div> <!-- /6-COLUMN -->
					</div> <!-- /ROW -->

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="status_id" class="work-order-label">Status</label>
								<input type="text" id="status_id" class="form-control"
									value="{{ $workOrder->status->status }}" disabled>
							</div>
						</div> <!-- /6-COLUMN -->
						<div class="col-lg-6">
							<div class="form-group">
								<label for="work_order_billing_status_id" class="work-order-label">Billing Status</label>
								<input type="text" id="work_order_billing_status_id" class="form-control"
									value="{{ $workOrder->billingStatus->status }}" disabled>
							</div>
						</div> <!-- /6-COLUMN -->
					</div> <!-- /ROW -->

					<!-- TITLE AREA -->
					<div class="form-group">
						<label for="title" class="work-order-label">Title</label>
						<input type="text" id="title" class="form-control"
							value="{{ $workOrder->title }}" disabled>
					</div>

					<!-- SCOPE OF WORK AREA -->
					<div class="form-group">
						<label for="scope_of_work" class="work-order-label">Scope of Work</label>
						<textarea id="scope_of_work" class="form-control no-resize" rows="6" disabled>{{ $workOrder->scope_of_work }}</textarea>
					</div>

					@if ($workOrder->resolution)
					<!-- RESOLUTION AREA -->
					<div class="form-group">
						<label for="resolution" class="work-order-label">Resolution</label>
						<textarea id="resolution" class="form-control no-resize" rows="6" disabled>{{ $workOrder->resolution }}</textarea>
					</div>
					@endif

					<!-- BUTTONS AREA -->
					<div class="text-center">
						<button type="" class="btn btn-xs btn-primary">Edit</button>
						&nbsp;
						<button type="" class="btn btn-xs btn-primary">Close</button>
						&nbsp;
						<button type="" class="btn btn-xs btn-danger">Delete</button>
					</div>

				</div> <!-- /8-COLUMN -->
				<div class="col-lg-4">
					<label for="work_order_meta" class="work-order-label">Work Order Info</label>
					<div class="well">
						<small>
							<strong>Added: </strong>January 1, 2001<br>
							<strong>Added By: </strong>Person McPerson<br>
						</small>
					</div>

				</div> <!-- /4-COLUMN -->
			</div> <!-- ROW -->
	</div> <!-- /COLUMN WITH OFFSET -->
</div> <!-- /CONTAINER -->

@stop
