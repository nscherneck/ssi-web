<span class="label label-danger">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }} 
deleted 
@if($event->subject == null)
	a system
@else
	<a href="{{ $event->subject->path() }}">{{ $event->subject->name }}</a>
@endif
</small>