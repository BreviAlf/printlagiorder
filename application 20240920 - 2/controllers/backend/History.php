<?php
class History extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->model('spk_model');
		//$this->load->library('Pdf');
		$this->load->library('Code128');
		if(!$this->session->userdata('user_id') && !$this->session->userdata('user_display_name') ):
			redirect('login');
		elseif($this->session->userdata('user_rule')=='Frontend'):
			redirect('no_access');
		endif;
	}

	function index($offset = FALSE, $search_q = FALSE)
	{
		if(!$offset){$offset=0;}
		if($this->input->post('search_q') || $search_q!=null){
			if($this->input->post('search_q')){$teks = $this->input->post('search_q'); } else {$teks = $search_q; }  
			$data['search_q'] = $this->input->post('search_q'). $search_q;

			$data['arr_batch'] = $this->db->query('SELECT * FROM tb_batch_spk WHERE  
				batch_spk_no LIKE "%'.$teks.'%" OR 
				batch_spk_name LIKE "%'.$teks.'%" OR 
				batch_spk_date_created LIKE "%'.$teks.'%" OR 
				batch_spk_date_deadline LIKE "%'.$teks.'%" OR 
				batch_spk_date_deadline LIKE "%'.$teks.'%" OR 
				batch_spk_date_done LIKE "%'.$teks.'%" 
				ORDER BY batch_spk_date_created DESC LIMIT 10 OFFSET '. $offset.' ')->result_array();
				 
			$data['row_count'] = $this->db->query('SELECT * FROM tb_batch_spk WHERE  
				batch_spk_no LIKE "%'.$teks.'%" OR 
				batch_spk_name LIKE "%'.$teks.'%" OR 
				batch_spk_date_created LIKE "%'.$teks.'%" OR 
				batch_spk_date_deadline LIKE "%'.$teks.'%" OR 
				batch_spk_date_deadline LIKE "%'.$teks.'%" OR 
				batch_spk_date_done LIKE "%'.$teks.'%" 
				ORDER BY batch_spk_date_created DESC')->num_rows();
				
			CreateLog('INFO','load page');
			$data['current_offset'] = $offset;
			$data['sidebar_active'] = "sidebar_bspk_history";
			$data['collapse_active'] = "bspk-nav";
			$data['title'] = 'SISPRINT - SPK Batch';
			$data['template'] = 'history/index';
			$this->load->view('backend/index',$data);
		
		} else {

			$data['arr_batch'] = $this->db->get('tb_batch_spk')->result_array();
			$qr = $this->db->select('*');
			$qr = $this->db->from('tb_batch_spk');
			$qr = $this->db->limit(10,$offset);
			$qr = $this->db->order_by('batch_spk_date_created','desc');
			$qr = $this->db->get();
			$data['arr_batch'] = $qr->result_array();
			$data['row_count'] = $this->db->query('SELECT * FROM tb_batch_spk ')->num_rows();
			$data['current_offset'] = $offset;
			$data['search_q'] = '';
			
			CreateLog('INFO','load page');
			$data['sidebar_active'] = "sidebar_bspk_history";
			$data['collapse_active'] = "bspk-nav";
			$data['title'] = 'SISPRINT - SPK Batch';
			$data['template'] = 'history/index';
			$this->load->view('backend/index',$data);
		}
	}

	function detail()
	{

		$data['title'] = 'Batch List';
		//sidebar prop
		$data['sidebar_active'] = "sidebar_bspk_history";
		$data['collapse_active'] = "bspk-nav";
		
		CreateLog('INFO','load page');
		$batch_spk_id = $this->uri->segment(4);
		$this->db->where('batch_spk_id',$batch_spk_id);
		$data['row_batch'] = $this->db->get('tb_batch_spk')->row();
		
		$qr = $this->db->query(
			"SELECT * FROM tb_batch_spk_detail
			 JOIN tb_spk
			 ON tb_batch_spk_detail.batch_spk_det_spk_no = tb_spk.spk_no WHERE batch_spk_det_spk_id = $batch_spk_id ORDER BY batch_spk_det_done ASC");
		$data['arr_spk_det'] = $qr->result_array();
		$data['batch_spk_id'] =$batch_spk_id;
		
		$data['template'] = 'history/history_detailspk';
		$this->load->view('backend/index',$data);
	}


	function done()
	{

		//$batch_spk_id = $this->input->post('batch_spk_id');
		$batch_spk_id	= $this->uri->segment(4);
		date_default_timezone_set('Asia/Jakarta');
		$time_now 	  = date('Y-m-d H:i:s');

		// process SPK
		// loop data spk batch

		$this->db->where('batch_spk_det_spk_id',$batch_spk_id);
		$arr_det_spk = $this->db->get('tb_batch_spk_detail')->result_array();

		foreach($arr_det_spk as $row_det_spk)
		{
			$updateArray[] = array(
				'spk_no'			=>$row_det_spk['batch_spk_det_spk_no'],
				'spk_status' 		=> 'Done',
				'spk_time_done'  => $time_now
			);
		}

		$this->db->update_batch('tb_spk',$updateArray, 'spk_no'); 

		CreateLog('INFO','update batch data id '.$batch_spk_id);

		$data = array
				(
					'batch_spk_date_done'	=> $time_now,
					'batch_spk_status'		=> 'Done',
				);
		$this->db->where('batch_spk_id',$batch_spk_id);
		$this->db->update('tb_batch_spk',$data);

		$this->load->helper('url');

		//echo anchor(site_url().'backend/batchspk/cetak_batch/'.$batch_spk_id, 'title="Pakainfo Jaydeep"', array('target' => '_blank', 'class' => 'new_window'));

		redirect('backend/history');

	}

	function delete()
	{
		$batch_spk_id = $this->uri->segment(4);

		// delete data batch
		$this->db->where('batch_spk_id',$batch_spk_id);
		$this->db->delete('tb_batch_spk');

		// delete data batch detail
		// del tb_batch_spk_detail by batch_spk_det_batch_spk_id
		$this->db->where('batch_spk_det_spk_id',$batch_spk_id);
		$this->db->delete('tb_batch_spk_detail');


		redirect('backend/batchspk');

	}
}
?>