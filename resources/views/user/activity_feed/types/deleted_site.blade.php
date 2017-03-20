<span class="label label-danger">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }} 
deleted 
@if($event->subject == null)
	a site
@else
	<a href="/site/{{ $event->subject->id }}">{{ $event->subject->name }}</a>
@endif
</small>