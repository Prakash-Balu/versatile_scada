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
                    <div class="card">
                        <div class="card-header">Device Name</div>
                        <div class="card-body">
                            <div class="float-left">
                              <img src="<?php echo base_url();?>assets/images/wind.jpg" class="img-fluid" style=" position: absolute;width: 35%;height: 75%;">
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
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Live Status</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6>Generation</h6>
                                    <div id="gen_guage1" style="max-width: 150px; height: 140px;"></div>
                                </div>
                                <div class="col-md-4">
                                    <h6>Wind Speed</h6>
                                    <div id="gen_guage2" style="max-width: 150px; height: 140px;"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <h6>Pitch</h6>
                                    <div id="gen_guage3" style="max-width: 150px; height: 140px;"></div>
                                </div>
                                <div class="col-md-4">
                                    <h6>GRPM</h6>
                                    <div id="gen_guage4" style="max-width: 150px; height: 140px;"></div>
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
                        <div class="card-header">Turbine Current Generation</div>
                        <div class="card-body">
                            
                        </div>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Temperature</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="progress-group mb-4">
                                        <div class="progress-group-prepend">
                                            <span class="progress-group-text">Hydraulic</span>
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="progress-group mb-4">
                                        <div class="progress-group-prepend">
                                            <span class="progress-group-text">Gear Bearing</span>
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="progress-group mb-4">
                                        <div class="progress-group-prepend">
                                            <span class="progress-group-text">Gear Box Oil</span>
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="progress-group mb-4">
                                        <div class="progress-group-prepend">
                                            <span class="progress-group-text">Generator</span>
                                        </div>
                                        <div class="progress-group-bars">
                                            <div class="progress progress-xs">
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