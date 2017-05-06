<span class="label label-success">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }} 
deleted 
@if($event->subject == null)
	a work order
@else
	<a href="{{ $event->subject->path() }}">{{ $event->subject->work_order_number }}</a>
@endif
</small>