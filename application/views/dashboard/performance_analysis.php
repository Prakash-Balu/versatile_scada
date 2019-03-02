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
</style>
<main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">
            <a href="#">Admin</a>
        </li>
        <li class="breadcrumb-item active">Performance Analysis</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Generation Performance Analysis</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group mb-4">
                                                <input class="form-control start_date" type="text" placeholder="Month" id="start_date">
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
                                            foreach ($perAna['deviceList'] as $key => $value) {
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
                                    <div class="card">
                                        <div class="card-header airforce-blue" id="perAna">Performance Chart</div>
                                        <div class="card-body">
                                            <div id="export_gad" style="height:350px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <input type="button" class="btn btn-default" onclick="getPerformanceAnalysis();" value="Submit" />
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
    format: 'M-yyyy',
    viewMode: "months",
    orientation: "bottom",
    autoclose: true
});

$('.end_date').datepicker({
    orientation: "bottom",
    autoclose: true
});

var count = 0;

function getDeviceList() {

    // $('.check').each(function(i) {
    //     if ($(this).hasClass('active')) {
    //         count++;
    //         if (count > 2) {
    //             this.checked = false;
    //             //    if( $(this).hasClass('active') ) {
    //             $(this).removeClass('active');
    //             // }
    //             alert('Please check two device only');
    //             count = count - 1;
    //             return false;
    //         }
    //     }
    // });
}

function getPerformanceAnalysis() {
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
    
    $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>ajax/ajax_perform_analysis",
            dataType: 'json',
            data: { 'device_name': device_name, 'date': date_val },
            success: function(data) {

                if (data.valid.length !=0) {
                    var pat_gen = [];
                    var color = [];
                    device_name.forEach(function(val, i){
                        if( data.valid[val] !== undefined ){
                            pat_gen.push(data.valid[val].value[0]);
                        } else{
                            pat_gen.push(0);
                        }
                    });

                    var theme = {
                        color: [
                            '#26B99A', '#34495E', '#BDC3C7', '#3498DB',
                            '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
                        ]
                    };
                    $body.removeClass("loading");

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
                                data: device_name
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
                } else if(data.valid.length ==0) {
                    $body.removeClass("loading");
                    document.getElementById('export_gad').innerHTML ='<p class="text-center">No Records Found</p>';
                } else if( data.invalid ) {
                    $body.removeClass("loading");
                    alert('Invalid Data');
                }
            }
    });

}
</script>