<?php

include 'login/config.php';
;?>
<!DOCTYPE html>
<html>
<head>
	<title> اداره ايفاد الطلاب </title>
	<!-- Include Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="js/jquery-3.6.4.min.js"></script>
</head>
<body dir="rtl">
	<div class="container"  style="text-align: right;" >
		<h1> ادارة ايفاد الطلاب </h1>
		<div class="form-group mb-2 text-right">
			<label for="Id_Dept" class="control-label">القسم</label>
			<select name="Id_Dept" id="Id_Dept" class="form-control" required>
				<?php $dept =$conn->query("SELECT `Id_Dept`, concat(`Code_Dept`, `Name_Dept` )as 'dept_name' FROM `table_department`");?>
				<?php while($row=$dept->fetch_assoc()){?>
				 <option value="<?php echo $row['Id_Dept']?>"><?php echo $row['dept_name']?></option>
				<?php  }?>
			</select>
	  </div>
      <div class="form-group">
			<label for="advisor"> اختر المشرف </label>
			<select   name="advisor" id="advisor"class="form-control">
             
			</select>
		</div>
	
		<hr>
        <table id="studentsTable" class="table">
			<thead>
				<tr>
				<th> الرقم الجامعي  </th>
					<th> اسم الطالب </th>
					<th> الجنس </th>
					<th>تاريخ  الميلاد </th>
					<th>رقم الجوال </th>
					<th>عنوان الايميل </th>
					<th>القسم </th>
				
				</tr>
			</thead>
			<tbody>
				<!-- Students will be added dynamically here -->
			</tbody>
		</table>
	</div>


	<!-- Include jQuery -->
	<script src="js/jquery-3.6.4.min.js"></script>
    <script>
$(document).ready(function()
{select_advisor_in_dept();
    select_student_join_advisor();
    $("#Id_Dept").change(function(){
        select_advisor_in_dept();
});
$("#advisor").change(function(){

    select_student_join_advisor();});

});
 function select_advisor_in_dept() {
	var Id_Dept=$("#Id_Dept").val();

     $.ajax({
	
        url:'academic_advisor/Controler_Advisor.php',
        type:'POST',
        data:{select_advisor:true,Id_Dept:Id_Dept},
        dataType:'json',
        success:function(data)
        {
            var option='';
            option+=' <option value=""></option>';

            $.each(data,function(i,item){
                option+=' <option value="'+item.Id_Advisor+'">'+item.Name_Advisor+'</option>';

            });
            $("#advisor").html(option);

        }
     

			
});
}
function select_student_join_advisor() {
	var advisor=$("#advisor").val();
  

$.ajax({
	
					url:'students/Controler_Students.php',
					type:'POST',
					data:{select_student_join_advisor:true,advisor:advisor},
					dataType:'json',
					success:function(data)
					{
                        
						$.each(data,function(i,item){
							$('#studentsTable tbody').append('<tr><td>' + item.Id_Student + '</td><td>' + item.Name_Student + '</td><td>' + item.gender + '</td><td>' + item.Date_Birth + '</td><td>' + item.Phone_Student + '</td><td>' + item.Email_Student + '</td><td>' + item.Name_Dept + '</td></tr>');
				
						});
					

					}
			
});
}
				
      </script>
    </body> </html>