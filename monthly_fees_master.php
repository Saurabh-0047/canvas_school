  <?php
  include 'config.php';
  session_start();
  $is_login = isset($_SESSION['is_login']) ? $_SESSION['is_login'] : null;

  if ($is_login == 'Admin') {
      $user_id = $_SESSION['id'];
  } else {
      echo "<script>window.open('logout.php','_self')</script>";
  }
 $sess_id = '';
    $show_table = 'style="display:none;"';
    $hide_form = '';

        if (isset($_GET['submit'])) {
          $sess_id = $_GET['session_id'];

          $session_name = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM tb_session WHERE id = $sess_id"));
            $session_name_show = $session_name['session'];


          $show_table = '';
          $hide_form = 'style="display:none;"';

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
                              <h4 class="box-title">Enter Monthly Fees Here</h4>
                          </div>
                          <!-- /.box-header -->
                          <!-- form start -->
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
              <label class="form-label">Select Month</label>
             <select class="form-control" name="month[]" id="month" multiple>
               
      <?php
      $currentMonth = date('n');
      $currentYear = date('Y');
      $startMonth = 4; // April

      // If the current month is before April, consider the financial year to start from last year
      if ($currentMonth < $startMonth) {
          $startYear = $currentYear - 1;
      } else {
          $startYear = $currentYear;
      }

      // Display the months from April to March
      for ($i = $startMonth; $i <= 12; $i++) {
          ?>
          <option value="<?php echo $i ?>"><?php echo date('F', mktime(0, 0, 0, $i, 1))?></option>
      <?php
      }

      // Display the months from January to March for the next year
      for ($i = 1; $i < $startMonth; $i++) {
          ?>
          <option value="<?php echo $i ?>"><?php echo date('F', mktime(0, 0, 0, $i, 1)) ?></option>
      <?php
      }
      ?>
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
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <button type="submit" class="btn btn-danger">Cancel</button>
                        <button type="submit" name="submit" class="btn btn-info pull-right">Submit</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
                <?php
                if (isset($_POST['submit'])) {
                     $session = $_POST['session'];
                     $class = $_POST['class'];
                     $month = $_POST['month'];
                     $fee_amt = $_POST['fee_amt'];
                     $fee_head = $_POST['fee_head'];

                     foreach($month as $key => $value){
           $get_fees = mysqli_query($con,"SELECT * FROM tb_monthly_fees WHERE class_id='$class' and sess_id = '$session' and fee_head = '$fee_head' and month = '$value'  ");
         $count_fee = mysqli_num_rows($get_fees);

         if ($count_fee > 0) {
            echo "<script>
            alert('Fees Already Present For Selected Credentials!');
            </script>";
         }else{
          
          $insert = mysqli_query($con,"INSERT INTO tb_monthly_fees (class_id,sess_id,fee_amt,fee_head,month) VALUES('$class','$session','$fee_amt','$fee_head','$value')");
          }
         }


              }
              ?>



          </div>

          <div class="col-12">
         
        <div class="box">
            
        <div class="box-header with-border">
       
          <p class="mb-0 box-subtitle">Export data to Copy, CSV, Excel, PDF & Print</p>
         
        </div>
        <!-- /.box-header -->
        <div class="box-body">
             <form class="form-horizontal form-element" method="GET" enctype="multipart/form-data">
          <div class="box-body">
           
          <div class="form-group row"> 
         

            <div class="col-lg-6">
              <div class="form-group">
            <label class="form-label">Select Session</label>
            <select class="form-control" name="session_id">
              <?php 
              $all_sessions = mysqli_query($con,"SELECT * FROM tb_session ORDER BY id DESC");
              while($sessions = mysqli_fetch_assoc($all_sessions)){
              ?>
              <option value="<?php echo $sessions['id']; ?>"><?php echo $sessions['session']; ?></option>
            <?php } ?>
            </select>
            </div> 
            </div>
          </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
          <button type="submit" class="btn btn-danger">Cancel</button>
          <input type="submit" name="submit" class="btn btn-info pull-right" value="Submit">
          </div>
          <!-- /.box-footer -->
        </form>



          <div class="table-responsive" <?php echo $show_table; ?>>
            <h4>Monhtly  Fees For  <?php echo $session_name_show; ?></h4>
            <table id="example" class="table text-fade table-bordered table-hover display nowrap margin-top-10 w-p100">
            <thead>
              <tr class="text-dark">
                <td>S.NO</td>
                <td>Class</td>
                <td>Fees For</td>
                <td>Month</td>
                <td>Fee Amount</td>
              </tr>
            </thead>
            <tbody>
           <?php  
           $i = 1;
           $all_fees = mysqli_query($con,"SELECT * FROM tb_monthly_fees WHERE sess_id = '$sess_id'");
           while($fees = mysqli_fetch_assoc($all_fees)){
            $class_id = $fees['class_id'];
            $month_id = $fees['month'];

            $month_get = mysqli_query($con,"SELECT * FROM tb_month WHERE id = '$month_id'");
            while($month = mysqli_fetch_assoc($month_get)){
              $month_name = $month['month'];
            }
            
            $class_name = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM tb_class WHERE id = $class_id"));
            $class = $class_name['class'];
            ?>
            <tr>
               <td><?php echo $i ?></td>
               <td><?php  echo $class ?></td>
               <td><?php  echo $fees['fee_head']; ?></td>
               <td><?php echo $month_name; ?></td>
               <td><?php echo $fees['fee_amt']; ?></td>
                
               
            </tr>
           <?php  $i++; } ?>
          </table>
          </div>              
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
        
        
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