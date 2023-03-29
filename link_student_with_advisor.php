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
	<div class="container">
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
			<select class="form-control"  name="advisor"id="advisor">
             
			</select>
		</div>
		<button type="button" class="btn btn-primary"  id="showModelStudent" >
			اختر الطلاب
		</button>
		<hr>
		<table id="selectedStudentsTable" class="table" style="display:none;">
			<thead>
				<tr>
					<th> القسم </th>
					<th> اسم المرشد الاكاديمي </th>
					<th> اسم الطلاب </th>
				</tr>
			</thead>
			<tbody>
				<!-- Selected students will be added dynamically here -->
			</tbody>
		</table>
	</div>
	<!-- Students Modal -->
	<div class="modal fade" id="studentsModal" tabindex="-1" role="dialog" aria-labelledby="studentsModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="studentsModalLabel"> اختر الطلاب </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table id="studentsTable" class="table">

						<tbody>
						
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"> الغاء </button>
					<button type="button" class="btn btn-primary" id="saveStudentsBtn"> حفظ </button>
				</div>
			</div>
		</div>
	</div>
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
			updateStates();
			// Save selected students and display them in a table
            $('#saveStudentsBtn').click(function() {
// Get selected program and advisor
var Id_Dept = $('#Id_Dept').val();
var advisor = $('#advisor').val();
var Dept_name = $('#Id_Dept option:selected').text();
var advisor_name = $('#advisor option:selected').text();
// Get selected students and their names
var selectedStudents = [];
var selecteStudentsname=[];
$('.studentCheckbox:checked').each(function() {
selectedStudents.push($(this).val());
selecteStudentsname.push($(this).closest('tr').find('td:first-child').text());
//selectedStudents.add($(this).closest('tr').find('td:first-child').text());
});
// Create table rows for selected students
var rows = '';
var insert='';
for (var i = 0; i < selectedStudents.length; i++) {
rows += '<tr>';
rows += '<td value="'+Id_Dept+'">' + Dept_name + '</td>';
rows += '<td value="'+advisor+'">' + advisor_name + '</td>';
rows += '<td value="'+selectedStudents[i]+'">' +selecteStudentsname[i]+ '</td>';

rows += '</tr>';

if(i!=0)
insert+=',';
insert+='(NULL,"'+selectedStudents[i]+'","'+advisor+'",sysdate(),"'+1+'")';
}

// Add table rows to the selected students table


					$.ajax({
						url:'date_link/ajax_function.php',
						type:'POST',
						data:{add_data_link:true,data:insert},
						success:function(data){
						
						}});

						$('#selectedStudentsTable tbody').html(rows);
				
// Show the selected students table
$('#selectedStudentsTable').show();
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
							$("#studentsTable tbody").html('');
							var tr='';
						
							$.each(data,function(i,item){

								$("#studentsTable tbody").append('<tr><td><center> '+item.Name_Student+'</center></td><td><input type="checkbox" class="studentCheckbox" name="student" value="'+item.Id_Student+'"></td></tr>');
							});
							

						}
						
				
	});
	$('#studentsModal').modal('show');
});
$("#Id_Dept").change(function(){
updateStates()
});


});
function updateStates() {
	var Id_Dept=$("#Id_Dept").val();

$.ajax({
	
					url:'academic_advisor/ajax_function.php',
					type:'POST',
					data:{select_advisor:true,Id_Dept:Id_Dept},
					dataType:'json',
					success:function(data)
					{
						var option='';
					
						$.each(data,function(i,item){
							option+=' <option value="'+item.Id_Advisor+'">'+item.Name_Advisor+'</option>';
			
						});
						$("#advisor").html(option);

					}
			
});
}
</script>

</body> </html>