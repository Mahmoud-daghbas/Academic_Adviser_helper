<?php include '../login/config.php';
header("Cache-Control: no-cache, must-revalidate");?>
<section id="" class="d-flex align-items-center">
<main id="main">
   <div class="container ">
   <div id="form" class="card mt-3">
   <div class="card body">
<<<<<<< HEAD
   
   <fieldset>
   <legend>بيانات الخطة</legend>
             <div class="form-group mb-2 text-right" style="display:none;">
                   <?php
                    $max_id_plan=$conn->query("SELECT (ifNull( max( `Id_Plan`) ,0)+1) 'Id_Plan' FROM `table_header_program_study_plan`")->fetch_assoc()['Id_Plan'];

                   ?>
                      <input type="text" class="form-control" id="Id_Plan" name="Id_Plan"  value="<?=$max_id_plan;?>"required>
						    </div>
            
           
=======
   <form>
      <table >
           <tr> 
             <td>
>>>>>>> 15c8bba3fdd6113fc77c1a32947488922b3e5961
               <div class="form-group mb-2 text-right">
                      <label for="Name_Plan">اسم الخطة:</label>
                      <input type="text" class="form-control" id="Name_Plan" name="Name_Plan" required>
						    </div>
            
            
              <div class="form-group mb-2 text-right">
                    <label for="datepicker"> تاريخ انشاء الخطة</label>
                    <input type="text" class="form-control" id="datepicker">
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
              <button class=" w-30 h-50 float-right ml-2 btn btn-primary" id="save_plan" style="margin-top: 2rem;"><i class="fa fa-save"></i> حفظ</button>
              <button class="w-30 h-50 float-right  mr-2 rem btn btn-primary" id="select_plan"style="margin-top: 2rem;"><i class="fa fa-select"></i> استيراد بيانات الخطة من خطة سابقة</button>
      
                </fieldset>
             
  
     
   </div>
  </div>
   </div>
<div id="div_table" class="container">
</div>
<!--model confirm empty text -->
<div class="modal" id="confirm-empty">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">وجود قيم فارغة</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body mb-2 text-right">
        هناك قيم فارغة هل تريد حفظ البيانات التي تم تعبئتها فقط؟
      </div>
      <div class="modal-footer">
      
        <button type="button" class="btn btn-secondary" data-dismiss="modal">لا</button>
		<button type="button" class="btn btn-primary" id="btn-empty-yes">نعم</button>
      </div>
    </div>
  </div>
                </div>
  <!--model select plan to import data -->
<div class="modal" id="data_plan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">اختر الخطة</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body mb-2 text-right">
      <div class="form-group mb-2 text-right">
                    <label for="id_plan_m" class="control-label">الخطة الدراسية</label>
                    <select name="id_plan_m" id="id_plan_m" class="form-control" required>
                    </select>
                </div>  
      </div>
      <div class="modal-footer">
      
        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
		
        <button type="button" class="btn btn-primary" id="btn-import-yes">استيراد</button>
      </div>
    </div>
  </div>
</div>
 
</main>
</section>
    <!-- Add more rows here -->

<script>
    $(document).ready(function(){
      $('#datepicker').datepicker({
      format: 'yyyy-mm-dd',
	  todayHighlight: true,
      autoclose: true
    });
    load_plan('coordinator_of_academic_advising/load_plan_programing_after_created.php?Id_plan=-1');
var check_value_empty=0;
		
        
   $('.remove_row_selected').on('click', function() {
    $('#my-table .selected').remove();
  });
 //event save-----------------------------

$('#save_plan').click(function(e){
      var data = [];
      var Id_Plan = $('#Id_Plan').val();
      var Name_Plan=$('#Name_Plan').val();
      var Date_create=$('#datepicker').val();
      var Id_Dept=$('#Id_Dept').val();
// Loop through all tables
$('table').each(function() {
var Id_level=$(this).data('value');
  // Retrieve data from current table
  $(this).find('tbody tr').each(function() {
    if($(this).closest('tr').find('td:nth-child(1)').text()!='+')
    {
    var row = {};
    row.Id_Course = $(this).find('td:eq(0) select').val();
    var inputElement = $(this).closest('tr').find('input[name="Hour_Plan_Credit"]');
    row.Hour_Plan_Credit=inputElement.val();
    // Get value of input element
    row.Course_Type = $(this).find('td:eq(2)  select').val();
    row.Id_level = Id_level;
    row.pre_requisites = $(this).find('td:eq(3) select').val();
   // alert("course"+  row.Id_Course +"type_corse "+row.Course_Type+"levels"+row.Id_level+"hour_plan_credit"+row.Hour_Plan_Credit);
    if(row.Id_Course!="" && row.Hour_Plan_Credit!="" && row.Course_Type!="" && row.Id_level!="")
    {
      data.push(row);
    }
    else{
      check_value_empty=1;
    }    
      }
  });
});
let isConfirmed = false;
if(check_value_empty==1)
{

  $('#confirm-empty').modal('show');
    // Attach click event handler to Yes button in confirmation dialog
      $(document).on('click',"#btn-empty-yes", function(e) {
      if (!isConfirmed) {
// mark the confirmation as triggered
      isConfirmed = true;        // Make AJAX request to empty record from database
        $('#confirm-empty').modal('hide');
        check_value_empty=0;
      
        save_plan_programing(Id_Plan,Name_Plan,Date_create,Id_Dept,data);
        }
	});
}else
{
  save_plan_programing(Id_Plan,Name_Plan,Date_create,Id_Dept,data);
}
});
// end event save----------------
//event import plan data
$('#select_plan').click(function()
{
  var Id_Dept=$('#Id_Dept').val();
  $.ajax({
      type: 'POST',
      url: 'coordinator_of_academic_advising/Controler_plan_program.php',
      data: {oper:'select',Id_Dept:Id_Dept },
      dataType:'json',
      success: function(data) {
        var option='';
     $.each(data,function(i,item){
      option+='<option value="'+item.Id_Plan+'">'+item.Name_Plan+'</option>';
     
     });
       $('#id_plan_m').html(option);
      }
    });
    $('#data_plan').modal('show');

});
$('#btn-import-yes').click(function()
{var id_plan=$('#id_plan_m').val();

  $('#data_plan').modal('hide');
  load_plan('coordinator_of_academic_advising/load_plan_programing_after_created.php?Id_plan='+id_plan);

})
    });
</script>


<script>
  //all function
  function save_plan_programing(Id_Plan,Name_Plan,Date_create,Id_Dept,data)
  {
    $.ajax({
      type: 'POST',
      url: 'coordinator_of_academic_advising/Controler_plan_program.php',
      data: {oper:'insert',Id_Plan:Id_Plan,Name_Plan:Name_Plan,Date_create:Date_create,Id_Dept:Id_Dept ,data: JSON.stringify(data) },
      success: function(response) {
      alert("تم الحفظ بنجاح");
       
      }
    });
  }
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
					url: 'coordinator_of_academic_advising/clone_row.php',
					type: 'GET',
					success: function(row){
						// Clear table
					
						// Loop through data and add rows to table
            callback(row);
									
					}
				});

}
function load_plan(url)
{
  $.ajax({
					url: url,
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
}

window.start_load = function(){
    $('body').prepend('<di id="preloader2"></di>')
  }
  window.end_load = function(){
    $('#preloader2').fadeOut('fast', function() {
        $(this).remove();
      })
  }

</script>
   