<span class="label label-success">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }} 
created 
@if($event->subject == null)
	a test that has since been deleted
@else
	<a href="{{ $event->subject->system->site->customer->path() }}">
		{{ $event->subject->system->site->customer->name }}
	</a>
	 {{ env('ENTITY_SEPARATOR') }} 
	<a href="{{ $event->subject->system->site->path() }}">
		{{ $event->subject->system->site->name }}
	</a>
	 {{ env('ENTITY_SEPARATOR') }} 
	<a href="{{ $event->subject->system->path() }}">
		{{ $event->subject->system->name }}
	</a>
	 {{ env('ENTITY_SEPARATOR') }} 
	<a href="{{ $event->subject->path() }}">
		{{ $event->subject->test_type->name }} - 
		{{ $event->subject->formatted_test_date }}
	</a>
@endif
</small>

