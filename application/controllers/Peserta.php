<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta extends CI_Controller {

	public function index()
	{
		redirect('main','refresh');
	}

	function register()
	{
		if (isset($_POST['submit'])) {
			$nohp = $this->db->escape_str($this->input->post('nohp_peserta'));
			$nama = $this->db->escape_str($this->input->post('nama_peserta'));
			$jemaat = $this->db->escape_str($this->input->post('sts_jemaat'));
			$jml = $this->db->escape_str($this->input->post('jml_peserta'));
			$tglacara = date($this->input->post('tgl_acara'));
			$jamacara = date($this->input->post('jam_acara'));
			$namaacara = $this->db->escape_str($this->input->post('nama_acara'));
			$q    = $this->model_utama->view_where('t_peserta',array('nohp_peserta'=>$nohp));
			$a    = $this->model_utama->view_where('t_acara',array('nohp_peserta'=>$nohp,'tgl_acara'=>$tglacara, 'jam_acara'=>$jamacara));
			$cek  = $q->num_rows();
			$ceka  = $a->num_rows();
			if ($cek == 0) {
				$kodepeserta = $this->mylibrary->kdauto('t_peserta', 'id_peserta', 'GKI');
				$this->load->library('ciqrcode'); //pemanggilan library QR CODE
		 
		        $config['cacheable']    = true; //boolean, the default is true
		        $config['cachedir']     = 'assets/'; //string, the default is application/cache/
		        $config['errorlog']     = 'assets/'; //string, the default is application/logs/
		        $config['imagedir']     = 'assets/uploads/qrusers/'; //direktori penyimpanan qr code
		        $config['quality']      = true; //boolean, the default is true
		        $config['size']         = '5000'; //interger, the default is 1024
		        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
		        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
		        $this->ciqrcode->initialize($config);
		 
		        $image_name = $kodepeserta.'.png'; //buat name dari qr code sesuai dengan nim
		 
		        $params['data'] = base_url().'main/peserta/'.$kodepeserta; //data yang akan di jadikan QR CODE
		        $params['level'] = 'H'; //H=High
		        $params['size'] = 50;
		        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
		        $this->ciqrcode->generate($params);
		        $data = array(
						'kode_peserta' => $kodepeserta,
						'nama_peserta' => $nama,
						'nohp_peserta' => $nohp,
						'jml_peserta'  => $jml,
						'sts_jemaat'   => $jemaat,
						'qr_peserta'   => $image_name,
						'created_on'   => date('Y-m-d'),
						'created_by'   => $nama
					);
				$this->model_utama->insert('t_peserta',$data);
			}else{
				$data = array(
						'nama_peserta' => $nama,
						'nohp_peserta' => $nohp,
						'jml_peserta'  => $jml,
						'sts_jemaat'   => $jemaat
					);
				$where = array('nohp_peserta'=>$nohp);
				$this->model_utama->update('t_peserta',$data,$where);
			}

			if ($ceka == 0) {

				$qq = $this->db->query("SELECT jml_peserta FROM t_acara WHERE tgl_acara = '".$tglacara."' AND jam_acara = '".$jamacara."'");
				$cekq = $qq->num_rows();
				if ($cekq == 0) {

					$rangeq  = range(1, $jml);
					$gabungq = '';
					foreach ($rangeq as $num) {
						$gabungq .= $num.',';
					}
					$nodudukx = substr($gabungq,0,-1);

				}else{

					$q11 = $this->db->query("SELECT jml_peserta FROM t_acara WHERE tgl_acara = '".$tglacara."' AND jam_acara = '".$jamacara."' AND id_acara = (SELECT max(id_acara) FROM t_acara WHERE tgl_acara = '".$tglacara."' AND jam_acara = '".$jamacara."')")->row();
					$pecahs = explode(',', $q11->jml_peserta);
					$n_maxs = max($pecahs);
					$sums   = $n_maxs+$jml;
					$ranges = range($n_maxs+1,$sums);
					$gabungs = '';
					foreach ($ranges as $num) {
						$gabungs .= $num.',';
					}
					$nodudukx = substr($gabungs,0,-1);

				}

				$kodeacara = $this->mylibrary->kdauto('t_acara', 'id_acara', 'BAKTI');
				$this->load->library('ciqrcode'); //pemanggilan library QR CODE
		 
		        $config['cacheable']    = true; //boolean, the default is true
		        $config['cachedir']     = 'assets/'; //string, the default is application/cache/
		        $config['errorlog']     = 'assets/'; //string, the default is application/logs/
		        $config['imagedir']     = 'assets/uploads/qracara/'; //direktori penyimpanan qr code
		        $config['quality']      = true; //boolean, the default is true
		        $config['size']         = '5000'; //interger, the default is 1024
		        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
		        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
		        $this->ciqrcode->initialize($config);
		 
		        $image_name = $kodeacara.'.png'; //buat name dari qr code sesuai dengan nim
		 
		        $params['data'] = base_url().'siteman/cek_bakti/'.$kodeacara; //data yang akan di jadikan QR CODE
		        $params['level'] = 'H'; //H=High
		        $params['size'] = 50;
		        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
		        $this->ciqrcode->generate($params);

				$data = array(
							'kode_acara'   => $kodeacara,
							'nama_peserta' => $nama,
							'nohp_peserta' => $nohp,
							'nama_acara'   => $namaacara,
							'tgl_acara'    => $tglacara,
							'jam_acara'    => $jamacara,
							'sts_jemaat'   => $jemaat,
							'jml_peserta'  => $nodudukx,
							'qr_acara'     => $image_name,
							'created_on'   => date('Y-m-d'),
							'created_by'   => $nama,
							'flag'         => 1
						);
				$q = $this->model_utama->insert('t_acara',$data);
				if ($q) {
					$insert_id = $this->db->insert_id();
					redirect('peserta/detil/'.$insert_id,'refresh');
				}
			}else{

				$q1 = $this->db->query("SELECT jml_peserta FROM t_acara WHERE tgl_acara = '".$tglacara."' AND jam_acara = '".$jamacara."' AND id_acara = (SELECT max(id_acara) FROM t_acara WHERE tgl_acara = '".$tglacara."' AND jam_acara = '".$jamacara."')")->row();
				$pecahs = explode(',', $q1->jml_peserta);
				$n_maxs = max($pecahs);
				$sums   = $n_max+$jml;
				$ranges = range($n_maxs+1,$sums);
				$gabungs = '';
				foreach ($ranges as $num) {
					$gabungs .= $num.',';
				}
				$noduduks = substr($gabungs,0,-1);

				$data = array(
							'nama_peserta' => $nama,
							'nohp_peserta' => $nohp,
							'nama_acara'   => $namaacara,
							'tgl_acara'    => $tglacara,
							'jam_acara'    => $jamacara,
							'sts_jemaat'   => $jemaat,
							'jml_peserta'  => $noduduks,
						);
				$where = array('nohp_peserta'=>$nohp,'tgl_acara'=>$tglacara,'jam_acara'=>$jamacara);
				$q = $this->model_utama->update('t_acara',$data,$where);
				if ($q) {
					$insert_id = $q->affected_rows();
					redirect('peserta/detil/'.$insert_id,'refresh');
				}
				// $insert_id = $idnyax;
				// echo $insert_id;

			}
			
		}
	}

	function detil()
	{
		$id = $this->uri->segment(3);
		$data['title']  = 'Tiket anda';
		$data['record'] = $this->model_utama->view_where('t_acara',array('id_acara'=>$id,'flag'=>1));
		$this->template->load('frontend/template','frontend/tiket',$data);
		
	}

	function cek_register()
	{
		if (isset($_POST['submit'])) {
			$nohp      = $this->db->escape_str($this->input->post('nohp_peserta'));
			$tglacara  = date($this->input->post('tgl_acara'));
			$jamacara  = date($this->input->post('jam_acara'));
			$namaacara = $this->db->escape_str($this->input->post('nama_acara'));
			$data['title']  = 'Hasil pencarian tiket anda';
			$data['record'] = $this->model_utama->view_where('t_acara',array('nohp_peserta'=>$nohp,'nama_acara'=>$namaacara,'tgl_acara'=>$tglacara,'jam_acara'=>$jamacara,'flag'=>1));
			$this->template->load('frontend/template','frontend/tiket',$data);
		}else{
			redirect('main','refresh');
		}
		
	}

	public function cetakTiket(){

	    $kode = $this->uri->segment(3);
	    $data['record'] = $this->model_utama->view_where('t_acara',array('kode_acara'=>$kode));
	    $this->load->library('dpdf');
	    $customPaper = array(0,0,250,420);
		$this->dpdf->set_paper($customPaper);
	    $this->dpdf->filename = "cetakTiket.pdf";
	    $this->dpdf->load_view('frontend/cetakTiket', $data);


	}

}

/* End of file Peserta.php */
/* Location: ./application/controllers/Peserta.php */