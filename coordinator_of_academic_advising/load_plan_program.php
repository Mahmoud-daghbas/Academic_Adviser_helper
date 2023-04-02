<?php  include "../login/config.php";
//$qry=$conn->query('SELECT `Id_Course`, `Hour_Plan_Credit`, `Course_Type`, `Id_level`, `Id_Plan`, `pre_requisites` FROM `table_program_study_plan` WHERE 1');
 
 $qry=$conn->query('SELECT `Id_Level`, `Name_Level` FROM `table_levels` order by Id_Level asc');
 $body_plan='';
 while($row=$qry->fetch_assoc())
        {
           
           $body_plan.= '<h3><center>'.$row["Name_Level"].'</center></h3>';
        
           $body_plan.='<table class="table table-hover" ><thead> <tr style=" background-color:	#00bfff;"><th>المادة</th><th>عدد السلاعات المعتمدة</th><th>نوع المادة</th><th>المادة المتطلبة</th><th>الاجراء</th></tr></thead> <tbody>';
         
            $qry2=$conn->query("SELECT `Id_Course`,concat( `Course_Code`,'--', `Name_Course`) Name_Course FROM `table_courses` ");
            $course='';
            $course.=' <option value=""  class="Course"></option>';
            while($row2=$qry2->fetch_assoc())
            {
               $course.=' <option value="'.$row2["Id_Course"].'"  class="Course">'.$row2['Name_Course'].'</option>';
            }
            $body_plan.='<tr><td> <select class="form-control"  name="course" id="course">'.$course. '</select></td> <td><input type="text" class="form-control" id="Hour_Plan_Credit" name="Hour_Plan_Credit" required></td><td> <select class="form-control"  name="type_course" id="type_course"><option value="1"  class="type_course">اجباري</option><option value="2"  class="type_course">اختياري</option></select></td><td><select class="form-control"  name="pre_request" id="pre_request">'.$course. '</select></td><td><button class="btn btn-sm btn-danger remove_row_selected" > حذف </button></center></td></tr>';
             $body_plan.='<tr class="last-row">
             <td colspan="3">
               <button class="btn btn-primary floating-action-button" >+</button>
             </td>
           </tr></tbody> </table>';
         
        }
        echo $body_plan;
        
        
        
  ?>