<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// echo "<pre>"; print_r($parkview); exit;
?>

<main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item">
            <a href="#">Admin</a>
          </li>
          <li class="breadcrumb-item active">Park View</li>
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <?php 
                  foreach ($parkview['regions'] as $key => $value) {
                    foreach ($parkview['regionDeviceData'] as $key1 => $value1) {
                      if( $value['Region'] == $key1 && array_key_exists($value['Device_Name'], $value1) ) {
                  ?>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header"><?php echo $value['Region'];?></div>
                  <div class="card-body">
                    <table class="table table-responsive-sm table-hover table-outline mb-0">
                      <thead class="thead-light">
                        <tr>
                          <th>Power</th>
                          <th>Windspeed</th>
                          <th>Generating</th>
                          <th>Fault</th>
                          <th>Grid Drop</th>
                          <th>No communication</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><?php echo $value1[$value['Device_Name']][0]['Power'];?></td>
                          <td><?php echo $value1[$value['Device_Name']][0]['Windspeed'];?></td>
                          <td>12</td>
                          <td>61</td>
                          <td>10</td>
                          <td>1</td>
                        </tr>
                      </tbody>
                    </table>
                    <br/>
                    <table class="table table-responsive-sm table-hover table-outline mb-0">
                      <thead class="thead-light">
                        <tr>
                          <th>Loc no</th>
                          <th>Status</th>
                          <th>Capacity</th>
                          <th>Power</th>
                          <th>Wind speed</th>
                          <th>Rotor RPM</th>
                          <th>Generator RPM</th>
                          <th>Pitch ANGLE</th>
                          <th>Freq</th>
                          <th>Voltage</th>
                          <th>Daily GEN</th>
                          <th>Feeder</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><?php echo $value['LOC_No'];?></td>
                          <td><?php echo $value1[$value['Device_Name']][0]['Status'];?></td>
                          <td><?php echo $value['capacity'] ? $value['capacity']: 0;?></td>
                          <td><?php echo $value1[$value['Device_Name']][0]['Power'];?></td>
                          <td><?php echo $value1[$value['Device_Name']][0]['Windspeed'];?></td>
                          <td><?php echo $value1[$value['Device_Name']][0]['RRPM'];?></td>
                          <td><?php echo $value1[$value['Device_Name']][0]['GRPM'];?></td>
                          <td><?php echo (array_key_exists('Pitch', $value1[$value['Device_Name']][0]) ? $value1[$value['Device_Name']][0]['Pitch'] : 0);?></td>
                          <td><?php echo (array_key_exists('Frequency', $value1[$value['Device_Name']][0]) ? $value1[$value['Device_Name']][0]['Frequency'] : 0);?></td>
                          <td><?php echo $value1[$value['Device_Name']][0]['RPhase_Volt'];?></td>
                          <td><?php echo (array_key_exists('Gen1_Temp', $value1[$value['Device_Name']][0]) ? $value1[$value['Device_Name']][0]['Gen1_Temp'] : 0);?></td>
                          <td><?php echo $value['Connect_Feeder'];?></td>
                        </tr>
                      </tbody>
                    </table>
                    
                  </div>
                </div>
              </div>
              <!-- /.col-->
            </div>
            <!-- /.row-->
            <div class="row">
              <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">Active Alarams</div>
                      <div class="card-body">
                        <table class="table table-responsive-sm table-hover table-outline mb-0">
                          <thead class="thead-light">
                            <tr>
                              <th>Date</th>
                              <th>Stop Time</th>
                              <th>Turbine Name</th>
                              <th>Error Description</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>6400</td>
                              <td>100 m/s</td>
                              <td>12</td>
                              <td>61</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                </div>
              </div>
            </div>
            <!-- /.row-->
              <?php
                    }
                  }
                }
              ?>
            
          </div>
        </div>
      </main>
        <!-- /page content -->
<?php  $this->load->view('layout/footer'); ?>