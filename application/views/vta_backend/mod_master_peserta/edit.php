<div class="col-sm-12">
    <div class="white-box">
        <h3 class="box-title m-b-0"><?=$title?></h3>
        <p class="text-muted m-b-30 font-13"> Pastikan semua kolom terisi. </p>
        <?php $attributes = array('class'=>'form-horizontal','role'=>'form','autocomplete'=>'off'); echo form_open_multipart('siteman/ubah_peserta',$attributes); ?>
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <div class="form-group row">
                <label for="example-text-input" class="col-2 col-form-label">Nama peserta</label>
                <div class="col-10">
                    <input class="form-control" type="hidden" name="id" value="<?=$row['id_peserta']?>">
                    <input class="form-control" type="text" name="nama_peserta" value="<?=$row['nama_peserta']?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="example-text-input" class="col-2 col-form-label">Kontak</label>
                <div class="col-10">
                    <input class="form-control" type="number" name="nohp_peserta" value="<?=$row['nohp_peserta']?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="example-text-input" class="col-2 col-form-label">Jumlah peserta</label>
                <div class="col-10">
                    <input class="form-control" type="number" name="jml_peserta" max="4" value="<?=$row['jml_peserta']?>">
                    <small class="text-muted">Max peserta adalah 4 Orang</small>
                </div>
            </div>

            <div class="form-group row">
                <label for="example-text-input" class="col-2 col-form-label">Status Jemaat</label>
                <div class="col-10">
                    <select class="form-control" name="sts_jemaat">
                        <option value="<?=$row['sts_jemaat']?>"> <?=$row['sts_jemaat']?> </option>
                        <option value="jemaat"> jemaat </option>
                        <option value="simpatisan"> simpatisan </option>
                    </select>
                </div>
            </div>
            
            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" name="submit">Kirim</button>
            <a href="<?=base_url().'siteman/peserta'?>" class="btn btn-inverse waves-effect waves-light">Batal</a>
        <?php echo form_close(); ?>
    </div>
</div>