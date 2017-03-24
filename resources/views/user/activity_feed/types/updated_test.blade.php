<span class="label label-primary">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }} 
updated 
<a href="/customer/{{ $event->subject->system->site->customer->id }}">{{ $event->subject->system->site->customer->name }}</a>
 / 
<a href="/site/{{ $event->subject->system->site->id }}">{{ $event->subject->system->site->name }}</a>
 / 
<a href="/system/{{ $event->subject->system->id }}">{{ $event->subject->system->name }}</a>
 / 
<a href="/tests/{{ $event->subject->id }}">{{ $event->subject->test_type->name }} - 
{{ $event->subject->formatted_test_date }}</a>
</small>
