<div class="container">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="white-box">
            <div class="row row-in">
                <div class="col-lg-3 col-sm-6 row-in-br">
                    <div class="col-in row">
                        <div class="col-md-6 col-sm-6 col-xs-6"> <i data-icon="m" class="linea-icon linea-basic"></i>
                            <h5 class="text-muted vb">JEMAAT</h5> </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <?php $query = $this->model_app->view_where('t_peserta',array('sts_jemaat'=>'jemaat')); ?>
                            <h3 class="counter text-right m-t-15 text-danger"><?=$query->num_rows();?></h3> </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="progress">
                                <?php $persen = round($query->num_rows()/1000 * 100,2); ?>
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?=$persen?>%"> <span class="sr-only"><?=$persen?>% Jemaat</span> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 row-in-br  b-r-none">
                    <div class="col-in row">
                        <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe01b;"></i>
                            <h5 class="text-muted vb">SIMPATISAN</h5> </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <?php $query = $this->model_app->view_where('t_peserta',array('sts_jemaat'=>'simpatisan')); ?>
                            <h3 class="counter text-right m-t-15 text-megna"><?=$query->num_rows();?></h3> </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="progress">
                                <?php $persen = round($query->num_rows()/1000 * 100,2); ?>
                                <div class="progress-bar progress-bar-megna" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?=$persen?>%"> <span class="sr-only"><?=$persen?>% simpatisan</span> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 row-in-br">
                    <div class="col-in row">
                        <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe00b;"></i>
                            <h5 class="text-muted vb">PENGURUS</h5> </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <?php $query = $this->model_app->view_where('t_users',array('level'=>'admin','blokir'=>'N')); ?>
                            <h3 class="counter text-right m-t-15 text-primary"><?=$query->num_rows();?></h3> </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="progress">
                                <?php $persen = round($query->num_rows()/100 * 100,2); ?>
                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?=$persen?>%"> <span class="sr-only"><?=$persen?>% Pengurus</span> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6  b-0">
                    <div class="col-in row">
                        <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe016;"></i>
                            <h5 class="text-muted vb">ACARA SELESAI</h5> </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <?php $query = $this->model_app->view_where('t_acara',array('flag'=>0)); ?>
                            <h3 class="counter text-right m-t-15 text-success"><?=$query->num_rows();?></h3> </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="progress">
                                <?php $persen = round($query->num_rows()/1000 * 100,2); ?>
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?=$persen?>%"> <span class="sr-only"><?=$persen?>% Acara</span> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



<div class="container">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Last Activity</h3>
            <div class="table-responsive">
                <table id="myTabless" class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 25px">No</th>
                            <th>Users</th>
                            <th>Kegiatan</th>
                            <th>Data</th>
                            <th>IP</th>
                            <th>Browser</th>
                        </tr>
                    </thead>
                </table>
                <script type="text/javascript">
                  $(function() {
                    $('#myTabless').DataTable( {
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                          "url":"<?=base_url().'ajax/gethistory'?>",
                          "type": "POST",
                          "data": {csrf_test_name: $.cookie('csrf_cookie_name')},
                          "dataType": 'json'
                        }
                    } );
                  }); // End Document Ready Function
                </script>
            </div>
        </div>
    </div>
</div>





    