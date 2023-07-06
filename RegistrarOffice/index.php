<?php 
session_start();
if (isset($_SESSION['r_user_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Registrar Office') {
      include "../DB_connection.php";
      include "data/registrar_office.php";
      
      $r_user_id = $_SESSION['r_user_id'];
      $teacher = getR_usersById($r_user_id, $conn);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Ashraf Mohammed Hassan">
	<meta name="description" content="Web designed as a school management platform for Adan Madrassah, Islamic learning institute">
	<meta name="keywords" content="School Management, Adan Madrassa, Islamic">

	<title>Registrar - Home</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../images/Madrassa_logo2.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php 
        include "inc/navbar.php";

        if ($teacher != 0) {
     ?>
     
     <div class="row">
        <div class="col-md-6">
        <div class="container mt-5">
         <div class="card" style="width: 22rem;">
          
          <img src="../img/registrar-office-<?=$teacher['gender']?>.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title text-center">@<?=$teacher['username']?></h5>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Full name: <?=$teacher['fname']?></li>
            
            <li class="list-group-item">Username: <?=$teacher['username']?></li>

            <li class="list-group-item">Employee number: <?=$teacher['employee_number']?></li>
            <li class="list-group-item">Home Location/address: <?=$teacher['address']?></li>
            <li class="list-group-item">Date of birth: <?=$teacher['date_of_birth']?></li>
            <li class="list-group-item">Phone number: <?=$teacher['phone_number']?></li>
            
            <li class="list-group-item">Email<?=$teacher['email_address']?></li>
            <li class="list-group-item">Gender: <?=$teacher['gender']?></li>
            <li class="list-group-item">Date: <?=$teacher['date_of_joined']?></li>

          </ul>
        </div>
     </div>
        </div>
        <div class="col-md-6">
        <div class="container mt-5">
         <div class="container text-center">
             <div class="row row-cols-5">
               <a href="student.php" 
                  class="col btn btn-dark m-2 py-3 col-5">
                 <i class="fa fa-user-plus fs-1" aria-hidden="true"></i><br>
                  Register Students
               </a> 
               <a href="teacher.php" class="col btn btn-dark m-2 py-3 col-5">
                 <i class="fa fa-user-plus fs-1" aria-hidden="true"></i><br>
                 Register Teachers
               </a>
               <br>
               
               <a href="stats.php" class="col btn btn-dark m-2 py-3 col-5">
                 <i class="fa fa-columns fs-1" aria-hidden="true"></i><br>
                  Statistics
               </a> 
               
               <a href="pass.php" class="col btn btn-info m-2 py-3 col-5">
                 <i class="fa fa-cogs fs-1" aria-hidden="true"></i><br>
                  Change Password
               </a> 
               <a href="../logout.php" class="col btn btn-warning m-2 py-3 col-10">
                 <i class="fa fa-sign-out fs-1" aria-hidden="true"></i><br>
                  Logout
               </a> 
             </div>
          </div>
        </div>
        </div>
    </div>
     <?php 
        }else {
          header("Location: logout.php?error=An error occurred");
          exit;
        }
     ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(1) a").addClass('active');
        });
    </script>

</body>
</html>
<?php 

  }else {
    header("Location: ../login.php");
    exit;
  } 
}else {
	header("Location: ../login.php");
	exit;
} 

?>