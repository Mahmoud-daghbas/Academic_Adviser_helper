<?php
include "login/config.php";
	session_start();
$user_sucess=0;
	if(isset($_POST["submit"]))
	{
		 $username = mysqli_real_escape_string($conn, $_POST['username']);
   $pass = $_POST['password'];

		if(isset($_POST['username']) && isset($_POST["password"]))
		{
			$select="select * from table_users where username ='$username' and password ='$pass'";
			$result= mysqli_query($conn,$select);
	   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

     $_SESSION["u_type"]=$row["u_type"];
		   if($row["u_type"]==1)
		   header('location:unit_home.php');
				$user_sucess=1;
			}
			
		}
	}
?>

<?php include "incloude/header.php" ?>
<body dir="rtl">
   <div class="container my-5">
      <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
         <div class="toast-body text-white"></div>
      </div> <div class="row justify-content-center">
     <div class="col-md-6">
        <div class="card">
           <div class="card-body">
              <h3 class="card-title text-center mb-4">تسجيل الدخول</h3>
              <?php
              if(isset($error)){
                 foreach($error as $error){
                    echo '<div class="alert alert-danger">'.$error.'</div>';
                 };
              };
              ?>
              <form action="" method="post">
                 <div class="form-group">
                    <label for="username">اسم المستخدم</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                 </div>
                 <div class="form-group">
                    <label for="password">كلمة المرور</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                 </div>
                 <div class="form-group text-center">
                    <button type="submit" name="submit" class="btn btn-primary">تسجيل الدخول</button>
                 </div>
              </form>
           </div>
        </div>
     </div>
  </div>
            </body>
</html>

<script src="js/jquery-3.6.4.min.js"></script>
<script>
	  window.alert_toast= function($msg = 'TEST',$bg = 'success'){
      $('#alert_toast').removeClass('bg-success')
      $('#alert_toast').removeClass('bg-danger')
      $('#alert_toast').removeClass('bg-info')
      $('#alert_toast').removeClass('bg-warning')

    if($bg == 'success')
      $('#alert_toast').addClass('bg-success')
    if($bg == 'danger')
      $('#alert_toast').addClass('bg-danger')
    if($bg == 'info')
      $('#alert_toast').addClass('bg-info')
    if($bg == 'warning')
      $('#alert_toast').addClass('bg-warning')
    $('#alert_toast .toast-body').html($msg)
    $('#alert_toast').toast({delay:3000}).toast('show');
  }
var u_type =<?php echo $user_sucess?>;
$("document").ready(function(){
	$(".form-btn").click(function(){
	
	alert_toast('تمت عملية تسجيل الدخول', 'success');

	if(u_type===1){
	
    			
		
	}else
	{
		
		  alert_toast('حدث خطأ', 'danger');}
		});
});
</script>