<?php
class Broadcast extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->model('broadcast_model');
		if(!$this->session->userdata('user_id') && !$this->session->userdata('user_display_name') ):
			redirect('login');
		elseif($this->session->userdata('user_rule')=='Frontend'):
			redirect('no_access');
		endif;
	}

	function index()
	{

		$data['title'] = 'Broadcast List';

		CreateLog('INFO','Open Page');
		//sidebar prop

		$data['sidebar_active'] = "sidebar_broadcast";
		$data['collapse_active'] = "broadcast-nav";

		//data
		$this->load->library('pagination');
		$offset = $this->uri->segment(4);
		$config['base_url'] = site_url().'/backend/broadcast/index';
		$config['total_rows'] = count($this->broadcast_model->GetBroadcastBatch('all',FALSE,FALSE,FALSE));
		$config['uri_segment'] = '4';
		
		// pagination config
		$config['per_page'] 		= $this->config->item('per_page');
		$config['full_tag_open'] 	= $this->config->item('full_tag_open');
		$config['full_tag_close'] 	= $this->config->item('full_tag_close');
		$config['num_tag_open'] 	= $this->config->item('num_tag_open');
		$config['num_tag_close'] 	= $this->config->item('num_tag_close');
		$config['cur_tag_open'] 	= $this->config->item('cur_tag_open');
		$config['cur_tag_close'] 	= $this->config->item('cur_tag_close');
		$config['next_tag_open'] 	= $this->config->item('next_tag_open');
		$config['next_tagl_close'] 	= $this->config->item('next_tagl_close');
		$config['prev_tag_open'] 	= $this->config->item('prev_tag_open');
		$config['prev_tagl_close'] 	= $this->config->item('prev_tagl_close');
		$config['first_tag_open'] 	= $this->config->item('first_tag_open');
		$config['first_tagl_close'] = $this->config->item('first_tagl_close');
		$config['last_tag_open'] 	= $this->config->item('last_tag_open');
		$config['last_tagl_close'] 	= $this->config->item('last_tagl_close');
		
		$data['urut'] = $this->uri->segment(4);
		$data['offset'] = $offset;
		$data['template'] = 'broadcast/index';
		$data['arr_data'] = $this->broadcast_model->GetBroadcastBatch('all',FALSE,$config['per_page'],$offset);
		$this->pagination->initialize($config);
		$this->load->view('backend/index',$data);
		

	}


	public function AjaxGenerateFile()
	{
		$bc_batch_id = $this->input->post('bc_batch_id');

		$this->db->where('bc_batch_id',$bc_batch_id);
		$row = $this->db->get('tb_bc_batch')->row();

		if($row->bc_batch_file_generate_created == '0000-00-00 00:00:00' || $row->bc_batch_file_generate_created == NULL){
			$arr_resp= array('bc_batch_id'=>$bc_batch_id,'flag'=>0);

		}else{
			$arr_resp= array('bc_batch_id'=>$bc_batch_id,'flag'=>1);
		}
		echo json_encode($arr_resp);
	}

	public function generate_file()
	{	
		$bc_batch_id = $this->uri->segment(4);
		$cust_batch_id = $this->uri->segment(5);
		$gender = $this->uri->segment(6);

		CreateLog('INFO','Generate file batch_id = '.$bc_batch_id);
		$this->db->where('bc_batch_id',$bc_batch_id);
		$row_bc = $this->db->get('tb_bc_batch')->row();

		$this->db->where('cust_batch_id',$cust_batch_id);
		$row_cust = $this->db->get('tb_cust_batch')->row();

		$url = site_url().'landing/id/'.$row_bc->bc_batch_landing_id.'?uid=';

		
		// create csv file
		$qr_bc_csv = $this->db->query("SELECT
		tb_customer.cust_name,
		tb_customer.cust_phone,
		tb_customer.cust_uid,
		tb_customer.cust_id,
		tb_landing.landing_id,
		CONCAT('$url',tb_customer.cust_uid) AS url
		FROM
			tb_cust_batch
				INNER JOIN tb_bc_batch ON tb_bc_batch.bc_batch_cust_batch_id = tb_cust_batch.cust_batch_id
				INNER JOIN tb_landing ON tb_landing.landing_id = tb_bc_batch.bc_batch_landing_id
				LEFT JOIN tb_customer ON tb_customer.cust_cust_batch_id = tb_cust_batch.cust_batch_id
				WHERE tb_bc_batch.bc_batch_id = $bc_batch_id");

		$arr_data_csv = $qr_bc_csv->result_array();
		

		//get data tb_bc_batch
		$this->load->helper('inflector');

		$filename = underscore($row_cust->cust_batch_name.'_'.$row_bc->bc_batch_name);

		$data = array('bc_batch_file_generate_created'=>date('Y-m-d H:i:s'));
		$this->db->where('bc_batch_id',$bc_batch_id);
		$this->db->update('tb_bc_batch',$data); 
		
		$this->exportCSV($arr_data_csv,$filename,$bc_batch_id,$row_bc->bc_batch_landing_id,$gender);

	}

	private function exportCSV($array_csv,$file_name,$batch_id,$landing_id,$gender)
	{ 
		// file name 
		$filename = $file_name.'_'.date('Ymd_His').'.txt'; 

		foreach ($array_csv as $row)
		{ 

			$arr_cust[] = array
			(
				'bc_cust_cust_id' 		=> $row['cust_id'],
				'bc_cust_phone' 		=> $row['cust_phone'],
				'bc_cust_bc_batch_id'   => $batch_id,
				'bc_cust_status' 		=> 'Ready',
				'bc_cust_app_id' 		=> 1,
				'bc_cust_landing_id' 	=> $landing_id
			);	
		}

		
		$this->db->insert_batch('tb_bc_cust_detail',$arr_cust);
		CreateLog('INFO','Insert tb_bc_cust_detail batch_id = '.$batch_id.'landing_id = '.$landing_id);


		CreateLog('INFO','Create Array For Generate Random Name batch_id = '.$batch_id.'landing_id = '.$landing_id.' txt file name :'.$filename);
		$array_export = array();

		/*QISCUS HEADER
		phone_number,customer_name,variable1,variable2,variable3,variable4,variable5
		6285197553239,GraceChristin,GraceChristin,13143,f048e30,https://isamu.id/landing/id/24?uid=f048e30,Aldi
		*/

		/*QISCUS HEADER 2
		phone_number,customer_name,variable1,variable2,variable3,variable4,variable5
		6283804777481,Rezky Alfonzo,Sinta,81b9550,16141,https://isamu.id/landing/id/23?uid=81b9550,Sinta
		*/

		foreach ($array_csv as $row_csv)
		{ 
			$array_export[] = array(
				'cust_phone'	=>	$row_csv['cust_phone'],
				'cust_name'		=>	$row_csv['cust_name'],
				'variable1'		=>  GenerateName($gender),
				'variable2'		=>	$row_csv['cust_uid'],
				'variable3'		=>	$row_csv['cust_id'],
				'variable4'		=>	$row_csv['url'],
				'variable5'		=>	GenerateName($gender)
				
			);
		}

		//echo '<pre>';

		//print_r($arr_export);

		//exit();
		
		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header('Content-Type: application/csv; charset=UTF-8');

		
		// file creation 
		$file = fopen('php://output', 'w');
		CreateLog('INFO','Export batch_id = '.$batch_id.'landing_id = '.$landing_id.' txt file name :'.$filename);

		/*QISCUS HEADER
		phone_number,customer_name,variable1,variable2,variable3,variable4,variable5
		6285197553239,GraceChristin,GraceChristin,13143,f048e30,https://isamu.id/landing/id/24?uid=f048e30,Aldi
		*/

		/*QISCUS HEADER 2
		phone_number,customer_name,variable1,variable2,variable3,variable4,variable5
		6283804777481,Rezky Alfonzo,Sinta,81b9550,16141,https://isamu.id/landing/id/23?uid=81b9550,Sinta
		*/

		$header = array("phone_number","customer_name","variable1","variable2","variable3","variable4","variable5"); 

		fputcsv($file, $header);
		
		foreach ($array_export as $key=>$line){ 
		  fputcsv($file,$line); 
		}
		fclose($file); 
		//redirect('backend/broadcast');
	}

	public function result()
	{



	}
	 

	public function add()
	{
		$this->form_validation->set_rules('bc_batch_name', 'Broadcast Name','required');
		//$this->form_validation->set_rules('prod_code', 'Code','required');
		//exit();
		
		if($this->form_validation->run() == FALSE)
		{	
		
			//sidebar prop
			$data['sidebar_active'] = "sidebar_bc_batch";
			$data['collapse_active'] = "broadcast-nav";

			$data['title'] = 'Add Batch Broadcast';
			$data['template'] = 'batch_broadcast/add';
			$this->load->view('backend/index',$data);

		}
		else
		{

			$data = array
				(
					'bc_batch_name'			=> $this->input->post('cat_name'),
					'bc_batch_cust_batch_id' => $this->input->post('cat_name'),
					'bc_batch_msg'			=> $this->input->post('cat_name')

				);
			CreateLog('INFO','Add broadcast Batch');
			$this->broadcast_model->CreateBroadcastBatch($data);
			redirect('backend/broadcast');
		}	

	}
	public function delete()
	{
		$batch_id = $this->uri->segment(4);
		CreateLog('INFO','Delete broadcast Batch = '.$batch_id);
		$this->db->where('bc_batch_id',$batch_id);
		$this->db->delete('tb_bc_batch');
		$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Delete Success</div>');
		redirect('backend/broadcast');
	}
}
?>