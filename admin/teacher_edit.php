<?php
session_start();
if (isset($_SESSION['admin_id ']) &&
    isset($_SESSION['role']) &&
    isset($_GET['teacher_id'])){

    if ($_SESSION['role'] == 'Admin'){
        include "../DB_connection.php";
        include "data/subject.php";
        include "data/grade.php";
        include "data/teacher.php";

        $subjects = getAllSubjects($conn);
        $grades = getAllGrades($conn);
        $choice = "";
        $alt_choice = "";

        $teacher_id = $_GET['teacher_id'];
        $teacher = getTeacherById($teacher_id, $conn);

        if ($teacher == 0){
            header("Location: teacher.php");
            exit;
        }
        // if ($teacher['gender'] == "Male"){
        //     $alt_choice = "Female";
        //     $choice = $teacher['gender'];
        // }
        // else{
        //     $alt_choice = "Male";
        //     $choice = $teacher['gender'];
        // }
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit a Teacher</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../images/Madrassa_logo2.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
</head>
<body>
    <?php
        include "inc/navbar.php";

    ?>
    <div class="container mt-5">
        <a href="teacher.php" class="btn btn-dark">Go Back</a>
        
        <form method="post" class="shadow p-3 mt-5 form-w" action="req/teacher_edits.php">
            <div class="text-center">
                <img src="../images/Madrassa_logo2.png" width="85" height="75">
            </div>
            <h3>Edit a Teacher(Maalim)</h3>
            <hr>
            <?php 
                if(isset($_GET['error'])){ ?>
                <div class="alert alert-danger" role="alert">
                <?=$_GET['error']?>
                </div>

             <?php  }  ?>
             <?php 
                if(isset($_GET['success'])){ ?>
                <div class="alert alert-success" role="alert">
                <?=$_GET['success']?>
                </div>

             <?php  }  ?>
             <div class="mb-3">
                <label class="form-label">Id</label>
                <input type="text" class="form-control"
                       value="<?=$teacher['teacher_id']?>" name="teacher_id">
            </div>

            <div class="mb-3">
                <label class="form-label">Full name</label>
                <input type="text" class="form-control"
                       value="<?=$teacher['fname']?>" name="fname">
            </div>

            <div class="mb-3">
                <label class="form-label">Age</label>
                <input type="number" class="form-control"
                    value="<?=$teacher['age']?>" name="age">
            </div>

            <div class="mb-3">
                <label class="form-label">Employee no.</label>
                <input type="text" class="form-control" 
                value="<?=$teacher['username']?>" name="username">
            </div>

            <div class="mb-3">
                <label class="form-label">Gender</label>
                
                <!-- <select class="form-control" name="gender">
                    <option value="<?=$choice?>" selected><?=$choice?></option>
                    <option value="<?=$alt_choice?>"><?=$alt_choice?></option>
                    
                </select> -->

                <select class="form-control" name="gender">
                    <option value="Male">Male</option>
                    <option value="Female>">Female</option>
                    
                </select>
            </div>
            <br>

            <div class="mb-3">
                <label class="form-label">Subjects teaching</label><br>
                <div class="row row-cols-5">
                    <?php
                    $subject_ids = str_split(trim($teacher['subjects']));
                     foreach ($subjects as $subject){
                        $checked = 0;
                        foreach ($subject_ids as $subject_id){
                            if ($subject_id == $subject['subject_id']){
                                $checked = 1;
                            }
                        }
                     
                      ?>
                        <div class="col">
                        <input type="checkbox" name="subjects[]" 
                        <?php if ($checked) echo "checked"; ?>    
                        value="<?=$subject['subject_id']?>">
                        <?=$subject['subject']?>
                        </div>
                    <?php } ?>
                </div>
                
            </div>
            <br>

            <div class="mb-3">
                <label class="form-label">Classes teaching</label>
                <div class="row row-cols-5">
                <?php
                    $grade_ids = str_split(trim($teacher['grades']));
                     foreach ($grades as $grade){
                        $checked = 0;
                        foreach ($grade_ids as $grade_id){
                            if ($grade_id == $grade['grade_id']){
                                $checked = 1;
                            }
                        }
                     
                      ?>

                <div class="col">
                <input type="checkbox" name="grades[]" 
                <?php if ($checked) echo "checked"; ?>
                value="<?=$grade['grade_id']?>">
                <?=$grade['grade_code']?>-<?=$grade['grade']?>
                </div>
                <?php } ?>
                </div>
                
            </div>

            
            
            
            
            <button type="submit" class="btn btn-primary">Update</button>
            
        </form>

        <form method="post" class="shadow p-3 mt-5 form-w" action="">
        <h3>Change password</h3>
            <hr>
            <?php 
                if(isset($_GET['error'])){ ?>
                <div class="alert alert-danger" role="alert">
                <?=$_GET['error']?>
                </div>

             <?php  }  ?>
             <?php 
                if(isset($_GET['success'])){ ?>
                <div class="alert alert-success" role="alert">
                <?=$_GET['success']?>
                </div>

             <?php  }  ?>

            <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group mb-3">
                    <input type="text" class="form-control" 
                        name="pass" id="passInput">
                    <button class="btn btn-secondary" id="gBtn">Random</button>
                    </div>
            </div>
        </form>
        <button type="submit" class="btn btn-primary">Change</button>

        
    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    </script>
    <script>
        $(document).ready(function(){
               $("#navLinks li:nth-child(2) a").addClass('active'); 
        
        });

        function makePassword(length) {
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            let counter = 0;
            while (counter < length) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
            counter += 1;
            
            }
            var passInput = document.getElementById('passInput');
            passInput.value = result;
        }
        var gBtn = document.getElementById('gBtn');
        gBtn.addEventListener('click', function(e){
            e.preventDefault();
            makePassword(5);
        });

    </script>
</body>
</html>

<?php
}else{
    header("Location: teacher.php");
    exit;
} 

}else{
    header("Location: teacher.php");
    exit;
}

?>