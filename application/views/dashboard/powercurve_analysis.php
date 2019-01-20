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
                                                        <label class="btn btn-default">
                                                            <div class="bizcontent">
                                                                <input type="checkbox" name="device_name[]" autocomplete="off" value="<?php echo $value['Device_Name'];?>" onchange="getDeviceList()">
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
                                        <div class="card-header" id="temp0"></div>
                                        <div class="card-body">
                                            <div id="power-curve0" style="height: 400px;"></div>
                                        </div>
                                    </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card">
                                        <div class="card-header" id="temp1"></div>
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
});

$('.end_date').datepicker({
    orientation: "bottom",
});
 var count =0;
function getDeviceList() {
  
        $(':checkbox:checked').each(function(i){
            if(count >2) {
                this.checked = false;
                if( $(this).parent().parent().hasClass('active') ) {
                    $(this).parent().parent().removeClass('active');
                }
                alert('Please check two device only');
                count = count-1;
                return false;
            }
            
          count++;
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
        $(':checkbox:checked').each(function(i){
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
        data: { 'device_name': device_name, 'date': date_val},
        success: function(data) {

            if (data) {
                $body.removeClass("loading");
                console.log(data);
                device_name.forEach(function(val, i){
                    $("#temp"+i).html('WTG Loc No: ' + val);
                    const dataSource = {
                    "chart": {
                        "caption": "",
                        "yaxisname": "Temperature",
                        "xaxisname": date_val,
                        "yAxisMaxValue": "100",
                        "yAxisMinValue": "0",
                        "subcaption": "",
                        "showhovereffect": "1",
                        "numbersuffix": "",
                        "drawcrossline": "1",
                        // "plottooltext": "<b>$dataValue</b> on $seriesName",
                        "theme": "fusion"
                    },
                    "categories": [{
                        "category": [{
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
                    }],
                    "dataset": data[val]
                };

                FusionCharts.ready(function() {
                    var myChart = new FusionCharts({
                        type: "msline",
                        renderAt: "power-curve" + i,
                        width: "100%",
                        height: "100%",
                        dataFormat: "json",
                        dataSource
                    }).render();
                });
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