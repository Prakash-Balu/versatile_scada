<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// echo "<pre>"; print_r($parkview); exit;
?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Park View</h3>
              </div>
              
              <!--<div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>-->
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <?php foreach ($parkview['regions'] as $key => $value) {
                foreach ($parkview['regionDeviceData'] as $key1 => $value1) {
                  

                    if( $value['Region'] == $key1 && array_key_exists($value['Device_Name'], $value1) ) {
// echo "<pre>"; print_r($key); 
//                     echo "<pre>"; print_r($value); 
//                     echo "<pre>"; print_r($key1); 
//                     echo "<pre>"; print_r($value1); exit;
                    
                ?>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?php echo $value['Region'];?></h2>
                     <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                    <table id="table1" class="table table-striped table-bordered nowrap data_table" style="width:100%">
                      <thead>
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
                  </div>
                </div>
              </div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Device info</h2>
                      <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="table2" class="table table-striped table-bordered nowrap data_table" style="width:100%">
                      <thead>
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
                          <td><?php echo $value['capacity'];?></td>
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
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Active Alarams</h2>
                     <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                    <table  id="table3" class="table table-striped table-bordered nowrap data_table" style="width:100%">
                      <thead>
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
              <?php
                  }
                }
              }
            ?>
            </div>
           
          </div>
        </div>
        <!-- /page content -->
<?php  $this->load->view('layout/footer'); ?>