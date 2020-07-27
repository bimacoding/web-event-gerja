<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function index()
	{
		redirect('siteman/index','refresh');
	}

	public function getHistory()
	{
		$this->load->model('model_ajax');
		if( $this->input->is_ajax_request()  )  {
			$datatables  = $_POST;
			$datatables['table']    = 't_histori';
			$datatables['id-table'] = 'id_histori';
			$datatables['col-display'] = array(
			                "id_histori",
			                "id_users",
			                "kegiatan",
			                "data",
			                "ip",
			                "browser",
			             );
			$this->model_ajax->get_Datatables($datatables);
		}
		return;
    }

   function getKebaktian()
   {
   		$kode = $this->input->post('id_kebaktian');
		$q = $this->model_app->view_where('t_kebaktian',array('id_kebaktian'=>$kode));
		$alat = $q->row_array();
		$data = array(
            'nama_acara'   =>  htmlentities($alat['nama_kebaktian']),
            'tgl_acara'   =>  htmlentities($alat['tgl_kebaktian']),
            'jam_acara'   =>  htmlentities($alat['jam_kebaktian']),
        );
 		echo json_encode($data);
   }

   function update_acara()
   {
   		$datenow = date('Y-m-d');
   		$q = $this->model_app->view_ordering('t_acara','id_acara','ASC');
   		foreach ($q as $key) {
   			if ($datenow > $key['tgl_acara']) {
   				$this->model_app->update('t_acara',array('flag'=>0),array('id_acara'=>$key['id_acara'],'flag'=>1));
   			}
   		}
   }

}

/* End of file Ajax.php */
/* Location: ./application/controllers/Ajax.php */