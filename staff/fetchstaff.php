<?php
  include 'asideandheader.php';
  include '../class/phmsclasses.php';

?>



<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header text-center"> All Staff</h5>
            <div class="card-body">
             	<div class="row justify-content-center text-center">
                <div class="col-9">
                  <div class="card-body">
                    <?php
                      if (!empty($_GET)) {
                        # code...
                        echo "<div class='alert alert-success'>".$_GET['msg']."</div>";
                      }
                    ?>
                  <table class="table table-striped table-bordered">
                    <thead>
                      <th>StaffID</th>
                      <th>First Name</th>
                      <th>Lastname</th>
                      <th>Role</th>
                      <th>Speciality</th>
                      <th>Phone Number</th>
                      <th>Action</th>
                    </thead>

                    <tbody>
                      <?php
                        //create street object
                        $admin = new Staff;
                        $staff = $admin->fetchStaff();
                        //var_dump($patients); exit();
                        if(count($staff) >0) {
                          # to check if the street variable has value
                          foreach ($staff as $key => $value) {
                          # code...                       
                          //var_dump($value); exit();
                      ?>
                      <tr>
                        <td><?php echo $value['staff_id']; ?></td>
                        <td><?php echo $value['firstname']; ?></td>
                        <td><?php echo $value['lastname']; ?></td>
                        <td><?php echo $value['staff_type']; ?></td>
                        <td><?php echo $value['speciality']; ?></td>
                        <td><?php echo $value['phone']; ?></td>
                        <td><a href="updatestaff.php?staffid=<?php echo $value['staff_id']; ?>" class="mr-2">Edit</a>|<a href=".php?patientid=<?php echo $value['staff_id']; ?>" class="ml-2">Delete</a></td>
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