<span class="label label-danger">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }}
deleted
@if($event->subject == null)
	a test
@else
	<a href="{{ $event->subject->path() }}">{{ $event->subject->testType->name }} -
{{ $event->subject->formatted_test_date }}</a>
@endif
</small>
