<span class="label label-primary">{{ $event->created_at->diffForHumans() }}</span>
<small>
{{ $event->causer->first_name }} 
logged in 
<i class="fa fa-user-circle" aria-hidden="true"></i>
</small>

