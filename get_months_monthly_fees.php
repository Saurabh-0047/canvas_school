<?php
include 'config.php';
$stu_id = mysqli_real_escape_string($con,$_GET['stu_id']);
$sess_id = mysqli_real_escape_string($con,$_GET['sess_id']);
$class_id = mysqli_real_escape_string($con,$_GET['class_id']);


$check_stu = mysqli_query($con,"SELECT * FROM tb_students WHERE adm_no = '$stu_id' and sess_id = '$sess_id'");
$count_stu = mysqli_num_rows($check_stu);

if ($count_stu >=1) {
   $get_details = mysqli_query($con, "SELECT * FROM tb_fees_collected  WHERE stu_adm_no = '$stu_id' and session_id = '$sess_id'");
$count_rows = mysqli_num_rows($get_details);
if ($count_rows == '0') {

$month_query = mysqli_query($con,"SELECT * FROM tb_month ORDER BY FIELD(id, 4,5,6,7,8,9,10,11,12,1,2,3)");
while($rest_months = mysqli_fetch_assoc($month_query)){?>
<option value="<?php echo $rest_months['id'] ?>"><?php echo $rest_months['month'] ?></option>
<?php }
    
}else{
$numberArray = array(); // Initialize an array

while ($fee_details = mysqli_fetch_assoc($get_details)) {
    $months = $fee_details['month_id'];
    $monthArray = explode(',', $months); // Split the months into an array

    foreach ($monthArray as $month_get) {
        $numberArray[] = $month_get; // Add month to the number array
    }
}

$c_month = implode(",",$numberArray);

$month_query = mysqli_query($con,"SELECT * FROM tb_month WHERE id NOT IN($c_month) ORDER BY FIELD(id, 4,5,6,7,8,9,10,11,12,1,2,3)");
while($rest_months = mysqli_fetch_assoc($month_query)){?>
<option value="<?php echo $rest_months['id'] ?>"><?php echo $rest_months['month'] ?></option>
<?php }  } }?>



