<span class="label label-success">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }} 
created 
@if($event->subject == null)
	a system that has since been deleted
@else
	<a href="{{ $event->subject->site->customer->path() }}">{{ $event->subject->site->customer->name }}</a>
	 {{ config('constants.SEPARATOR') }}
	<a href="{{ $event->subject->site->path() }}">{{ $event->subject->site->name }}</a>
	 {{ config('constants.SEPARATOR') }}  
	<a href="{{ $event->subject->path() }}">{{ $event->subject->name }}</a>
@endif
</small>