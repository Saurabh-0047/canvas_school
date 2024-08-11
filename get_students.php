<?php
include 'config.php';
$stu_id = $_POST['stu_id'];
$sess_id = $_POST['sess_id'];

$sql = "SELECT * FROM tb_students WHERE (student_name LIKE '%$stu_id%' OR adm_no LIKE '%$stu_id%') AND sess_id='$sess_id'";

$result = mysqli_query($con, $sql);
$suggestions = array();
$class = array();
$father_name = array();
$stuid = array();

if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $adm_no = $row['adm_no'];
        
        // Check if the student is already in tb_fees_collected for the given session
        $check_fees_sql = "SELECT * FROM tb_fees_collected WHERE stu_adm_no = '$adm_no' AND session_id = '$sess_id' AND fee_type='Admission'";
        $fees_result = mysqli_query($con, $check_fees_sql);

        // If the student is not found in tb_fees_collected, add to suggestions
        if ($fees_result->num_rows == 0) {
            $suggestions[] = $row['student_name'];
            $class[] = $row['class_id'];
            $father_name[] = $row['father_name'];
            $stuid[] = $row['adm_no'];
        }
    }
}

if (!empty($stuid)) {
    if (!empty($suggestions)) {
        foreach ($suggestions as $key => $suggestion) {
            $currentClass = $class[$key];
            $classes = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tb_class WHERE id = '$currentClass'"));
            $class_name = $classes['class'];
            $currentFatherName = $father_name[$key];
            $currentStuId = $stuid[$key];
            
            echo "<div class='suggestion' onclick=\"abc('$currentStuId', '$suggestion', '$currentFatherName','$currentClass')\"><a href='#!'>$suggestion, $class_name, $currentFatherName, $currentStuId</a></div>";
        }
    } else {
        echo "<div class='no-suggestion'>No suggestions found.</div>";
    }
}else{
  echo "<div class='no-suggestion'>No suggestions found.</div>";
}

?>
