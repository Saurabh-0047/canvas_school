<?php 
include '../config.php';
if (isset($_GET['cat_id'])) {
	?>
	<option value="">Select Sub Category</option>
	<?php
	$cat_id = $_GET['cat_id'];
	$all_categories = mysqli_query($con,"SELECT * FROM tb_sub_categories WHERE cat_id = '$cat_id'");
	while($categories = mysqli_fetch_assoc($all_categories)){
		?>
		<option value="<?php echo $categories['id']; ?>"><?php echo $categories['sub_cat_name']; ?></option>
		<?php
	}
}
?>