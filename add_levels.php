<?php

include 'login/config.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> اضافة المستويات  </title>
	<!-- Include Bootstrap CSS -->

</head>
<body dir="rtl">

<div class="container"  style="text-align: right;" >
	
		<button type="button" class="btn btn-primary text-right" onclick="showAddlevelModal('اضافة مستوى')">اضافة
		</button>
		
		<!-- Modal -->
		<div class="modal fade" id="addlevelModal" tabindex="-1" role="dialog" aria-labelledby="addlevelModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="addlevelModalLabel" value=""></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="addlevelForm">
						
							<div class="form-group mb-2 text-right">
								<label for="Name_Level">اسم المستوى</label>
								<input type="text" class="form-control" id="Name_Level" name="Name_Level" required>
							</div>
							 

						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
						<button type="button" id="savelevel" class="btn btn-primary">حفظ</button>
					</div>
				</div>
			</div>
		</div>
</div >
		
		<div style="height: 300px; overflow-y: scroll;">
		<table id="levelTable" class="table "style="text-align: center;"  dir="rtl"  >
			<thead >
				<tr>
					<th style="position: sticky; top: 0; background-color: #fff"> اسم المستوى </th>
				
					<th style="position: sticky; top: 0; background-color: #fff;">الاجراء</th>
				</tr>
			</thead>
			
			<tbody>
				<!-- level will be added  here -->
			</tbody>
			
		</table>
</div>
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
		function showAddlevelModal($title) {
			
			$('#addlevelModal .modal-title').html($title);
			if($title=="اضافة مستوى"){
			
              
                $('#Name_Level').val('');
              
              
			}
			$('#addlevelModal').modal('show');
		
		}
		</script>
		<script>
		function load_levels()
		{
			$.ajax({
					url: 'file_opertion_levels/Controler_level.php?select_level=true',
					type: 'GET',
					dataType: 'json',
					success: function(data){
						// Clear table
						$('#levelTable tbody').html('');
						// Loop through data and add rows to table
						$.each(data, function(i, item){
							$('#levelTable tbody').append('<tr><td>' + item.Name_Level + '</td><td><center><button class="btn btn-sm btn-info edit_level mr-2" data-id="'+item.Id_Level +'"> تعديل </button><button class="btn btn-sm btn-danger remove_level" data-id="'+item.Id_Level +'"> حذف </button></center></td></tr>');
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
		

load_levels();
				$("#savelevel").click(function(){
					var fun ='add_Level';
					if($('#addlevelModal .modal-title').text()!='اضافة مستوى')
					fun ='update_Level';
					var Name_Level=$('#Name_Level').val();
					var Id_level=$('#addlevelModalLabel').val();
					$.ajax({
						url:'file_opertion_levels/Controler_level.php',
						type:'POST',
						data:{oper:fun,Id_Level:Id_level,Name_Level:Name_Level},
						success:function(data){
	
							 if(data==3){	alert("يوجد بعض حقول النص فارغة");}
							  else{
								load_levels();
								$("#addlevelModal").modal("hide");
						
								}
					
						}
					});
				});
				
				$('#levelTable').on('click', '.remove_level', function() {
			
                      var id = $(this).data('id');
					  row_select=$(this).closest('tr');
                    // Show confirmation dialog
                      $('#confirm-delete').modal('show');
                       // Attach click event handler to Yes button in confirmation dialog
                    $('#btn-delete-yes').on('click', function() {
                   // Make AJAX request to delete record from database
					$.ajax({
					url: 'file_opertion_levels/Controler_level.php',
					type: 'POST',
						data:{delete_Level:true,Id_Level:id},
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

			/////edit level
			$('#levelTable').on('click', '.edit_level', function() {
				var id = $(this).data('id');
				row_select=$(this).closest('tr');
                var Name_Level =  $(this).closest('tr').find('td:first-child').text();
				$('#addlevelModalLabel').val(id);
				// Set the values of the input elements in the modal for
				$('#Name_Level').val(Name_Level);
		  // Show confirmation dialog
		  showAddlevelModal('تعديل بيانات المستوى');
  });
		
 


			
		});

	</script>
	
</body>
</html>