<?php
include"login/config.php";
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
		 else if($row["u_type"]==2)
     {
      header('location:coordinator_home.php');
     }
				$user_sucess=1;
			}
			
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
	    <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-body text-white">
      </div>
    </div>
<body style="direction: rtl;">
   
<div class="form-container rtl">

   <form action="" method="post">
      <h3>تسجيل الدخول</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="username" required placeholder="ادخل اسم المستخدم">
      <input type="password" name="password" required placeholder="ادخل كلمة المرور">
      <input type="submit" name="submit" value="تسجيل الدخول" class="form-btn">
     
   </form>

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