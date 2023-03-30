<?php

include 'login/config.php';
;?>
<!DOCTYPE html>
<html>
<head>
	<title> اداره ايفاد الطلاب </title>
	<!-- Include Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
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
		
		<button type="button" class="btn btn-primary"  id="showModelStudent" >
			انزال بيانات الطلاب
		</button>
		<button type="button" class="btn btn-primary"  id="saveStudentsBtn" >
			خفظ
		</button>
		<hr>
		<table id="selectedStudentsTable" class="table" style="display:none;">
			<thead>
				<tr>
					<th> رقم الطالب</th>
					<th> اسم الطالب </th>
					<th> المشرف الاكاديمي </th>
				</tr>
			</thead>
			<tbody>
				<!-- Selected students will be added dynamically here -->
			</tbody>
		</table>
	</div>
	<!-- Students Modal -->

	<!-- Include jQuery -->
	<script src="js/js/jquery-3.6.4.min.js"></script>

	<!-- Include Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script>
		function showStudentModal()
		 {
			 $('#studentsModal').modal('show');

		 }
	</script>
	<script>
		$(document).ready(function() {
		
			$('#selectedStudentsTable').show();
			// Save selected students and display them in a table
            $('#saveStudentsBtn').click(function() {
// Get selected program and advisor

// Get selected students and their names
var selectedadvisor = [];
var selecteStudentsname=[];
$('#selectedStudentsTable tbody tr').each(function() {
    // Get the selected value of the select element in the gender column
   //
 
	selectedadvisor.push($(this).find('td:eq(2) select').val());
selecteStudentsname.push($(this).closest('tr').find('td:nth-child(1)').text());

//selectedStudents.add($(this).closest('tr').find('td:first-child').text());
});
// Create table rows for selected students
var rows = '';
var insert='';
var j=0;
for (var i = 0; i < selectedadvisor.length; i++) {

if(selectedadvisor[i]!=" ")
{

	if(j!=0)
insert+=',';
insert+='("'+selecteStudentsname[i]+'","'+selectedadvisor[i]+'",sysdate(),"'+1+'")';
j++;
}
}


// Add table rows to the selected students table


					$.ajax({
						url:'data_link/ajax_function.php',
						type:'POST',
						data:{add_data_link:true,data:insert},
						success:function(data){
					alert("تمت حفظ بنجاح");
						}});

					
				
// Show the selected students table

// Hide the students modal
$('#studentsModal').modal('hide');
});


$('#showModelStudent').click(function() {

	var Id_Dept=$('#Id_Dept').val();

	$.ajax({
		
						url:'students/ajax_function.php',
						type:'POST',
						data:{select_students:true,Id_Dept:Id_Dept},
						dataType:'json',
						success:function(data)
						{

							
							var tr='';
							$("#selectedStudentsTable tbody").html('');
							$.each(data,function(i,item){
							
								updateStates(item.Id_Advisor,function(html){
								$("#selectedStudentsTable tbody").append('<tr><td>'+item.Id_Student+'</td><td><center> '+item.Name_Student+'</center></td><td><select class="form-control"  name="advisor"id="advisor">'+html+'</select></td></tr>');
								
							});
						
									});
							

						}
						
				
	});
	
});
$("#Id_Dept").change(function(){
updateStates()
});


});
function updateStates(Id_advisor,callback) {
	var Id_Dept=$("#Id_Dept").val();
	var vhtml='';

$.ajax({
	
					url:'academic_advisor/ajax_function.php',
					type:'POST',
					data:{select_advisor:true,Id_Dept:Id_Dept},
					dataType:'json',
					success:function(data)
					{
						var vhtml='';
						var option='';
					vhtml+='<option value=" " class="advisor"></option>';
						$.each(data,function(i,item){
							var check_selected='';
						
								
							if(Id_advisor==item.Id_Advisor)
							{
								check_selected='selected';
							}
							else{check_selected=' ';}
							vhtml+=' <option value="'+item.Id_Advisor+'" '+check_selected+' class="advisor">'+item.Name_Advisor+'</option>';
			
						});
				
			callback(vhtml);

					}
				
			
});


}
</script>

</body> </html>