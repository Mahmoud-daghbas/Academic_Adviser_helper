<?php

include 'login/config.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> اضافة المواد  </title>
	<!-- Include Bootstrap CSS -->
	<link href="js/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/js/bootstrap.min.js"></script>
</head>
<body dir="rtl">

<div class="container"  style="text-align: right;" >
		<h1> قم باضافةمادةوسيظهر لك في الجدول اسفل  </h1>
		<button type="button" class="btn btn-primary text-right" onclick="showAddCoursesModal('اضافة مادة')">اضافة
		</button>
		
		<!-- Modal -->
		<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="addCourseModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="addCourseModalLabel" value=""></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="addCourseForm">
						<div class="form-group mb-2 text-right">
								<label for="Course_Code">كود المادة</label>
								<input type="text" class="form-control" id="Course_Code" name="Course_Code" required>
							</div>
							<div class="form-group mb-2 text-right">
								<label for="Name_Course">اسم المادة</label>
								<input type="text" class="form-control" id="Name_Course" name="Name_Course" required>
							</div>
							
									  
							  <div class="form-group mb-2 text-right">
								<label for="Hour_Credit">الساعات المعتمدة</label>
								<input type="number"  class="form-control " min="1"  oninput="validity.valid||(value='')" id="Hour_Credit" name="Hour_Credit" required >

							</div>
							<div class="form-group mb-2 text-right">
								<label for="short_description">وضف المادة</label>
								<input type="text" class="form-control" id="short_description" name="short_description" required>
							</div>
							
						
							 

						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
						<button type="button" id="saveCourse" class="btn btn-primary">حفظ</button>
					</div>
				</div>
			</div>
		</div>
</div >
		<hr>
		
		<table id="CoursesTable" class="table "style="text-align: center;"  dir="rtl"  >
			<thead>
				<tr>
				<th> كود المادة</th>
					<th> اسم المادة </th>
					<th>الساعات المعتمدة</th>
					<th>وصف المادة </th>
				
					<th>الاجراء</th>
				</tr>
			</thead>
			<tbody>
				<!-- Courses will be added  here -->
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
		<script>
		function showAddCoursesModal($title) {
			
			$('#addCourseModal .modal-title').html($title);
			if($title=="اضافة مادة"){
			
                $('#Course_Code').val('');
                $('#Name_Course').val('');
                $('#Hour_Credit').val('');
                $('#short_description').val('');
              
			}
			$('#addCourseModal').modal('show');
		
		}
		</script>
		<script>
		function load_coursess()
		{
			$.ajax({
					url: 'file_opertion_courses/load_courses.php',
					type: 'GET',
					dataType: 'json',
					success: function(data){
						// Clear table
						$('#CoursesTable tbody').html('');
						// Loop through data and add rows to table
						$.each(data, function(i, item){
							$('#CoursesTable tbody').append('<tr><td>' + item.Course_Code + '</td><td>' + item.Name_Course + '</td><td>' + item.Hour_Credit + '</td><td>' + item.short_description + '</td><td><center><button class="btn btn-sm btn-info edit_Course mr-2" data-id="'+item.Id_Course +'"> تعديل </button><button class="btn btn-sm btn-danger remove_Course" data-id="'+item.Id_Course +'"> حذف </button></center></td></tr>');
						});
					},
			
					error: function(xhr, status, error){
						console.log(xhr.responseText);
					}
				});
		}
		</script>
		<script>
		$(document).ready(function(){
var row_select='';
		

load_coursess();
				$("#saveCourse").click(function(){
					var fun ='add_Course';
					if($('#addCourseModal .modal-title').text()!='اضافة مادة')
					fun ='update_Course';
					var Course_Code=$('#Course_Code').val();
					var Name_Course=$('#Name_Course').val();
					var Hour_Credit=$('#Hour_Credit').val();
					var short_description=$('#short_description').val();
				
					var Id_Course=$('#addCourseModalLabel').val();
				
					
					/////  empty iput
				
						
					$.ajax({
						url:'file_opertion_courses/Controler_Course.php',
						type:'POST',
						data:{oper:fun,Id_Course:Id_Course,Course_Code:Course_Code,Name_Course:Name_Course,Hour_Credit:Hour_Credit,short_description:short_description},
						success:function(data){
			
							if(data==0){
							alert("المادة موجودة مسبقا");
							}
							else if(data==3){	alert("يوجد بعض حقول النص فارغة");}
							else{
								load_coursess();
								$("#addCourseModal").modal("hide");
						
								}
					
						}
					});
				});
				
				$('#CoursesTable').on('click', '.remove_Course', function() {
			
                      var id = $(this).data('id');
					  row_select=$(this).closest('tr');
                    // Show confirmation dialog
                      $('#confirm-delete').modal('show');
                       // Attach click event handler to Yes button in confirmation dialog
                    $('#btn-delete-yes').on('click', function() {
                   // Make AJAX request to delete record from database
					$.ajax({
					url: 'file_opertion_courses/Controler_Course.php',
					type: 'POST',
						data:{delete_Course:true,Id_Course:id},
					success: function(response) {
						
						// If deletion is successful, remove row from table
						if (response==1) {
							
							row_select.remove();
						}
						// Hide confirmation dialog
						$('#confirm-delete').modal('hide');
					}
					});
		
				});
		
			});

			/////edit Course
			$('#CoursesTable').on('click', '.edit_Course', function() {
				var id = $(this).data('id');
				row_select=$(this).closest('tr');
				var Course_Code =  $(this).closest('tr').find('td:first-child').text();
				var Name_Course =  $(this).closest('tr').find('td:nth-child(2)').text();
				var Hour_Credit =  $(this).closest('tr').find('td:nth-child(3)').text();
				var short_description =  $(this).closest('tr').find('td:nth-child(4)').text();;
			
				$('#addCourseModalLabel').val(id);
				
				// Set the values of the input elements in the modal form
				$('#Course_Code').val(Course_Code);
				$('#Name_Course').val(Name_Course);
				$('#Hour_Credit').val(Hour_Credit);
				$('#short_description').val(short_description);
			
		  // Show confirmation dialog
		  showAddCoursesModal('تعديل بيانات المادة');
  });
		
 


			
		});

	</script>
	
</body>
</html>