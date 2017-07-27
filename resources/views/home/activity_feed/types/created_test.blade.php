<span class="label label-success">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }} 
created 
@if($event->subject == null)
	a test that has since been deleted
@else
	<a href="/customer/{{ $event->subject->system->site->customer->id }}">{{ $event->subject->system->site->customer->name }}</a>
	 {{ env('ENTITY_SEPARATOR') }} 
	<a href="/site/{{ $event->subject->system->site->id }}">{{ $event->subject->system->site->name }}</a>
	 {{ env('ENTITY_SEPARATOR') }} 
	<a href="/system/{{ $event->subject->system->id }}">{{ $event->subject->system->name }}</a>
	 {{ env('ENTITY_SEPARATOR') }} 
	<a href="/tests/{{ $event->subject->id }}">{{ $event->subject->test_type->name }} - 
	{{ $event->subject->formatted_test_date }}</a>
@endif
</small>

