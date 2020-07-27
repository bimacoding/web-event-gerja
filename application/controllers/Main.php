<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$data['title'] = title();
		$data['record'] = $this->model_app->view_where_ordering('t_kebaktian',array('flag'=>1),'tgl_kebaktian','ASC');
		$data['duduk'] = $this->db->query("SELECT SUM(kapasitas) AS jml FROM t_duduk");
		$this->template->load('frontend/template','frontend/home',$data);
	}

	function about()
	{
		$this->load->view('frontend/about');
	}

	

	function dt()
	{
		$tglacara   = '2020-07-28';
		$jmlpeserta = 4;

		$q = $this->db->query("SELECT jml_peserta FROM t_acara WHERE tgl_acara = '".$tglacara."'");
		$cek = $q->num_rows();
		if ($cek == 0) {

			$range  = range(1, $jmlpeserta);
			$gabung = '';
			foreach ($range as $num) {
				$gabung .= $num.',';
			}
			echo substr($gabung,0,-1);

		}else{

			$q1 = $this->db->query("SELECT jml_peserta FROM t_acara WHERE tgl_acara = '".$tglacara."' AND id_acara = (SELECT max(id_acara) FROM t_acara WHERE tgl_acara = '".$tglacara."')")->row();
			$pecah = explode(',', $q1->jml_peserta);
			$n_max = max($pecah);
			$sum   = $n_max+$jmlpeserta;
			$range = range($n_max+1,$sum);
			$gabung = '';
			foreach ($range as $num) {
				$gabung .= $num.',';
			}
			echo substr($gabung,0,-1);

		}
	}

	function ddk()
	{
		$ddd = 4;
		$rr = noduduk($ddd);
		echo $rr;
	}



}

/* End of file Main.php */
/* Location: ./application/controllers/Main.php */ 