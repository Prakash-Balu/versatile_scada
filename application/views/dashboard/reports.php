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
                        <div class="card-header">Reports</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h4>Device List</h4>
                                        <div class="row">
                                            <?php 
                                            foreach ($reports['deviceList'] as $key => $value) {
                                            ?>
                                            <div class="searchable-container items col-md-6">
                                                <div class="info-block block-info clearfix">
                                                    <div class="square-box pull-left">
                                                        <span class="glyphicon glyphicon-tags glyphicon-lg"></span>
                                                    </div>
                                                    <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                        <label class="btn btn-default" onclick="getPowerCurve('<?php echo $value['Device_Name'];?>', event);">
                                                            <div class="bizcontent">
                                                                <input type="checkbox" name="device_name[]" autocomplete="off" value="<?php echo $value['Device_Name'];?>">
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
                                        <div class="card-header" id="temp">Location Name: MTK Textile 6</div>
                                        <div class="card-body">
                                            <table class="table table-responsive-sm table-hover table-outline mb-0">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th class="text-center">Reports</th>
                                                        <th class="text-center">Start Date</th>
                                                        <th class="text-center">End Date</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">
                                                            <select  class="form-control" name="device_name">
                                        
                                            <option value="Select">
                                                select
                                            </option>
                                            <option value="Gen_temp">
                                                Generation & Temperature
                                            </option>
                                            
                                      </select>
                                                        </td>
                                                        <td class="text-center">
                                                            
                                                <input class="form-control start_date" type="text" placeholder="Start Date" id="start_date">
                                                        </td>
                                                        <td class="text-center">
                                                            <input class="form-control end_date" type="text" placeholder="End Date" id="end_date">
                                                        </td>
                                                        <td class="text-center">
                                                            <button class="btn btn-primary">Go</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
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
</script>