@extends('layout')

@section('title', 'SSI-Extranet | Work Order')

@section('head')

<script>

function getSites(val)
{

 $.ajax({
 type: 'post',
 url: "/get_sites",
 data: {
  customer_id:val,
  _token: "{{ csrf_token() }}"
 },
 dataType: "json",

 success: function (data) {
  console.log(data);
  var select_site = document.getElementById("sites");

  // clear out previous options
  select_site.innerHTML = "";

  for (var i=0; i<data.length; i++) {
      select_site.options[select_site.options.length] = new Option(data[i].name, data[i].id);
      var opts = (select_site.childNodes);
      opts[i].setAttribute("data-parent", i);
      opts[i].setAttribute("class", "site_option");
  }

}

});

}

</script>

@stop

@section('content')

@include('partials.nav')

<div class="container-fluid">

  @include('partials.flash')
  <br>
  <div class="row">
	  	
	  <div class="col-lg-6 col-lg-offset-3">
	  	<form action="/workorders" method="POST" role="form">
	  	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	  		<legend>Create a New Work Order</legend>

	  		<div class="row">
	  		  <div class="col-lg-6">
		  		<div class="form-group">
		  			<select class="form-control" id="customers" name="customer_id" 
		  			onchange="getSites(this.value);">
			  			<option value="" disabled selected>Select Customer</option>
			  			@foreach ($customers as $customer)
			  			    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
		  			    @endforeach
		  			</select>
		  		</div>	  		  	
	  		  </div>
	  		  <div class="col-lg-6">
	  		  	<select class="form-control" id="sites" name="site_id">
			  			<option value="" disabled selected>Select Site</option>	  		  	
	  		  	</select>
	  		  </div>
	  		</div> <!-- end of row -->

	  		<div class="row">
	  			<div class="col-lg-6">
					<select class="form-control" id="technician" name="assigned_to">
						<option value="" disabled selected>Assign Technician</option>	 
						@foreach ($technicians as $tech)
							<option value="{{ $tech->id }}">{{ $tech->full_name }}</option>
						@endforeach  	
					</select>
	  			</div>
	  			<div class="col-lg-6">
	  				<select class="form-control" id="type_id" name="type_id">
	  					<option value="" disabled selected>Work Order Type</option>	 
	  					@foreach ($workOrderTypes as $type)
	  						<option value="{{ $type->id }}">{{ $type->name }}</option>
	  					@endforeach  	
	  				</select>
	  			</div>
	  		</div>
	  		<br>
	  	
	  		<div class="form-group">
	  			<input type="text" class="form-control" name="title" 
	  			placeholder="Work Order Title">
	  		</div>
	  	
	  		<div class="form-group">
	  			<input type="text" class="form-control" name="customer_purchase_order" 
	  			placeholder="Customer purchase order or reference">
	  		</div>
	  	
	  		<div class="form-group">
	  			<input type="text" class="form-control" name="point_of_contact" 
	  			placeholder="Point of contact (i.e. Rick Myers, (503) 555-5555)">
	  		</div>

	  		<div class="form-group">
	  			<textarea class="form-control" name="scope_of_work" rows="6" 
	  			placeholder="Scope of work..."></textarea>
	  		</div>  		
	  	
	  		<button type="submit" class="btn btn-primary">Create Work Order</button>
	  	</form>
	  </div>
  </div> <!-- end of row -->

</div> <!--          END OF CONTAINER         -->


@stop