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
                        <div class="card-header">Location Temperature Analysis</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group mb-4">
                                        <input class="form-control start_date" type="text" placeholder="Start Date" id="start_date">
                                    </div>
                                    <div class="form-group">
                                      <label>Device List</label>
                                      <select multiple class="form-control" name="device_name" placeholder="Choose anything" data-allow-clear="1">
                                        <?php 
                                            foreach ($tempAna['deviceList'] as $key => $value) {
                                            ?>
                                            <option value="<?php echo $value['Device_Name'];?>">
                                                <?php echo $value['Device_Name'];?>
                                            </option>
                                            <?php }?>
                                      </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h2><span id="temp">Temperature</span></h2>
                                    <!-- <div id="graph_area_temp" style="width:100%; height:300px;"></div> -->
                                <div id="power-curve" style="height: 400px;"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <input type="button" class="btn btn-default" onclick="getTempAnalysis('Gear_Temp','Gear');" value="Gear" />
                                        <input type="button" class="btn btn-default" onclick="getTempAnalysis('Bearing_Temp','Bearing');" value="Bearing" />
                                        <input type="button" class="btn btn-default" onclick="getTempAnalysis('Gen1_Temp','Gen1');" value="Generator" />
                                        <input type="button" class="btn btn-default" onclick="getTempAnalysis('Hydraulic_Temp','Hydraulic');" value="Hydraulic" />
                                        <input type="button" class="btn btn-default" onclick="getTempAnalysis('Control_Temp','Control');" value="Control" />
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

function getTempAnalysis(TempName, title) {
    console.log(TempName)
    var date_val = $('#start_date').val();

    if (date_val == '') {
        alert('Please select date');
        return false;
    }

    var device_name = [];
    // $.each($("select[name='device_name:selected']"), function() {
    //     device_name.push($(this).val());
    // });

    $.each($("select[name='device_name']").select2('data'), function(key, value) {
        device_name.push(value.id);
    });
    console.log(device_name);

    if (device_name == '') {
        alert('Please select device name');
        return false;
    }

    $("#graph_area_temp").empty();
    $("#temp").html(title);
    $.ajax({
        type: 'POST',
        url: "<?php echo base_url(); ?>ajax/ajax_temp_analysis",
        dataType: 'json',
        data: { 'device_name': device_name, 'date': date_val, 'temp_name': TempName },
        success: function(data) {

            if (data.valid) {
                console.log(data);
                if ($('#graph_area_temp').length) {
                    // Morris.Area({
                    //     element: 'graph_area_temp',
                    //     data: data.valid,
                    //     xkey: 'hours',
                    //     ykeys: ['green', 'red', 'blue', 'gray'],
                    //     lineColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
                    //     labels: ['Green', 'Red', 'Blue', 'Gray'],
                    //     pointSize: 2,
                    //     hideHover: 'auto',
                    //     parseTime: false,
                    //     resize: true
                    // });

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
        },
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
        },
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
  "dataset": data.valid
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
                }
            } else if(data.session=='expired'){
                alert('session expired');
                windows.reload();
            } else {
                alert(data.invalid);
            }
        }
    });

}

$(function() {
    $('#search').on('keyup', function() {
        var pattern = $(this).val();
        $('.searchable-container .items').hide();
        $('.searchable-container .items').filter(function() {
            return $(this).text().match(new RegExp(pattern, 'i'));
        }).show();
    });


});
</script>