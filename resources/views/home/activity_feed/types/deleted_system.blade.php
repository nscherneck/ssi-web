<span class="label label-danger">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }} 
deleted 
@if($event->subject == null)
	a system
@else
	<a href="/system/{{ $event->subject->id }}">{{ $event->subject->name }}</a>
@endif
</small>