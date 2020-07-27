<?php $cek = $record->num_rows(); 
	if ($cek == 0) {
?>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	    <div class="white-box">
	    	<span class="text-center text-danger">
	    		Data yang di cari tidak ditemukan.!
	    	</span>
	    </div>
	</div>
<?php }else{ 
	$row = $record->row_array();
?>
<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
    <div class="white-box">
    	<img src="<?=base_url().'assets/uploads/qracara/'.$row['qr_acara']?>" alt="<?=$row['nama_peserta']?>" class="img-thumbnail rounded mx-auto d-block" width="170">
        <p style="text-align: center;">Scan barcode data peserta milik <?=$row['nama_peserta']?></p>
    </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
    <div class="white-box">
    	<div class="form-group row">
            <label for="example-text-input" class="col-3 col-form-label">Nama</label>
            <div class="col-9">
                : <?=$row['nama_peserta']?>
            </div>
        </div>

        <div class="form-group row">
            <label for="example-text-input" class="col-3 col-form-label">No.HP/Telp</label>
            <div class="col-9">
                : <?=$row['nohp_peserta']?>
            </div>
        </div>

        <div class="form-group row">
            <label for="example-text-input" class="col-3 col-form-label">No Hp</label>
            <div class="col-9">
                : <?php $jmlpesertasx = explode(',', $row['jml_peserta']); echo count($jmlpesertasx).' Orang';?>
            </div>
        </div>

        <div class="form-group row">
            <label for="example-text-input" class="col-3 col-form-label">Kegiatan Kebaktian</label>
            <div class="col-9">
                : <?=$row['nama_acara']?>
            </div>
        </div>

        <div class="form-group row">
            <label for="example-text-input" class="col-3 col-form-label">Tanggal</label>
            <div class="col-9">
                : <?php if (date('Y-m-d') > $row['tgl_acara'] ) { echo "<h3 class='text-danger'>EXPIRED</h3>"; } else { echo $this->mylibrary->tgl_indo($row['tgl_acara']); } ?>
            </div>
        </div>

        <div class="form-group row">
            <label for="example-text-input" class="col-3 col-form-label">Jam</label>
            <div class="col-9">
                : <?=$row['jam_acara']?>
            </div>
        </div>

        <div class="form-group row">
            <label for="example-text-input" class="col-3 col-form-label">Nomor Duduk</label>
            <div class="col-9">
                : <?php  $noddk = explode(',', $row['jml_peserta']); foreach ($noddk as $n) { echo "<span class='btn btn-info btn-sm'>".str_replace("'","",noduduk($n))."</span>&nbsp;"; } ?>
            </div>
        </div>

        <div class="form-group row">
            <label for="example-text-input" class="col-3 col-form-label">Status Jemaat</label>
            <div class="col-9">
                : <?=ucwords($row['sts_jemaat'])?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
