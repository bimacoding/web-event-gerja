<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siteman extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		
		// $this->load->model('model_app');
	}

	function index()
	{
		
		if (isset($_POST['submit'])) {
			$username = $this->input->post('a');
			$password = md5($this->input->post('b'));
			$cek = $this->model_app->cek_login($username, $password,'t_users');
			$row = $cek->row_array();
			$total = $cek->num_rows();
			if ($total > 0) {
				$array = array(
					'email'   => $row['email'],
					'level'   => $row['level'],
					'id' 	  => $row['id_users'],
					'nama' 	  => $row['nama'],
					'nik' 	  => $row['nopeg'],
					'foto' 	  => $row['foto']
				);
				
				$this->session->set_userdata( $array );
				redirect('siteman/home');
			}else{
				$data['title'] = 'Username atau Password salah!';
				$this->load->view('vta_backend/login',$data);
			}
		}else{
			if ($this->session->userdata('level')=='admin') {
				 redirect('siteman/home','refresh');
			}else{
				$this->load->view('vta_backend/login');
			}
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect('siteman');
	}

	function home()
	{
		cek_session_user();
		$data['title'] = "Dashboard admin";
		$this->template->load('vta_backend/template','vta_backend/main',$data);
	}

	function add_logo()
	{
		$level = $this->session->userdata('level');
		cek_session_akses('siteman/identitaswebsite',$level);
		if (isset($_POST['submit'])) {
			$config['upload_path'] = 'assets/images/';
			$config['allowed_types'] = 'png';
			$config['max_size']  = '20000'; //Kb
			$this->load->library('upload', $config);
			$this->upload->do_upload('logo');
			$hasil = $this->upload->data();
			$data = array('logo'=>$hasil['file_name']);
			$where = array('id_identitas'=>1);
			$q = $this->model_app->update('t_identitas', $data, $where);

			if ($q) {
				redirect('siteman/identitaswebsite/berhasil','refresh');
			}else{
				redirect('siteman/identitaswebsite/gagal','refresh');

			}
			
		}
	}

	function identitaswebsite()
	{
		
		$level = $this->session->userdata('level');
		cek_session_akses('siteman/identitaswebsite',$level);
		if (isset($_POST['submit'])) {
			$config['upload_path'] = 'assets/images/';
			$config['allowed_types'] = 'gif|jpg|png|ico';
			$config['max_size']  = '1000'; //Kb
			$this->load->library('upload', $config);
			$this->upload->do_upload('g');
			$hasil = $this->upload->data();
			if ($hasil['file_name']=='') {
				$data = array(
								'nama_website'=>$this->db->escape_str($this->input->post('a')),
								'email'=>$this->db->escape_str($this->input->post('b')),
								'key'=>$this->db->escape_str($this->input->post('key')),
								'url'=>$this->db->escape_str($this->input->post('c')),
								'no_telp'=>$this->db->escape_str($this->input->post('d')),
								'meta_deskripsi'=>$this->db->escape_str($this->input->post('e')),
								'meta_keyword'=>$this->db->escape_str($this->input->post('f')),
								'maps'=>$this->db->escape_str($this->input->post('h'))
							  ); 
			}else{
				$data = array(
								'nama_website'=>$this->db->escape_str($this->input->post('a')),
								'email'=>$this->db->escape_str($this->input->post('b')),
								'key'=>$this->db->escape_str($this->input->post('key')),
								'url'=>$this->db->escape_str($this->input->post('c')),
								'no_telp'=>$this->db->escape_str($this->input->post('d')),
								'meta_deskripsi'=>$this->db->escape_str($this->input->post('e')),
								'meta_keyword'=>$this->db->escape_str($this->input->post('f')),
								'favicon'=>$hasil['file_name'],
								'maps'=>$this->db->escape_str($this->input->post('h'))
							  );
			}
			$where = array('id_identitas'=>$this->input->post('id'));
			$q = $this->model_app->update('t_identitas', $data, $where);
			if ($q) {
				redirect('siteman/identitaswebsite/berhasil','refresh');
			}else{
				redirect('siteman/identitaswebsite/gagal','refresh');
			}

		}else{
			$data = array(
							'title'=>'Setting Identitas',
							'row'=>$this->model_app->edit('t_identitas',array('id_identitas'=>1))->row_array()
						);
			$this->template->load('vta_backend/template','vta_backend/mod_master_identitas/identitas',$data);
		}
	}


	function download($file)
	{
		$this->load->helper('download');
		force_download('assets/uploads/'.$file , NULL);
	}

	function peserta()
	{
		$level = $this->session->userdata('level');
		cek_session_akses('siteman/peserta',$level);
		$data['title'] = 'Data peserta';
		$data['record'] = $this->model_app->view_ordering('t_peserta','id_peserta','DESC');
		$this->template->load('vta_backend/template','vta_backend/mod_master_peserta/view',$data);
	}


	function tambah_peserta()
	{
		$level = $this->session->userdata('level');
		cek_session_akses('siteman/peserta',$level);

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
		if (isset($_POST['submit'])) {
			$data = array(
						'kode_peserta' => $kodepeserta,
						'nama_peserta' => $this->db->escape_str($this->input->post('nama_peserta')),
						'nohp_peserta' => $this->db->escape_str($this->input->post('nohp_peserta')),
						'jml_peserta'  => $this->db->escape_str($this->input->post('jml_peserta')),
						'sts_jemaat'  => $this->db->escape_str($this->input->post('sts_jemaat')),
						'qr_peserta'   => $image_name,
						'created_on'   => date('Y-m-d'),
						'created_by'   => $this->session->userdata('nama')
					);
			$q = $this->model_app->insert('t_peserta',$data);
			if ($q) {
				$this->session->set_flashdata('success', 'Data berhasil diproses!');
				logAct($this->session->userdata('id'),'Tambah peserta',$this->input->post('peserta'));
				redirect('siteman/peserta','refresh');
			}else{
				$this->session->set_flashdata('error', 'Data gagal diproses!');
				redirect('siteman/peserta','refresh');
			}
		}else{
			$data['title'] = 'Tambah Data peserta';
			$this->template->load('vta_backend/template','vta_backend/mod_master_peserta/add',$data);
		}
		

	}

	function ubah_peserta()
	{
		$level = $this->session->userdata('level');
		cek_session_akses('siteman/peserta',$level);

		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])) {
			$data = array(
						'nama_peserta' => $this->db->escape_str($this->input->post('nama_peserta')),
						'nohp_peserta' => $this->db->escape_str($this->input->post('nohp_peserta')),
						'jml_peserta'  => $this->db->escape_str($this->input->post('jml_peserta')),
						'sts_jemaat'  => $this->db->escape_str($this->input->post('sts_jemaat'))
					);
			$where = array('id_peserta'=>$this->input->post('id'));
			$q = $this->model_app->update('t_peserta',$data,$where);
			if ($q) {
				$this->session->set_flashdata('success', 'Data berhasil diproses!');
				logAct($this->session->userdata('id'),'Ubah peserta',$this->input->post('peserta'));
				redirect('siteman/peserta','refresh');
			}else{
				$this->session->set_flashdata('error', 'Data gagal diproses!');
				redirect('siteman/peserta','refresh');
			}
		}else{
			$data['title'] = 'Ubah Data peserta';
			$data['row'] = $this->model_app->edit('t_peserta',array('id_peserta'=>$id))->row_array();
			$this->template->load('vta_backend/template','vta_backend/mod_master_peserta/edit',$data);
		}
		

	}

	function hapus_peserta()
	{
		$level = $this->session->userdata('level');
		cek_session_akses('siteman/peserta',$level);

		$id = $this->uri->segment(3);
		$data = array('id_peserta'=>$id);
		$q = $this->model_app->delete('t_peserta',$data);
		if ($q) {
			$this->session->set_flashdata('success', 'Data berhasil diproses!');
			redirect('siteman/peserta','refresh');
		}else{
			$this->session->set_flashdata('error', 'Data gagal diproses!');
			redirect('siteman/peserta','refresh');
		}
		$dt = $this->model_app->view_where('t_peserta',$data)->row_array();
		logAct($this->session->userdata('id'),'Hapus peserta',$dt['nama_peserta']);
	}

	function kebaktian()
	{
		$level = $this->session->userdata('level');
		cek_session_akses('siteman/kebaktian',$level);

		$data['title'] = 'Data kebaktian';
		$data['record'] = $this->model_app->view_ordering('t_kebaktian','id_kebaktian','DESC');
		$this->template->load('vta_backend/template','vta_backend/mod_master_kebaktian/view',$data);
	}

	function tambah_kebaktian()
	{
		$level = $this->session->userdata('level');
		cek_session_akses('siteman/kebaktian',$level);

		if (isset($_POST['submit'])) {
			$data = array(
						'nama_kebaktian' => $this->db->escape_str($this->input->post('nama_kebaktian')),
						'tgl_kebaktian' => $this->db->escape_str($this->input->post('tahun')).'-'.$this->db->escape_str($this->input->post('bulan')).'-'.$this->db->escape_str($this->input->post('tanggal')),
						'jam_kebaktian' => $this->db->escape_str($this->input->post('jam_kebaktian')),
						'keterangan' => $this->db->escape_str($this->input->post('keterangan')),
						'flag' => 1,
						'created_on' => date('Y-m-d'),
						'created_by' => $this->session->userdata('nama')
					);
			$q = $this->model_app->insert('t_kebaktian',$data);
			if ($q) {
				$this->session->set_flashdata('success', 'Data berhasil diproses!');
				logAct($this->session->userdata('id'),'Tambah kebaktian',$this->input->post('nama_kebaktian'));
				redirect('siteman/kebaktian','refresh');
			}else{
				$this->session->set_flashdata('error', 'Data gagal diproses!');
				redirect('siteman/kebaktian','refresh');
			}
		}else{
			$data['title'] = 'Tambah Data kebaktian';
			$this->template->load('vta_backend/template','vta_backend/mod_master_kebaktian/add',$data);
		}
		

	}

	function ubah_kebaktian()
	{
		$level = $this->session->userdata('level');
		cek_session_akses('siteman/kebaktian',$level);

		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])) {
			$data = array(
						'nama_kebaktian' => $this->db->escape_str($this->input->post('nama_kebaktian')),
						'tgl_kebaktian' => $this->db->escape_str($this->input->post('tahun')).'-'.$this->db->escape_str($this->input->post('bulan')).'-'.$this->db->escape_str($this->input->post('tanggal')),
						'jam_kebaktian' => $this->db->escape_str($this->input->post('jam_kebaktian')),
						'keterangan' => $this->db->escape_str($this->input->post('keterangan')),
						'flag' => 1
					);
			$where = array('id_kebaktian'=>$this->input->post('id'));
			$q = $this->model_app->update('t_kebaktian',$data,$where);
			if ($q) {
				$this->session->set_flashdata('success', 'Data berhasil diproses!');
				logAct($this->session->userdata('id'),'Ubah kebaktian',$this->input->post('nama_kebaktian'));
				redirect('siteman/kebaktian','refresh');
			}else{
				$this->session->set_flashdata('error', 'Data gagal diproses!');
				redirect('siteman/kebaktian','refresh');
			}
		}else{
			$data['title'] = 'Ubah Data kebaktian';
			$data['row'] = $this->model_app->edit('t_kebaktian',array('id_kebaktian'=>$id))->row_array();
			$this->template->load('vta_backend/template','vta_backend/mod_master_kebaktian/edit',$data);
		}
		

	}

	function hapus_kebaktian()
	{
		$level = $this->session->userdata('level');
		cek_session_akses('siteman/kebaktian',$level);

		$id = $this->uri->segment(3);
		$data = array('id_kebaktian'=>$id);
		$q = $this->model_app->delete('t_kebaktian',$data);
		if ($q) {
			$this->session->set_flashdata('success', 'Data berhasil diproses!');
			redirect('siteman/kebaktian','refresh');
		}else{
			$this->session->set_flashdata('error', 'Data gagal diproses!');
			redirect('siteman/kebaktian','refresh');
		}
		$dt = $this->model_app->view_where('t_kebaktian',$data)->row_array();
		logAct($this->session->userdata('id'),'Hapus kebaktian',$dt['nama_kebaktian']);
	}

	function aktif_kebaktian()
	{
		$level = $this->session->userdata('level');
		cek_session_akses('siteman/kebaktian',$level);

		$id = $this->uri->segment(3);
		$where = array('id_kebaktian'=>$id,'flag'=>0);
		$data = array('flag'=>1);
		$q = $this->model_app->update('t_kebaktian',$data,$where);
		if ($q) {
			$this->session->set_flashdata('success', 'Data berhasil diproses!');
			redirect('siteman/kebaktian','refresh');
		}else{
			$this->session->set_flashdata('error', 'Data gagal diproses!');
			redirect('siteman/kebaktian','refresh');
		}
		$dt = $this->model_app->view_where('t_kebaktian',array('id_kebaktian'=>$id))->row_array();
		logAct($this->session->userdata('id'),'aktifkan kebaktian',$dt['nama_kebaktian']);
	}

	function nonaktif_kebaktian()
	{
		$level = $this->session->userdata('level');
		cek_session_akses('siteman/kebaktian',$level);

		$id = $this->uri->segment(3);
		$where = array('id_kebaktian'=>$id,'flag'=>1);
		$data = array('flag'=>0);
		$q = $this->model_app->update('t_kebaktian',$data,$where);
		if ($q) {
			$this->session->set_flashdata('success', 'Data berhasil diproses!');
			redirect('siteman/kebaktian','refresh');
		}else{
			$this->session->set_flashdata('error', 'Data gagal diproses!');
			redirect('siteman/kebaktian','refresh');
		}
		$dt = $this->model_app->view_where('t_kebaktian',array('id_kebaktian'=>$id))->row_array();
		logAct($this->session->userdata('id'),'non-aktifkan kebaktian',$dt['nama_kebaktian']);
	}


	function duduk()
	{
		$level = $this->session->userdata('level');
		cek_session_akses('siteman/duduk',$level);

		$data['title'] = 'Data duduk';
		$data['record'] = $this->model_app->view_ordering('t_duduk','id_duduk','DESC');
		$this->template->load('vta_backend/template','vta_backend/mod_master_duduk/view',$data);
	}

	function tambah_duduk()
	{
		$level = $this->session->userdata('level');
		cek_session_akses('siteman/duduk',$level);

		if (isset($_POST['submit'])) {
			$data = array(
						'baris' => $this->db->escape_str($this->input->post('baris')),
						'kapasitas' => $this->db->escape_str($this->input->post('kapasitas'))
					);
			$q = $this->model_app->insert('t_duduk',$data);
			if ($q) {
				$this->session->set_flashdata('success', 'Data berhasil diproses!');
				logAct($this->session->userdata('id'),'Tambah duduk',$this->input->post('baris'));
				redirect('siteman/duduk','refresh');
			}else{
				$this->session->set_flashdata('error', 'Data gagal diproses!');
				redirect('siteman/duduk','refresh');
			}
		}else{
			$data['title'] = 'Tambah Data duduk';
			$this->template->load('vta_backend/template','vta_backend/mod_master_duduk/add',$data);
		}
		

	}

	function ubah_duduk()
	{
		$level = $this->session->userdata('level');
		cek_session_akses('siteman/duduk',$level);

		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])) {
			$data = array(
						'baris' => $this->db->escape_str($this->input->post('baris')),
						'kapasitas' => $this->db->escape_str($this->input->post('kapasitas'))
					);
			$where = array('id_duduk'=>$this->input->post('id'));
			$q = $this->model_app->update('t_duduk',$data,$where);
			if ($q) {
				$this->session->set_flashdata('success', 'Data berhasil diproses!');
				logAct($this->session->userdata('id'),'Ubah duduk',$this->input->post('baris'));
				redirect('siteman/duduk','refresh');
			}else{
				$this->session->set_flashdata('error', 'Data gagal diproses!');
				redirect('siteman/duduk','refresh');
			}
		}else{
			$data['title'] = 'Ubah Data duduk';
			$data['row'] = $this->model_app->edit('t_duduk',array('id_duduk'=>$id))->row_array();
			$this->template->load('vta_backend/template','vta_backend/mod_master_duduk/edit',$data);
		}
		

	}

	function hapus_duduk()
	{
		$level = $this->session->userdata('level');
		cek_session_akses('siteman/duduk',$level);

		$id = $this->uri->segment(3);
		$data = array('id_duduk'=>$id);
		$q = $this->model_app->delete('t_duduk',$data);
		if ($q) {
			$this->session->set_flashdata('success', 'Data berhasil diproses!');
			redirect('siteman/duduk','refresh');
		}else{
			$this->session->set_flashdata('error', 'Data gagal diproses!');
			redirect('siteman/duduk','refresh');
		}
		$dt = $this->model_app->view_where('t_duduk',$data)->row_array();
		logAct($this->session->userdata('id'),'Hapus duduk',$dt['baris']);
	}

	function icon()
	{
		$data['title'] = 'Dokumentasi Icon';
		$this->template->load('vta_backend/template','vta_backend/dokumentasi',$data);
	}


	function slide()
	{
		$level = $this->session->userdata('level');
		cek_session_akses('siteman/slide',$level);

		$data['title'] = 'Data Slide';
		$data['record'] = $this->model_app->view_ordering('t_slide','id_slide','DESC');
		$this->template->load('vta_backend/template','vta_backend/mod_master_slide/view',$data);
	}

	function tambah_slide()
	{
		$level = $this->session->userdata('level');
		cek_session_akses('siteman/slide',$level);

		if (isset($_POST['submit'])){
			$config['upload_path'] = 'assets/uploads/slide/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']  = '2000'; //Kb
			$this->load->library('upload', $config);
			$this->upload->do_upload('gambar_slide');
			$hasil = $this->upload->data();
			if ($hasil['file_name']!=='') {
				$data = array(
							'nama_slide' => $this->db->escape_str($this->input->post('nama_slide')),
							'gambar_slide' => $hasil['file_name'],
							'ket_slide' => $this->db->escape_str($this->input->post('ket_slide')),
							'aktif_slide' => $this->db->escape_str($this->input->post('aktif_slide')),
						); 
			}else{
				$data = array(
							'nama_slide' => $this->db->escape_str($this->input->post('nama_slide')),
							'gambar_slide' => '',
							'ket_slide' => $this->db->escape_str($this->input->post('ket_slide')),
							'aktif_slide' => $this->db->escape_str($this->input->post('aktif_slide')),
						);
			}
			$q = $this->model_app->insert('t_slide',$data);
			if ($q) {
				$this->session->set_flashdata('success', 'Data berhasil diproses!');
				logAct($this->session->userdata('id'),'Tambah slide',$this->input->post('nama_slide'));
				redirect('siteman/slide','refresh');
			}else{
				$this->session->set_flashdata('error', 'Data gagal diproses!');
				redirect('siteman/slide','refresh');
			}
		}else{
			$data['title'] = 'Tambah Data Slide';
			$this->template->load('vta_backend/template','vta_backend/mod_master_slide/add',$data);
		}
	}

	function ubah_slide()
	{
		$level = $this->session->userdata('level');
		cek_session_akses('siteman/slide',$level);

		$id = $this->uri->segment(3);
		if (isset($_POST['submit'])){
			$config['upload_path'] = 'assets/uploads/slide/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']  = '2000'; //Kb
			$this->load->library('upload', $config);
			$this->upload->do_upload('gambar_slide');
			$hasil = $this->upload->data();
			if ($hasil['file_name']!=='') {
				$data = array(
							'nama_slide' => $this->db->escape_str($this->input->post('nama_slide')),
							'gambar_slide' => $hasil['file_name'],
							'ket_slide' => $this->db->escape_str($this->input->post('ket_slide')),
							'aktif_slide' => $this->db->escape_str($this->input->post('aktif_slide')),
						); 
			}else{
				$data = array(
							'nama_slide' => $this->db->escape_str($this->input->post('nama_slide')),
							'gambar_slide' => '',
							'ket_slide' => $this->db->escape_str($this->input->post('ket_slide')),
							'aktif_slide' => $this->db->escape_str($this->input->post('aktif_slide')),
						);
			}
			$where = array('id_slide'=>$this->input->post('id'));
			$q = $this->model_app->update('t_slide',$data,$where);
			if ($q) {
				$this->session->set_flashdata('success', 'Data berhasil diproses!');
				logAct($this->session->userdata('id'),'Tambah slide',$this->input->post('nama_slide'));
				redirect('siteman/slide','refresh');
			}else{
				$this->session->set_flashdata('error', 'Data gagal diproses!');
				redirect('siteman/slide','refresh');
			}
		}else{
			$data['title'] = 'Tambah Data Slide';
			$data['row'] = $this->model_app->edit('t_slide',array('id_slide'=>$id))->row_array();
			$this->template->load('vta_backend/template','vta_backend/mod_master_slide/edit',$data);
		}
	}

	function hapus_slide()
	{
		$level = $this->session->userdata('level');
		cek_session_akses('siteman/slide',$level);
		
		$id = $this->uri->segment(3);
		$data = array('id_slide'=>$id);
		$q = $this->model_app->delete('t_slide',$data);
		if ($q) {
			$this->session->set_flashdata('success', 'Data berhasil diproses!');
			redirect('siteman/slide','refresh');
		}else{
			$this->session->set_flashdata('error', 'Data gagal diproses!');
			redirect('siteman/slide','refresh');
		}
		$dt = $this->model_app->view_where('t_slide',$data)->row_array();
		logAct($this->session->userdata('id'),'Hapus slide',$dt['nama_slide']);
	}

	function cek_register()
	{
		$level = $this->session->userdata('level');
		cek_session_akses('siteman/cek_register',$level);
		$data['title'] = 'Cek data register';
		$this->template->load('vta_backend/template','vta_backend/qr_cek',$data);
	}

	function cek_register_mobile()
	{
		$level = $this->session->userdata('level');
		cek_session_akses('siteman/cek_register_mobile',$level);
		$data['title'] = 'Cek data register';
		$this->template->load('vta_backend/template','vta_backend/qr_cek2',$data);
		// $this->load->view('vta_backend/qr_cek2',$data);

	}

	function cek_bakti()
	{
		$kode = $this->uri->segment(3);
		$level = $this->session->userdata('level');
		if ($level != 'user') {
			redirect('main','refresh');
		}
		$data['title'] = 'Cek data peserta kebaktian yang hadir';
		$data['record']   = $this->model_app->view_where('t_acara',array('kode_acara'=>$kode));
		$this->template->load('vta_backend/template','vta_backend/cek_kebaktian',$data);
	}





	

}

/* End of file Siteman.php */
/* Location: ./application/controllers/Siteman.php */