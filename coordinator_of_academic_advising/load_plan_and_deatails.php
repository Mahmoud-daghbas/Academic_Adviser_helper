<?php
    // Include the database configuration file
    include "../login/config.php";
    $bodyPlan = '';

   
    $main_query=$conn->query('SELECT `Id_Plan`, `Name_Plan`, `Date_create`,d.Name_Dept,d.Id_Dept FROM `table_header_program_study_plan` p INNER JOIN table_department d on d.Id_Dept=p.Id_Dept ');
    $table_main='<table id="Plan_programing-table">
    <thead>
        <tr>
            <th>رقم الخطة</th>
            <th>اسم الخطة</th>
            <th>تاريخ انشاء الخطة</th>
            <th>القسم</th>
            <th>عرض التفاصيل</th>
            <th>مشاركةالخطة</th>
        </tr>
    </thead>
    <tbody>';
    $tr_plan='';
    while($row_header_plan = $main_query->fetch_assoc()) 
    {
        $tr_plan.='<tr class="plan-row"><td>'.$row_header_plan["Id_Plan"].'</td> <td>'.$row_header_plan["Name_Plan"].'</td> <td>'.$row_header_plan["Date_create"].'</td><td>'.$row_header_plan["Name_Dept"].'</td> <td><button class="details-btn btn btn-sm btn-info ">تفاضيل الخطة</button></td><td><button class="share-btn btn btn-sm btn-info " data-Id_Dept="'.$row_header_plan["Id_Dept"].'">مشاركة الخطة</button></td></tr>';

        $bodyPlan = '';

    // Fetch all levels from the database
    $query_levels = $conn->query('SELECT `Id_Level`, `Name_Level` FROM `table_levels` ORDER BY Id_Level ASC');

    // Initialize variable
   
    // Loop through each level and generate the HTML
    while($rowlevel = $query_levels->fetch_assoc()) {
        $text_query=sprintf('SELECT  c.`Name_Course`, `Hour_Plan_Credit`, `Course_Type`, pre_requisites FROM `table_program_study_plan` p inner join table_courses c on  p.Id_Course=c.Id_Course  WHERE `Id_Plan`=%s and Id_level=%s ORDER BY SN ASC',$row_header_plan["Id_Plan"],$rowlevel["Id_Level"]);
        $query_plan_programing = $conn->query($text_query);
        $bodyPlan .= '<h3><center>'.$rowlevel["Name_Level"].'</center></h3>';
        $bodyPlan .= '<table class="table table-hover" data-value="'.$rowlevel["Id_Level"].'"><thead><tr style="background-color:#00bfff;"><th>المادة</th><th>عدد السلاعات المعتمدة</th><th>نوع المادة</th><th>المادة المتطلبة</th></tr></thead><tbody>';

        while($row2 = $query_plan_programing->fetch_assoc()) {
            if(!empty($row2["pre_requisites"]))
            {
            $course=$conn->query("SELECT concat(`Name_Course`,' ',`Course_Code`)as Course_name FROM `table_courses` WHERE `Id_Course`=".$row2['pre_requisites'] )->fetch_assoc()['Course_name'];
       $row2["pre_requisites"]=$course.'';
            }else
            { $row2["pre_requisites"]='';}
        // Fetch all courses from the database
      
        // Initialize variable

        $rowData =' <tr> <td>'.$row2["Name_Course"].' </td> <td> '.$row2["Hour_Plan_Credit"].'  </td><td> '.$row2["Course_Type"].' </td> <td> '.$row2["pre_requisites"].' </td>   </tr>';

        // Add the row data HTML to the table body
        $bodyPlan .= $rowData;
    }
        // Add the last row HTML to the table body
        $bodyPlan .='</tbody></table>';
    }
    
$tr_plan.='<tr class="details-row" style="display: none;">
<td colspan="6">
  '. $bodyPlan .'
</td>
</tr>';
    }
  
$table_main.=$tr_plan.' </tbody></table>';
echo $table_main;
    // Output the HTML
  
?>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

tr.details-row td {
    background-color: #f9f9f9;
}
</style>


    <script src="../assest/js/jquery-3.6.0.min.js"></script>
    <script>
        // Add your jQuery code here
        $(document).ready(function() {
    $(".details-btn").on("click", function() {
       
        const detailsRow = $(this).closest(".plan-row").next(".details-row");
        detailsRow.toggle();
    });
    $('.share-btn').on("click",function(){
        var array_data=$(this).attr('data-Id_Dept');
      
       var id_plan_share=$(this).closest('tr').find('td:first-child').text();
        $('#advisorModal').val(id_plan_share);
        var ContenUrl='academic_advisor/Controler_Advisor.php';
        tag_controler='select_advisor';
        select(ContenUrl,tag_controler,array_data);
        $('#advisorModal').modal('show');
  
})
});
    </script>