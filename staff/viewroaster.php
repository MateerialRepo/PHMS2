<?php
  include 'asideandheader.php';
  include '../class/phmsclasses.php'; 


?>



<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header text-center"> Doctor's Roaster</h5>
            <div class="card-body">
             	<div class="row justify-content-center text-center">
                <div class="col-9">
                  <div class="card-body">
                  <table class="table table-responsive table-striped table-bordered">
                    <thead>
                      <th>S/N</th>
                      <th>First Name</th>
                      <th>Lastname</th>
                      <th>Call Date</th>
                      <th>Time In</th>
                      <th>Time Out</th>
                      <th>Action</th>
                    </thead>

                    <tbody>
                      <?php
                        //create street object
                        $admin = new Roaster;
                        $roaster = $admin->fetchRoaster();
                        //var_dump($roaster); exit();
                        $count = 1;
                        if(count($roaster) >0) {
                          # to check if the street variable has value
                          foreach ($roaster as $key => $value) {
                          # code...                       
                          //var_dump($value); exit();
                      ?>
                      <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $value['firstname']; ?></td>
                        <td><?php echo $value['lastname']; ?></td>
                        <td><?php echo date('d M Y', strtotime($value['call_date'])); ?></td>
                        <td><?php echo $value['call_start']; ?></td>
                        <td><?php echo $value['call_end']; ?></td>
                        <td><a href="editroaster.php?patientid=<?php echo $value['roaster_id']; ?>" class="mr-2">Edit</a>|<a href="deleteRoasterentry.php?patientid=<?php echo $value['roaster_id']; ?>" class="ml-2">Delete</a></td>
                      </tr>

                      <?php
                          }
                        }

                      ?>
                    </tbody>
                  </table>
                 
                </div>               
            </div>
        </div>
    </div>
  </div>
</div>






<?php
	include 'footer.php';

?>