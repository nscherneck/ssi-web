<span class="label label-primary">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }} 
updated 

@if($event->properties['attributes']['notes'] != $event->properties['old']['notes'])
	the <strong>notes</strong> for 
@endif

@if($event->subject == null)
	a system that has since been deleted
@else
	<a href="/customer/{{ $event->subject->site->customer->id }}">{{ $event->subject->site->customer->name }}</a>
	 / 
	<a href="/site/{{ $event->subject->site->id }}">{{ $event->subject->site->name }}</a>
	 / 
	<a href="/system/{{ $event->subject->id }}">{{ $event->subject->name }}</a>
@endif
</small>