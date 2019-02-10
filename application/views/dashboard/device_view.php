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
        <li class="breadcrumb-item active">
            <?php echo $regions['Device_Name'];?>
        </li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-4">
                    <div class="card" style="height: 415px;">
                        <div class="card-header">
                            <?php echo $regions['Device_Name'];?>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <img src="<?php echo base_url();?>assets/images/box/<?php echo !empty($live_status['color'])?$live_status['color']:'gray'.'.png'?>" class="img-fluid" style=" position: absolute;height: 60%;">
                                </div>
                                    <div class="col-sm-8">
                                        <p>Device Name :
                                            <?php echo $regions['Device_Name'];?>
                                        </p>
                                        <p>HTSC No : 2284</p>
                                        <p>Capacity :
                                            <?php echo $regions['capacity'];?>
                                        </p>
                                        <p>Feeder Name :
                                            <?php echo $regions['Connect_Feeder'];?>
                                        </p>
                                        <p>Status :
                                            <?php echo !empty($live_status['Status'])?$live_status['Status']: '';?>
                                        </p>
                                        <p>Date :
                                            <?php echo !empty($live_status['Date'])?$live_status['Date']: '';?>
                                        </p><!-- 2018-11-19 -->
                                        <p>Time :
                                            <?php echo !empty($live_status['Time'])?$live_status['Time']:'';?>
                                        </p><!-- 11:57:52-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">Live Status</div>
                            <div class="card-body" style="<?php echo empty($live_status)? 'height: 367px;' : '';?>">
                                <?php if(empty($live_status)) {?>
                                <h4 class="text-center">No records found</h4>
                                <?php }?>
                                <?php if(!empty($live_status)) {?>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <h6>Generation</h6>
                                        <div id="gen_guage1" style="max-width: 150px; height: 140px;"></div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <h6>Wind Speed</h6>
                                        <div id="gen_guage2" style="max-width: 150px; height: 140px;"></div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <h6>Pitch</h6>
                                        <div id="gen_guage3" style="max-width: 150px; height: 140px;"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 text-center">
                                        <h6>GRPM</h6>
                                        <div id="gen_guage4" style="max-width: 150px; height: 140px;"></div>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <h6>ROTOR</h6>
                                        <div id="gen_guage5" style="max-width: 150px; height: 140px;"></div>
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-md-3">
                        <div class="card" style="height: 415px;">
                            <div class="card-header">Turbine Current Generation</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="progress-group mb-4">
                                            <div class="progress-group-prepend">
                                                <span class="progress-group-text">PLF</span>
                                            </div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 0.12%" aria-valuenow="0.12" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="progress-group mb-4">
                                            <div class="progress-group-prepend">
                                                <span class="progress-group-text">MA</span>
                                            </div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="progress-group mb-4">
                                            <div class="progress-group-prepend">
                                                <span class="progress-group-text">GA</span>
                                            </div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <div class="progress-group mb-4">
                                            <div class="progress-group-prepend">
                                                <span class="progress-group-text">Energy Generated Today</span>
                                            </div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-md-4">
                        <div class="card" style="height: 358px;">
                            <div class="card-header">Event Log</div>
                            <div class="card-body">
                                <table class="table table-responsive-sm table-hover table-outline mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(empty($event_log)) { ?>
                                        <tr>
                                            <td colspan="2" class="text-center">No records found</td>
                                        </tr>
                                        <?php }?>
                                        <?php foreach ($event_log as $key => $value) {?>
                                        <tr>
                                            <td>
                                                <?php echo $value['Date_S'];?>
                                            </td>
                                            <td>
                                                <?php echo $value['Time_S']. ' '. $value['Description'];?>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Temperature</div>
                            <div class="card-body" style="<?php echo empty($live_status)? 'height: 310px;' : '';?>">
                                <?php if(empty($live_status)) { ?>
                                <h4 class="text-center">No records found</h4>
                                <?php }?>
                                <?php if(!empty($live_status)) { ?>
                                <div class="row">
                                    <div class="col-md-6 p-b-90">
                                        <div class="progress-group mb-4">
                                            <div class="progress-group-prepend">
                                                <span class="progress-group-text">Hydraulic</span>
                                            </div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-xs temp-thermo-bar-height">
                                                    <div class="progress-bar bg-primary" role="progressbar" title="<?php echo $live_status['Hydraulic_Temp'];?>" style="width: <?php echo $live_status['Hydraulic_Temp'];?>%" aria-valuenow="<?php echo $live_status['Hydraulic_Temp'];?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <!-- <i class="fa fa-thermometer-half" aria-hidden="true"></i> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 p-b-90">
                                        <div class="progress-group mb-4">
                                            <div class="progress-group-prepend">
                                                <span class="progress-group-text">Gear Bearing</span>
                                            </div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-xs temp-thermo-bar-height">
                                                    <div class="progress-bar bg-primary" role="progressbar" title="<?php echo $live_status['Bearing_Temp'];?>" style="width: <?php echo $live_status['Bearing_Temp'];?>%" aria-valuenow="<?php echo $live_status['Bearing_Temp'];?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 p-b-90">
                                        <div class="progress-group mb-4">
                                            <div class="progress-group-prepend">
                                                <span class="progress-group-text">Gear Box Oil</span>
                                            </div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-xs temp-thermo-bar-height">
                                                    <div class="progress-bar bg-primary" role="progressbar" title="<?php echo $live_status['Gear_Temp'];?>" style="width: <?php echo $live_status['Gear_Temp'];?>%" aria-valuenow="<?php echo $live_status['Gear_Temp'];?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 p-b-90">
                                        <div class="progress-group mb-4">
                                            <div class="progress-group-prepend">
                                                <span class="progress-group-text">Generator</span>
                                            </div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-xs temp-thermo-bar-height">
                                                    <div class="progress-bar bg-primary" role="progressbar" title="<?php echo $live_status['Gen1_Temp'];?>" style="width: <?php echo $live_status['Gen1_Temp'];?>%" aria-valuenow="<?php echo $live_status['Gen1_Temp'];?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">Daily Generation Chart with Avg Wind Speed Comparison</div>
                            <div class="card-body">
                                <!-- <div class="chart-wrapper">
                                    <canvas id="canvas-2" style="height: 300px;"></canvas>
                                </div> -->
                                <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                                <div id="avg_wind_speed" style="height:350px;">
                                    <h4 class="text-center"> No Records found</h4>
                                </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header">Power Curve</div>
                            <div class="card-body">
                                <div id="power-curve" style="height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                </div>
                <!-- /.row-->
            </div>
        </div>
</main>
<!-- /page content -->
<?php  $this->load->view('layout/footer'); ?>
<script type="text/javascript">
<?php if(!empty($live_status)) {?>
var chartData = {

    chart: {
        type: 'gauge'
    },

    title: {
        text: ''
    },

    pane: {
        startAngle: -90,
        endAngle: 90,
        background: null
    },

    // the value axis
    yAxis: {
        min: 0,
        max: 1,

        minorTickInterval: 'auto',
        minorTickWidth: 1,
        minorTickLength: 10,
        minorTickPosition: 'inside',
        minorTickColor: '#666',

        tickPixelInterval: 30,
        tickWidth: 2,
        tickPosition: 'inside',
        tickLength: 10,
        tickColor: '#666',
        labels: {
            step: 2,
            rotation: 'auto'
        },

        plotBands: [{
            from: 0,
            to: 120,
            color: '#55BF3B' // green
        }]
    },
    series: [{
        name: 'Speed',
        data: [0.75],
        tooltip: {
            valueSuffix: ''
        }
    }]
};

chartData.series[0].data = [0.30];

$('#gen_guage1').highcharts(chartData);

//Windspeed
var windspeed = <?php echo $live_status['Windspeed'];?>;
var chartData1 = {

    chart: {
        type: 'gauge'
    },

    title: {
        text: ''
    },

    pane: {
        startAngle: -90,
        endAngle: 90,
        background: null
    },

    // the value axis
    yAxis: {
        min: 5,
        max: 20,

        minorTickInterval: 'auto',
        minorTickWidth: 1,
        minorTickLength: 10,
        minorTickPosition: 'inside',
        minorTickColor: '#666',

        tickPixelInterval: 30,
        tickWidth: 2,
        tickPosition: 'inside',
        tickLength: 10,
        tickColor: '#666',
        labels: {
            step: 2,
            rotation: 'auto'
        },

        plotBands: [{
            from: 0,
            to: 120,
            color: '#55BF3B' // green
        }]
    },
    series: [{
        name: 'Windspeed',
        data: [windspeed],
        tooltip: {
            valueSuffix: ''
        }
    }]
};

$('#gen_guage2').highcharts(chartData1);

//Pitch
var Pitch = <?php echo $live_status['Pitch'];?>;
var chartData2 = {

    chart: {
        type: 'gauge'
    },

    title: {
        text: ''
    },

    pane: {
        startAngle: -90,
        endAngle: 90,
        background: null
    },

    // the value axis
    yAxis: {
        min: 5,
        max: 20,

        minorTickInterval: 'auto',
        minorTickWidth: 1,
        minorTickLength: 10,
        minorTickPosition: 'inside',
        minorTickColor: '#666',

        tickPixelInterval: 30,
        tickWidth: 2,
        tickPosition: 'inside',
        tickLength: 10,
        tickColor: '#666',
        labels: {
            step: 2,
            rotation: 'auto'
        },

        plotBands: [{
            from: 0,
            to: 120,
            color: '#55BF3B' // green
        }]
    },
    series: [{
        name: 'Pitch',
        data: [Pitch],
        tooltip: {
            valueSuffix: ''
        }
    }]
};

$('#gen_guage3').highcharts(chartData2);

//GRPM
var GRPM = <?php echo $live_status['GRPM'];?>;
var chartData3 = {

    chart: {
        type: 'gauge'
    },

    title: {
        text: ''
    },

    pane: {
        startAngle: -90,
        endAngle: 90,
        background: null
    },

    // the value axis
    yAxis: {
        min: 1000,
        max: 5000,

        minorTickInterval: 'auto',
        minorTickWidth: 1,
        minorTickLength: 10,
        minorTickPosition: 'inside',
        minorTickColor: '#666',

        tickPixelInterval: 30,
        tickWidth: 2,
        tickPosition: 'inside',
        tickLength: 10,
        tickColor: '#666',
        labels: {
            step: 2,
            rotation: 'auto'
        },

        plotBands: [{
            from: 1000,
            to: 5000,
            color: '#55BF3B' // green
        }]
    },
    series: [{
        name: 'GRPM',
        data: [GRPM],
        tooltip: {
            valueSuffix: ''
        }
    }]
};
$('#gen_guage4').highcharts(chartData3);

//Rotor
var Rotor = <?php echo $live_status['RRPM'];?>;
var chartData4 = {

    chart: {
        type: 'gauge'
    },

    title: {
        text: ''
    },

    pane: {
        startAngle: -90,
        endAngle: 90,
        background: null
    },

    // the value axis
    yAxis: {
        min: 5,
        max: 50,

        minorTickInterval: 'auto',
        minorTickWidth: 1,
        minorTickLength: 10,
        minorTickPosition: 'inside',
        minorTickColor: '#666',

        tickPixelInterval: 30,
        tickWidth: 2,
        tickPosition: 'inside',
        tickLength: 10,
        tickColor: '#666',
        labels: {
            step: 2,
            rotation: 'auto'
        },

        plotBands: [{
            from: 0,
            to: 120,
            color: '#55BF3B' // green
        }]
    },
    series: [{
        name: 'Rotor',
        data: [Rotor],
        tooltip: {
            valueSuffix: ''
        }
    }]
};
$('#gen_guage5').highcharts(chartData4);
<?php }?>
<?php if(!empty($power_curve)) {?>
var power_curve = <?php echo json_encode($power_curve[0]);?>;
console.log(power_curve);
const dataSource = {
    "chart": {
        "caption": "",
        "yaxisname": "Power(kw)",
        "xaxisname": "WindSpeed(m/s)",
        "yAxisMaxValue": "500",
        "yAxisMinValue": "3.1",
        "yAxisValuesStep": "4.07",
        "subcaption": "",
        "showhovereffect": "1",
        "numbersuffix": "",
        "drawcrossline": "1",
        "plottooltext": "<b>$dataValue</b> of youth were on $seriesName",
        "theme": "fusion"
    },
    "categories": [{
        "category": [{ "label": "4" }, { "label": "4.1" }, { "label": "4.2" }, { "label": "4.3" }, { "label": "4.4" }, { "label": "4.5" }, { "label": "4.6" }, { "label": "4.7" }, { "label": "4.8" }, { "label": "4.9" }, { "label": "5" }, { "label": "5.1" }, { "label": "5.2" }, { "label": "5.3" }, { "label": "5.4" }, { "label": "5.5" }, { "label": "5.6" }, { "label": "5.7" }, { "label": "5.8" }, { "label": "5.9" }, { "label": "6" }, { "label": "6.1" }, { "label": "6.2" }, { "label": "6.3" }, { "label": "6.4" }, { "label": "6.5" }, { "label": "6.6" }, { "label": "6.7" }, { "label": "6.8" }, { "label": "6.9" }, { "label": "7" }, { "label": "7.1" }, { "label": "7.2" }, { "label": "7.3" }, { "label": "7.4" }, { "label": "7.5" }, { "label": "7.6" }, { "label": "7.7" }, { "label": "7.8" }, { "label": "7.9" }, { "label": "8" }, { "label": "8.1" }, { "label": "8.2" }, { "label": "8.3" }, { "label": "8.4" }, { "label": "8.5" }, { "label": "8.6" }, { "label": "8.7" }, { "label": "8.8" }, { "label": "8.9" }, { "label": "9" }, { "label": "9.1" }, { "label": "9.2" }, { "label": "9.3" }, { "label": "9.4" }, { "label": "9.5" }, { "label": "9.6" }, { "label": "9.7" }, { "label": "9.8" }, { "label": "9.9" }, { "label": "10" }, { "label": "10.1" }, { "label": "10.2" }, { "label": "10.3" }, { "label": "10.4" }, { "label": "10.5" }, { "label": "10.6" }, { "label": "10.7" }, { "label": "10.8" }, { "label": "10.9" }, { "label": "11" }, { "label": "11.1" }, { "label": "11.2" }, { "label": "11.3" }, { "label": "11.4" }, { "label": "11.5" }, { "label": "11.6" }, { "label": "11.7" }, { "label": "11.8" }, { "label": "11.9" }, { "label": "12" }, { "label": "12.1" }, { "label": "12.2" }, { "label": "12.3" }, { "label": "12.4" }, { "label": "12.5" }, { "label": "12.6" }, { "label": "12.7" }, { "label": "12.8" }, { "label": "12.9" }, { "label": "13" }, { "label": "13.1" }, { "label": "13.2" }, { "label": "13.3" }, { "label": "13.4" }, { "label": "13.5" }, { "label": "13.6" }, { "label": "13.7" }, { "label": "13.8" }, { "label": "13.9" }, { "label": "14" }, { "label": "14.1" }, { "label": "14.2" }, { "label": "14.3" }, { "label": "14.4" }, { "label": "14.5" }, { "label": "14.6" }, { "label": "14.7" }, { "label": "14.8" }, { "label": "14.9" }, { "label": "15" }, { "label": "15.1" }, { "label": "15.2" }, { "label": "15.3" }, { "label": "15.4" }, { "label": "15.5" }, { "label": "15.6" }, { "label": "15.7" }, { "label": "15.8" }, { "label": "15.9" }, { "label": "16" }, { "label": "16.1" }, { "label": "16.2" }, { "label": "16.3" }, { "label": "16.4" }, { "label": "16.5" }, { "label": "16.6" }, { "label": "16.7" }, { "label": "16.8" }, { "label": "16.9" }, { "label": "17" }, { "label": "17.1" }, { "label": "17.2" }, { "label": "17.3" }, { "label": "17.4" }, { "label": "17.5" }, { "label": "17.6" }, { "label": "17.7" }, { "label": "17.8" }, { "label": "17.9" }, { "label": "18" }, { "label": "18.1" }, { "label": "18.2" }, { "label": "18.3" }, { "label": "18.4" }, { "label": "18.5" }, { "label": "18.6" }, { "label": "18.7" }, { "label": "18.8" }, { "label": "18.9" }, { "label": "19" }, { "label": "19.1" }, { "label": "19.2" }, { "label": "19.3" }, { "label": "19.4" }, { "label": "19.5" }, { "label": "19.6" }, { "label": "19.7" }, { "label": "19.8" }, { "label": "19.9" }, { "label": "20" }, { "label": "20.1" }, { "label": "20.2" }, { "label": "20.3" }, { "label": "20.4" }, { "label": "20.5" }, { "label": "20.6" }, { "label": "20.7" }, { "label": "20.8" }, { "label": "20.9" }, { "label": "21" }, { "label": "21.1" }, { "label": "21.2" }, { "label": "21.3" }, { "label": "21.4" }, { "label": "21.5" }, { "label": "21.6" }, { "label": "21.7" }, { "label": "21.8" }, { "label": "21.9" }, { "label": "22" }, { "label": "22.1" }, { "label": "22.2" }, { "label": "22.3" }, { "label": "22.4" }, { "label": "22.5" }, { "label": "22.6" }, { "label": "22.7" }, { "label": "22.8" }, { "label": "22.9" }, { "label": "23" }, { "label": "23.1" }, { "label": "23.2" }, { "label": "23.3" }, { "label": "23.4" }, { "label": "23.5" }, { "label": "23.6" }, { "label": "23.7" }, { "label": "23.8" }, { "label": "23.9" }, { "label": "24" }, { "label": "24.1" }, { "label": "24.2" }, { "label": "24.3" }, { "label": "24.4" }, { "label": "24.5" }, { "label": "24.6" }, { "label": "24.7" }, { "label": "24.8" }, { "label": "24.9" }, { "label": "25" }]
    }],
    "dataset": [
        power_curve
    ]
};

FusionCharts.ready(function() {
    var myChart = new FusionCharts({
        type: "msline",
        renderAt: "power-curve",
        width: "100%",
        height: "100%",
        dataFormat: "json",
        dataSource
    }).render();
});
<?php } else {?>
FusionCharts.ready(function() {
    var myChart = new FusionCharts({
        dataEmptyMessage: 'No Data to display',
        type: "msline",
        renderAt: "power-curve",
        width: "100%",
        height: "100%",
        dataFormat: "json"
    }).render();
});
<?php }?>


<?php if(!empty($avg_speed)) {?>

if ($('#avg_wind_speed').length) {
    var avgSpeedJson = <?php echo json_encode($avg_speed );?>;
    var theme = {
        color: [
            '#26B99A', '#34495E', '#BDC3C7', '#3498DB',
            '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
        ]
    };

    console.log(avgSpeedJson);
    var avgspeedLabel = [];
    var avgspeedValue = [];
    $.each(avgSpeedJson, function(key, value) {
        // alert( index + ": " + value );
        avgspeedLabel.push(key);
        avgspeedValue.push(parseInt(value));
    });
    var echartBar = echarts.init(document.getElementById('avg_wind_speed'), theme);

    echartBar.setOption({
        title: {
            text: 'Compare Sales Strategy'
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
            data: avgspeedLabel
        }],
        yAxis: [{
            type: 'value',
            //  data: ['100', '200', '500', '1000', '1500', '2000', '2500', '3000', '4000', '5000', '6000', '7000']
        }],
        series: [{
            // name: 'purchases',
            type: 'bar',
            data: avgspeedValue,
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
<?php }?>
</script>