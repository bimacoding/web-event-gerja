<div class="col-sm-12">
    <?php if($this->session->flashdata('success')){ ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php }else if($this->session->flashdata('error')){  ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php } ?>
    <div class="white-box">
        <h3 class="box-title m-b-0"><?=$title?>
            <a href="<?=base_url().'siteman/tambah_kebaktian'?>" class="badge badge-primary float-right">Tambah</a>
        </h3>
        
        <div class="table-responsive">
            <table id="myTable" class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 25px">No</th>
                        <th>Nama Kebaktian</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Keterangan</th>
                        <th>status</th>
                        <th style="width: 100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        foreach ($record as $row) {
                    ?>
                        <tr>
                            <td><center><?=$no?></center></td>
                            <td><?=$row['nama_kebaktian']?></td>
                            <td><?=$row['tgl_kebaktian']?></td>
                            <td><?=$row['jam_kebaktian']?></td>
                            <td><?=substr($row['keterangan'],0,150)?>...</td>
                            <td>
                                <?php if ($row['flag']==1) { ?>
                                    <span class="badge badge-success">Aktif</span>
                                <?php }else{ ?>
                                    <span class="badge badge-danger">Selesai</span>
                                <?php } ?>
                            </td>
                            <td>
                                <center>
                                    <?php if ($row['flag']==1) { ?>
                                        <a href="<?=base_url().'siteman/nonaktif_kebaktian/'.$row['id_kebaktian'];?>" title="nonaktif kebaktian" class="badge badge-warning">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    <?php }else{ ?>
                                        <a href="<?=base_url().'siteman/aktif_kebaktian/'.$row['id_kebaktian'];?>" title="aktif kebaktian" class="badge badge-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    <?php } ?>
                                    <a href="<?=base_url().'siteman/ubah_kebaktian/'.$row['id_kebaktian'];?>" class="badge badge-success">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="<?=base_url().'siteman/hapus_kebaktian/'.$row['id_kebaktian'];?>" class="badge badge-danger" onclick='return confirm("Apa anda yakin untuk hapus Data ini?")'>
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </center>
                            </td>
                        </tr>
                    <?php
                        $no++;    # code...
                        }
                     ?>
                </tbody>
            </table>
        </div>
    </div>
</div>