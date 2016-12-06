<?php

use DB;

  if(isset($_POST['manufacturer_id'])) {

   $manufacturer_id = $_POST['manufacturer_id'];
   $components = DB::table('components')->where('manufacturer_id', '=', '{$manufacturer_id}');
   while($components->model) {
    echo "<option>"  .$components->model . "</option>";
   }
   return false;
  }


?>
