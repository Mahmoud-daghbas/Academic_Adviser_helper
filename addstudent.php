<?php

include 'login/config.php';
;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> اضافة طالب  </title>
	<!-- Include Bootstrap CSS -->
	<link href="js/css/bootstrap.min.css" rel="stylesheet">
    	<!-- Include Bootstrap JS -->
		<script src="js/js/bootstrap.min.js"></script>
		<script src="js/bootstrap-datepicker.min.js"></script>
		
		<script src="js/js/jquery-3.6.4.min.js"></script>

</head>
<body>

	<div class="container"  style="text-align: right;" >
		<h1> قم باضافة الطالب وستظهر لك في الجدول اسفل  </h1>
		<button type="button" class="btn btn-primary text-right" onclick="showAddStudentModal('اضافة طالب')">
			 اضافة طالب
		</button>
		<!-- Modal -->
		<div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="addStudentModalLabel"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="addStudentForm">
						<div class="form-group mb-2 text-right">
								<label for="id_student">الرقم الجامعي:</label>
								<input type="text" class="form-control" id="id_student" name="id_student" required>
							</div>
							<div class="form-group mb-2 text-right">
								<label for="name">الاسم:</label>
								<input type="text" class="form-control" id="name" name="name" required>
							</div>
							
						
							<div class="form-group mb-2 text-right">
			                    	<label for="from_location" class="control-label">الجنس</label>
				                    <select name="gender" id="gender" class="form-control" required>
					                    <option value="1" > ذكر</option>
					                     
						                 <option value="2">انثى</option>
					                    
				                    </select>
			                  </div>
							  <div class="form-group mb-2 text-right">
                       <label for="datepicker">تاريخ  الميلاد</label>
                                   <input type="text" class="form-control" id="datepicker">
                             </div>
									  
							  <div class="form-group mb-2 text-right">
								<label for="mobileNumber">رقم التلفون</label>
								<input type="tel" class="form-control" id="mobileNumber" name="mobileNumber" required>
							</div>
							<div class="form-group mb-2 text-right">
								<label for="email">الايميل</label>
								<input type="email" class="form-control" id="email" name="email" required>
							</div>
							
							<div class="form-group mb-2 text-right">
			                    	<label for="dept" class="control-label">القسم</label>
				                    <select name="dept" id="dept" class="form-control" required>
										<?php $dept =$conn->query("SELECT `Id_Dept`, concat(`Code_Dept`, `Name_Dept` )as 'dept_name' FROM `table_department`");?>
										<?php while($row=$dept->fetch_assoc()){?>
						                 <option value="<?php echo $row['Id_Dept']?>"><?php echo $row['dept_name']?></option>
					                    <?php  }?>
				                    </select>
			                  </div>
							  <div class="form-group mb-2 text-right">
			                    	<label for="id_plan" class="control-label">الخطة الدراسية</label>
				                    <select name="id_plan" id="id_plan" class="form-control" required>
										<?php $plan =$conn->query("SELECT `Id_Plan`, `Name_Plan` FROM `table_header_program_study_plan`");?>
										<?php while($row=$plan->fetch_assoc()){?>
						                 <option value="<?php echo $row['Id_Plan']?>"><?php echo $row['Name_Plan']?></option>
					                    <?php  }?>
				                    </select>
			                  </div>

						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
						<button type="button" id="savestudent" class="btn btn-primary margin-2 ">حفظ</button>
					</div>
				</div>
			</div>
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
					<th>الاجراء</th>
				</tr>
			</thead>
			<tbody>
				<!-- Students will be added dynamically here -->
			</tbody>
		</table>
		<!-- Modal dialog box for confirmation -->
<div class="modal" id="confirm-delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">تاكيد عملية الحذف</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body mb-2 text-right">
        هل انت تريد  حذف بيانات الصف فعلا؟
      </div>
      <div class="modal-footer">
      
        <button type="button" class="btn btn-secondary" data-dismiss="modal">لا</button>
		<button type="button" class="btn btn-primary" id="btn-delete-yes">نعم</button>
      </div>
    </div>
  </div>
</div>

	</div>
		<script>
		
		function showAddStudentModal($title) {
			
			$('#addStudentModal .modal-title').html($title);
			if($title=="اضافة طالب"){
			$('#name').val('');
                $('#id_student').val('');
                $('#datepicker').val('');
                $('#mobileNumber').val('');
                $('#email').val('');
                $('#dept').val('');
                $('#id_plan').val('');
			}
			$('#addStudentModal').modal('show');
		
		}
		</script>
		<script>
		$(document).ready(function(){
var row_select='';
			$.ajax({
					url: 'students/loadstudent.php',
					type: 'GET',
					dataType: 'json',
					success: function(data){
						// Clear table
					
						// Loop through data and add rows to table
						$.each(data, function(i, item){
							$('#studentsTable tbody').append('<tr><td>' + item.Id_Student + '</td><td>' + item.Name_Student + '</td><td>' + item.gender + '</td><td>' + item.Date_Birth + '</td><td>' + item.Phone_Student + '</td><td>' + item.Email_Student + '</td><td>' + item.Name_Dept + '</td><td><center><button class="btn btn-sm btn-info edit_student mr-2" data-id="'+item.Id_Student +'"> تعديل </button><button class="btn btn-sm btn-danger remove_student" data-id="'+item.Id_Student +'"> حذف </button></center></td></tr>');
						});
					},
			
					error: function(xhr, status, error){
						console.log(xhr.responseText);
					}
				});
				
				$("#savestudent").click(function(){
					var fun ='add_student';
					if($('#addStudentModal .modal-title').text()!='اضافة طالب')
					fun ='update_student';
					var id_student=$("#id_student").val();
					var s_name=$("#name").val();
					var s_gender=$("#gender").val();
					var birth_date=$("#datepicker").val();
					var phone_no=$("#mobileNumber").val();
					var s_email=$("#email").val();
					var id_dept=$("#dept").val();
					var Id_Plan=$("#id_plan").val();
					var dept_name=$('#dept option:selected').text();
					var gender_name=$('#gender option:selected').text();
					/////  empty iput
				
						
					$.ajax({
						url:'students/ajax_function.php',
						type:'POST',
						data:{oper:fun,id_student:id_student,s_name:s_name,s_gender:s_gender,birth_date:birth_date,phone_no:phone_no,s_email:s_email,id_dept:id_dept,Id_Plan:Id_Plan},
						success:function(data){
							
							if(data==0){
								
							alert("رقم الطالب او رقم الهاتف او عنوان الايميل موجود مسبقا");
							}
							else if(data==3){	alert("يوجد بعض حقول النص فارغة");}
							else{
								var  tr='<tr><td>' + id_student + '</td><td>' + s_name + '</td><td>' + gender_name + '</td><td>' + birth_date + '</td><td>' + phone_no + '</td><td>' + s_email + '</td><td>' +dept_name+ '</td><td><center><button class="btn btn-sm btn-info edit_student mr-2" data-id="'+id_student+'"> تعديل </button><button class="btn btn-sm btn-danger remove_student" data-id="'+id_student +'"> حذف </button></center></td></tr>';
								if(fun=='add_student'){
								$('#studentsTable tbody').append(tr);}
								else{row_select.replaceWith(tr);}
						$("#addStudentModal").modal("hide");
					
							}
					
						}
					});
				});
				
				$('#studentsTable').on('click', '.remove_student', function() {
			
                      var id = $(this).data('id');
					  row_select=$(this).closest('tr');
                    // Show confirmation dialog
                      $('#confirm-delete').modal('show');
                       // Attach click event handler to Yes button in confirmation dialog
                    $('#btn-delete-yes').on('click', function() {
                   // Make AJAX request to delete record from database

					$.ajax({
					url: 'students/ajax_function.php',
					type: 'POST',
						data:{delete_student:true,id_student:id},
					success: function(response) {
						
						// If deletion is successful, remove row from table
						if (response==1) {
							//$(this).closest('tr').remove()
							row_select.remove();
							
					
						}
						
						// Hide confirmation dialog
						$('#confirm-delete').modal('hide');
					}
					});
		
				});
		
			});

			/////edit student
			$('#studentsTable').on('click', '.edit_student', function() {
				var name = $(this).closest('tr').find('td:first-child').text();
    var email = $(this).closest('tr').find('td:nth-child(2)').text();	
				var id = $(this).data('id');
				row_select=$(this).closest('tr');
				var id_student =  $(this).closest('tr').find('td:first-child').text();
				var name =  $(this).closest('tr').find('td:nth-child(2)').text();
				var gender =  $(this).closest('tr').find('td:nth-child(3)').text();
				var datepicker =  $(this).closest('tr').find('td:nth-child(4)').text();;
				var mobileNumber = $(this).closest('tr').find('td:nth-child(5)').text();
				var email =  $(this).closest('tr').find('td:nth-child(6)').text();
				var dept =  $(this).closest('tr').find('td:nth-child(7)').text();
				var id_plan = $(this).closest('tr').find('td:nth-child(8)').text();
 
				// Set the values of the input elements in the modal form
				$('#id_student').val(id_student);
				$('#name').val(name);
				$('#gender option:contains(' + gender + ')').prop('selected', true);
				$('#datepicker').val(datepicker);
				$('#mobileNumber').val(mobileNumber);
				$('#email').val(email);
				$('#dept option:contains(' + dept + ')').prop('selected', true);
		
				$('#id_plan option:contains(' + id_plan + ')').prop('selected', true);
			
		  // Show confirmation dialog
		  showAddStudentModal('تعديل بيانات الطالب');
			 // Attach click event handler to Yes button in confirmation dialog
		
		 // Make AJAX request to delete record from database

		  /*$.ajax({
		  url: 'students/ajax_function.php',
		  type: 'POST',
			  data:{delete_student:true,id_student:id},
		  success: function(response) {
			  
			  // If deletion is successful, remove row from table
			  if (response==1) {
				  //$(this).closest('tr').remove()
				  $('#' + Rowid).remove();
			  $('tr[data-id="' + id + '"]').remove();
			  }
			  
			  // Hide confirmation dialog
			  $('#confirm-delete').modal('hide');
		  }
		  });
*/
	

  });
		
 
    $('#datepicker').datepicker({
      format: 'yyyy-mm-dd',
	  todayHighlight: true,
      autoclose: true
    });


			
		});

	</script>
	
</body>
</html>