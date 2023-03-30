<?php
  include "../login/config.php";

  //function add adcademic advisor;
function add_data_link($add_data)
{
 global $conn;

$insert="INSERT INTO `table_links`( `Id_Student`, `Id_Advisor`, `link_date`, `Status_Join`) VALUES ".$add_data." ON DUPLICATE KEY UPDATE  Id_Student = VALUES(Id_Student), Id_Advisor = VALUES(Id_Advisor)";

        $query=mysqli_query($conn,$insert);
     if(!$query)
     echo $insert;
      else
       echo $insert;
 

}?>