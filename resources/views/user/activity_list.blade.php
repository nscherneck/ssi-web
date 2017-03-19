	<ul class="list-group">
		@foreach($sortedActivityItems as $event)
		<li class="list-group-item">
			{{ $event->created_at->diffForHumans() }}, 
			{{ $event->causer->first_name }} {{ $event->description }} a 
			{{ $event->subject_type }}
		</li>
		@endforeach
	</ul>