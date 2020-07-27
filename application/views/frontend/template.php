<!DOCTYPE html>
<html>
<head>
<title></title> 
<!-- For-Mobile-Apps-and-Meta-Tags -->
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?=keywords()?>" />
<meta name="description" content="<?=description()?>">
<meta name="author" content="<?=title()?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?=favicon()?>">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //For-Mobile-Apps-and-Meta-Tags -->
<!-- Custom Theme files -->
<link href="<?=base_url()?>template/css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="<?php echo base_url(); ?>template/font-awesome/css/font-awesome.min.css">
<link href="<?=base_url()?>template/css/style.css" type="text/css" rel="stylesheet" media="all"> 
<link rel="stylesheet" href="<?=base_url()?>template/css/ken-burns.css" type="text/css" media="all" /> 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<!-- //Custom Theme files -->
<!-- js -->
<script src="<?=base_url()?>template/js/jquery-2.2.3.min.js"></script> 
<!-- //js -->
<!-- pop-up-box -->
<script src="<?=base_url()?>template/js/jquery.magnific-popup.js" type="text/javascript"></script>
<script>
  $(document).ready(function() {
    $('.popup-top-anim').magnificPopup({
      type: 'inline',
      fixedContentPos: false,
      fixedBgPos: true,
      overflowY: 'auto',
      closeBtnInside: true,
      preloader: false,
      midClick: true,
      removalDelay: 300,
      mainClass: 'my-mfp-zoom-in'
    });                                             
  }); 
</script>
<script type="text/javascript">
  $(function() {
   $("#id_kebaktian").change(function(){
          var idKebaktian = $('#id_kebaktian').val();
          $.ajax({
              url: '<?=base_url().'ajax/getkebaktian'?>',
              type: 'POST',
              dataType: 'json',
              data: {
                  'id_kebaktian': idKebaktian 
              },
              success: function (alats) {

                  $("#nama_acara").val(alats.nama_acara);
                  $("#tgl_acara").val(alats.tgl_acara);
                  $("#jam_acara").val(alats.jam_acara);
              }
          });
    });
  });
</script>
<!--//pop-up-box -->
<!-- web-fonts -->  
<link href='//fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- //web-fonts -->

</head>
<body class="bg">
  <div class="agile-main"> 
    <div class="menu-wrap" id="style-1"> 
      <?php include 'navbar.php'; ?>
    </div> 
    <div class="content-wrap">
      <div class="header"> 
        <?php include 'header.php'; ?>
      </div>
      <div class="content">
        <!-- banner -->
          
        <!-- //banner -->
        <!-- welcome -->
        <?php echo $contents; ?>
        <!-- //welcome -->
        <!-- footer -->
        <div class="w3agile footer"> 
          <?php include 'footer.php'; ?>
        </div> 
      </div>
    </div>
  </div> 
  <!-- menu-js -->
  <script src="<?=base_url()?>template/js/classie.js"></script>
  <script src="<?=base_url()?>template/js/main.js"></script>
  <!-- //menu-js -->
  <!-- nice scroll-js -->
  <script src="<?=base_url()?>template/js/jquery.nicescroll.min.js"></script> 
  <script>
    $(document).ready(function() {
    
      var nice = $("html").niceScroll();  // The document page (body)
    
      $("#div1").html($("#div1").html()+' '+nice.version);
    
      $("#boxscroll").niceScroll({cursorborder:"",cursorcolor:"#00F",boxzoom:true}); // First scrollable DIV
    });
  </script>
  <!-- //nice scroll-js -->
  <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?=base_url()?>template/js/bootstrap.js"></script>
</body>
</html>
<div class="modal fade" id="modal-id-cek">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php $attributes = array('class'=>'form-horizontal','role'=>'form','autocomplete'=>'off'); echo form_open_multipart('peserta/cek_register',$attributes); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?=strtoupper(title().' cek register anda.')?></h4>
      </div>
      <div class="modal-body">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Masukan No. HP/Telfon anda</label>
              <input type="text" class="form-control" id="nohp_peserta" placeholder="e.g. 08126868686868" required name="nohp_peserta">
            </div>
            <div class="form-group">
              <label for="">Pilih Acara</label>
              <select class="form-control" name="kebaktian" id="id_kebaktiancek">
                <option value="0" >-- Pilih --</option>
                <?php 
                  $keb = $this->db->query("SELECT * FROM t_kebaktian WHERE flag = 1 ORDER BY id_kebaktian ASC"); 
                  foreach ($keb->result_array() as $keys) {
                ?>
                    <option value="<?=$keys['id_kebaktian']?>" > <?=$keys['nama_kebaktian']?> </option>
                <?php } ?>
              </select>
              <input type="hidden" name="nama_acara" id="nama_acaracek">
              <input type="hidden" name="tgl_acara" id="tgl_acaracek">
              <input type="hidden" name="jam_acara" id="jam_acaracek">
            </div>
            <script type="text/javascript">
              $(function() {
                $("#id_kebaktiancek").change(function(){
                  var idKebaktian = $('#id_kebaktiancek').val();
                  $.ajax({
                      url: '<?=base_url().'ajax/getkebaktian'?>',
                      type: 'POST',
                      dataType: 'json',
                      data: {
                          'id_kebaktian': idKebaktian 
                      },
                      success: function (alats) {

                          $("#nama_acaracek").val(alats.nama_acara);
                          $("#tgl_acaracek").val(alats.tgl_acara);
                          $("#jam_acaracek").val(alats.jam_acara);
                      }
                  });
                });
              });
            </script>
          </div>
          <button type="submit" class="btn btn-primary" name="submit">cek</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-id-register">
    <div class="modal-dialog">
      <div class="modal-content">
        <?php $attributes = array('class'=>'form-horizontal','role'=>'form','autocomplete'=>'off'); echo form_open_multipart('peserta/register',$attributes); ?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><?=strtoupper(title().' form register ')?></h4>
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
              <select class="form-control" name="kebaktian" id="id_kebaktian">
                <option value="0" >-- Pilih --</option>
                <?php 
                  $keb = $this->db->query("SELECT * FROM t_kebaktian WHERE flag = 1 ORDER BY id_kebaktian ASC"); 
                  foreach ($keb->result_array() as $keys) {
                ?>
                    <option value="<?=$keys['id_kebaktian']?>" > <?=$keys['nama_kebaktian']?> </option>
                <?php } ?>
              </select>
              <input type="hidden" name="nama_acara" id="nama_acara">
              <input type="hidden" name="tgl_acara" id="tgl_acara">
              <input type="hidden" name="jam_acara" id="jam_acara">
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

            <button type="submit" class="btn btn-primary" name="submit">Daftar</button>
          
        </div>

        <?php echo form_close(); ?>
      </div>
    </div>
</div>