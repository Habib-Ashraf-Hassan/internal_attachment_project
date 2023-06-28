<?php 
session_start();
if (isset($_SESSION['teacher_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Teacher') {
    	

if (isset($_POST['a1']) &&
    isset($_POST['aoutof1']) &&
    isset($_POST['student_id']) &&
    isset($_POST['subject']) &&
    isset($_POST['current_year']) &&
    isset($_POST['current_semester'])
    ) {
    
      
    include '../../DB_connection.php';
    include "../data/student_score.php";
    include "../data/student.php";


    $score_1 = $_POST['a1'];
    $aoutof_1 = $_POST['aoutof1'];

    $student_id = $_POST['student_id'];
    $subject_id = $_POST['subject'];
    $current_year = $_POST['current_year'];
    $current_semester = $_POST['current_semester'];
    $teacher_id = $_SESSION['teacher_id'];
    $student = getStudentById($student_id, $conn);
    $student_class_id = $student['grade'];
    $student_fname = $student['fname'];
    $student_adm_number = $student['admission_number'];

    $student_score_id = getScoreByStudentId($student_id, $subject_id, $current_semester, $current_year, $conn);
    $student_results_id = getResultsByStudentId($student_id, $subject_id, $current_semester, $current_year, $conn);

    if(empty($score_1)  || empty($aoutof_1) ||  empty($student_id) || empty($subject_id) || empty($current_year) || empty($current_semester)){

       $em  = "All fields are required";
        header("Location: ../student-enter.php?student_id=$student_id&error=$em");
        exit;

    }else {
        $data = '';
        $total_results = 0;
        $limit = 0;
        if ($score_1 > 0 && $aoutof_1 > 0 && $score_1 <=  $aoutof_1)  {
            $data .= $score_1." ".$aoutof_1; 
            $total_results = ($score_1/$aoutof_1)*100;
             $limit += $aoutof_1;
        } 
        
        if (empty($data)) {
            $em  = "An error occurred, marks not entered!";
            header("Location: ../student-enter.php?student_id=$student_id&error=$em");
            exit;
        }else if($limit > 500){
            $em  = "Out of boundaries";
            header("Location: ../student-enter.php?student_id=$student_id&error=$em");
            exit;
        }
        else {
        if ($student_score_id != 0) {
            // $data = $student_score_id['results'].",".$data;
            
        $sql = "UPDATE student_score SET
                results = ?
                WHERE  semester=?
                AND year=? AND student_id=? AND subject_id=?";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$data, $current_semester, $current_year, $student_id, $subject_id]);
        // $sm = "The Score has been updated successfully!";
        // header("Location: ../student-enter.php?student_id=$student_id&success=$sm");
        // exit;
                if ($student_results_id != 0) {
                    
                    // $total_results = ($total_results + $student_results_id['total'])/2;
                    $sql = "UPDATE student_results SET
                            total = ?
                            WHERE  semester=?
                            AND year=? AND student_id=? AND subject_id=? AND class_id=?";

                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$total_results, $current_semester, $current_year, $student_id, $subject_id, $student_class_id]);
                    $sm = "The Score has been updated successfully!";
                    header("Location: ../student-enter.php?student_id=$student_id&success=$sm");
                    exit;
                
                }
                
          }else {
            $sql = "INSERT INTO student_score(semester, year, student_id, teacher_id, subject_id, results, fname, adm_number)VALUES(?,?,?,?,?,?,?,?)";

            $stmt = $conn->prepare($sql);
            $stmt->execute([$current_semester, $current_year, $student_id, $teacher_id, $subject_id, $data, $student_fname, $student_adm_number]);
            // $sm = "The Score has been entered successfully!";
            // header("Location: ../student-enter.php?student_id=$student_id&success=$sm");

            if ($student_results_id == 0){
                $sql = "INSERT INTO student_results(semester, year, student_id, teacher_id, subject_id, class_id, total, fname, adm_number)VALUES(?,?,?,?,?,?,?,?,?)";

                $stmt = $conn->prepare($sql);
                $stmt->execute([$current_semester, $current_year, $student_id, $teacher_id, $subject_id, $student_class_id, $total_results, $student_fname, $student_adm_number]);
                $sm = "The Score has been entered successfully!";
                header("Location: ../student-enter.php?student_id=$student_id&success=$sm");

            }

          }
        }

    }
    
  }else {
  	$em = "Error ! some fields are missing";
    header("Location: ../student-enter.php?error=$em");
    exit;
  }

  }else {
    header("Location: ../../logout.php");
    exit;
  } 
}else {
	header("Location: ../../logout.php");
	exit;
} 
