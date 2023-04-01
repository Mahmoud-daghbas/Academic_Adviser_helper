<?php
  include "../login/config.php";
  function add_level($Name_Level)
  {
   global $conn;
  
   if(!empty($Name_Level))
  {$insert="INSERT INTO `table_levels`(`Id_Level`, `Name_Level`) VALUES (Null,'$Name_Level')";
     
    echo  $insert;
      try
      {
        $insert="INSERT INTO `table_levels`(`Id_Level`, `Name_Level`) VALUES (Null,'$Name_Level')";
         $query=mysqli_query($conn,$insert);
        if(!$query)   echo '0';
         else echo '1';
      }
    catch(mysqli_sql_exception $ex)
    {
      $errorMessage = $ex->getMessage();
      $errorParts = explode("'", $errorMessage);
      echo "هذه القيمة موجودة مسبقا: " . $errorParts[1];
     }
  }
  else echo '3';
  
  }
function update_Level($Id_Level,$Name_Level)
{
    global $conn;
    if(!empty($Name_Level))
    {
      try
      {
          $q_update="UPDATE `table_levels` set `Name_Level`='$Name_Level' WHERE  `Id_Level`='$Id_Level' ";
          $query=mysqli_query($conn,$q_update);
          if(!$query)
          echo '0';
          else
          echo '1';
      } catch(mysqli_sql_exception $ex)
      {
        $errorMessage = $ex->getMessage();
        $errorParts = explode("'", $errorMessage);
       // echo "هذه القيمة موجودة مسبقا: " . $errorParts[1];
       }
      }
      else echo '3';
   
 

}
function delete_Level($Id_Level)
{  global $conn;
    try{
    $q_delete="DELETE FROM `table_levels` WHERE `Id_Level`='$Id_Level'";
    $query=mysqli_query($conn,$q_delete);
    if(!$query)
          echo '0';
      else
       echo '1';
    } catch(mysqli_sql_exception $ex)
    {
      echo "لايمكن حذف هذا البيانات لانها مرتبطه بها بيانات اخرى: " ;
     }
  }
  function select_level($extra=NULL){
    global $conn;
    $query=$conn->query("SELECT * FROM `table_levels` ".$extra."order by Id_Level asc");
    $data=array();
      while ($row=$query->fetch_assoc())
      {
      $data[]=$row;
      }
echo json_encode($data);
  }
?>