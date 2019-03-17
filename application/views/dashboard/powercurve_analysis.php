<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// echo "<pre>"; print_r($tempAna); exit;
?>
<style>
    .searchable-container{margin:20px 0 0 0}
.searchable-container label.btn-default.active{background-color:#007ba7;color:#FFF}
.searchable-container label.btn-default{width:90%;border:1px solid #efefef;margin:5px; box-shadow:5px 8px 8px 0 #ccc;}
.searchable-container label .bizcontent{width:100%;}
.searchable-container .btn-group{width:90%}
.searchable-container .btn span.glyphicon{
    opacity: 0;
}
.searchable-container .btn.active span.glyphicon {
    opacity: 1;
}

.searchable-container .bizcontent input[type="checkbox"] {
    position: absolute;
    clip: rect(0,0,0,0);
    pointer-events: none;
}
.airforce-blue {
  color: #fff;
  background-color: #517fa4;
}
.raphael-group-22-creditgroup {
    display: none;
}
</style>
<main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">
            <a href="#">Admin</a>
        </li>
        <li class="breadcrumb-item active">Power Curve</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Location Power Curve</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group mb-4">
                                                <input class="form-control start_date" type="text" placeholder="Date" id="start_date">
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <input class="form-control end_date" type="text" placeholder="End Date" id="end_date">
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="form-group">
                                        <h4>Device List</h4>
                                        <div class="row">
                                            <?php 
                                            foreach ($powCurve['deviceList'] as $key => $value) {
                                            ?>
                                            <div class="searchable-container items col-md-6">
                                                <div class="info-block block-info clearfix">
                                                    <div class="square-box pull-left">
                                                        <span class="glyphicon glyphicon-tags glyphicon-lg"></span>
                                                    </div>
                                                    <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                        <label class="check btn btn-default">
                                                            <div class="bizcontent">
                                                                <input type="checkbox" id="input_<?php echo $key;?>" name="device_name[]" autocomplete="off" value="<?php echo $value['Device_Name'];?>" onchange="getDeviceList()">
                                                                <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                                <div>
                                                                    <?php echo $value['Device_Name'];?>
                                                                </div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header airforce-blue" id="temp0"></div>
                                                <div class="card-body">
                                                    <div id="power-curve0" style="height: 400px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header airforce-blue" id="temp1"></div>
                                                <div class="card-body">
                                                    <div id="power-curve1" style="height: 400px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="card">
                                        <div class="card-header" id="temp"></div>
                                        <div class="card-body">
                                            <div id="power-curve" style="height: 400px;"></div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <input type="button" class="btn btn-default" onclick="getPowerCurve();" value="Submit" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- /.row-->
        </div>
    </div>
</main>
<?php  $this->load->view('layout/footer'); ?>
<script type="text/javascript">
$('.start_date').datepicker({
    orientation: "bottom",
    autoclose: true
});

$('.end_date').datepicker({
    orientation: "bottom",
    autoclose: true
});

var count = 0;

function getDeviceList() {

    $('.check').each(function(i) {
        if ($(this).hasClass('active')) {
            count++;
            if (count > 2) {
                this.checked = false;
                //    if( $(this).hasClass('active') ) {
                $(this).removeClass('active');
                // }
                alert('Please check two device only');
                count = count - 1;
                return false;
            }


        }
    });
}



function getPowerCurve() {
    var date_val = $('#start_date').val();

    // var deviceBtn = $('.searchable-container label');
    console.log($(event.target).hasClass('active'));
    if (date_val == '') {
        alert('Please select date');
        // event.removeClass('active');
        return false;
    }

    var device_name = [];
    $(':checkbox:checked').each(function(i) {
        device_name[i] = $(this).val();
    });
    console.log(device_name);

    if (device_name == '') {
        alert('Please select device name');
        return false;
    }

    $body = $("body");
    $body.addClass("loading");
    $("#graph_area_temp").empty();
    // $("#temp").html('WTG Loc No: ' + deviceName);
    $.ajax({
        type: 'POST',
        url: "<?php echo base_url(); ?>ajax/ajax_power_curve",
        dataType: 'json',
        data: { 'device_name': device_name, 'date': date_val },
        success: function(data) {
            var powercurve = [];
            var value = '';
            if (data) {
                $body.removeClass("loading");
                console.log(data);
                device_name.forEach(function(val, i) {
                    $("#temp" + i).html('WTG Loc No: ' + val);

                    if (data['powercurve'][val]) {
                        powercurve = data['powercurve'][val].join();
                        //     const dataSource = {
                        //     "chart": {
                        //         "caption": "",
                        //         "yaxisname": "Power",
                        //         "xaxisname": date_val,
                        //         "yAxisMaxValue": "100",
                        //         "yAxisMinValue": "0",
                        //         "subcaption": "",
                        //         "showhovereffect": "1",
                        //         "numbersuffix": "",
                        //         "drawcrossline": "1",
                        //         // "plottooltext": "<b>$dataValue</b> on $seriesName",
                        //         "theme": "fusion"
                        //     },
                        //     "categories": [{
                        //         "category": [{
                        //                 "label": "0"
                        //             },
                        //             {
                        //                 "label": "5"
                        //             },
                        //             {
                        //                 "label": "10"
                        //             },
                        //             {
                        //                 "label": "15"
                        //             },
                        //             {
                        //                 "label": "20"
                        //             },
                        //             {
                        //                 "label": "25"
                        //             },
                        //             {
                        //                 "label": "30"
                        //             }
                        //         ]
                        //     }],
                        //     "dataset": data[val]
                        // };

                        // FusionCharts.ready(function() {
                        //     var myChart = new FusionCharts({
                        //         type: "msline",
                        //         renderAt: "power-curve" + i,
                        //         width: "100%",
                        //         height: "100%",
                        //         dataFormat: "json",
                        //         dataSource
                        //     }).render();
                        // });


                        Highcharts.chart("power-curve" + i, {
                            chart: {
                                type: 'scatter',
                                zoomType: 'xy'
                            },
                            title: {
                                text: ''
                            },
                            subtitle: {
                                text: ''
                            },
                            xAxis: {
                                title: {
                                    enabled: true,
                                    text: 'WindSpeed (m/s)'
                                },
                                startOnTick: true,
                                endOnTick: true,
                                showLastLabel: true
                            },
                            yAxis: {
                                title: {
                                    text: 'Power (kw)'
                                }
                            },
                            legend: {
                                layout: 'vertical',
                                align: 'left',
                                verticalAlign: 'top',
                                x: 100,
                                y: 70,
                                floating: true,
                                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF',
                                borderWidth: 1
                            },

                            plotOptions: {
                                scatter: {
                                    marker: {
                                        radius: 5,
                                        states: {
                                            hover: {
                                                enabled: true,
                                                lineColor: 'rgb(100,100,100)'
                                            }
                                        }
                                    },
                                    states: {
                                        hover: {
                                            marker: {
                                                enabled: false
                                            }
                                        }
                                    },
                                    tooltip: {
                                        headerFormat: '<b>{series.name}</b><br>',
                                        pointFormat: '{point.x} (m/s), {point.y} (kw)'
                                    }
                                }
                            },
                            series: [{
                                name: 'WindSpeed',
                                //color: 'rgba(223, 83, 83, .5)',
                                color: 'green',

                                // data: []
                                data: [powercurve]
                            }, {
                                name: 'Capacity',
                                //color: 'rgba(119, 152, 191, .5)',
                                color: '#FAF619',

                                data: [[2.50, 3.00],[3.00, 4.00],[4.20, 11.24],[4.30, 15.31],[4.40, 19.38],[4.50, 23.45],[4.60, 27.52],[4.70, 31.59],[4.80, 35.66],[4.90, 39.73],[5.00, 43.80],[5.10, 49.03],[5.20, 54.26],[5.30, 59.49],[5.40, 64.72],[5.50, 69.95],[5.60, 75.18],[5.70, 80.41],[5.80, 85.64],[5.90, 90.87],[6.00, 96.10],[6.10, 102.79],[6.20, 109.48],[6.30, 116.17],[6.40, 122.86],[6.50, 129.55],[6.60, 136.24],[6.70, 142.93],[6.80, 149.62],[6.90, 156.31],[7.00, 163.00],[7.10, 170.90],[7.20, 178.80],[7.30, 186.70],[7.40, 194.60],[7.50, 202.50],[7.60, 210.40],[7.70, 218.30],[7.80, 226.20],[7.90, 234.10],[8.00, 242.00],[8.10, 250.30],[8.20, 258.60],[8.30, 266.90],[8.40, 275.20],[8.50, 283.50],[8.60, 291.80],[8.70, 300.10],[8.80, 308.40],[8.90, 316.70],[9.00, 325.00],[9.10, 332.50],[9.20, 340.00],[9.30, 347.50],[9.40, 355.00],[9.50, 362.50],[9.60, 370.00],[9.70, 377.50],[9.80, 385.00],[9.90, 392.50],[10.00, 400.00],[10.10, 405.20],[10.20, 410.40],[10.30, 415.60],[10.40, 420.80],[10.50, 426.00],[10.60, 431.20],[10.70, 436.40],[10.80, 441.60],[10.90, 446.80],[11.00, 452.00],[11.10, 454.90],[11.20, 457.80],[11.30, 460.70],[11.40, 463.60],[11.50, 466.50],[11.60, 469.40],[11.70, 472.30],[11.80, 475.20],[11.90, 478.10],[12.00, 481.00],[12.10, 482.30],[12.20, 483.60],[12.30, 484.90],[12.40, 486.20],[12.50, 487.50],[12.60, 488.80],[12.70, 490.10],[12.80, 491.40],[12.90, 492.70],[13.00, 494.00],[13.10, 494.40],[13.20, 494.80],[13.30, 495.20],[13.40, 495.60],[13.50, 496.00],[13.60, 496.40],[13.70, 496.80],[13.80, 497.20],[13.90, 497.60],[14.00, 498.00],[14.10, 498.20],[14.20, 498.40],[14.30, 498.60],[14.40, 498.80],[14.50, 499.00],[14.60, 499.20],[14.70, 499.40],[14.80, 499.60],[14.90, 499.80],[15.00, 500.00],[15.10, 500.00],[15.20, 500.00],[15.30, 500.00],[15.40, 500.00],[15.50, 500.00],[15.60, 500.00],[15.70, 500.00],[15.80, 500.00],[15.90, 500.00],[16.00, 500.00],[16.10, 500.00],[16.20, 500.00],[16.30, 500.00],[16.40, 500.00],[16.50, 500.00],[16.60, 500.00],[16.70, 500.00],[16.80, 500.00],[16.90, 500.00],[17.00, 500.00],[17.10, 500.00],[17.20, 500.00],[17.30, 500.00],[17.40, 500.00],[17.50, 500.00],[17.60, 500.00],[17.70, 500.00],[17.80, 500.00],[17.90, 500.00],[18.00, 500.00],[18.10, 500.00],[18.20, 500.00],[18.30, 500.00],[18.40, 500.00],[18.50, 500.00],[18.60, 500.00],[18.70, 500.00],[18.80, 500.00],[18.90, 500.00],[19.00, 500.00],[19.10, 500.00],[19.20, 500.00],[19.30, 500.00],[19.40, 500.00],[19.50, 500.00],[19.60, 500.00],[19.70, 500.00],[19.80, 500.00],[19.90, 500.00],[20.00, 500.00],[20.10, 500.00],[20.20, 500.00],[20.30, 500.00],[20.40, 500.00],[20.50, 500.00],[20.60, 500.00],[20.70, 500.00],[20.80, 500.00],[20.90, 500.00],[21.00, 500.00],[21.10, 500.00],[21.20, 500.00],[21.30, 500.00],[21.40, 500.00],[21.50, 500.00],[21.60, 500.00],[21.70, 500.00],[21.80, 500.00],[21.90, 500.00],[22.00, 500.00],[22.10, 500.00],[22.20, 500.00],[22.30, 500.00],[22.40, 500.00],[22.50, 500.00],[22.60, 500.00],[22.70, 500.00],[22.80, 500.00],[22.90, 500.00],[23.00, 500.00],[23.10, 500.00],[23.20, 500.00],[23.30, 500.00],[23.40, 500.00],[23.50, 500.00],[23.60, 500.00],[23.70, 500.00],[23.80, 500.00],[23.90, 500.00],[24.00, 500.00],[24.10, 500.00],[24.20, 500.00],[24.30, 500.00],[24.40, 500.00],[24.50, 500.00],[24.60, 500.00],[24.70, 500.00],[24.80, 500.00],[24.90, 500.00],[25.00, 500.00]]
                            }]
                        });
                    }
                });

                // }
            } else if (data.session == 'expired') {
                alert('session expired');
                windows.reload();
            } else {
                alert(data.invalid);
            }
        }
    });

}
</script>