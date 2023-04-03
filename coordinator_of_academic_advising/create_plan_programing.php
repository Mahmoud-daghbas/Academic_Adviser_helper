<?php include '../login/config.php';?>
<!DOCTYPE html>
<html>
<head>
  <title>My Web Page</title>
  <link rel="stylesheet" href="../assest/css/bootstrap.min.css">
  <link rel="stylesheet" href="css\create_plan_programing.css">
</head>
<body dir="rtl">
   <div class="container ">
   <div id="form" class="card mt-3">
   <div class="card body">
   <form>
      <table style="font_size:16px;">
           <tr> 
             <td>
               <div class="form-group mb-2 text-right">
                      <label for="Name_Plan">اسم الخطة:</label>
                      <input type="text" class="form-control" id="Name_Plan" name="Name_Plan" required>
						    </div>
            </td>
            <td>
              <div class="form-group mb-2 text-right">
                    <label for="datepicker"> تاريخ انشاء الخطة</label>
                    <input type="text" class="form-control" id="datepicker">
               </div>
							
            </td>
            <td>
              <div class="form-group mb-2 text-right">
                <label for="dept" class="control-label">القسم</label>
                <select name="dept" id="dept" class="form-control" required>
                <?php $dept =$conn->query("SELECT `Id_Dept`, concat(`Code_Dept`, `Name_Dept` )as 'dept_name' FROM `table_department`");?>
                <?php while($row=$dept->fetch_assoc()){?>
                <option value="<?php echo $row['Id_Dept']?>"><?php echo $row['dept_name']?></option>
                  <?php  }?>
                </select>
              </div>
              </td>
                </tr>
                </table>
    </form>
   </div>
  </div>
   </div>
<div id="div_table" class="container">
</div>
    <!-- Add more rows here -->

  <script src="../assest/js/jquery-3.2.1.slim.min.js"></script>
  <script src="../assest/js/popper.min.js"></script>
  <script src="../assest/js/bootstrap.min.js"></script>
  <script src="../assest/js/jquery-3.6.0.min.js"></script>
  <script src="../js/bootstrap-datepicker.min.js"></script>
  
  


<script>
    $(document).ready(function(){
		
			$.ajax({
					url: 'load_plan_program.php',
					type: 'GET',
					success: function(data){
						// Clear table
					
						// Loop through data and add rows to table
					$('#div_table').html(data);
									
					},
			
					error: function(xhr, status, error){
						console.log(xhr.responseText);
					},
          complete: function(jqXHR, textStatus) {
            creat_flocat_button();
          }
				});
        
        $('.remove_row_selected').on('click', function() {
    $('#my-table .selected').remove();
  });
  $('#datepicker').datepicker({
      format: 'yyyy-mm-dd',
	  todayHighlight: true,
      autoclose: true
    });
      });
</script>
<script>
function creat_flocat_button() {
    const  table = $('table');
    const button = $('.floating-action-button');
    table.on('click', 'tbody tr:not(.last-row)', function() {
      button.show();
      button.data('selectedRow', $(this).index());
      // Add active class to the selected row
      $(this).addClass('table-active');
    });

    button.click(function() {
     
      const lastRow =$(this).closest('tr');
      clone_row(function(row){
        //$('tbody').append(row);
        $(lastRow).before(row); 
        
      create_click_button();
       
       });
      
      create_click_button();
      // Remove active class from all rows
     //$('tbody tr').removeClass('table-active');
 

});
 
}
				
  function create_click_button()
  {
    const button_delete=$('.remove_row_selected');
    button_delete.click(function()
  {
   
     var row_select =$(this).closest('tr');
    
     row_select.remove();
  });
  }
function clone_row(callback)
{
  
  $.ajax({
					url: 'clone_row.php',
					type: 'GET',
					success: function(row){
						// Clear table
					
						// Loop through data and add rows to table
            callback(row);
									
					}
				});

}

</script>
    </body>
    </html>