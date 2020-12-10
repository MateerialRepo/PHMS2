<?php

    include "asideandheader.php";

?>


    <div class="" id="pagebody">

            <div class="row justify-content-center mb-4">
                <div class="col-xl-11 col-lg-11 col-md-11 col-sm-12">
                    <div class="card">
                        <h5 class="card-header text-center">Card for inputs</h5>
                        <div class="card-body">
                            Content is here
                            <?php 
                              echo  md5(123456789);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
                

            <div class="row justify-content-center mb-4">
                <div class="col-xl-11 col-lg-11 col-md-11 col-sm-12">
                    <div class="card">
                        <h5 class="card-header text-center">Sample Table</h5>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead class="bg-light">
                                        <tr class="">
                                            <th class="">S/N</th>
                                            <th class="">Doctor Name</th>
                                            <th class="">Gender</th>
                                            <th class="">Speciality</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>#</td>
                                            <td>#</td> 
                                            <td>#</td>                                                                     
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>#</td>
                                            <td>#</td> 
                                            <td>#</td> 
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>#</td>
                                            <td>#</td> 
                                            <td>#</td> 
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>#</td>
                                            <td>#</td> 
                                            <td>#</td> 
                                        </tr>
                                        <tr>
                                            <td colspan="9"><a href="#" class="btn btn-outline-light float-right">View Details</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- eof the table card -->
            </div>

            <!-- ============================================================== -->
                                        <!--another card space  -->
                <!-- ============================================================== -->
            <div class="row justify-content-center">
                <div class="col-xl-11 col-lg-11 col-md-11 col-sm-12">
                    <div class="card">
                        <h5 class="card-header text-center"> Another Card body</h5>
                        <div class="card-body">
                           This is another card body for content
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end of card space  -->
                
            </div>
        </div>
    </div>


<?php
    include "footer.php";

?>