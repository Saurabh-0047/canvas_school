<?php
include 'config.php';
session_start();
$is_login = isset($_SESSION['is_login']) ? $_SESSION['is_login'] : null;

if ($is_login == 'Admin') {
  $user_id = $_SESSION['id'];
} else {
  echo "<script>window.open('logout.php','_self')</script>";
}

$show_container = 'style="display:none;"';
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
              <h4 class="box-title">Collect Monthly Fees</h4>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal form-element" method="POST" enctype="multipart/form-data">
              <div class="box-body">

                <div class="form-group row"> 

                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-label">Select Session</label>
                      <select class="form-control" name="session_id" id="sess_id" required>
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
                      <select class="form-control" name="class_id" id="class_id" required>
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
                      <label class="form-label">Enter Student Name/ID</label>    <i class="fas fa-sync-alt" onclick="refresh()"></i>  
                      <input type="text" name="stu_id" class="form-control" id="stu_id" onkeyup="get_students()" placeholder="Enter Student Id"  required>
                      <div id="students"></div>
                    </div> 
                  </div>

                   <div class="col-lg-4" >
                  <div class="form-group">
                    <label class="form-label">Select Month</label>
                    <select class="form-control" name="month[]" multiple id="months" required>
                    </select>
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
              $show_container = '';
              $session_id = $_POST['session_id'];
              $class_id = $_POST['class_id'];
              $stu_id = $_POST['stu_id'];

              $check_student = mysqli_query($con,"SELECT * FROM tb_students WHERE adm_no = '$stu_id' ");
              if (mysqli_num_rows($check_student)==0) {
                echo "<script>alert('Invalid Admission Number'),window.open('collect_monthly_fees.php','_self')</script>";
                die();
              }
              $months = $_POST['month'];
              $month_fee = implode(",", $months);

              $student_details = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tb_students WHERE adm_no = '$stu_id' and sess_id = '$session_id' "));
              $due_amt = $student_details['dues_amt'];

              $fees_amt = [];
              

              foreach ($months as $month_id) {
                $monthly_fees_result = mysqli_query($con, "SELECT * FROM tb_monthly_fees WHERE class_id='$class_id' AND sess_id = '$session_id' AND month='$month_id'");
                while ($monthly_fee = mysqli_fetch_assoc($monthly_fees_result)) {
                  $fee_head = $monthly_fee['fee_head'];
                  $fee_amt = $monthly_fee['fee_amt'];

                  if (isset($fees_amt[$fee_head])) {
                    $fees_amt[$fee_head] += $fee_amt;
                  } else {
                    $fees_amt[$fee_head] = $fee_amt;
                  }
                }
              }

              $total_fees = array_sum($fees_amt)+$due_amt;
              ?>
              <div class="container">
                <div class="row">
                  <form method="POST" id="second_form" >
                    <input type='hidden' name='today' value='<?php echo $today ?>'>
                    <input type='hidden' name='stu_id' value='<?php echo $stu_id ?>'>
                    <input type='hidden' name='class_id' value='<?php echo $class_id ?>'>
                    <input type='hidden' name='session_id' value='<?php echo $session_id ?>'>
                    <input type='hidden' name='month_id' value='<?php echo $month_fee ?>'>
                    
                    
                    
                    <div class="table-responsive">
                      <div class="col-lg-2"></div>
                      <div class="col-lg-8 text-center">
                        <table id="particularsTable" class="table text-fade table-bordered table-hover display nowrap margin-top-10 w-p100">
                          <thead>
                            <tr class="text-dark">
                              <td>S.NO</td>
                              <td>Particulars</td>
                              <td>Fee Amount</td>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $i = 1;
                            foreach ($fees_amt as $fee_head => $fee_amt) {?>
                              <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $fee_head ?></td>
                                <!-- <td><?php echo $fee_amt ?></td> -->
                                <td><input type="number" name="parti_fee_amts[]"  id ="fees_'<?php echo $fee_head ?>'" value="<?php echo  $fee_amt ?>" class="particular-amount form-control"  readonly></td>

                              </tr>
                              <?php
                              $i++;
                            }
                            ?>
                          </tbody>
                        </table>

                      </div>
                      <div class="col-lg-2"></div>

                      <div class="col-lg-4" id="remarks_box" style="display:none;">
                        <div class="form-group">
                          <label class="form-label">Add Remarks</label>
                          <textarea name="remarks" class="form-control" id="remarks_text" placeholder="Add Remarks For Discount" rows="5"></textarea>
                        </div> 
                      </div>
                      <!-- <div class="col-lg-4" >
                        <div class="form-group">
                          <a class="btn btn-primary" onclick="add_discount()">Give Discount</a>
                        </div> 
                      </div> -->
                      <?php
                    }
                    ?>

                    <div class="container" <?php echo $show_container ?>>
                      <div class="row">





                        <div class="col-lg-4">
                          <label>Total Fee Amount:</label>
                          <input type="text" name="tot_fee" id="tot_fee" class="form-control" value="<?php echo $total_fees; ?>" readonly>
                        </div>
                        <div class="col-lg-4">
                          <label>Previous Dues:</label>
                          <input type="text" name="pre_due" id="pre_due" class="form-control" value="<?php echo $due_amt; ?>" readonly>
                        </div>
                        <div class="col-lg-4">
                          <label>Amount Paid:</label>
                          <input type="text" name="amt_paid" id="paid_fee" onkeyup="due_amt()" class="form-control"  required>
                        </div>
                        <div class="col-lg-4">
                          <label>Dues Amount:</label>
                          <input type="text" name="due_fee" id="due_fee" class="form-control" readonly>
                        </div>
                        <div class="col-lg-4">
                          <label>Fee Date:</label>
                          <input type="date" name="fee_date" id="fee_date" class="form-control" required value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="col-lg-6">
                          <label>Payment Mode:</label>
                          <div class="demo-checkbox">
                            <label for="exampleInputUsername1">Select Payment Method/s</label><br>


                            <div class="row">
                              <div class="col-lg-6">
                                <input type="checkbox" id="md_checkbox_1" class="chk-col-primary" name="pay_type[]" value="cash"  onclick="show_cash()"/>
                                <label for="md_checkbox_1" class="label_text">Cash</label>
                                <input class="form-control form_check cash_amount" type="text" name="cash_amount" placeholder="Amount Paid Via Cash" id="input2" style="display:none">
                              </div>
                              <div class="col-lg-6">
                                <input type="checkbox" id="md_checkbox_3" class="chk-col-primary"  name="pay_type[]" value="card" onclick="show_card()" />
                                <label for="md_checkbox_3" class="label_text">Card</label>
                                <input class="form-control form_check" type="text" name="card_amount" placeholder="Amount Paid Via Card" id="input3" style="display:none">
                              </div>
                              <div class="col-lg-6"> 
                                <input type="checkbox" id="md_checkbox_6" class="chk-col-primary"  name="pay_type[]" value="upi" onclick="show_upi()" />
                                <label for="md_checkbox_6" class="label_text">UPI</label>
                                <input class="form-control form_check" type="text" name="upi_amount" id="input4" placeholder="Amount Paid Via UPI" style="display:none">
                              </div> 

                            </div> 
                          </div>
                        </div>
                        <div class="col-lg-6">

                          <input type="submit" name="collect" value="Collect Fee" class="btn btn-primary">
                        </div>
                      </form>

                      <?php 
                      if (isset($_POST['collect'])) {

                       $cash_amount = 0;
                       $card_amount = 0;
                       $upi_amount = 0;
                       $stu_adm_no = $_POST['stu_id'];
                       $month_id = $_POST['month_id'];
                       $class_id = $_POST['class_id'];
                       $session_id = $_POST['session_id'];
                       $tot_fee = $_POST['tot_fee'];
                       $amt_paid = $_POST['amt_paid'];
                       $checkbox1 = $_POST['pay_type']?? 0;
                       $cash_amount = $_POST['cash_amount'] ?? 0;
                       $upi_amount = $_POST['upi_amount'] ?? 0;
                       $card_amount = $_POST['card_amount'] ?? 0;
                       $due_fee = $_POST['due_fee'];
                       $fee_date = $_POST['fee_date'];

                       $final_amt = intval($cash_amount)+intval($card_amount)+intval($upi_amount);

                       if ($final_amt != $amt_paid) {
                         echo "<script>alert('Amount Mismatched!'),window.open('collect_monthly_fees.php','_self')</script>";
                          die();
                       }

                       $pay_mode = "";
                       foreach ($checkbox1 as $pay_mode1) {
                        $pay_mode .= $pay_mode1 . ",";
                        $pay_mode = rtrim($pay_mode);
                      }
                      $bill_id = "CANVAS"."_".date("hisdmY");


                      $sql = "INSERT INTO tb_fees_collected (stu_adm_no, month_id, class_id, session_id, tot_fee, amt_paid, pay_mode, bill_id, cash_amount, card_amount, upi_amount, due_fee, fee_date,fee_type)
                      VALUES ('$stu_adm_no', '$month_id', '$class_id', '$session_id', '$tot_fee', '$amt_paid', '$pay_mode', '$bill_id', '$cash_amount', '$card_amount', '$upi_amount', '$due_fee', '$fee_date','Monthly')";

                      if (mysqli_query($con, $sql)) {
                        $add_dues = mysqli_query($con,"UPDATE tb_students SET dues_amt = '$due_fee' WHERE adm_no='$stu_adm_no' ");
                        if ($add_dues) {
                          echo "<script>alert('Monthly Fees Collected!'),window.open('monthly_fee_receipt.php'),window.open('collect_monthly_fees.php','_self')</script>";
                        }

                      } else {
                        echo "Error: " . mysqli_error($con);
                      }
                      



                      die();
                    }
                    ?>
                    </div>
                    </div>

                    </div>



                    </div>
                    </div>
                    </section>
                    </div>
                    </div>
                    <?php include 'include/footer.php' ?>
                    <?php include 'include/js.php' ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
    function get_months(stu_id,aaa,bb,class_id){                   

    var stu_id = stu_id;
    var sess_id = $('#sess_id').val();

    var det = stu_id;
    var class_id = class_id;
    $.ajax({
      url: "get_months_monthly_fees.php",
      type: "GET",
      data: {
        stu_id: stu_id,
        sess_id: sess_id,
        class_id: class_id
      },
      cache: false,
      success: function(result) {
        $("#months").html(result);
      }
    });
    $('#stu_id').val(det);  
    $('#stu_id').prop('readonly', true);
  };
    function get_students(){
      var stu_id = $('#stu_id').val();
      var sess_id = $('#sess_id').val();

      if(stu_id.length>=3){

       $.ajax({
        url: "get_students_monthly_fees.php",
        type: "POST",
        data: {
          stu_id: stu_id,
          sess_id:sess_id
        },
        cache: false,
        success: function(result) {
          $("#students").html(result);
        }
      });


     }

     else{

     }

   };



   function refresh(){

    $('#stu_id').prop('readonly', false);
    $('#stu_id').val('');
    $("#months").html('');
    $(".suggestion").html('');

  }

  function due_amt(){
    var tot_fee =$('#tot_fee').val();
    var paid_fee =  $('#paid_fee').val();
    $("#due_fee").val(tot_fee - paid_fee);
  }


  function show_cash() {



    var x = document.getElementById("input2");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }

  function show_card() {
    var x = document.getElementById("input3");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }

  function show_upi() {
    var x = document.getElementById("input4");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }

  </script>
<script>
  function validatePayment() {
    let valid = false;
    let totalAmount = 0;

    // Check if any payment mode is selected and corresponding amount is entered
    if ($('#md_checkbox_1').is(':checked') && $('#input2').val()) {
      valid = true;
      totalAmount += parseInt($('#input2').val() || 0);
    }
    if ($('#md_checkbox_3').is(':checked') && $('#input3').val()) {
      valid = true;
      totalAmount += parseInt($('#input3').val() || 0);
    }
    if ($('#md_checkbox_6').is(':checked') && $('#input4').val()) {
      valid = true;
      totalAmount += parseInt($('#input4').val() || 0);
    }

    // Validate if at least one payment method is selected
    if (!valid) {
      alert("Please select at least one payment mode and enter the corresponding amount.");
      return false;
    }

    // Validate if the total amount matches the sum of individual amounts
    let paidAmount = parseInt($('#paid_fee').val() || 0);
    if (paidAmount !== totalAmount) {
      alert("The total amount paid does not match the sum of the selected payment mode amounts.");
      return false;
    }

    return true;
  }

  // Attach the validation function to the form's submit event
  $('#second_form').on('submit', function(e) {
    if (!validatePayment()) {
      e.preventDefault(); // Prevent form submission if validation fails
    }
  });
</script>

  </body>

  </html>