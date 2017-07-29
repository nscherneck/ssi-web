<span class="label label-primary">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }} 
updated 
@if($event->subject == null)
	a photo that has since been deleted
@else
	a <strong><a href="/system/photo/{{ $event->subject->id }}">Photo</a></strong> for 

	<a href="{{ $event->subject->photoable->site->customer->path() }}">
		{{ $event->subject->photoable->site->customer->name }}
	</a>

	{{ env('ENTITY_SEPARATOR') }}  

	<a href="{{ $event->subject->photoable->site->path() }}">
		{{ $event->subject->photoable->site->name }}
	</a>

	{{ env('ENTITY_SEPARATOR') }}  

	<a href="{{ $event->subject->photoable->path() }}">
		{{ $event->subject->photoable->name }}
	</a>

@endif
</small>