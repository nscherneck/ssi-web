<span class="label label-success">{{ $event->created_at->diffForHumans() }}</span>
<small>
@if($event->causer_id == null)
  null user
@else
  {{ $event->causer->first_name }} 
@endif
created 
@if($event->subject == null)
  a customer that has since been deleted
@else
	<a href="{{ $event->subject->path() }}">{{ $event->subject->name }}</a>
@endif
</small>