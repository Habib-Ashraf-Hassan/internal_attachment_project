<?php 
session_start();
if (isset($_SESSION['r_user_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Registrar Office') {
       include "../DB_connection.php";
       include "data/student.php";
       include "data/stats.php";
       include "data/setting.php";
       $students = getAllstats($conn);
       $settings = getSetting($conn);
       $current_year = $settings['current_year'];
       $previous_year = $current_year - 1;
       $previous_previous_year = $previous_year - 1;
       $current_year_stats = getStatsbyYear($current_year, $conn);
       $previous_year_stats = getStatsbyYear($previous_year, $conn);
       $previous_previous_year_stats = getStatsbyYear($previous_previous_year, $conn);
       
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registrar - Stats</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../images/Madrassa_logo2.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php 
        include "inc/navbar.php";
        if ($students != 0) {
     ?>
     <div class="container mt-5">
        <h3>General Stats</h3>
           
           <div class="table-responsive">
              <table class="table table-bordered mt-3 n-table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Total Teachers</th>
                    <th scope="col">Total Students</th>
                    <th scope="col">Total Registrars</th>
                    <th scope="col">Male teachers</th>
                    <th scope="col">Female teachers</th>
                    <th scope="col">Male students</th>
                    <th scope="col">Female students</th>
                    <th scope="col">Male Registrars</th>
                    <th scope="col">Female Registrars</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0; foreach ($students as $student ) { 
                    $i++;  ?>
                  <tr>
                    <th scope="row"><?=$i?></th>
                    <td><?=$student['total_teachers']?></td>
                    <td>
                        <?=$student['total_students']?>
                      </a>
                    </td>
                    <td><?=$student['total_registrars']?></td>
                    <td><?=$student['male_teachers']?></td>
                    <td><?=$student['female_teachers']?></td>
                    <td><?=$student['male_students']?></td>
                    <td><?=$student['female_students']?></td>
                    <td><?=$student['male_registrars']?></td>
                    <td><?=$student['female_registrars']?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
           </div>
         <?php }else{ ?>
             <div class="alert alert-info .w-450 m-5" 
                  role="alert">
                Empty!
              </div>
         <?php } ?>
     </div>
     <div class="container mt-5">
      <h3>Stats for <?=$current_year?></h3>
        <?php if($current_year_stats != 0){

            
        ?>
        <div class="table-responsive">
          <table class="table table-bordered mt-3 n-table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Total Teachers</th>
                    <th scope="col">Total Students</th>
                    <th scope="col">Total Registrars</th>
                    <th scope="col">Male teachers</th>
                    <th scope="col">Female teachers</th>
                    <th scope="col">Male students</th>
                    <th scope="col">Female students</th>
                    <th scope="col">Male Registrars</th>
                    <th scope="col">Female Registrars</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0; foreach ($current_year_stats as $c_stats) { 
                    $i++;  ?>
                  <tr>
                    <th scope="row"><?=$i?></th>
                    <td><?=$c_stats['total_teachers']?></td>
                    <td>
                        <?=$c_stats['total_students']?>
                      </a>
                    </td>
                    <td><?=$c_stats['total_registrars']?></td>
                    <td><?=$c_stats['male_teachers']?></td>
                    <td><?=$c_stats['female_teachers']?></td>
                    <td><?=$c_stats['male_students']?></td>
                    <td><?=$c_stats['female_students']?></td>
                    <td><?=$c_stats['male_registrars']?></td>
                    <td><?=$c_stats['female_registrars']?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
        </div>
        <?php } else{ ?>
          <div class="alert alert-info .w-450 m-5" 
                  role="alert">
                Empty!
              </div>
        <?php } ?>

     </div>

     <div class="container mt-5">
      <h3>Stats for <?=$previous_year?></h3>
        <?php if($previous_year_stats != 0){

            
        ?>
        <div class="table-responsive">
          <table class="table table-bordered mt-3 n-table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Total Teachers</th>
                    <th scope="col">Total Students</th>
                    <th scope="col">Total Registrars</th>
                    <th scope="col">Male teachers</th>
                    <th scope="col">Female teachers</th>
                    <th scope="col">Male students</th>
                    <th scope="col">Female students</th>
                    <th scope="col">Male Registrars</th>
                    <th scope="col">Female Registrars</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0; foreach ($previous_year_stats as $p_stats) { 
                    $i++;  ?>
                  <tr>
                    <th scope="row"><?=$i?></th>
                    <td><?=$p_stats['total_teachers']?></td>
                    <td>
                        <?=$p_stats['total_students']?>
                      </a>
                    </td>
                    <td><?=$p_stats['total_registrars']?></td>
                    <td><?=$p_stats['male_teachers']?></td>
                    <td><?=$p_stats['female_teachers']?></td>
                    <td><?=$p_stats['male_students']?></td>
                    <td><?=$p_stats['female_students']?></td>
                    <td><?=$p_stats['male_registrars']?></td>
                    <td><?=$p_stats['female_registrars']?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
        </div>
        <?php } else{ ?>
          <div class="alert alert-info .w-450 m-5" 
                  role="alert">
                Empty!
              </div>
        <?php } ?>

     </div>

     <div class="container mt-5">
      <h3>Stats for <?=$previous_previous_year?></h3>
        <?php if($previous_previous_year_stats != 0){

            
        ?>
        <div class="table-responsive">
          <table class="table table-bordered mt-3 n-table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Total Teachers</th>
                    <th scope="col">Total Students</th>
                    <th scope="col">Total Registrars</th>
                    <th scope="col">Male teachers</th>
                    <th scope="col">Female teachers</th>
                    <th scope="col">Male students</th>
                    <th scope="col">Female students</th>
                    <th scope="col">Male Registrars</th>
                    <th scope="col">Female Registrars</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0; foreach ($previous_previous_year_stats as $pp_stats) { 
                    $i++;  ?>
                  <tr>
                    <th scope="row"><?=$i?></th>
                    <td><?=$pp_stats['total_teachers']?></td>
                    <td>
                        <?=$pp_stats['total_students']?>
                      </a>
                    </td>
                    <td><?=$pp_stats['total_registrars']?></td>
                    <td><?=$pp_stats['male_teachers']?></td>
                    <td><?=$pp_stats['female_teachers']?></td>
                    <td><?=$pp_stats['male_students']?></td>
                    <td><?=$pp_stats['female_students']?></td>
                    <td><?=$pp_stats['male_registrars']?></td>
                    <td><?=$pp_stats['female_registrars']?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
        </div>
        <?php } else{ ?>
          <div class="alert alert-info .w-450 m-5" 
                  role="alert">
                Empty!
              </div>
        <?php } ?>

     </div>
     
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(4) a").addClass('active');
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