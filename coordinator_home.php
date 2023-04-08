<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Side Menu with Content</title>
    <?php
    include('incloude/header.php');

    ?>
   
    <style>
        .side-menu {
            width: 30%;
            height: 100vh;
            overflow-y: auto;
            position: fixed;
            padding: 5px;
            background-color: #f8f9fa;
        }
        .content {
            margin-right: 30%;
            padding: 1rem;
        }
        .jumbotron1{
            padding: 5px;
           
        }
        .side-menu {
      float: right;
    }
    
    .list-group-item {
      float: right;
    }
    
    .list-group-item.active {
      float: right;
    }
    </style>
</head>
<body>

        <div class="jumbotron1">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h5 class="display-6">مرحباً بك!</h5>
                <p class="lead">نحن سعداء لزيارتك لموقعنا.</p>
              </div>
              <div>
                <img src="images/logo.png" alt="Logo" class="img-fluid" style="max-width: 15%;">
              </div>
            </div>
            <hr class="">
          </div>
     
    </div>

        <div class="side-menu"  style="text-align: right;"  >
            <div class="card mb-3 text-center">
                <img src="images/logo.png" alt="person" class="img-fluid" style="max-width: 15%; margin: auto;">
               
            </div>
            <div class="list-group"  >
            <a href="#" class="list-group-item list-group-item-action" data-content="add_courcses.php"> ادارة المواد </a>
                <a href="#" class="list-group-item list-group-item-action" data-content="add_levels.php"> ادارة المستويات</a>
              
                <a href="#" class="list-group-item list-group-item-action" data-content="coordinator_of_academic_advising/create_plan_programing.php"> انشاء خطة  جديدة </a>
                <a href="#" class="list-group-item list-group-item-action" data-content="coordinator_of_academic_advising/update_plan_programing.php"> تعديل خطة </a>
                <a href="#" class="list-group-item list-group-item-action" data-content="coordinator_of_academic_advising/load_plan_and_deatails.php"> عرض الخطط</a>
         
            </div>
        </div>
        <div class="content">
      
        </div>
       
       
        </div>
        <div class="modal fade" id="advisorModal" value="" tabindex="-1" role="dialog" aria-labelledby="addvisorModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="advisorModalLabel">اختر المرشدين المطلوب مشاركة الخطة معهم </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table id="advisorsTable" class="table">

						<tbody>
						
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"> الغاء </button>
					<button type="button" class="btn btn-primary" id="saveAdvisorsBtn"> حفظ </button>
				</div>
			</div>
		</div>
	</div>
    </body>
    <script>
         $(document).ready(function () {
      $(".list-group-item").on("click", function (e) {
        e.preventDefault();
        const contentUrl = $(this).data("content");
    
        $(".list-group-item").removeClass("active");
        $(this).addClass("active");
    
  
      $('#saveAdvisorsBtn').on('click',function()
      {
        var select_advisor=[];
        var id_plan_shar=$('#advisorModal').val();
      
 $('.AdvisorCheckbox:checked').each(function() {
  select_advisor.push($(this).val());
});

  $.ajax({
          url:'coordinator_of_academic_advising/connection_with_advisor.php',
          method: "post",
        data:{oper:"insert",Id_Plan:id_plan_shar,Id_Advisor:select_advisor},
          success: function (data) {
          alert('تمت مشاركة الخطة بنجاح');
          $('#advisorModal').modal('hide');
          },
     
    });
  });

    // your AJAX code here
     $.ajax({
          url: contentUrl,
          method: "GET",
        
          success: function (data) {
            $(".content").html(data);
          },
          error: function () {
            $(".content").html(
              '<div class="alert alert-danger"> Failed to load content. </div>'
            );
          },
          
  
        });

      });
    });

    </script>
      <script>
        function select(ContenUrl,tag_controler,data=null)
        {
       

$.ajax({
  
          url:ContenUrl,
          type:'POST',
          data:{oper:tag_controler,data:data},
          dataType:'json',
          success:function(data)
          {
            var tr='';
            $("#advisorsTable tbody").html('');
            if(data=="")
            {
              $("#advisorsTable tbodyt").html(
              '<tr><td><div class="alert alert-danger">لايوجد مرشدين في هذا القسم. </div></tr></td>');
            }
           
            $.each(data,function(i,item){
              $("#advisorsTable tbody").append('<tr><td><center> '+item.Name_Advisor+'</center></td><td><input type="checkbox" class="AdvisorCheckbox" name="Advisor" value="'+item.Id_Advisor+'"></td></tr>');

                       });},
                       error: function () {
            $("#advisorsTable tbodyt").html(
              '<div class="alert alert-danger">لايوجد مرشدين في هذا القسم. </div>'
            );
          }
          
  

          
          
      
});



        }
      </script>
   
</html>

