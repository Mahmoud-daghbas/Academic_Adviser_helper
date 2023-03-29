
<?php
  include "../login/config.php";

  //function add adcademic advisor;
function add_advisor($Id_Advisor=NULL,$Name_Advisor,$Email_Advisor=NULL,$Phone_Number=NULL,$Office_Room=NULL,$Id_Dept=NULL)
{
 global $conn;
 if(!empty($Id_Advisor) && !empty($Name_Advisor)&& !empty($Email_Advisor)&& !empty($Phone_Number)&& !empty($Office_Room)&& !empty($Id_Dept))
{
 if(!validate_phone_and_email($Email_Advisor,$Phone_Number,$Id_Advisor))
  {
    $insert="INSERT INTO `table_advisors`(`Id_Advisor`, `Name_Advisor`, `Email_Advisor`, `Phone_Number`, `Office_Room`, `Id_Dept`)  VALUES ('$Id_Advisor','$Name_Advisor','$Email_Advisor','$Phone_Number','$Office_Room','$Id_Dept')";
      $query=mysqli_query($conn,$insert);
     if(!$query)
          echo '0';
      else
       echo '1';
  }
}else echo '3';
}
// function check email or phone is exist in database or no 
//extraa useing in state update  even check email or phone without email and phone number advisor that you want update
function validate_phone_and_email($email,$phone,$Id_Advisor,$extraa=NULL)
{
    global $conn;
  $select="select * from table_advisors where (Email_Advisor='$email' or Phone_Number='$phone' )".$extraa;
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

function update_advisor($Id_Advisor=NULL,$Name_Advisor,$Email_Advisor=NULL,$Phone_Number=NULL,$Office_Room=NULL,$Id_Dept=NULL)
{
    global $conn;
    if(!empty($Id_Advisor) && !empty($Name_Advisor)&& !empty($Email_Advisor)&& !empty($Phone_Number)&& !empty($Office_Room)&& !empty($Id_Dept))
    {
      if(!validate_phone_and_email($Email_Advisor,$Phone_Number,$Id_Advisor ," and `Id_Advisor`!='$Id_Advisor'"))
      {
          $q_update="UPDATE `table_advisors` SET `Id_Advisor`='$Id_Advisor',`Name_Advisor`='$Name_Advisor',`Email_Advisor`='$Email_Advisor',`Phone_Number`='$Phone_Number',`Office_Room`='$Office_Room',`Id_Dept`='$Id_Dept' WHERE  `Id_Advisor`='$Id_Advisor' ";
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
function delete_advisor($Id_Advisor)
{  global $conn;
    $q_delete="DELETE FROM `table_advisors` WHERE `Id_Advisor`='$Id_Advisor'";
    $query=mysqli_query($conn,$q_delete);
    if(!$query)
          echo '0';
      else
       echo '1';
  }

function select_advisor_in_deptAssigment($Id_Dept)
{
  global $conn;
   $advisor =$conn->query("SELECT `Id_Advisor`, `Name_Advisor` FROM `table_advisors` WHERE Id_Dept='$Id_Dept'");
$data=array();
   while($row=$advisor->fetch_assoc()){
$data[]=$row;
    }
   echo json_encode($data);
  }
//update_advisor(1,'saleemmm','24_dep','saleemmm@gmail.com','99987779');
?>