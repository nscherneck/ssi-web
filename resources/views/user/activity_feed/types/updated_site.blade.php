<span class="label label-primary">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }} 
updated  

@if($event->properties['attributes']['notes'] != $event->properties['old']['notes'])
	the <strong>notes</strong> for 
@endif

@if($event->subject == null)
	a site that has since been deleted
@else
	<a href="/customer/{{ $event->subject->customer->id }}">{{ $event->subject->customer->name }}</a>
	 / 
	<a href="/site/{{ $event->subject->id }}">{{ $event->subject->name }}</a>
@endif
</small>