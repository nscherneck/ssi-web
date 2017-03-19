	<ul class="list-group">
		@foreach($activityItems as $event)
			<li class="list-group-item">

				@php
					$viewName = 'user.activity_feed.types.' . 
					formatActivityModelName($event->description, $event->subject_type);
				@endphp

				@include($viewName)

			</li>
		@endforeach
	</ul>