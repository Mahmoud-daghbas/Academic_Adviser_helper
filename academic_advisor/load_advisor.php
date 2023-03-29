<?php
include '..\login\config.php';
$query=$conn->query("SELECT `Id_Advisor`, `Name_Advisor`, `Email_Advisor`, `Phone_Number`, `Office_Room`, concat(d.`Code_Dept`, d.`Name_Dept` ) as'Name_Dept' FROM `table_advisors` a inner JOIN table_department d on  a.Id_Dept=d.Id_Dept");
$data=array();
while ($row=$query->fetch_assoc())
{
$data[]=$row;
}
echo json_encode($data);
?>