<?php 
session_start();
if (isset($_SESSION['teacher_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Teacher') {
      
       include "../DB_connection.php";
       include "data/subject.php";
       include "data/grade.php";
       include "data/student.php";
       include "data/teacher.php";
       include "data/setting.php";

       $subjects = getAllSubjects($conn);
       $grades = getAllGrades($conn);
       $teacher_id = $_SESSION['teacher_id'];
       $teacher = getTeacherById($teacher_id, $conn);
       
       $student_id = $_GET['student_id'];
       $student = getStudentById($student_id, $conn);
       $settings = getSetting($conn);
       $student_grade_id = $student['grade'];

       if ($student == 0) {
         header("Location: student.php");
         exit;
       }


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Teacher - Grade Student</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../images/Madrassa_logo2.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php 
        include "inc/navbar.php";
     ?>
     <div class="container mt-5">
        <a href="student-enter-grade.php"
           class="btn btn-dark">Go Back</a>
        <div class="d-flex justify-content-center align-items-center flex-column">
        <form method="post"
              class="shadow p-3 mt-5 form-w" 
              action="req/save-results.php">
            <h3>Grade Student: </h3>
            <?php
            $student_grade = getGradeById($student['grade'], $conn);
            
            ?>
            
            @<?=$student['username']?><br>
            <b>Name: </b><?=$student['fname']?><br>
            <b>Class: </b><?=$student_grade['grade_code'].'-'.$student_grade['grade']?><br><br>
            <span class="d-flex justify-content-center align-items-center flex-column">

            Year: <b><?=$settings['current_year']?></b>
            Term: <b><?=$settings['current_semester']?></b>
            </span>
            <br>
            


        <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
           <?=$_GET['error']?>
          </div>
        <?php } ?>
        <?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success" role="alert">
           <?=$_GET['success']?>
          </div>
        <?php } ?>

        <div class="input-group mb-3">
                  <input type="number" min="0" max="100" class="form-control" name="a1">
                  <span class="input-group-text">/</span>
                  <input type="number" min="0" max="100" class="form-control" 
                  name="aoutof1">
        </div>
        <input type="text"
                value="<?=$student['student_id']?>"
                name="student_id"
                hidden>
        <input type="text"
                value="<?=$settings['current_year']?>"
                name="current_year"
                hidden>
        <input type="text"
                value="<?=$settings['current_semester']?>"
                name="current_semester"
                hidden>
        <input type="text"
                value="<?=$student_grade_id?>"
                name="student_grade_id"
                hidden>
            

        <div class="container mt-5">
            <?php
            $common_subjects = findCommonCharacters($student['subjects'], $teacher['subjects']);
            ?>
            <label for="subject" class="form-label"> Choose subject: </label>
            
            <select class="form-control" id="subject" name="subject">
                <?php foreach ($common_subjects as $subject) {
                    $the_subject = getSubjectById($subject, $conn);
                    if ($the_subject != 0){ ?>
                 
                 <option value="<?=$the_subject['subject_id']?>"><?=$the_subject['subject']?></option>
                        <?php } ?>
                 <?php } ?>

                    
            </select><br>

        </div>
        
        
        <button type="submit" 
                class="btn btn-primary">
                Grade</button>
        </form>
        </div>

     
     </div>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(4) a").addClass('active');
        });

        function makePass(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
              result += characters.charAt(Math.floor(Math.random() * 
         charactersLength));

           }
           var passInput = document.getElementById('passInput');
           var passInput2 = document.getElementById('passInput2');
           passInput.value = result;
           passInput2.value = result;
        }

        var gBtn = document.getElementById('gBtn');
        gBtn.addEventListener('click', function(e){
          e.preventDefault();
          makePass(5);
        });
    </script>

</body>
</html>
<?php 

  }else {
    header("Location: student.php");
    exit;
  } 
}else {
	header("Location: student.php");
	exit;
} 

?>