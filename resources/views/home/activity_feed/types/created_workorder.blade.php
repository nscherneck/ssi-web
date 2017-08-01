<span class="label label-success">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }} 
created a work order  
@if ($event->subject == null)
  a work order that has since been deleted
@else
	<a href="{{ $event->subject->path() }}">{{ $event->subject->work_order_number }} </a>
	for 
	<strong>
	<a href="{{ $event->subject->site->customer->path() }}">
	{{ $event->subject->site->customer->name }}
	</a>
	</strong>
	{{ config('constants.SEPARATOR') }}  
	<strong>
	<a href="{{ $event->subject->site->path() }}">
	{{ $event->subject->site->name }}
	</a>
	</strong>
@endif
</small>