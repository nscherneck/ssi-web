@if (session()->has('flash_message'))
  <div class="Alert Alert--{{ ucwords(session('flash_message_level')) }}">
  {{ (session('flash_message')) }}
  </div>
@endif
