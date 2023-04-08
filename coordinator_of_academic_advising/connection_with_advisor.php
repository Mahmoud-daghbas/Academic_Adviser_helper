<?php 
require_once('../login/config.php');
if(isset($_POST['oper'])&&$_POST['oper']=='insert')
{
    $Id_Advisor=$_POST['Id_Advisor'];
    $Id_Plan=$_POST['Id_Plan'];
    share_plan($Id_Advisor,$Id_Plan);
}

function share_plan($Id_Advisor,$Id_Plan)
{
    global $conn;
    for($i=0;$i<count($Id_Advisor);$i++)
    {
        $query=$conn->query("INSERT INTO `table_permision`(`u_id`, `Id_Plan`) VALUES ('$Id_Advisor[$i]','$Id_Plan')   ON DUPLICATE KEY UPDATE
        u_id = VALUES(u_id),
        Id_Plan = VALUES(Id_Plan)");
       

    }
 } 


?>