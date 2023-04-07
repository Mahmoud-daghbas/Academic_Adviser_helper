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
                <div class="card-body" style="text-align: center;">
                    <h5 class="card-title"> الاسم رغد </h5>
                    <p class="card-text"> الايميل: person@example.com</p>
                    <p class="card-text">اسم المستخدم: person_username</p>
                </div>
            </div>
            <div class="list-group"  >
            <a href="#" class="list-group-item list-group-item-action" data-content="add_courcses.php"> ادارة المواد </a>
                <a href="#" class="list-group-item list-group-item-action" data-content="add_levels.php"> ادارة المستويات</a>
                  
                <a href="#" class="list-group-item list-group-item-action" data-content="coordinator_of_academic_advising/create_plan_programing.php"> انشاء خطة  جديدة </a>
                <a href="#" class="list-group-item list-group-item-action" data-content="coordinator_of_academic_advising/update_plan_programing.php"> تعديل خطة </a>
                          
            </div>
        </div>
        <div class="content">
      
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
  
  
   
</html>

