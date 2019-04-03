@if(!session('user_tz_attempted'))
  <?php
    session()->put('user_tz_attempted', true);
  ?>
  <script>
    var dtz = -(new Date().getTimezoneOffset()) / 60;
    document.cookie = 'user_tz_off='+dtz+';max-age='+(60*60*24).toString()+';path=/';
    location.reload();
  </script> 
@endif