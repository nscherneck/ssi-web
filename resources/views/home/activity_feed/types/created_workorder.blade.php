<span class="label label-success">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }} 
created work order  
@if($event->subject == null)
  a work order that has since been deleted
@else
	<a href="{{ $event->subject->path() }}">{{ $event->subject->work_order_number }} </a>
	for 
	<strong>
	<a href="/customer/{{ $event->subject->site->customer->id }}">
	{{ $event->subject->site->customer->name }}
	</a>
	</strong>
	 -- 
	 <strong>
	<a href="/site/{{ $event->subject->site->id }}">
	{{ $event->subject->site->name }}
	</a>
	</strong>

@endif
</small>