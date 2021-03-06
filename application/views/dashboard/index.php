<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">
            <a href="#">Admin</a>
        </li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <?php 
              $index = 1;
              foreach($response as $key=>$val){ ?>
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white <?php echo 'bg-'.$key;?> tile-box">
                        <div class="card-body pb-0">
                            <div class="text-value">
                                <?php echo $val['name'].' : '.$val['count']; ?>
                            </div>
                            <div>Total WTG :
                                <?php echo $val['total']; ?>
                            </div>
                        </div>
                        <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                            <!-- <canvas class="chart" id="card-chart<?php echo $index;?>" height="70"></canvas> -->
                            <img class="img-fluid" src="<?php echo base_url();?>assets/images/box/<?php echo ($key=='green'? $key .'.gif': $key.'.png');?>" style="margin-top: -35px; margin-left: 108px;"/>
                        </div>
                    </div>
                </div>
                <?php 
                $index++;
              }?>
                <!-- /.col-->
            </div>
            <!-- /.row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Status</div>
                        <div class="card-body">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label>AVG wind speed : </label>
                                <?php echo $avgWindSpeedSum;?>
                                <!-- <div class="avg_wind_speed graph" style="height: 70px;"><canvas style="display: inline-block; width: 468px; height: 40px; vertical-align: top;" width="468" height="40"></canvas></div> -->
                                <div class="chart-wrapper" style="height:50px;">
                                    <canvas id="avg-wind-speed"></canvas>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label>Real Power : </label>
                                <?php echo $powerSpeedSum;?>
                                <!-- <div class="power_speed graph" style="height: 70px;">
                                <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                          </div> -->
                                <div class="chart-wrapper" style="height:50px;">
                                    <canvas id="power-speed"></canvas>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div id="export_gad" style="height:350px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card" style="height: 320px;">
                        <div class="card-header">Performance Trending Chart - Today</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12" style="height: 240px; overflow-y: scroll;">
                                  <?php foreach($device_list as $deviceName=>$deviceArrVal){ ?>
                                    <div class="progress-group mb-4">
                                        <div class="progress-group-prepend">
                                            <span class="progress-group-text"><?php echo $deviceName;?></span>
                                            <input type="hidden" name="device_name[]" value="<?php echo $deviceName;?>">
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress progress-xs">
                                                <!-- <div class="progress-bar bg-danger" role="progressbar" style="width: 150%" aria-valuenow="150" aria-valuemin="0" aria-valuemax="100"></div> -->
                                                <!-- <div class="progress-bar bg-info" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div> -->
                                                <?php foreach($deviceArrVal as $deviceKey=>$deviceVal) {
                                                  if( !empty($deviceVal) ) {?>
                                                <div class="progress-bar bg-<?php echo $deviceVal;?>" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                              <?php } else {?>
                                                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                              <?php }}?>
                                            </div>
                                        </div>
                                    </div>
                                  <?php }?>
                                    <!-- <div class="progress-group mb-4">
                                        <div class="progress-group-prepend">
                                            <span class="progress-group-text">Device 2</span>
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 56%" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-group mb-4">
                                        <div class="progress-group-prepend">
                                            <span class="progress-group-text">Device 3</span>
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-group mb-4">
                                        <div class="progress-group-prepend">
                                            <span class="progress-group-text">Device 4</span>
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 48%" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                                <!-- /.col-->
                            </div>
                            <!-- /.row-->
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- /.row-->
            <div class="card-columns cols-2">
                <div class="card">
                    <div class="card-body">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://embed.windy.com/embed2.html?lat=13.083&lon=80.283&zoom=6&level=surface&overlay=wind&menu=&message=&marker=&calendar=&pressure=&type=map&location=coordinates&detail=&detailLat=13.083&detailLon=80.283&metricWind=default&metricTemp=default&radarRange=-1" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
                <div class="card" style="height:370px">
                    <div class="card-header">Temperature Trending - Notification</div>
                    <div class="card-body">
                        <div class="chart-wrapper mt-3 mx-3" style="height:320px;">
                            <div>
                                <p><b>Total Downtime Today :</b> <?php echo $notify['downTimeTtl'];?></p>
                            </div>
                            <div>
                                <p><b>Total Open Alarms : </b><?php echo $notify['alarmCount'];?></p>
                            </div>
                            <div>
                                <p><b>Unresolved more than 24 hrs : </b></p>
                                <?php if(!empty($notify['unresDevList'])) {
                                    ?>
                                    <ul style="height: 60px;overflow-y: scroll;">
                                    <?php foreach($notify['unresDevList'] as $unreslist) {?>
                                      <li><?php echo $unreslist;?></li>
                                      <?php }?>
                                    </ul>
                                <?php } else {?>
                                    <p>No Device Found</p>
                                <?php }?>
                            </div>
                            <div>
                                <p><b>Recent Alarm name with device name : </b></p>
                                <?php if(!empty($notify['recentAlarmDevList'])) {
                                    ?>
                                    <ul style="height: 60px;overflow-y: scroll;">
                                    <?php foreach($notify['recentAlarmDevList'] as $deviceKey => $alarmName) {?>
                                      <li><?php echo $deviceKey . '-'. $alarmName;?> </li>
                                      <?php }?>
                                    </ul>
                                <?php } else {?>
                                    <p>No Device Found</p>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<aside class="aside-menu">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#timeline" role="tab">
              <i class="icon-list"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#messages" role="tab">
              <i class="icon-speech"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#settings" role="tab">
              <i class="icon-settings"></i>
            </a>
        </li>
    </ul>
    <!-- Tab panes-->
    <div class="tab-content">
        <div class="tab-pane active" id="timeline" role="tabpanel">
            <div class="list-group list-group-accent">
                <div class="list-group-item list-group-item-accent-secondary bg-light text-center font-weight-bold text-muted text-uppercase small">Today</div>
                <div class="list-group-item list-group-item-accent-warning list-group-item-divider">
                    <div class="avatar float-right">
                        <img class="img-avatar" src="<?php echo base_url();?>assets/images/avatars/7.jpg" alt="admin@bootstrapmaster.com">
                </div>
                        <div>Meeting with
                            <strong>Lucas</strong>
                        </div>
                        <small class="text-muted mr-3">
                  <i class="icon-calendar"></i>  1 - 3pm</small>
                        <small class="text-muted">
                  <i class="icon-location-pin"></i>  Palo Alto, CA</small>
                    </div>
                    <div class="list-group-item list-group-item-accent-info">
                        <div class="avatar float-right">
                            <img class="img-avatar" src="<?php echo base_url();?>assets/images/avatars/4.jpg" alt="admin@bootstrapmaster.com">
                </div>
                            <div>Skype with
                                <strong>Megan</strong>
                            </div>
                            <small class="text-muted mr-3">
                  <i class="icon-calendar"></i>  4 - 5pm</small>
                            <small class="text-muted">
                  <i class="icon-social-skype"></i>  On-line</small>
                        </div>
                        <div class="list-group-item list-group-item-accent-secondary bg-light text-center font-weight-bold text-muted text-uppercase small">Tomorrow</div>
                        <div class="list-group-item list-group-item-accent-danger list-group-item-divider">
                            <div>New UI Project -
                                <strong>deadline</strong>
                            </div>
                            <small class="text-muted mr-3">
                  <i class="icon-calendar"></i>  10 - 11pm</small>
                            <small class="text-muted">
                  <i class="icon-home"></i>  creativeLabs HQ</small>
                            <div class="avatars-stack mt-2">
                                <div class="avatar avatar-xs">
                                    <img class="img-avatar" src="<?php echo base_url();?>assets/images/avatars/2.jpg" alt="admin@bootstrapmaster.com">
                  </div>
                                    <div class="avatar avatar-xs">
                                        <img class="img-avatar" src="<?php echo base_url();?>assets/images/avatars/3.jpg" alt="admin@bootstrapmaster.com">
                  </div>
                                        <div class="avatar avatar-xs">
                                            <img class="img-avatar" src="<?php echo base_url();?>assets/images/avatars/4.jpg" alt="admin@bootstrapmaster.com">
                  </div>
                                            <div class="avatar avatar-xs">
                                                <img class="img-avatar" src="<?php echo base_url();?>assets/images/avatars/5.jpg" alt="admin@bootstrapmaster.com">
                  </div>
                                                <div class="avatar avatar-xs">
                                                    <img class="img-avatar" src="<?php echo base_url();?>assets/images/avatars/6.jpg" alt="admin@bootstrapmaster.com">
                  </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item list-group-item-accent-success list-group-item-divider">
                                                <div>
                                                    <strong>#10 Startups.Garden</strong> Meetup</div>
                                                <small class="text-muted mr-3">
                  <i class="icon-calendar"></i>  1 - 3pm</small>
                                                <small class="text-muted">
                  <i class="icon-location-pin"></i>  Palo Alto, CA</small>
                                            </div>
                                            <div class="list-group-item list-group-item-accent-primary list-group-item-divider">
                                                <div>
                                                    <strong>Team meeting</strong>
                                                </div>
                                                <small class="text-muted mr-3">
                  <i class="icon-calendar"></i>  4 - 6pm</small>
                                                <small class="text-muted">
                  <i class="icon-home"></i>  creativeLabs HQ</small>
                                                <div class="avatars-stack mt-2">
                                                    <div class="avatar avatar-xs">
                                                        <img class="img-avatar" src="<?php echo base_url();?>assets/images/avatars/2.jpg" alt="admin@bootstrapmaster.com">
                  </div>
                                                        <div class="avatar avatar-xs">
                                                            <img class="img-avatar" src="<?php echo base_url();?>assets/images/avatars/3.jpg" alt="admin@bootstrapmaster.com">
                  </div>
                                                            <div class="avatar avatar-xs">
                                                                <img class="img-avatar" src="<?php echo base_url();?>assets/images/avatars/4.jpg" alt="admin@bootstrapmaster.com">
                  </div>
                                                                <div class="avatar avatar-xs">
                                                                    <img class="img-avatar" src="<?php echo base_url();?>assets/images/avatars/5.jpg" alt="admin@bootstrapmaster.com">
                  </div>
                                                                    <div class="avatar avatar-xs">
                                                                        <img class="img-avatar" src="<?php echo base_url();?>assets/images/avatars/6.jpg" alt="admin@bootstrapmaster.com">
                  </div>
                                                                        <div class="avatar avatar-xs">
                                                                            <img class="img-avatar" src="<?php echo base_url();?>assets/images/avatars/7.jpg" alt="admin@bootstrapmaster.com">
                  </div>
                                                                            <div class="avatar avatar-xs">
                                                                                <img class="img-avatar" src="<?php echo base_url();?>assets/images/avatars/8.jpg" alt="admin@bootstrapmaster.com">
                  </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane p-3" id="messages" role="tabpanel">
                                                                    <div class="message">
                                                                        <div class="py-3 pb-5 mr-3 float-left">
                                                                            <div class="avatar">
                                                                                <img class="img-avatar" src="<?php echo base_url();?>assets/images/avatars/7.jpg" alt="admin@bootstrapmaster.com">
                                                                                <span class="avatar-status badge-success"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <small class="text-muted">Lukasz Holeczek</small>
                                                                            <small class="text-muted float-right mt-1">1:52 PM</small>
                                                                        </div>
                                                                        <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                                                                        <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="message">
                                                                        <div class="py-3 pb-5 mr-3 float-left">
                                                                            <div class="avatar">
                                                                                <img class="img-avatar" src="<?php echo base_url();?>assets/images/avatars/7.jpg" alt="admin@bootstrapmaster.com">
                                                                                <span class="avatar-status badge-success"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <small class="text-muted">Lukasz Holeczek</small>
                                                                            <small class="text-muted float-right mt-1">1:52 PM</small>
                                                                        </div>
                                                                        <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                                                                        <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="message">
                                                                        <div class="py-3 pb-5 mr-3 float-left">
                                                                            <div class="avatar">
                                                                                <img class="img-avatar" src="<?php echo base_url();?>assets/images/avatars/7.jpg" alt="admin@bootstrapmaster.com">
                                                                                <span class="avatar-status badge-success"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <small class="text-muted">Lukasz Holeczek</small>
                                                                            <small class="text-muted float-right mt-1">1:52 PM</small>
                                                                        </div>
                                                                        <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                                                                        <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="message">
                                                                        <div class="py-3 pb-5 mr-3 float-left">
                                                                            <div class="avatar">
                                                                                <img class="img-avatar" src="<?php echo base_url();?>assets/images/avatars/7.jpg" alt="admin@bootstrapmaster.com">
                                                                                <span class="avatar-status badge-success"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <small class="text-muted">Lukasz Holeczek</small>
                                                                            <small class="text-muted float-right mt-1">1:52 PM</small>
                                                                        </div>
                                                                        <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                                                                        <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="message">
                                                                        <div class="py-3 pb-5 mr-3 float-left">
                                                                            <div class="avatar">
                                                                                <img class="img-avatar" src="<?php echo base_url();?>assets/images/avatars/7.jpg" alt="admin@bootstrapmaster.com">
                                                                                <span class="avatar-status badge-success"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <small class="text-muted">Lukasz Holeczek</small>
                                                                            <small class="text-muted float-right mt-1">1:52 PM</small>
                                                                        </div>
                                                                        <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                                                                        <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane p-3" id="settings" role="tabpanel">
                                                                    <h6>Settings</h6>
                                                                    <div class="aside-options">
                                                                        <div class="clearfix mt-4">
                                                                            <small>
                  <b>Option 1</b>
                </small>
                                                                            <label class="switch switch-label switch-pill switch-success switch-sm float-right">
                                                                                <input class="switch-input" type="checkbox" checked="">
                                                                                <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div>
                                                                            <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="aside-options">
                                                                        <div class="clearfix mt-3">
                                                                            <small>
                  <b>Option 2</b>
                </small>
                                                                            <label class="switch switch-label switch-pill switch-success switch-sm float-right">
                                                                                <input class="switch-input" type="checkbox">
                                                                                <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div>
                                                                            <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="aside-options">
                                                                        <div class="clearfix mt-3">
                                                                            <small>
                  <b>Option 3</b>
                </small>
                                                                            <label class="switch switch-label switch-pill switch-success switch-sm float-right">
                                                                                <input class="switch-input" type="checkbox">
                                                                                <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="aside-options">
                                                                        <div class="clearfix mt-3">
                                                                            <small>
                  <b>Option 4</b>
                </small>
                                                                            <label class="switch switch-label switch-pill switch-success switch-sm float-right">
                                                                                <input class="switch-input" type="checkbox" checked="">
                                                                                <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <h6>System Utilization</h6>
                                                                    <div class="text-uppercase mb-1 mt-4">
                                                                        <small>
                <b>CPU Usage</b>
              </small>
                                                                    </div>
                                                                    <div class="progress progress-xs">
                                                                        <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                    <small class="text-muted">348 Processes. 1/4 Cores.</small>
                                                                    <div class="text-uppercase mb-1 mt-2">
                                                                        <small>
                <b>Memory Usage</b>
              </small>
                                                                    </div>
                                                                    <div class="progress progress-xs">
                                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                    <small class="text-muted">11444GB/16384MB</small>
                                                                    <div class="text-uppercase mb-1 mt-2">
                                                                        <small>
                <b>SSD 1 Usage</b>
              </small>
                                                                    </div>
                                                                    <div class="progress progress-xs">
                                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                    <small class="text-muted">243GB/256GB</small>
                                                                    <div class="text-uppercase mb-1 mt-2">
                                                                        <small>
                <b>SSD 2 Usage</b>
              </small>
                                                                    </div>
                                                                    <div class="progress progress-xs">
                                                                        <div class="progress-bar bg-success" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                    <small class="text-muted">25GB/256GB</small>
                                                                </div>
                                                            </div>
</aside>
<?php  $this->load->view('layout/footer'); ?>
<script type='text/javascript'>
var avg_wind_speed1 = <?php echo json_encode($avgWindSpeed );?>;
//var avg_wind_speed_time = <?php //echo json_encode($avgWindSpeedTime );?>;
var power_speed = <?php echo json_encode($powerSpeed );?>;
var pat_gen = <?php echo json_encode($patGen );?>;

var theme = {
    color: [
        '#26B99A', '#34495E', '#BDC3C7', '#3498DB',
        '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
    ]
};
var avg_wind_speed = [];
var avg_wind_speed_time =[];

for(var [time, avg] of Object.entries(avg_wind_speed1)){
    avg_wind_speed.push(avg);
    avg_wind_speed_time.push(time);
}
console.log(avg_wind_speed);
console.log(power_speed);


    var device_name = [];
    $.each($("input[name='device_name[]']"), function(key, data) {
        device_name.push(data.value);
    });
    console.log(device_name);
if ($('#export_gad').length) {

    var echartBar = echarts.init(document.getElementById('export_gad'), theme);

    echartBar.setOption({
        title: {
            text: 'Export GAD'
            // subtext: 'Graph Sub-text'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data: ['purchases']
        },
        toolbox: {
            show: false
        },
        calculable: false,
        xAxis: [{
            type: 'category',
            // data: ['10', '20', '30', '40', '50', '60', '70', '80', '90', '100', '110', '120']
            data:device_name
        }],
        yAxis: [{
            type: 'value',
            //  data: ['100', '200', '500', '1000', '1500', '2000', '2500', '3000', '4000', '5000', '6000', '7000']
        }],
        series: [{
            // name: 'purchases',
            type: 'bar',
            data: pat_gen,
            /* markPoint: {
             data: [{
               name: 'sales',
               value: 182.2,
               xAxis: 7,
               yAxis: 183,
             }, {
               name: 'purchases',
               value: 2.3,
               xAxis: 11,
               yAxis: 3
             }]
             },
             markLine: {
             data: [{
               type: 'average',
               name: '???'
             }]
             }*/
        }]
    });

}

function init_sparklines() {

    if (typeof(jQuery.fn.sparkline) === 'undefined') { return; }
    console.log('init_sparklines');
    $(".avg_wind_speed").sparkline(avg_wind_speed, {
        type: 'line',
        height: '40',
        width: '100%',
        lineColor: 'green',
        fillColor: 'white',
        lineWidth: 5,
        spotColor: 'red',
        minSpotColor: 'orange'
    });

    $(".power_speed").sparkline(power_speed, {
        title: 'Power Speed',
        type: 'line',
        height: '40',
        width: '100%',
        lineColor: 'blue',
        fillColor: 'white',
        lineWidth: 5,
        spotColor: 'red',
        minSpotColor: 'orange'
    });
};
$(document).ready(function() {

    init_sparklines();
});

// $(".export_gad").sparkline(pat_gen, {
//  type: 'bar',
//   height: '100%',
//   width: '100%',
//  barWidth: 8,
//  colorMap: {
//    '10': '#a1a1a1'
//  },
//  barSpacing: 2,
//  barColor: 'orange'
// }); 

var arr_data1 = [10, 17, 20, 60];
var ttc = document.getElementById("temp_trending_chart");
var cardChart1 = new Chart(ttc, {
    type: 'line',
    data: {
        labels: arr_data1,
        datasets: [{
            label: 'Temperature',
            backgroundColor: getStyle('--primary'),
            borderColor: 'rgba(255,255,255,.55)',
            data: arr_data1
        }]
    },
    options: {
        maintainAspectRatio: false,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                gridLines: {
                    color: 'transparent',
                    zeroLineColor: 'transparent'
                },
                ticks: {
                    fontSize: 2,
                    fontColor: 'transparent'
                }
            }],
            yAxes: [{
                display: false,
                ticks: {
                    display: false,
                    min: 0,
                    max: 89
                }
            }]
        },
        elements: {
            line: {
                borderWidth: 1
            },
            point: {
                radius: 4,
                hitRadius: 10,
                hoverRadius: 4
            }
        }
    }
}); // eslint-disable-next-line no-unused-vars


// var avgWindSpeed = new Chart($('#avg-wind-speed'), {
//   type: 'line',
//   data: {
//     labels: [16.3, 7.1, 12.3, 7.8],
//     datasets: [{
//       // label: 'My First dataset',
//       backgroundColor: getStyle('--primary'),
//       borderColor: 'rgba(255,255,255,.55)',
//       data: [163, 71, 123, 78]
//     }]
//   },
//   options: {
//     maintainAspectRatio: false,
//     legend: {
//       display: false
//     },
//     scales: {
//       xAxes: [{
//         gridLines: {
//           color: 'transparent',
//           zeroLineColor: 'transparent'
//         },
//         ticks: {
//           fontSize: 2,
//           fontColor: 'transparent'
//         }
//       }],
//       yAxes: [{
//         display: false,
//         ticks: {
//           display: false,
//           min: 35,
//           max: 89
//         }
//       }]
//     },
//     elements: {
//       line: {
//         borderWidth: 1
//       },
//       point: {
//         radius: 4,
//         hitRadius: 10,
//         hoverRadius: 4
//       }
//     }
//   }
// });

var avgWindSpeed = new Chart($('#avg-wind-speed'), {
    type: 'line',
    data: {
        labels: avg_wind_speed_time,
        datasets: [{
            label: 'AVG Wind Speed',
            backgroundColor: getStyle('--primary'),
            borderColor: 'rgba(255,255,255,.55)',
            data: avg_wind_speed
        }]
    },
    // options: {
    //   responsive: true
    // }
    options: {
        maintainAspectRatio: false,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                gridLines: {
                    color: 'transparent',
                    zeroLineColor: 'transparent'
                },
                ticks: {
                    fontSize: 2,
                    fontColor: 'transparent'
                }
            }],
            yAxes: [{
                display: false,
                ticks: {
                    display: false,
                    // min: 0,
                    //max: 20
                }
            }]
        },
        elements: {
            line: {
                borderWidth: 1
            },
            point: {
                radius: 4,
                hitRadius: 10,
                hoverRadius: 4
            }
        }
    }
}); // eslint-disable-next-line no-unused-vars


var powerSpeed = new Chart($('#power-speed'), {
    type: 'line',
    data: {
        labels: avg_wind_speed_time,
        datasets: [{
            label: 'Real Power',
            backgroundColor: getStyle('--success'),
            borderColor: 'rgba(255,255,255,.55)',
            data: power_speed
        }]
    },
    // options: {
    //   responsive: true
    // }
    options: {
        maintainAspectRatio: false,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                gridLines: {
                    color: 'transparent',
                    zeroLineColor: 'transparent'
                },
                ticks: {
                    fontSize: 2,
                    fontColor: 'transparent'
                }
            }],
            yAxes: [{
                display: false,
                ticks: {
                    display: false,
                    // min: 0,
                    max: 1000
                }
            }]
        },
        elements: {
            line: {
                borderWidth: 1
            },
            point: {
                radius: 4,
                hitRadius: 10,
                hoverRadius: 4
            }
        }
    }
}); // eslint-disable-next-line no-unused-vars
</script>
