
<?php
include('../login/config.php');

  //function add student;

 
function add_student($id_student,$s_name=NULL,$s_gender=NULL,$birth_date,$phone_no=NULL,$s_email=NULL,$id_dept=NULL,$Id_Plan=NULL)
{
 global $conn;
if(!empty($id_student) && !empty($s_name)&& !empty($s_gender)&& !empty($birth_date)&& !empty($phone_no)&& !empty($s_email)&& !empty($id_dept)&& !empty($Id_Plan))
{
 if(!validate_phone_and_email($s_email,$phone_no,$id_student))
  {
    $insert="INSERT INTO `table_students`(`Id_Student`, `Name_Student`, `Gender_Student`, `Date_Birth`, `Phone_Student`, `Email_Student`, `Id_Dept`, `Id_Plan`) VALUES ($id_student,'$s_name','$s_gender',$birth_date,'$phone_no','$s_email','$id_dept','$Id_Plan')";
    $query=mysqli_query($conn,$insert);
     if(!$query)
          echo '0';
      else
        echo '1';
  }
  else{echo '0';}
}
else echo '3';
}
// function check email or phone is exist in database or no 
//extraa useing in state update  even check email or phone without email and phone number student that you want update
function validate_phone_and_email($email,$phone,$id_student,$extraa=NULL)
{
    global $conn;
  $select="select * from table_students where (Email_Student='$email' or Phone_Student='$phone' or Id_Student='$id_student')".$extraa;
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

function update_student($s_id,$s_name=NULL,$s_gender=NULL,$birth_date,$phone_no=NULL,$s_email=NULL,$id_dept=NULL,$Id_Plan=NULL)
{
    global $conn;
    if(!empty($s_id) && !empty($s_name)&& !empty($s_gender)&& !empty($birth_date)&& !empty($phone_no)&& !empty($s_email)&& !empty($id_dept)&& !empty($Id_Plan))
  {
    
    if(!validate_phone_and_email($s_email,$phone_no,$s_id," and `Id_Student`!='$s_id'"))
    {
     $q_update="UPDATE `table_students` SET `Name_Student`='$s_name',`Gender_Student`='$s_gender',`Phone_Student`='$phone_no',`Email_Student`='$s_email',`Date_Birth`='$birth_date',Id_Dept='$id_dept',`Id_Plan`='$Id_Plan' where `Id_Student`='$s_id'";
     $query=mysqli_query($conn,$q_update);

     if(!$query)
      {
       echo "0";
      }
      echo "1";
   
    }
    else
    {
        echo "0";
    }
  }else echo '3';
  
}
function delete_student($s_id)
{  global $conn;

    $q_delete="DELETE FROM `table_students` WHERE `Id_Student`='$s_id'";
    $query=mysqli_query($conn,$q_delete);
    if(!$query)
    {
      echo '0';
 
    }
    else
    {
        echo '1';
    }
   
  
}

function select_gender($s_id)
{  global $conn;
    $select="SELECT `Gender_Student` FROM `table_students` WHERE `Id_Student`=$id'";
    $gender = $conn->query("SELECT `Gender_Student` FROM `table_students` WHERE `Id_Student`='$s_id'")->fetch_array()["Gender_Student"];
   return $gender;
}
function add_student2($s_name=NULL,$s_gender=NULL,$birth_date,$phone_no=NULL,$s_email=NULL,$id_dept=1,$Id_Plan=1)
{
 global $conn;
 if(!validate_phone_and_email($s_email,$phone_no))
  {
    $insert="INSERT INTO `table_students`(`Id_Student`, `Name_Student`, `Gender_Student`, `Date_Birth`, `Phone_Student`, `Email_Student`, `Id_Dept`, `Id_Plan`) VALUES (NULL,'$s_name','$s_gender',$birth_date,'$phone_no','$s_email','$Id_Plan','$Id_Plan')";
    $query=mysqli_query($conn,$insert);
     if(!$query)
          return false;
      else
        return true;
  }
}

function select_student_in_dept_assigment($Id_Dept)
{
  global $conn;
   $students =$conn->query("SELECT  DISTINCT s.`Id_Student`, `Name_Student`,l.Id_Advisor FROM `table_students` s LEFT join table_links l on l.Id_Student=s.Id_Student  WHERE Id_Dept='$Id_Dept' order by Id_Student asc");
$data=array();
   while($row=$students->fetch_assoc()){
$data[]=$row;
    }
   echo json_encode($data);
  }
  function select_student_join_advisor_assigment($id_advisor)
{
  global $conn;
   $students =$conn->query("SELECT s.`Id_Student`, `Name_Student`, IF(`Gender_Student`=1,'ذكر', 'انثى') gender,`Date_Birth`, `Phone_Student`, `Email_Student`,  concat(d.`Code_Dept`, d.`Name_Dept` ) as'Name_Dept' FROM `table_students` s inner JOIN table_department d on  s.Id_Dept=d.Id_Dept LEFT join table_links l on l.Id_Student=s.Id_Student   WHERE l.Id_Advisor='$id_advisor' order by Id_Student asc");
$data=array();
   while($row=$students->fetch_assoc()){
$data[]=$row;
    }
   echo json_encode($data);
  }

//delete_student(8888);
//update_student(12355666,'lgdf', 1, '2022-1-1', '7777666666', 'hhh@gmail.com', 1,2);
?>