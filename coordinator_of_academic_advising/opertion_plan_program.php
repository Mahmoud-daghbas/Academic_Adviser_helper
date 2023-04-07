<?php 
require_once('../login/config.php');
function add_header_plan_programing($Id_Plan,$Name_Plan,$Date_create,$Id_Dept,$call_back)
{
    global $conn;
    $query_check=$conn->query("SELECT `Id_Plan` FROM `table_header_program_study_plan`where Id_Plan='$Id_Plan'");

if(mysqli_num_rows($query_check)<=0)
{


 if(!empty($Name_Plan)&& !empty($Date_create)&& !empty($Id_Dept))
 {

    $insert="INSERT INTO `table_header_program_study_plan`(`Id_Plan`, `Name_Plan`, `Date_create`, `Id_Dept`) VALUES ($Id_Plan,'$Name_Plan','$Date_create','$Id_Dept')";
    $query=mysqli_query($conn,$insert);
  
    if(!$query)
    $call_back(0);
     else
     $call_back($Id_Plan);
 
   
}else
{
    echo '2';
}
}
$call_back(-1);
}
function update_header_plan_programing($Name_Plan,$Date_create,$Id_Dept,$call_back)
{
    global $conn;
 if(!empty($Name_Plan)&& !empty($Date_create)&& !empty($Id_Dept))
 {
    $update="UPDATE `table_header_program_study_plan` SET `Name_Plan`='$Name_Plan',`Date_create`='$Date_create',`Id_Dept`='$Id_Dept' WHERE `Id_Plan`='$Id_Plan'";
     $query=mysqli_query($conn,$update);
    if(!$query)
  echo '0';
     else
     echo '1';
}else
{
    echo '2';
}

}
function delete_header_plan_programing($s_id)
{  global $conn;

    $q_delete="DELETE FROM `table_header_program_study_plan` WHERE`Id_Plan`='$Id_Plan'";
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

///opertion footer plan programing
include('../login/config.php');
function add_plan_programing($Id_Plan,$Name_Plan,$Date_create,$Id_Dept,$array_plane)
{
 
    global $conn;
    $data=json_decode($array_plane, true);
    $_POST['data']=null;
 
    $new_ids = array();
    foreach ($data as $row) 
    {
         $new_ids[] = array($row['Id_Course'], $Id_Plan);
      
    }

    if(isset($array_plane))
        {
        if(!empty($Id_Plan)&& !empty($Name_Plan)&& !empty($Date_create)&& !empty($Id_Dept))
        {
            add_header_plan_programing($Id_Plan,$Name_Plan,$Date_create,$Id_Dept,function($opertion_type)use($conn,$new_ids,$Id_Plan,$data)
            {   
                $current_data=array();
                    $result=$conn->query("SELECT `Id_Course`, `Id_Plan` FROM `table_program_study_plan` WHERE Id_Plan='$Id_Plan'");
                    if ($result->num_rows > 0) 
                    {
                        while ($row = $result->fetch_assoc()) {
                            $current_data[] = $row;
                        }
                     }
                    $rows_to_delete = array();
                    foreach ($current_data as $row) 
                    {
                        if (!in_array(array($row['Id_Course'], $row['Id_Plan']), $new_ids)) 
                        {
                            $rows_to_delete[] = $row;
                        }
                    }

            // Delete the rows to delete
                    foreach ($rows_to_delete as $row)
                    {
                        $sql = "DELETE FROM table_program_study_plan WHERE Id_Course = '" . $row['Id_Course'] . "' AND Id_Plan = '" . $row['Id_Plan'] . "'";
                        $conn->query($sql);
                    }

                
                $i=1;
                
                    foreach ($data as $row) {
                        // echo $row['Id_Course'];
                        $Hour_Plan_Credit = $row['Hour_Plan_Credit'];
                        $Course_Type = $row['Course_Type'];
                        $Id_level = $row['Id_level'];
                        $Id_Course = $row['Id_Course'];
                        $pre_requisites = $row['pre_requisites'];
                        $query_text="INSERT INTO `table_program_study_plan` (SN,Id_Course, Hour_Plan_Credit, Course_Type, Id_level, Id_Plan, pre_requisites)
                        VALUES  ($i,'$Id_Course','$Hour_Plan_Credit','$Course_Type','$Id_level','$Id_Plan','$pre_requisites')
                        ON DUPLICATE KEY UPDATE
                            Hour_Plan_Credit = VALUES(Hour_Plan_Credit),
                            Course_Type = VALUES(Course_Type),
                            Id_level = VALUES(Id_level),
                            pre_requisites = VALUES(pre_requisites)";
                        //  $insert="INSERT INTO `table_program_study_plan`(`Id_Course`, `Hour_Plan_Credit`, `Course_Type`, `Id_level`, `Id_Plan`, `pre_requisites`) VALUES ('$Id_Course','$Hour_Plan_Credit','$Course_Type','$Id_level','$Id_Plan','$pre_requisites')";

                        $conn->query($query_text);
                        $i++;
                        
                    
                    }
                
            });

        
        }else
        {
            echo '3';
        }
    }
    else
    {
        echo '4';
    }
}
// function update_plan_programing($Id_Plan,$Name_Plan,$Date_create,$Id_Dept,$call_back)
// {
//     global $conn;
//  if(!empty($Name_Plan)&& !empty($Date_create)&& !empty($Id_Dept))
//  {
//     $update="";
//       $query=mysqli_query($conn,$update);
//     if(!$query)
//     echo '0';
//      else
//      echo '1';
// }else
// {
//     echo '2';
// }

// }
function delete_plan_programing($s_id)
{  global $conn;

    $q_delete="DELETE FROM `table_program_study_plan` WHERE`Id_Plan`='$Id_Plan'";
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
function select_plan_in_dept($id_dept)
{ global $conn;
    
     $plan =$conn->query("SELECT `Id_Plan`, `Name_Plan` FROM `table_header_program_study_plan`where Id_Dept='$id_dept'");
     $data_plan=array();
    while($row=$plan->fetch_assoc())
    {
        $data_plan[]=$row;
    }
    echo json_encode($data_plan);  

}

// INSERT INTO `table_program_study_plan` (`Id_Course`, `Hour_Plan_Credit`, `Course_Type`, `Id_level`, `Id_Plan`, `pre_requisites`) VALUES
// (1, 4, 1, 5, 2, 0),
// (2, 3, 1, 5, 2, 0),
// (3, 2, 1, 5, 2, 0),
// (4, 4, 1, 6, 2, 0),
// (5, 3, 1, 6, 2, 0),
// (6, 3, 1, 6, 2, 0),
// (7, 4, 1, 7, 2, 4),
// (8, 3, 1, 7, 2, 0),
// (9, 3, 1, 7, 2, 6),
// (10, 2, 1, 8, 2, 0),
// (11, 4, 1, 8, 2, 5),
// (12, 3, 1, 8, 2, 9),
// (13, 3, 1, 8, 2, 9),
// (14, 4, 1, 9, 2, 0),
// (15, 4, 1, 9, 2, 9),
// (16, 3, 1, 9, 2, 11),
// (17, 2, 1, 10, 2, 0),
// (18, 4, 1, 10, 2, 14),
// (19, 3, 1, 10, 2, 11),
// (20, 3, 1, 10, 2, 13);



?>
