<span class="label label-danger">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }} deleted a photo 
</small>