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
        
            $suggestions[] = $row['student_name'];
            $class[] = $row['class_id'];
            $father_name[] = $row['father_name'];
            $stuid[] = $row['adm_no'];
        
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
            
            echo "<div class='suggestion' onclick=\"get_months('$currentStuId', '$suggestion', '$currentFatherName','$currentClass')\"><a href='#!'>$suggestion, $class_name, $currentFatherName, $currentStuId</a></div>";
        }
    } else {
        echo "<div class='no-suggestion'>No suggestions found.</div>";
    }
}else{
  echo "<div class='no-suggestion'>No suggestions found.</div>";
}

?>
