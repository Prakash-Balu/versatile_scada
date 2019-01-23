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
        <li class="breadcrumb-item active">Device 1</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-4">
                    <div class="card" style="height: 415px;">
                        <div class="card-header">Device Name</div>
                        <div class="card-body">
                            <div class="float-left">
                                <img src="<?php echo base_url();?>assets/images/device/blue.png" class="img-fluid" style=" position: absolute;width: 35%;height: 60%;">
                            </div>
                                <div class="float-right">
                                    <p>Device Name : A1</p>
                                    <p>HTSC No : 2284</p>
                                    <p>Capacity : 600</p>
                                    <p>Feeder Name : Micon 7</p>
                                    <p>Status : Grid in Gen Brk Trip</p>
                                    <p>Date : 2018-11-19</p>
                                    <p>Time : 11:57:52</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">Live Status</div>
                            <div class="card-body">
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
                        <div class="card">
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
                                        <tr>
                                            <td>
                                                19-Nov-18
                                            </td>
                                            <td class="text-center">
                                                13:08:49 Nac.vent.2
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                19-Nov-18
                                            </td>
                                            <td class="text-center">
                                                13:08:49 Nac.vent.2
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                19-Nov-18
                                            </td>
                                            <td class="text-center">
                                                13:08:49 Nac.vent.2
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                19-Nov-18
                                            </td>
                                            <td class="text-center">
                                                13:08:49 Nac.vent.2
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                19-Nov-18
                                            </td>
                                            <td class="text-center">
                                                13:08:49 Nac.vent.2
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Temperature</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 p-b-90">
                                        <div class="progress-group mb-4">
                                            <div class="progress-group-prepend">
                                                <span class="progress-group-text">Hydraulic</span>
                                            </div>
                                            <div class="progress-group-bars">
                                                <div class="progress progress-xs temp-thermo-bar-height">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>

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
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
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
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
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
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
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
                        <div class="card">
                            <div class="card-header">Daily Generation Chart with Avg Wind Speed Comparison</div>
                            <div class="card-body">
                                <div class="chart-wrapper">
                                    <canvas id="canvas-2" style="height: 300px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-md-8">
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
    var chartData ={

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


chartData.series[0].data = [0.70];

$('#gen_guage2').highcharts(chartData);
  
  chartData.series[0].data = [0.90];

$('#gen_guage3').highcharts(chartData);

chartData.series[0].data = [0.85];

$('#gen_guage4').highcharts(chartData);

chartData.series[0].data = [0.95];

$('#gen_guage5').highcharts(chartData);


const dataSource = {
  "chart": {
    "caption": "",
    "yaxisname": "Power(kw)",
    "xaxisname": "WindSpeed(m/s)",
    "yAxisMaxValue": "750",
    "yAxisMinValue": "-250",
    "subcaption": "",
    "showhovereffect": "1",
    "numbersuffix": "",
    "drawcrossline": "1",
    "plottooltext": "<b>$dataValue</b> of youth were on $seriesName",
    "theme": "fusion"
  },
  "categories": [
    {
      "category": [
        {
          "label": "-5"
        },
        {
          "label": "0"
        },
        {
          "label": "5"
        },
        {
          "label": "10"
        },
        {
          "label": "15"
        },
        {
          "label": "20"
        },
        {
          "label": "25"
        },
        {
          "label": "30"
        }
      ]
    }
  ],
  "dataset": [
    {
      "seriesname": "WindSpeed",
      "data": [
        {
          "value": "62"
        },
        {
          "value": "64"
        },
        {
          "value": "64"
        },
        {
          "value": "66"
        }
      ]
    },
    {
      "seriesname": "Capacity",
      "data": [
        {
          "value": ""
        },
        {
          "value": ""
        },
        {
          "value": "64"
        },
        {
          "value": "160"
        },
        {
          "value": ""
        },
        {
          "value": "500"
        },
        {
          "value": "500"
        },
        {
          "value": "500"
        }
      ]
    },
    {
      "seriesname": "Device3",
      "data": [
        {
          "value": ""
        },
        {
          "value": ""
        },
        {
          "value": "75"
        },
        {
          "value": "170"
        },
        {
          "value": ""
        },
        {
          "value": "150"
        },
        {
          "value": "412"
        },
        {
          "value": "320"
        }
      ]
    }
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

</script>