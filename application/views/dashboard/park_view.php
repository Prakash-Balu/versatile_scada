<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 //echo "<pre>"; print_r($regionDeviceData); exit;
?>
<style>
.table .thead-green th {
    color: #fff;
    background-color: #4dbd74;
    border-color: #c8ced3;
}

.table .thead-blue th {
    color: #fff;
    background-color: #20a8d8;
    border-color: #c8ced3;
}

.table .thead-airforce-blue th {
    color: #fff;
    background-color: #517fa4;
    border-color: #c8ced3;
}

.table .thead-pompadour th {
    color: #fff;
    background-color: #581845;
    border-color: #c8ced3;
}

/*#581845 - Pompadour*/
/*#20a8d8*/
</style>
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
            <?php if(!empty($regions)) {
                  foreach ($regions as $key => $value) {
                    
                  ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <?php echo $key.' - '.date('d-m-Y', strtotime($regionDeviceData[$key][$value['device_list'][0]]['Date_S'])).' '.date('h:i:s a', strtotime($regionDeviceData[$key][$value['device_list'][0]]['Time_S']));?>
                        </div>
                        <div class="card-body">
                            <!-- <table class="table table-responsive-sm table-hover table-outline mb-0">
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
                          <td><?php echo array_sum($value['Power'])/1000;?></td>
                          <td><?php echo array_sum($value['Windspeed']) / count($value['device_list']);?></td>
                          <td>--</td>
                          <td>--</td>
                          <td>--</td>
                          <td>--</td>
                        </tr>
                      </tbody>
                    </table>
                    <br/> -->
                            <?php if(!empty($regionDeviceData)) { ?>
                            <table class="table table-responsive-sm table-hover table-outline mb-0">
                                <thead class="thead-airforce-blue">
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
                      $green_array = array('Run', 'RUN', 'M/C Running', 'M/C Running');
                      $blue_array = array('GRIDDROP', 'griddrop', 'Grid Drop', 'Grid Drop');
                      $red_array = array_merge($green_array,$blue_array);

                      foreach ($regionDeviceData as $key1 => $value1) {
                        if( $key == $key1  ) {
                          foreach ($value1 as $key2 => $value2) {
                $device_name = !empty($value2['Device_Name'])?$value2['Device_Name']:0;
                $IMEI = !empty($value2['IMEI'])?$value2['IMEI']:0;
        $powerMaxValue = 500;
        if($value2['Format_Type'] == 1) {
          $powerMaxValue = 600;
        } elseif($value2['Format_Type'] == 2) {
          $powerMaxValue = 300;
        } elseif($value2['Format_Type'] == 3) {
          $powerMaxValue = 900;
        } elseif($value2['Format_Type'] == 7) {
          $powerMaxValue = 900;
        } elseif($value2['Format_Type'] == 8) {
          $powerMaxValue = 300;
        } elseif($value2['Format_Type'] == 10) {
          $powerMaxValue = 300;
        }
        
                    ?>
                                    <tr>
                                        <td>
                                            <a target="_blank" href="<?php echo base_url().'dashboard/device_view?d='.$IMEI;?>">
                                                <?php echo $device_name;?></a>
                                        </td>
                                        <td>
                                            <?php
                           $color = 'gray';
                           $symbol = '<i class="fa fa-circle-o fa-3" aria-hidden="true"></i>';
                          $status =!empty($value2['Status'])?$value2['Status']:'';
                          if(in_array($status,$green_array))
                          {
                            $color = 'green';//green
                            $symbol = '<i class="fa fa-check fa-3" aria-hidden="true"></i>';
                          }elseif(in_array($status,$blue_array)){
                            $color = 'blue';
                            $symbol = '<i class="fa fa-circle-o fa-3" aria-hidden="true"></i>';
                          }elseif(in_array($status,$red_array)){
                            $color = 'red';//red
                            $symbol = '<i class="fa fa-times fa-3" aria-hidden="true"></i>';
                          }

                          ?>
                                            <!-- <div class="progress progress-xs" style="height:15px;">
                                                <div class="progress-bar bg-<?php echo $color;?>" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div> -->
                                            <div class="mark text-center" style="color:#fff;background-color: <?php echo $color;?>">
                                                <?php echo $symbol;?>
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo !empty($value2['capacity']) ? $value2['capacity']: 0;?>
                                        </td>
                                        <td style="width: 12%;">
                                            <div class="progress-group">
                                                <div class="progress-group-header align-items-end">
                                                    <div class="ml-auto font-weight-bold mr-2">
                                                        <?php echo !empty($value2['Power'])?$value2['Power']:0;?>
                                                    </div>
                                                </div>
                                                <div class="progress-group-bars">
                                                    <div class="progress progress-xs" style="height:15px;">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo !empty($value2['Power'])?$value2['Power']:0;?>%" aria-valuenow="<?php echo !empty($value2['Power'])?$value2['Power']:0;?>" aria-valuemin="0" aria-valuemax="<?php echo $powerMaxValue;?>"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="progress-group">
                                                <div class="progress-group-header align-items-end">
                                                    <div class="ml-auto font-weight-bold mr-2">
                                                        <?php echo !empty($value2['Windspeed'])?$value2['Windspeed']:0;?>
                                                    </div>
                                                </div>
                                                <div class="progress-group-bars">
                                                    <div class="progress progress-xs" style="height:15px;">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo (!empty($value2['Windspeed'])?$value2['Windspeed']:0);?>%" aria-valuenow="<?php echo !empty($value2['Windspeed'])?$value2['Windspeed']:0;?>" aria-valuemin="0" aria-valuemax="30"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo !empty($value2['RRPM'])?$value2['RRPM']:0;?>
                                        </td>
                                        <td>
                                            <?php echo !empty($value2['GRPM'])?$value2['GRPM']:0;?>
                                        </td>
                                        <td>
                                            <?php echo !empty($value2['Pitch'])?$value2['Pitch']:0;?>
                                        </td>
                                        <td>
                                            <?php echo !empty($value2['Frequency'])?$value2['Frequency']:0;?>
                                        </td>
                                        <td>
                                            <?php echo !empty($value2['RPhase_Volt'])?$value2['RPhase_Volt']:0;?>
                                        </td>
                                        <td>
                                            <?php echo !empty($value2['Gen1_Temp'])?$value2['Gen1_Temp']:0;?>
                                        </td>
                                        <td>
                                            <?php echo !empty($value2['Connect_Feeder'])?$value2['Connect_Feeder']:0;?>
                                        </td>
                                    </tr>
                                    <?php }} }?>
                                </tbody>
                            </table>
                            <?php }?>
                            <br />
                            <?php if(!empty($footer_data[$key])) {?>
                            <h4> Active Alarams </h4>
                            <table class="table table-responsive-sm table-hover table-outline mb-0">
                                <thead class="thead-pompadour">
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
                                  $i=1;
                                  foreach ($val as $info) {
                                    if($i==6)
                                       break;
                          ?>
                                    <tr>
                                        <td>
                                            <?php echo $info['Date_S'];?>
                                        </td>
                                        <td>
                                            <?php echo date('h:i:s a', strtotime($info['Time_S']));?>
                                        </td>
                                        <td>
                                            <?php echo $info['Device_Name'];?>
                                        </td>
                                        <td>
                                            <?php echo $info['Description'];?>
                                        </td>
                                    </tr>
                                    <?php $i++;} } }?>
                                </tbody>
                            </table>
                            <?php } else { ?>
                            <h4> Active Alarams </h4>
                            <table class="table table-responsive-sm table-hover table-outline mb-0">
                                <thead class="thead-pompadour">
                                    <tr>
                                        <th>Date</th>
                                        <th>Stop Time</th>
                                        <th>Turbine Name</th>
                                        <th>Error Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center" colspan="4">
                                            No Records found
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php }?>
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
        } else{ echo "<h4 class='text-center'> No Record Available</h4>";}
              ?>
        </div>
    </div>
</main>
<!-- /page content -->
<?php  $this->load->view('layout/footer'); ?>