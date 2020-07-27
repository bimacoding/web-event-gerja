<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style type="text/css">
			html { margin: 7px}
			table {
			  border-collapse: collapse;
			  width: 100%;
			}

			th, td {
			  text-align: left;
			  padding: 8px;
			}

			tr:nth-child(even) {background-color: #f2f2f2;}
		</style>
	</head>
	<body>
		<?php 
			$logo = $this->db->query("SELECT logo FROM t_identitas WHERE id_identitas = 1 ORDER BY id_identitas LIMIT 1")->row_array();
		?>
		<center style="margin-top: 5px">
		    <img src="assets/images/<?=$logo['logo']?>" width="60">
		</center>
		<h3 class="text-center" style="margin-top:2px;"><?=strtoupper(title())?></h3>
		<?php $row = $record->row_array() ?>
		<table>
			<tr>
				<th>Nama</th>
				<th>Gereja</th>
			</tr>
			<tr>
				<td><?=$row['nama_peserta']?></td>
				<td><?=title()?></td>
			</tr>
			<tr>
				<th>Kebaktian</th>
				<th>Tanggal</th>
			</tr>
			<tr>
				<td><?=$row['nama_acara']?></td>
				<td>
					<?php 
	            	$now = date('Y-m-d');
	            	if ( $now > $row['tgl_acara'] ) {
	            		$this->model_utama->update('t_acara',array('flag'=>0),array('id_acara'=>$row['id_acara']));
	            		echo "<h4 style='color:red;'>EXPIRED</h4>";
	            	}else{
	            		echo $this->mylibrary->tgl_indo($row['tgl_acara']);
	            	} ?>
				</td>
			</tr>
			<tr>
				<th colspan="2"><center>Tempat Duduk</center></th>
			</tr>
		</table>
		<div class="clearfix"></div>
		<br>
		<div class="col-md-12" style="margin-left: 62px;">
			<?php  
            	$noddk = explode(',', $row['jml_peserta']);
            	foreach ($noddk as $n) {
            		echo "<span class='btn btn-info btn-sm'>".str_replace("'","",noduduk($n))."</span>&nbsp;";
            	}
            ?>

		</div>
		<div class="clearfix"></div>
		<br>
		<center>
		    <img src="assets/uploads/qracara/<?=$row['qr_acara']?>" style="width: 50%;height: 50%">
		</center>


		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 		<script src="Hello World"></script>
	</body>
</html>