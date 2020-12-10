<?php
  include 'asideandheader.php';
  include '../class/phmsclasses.php'; 

  //var_dump($_SERVER);
  
  $err = array();

  if (!empty($_POST) && $_POST['submit'] == 'submit') {

   /** $j = count($_POST['timein']);

    for ($i=0; $i < $j; $i++) { 

      //ensure there are no empty inputs
      if (empty($_POST['date'])) {
        # code...
        $date  err[$i] = "<small class='text-danger'>Date cannot be empty</small>";
      }

      if (empty($_POST['staffid'])) {
        # code...
        $err[$i] = "<small class='text-danger'>Start time must be filled</small>";
      }
 
      if (empty($_POST['timein'])) {
        # code...
        $err[$i] = "<small class='text-danger'>End time must be filled</small>";
      }

      if (empty($_POST['timeout'])) {
        # code...
        $err[$i] = "<small class='text-danger'>End time must be filled</small>";
      }

    }
    




    validate the input time: check if timeout is less than time in
    $date1 = new Datetime($_POST['timein']);
     $date2 = new Datetime($_POST['timeout']);

     if ($date2 > $date1) {
      # code...

      echo('Time2 is greater than Time1');

     } else{

      echo "Time1 is greater than Time2";
     } **/
    
    //var_dump($_POST['timein']); exit();

    $admin = new Roaster;

    $response = $admin->createRoaster($_POST['staff'], $_POST['date'], $_POST['timein'], $_POST['timeout']);

    if ($response == true) {
      # code...
      $msg = "<div class='alert alert-success'>Roaster creation Successful</div>";

    }else{

      $msg = "<div class='alert alert-danger'>Roaster creation Failed</div>";
    }
  }

?>



<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header text-center"> Create staff roaster</h5>
            <div class="card-body">
              <?php
                if (isset($msg)) {
                  echo $msg;
                }

              ?>
            	<!-- form to create staff roaster -->
              <form action="" method="post">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Staff Name</th>
                      <th>Start Time</th>
                      <th>End Time</th>
                    </tr>
                  </thead>

                  <tbody id="table_body">
                    <tr>
                      <td>
                        <div class="form-inline my-2 my-md-0">
                          <input class="form-control" name="date[0]" type="date" placeholder="Search" value="">
                        </div>
                      </td>
                      <td>
                        <div class="form-inline my-2 my-md-0">
                          <input class="form-control" name="staff[0]" type="text" placeholder="staffid" value="">
                        </div>
                      </td>
                      <td>
                        <div class="form-inline my-2 my-md-0">
                          <input class="form-control" name="timein[0]" type="time" placeholder="Start Time" value="">
                        </div>
                      </td><td>
                        <div class="form-inline my-2 my-md-0">
                          <input class="form-control" name="timeout[0]" type="time" placeholder="Start Time" value="">
                        </div>
                      </td>
                    </tr>

                  </tbody>
                  
                </table>

                <div class="form-group">
                  <button type="button" class="btn btn-block btn-primary" id="addrow">Add a new Entry</button>
                  <button type="button" class="btn btn-block btn-primary" id="deleterow">Delete last row Entry</button>
                  <button type="submit" class="btn btn-block btn-primary" id="addrow" value="submit" name="submit">Submit</button>
                </div>

              </form>
               
            </div>
        </div>
    </div>




<?php
	include 'footer.php';

?>


<script type="text/javascript">
  $(document).ready(function(){
      var i=1;
      //to add a new roaster row on the page
      $('#addrow').click(function() {

        content = "<tr> <td> <div class='form-inline my-2 my-md-0'> <input class='form-control' name='date["+i+"]' type='date' placeholder='Search' aria-label='Search'> <?php 
                        if (isset($reg_error['address'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['address']."</div>";
                        }
                        ?></div>           </td> <td> <div class='form-inline my-2 my-md-0'> <input class='form-control' name='staff["+i+"]' type='text' placeholder='staffid' > <?php 
                        if (isset($reg_error['address'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['address']."</div>";
                        }
                        ?></div> </td> <td> <div class='form-inline my-2 my-md-0'> <input class='form-control' name='timein["+i+"]' type='time' placeholder='Start Time' >  <?php 
                        if (isset($reg_error['address'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['address']."</div>";
                        }
                        ?></div> </td><td> <div class='form-inline my-2 my-md-0'> <input class='form-control' name='timeout["+i+"]' type='time' placeholder='Start Time' > <?php 
                        if (isset($reg_error['address'])) {
                          # this gets the error message from the validation and ouputs it
                          echo "<div class='alert'>".$reg_error['address']."</div>";
                        }
                        ?></div> </td> </tr>";

        $('table tbody').append(content);

        i++;

      }); 

      //to remove the last roaster row on the page
     $('#deleterow').click(function() {
      $('tr').last().remove();
      i--;

     });

    })
</script>