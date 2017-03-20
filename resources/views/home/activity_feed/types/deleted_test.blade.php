<span class="label label-danger">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }} 
deleted 
@if($event->subject == null)
	a test
@else
	<a href="/tests/{{ $event->subject->id }}">{{ $event->subject->test_type->name }} - 
{{ $event->subject->formatted_test_date }}</a>
@endif
</small>