<link rel="stylesheet" href="<?=base_url()?>assets/css/qrscan/styles.css" />
<script src="<?=base_url()?>assets/js/qr_packed.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/src/grid.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/src/version.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/src/detector.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/src/formatinf.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/src/errorlevel.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/src/bitmat.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/src/datablock.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/src/bmparser.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/src/datamask.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/src/rsdecoder.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/src/gf256poly.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/src/gf256.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/src/decoder.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/src/qrcode.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/src/findpat.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/src/alignpat.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/src/databr.js"></script>
<div class="col-sm-12">
    <div class="white-box">
        <h3 class="box-title m-b-0"><?=$title?>
        </h3>
        <div id="containers">
	      <h1>QR Code Scanner</h1>

	      <a id="btn-scan-qr">
	        <img src="https://dab1nmslvvntp.cloudfront.net/wp-content/uploads/2017/07/1499401426qr_icon.svg">
	      <a/>

	      <canvas hidden="" id="qr-canvas"></canvas>

	      <div id="qr-result" hidden="">
	        <b>Data:</b> <span id="outputData"></span>
	      </div>
	    </div>
    </div>
</div>
<script type="text/javascript" src="<?=base_url()?>assets/js/qrCodeScanner.js"></script>

<!-- <!DOCTYPE html>
<html>
  <head>
    <title>QR Code Scanner</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
    <link rel="stylesheet" href="<?=base_url()?>assets/css/qrscan/styles.css" />
    <script type="text/javascript" src="<?=base_url()?>assets/js/src/version.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/src/detector.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/src/formatinf.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/src/errorlevel.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/src/bitmat.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/src/datablock.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/src/bmparser.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/src/datamask.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/src/rsdecoder.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/src/gf256poly.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/src/gf256.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/src/decoder.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/src/qrcode.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/src/findpat.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/src/alignpat.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/src/databr.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/src/qr_packed.js"></script>
  </head>

  <body>
    <div id="container">
      <h1>QR Code Scanner</h1>

      <a id="btn-scan-qr">
        <img src="https://dab1nmslvvntp.cloudfront.net/wp-content/uploads/2017/07/1499401426qr_icon.svg">
      <a/>

      <canvas hidden="" id="qr-canvas"></canvas>

      <div id="qr-result" hidden="">
        <b>Data:</b> <span id="outputData"></span>
      </div>
    </div>

    <script src="<?=base_url()?>assets/js/qrCodeScanner.js"></script>
  </body>
</html> -->
