<?php
include '../login/config.php';
$result=$conn->query("select distinct s.* , p.*,g.Grade from table_students s  RIGHT JOIN table_program_study_plan p on s.Id_Plan=p.Id_Plan inner join table_grades g on p.Id_Course=g.Id_Course  where s.Id_Student=401204999");
$data=array();
while($row=$result->fetch_assoc())
{
$course=$conn->query("SELECT concat(`Name_Course`,' ',`Course_Code`)as Course_name FROM `table_courses` WHERE `Id_Course`=".$row['Id_Course'] )->fetch_assoc()['Course_name'];
$dept=$conn->query("SELECT  concat(`Name_Dept`,'-',`Code_Dept`) dept_name FROM `table_department` WHERE Id_Dept=".$row['Id_Dept'] )->fetch_assoc()['dept_name'];
$level=$conn->query("SELECT  `Name_Level` FROM `table_levels` WHERE `Id_Level`=".$row['Id_level'] )->fetch_assoc()['Name_Level'];
$row["Id_level"]=$level;
$row["Id_Dept"]=$dept;
$row["Id_Course"]=$course;
if($row["Course_Type"]===1)
{
    $row["Course_Type"]='إيجبارية';
}else
{
    $row["Course_Type"]='اختيارية';
}
if($row["Gender_Student"]===1)
{
    $row["Gender_Student"]='ذكر`';
}else
{
    $row["Gender_Student"]='انثى';
}
$data[]=$row;


}
echo json_encode($data,JSON_UNESCAPED_UNICODE);

?>