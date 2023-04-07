<?php
    // Include the database configuration file
    include "../login/config.php";
    $bodyPlan = '';

if(isset($_GET['Id_plan']))
{
$id_plan=$_GET['Id_plan'];

    // Fetch all levels from the database
    $qry = $conn->query('SELECT `Id_Level`, `Name_Level` FROM `table_levels` ORDER BY Id_Level ASC');

    // Initialize variable
   
    // Loop through each level and generate the HTML
    while($row = $qry->fetch_assoc()) {
        $text_query=sprintf('SELECT  `Id_Course`, `Hour_Plan_Credit`, `Course_Type`, `Id_level`,`pre_requisites` FROM `table_program_study_plan` WHERE `Id_Plan`=%s and Id_level=%s ORDER BY SN ASC',$id_plan,$row["Id_Level"]);
        $qry_plan_programing = $conn->query($text_query);
        $bodyPlan .= '<h3><center>'.$row["Name_Level"].'</center></h3>';
        $bodyPlan .= '<table class="table table-hover" data-value="'.$row["Id_Level"].'"><thead><tr style="background-color:#00bfff;"><th>المادة</th><th>عدد السلاعات المعتمدة</th><th>نوع المادة</th><th>المادة المتطلبة</th><th>الاجراء</th></tr></thead><tbody>';

        while($row2 = $qry_plan_programing->fetch_assoc()) {
       
       
        // Fetch all courses from the database
        $qry2 = $conn->query("SELECT `Id_Course`, CONCAT(`Course_Code`, '--', `Name_Course`) Name_Course FROM `table_courses` ");

        // Initialize variable
        $courseOptions = '';
        $coursepre_request='';
        $courseOptions .= '<option value="" class="Course"></option>';
        $coursepre_request .= '<option value="" class="Course"></option>';
        // Generate the course options HTML
        while($row3 = $qry2->fetch_assoc()) {
            $select='';
           if( $row2["Id_Course"]==$row3["Id_Course"])
           {
               $select='selected';

           }    
            else{ $select='';}
           
            $courseOptions .= '<option value="'.$row3["Id_Course"].'" class="Course" '.$select.'>'.$row3['Name_Course'].'</option>';
   
           if( $row2["pre_requisites"]==$row3["Id_Course"])
           {
               $select='selected';

           }
           else{ $select='';}
            $coursepre_request .= '<option value="'.$row3["Id_Course"].'" class="Course" '.$select.'>'.$row3['Name_Course'].'</option>';

        }
        $select_type_course_f='';
        $select_type_course_o='';
        if( $row2["Course_Type"]==1)
        {
            $select_type_course_f='selected';
            $select_type_course_o='';

        }
        else{  $select_type_course_o='selected';
            $select_type_course_f='';}
        // Generate the row data HTML
        $hour_credit=$row2['Hour_Plan_Credit'];
        $rowData ='
        <tr>
            <td>
                <select class="form-control" name="course" id="course">
                    '.$courseOptions.'
                </select>
            </td>
            <td>
                <input type="number" class="form-control" id="Hour_Plan_Credit" name="Hour_Plan_Credit"  value ="'.$hour_credit.'"required>
            </td>
            <td>
                <select class="form-control" name="type_course" id="type_course">
                <option value="" class="type_course"></option>
                    <option value="1" class="type_course"'.$select_type_course_f.'>اجباري</option>
                    <option value="2" class="type_course" '.$select_type_course_o.' >اختياري</option>
                </select>
            </td>
            <td>
                <select class="form-control" name="pre_request" id="pre_request">
                    '.$coursepre_request.'
                </select>
            </td>
            <td>
                <button class="btn btn-sm btn-danger remove_row_selected" value>حذف</button>
            </td>
        </tr>
    ';

        // Add the row data HTML to the table body
        $bodyPlan .= $rowData;
    }
        // Add the last row HTML to the table body
        $bodyPlan .= '<tr class="last-row"><td colspan="3"><button class="btn btn-primary floating-action-button">+</button></td></tr></tbody></table>';
    }
    echo $bodyPlan;
}

    // Output the HTML
  
?>