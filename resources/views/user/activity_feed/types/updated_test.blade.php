<span class="label label-primary">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }} 
updated 
<a href="{{ $event->subject->system->site->customer->path() }}">
	{{ $event->subject->system->site->customer->name }}
</a>

{{ config('constants.SEPARATOR') }}

<a href="{{ $event->subject->system->site->path() }}">
	{{ $event->subject->system->site->name }}
</a>

{{ config('constants.SEPARATOR') }}

<a href="{{ $event->subject->system->path() }}">
	{{ $event->subject->system->name }}
</a>

{{ config('constants.SEPARATOR') }}

<a href="{{ $event->subject->path() }}">
	{{ $event->subject->test_type->name }} - 
	{{ $event->subject->formatted_test_date }}
</a>
</small>

