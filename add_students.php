<?php
include 'config.php';
session_start();
$is_login = isset($_SESSION['is_login']) ? $_SESSION['is_login'] : null;

if ($is_login == 'Admin') {
  $user_id = $_SESSION['id'];
} else {
  echo "<script>window.open('logout.php','_self')</script>";
}


?>
<!DOCTYPE html>
<html>
<?php include 'include/head.php' ?>

<body>
  <?php include 'include/header.php' ?>
  <?php include 'include/sidemenu.php' ?>
  <div class="content-wrapper">
    <div class="container-full">
      <div class="content-header">
        <div class="d-flex align-items-center">
          <div class="me-auto">
          </div>
        </div>
      </div>
      <section class="content">
        <div class="row">
          <div class="box">
            <div class="box-header with-border">
              <h4 class="box-title">Add Students Here</h4>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal form-element" method="POST" enctype="multipart/form-data">
              <div class="box-body">

                <div class="form-group row"> 

                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-label">Select Session</label>
                      <select class="form-control" name="session_id" required>
                        <option value="">Select Session</option>
                        <?php
                        $query = mysqli_query($con,"SELECT * FROM tb_session");
                        while($row = mysqli_fetch_array($query)){ ?>
                          <option value="<?php echo $row['id']; ?>"><?php echo $row['session']; ?></option>
                        <?php } ?>
                      </select>
                    </div> 
                  </div>  

                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-label">Select Class</label>
                      <select class="form-control" name="class_id" required>
                        <option value="">Select Class</option>
                        <?php
                        $query = mysqli_query($con,"SELECT * FROM tb_class");
                        while($row = mysqli_fetch_array($query)){ ?>
                          <option value="<?php echo $row['id']; ?>"><?php echo $row['class']; ?></option>
                        <?php } ?>
                      </select>
                    </div> 
                  </div>

                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-label">Student Name</label>
                      <input type="text" name="student_name" class="form-control" placeholder="Student Name"  >
                    </div> 
                  </div>

                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-label">Student Aadhar Number</label>
                      <input type="text" name="stu_adhar_no" class="form-control" placeholder="Aadhar Number"  >
                    </div> 
                  </div>

                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-label">Birth Certificate Number</label>
                      <input type="text" name="birth_certi_no" class="form-control" placeholder="Birth Certificate Number"  >
                    </div> 
                  </div>

                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-label">Father Name</label>
                      <input type="text" name="father_name" class="form-control" placeholder="Father Name"  >
                    </div> 
                  </div>

                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-label">Father's Aadhar Number</label>
                      <input type="text" name="father_adhar_no" class="form-control" placeholder="Father Aadhar Number"  >
                    </div> 
                  </div>


                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-label">Mother Name</label>
                      <input type="text" name="mother_name" class="form-control" placeholder="Mother Name"  >
                    </div> 
                  </div>

                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-label">Mother's Aadhar Number</label>
                      <input type="text" name="mother_adhar_no" class="form-control" placeholder="Mother Aadhar Number"  >
                    </div> 
                  </div>

                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-label">Admission Number</label>
                      <input type="text" name="adm_no" class="form-control" placeholder="Admission Number"  >
                    </div> 
                  </div>

                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-label">Admission Date</label>
                      <input type="date" name="adm_date" class="form-control" placeholder="Admission Number"  >
                    </div> 
                  </div>


                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-danger">Cancel</button>
                <button type="submit" name="submit" class="btn btn-info pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
            </form>
            <?php
            if (isset($_POST['submit'])) {
              $session_id = mysqli_real_escape_string($con,$_POST['session_id']);
              $class_id = mysqli_real_escape_string($con,$_POST['class_id']);
              $student_name = mysqli_real_escape_string($con,$_POST['student_name']);
              $stu_adhar_no = mysqli_real_escape_string($con,$_POST['stu_adhar_no']);
              $birth_certi_no = mysqli_real_escape_string($con,$_POST['birth_certi_no']);
              $father_name = mysqli_real_escape_string($con,$_POST['father_name']);
              $father_adhar_no = mysqli_real_escape_string($con,$_POST['father_adhar_no']);
              $mother_name = mysqli_real_escape_string($con,$_POST['mother_name']);
              $mother_adhar_no = mysqli_real_escape_string($con,$_POST['mother_adhar_no']);
              $adm_no = mysqli_real_escape_string($con,$_POST['adm_no']);
              $adm_date = mysqli_real_escape_string($con,$_POST['adm_date']);

              $insert = mysqli_query($con,"INSERT INTO `tb_students`(`sess_id`, `class_id`, `student_name`, `stu_adhar_no`, `birth_certi_no`, `father_name`, `father_adhar_no`, `mother_name`, `mother_adhar_no`, `adm_no`, `adm_date`) VALUES ('$session_id','$class_id','$student_name','$stu_adhar_no','$birth_certi_no','$father_name','$father_adhar_no','$mother_name','$mother_adhar_no','$adm_no','$adm_date')");

              if ($insert) {
                echo "<script>alert('New Student Added'),window.open('collect_adm_fees.php','_self')</script>";
              }
              

            }
            ?>



          </div>

          <div class="box">
            <div class="box-header with-border">
              <h4 class="box-title">All Students</h4>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <div class="table-responsive">
    <table id="example" class="table text-fade table-bordered table-hover display nowrap margin-top-10 w-p100">
        <thead>
            <tr class="text-dark">
                <td>S No</td>
                <td>Student Name</td>
                <td>Session</td>
                <td>Class</td>
                <td>Student Aadhar Number</td>
                <td>Birth Certificate Number</td>
                <td>Father's Name</td>
                <td>Father's Aadhar Number</td>
                <td>Mother's Name</td>
                <td>Mother's Aadhar Number</td>
                <td>Admission Number</td>
                <td>Admission Date</td>
            </tr>
        </thead>
        <tbody>
            <?php  
            $i = 1;
            $all_session = mysqli_query($con,"SELECT * FROM tb_students ORDER BY id DESC");
            while($session = mysqli_fetch_assoc($all_session)){
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo htmlspecialchars($session['student_name']); ?></td>
                <td><?php echo htmlspecialchars($session['sess_id']); ?></td>
                <td><?php echo htmlspecialchars($session['class_id']); ?></td>
                <td><?php echo htmlspecialchars($session['stu_adhar_no']); ?></td>
                <td><?php echo htmlspecialchars($session['birth_certi_no']); ?></td>
                <td><?php echo htmlspecialchars($session['father_name']); ?></td>
                <td><?php echo htmlspecialchars($session['father_adhar_no']); ?></td>
                <td><?php echo htmlspecialchars($session['mother_name']); ?></td>
                <td><?php echo htmlspecialchars($session['mother_adhar_no']); ?></td>
                <td><?php echo htmlspecialchars($session['adm_no']); ?></td>
                <td><?php echo htmlspecialchars($session['adm_date']); ?></td>
            </tr>
            <?php  
            $i++; 
            } 
            ?>
        </tbody>
    </table>
</div>


           </div>
         </div>
         <!-- /.row -->

       </section>
     </div>
   </div>
   <?php include 'include/footer.php' ?>
   <?php include 'include/js.php' ?>
 </body>

 </html>