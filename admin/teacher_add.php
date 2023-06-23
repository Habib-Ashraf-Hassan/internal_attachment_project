<?php
session_start();
if (isset($_SESSION['admin_id ']) && isset($_SESSION['role'])){

    if ($_SESSION['role'] == 'Admin'){
        include "../DB_connection.php";
        include "data/subject.php";
        include "data/grade.php";
        $subjects = getAllSubjects($conn);
        $grades = getAllGrades($conn);

        
        
        
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Teacher</title>
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
        
        <form method="post" class="shadow p-3 mt-5 form-w" action="">
            <!-- <div class="text-center">
                <img src="../images/Madrassa_logo2.png" width="85" height="75">
            </div> -->
            <h3>Add New Teacher(Maalim)</h3>
            <hr>
            
            <div class="mb-3">
                <label class="form-label">First name</label>
                <input type="text" class="form-control" name="fname">
            </div>

            <div class="mb-3">
                <label class="form-label">Last name</label>
                <input type="text" class="form-control" name="lname">
            </div>

            <div class="mb-3">
                <label class="form-label">Employee no.</label>
                <input type="text" class="form-control" name="username">
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group mb-3"></div>
                <input type="text" class="form-control" 
                    name="pass" id="passInput">
                <button class="btn btn-secondary" id="gBtn">Random</button>
            </div>

            <div class="mb-3">
                <label class="form-label">Gender</label>
                
                <select class="form-control" name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    
                </select>
            </div>
            <br>

            <div class="mb-3">
                <label class="form-label">Subjects teaching</label><br>
                <div class="row row-cols-5">
                    <?php foreach ($subjects as $subject): ?>

                <div class="col">
                <input type="checkbox" name="subjects[]" value="<?=$subject['subject_id']?>">
                <?=$subject['subject']?>
                </div>
                <?php endforeach ?>
                </div>
                
            </div>
            <br>

            <div class="mb-3">
                <label class="form-label">Classes teaching</label>
                <div class="row row-cols-5">
                    <?php foreach ($grades as $grade): ?>

                <div class="col">
                <input type="checkbox" name="grades[]" value="<?=$grade['grade_id']?>">
                <?=$grade['grade_code']?>-<?=$grade['grade']?>
                </div>
                <?php endforeach ?>
                </div>
                
            </div>

            
            
            
            
            <button type="submit" class="btn btn-primary">Add</button>
            
        </form>
        
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
    header("Location: ../login.php");
    exit;
} 

}else{
    header("Location: ../login.php");
    exit;
}

?>