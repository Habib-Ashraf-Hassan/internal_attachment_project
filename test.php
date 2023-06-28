<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="row">
    <div class="col-md-6">Left Content</div>
    <div class="col-md-6">Right Content
    <?php
function findCommonCharacters($str1, $str2) {
    $commonChars = array();

    $charCount1 = array_count_values(str_split($str1));
    $charCount2 = array_count_values(str_split($str2));

    foreach ($charCount1 as $char => $count) {
        if (isset($charCount2[$char])) {
            $commonChars[] = $char;
        }
    }

    return $commonChars;
}

// // Example usage
// $var1 = "12368901";
// $var2 = "12345698701";

// $result = findCommonCharacters($var1, $var2);

// // Iterate through each character in the result
// foreach ($result as $char) {
//     echo $char . "\n";
// }
function getPreviousSemester($current_semester) {
    if ($current_semester == "I") {
        return "I";
    } else {
        return substr($current_semester, 0, -1);
    }
}

$current_semester = "I";
$previous_semester = getPreviousSemester($current_semester);

$current_year = "2023";
$previous_year = date('Y', strtotime($current_year . ' -1 year'));
echo $previous_year;
echo $previous_semester;
?>




    </div>
    </div>

</body>
</html>