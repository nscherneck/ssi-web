<span class="label label-success">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }} 
created 
@if($event->subject == null)
	a customer that has since been deleted
@else
	<a href="/customer/{{ $event->subject->id }}">{{ $event->subject->name }}</a>
@endif
</small>