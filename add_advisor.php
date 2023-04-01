<?php

include 'login/config.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> اضافة مرشد  </title>
	<!-- Include Bootstrap CSS -->
	<link href="js/css/bootstrap.min.css" rel="stylesheet">
    	<!-- Include Bootstrap JS -->
		<script src="js/js/bootstrap.min.js"></script>
		<script src="js/bootstrap-datepicker.min.js"></script>
		
		<script src="js/js/jquery-3.6.4.min.js"></script>
</head>
<body>

	<div class="container"  style="text-align: right;" >
		<h1> قم باضافة مرشد وسيظهر لك في الجدول اسفل  </h1>
		<button type="button" class="btn btn-primary text-right" onclick="showAddAdvisorModal('اضافة مرشد')">
		اضافة مرشد اكاديمي
		</button>
		<!-- Modal -->
		<div class="modal fade" id="addAdvisorModal" tabindex="-1" role="dialog" aria-labelledby="addAdvisorModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="addAdvisorModalLabel"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="addAdvisorForm">
						<div class="form-group mb-2 text-right">
								<label for="Id_Advisor">الرقم الاكاديمي:</label>
								<input type="text" class="form-control" id="Id_Advisor" name="Id_Advisor" required>
							</div>
							<div class="form-group mb-2 text-right">
								<label for="Name_Advisor">الاسم:</label>
								<input type="text" class="form-control" id="Name_Advisor" name="Name_Advisor" required>
							</div>
							
									  
							  <div class="form-group mb-2 text-right">
								<label for="Phone_Number">رقم التلفون</label>
								<input type="tel" class="form-control" id="Phone_Number" name="Phone_Number" required>
							</div>
							<div class="form-group mb-2 text-right">
								<label for="Email_Advisor">الايميل</label>
								<input type="email" class="form-control" id="Email_Advisor" name="Email_Advisor" required>
							</div>
							<div class="form-group mb-2 text-right">
								<label for="Office_Room">رقم المكتب:</label>
								<input type="text" class="form-control" id="Office_Room" name="Office_Room" required>
							</div>
							<div class="form-group mb-2 text-right">
			                    	<label for="Id_Dept" class="control-label">القسم</label>
				                    <select name="Id_Dept" id="Id_Dept" class="form-control" required>
										<?php $dept =$conn->query("SELECT `Id_Dept`, concat(`Code_Dept`, `Name_Dept` )as 'dept_name' FROM `table_department`");?>
										<?php while($row=$dept->fetch_assoc()){?>
						                 <option value="<?php echo $row['Id_Dept']?>"><?php echo $row['dept_name']?></option>
					                    <?php  }?>
				                    </select>
			                  </div>
							 

						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
						<button type="button" id="saveadvisor" class="btn btn-primary">حفظ</button>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<table id="advisorsTable" class="table">
			<thead>
				<tr>
				<th> الرقم الاكاديمي  </th>
					<th> اسم المشرف </th>
					<th>عنوان الايميل </th>
					<th>رقم الجوال </th>
					<th>رقم المكتب </th>
					<th>القسم </th>
					<th>الاجراء</th>
				</tr>
			</thead>
			<tbody>
				<!-- advisors will be added dynamically here -->
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
		
		function showAddAdvisorModal($title) {
			
			$('#addAdvisorModal .modal-title').html($title);
			if($title=="اضافة مرشد"){
			
                $('#Id_Advisor').val('');
                $('#Name_Advisor').val('');
                $('#Email_Advisor').val('');
                $('#Phone_Number').val('');
                $('#Id_Dept').val('');
				$('#Office_Room').val('');
                $('#id_plan').val('');
			}
			$('#addAdvisorModal').modal('show');
		
		}
		</script>
		<script>
		$(document).ready(function(){
var row_select='';
			$.ajax({
					url: 'academic_advisor/load_advisor.php',
					type: 'GET',
					dataType: 'json',
					success: function(data){
						// Clear table
					
						// Loop through data and add rows to table
						$.each(data, function(i, item){
							$('#advisorsTable tbody').append('<tr><td>' + item.Id_Advisor + '</td><td>' + item.Name_Advisor + '</td><td>' + item.Email_Advisor + '</td><td>' + item.Phone_Number + '</td><td>' + item.Office_Room + '</td><td>' + item.Name_Dept + '</td><td><center><button class="btn btn-sm btn-info edit_advisor mr-2" data-id="'+item.Id_Advisor +'"> تعديل </button><button class="btn btn-sm btn-danger remove_advisor" data-id="'+item.Id_Advisor +'"> حذف </button></center></td></tr>');
						});
					},
			
					error: function(xhr, status, error){
						console.log(xhr.responseText);
					}
				});
				
				$("#saveadvisor").click(function(){
					var fun ='add_advisor';
					if($('#addAdvisorModal .modal-title').text()!='اضافة مرشد')
					fun ='update_advisor';
					var Id_Advisor=$('#Id_Advisor').val();
					var Name_Advisor=$('#Name_Advisor').val();
					var Email_Advisor=$('#Email_Advisor').val();
					var Phone_Number=$('#Phone_Number').val();
					var Office_Room=$('#Office_Room').val();
					var Id_Dept=$('#Id_Dept').val();
             
					var dept_name=$('#Id_Dept option:selected').text();
					
					/////  empty iput
				
						
					$.ajax({
						url:'academic_advisor/Controler_Advisor.php',
						type:'POST',
						data:{oper:fun,Id_Advisor:Id_Advisor,Name_Advisor:Name_Advisor,Email_Advisor:Email_Advisor,Phone_Number:Phone_Number,Office_Room:Office_Room,Id_Dept:Id_Dept},
						success:function(data){
				
							if(data==0){
							alert("رقم المرشد الاكاديمي  او رقم الهاتف او عنوان الايميل موجود مسبقا");
							}
							else if(data==3){	alert("يوجد بعض حقول النص فارغة");}
							else{
									var  tr='<tr><td>' + Id_Advisor + '</td><td>' + Name_Advisor + '</td><td>' + Email_Advisor + '</td><td>' + Phone_Number + '</td><td>' + Office_Room + '</td><td>' + dept_name + '</td><td><center><button class="btn btn-sm btn-info edit_advisor mr-2" data-id="'+Id_Advisor+'"> تعديل </button><button class="btn btn-sm btn-danger remove_advisor" data-id="'+Id_Advisor +'"> حذف </button></center></td></tr>';
									if(fun=='add_advisor'){
									$('#advisorsTable tbody').append(tr);}
									else{row_select.replaceWith(tr);}
									$("#addAdvisorModal").modal("hide");
						
								}
					
						}
					});
				});
				
				$('#advisorsTable').on('click', '.remove_advisor', function() {
			
                      var id = $(this).data('id');
					  row_select=$(this).closest('tr');
                    // Show confirmation dialog
                      $('#confirm-delete').modal('show');
                       // Attach click event handler to Yes button in confirmation dialog
                    $('#btn-delete-yes').on('click', function() {
                   // Make AJAX request to delete record from database
					$.ajax({
					url: 'academic_advisor/Controler_Advisor.php',
					type: 'POST',
						data:{delete_advisor:true,Id_Advisor:id},
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

			/////edit advisor
			$('#advisorsTable').on('click', '.edit_advisor', function() {
				var id = $(this).data('id');
				row_select=$(this).closest('tr');
				var Id_Advisor =  $(this).closest('tr').find('td:first-child').text();
				var Name_Advisor =  $(this).closest('tr').find('td:nth-child(2)').text();
				var Email_Advisor =  $(this).closest('tr').find('td:nth-child(3)').text();
				var Phone_Number =  $(this).closest('tr').find('td:nth-child(4)').text();;
				var Office_Room =  $(this).closest('tr').find('td:nth-child(5)').text();;
				var Id_Dept = $(this).closest('tr').find('td:nth-child(6)').text();
			
 
				// Set the values of the input elements in the modal form
				$('#Id_Advisor').val(Id_Advisor);
				$('#Name_Advisor').val(Name_Advisor);
				$('#Email_Advisor').val(Email_Advisor);
				$('#Phone_Number').val(Phone_Number);
				$('#Office_Room').val(Office_Room);
				$('#Id_Dept option:contains(' + Id_Dept + ')').prop('selected', true);
		  // Show confirmation dialog
		  showAddAdvisorModal('تعديل بيانات المرشد الاكاديمي');

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