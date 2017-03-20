<span class="label label-danger">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }} 
deleted 
@if($event->subject == null)
	a customer
@else
	<a href="/customer/{{ $event->subject->id }}">{{ $event->subject->name }}</a>
@endif
</small>