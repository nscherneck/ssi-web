<span class="label label-primary">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }} 
updated  

@if($event->properties['attributes']['notes'] != $event->properties['old']['notes'])
	the <strong>notes</strong> for 
@endif

@if($event->subject == null)
	a customer that has since been deleted
@else
	<a href="{{ $event->subject->path() }}">{{ $event->subject->name }}</a>
@endif
</small>