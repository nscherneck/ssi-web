<span class="label label-primary">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }} 
logged in 
@include('partials.icons.user-icon')
</small>

