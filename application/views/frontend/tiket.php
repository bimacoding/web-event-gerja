<div class="clearfix"></div>
<div class="container">

	<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
	<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
		<?php 
			$cek = $record->num_rows(); 
			if ($cek >= 1) {
			$row = $record->row_array();
		?>
				<div class="panel panel-default" style="margin-top: 20px">
					<div class="panel-heading">
						<h3 class="panel-title">
							<?=substr($row['nohp_peserta'],0,4).'XXXXXXXX'?>
							<a href="<?=base_url().'peserta/cetaktiket/'.$row['kode_acara']?>" class="badge badge-warning pull-right">
								<i class="fa fa-print"></i>
								print
							</a>
						</h3>
					</div>
					<div class="panel-body">
						<div class="col-xs-6 form-group">
				            <label>Nama</label>
				            <h4><?=$row['nama_peserta']?></h4>
				        </div>
				        <div class="col-xs-6 form-group">
				            <label>Gereja</label>
				            <h4><?=title()?></h4>
				        </div>
				        <div class="col-xs-6 form-group">
				            <label>Kebaktian</label>
				            <h4><?=$row['nama_acara']?></h4>
				        </div>
				        <div class="col-xs-6 form-group">
				            <label>Tanggal</label>
				            <h4>
				            	<?php 
				            	$now = date('Y-m-d');
				            	if ( $now > $row['tgl_acara'] ) {
				            		$this->model_utama->update('t_acara',array('flag'=>0),array('id_acara'=>$row['id_acara']));
				            		echo "<h4 style='color:red;'>EXPIRED</h4>";
				            	}else{
				            		echo $this->mylibrary->tgl_indo($row['tgl_acara']);
				            	} ?>
				            		
				            </h4>
				        </div>
				        <div class="col-xs-12 form-group">
				            <center>
				            	<label>
				            		Tempat duduk
				            	</label>
				            	<div class="clearfix"></div>
				            	<br>
					            <?php  
					            	$noddk = explode(',', $row['jml_peserta']);
					            	foreach ($noddk as $n) {
					            		echo "<span class='btn btn-info btn-sm'>".str_replace("'","",noduduk($n))."</span>&nbsp;";
					            	}
					            ?>
				            </center>
				        </div>
				        <div class="col-xs-12 form-group">
				            <center>
				            	<img src="<?=base_url().'assets/uploads/qracara/'.$row['qr_acara']?>" class="img-responsive" width="150">
				            </center>
				        </div>
					</div>
				</div>
		<?php	
			}else{
		?>
				<div class="panel panel-default" style="margin-top: 20px">
					<div class="panel-heading">
						<h3 class="panel-title">
							Opps..!!
						</h3>
					</div>
					<div class="panel-body">
						Data yang anda cari tidak ada.!
					</div>
				</div>
		<?php } ?>
	</div>
	<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
	
</div>