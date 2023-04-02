<?php  include "../login/config.php";
    $qry2=$conn->query("SELECT `Id_Course`,concat( `Course_Code`,'--', `Name_Course`) Name_Course FROM `table_courses` ");
    $course='';
    $row_with_data='';
    $course.=' <option value=""  class="Course"></option>';
    while($row2=$qry2->fetch_assoc())
    {
       $course.=' <option value="'.$row2["Id_Course"].'"  class="Course">'.$row2['Name_Course'].'</option>';
    }
    $row_with_data.='<tr><td> <select class="form-control"  name="course" id="course">'.$course. '</select></td> <td><input type="text" class="form-control" id="Hour_Plan_Credit" name="Hour_Plan_Credit" required></td><td> <select class="form-control"  name="type_course" id="type_course"><option value="1"  class="advisor">اجباري</option><option value="2"  class="advisor">اختياري</option></select></td><td><select class="form-control"  name="pre_request" id="pre_request">'.$course. '</select></td><td><button class="btn btn-sm btn-danger remove_row_selected" > حذف </button></center></td></tr>';
  echo $row_with_data;
?>