<?php include 'banner.php'; ?>
<div class="welcome"> 
  <h3 class="w3ls-title"><?=title()?></h3> 
  <p class="w3title-text">Kegiatan kebakian</p>
  	<?php 
  		date_default_timezone_set('Asia/Jakarta');
  		$no = 1;
  		$nowdate = date('Y-m-d'); 
  		$jduduk = $duduk->row_array(); 
  		foreach ($record as $key) { 
  		$hari = $this->mylibrary->hari_ini(substr(date("Y-m-D", strtotime($key['tgl_kebaktian'])),8));
  		$tanggal = substr($key['tgl_kebaktian'],8,2);
		$bulan = $this->mylibrary->getBulan(substr($key['tgl_kebaktian'],5,2));
		if ($nowdate > $key['tgl_kebaktian']) {
			$this->model_utama->update('t_kebaktian',array('flag'=>0),array('flag'=>1,'id_kebaktian'=>$key['id_kebaktian']));
		}

  	?>
	  <div class="panel panel-default">
	  	<div class="panel-body">
	  		<div class="col-2 col-xs-2 col-sm-2 col-md-2 col-lg-2" style="text-align: center;padding: 0px;">
	  			<h5><?=$hari?></h5>
	  			<h2><?=$tanggal?></h2>
	  			<h5><?=$bulan?></h5>
	  		</div>
	  		<div class="col-10 col-xs-10 col-sm-10 col-md-10 col-lg-10">
	  			<strong><?= $key['nama_kebaktian'] ?></strong>
	  			<p><?php echo substr($key['keterangan'],0,150); ?>..</p>
	  			<small class="fa fa-clock-o fa-fw">&nbsp;<?=$key['jam_kebaktian']?></small>
	  			<div class="clearfix"></div>
	  			<?php 
	  				$q11 = $this->db->query("SELECT jml_peserta FROM t_acara WHERE tgl_acara = '".$key['tgl_kebaktian']."' AND jam_acara = '".$key['jam_kebaktian']."' AND id_acara = (SELECT max(id_acara) FROM t_acara WHERE tgl_acara = '".$key['tgl_kebaktian']."' AND jam_acara = '".$key['jam_kebaktian']."')");
	  				$cekss = $q11->num_rows();
	  				$q11s = $q11->row();
	  				if ($cekss != 0) {
	  					$pecahs = explode(',', $q11s->jml_peserta);
						$n_maxs = max($pecahs); 
						if ($n_maxs<=$jduduk['jml']) {
							$hasil = $jduduk['jml'] - $n_maxs;
							echo "<small class='fa fa-wheelchair fa-fw'>&nbsp;".$jduduk['jml']."&nbsp;Kursi&nbsp;-&nbsp;Sisa&nbsp;".$hasil."</small>";
						}else{
							$hasil = 'Kursi Penuh';
							echo "<small class='fa fa-wheelchair fa-fw'>&nbsp;$hasil</small>";
						}
	  				}else{
	  					echo "<small class='fa fa-wheelchair fa-fw'>&nbsp;".$jduduk['jml']."&nbsp;Kursi&nbsp;-&nbsp;Sisa&nbsp;".$jduduk['jml']."</small>";
	  				}
					
				?>
	  			
	  			<div class="clearfix"></div>
	  			<?php 
	  			$now = date('Y-m-d');
	  			if ($now > $key['tgl_kebaktian']) {
	  				echo '<a href="#" class="btn btn-xs btn-primary pull-right">Selesai</a>';
	  			}elseif($hasil=='Kursi Penuh'){
	  				echo '<a href="#" class="btn btn-xs btn-primary pull-right">Selesai</a>';
	  			}else{
	  				echo '<a href="#modal-id'.$no.'" class="btn btn-xs btn-primary pull-right" data-toggle="modal">Daftar</a>';
	  			} ?>
	  			
	  		</div>
	  	</div>
	  </div>
	  <div class="modal fade" id="modal-id<?=$no?>">
	  	<div class="modal-dialog">
	  		<div class="modal-content">
	  			<?php $attributes = array('class'=>'form-horizontal','role'=>'form','autocomplete'=>'off'); echo form_open_multipart('peserta/register',$attributes); ?>
	  			<div class="modal-header">
	  				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	  				<h4 class="modal-title"><?=strtoupper(title().' form register ')?><span class="badge badge-info"><?=$key['tgl_kebaktian']?></span></h4>
	  			</div>
	  			<div class="modal-body">
	  				<div class="col-md-12">
	  				
	  					<div class="form-group">
	  						<label for="">Nama Lengkap</label>
	  						<input type="text" class="form-control" id="nama_peserta" placeholder="e.g. Super E" required name="nama_peserta">
	  					</div>

	  					<div class="form-group">
	  						<label for="">No. HP/Telfon</label>
	  						<input type="text" class="form-control" id="nohp_peserta" placeholder="e.g. 08126868686868" required name="nohp_peserta">
	  					</div>

	  					<div class="form-group">
	  						<label for="">Status Jemaat</label>
	  						<select class="form-control required " name="sts_jemaat">
	  							<option value="simpatisan">-- Pilih --</option>
	  							<option value="jemaat"> jemaat </option>
	  							<option value="simpatisan"> simpatisan </option>
	  						</select>
	  					</div> 

	  					<div class="form-group">
	  						<label for="">Pilih Kebaktian</label>
	  						<select class="form-control" name="kebaktian" readonly id="id_kebaktianx<?=$no?>">
	  							<option value="<?=$key['id_kebaktian']?>" selected> <?=$key['nama_kebaktian']?> </option>
	  						</select>
	  						<input type="hidden" name="nama_acara" id="nama_acara<?=$no?>">
	  						<input type="hidden" name="tgl_acara" id="tgl_acara<?=$no?>">
	  						<input type="hidden" name="jam_acara" id="jam_acara<?=$no?>">
	  					</div>

	  					<div class="form-group">
	  						<label for="">Jumlah Peserta</label>
	  						<input type="number" class="form-control" name="jml_peserta" max="4" required >
	  						<small style="color: red">Maks. 4 Peserta</small>
	  					</div>

	  					<div class="form-group">
	  							<input type="checkbox" name="member_setuju"  required <?php if(isset($_COOKIE["member_setuju"])) { ?> checked <?php } ?>>
	  							Saya/Kami dalam kondisi sehat, umur antara 17/59 tahun dan tidak berada di daerah zona merah.
	  					</div>


	  				</div>
	  			</div>
	  			<div class="modal-footer">
	  				<button type="submit" class="btn btn-primary" name="submit">Daftar</button>
	  			</div>

	  			<?php echo form_close(); ?>
	  		</div>
	  	</div>
	  </div>
	  <script type="text/javascript">
			$(function() {
				var urls = '<?=$no?>';
				var idKebaktian = $("#id_kebaktianx"+urls).val();
		        $.ajax({
		            url: '<?=base_url().'ajax/getkebaktian'?>',
		            type: 'POST',
		            dataType: 'json',
		            data: {
		                'id_kebaktian': idKebaktian 
		            },
		            success: function (alats) {

		                $("#nama_acara"+urls).val(alats.nama_acara);
		                $("#tgl_acara"+urls).val(alats.tgl_acara);
		                $("#jam_acara"+urls).val(alats.jam_acara);
		            }
		        });

		        $("#id_kebaktianx"+urls).change(function(){
		          var idKebaktian = $('#id_kebaktianx'+urls).val();
		          $.ajax({
		              url: '<?=base_url().'ajax/getkebaktian'?>',
		              type: 'POST',
		              dataType: 'json',
		              data: {
		                  'id_kebaktian': idKebaktian 
		              },
		              success: function (alats) {

		                  $("#nama_acara"+urls).val(alats.nama_acara);
		                  $("#tgl_acara"+urls).val(alats.tgl_acara);
		                  $("#jam_acara"+urls).val(alats.jam_acara);
		              }
		          });
		    	});
			});
		</script>
	<?php $no++; } ?>

</div> 


