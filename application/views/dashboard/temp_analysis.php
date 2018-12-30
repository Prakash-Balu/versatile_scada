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

<!-- page content -->
<div class="right_col" role="main">
<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2>Location Temperature Analysis</h2>
               <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <br />
            
            <form class="form-horizontal form-label-left input_mask">
              <div class="col-xs-12">
                <div class='col-xs-12'>
                  <div class="text-center">
                    <input type="button" onclick="getTempAnalysis('Gear_Temp');" value="Gear"/>
                    <input type="button" onclick="getTempAnalysis('Bearing_Temp');" value="Bearing"/>
                    <input type="button" onclick="getTempAnalysis('Genl_Temp');" value="Generator"/>
                    <input type="button" onclick="getTempAnalysis('Hydraulic_Temp');" value="Hydraulic"/>
                    <input type="button" onclick="getTempAnalysis('Control_Temp');" value="Control"/>
                  </div>
                </div>
                <div class='col-sm-6'>
                        Start Date
                        <div class="form-group">
                            <div class='input-group date' id='myDatepicker'>
                                <input type='text' class="form-control" id="start_date"/>
                                <span class="input-group-addon">
                                   <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                  <!-- <div class='col-sm-6'>
                        End Date
                        <div class="form-group">
                            <div class='input-group date' id='myDatepicker2'>
                                <input type='text' class="form-control" id="end_date"/>
                                <span class="input-group-addon">
                                   <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>-->
                   <div class='col-xs-12'>
                     <div class="x_panel">
                      <div class="x_content2">

                        <div style="width:100%; height:275px;">
                          <div class="row">
                            <div class="form-group">
                              <div class="searchable-container">
                          <?php 
                          foreach ($tempAna['deviceList'] as $key => $value) {
                          ?>
                            <!-- <input type="button" onclick="getTempAnalysis('<?php echo $value['IMEI'];?>','<?php echo $value['Format_Type'];?>');" value="<?php echo $value['Device_Name'];?>"/> -->
                            <div class="items col-xs-5 col-sm-5 col-md-3 col-lg-3">
                              <div class="info-block block-info clearfix">
                                  <div class="square-box pull-left">
                                      <span class="glyphicon glyphicon-tags glyphicon-lg"></span>
                                  </div>
                                  <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                      <label class="btn btn-default">
                                          <div class="bizcontent">
                                              <input type="checkbox" name="device_name[]" autocomplete="off" value="<?php echo $value['Device_Name'];?>">
                                              <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                              <h5><?php echo $value['Device_Name'];?></h5>
                                          </div>
                                      </label>
                                  </div>
                              </div>
                              </div>
                          <?php
                            }
                          ?>
                            </div>
                          </div>
                        </div>
                        </div>
                      </div>
                </div>
                   </div>
              </div>
              <!-- graph area -->
              <div class="col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Graph area</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content2">
                    <div id="graph_area" style="width:100%; height:300px;"></div>
                  </div>
                </div>
              </div>
              <!-- /graph area -->
            </form>
         </div>
      </div>
   </div>
</div>
<!-- /page content -->
<?php  $this->load->view('layout/footer'); ?>

<script type="text/javascript">
  $('#myDatepicker').datetimepicker({
        format: 'DD-MM-YYYY'
    });
  $('#myDatepicker2').datetimepicker({
        format: 'DD-MM-YYYY'
    });

function getTempAnalysis(TempName) {
  console.log(TempName)
  var date_val = $('#start_date').val();

   var device_name = [];
    $.each($("input[name='device_name[]']:checked"), function(){            
      device_name.push($(this).val());
    });
    console.log(device_name);

  if( device_name == '' ){
    alert ('Please select device name');
    return false;
  }

  if( date_val == '' ){
    alert ('Please select date');
    return false;
  }

  

  $.ajax({
    type:'POST',
    url:"<?php echo base_url(); ?>dashboard/get_temp_analysis",
    dataType: 'json',
    data:{'device_name':device_name,'date':date_val},
    success:function(data){
        console.log(data);
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