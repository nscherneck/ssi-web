<span class="label label-primary">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }} 
updated 

@if($event->subject == null)
	a work order that has since been deleted
@else
	<a href="{{ $event->subject->path() }}">{{ $event->subject->work_order_number }}</a>
@endif
</small>