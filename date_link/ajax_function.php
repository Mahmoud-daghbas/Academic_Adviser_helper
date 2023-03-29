<?php
require_once 'opertion_data_link.php';
  if (isset($_POST['add_data_link'])) 
  {
   $data= $_POST['data'];
   add_data_link($data);
  }
?>