<?php
  include "../login/config.php";

  //function add adcademic advisor;
function add_data_link($add_data)
{
 global $conn;

$insert="INSERT INTO `table_links`(`Id_link`, `Id_Student`, `Id_Advisor`, `link_date`, `Status_Join`) VALUES".$add_data;
        $query=mysqli_query($conn,$insert);
     if(!$query)
          echo '0';
      else
       echo '1';
 

}?>