<div class ="col-sm-9 col-md-12 main" style="padding-left: 20px" >
  <div>
    <br>
    <button id = "neftModalStatus" class = "btn btn-danger btn-large btn-block" data-toggle="modal" data-target="#neftDdModalStatus">Click here to check NEFT/Inter/Intra Bank transaction Status</button>
    <br>
    <legend class="alert alert-warning">
      Not for State bank collect / i-collect transactions <br>
      <small>Those who already entered i-collect are deleted</small>
    </legend>
    <br>
    <!--NEFT/DD payment detail collection  modal START -->
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li class="active"><a href="#neftInstructionsTab" role="tab" data-toggle="tab">Instructions</a></li>
      <li><a id = "nextBtnClicked" href="#neftFormTab" role="tab" data-toggle="tab">Form</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane active" id="neftInstructionsTab">
        <!--instructions goes here-->
        <h5>Please read the instructions below very carefully:</h5>
        <ol>
          <li>You are allowed to upload details for more than one NEFT/Inter/Intra bank transactions i.e you can submit this form more than once but do not submit twice for same NEFT/Inter/Intra bank transfer</li>
          <li>You have to submit separate details for each NEFT/Inter/Intra bank Transaction.</li>
          <li>Do not mix-up <strong>tuition fees</strong> with <strong>hostel/mess</strong> charges. Submit separate forms for both.</li>
          <li>Select payment category as <strong>Chief warden</strong> for mess and hostel charges</li>
          <li>Please decompose your NEFT/Inter/Intra bank transaction amount and put decomposed amounts in appropriate fields.</li>
          <li>Each field should be filled with appropriate amount. Fields which are not applicable leave it as ‘0’.</li>
          <li>Please make sure that auto-generated total amount field matches with the amount in your NEFT/Inter/Intra bank transaction slip.</li>
          <li>Please upload a clear scanned/photographed copy of the NEFT/Inter/Intra bank transaction slip.</li>
          <li>Only JPEG format images are allowed</li>
          <li>Please note that maximum allowed file size is 1MB (1024KB).</li>
          <li>Do not upload/add invalid/incorrect NEFT/Inter/Intra bank transaction information. If invalid/incorrect information is found allotment will be cancelled and heavy penalty will be imposed.</li>
        </ol>
        <p>
          <strong>Example scenario:</strong><br> 
          If you have made a NEFT/Inter/Intra bank transaction of 12000 as mess advance and 3500 as mess dues, write 12000 in mess advance and 3500 in mess dues box and you will see total amount automatically being calculated and updated in total amount box.
        </p>
        <div class="well" style="max-width: 400px; margin: 0 auto 10px;">
          <button id= "neftNextBtn" type="button" class="btn btn-primary btn-block">Next (not for i-collect)</button>
        </div>
      </div>
      <div class="tab-pane" id="neftFormTab">
        <form id="neftForm" class="form-horizontal" role="form">
          <strong class="text-danger">
            Please enter the following details very carefully. Re-submission of these details are not allowed.
          </strong>
          <div class="row">
            <!--row 1-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="neftMode" class="col-sm-4 control-label">Payment Mode</label>
                <div class="col-sm-8">
                  <select id="neftMode" class="form-control" required>
                    <option value="">--Select One--</option>
                    <option value="neft">NEFT</option>
                    <option value="inter">Inter/Intra bank transaction</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="neftPayId" class="col-sm-4 control-label">Transaction ID</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="neftPayId" required>
                  <div class="help-block">If you have more than one NEFT receipt/ Inter Bank transfer receipt, fill wsdc-collect multiple times for each transaction and fill the fee head accordingly. If the total amount in the image and total amount calculated is not matched, your transaction will be cancelled.</div>
                </div>
              </div>
              <div class="form-group">
                <label for="neftPayDate" class="col-sm-4 control-label">Transaction Date</label>
                <div style="padding-left:17px;" class="col-sm-7 col-md-8 input-group">
                  <input type="text" class="form-control" id="neftPayDate" required disabled>
                  <div id="neftDatePick" class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="neftCat" class="col-sm-4 control-label">Payment Category</label>
                <div class="col-sm-8">
                  <select id="neftCat" class="form-control" required>
                    <option value="">--Select One--</option>
                    <option value="1" selected>Chief Warden</option>
                    <option value="0">Fee account</option>
                  </select>
                </div>
              </div>
            </div>
            <!--row 2-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="neftMessDue" class="col-sm-4 control-label">Mess Dues</label>
                <div class="col-sm-8">
                  <input class="form-control neft-payments" type="number" class="form-control" id="neftMessDue" value="0" required>
                  <span class="help-block">Negative values are accepted</span>   
                </div>
              </div>

              <div class="form-group">
                <label for="neftMessAdv" class="col-sm-4 control-label">Mess Advance</label>
                <div class="col-sm-8">
                  <input class="form-control neft-payments" type="number" class="form-control" id="neftMessAdv" value="0" required>
                  <div class="help-block">Make sure you fill all the fee heads correctly</div>
                </div>
              </div>

              <div class="form-group">
                <label for="neftSeat" class="col-sm-4 control-label">Seat Rent</label>
                <div class="col-sm-8">
                  <input class="form-control neft-payments" type="number" class="form-control" id="neftSeat" value="0" required>
                </div>
              </div>

              <div class="form-group">
                <label for="neftMain" class="col-sm-4 control-label">Maintenance</label>
                <div class="col-sm-8">
                  <input class="form-control neft-payments" type="number" class="form-control" id="neftMain" value="0" required>
                </div>
              </div>

              <div class="form-group">
                <label for="neftEwc" class="col-sm-4 control-label">Electricity and Water Charges</label>
                <div class="col-sm-8">
                  <input class="form-control neft-payments" type="number" class="form-control" id="neftEwc" value="0" required>
                </div>
              </div>
            </div>
            <!--row 3-->
            <div class="col-md-4">
              <div class="form-group">
                <label for="neftFee" class="col-sm-4 control-label">Tuition Fee</label>
                <div class="col-sm-8">
                  <input class="form-control neft-payments" type="number" class="form-control" id="neftFee" value="0" required>
                </div>
              </div>

              <div class="form-group">
                <label for="neftOthers" class="col-sm-4 control-label">Others</label>
                <div class="col-sm-8">
                  <input class="form-control neft-payments" type="number" class="form-control" id="neftOthers" value="0" required>
                </div>
              </div>

              <div class="form-group">
                <label for="neftAmmnt" class="col-sm-4 control-label">Total Amount</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="neftAmmnt" value="0" required disabled>
                </div>
              </div>

              <div class="form-group">
                <label for="neftFiles" class="col-sm-4 control-label">Upload Photo/Scanned</label>
                <div class="col-sm-8">
                  <input type="file" class="form-control" id="neftFiles" required>
                </div>
              </div>
            </div>
          </div>
        </form>
        <div id="neftConfDiv" style="display:none;" class="col-md-6 col-xs-12 col-lg-6">
          <legend>Please confirm the entered details. Click the submit button to proceed or click edit to edit these details.</legend>
          <table id="neftConfTbl" class="table table-hover table-striped table-bordered">
            <thead>
            </thead>
            <tbody>
              <tr>
                <td><strong>Payment Mode</strong>
                </td>
                <td></td>
              </tr>
              <tr>
                <td><strong>Transaction Id</strong>
                </td>
                <td></td>
              </tr>
              <tr>
                <td><strong>Transaction Date</strong>
                </td>
                <td></td>
              </tr>
              <tr>
                <td><strong>Payment Category</strong>
                </td>
                <td></td>
              </tr>
              <tr>
                <td><strong>Mess Due</strong>
                </td>
                <td></td>
              </tr>
              <tr>
                <td><strong>Mess Advance</strong>
                </td>
                <td></td>
              </tr>
              <tr>
                <td><strong>Seat Rent</strong>
                </td>
                <td></td>
              </tr>
              <tr>
                <td><strong>Maintenance</strong>
                </td>
                <td></td>
              </tr>
              <tr>
                <td><strong>Electricity and Water Charges</strong>
                </td>
                <td></td>
              </tr>
              <tr>
                <td><strong>Fee Account</strong>
                </td>
                <td></td>
              </tr>
              <tr>
                <td><strong>Others</strong>
                </td>
                <td></td>
              </tr>
              <tr>
                <td><strong>Total Paid Amount</strong>
                </td>
                <td></td>
              </tr>
              <tr>
                <td><strong>File</strong>
                </td>
                <td></td>
              </tr>
            </tbody>
          </table>

          <div class="progress" style="display:none;">
            <div id="niftDDuploadProg" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
              <span class="sr-only">45% Complete</span>
            </div>
          </div>
          <div style = "display:none;" id = "progressGif">
            <h5>Please do not refresh the page or press the back button after pressing the 'submit' button while your request is being processed</h5>
            <h5>Page will automatically refresh after successful submission.</h5>
            <img src="/student/assets/images/720.GIF">
          </div>
        </div>
        <div class="clearfix"></div>
        <center>
          <button id="neftConfBtn" type="button" class="btn btn-primary btn-large" onclick="neft_form_cnf()">Confirm</button>
          <button id="neftSbmtfBtn" style="display:none;" type="button" class="btn btn-primary btn-large" onclick="neft_form_sub()">Submit</button>
          <button id="neftEditfBtn" style="display:none;" type="button" class="btn btn-danger btn-large" onclick="neft_form_edit()">Edit</button>
        </center>
        <!--NEFT/DD payment detail collection  modal END -->
      </div>
    </div>
    <!--NEFT/DD payment status  modal START -->
    <div id = "neftDdModalStatus" class="modal fade bs-example-modal-lg"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">NEFT/Intra/Inter bank transaction Status</h4>
          </div>
          <div class="modal-body">
            <?php if($neftdd_details){ ?>
            <table class = "table table-hover table-striped table-bordered">
              <thead>
              <tr>
                <th>Registration No.</th>
                <th>Transaction ID</th>
                <th>Transaction Date</th>
                <th>Category</th>
                <th>Mode</th>
                <th>Amount</th>
                <th>Files</th>
                <th>Current Status</th>
                </tr>
              </thead>
              <tbody>
                <?php for ($curr = 0; $curr<count($neftdd_details);++$curr) {
                  $neftdd_detail = $neftdd_details[$curr];
                  ?>
                  <tr>
                    <td><?php echo $neftdd_detail['registration_number'] ?></td>
                    <td><?php echo $neftdd_detail['transaction_id'] ?></td>
                    <td><?php echo $neftdd_detail['transaction_date'] ?></td>
                    <td><?php 
                      if($neftdd_detail['type']=='1'){
                        echo "Chief Warden";
                      }
                      if($neftdd_detail['type']=='0'){
                        echo "Fee account";
                      }
                      ?></td>
                      <td><?php 
                        if($neftdd_detail['category']=='1'){
                          echo "NEFT";
                        }
                        if($neftdd_detail['category']=='2'){
                          echo "DD";
                        }
                        if($neftdd_detail['category']=='3'){
                          echo "Inter/Intra bank transation";
                        }
                        ?></td>
                        <td><?php echo "Rs. " . $neftdd_detail['total'] ?></td>
                        <td>
                          <?php 
                          $image_link = "<a href = '/student/uploads/".$regno."/".$neftdd_detail['transaction_id'] . ".jpeg" ."' target='_blank'>".$neftdd_detail['transaction_id'] .".jpeg"."</a>";
                          echo$image_link;
                          ?>
                        </td>
                        <td>
                          <?php 
                          switch ($neftdd_detail['status']) {
                            case '0':
                            echo "Sent to hostel office for verification";
                            break;
                            case '1':
                            echo "Transaction updated / receipt not submitted";
                            break;
                            case '2':
                            echo "Rejected";
                            break;
                            case '3':
                            echo "Transaction Confirmed / Receipt submitted";
                            break;
                            default:
                            # code...
                            break;
                          }
                          ?>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  <?php }else{ ?>
                  <center><h1>No NEFT/Intra/Inter bank transaction data available.</h1></center>
                  <?php } ?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

