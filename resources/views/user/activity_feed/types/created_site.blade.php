<span class="label label-success">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }} 
created 
@if($event->subject == null)
	a site that has since been deleted
@else
	<a href="{{ $event->subject->customer->path() }}">{{ $event->subject->customer->name }}</a>
	 {{ env('ENTITY_SEPARATOR') }}  
	<a href="{{ $event->subject->path() }}">{{ $event->subject->name }}</a>
@endif
</small>
