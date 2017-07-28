<div class="row">
	<div class="col-lg-8">
		<span class="label label-success">{{ $event->created_at->diffForHumans() }}</span>
		<span>
			<small>
			&nbsp;{{ $event->causer->first_name }} 
			added 
			@if ($event->subject == null)
				a photo that has since been deleted
			@else
				a photo to 
				<strong>
					<a href="{{ $event->subject->photoable->site->customer->path() }}">
					{{ $event->subject->photoable->site->customer->name }}
					</a>
				</strong> 
				{{ env('ENTITY_SEPARATOR') }}
				<strong>
					<a href="{{ $event->subject->photoable->site->path() }}">
					{{ $event->subject->photoable->site->name }}
					</a>
				</strong> 
				{{ env('ENTITY_SEPARATOR') }}
				<strong>
					<a href="{{ $event->subject->photoable->path() }}">
					{{ $event->subject->photoable->name }}
					</a>
				</strong>
			@endif
			</small>
		</span>
	</div>
	<div class="col-lg-4 right-justify">
		<a href="/system/photo/{{ $event->subject->id }}">
			<img src="{{ env('SYSTEM_PHOTO_THUMB_URL') }}{{ $event->subject->file_name }}.{{ $event->subject->ext }}" 
			alt="{{ $event->subject->caption }}" 
			width="150" 
			height="auto"
			/>
		</a>
	</div>
</div>