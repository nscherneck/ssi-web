<span class="label label-primary">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }} 
updated 

@if ($event->properties['attributes']['notes'] != $event->properties['old']['notes'])
	the <strong>notes</strong> for 
@endif

@if ($event->subject == null)
	a system that has since been deleted
@else
	<a href="{{ $event->subject->site->customer->path() }}">{{ $event->subject->site->customer->name }}</a>
	 {{ env('ENTITY_SEPARATOR') }} 
	<a href="{{ $event->subject->site->path() }}">{{ $event->subject->site->name }}</a>
	 {{ env('ENTITY_SEPARATOR') }} 
	<a href="{{ $event->subject->path() }}">{{ $event->subject->name }}</a>
@endif
</small>