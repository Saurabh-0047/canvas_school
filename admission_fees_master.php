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
                              <h4 class="box-title">Enter Admission Fees Here</h4>
                          </div>
                          <form class="form-horizontal form-element" method="POST" enctype="multipart/form-data">
                            <div class="box-body">

                                <div class="form-group row"> 


                                  <div class="col-lg-4">
                <div class="form-group">
              <label class="form-label">Select Session</label>
              <select class="form-control" name="session" required>
                <option value="">Select Session</option>
                <?php
                $query = mysqli_query($con,"SELECT * FROM tb_session");
                while($row = mysqli_fetch_array($query)){ ?>
                  <option value="<?php echo $row['id']; ?>"><?php echo $row['session']; ?></option>
                <?php } ?>
              </select>
              </div> 
              </div>  

              <div class="col-lg-4">
                <div class="form-group">
              <label class="form-label">Select Class</label>
              <select class="form-control" name="class" required>
                <option value="">Select Class</option>
                <?php
                $query = mysqli_query($con,"SELECT * FROM tb_class");
                while($row = mysqli_fetch_array($query)){ ?>
                  <option value="<?php echo $row['id']; ?>"><?php echo $row['class']; ?></option>
                <?php } ?>
              </select>
              </div> 
              </div>


              <div class="col-lg-4">
              <div class="form-group">
              <label class="form-label">Fees For</label>
              <input type="text" name="fee_head" class="form-control" placeholder="Fees For" >
              </div> 
              </div>

              <div class="col-lg-4">
              <div class="form-group">
              <label class="form-label">Fees Amount</label>
              <input type="text" name="fee_amt" class="form-control" placeholder="Fees Amount" >
              </div> 
              </div>



                          </div>
                      </div>
                      <div class="box-footer">
                        <button type="submit" class="btn btn-danger">Cancel</button>
                        <button type="submit" name="submit" class="btn btn-info pull-right">Submit</button>
                    </div>
                </form>

                <?php 
                if (isset($_POST['submit'])) {
                    $session = $_POST['session'];
                     $class = $_POST['class'];
                     $fee_amt = $_POST['fee_amt'];
                     $fee_head = $_POST['fee_head'];

                     $get_fees = mysqli_query($con,"SELECT * FROM tb_admission_fees WHERE class_id='$class' and sess_id = '$session' and fee_head = '$fee_head'");
                       $count_fee = mysqli_num_rows($get_fees);
                       if ($count_fee > 0) {
            echo "<script>
            alert('Fees Already Present For Selected Credentials!');
            </script>";
         }else{
          
          $insert = mysqli_query($con,"INSERT INTO tb_admission_fees (class_id,sess_id,fee_amt,fee_head) VALUES('$class','$session','$fee_amt','$fee_head')");
          }
                }
                ?>
      



          </div>

          <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">Admission Fees</h4>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          
          <div class="table-responsive">
            <table id="example" class="table text-fade table-bordered table-hover display nowrap margin-top-10 w-p100">
              <thead>
                <tr class="text-dark">
                  <td>S No</td>
                  <td>Session</td>
                  <td>Class</td>
                  <td>Fee Head</td>
                  <td>Fee Amount</td>
                </tr>
              </thead>
              <tbody>
                <?php  
           $i = 1;
           $all_fees = mysqli_query($con,"SELECT * FROM tb_admission_fees ORDER BY id DESC");
           while($fees = mysqli_fetch_assoc($all_fees)){
            $class_id = $fees['class_id'];
            $session_id = $fees['sess_id'];
            
            $class_name = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM tb_class WHERE id = $class_id"));
            $class = $class_name['class'];

            $session_name = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM tb_session WHERE id = $session_id"));
            $session = $session_name['session'];
            ?>
            <tr>
               <td><?php echo $i ?></td>
               <td><?php  echo $session ?></td>
               <td><?php  echo $class ?></td>
               <td><?php  echo $fees['fee_head']; ?></td>
               <td><?php echo $fees['fee_amt']; ?></td>
                
               
            </tr>
           <?php  $i++; } ?>
            </tbody>
          </table>
        </div>

      </div>

      </div>

  </section>
  </div> 
  </div>
  <?php include 'include/footer.php' ?>
  <?php include 'include/js.php' ?>
  </body>

  </html>