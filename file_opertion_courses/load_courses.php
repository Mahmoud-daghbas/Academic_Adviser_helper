<?php
include '..\login\config.php';
$query=$conn->query("SELECT `Id_Course`, `Course_Code`, `Name_Course`, `Hour_Credit`, `short_description` FROM `table_courses` ");
$data=array();
while ($row=$query->fetch_assoc())
{
$data[]=$row;
}
echo json_encode($data);
?>