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
            <a href="<?=base_url().'siteman/tambah_peserta'?>" class="badge badge-primary float-right">Tambah</a>
        </h3>
        
        <div class="table-responsive">
            <table id="myTable" class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 25px">No</th>
                        <th>Kode Peserta</th>
                        <th>Nama Peserta</th>
                        <th>No.Hp Peserta</th>
                        <th>Jumlah Peserta</th>
                        <th>QR-code</th>
                        <th style="width: 50px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        foreach ($record as $row) {
                    ?>
                        <tr>
                            <td><center><?=$no?></center></td>
                            <td><?=$row['kode_peserta']?></td>
                            <td><?=$row['nama_peserta']?></td>
                            <td><?=$row['nohp_peserta']?></td>
                            <td><?=$row['jml_peserta'].' Peserta'?></td>
                            <td><button type="button" class="badge badge-success" data-toggle="modal" data-target="#exampleModalLong<?=$no?>">lihat</button></td>
                            <td>
                                <center>
                                    <a href="<?=base_url().'siteman/ubah_peserta/'.$row['id_peserta'];?>" class="badge badge-success">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="<?=base_url().'siteman/hapus_peserta/'.$row['id_peserta'];?>" class="badge badge-danger" onclick='return confirm("Apa anda yakin untuk hapus Data ini?")'>
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </center>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalLong<?=$no?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                          <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle"><?=$row['nama_peserta']?>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                </h5>
                              </div>
                              <div class="modal-body">
                                <img src="<?=base_url().'assets/uploads/qrusers/'.$row['qr_peserta']?>" alt="<?=$row['nama_peserta']?>" class="img-thumbnail rounded mx-auto d-block" width="170">
                                <p style="text-align: center;">Scan barcode data peserta milik <?=$row['nama_peserta']?></p>
                              </div>
                            </div>
                          </div>
                        </div>
                    <?php
                        $no++;    # code...
                        }
                     ?>
                </tbody>
            </table>
        </div>
    </div>
</div>