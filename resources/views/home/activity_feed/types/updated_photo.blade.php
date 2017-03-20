<span class="label label-primary">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }} 
updated 
@if($event->subject == null)
	a photo that has since been deleted
@else
	a <strong><a href="/system/photo/{{ $event->subject->id }}">Photo</a></strong> for 

	<strong>
	<a href="/customer/{{ $event->subject->photoable->site->customer->id }}">
	{{ $event->subject->photoable->site->customer->name }}
	</a></strong> -- 

	<strong>
	<a href="/site/{{ $event->subject->photoable->site->id }}">
	{{ $event->subject->photoable->site->name }}
	</a></strong> -- 

	<strong>
	<a href="/system/{{ $event->subject->photoable->id }}">
	{{ $event->subject->photoable->name }}
	</a>
	</strong>

@endif
</small>