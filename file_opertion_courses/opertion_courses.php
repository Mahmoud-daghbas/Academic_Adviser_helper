<?php
  include "../login/config.php";


function add_Course($Course_Code=NULL,$Name_Course,$Hour_Credit=NULL,$short_description=NULL)
{
 global $conn;

 if(!empty($Course_Code) && !empty($Name_Course)&& !empty($Hour_Credit))
{
 if(!validate_code_Name_courses($Course_Code,$Name_Course))
  {try
    {

    
    $insert="INSERT INTO `table_courses`(`Id_Course`, `Course_Code`, `Name_Course`, `Hour_Credit`, `short_description`)   VALUES (NULL,'$Course_Code','$Name_Course','$Hour_Credit','$short_description')";
      $query=mysqli_query($conn,$insert);
     if(!$query)
          echo '0';
      else
       echo '1';
  }catch(mysqli_sql_exception $ex){
    $errorMessage = $ex->getMessage();
    $errorParts = explode("'", $errorMessage);
    echo "هذه القيمة موجودة مسبقا: " . $errorParts[1];
  }

}
else echo '2';
}else echo '3';
}


function validate_code_Name_courses($Name_Course,$Course_Code,$extraa=NULL)
{
    global $conn;
  $select="select * from table_courses where (Name_Course='$Name_Course' or Course_Code='$Course_Code' )".$extraa;
 
   $query=mysqli_query($conn,$select);
  if(!$query)
  {
       return false;
  }
  else
  {
     if(mysqli_num_rows($query)>0)
        return 1;
     else
      return 0;
      
  }
}

function update_Course($Id_Course,$Course_Code=NULL,$Name_Course,$Hour_Credit=NULL,$short_description=NULL)
{
    global $conn;
    if(!empty($Course_Code) && !empty($Name_Course)&& !empty($Hour_Credit))
    {
      if(!validate_code_Name_courses($Name_Course,$Course_Code," and `Id_Course`!='$Id_Course'"))
      {
          $q_update="UPDATE `table_courses` SET `Course_Code`='$Course_Code',`Name_Course`='$Name_Course',`Hour_Credit`='$Hour_Credit',`short_description`='$short_description' WHERE  `Id_Course`='$Id_Course' ";
          $query=mysqli_query($conn,$q_update);
          if(!$query)
          echo '0';
          else
          echo '1';
      } 
      else
      {
          echo '0';
      }
   }
   else  echo '3';

}
function delete_Course($Id_Course)
{  global $conn;
    $q_delete="DELETE FROM `table_courses` WHERE `Id_Course`='$Id_Course'";
    $query=mysqli_query($conn,$q_delete);
    if(!$query)
          echo '0';
      else
       echo '1';
  }


//update_Course('','saleemmm','24_dep','saleemmm@gmail.com','99987779');
?>