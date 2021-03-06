<div class="col-sm-12">
    <div class="white-box">
        <h3 class="box-title m-b-0"><?=$title?></h3>
        <p class="text-muted m-b-30 font-13"> Pastikan semua kolom terisi. </p>
        <?php $attributes = array('class'=>'form-horizontal','role'=>'form','autocomplete'=>'off'); echo form_open_multipart('siteman/ubah_kebaktian',$attributes); ?>
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

            <div class="form-group row">
                <label for="example-text-input" class="col-2 col-form-label">Nama Acara</label>
                <div class="col-10">
                    <input class="form-control" type="hidden" name="id" value="<?=$row['id_kebaktian']?>">
                    <input class="form-control" type="text" name="nama_kebaktian" value="<?=$row['nama_kebaktian']?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-10 form-row">

                  <div class="col-md-4">
                    <select class="required form-control" name="tanggal">
                        <?php for ($i=1; $i <= 31 ; $i++) { 
                          $qq =substr($row['tgl_kebaktian'], 8,2);
                          if ($qq == $i) {
                            $pilih = 'selected';
                            echo "<option value=\"$i\" $pilih>$i</option>";
                          }else{
                            echo "<option value=\"$i\">$i</option>";
                          }
                        } ?>
                      </select>
                  </div>

                  <div class="col-md-4">
                    <select class="required form-control" name="bulan">
                        <?php for ($i=1; $i <= 12 ; $i++) { 
                          $bulan = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                          $qq =substr($row['tgl_kebaktian'], 5,2);
                          if ($qq == $i) {
                            $pilih = 'selected';
                            echo "<option value=\"$i\" $pilih>$bulan[$i]</option>";
                          }else{
                            echo "<option value=\"$i\">$bulan[$i]</option>";
                          }
                        } ?>
                      </select>
                  </div>

                  <div class="col-md-4">
                    <select class="required form-control" name="tahun">
                        <?php for ($i=1965; $i <= date('Y') ; $i++) {
                          $qq =substr($row['tgl_kebaktian'], 0,4);
                          if ($qq == $i) {
                            $pilih = 'selected';
                            echo "<option value=\"$i\" $pilih>$i</option>";
                          }else{
                            echo "<option value=\"$i\">$i</option>";
                          }
                        } ?>
                      </select>
                  </div>

                </div>
            </div>

            <div class="form-group row">
                <label for="example-text-input" class="col-2 col-form-label">Jam Mulai</label>
                <div class="col-10">
                    <input class="form-control" type="time" name="jam_kebaktian" value="<?=$row['jam_kebaktian']?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="example-text-input" class="col-2 col-form-label">Keterangan</label>
                <div class="col-10">
                    <input class="form-control" type="text" name="keterangan" value="<?=$row['keterangan']?>">
                </div>
            </div>

            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" name="submit">Kirim</button>
            <a href="<?=base_url().'siteman/kebaktian'?>" class="btn btn-inverse waves-effect waves-light">Batal</a>
        <?php echo form_close(); ?>
    </div>
</div>