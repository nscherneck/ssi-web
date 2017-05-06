@if (session()->has('flash_message'))
  <div class="alert alert-dismissible alert-{{ strtolower(session('flash_message_level')) }} text-center" role="alert" style="margin-top:20px; margin-bottom:0;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">
      &times;</span></button>
    <strong>{{ (session('flash_message')) }}</strong> {{ (session('flash_secondary_message')) }}
  </div>

  <script>
  $(".alert").fadeTo(4000, 500).slideUp(500, function(){
    $(".alert").slideUp(500);
  });
  </script>
@endif
