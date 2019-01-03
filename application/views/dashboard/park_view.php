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
                  foreach ($regions as $key => $value) {
                    
                  ?>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header"><?php echo $key;?></div>
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
                          <td><?php echo array_sum($value['Power']);?></td>
                          <td><?php echo array_sum($value['Windspeed']);?></td>
                          <td>--</td>
                          <td>--</td>
                          <td>--</td>
                          <td>--</td>
                        </tr>
                      </tbody>
                    </table>
                    <br/>
                    <?php if(!empty($regionDeviceData)) { ?>
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
                      <?php
                      foreach ($regionDeviceData as $key1 => $value1) {
                        if( $key == $key1  ) {
                          foreach ($value1 as $key2 => $value2) {
                    ?>
                        <tr>
                          <td><?php echo !empty($value2['LOC_No'])?$value2['LOC_No']:0;?></td>
                          <td><?php echo !empty($value2['Status'])?$value2['Status']:'';?></td>
                          <td><?php echo !empty($value2['capacity']) ? $value2['capacity']: 0;?></td>
                          <td><?php echo !empty($value2['Power'])?$value2['Power']:0;?></td>
                          <td><?php echo !empty($value2['Windspeed'])?$value2['Windspeed']:0;?></td>
                          <td><?php echo !empty($value2['RRPM'])?$value2['RRPM']:0;?></td>
                          <td><?php echo !empty($value2['GRPM'])?$value2['GRPM']:0;?></td>
                          <td><?php echo !empty($value2['Pitch'])?$value2['Pitch']:0;?></td>
                          <td><?php echo !empty($value2['Frequency'])?$value2['Frequency']:0;?></td>
                          <td><?php echo !empty($value2['RPhase_Volt'])?$value2['RPhase_Volt']:0;?></td>
                          <td><?php echo !empty($value2['Gen1_Temp'])?$value2['Gen1_Temp']:0;?></td>
                          <td><?php echo !empty($value2['Connect_Feeder'])?$value2['Connect_Feeder']:0;?></td>
                        </tr>
                        <?php }} }?>
                      </tbody>
                    </table>
                    <?php }?> 
                    <br/>
                    <?php if(!empty($footer_data)) {?>
                    <h4> Active Alarams </h4>
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
                          <?php foreach ($footer_data as $k => $val) {
                                if( $key == $k ) {
                                  foreach ($val as $info) {
                          ?>
                            <tr>
                              <td><?php echo $info['Date_S'];?></td>
                              <td><?php echo $info['Time_S'];?></td>
                              <td><?php echo $info['Device_Name'];?></td>
                              <td><?php echo $info['Description'];?></td>
                            </tr>
                          <?php } } }?>
                          </tbody>
                        </table>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <!-- /.col-->
            </div>
            <!-- /.row-->
            <!--<div class="row">
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
            </div> -->
            <!-- /.row-->
              <?php
                  
                }
              ?>
            
          </div>
        </div>
      </main>
        <!-- /page content -->
<?php  $this->load->view('layout/footer'); ?>