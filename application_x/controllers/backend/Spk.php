<?php
date_default_timezone_set('Asia/Jakarta');
class Spk extends CI_Controller {

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

	function index()
	{
	
		$data['title'] = 'SISPRINT - SPK New Order';
		//sidebar prop
		$data['sidebar_active'] = "sidebar_spk";
		$data['collapse_active'] = "spk-nav";

		//data
		$this->load->library('pagination');
		$offset = $this->uri->segment(4);
		$config['base_url'] = site_url().'/backend/spk/index';
		$config['total_rows'] = count($this->spk_model->GetSpk('new',FALSE,FALSE,FALSE));
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
		
		CreateLog('INFO','load page');
		$data['urut'] = $this->uri->segment(4);
		$data['offset'] = $offset;
		$data['template'] = 'spk/index';
		$data['arr_spk'] = $this->spk_model->GetSpk('new',FALSE,$config['per_page'],$offset);
		$this->pagination->initialize($config);
		$this->load->view('backend/index',$data);
	}



	function layout()
	{

		$data['title'] = 'SISPRINT - SPK On Layout';
		//sidebar prop
		$data['sidebar_active'] = "sidebar_spk_layout";
		$data['collapse_active'] = "spk-nav";

		//data
		$this->load->library('pagination');
		$offset = $this->uri->segment(4);
		$config['base_url'] = site_url().'/backend/spk/layout';
		$config['total_rows'] = count($this->spk_model->GetSpk('layout',FALSE,FALSE,FALSE));
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
		
		CreateLog('INFO','load page');
		$data['urut'] = $this->uri->segment(4);
		$data['offset'] = $offset;
		$data['template'] = 'spk/layout';
		$data['arr_spk'] = $this->spk_model->GetSpk('layout',FALSE,$config['per_page'],$offset);
		$this->pagination->initialize($config);
		$this->load->view('backend/index',$data);
	}


	function process()
	{

		$data['title'] = 'SISPRINT - SPK On Process';
		//sidebar prop
		$data['sidebar_active'] = "sidebar_spk_process";
		$data['collapse_active'] = "spk-nav";

		//data
		$this->load->library('pagination');
		$offset = $this->uri->segment(4);
		$config['base_url'] = site_url().'/backend/spk/process';
		$config['total_rows'] = count($this->spk_model->GetSpk('process',FALSE,FALSE,FALSE));
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
		
		CreateLog('INFO','load page');
		$data['urut'] = $this->uri->segment(4);
		$data['offset'] = $offset;
		$data['template'] = 'spk/process';
		$data['arr_spk'] = $this->spk_model->GetSpk('process',FALSE,$config['per_page'],$offset);
		$this->pagination->initialize($config);
		$this->load->view('backend/index',$data);
	}

	function done()
	{

		$data['title'] = 'SISPRINT - SPK Selesai';
		//sidebar prop
		$data['sidebar_active'] = "sidebar_spk_done";
		$data['collapse_active'] = "spk-nav";

		//data
		$this->load->library('pagination');
		$offset = $this->uri->segment(4);
		$config['base_url'] = site_url().'/backend/spk/done';
		$config['total_rows'] = count($this->spk_model->GetSpk('done',FALSE,FALSE,FALSE));
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
		
		CreateLog('INFO','load page');
		$data['urut'] = $this->uri->segment(4);
		$data['offset'] = $offset;
		$data['template'] = 'spk/done';
		$data['arr_spk'] = $this->spk_model->GetSpk('done',FALSE,$config['per_page'],$offset);
		$this->pagination->initialize($config);
		$this->load->view('backend/index',$data);
	}

	function s2($offset, $search_q = FALSE){
		if($this->input->post('search_q') || $search_q!=null){
			if($this->input->post('search_q')){$teks = $this->input->post('search_q'); } else {$teks = $search_q; }  

			$data['search_q'] = $this->input->post('search_q'). $search_q;
			
			$data['arr_spk'] = $this->db->query('SELECT * FROM tb_spk LEFT JOIN tb_product ON tb_spk.spk_prod_id = tb_product.prod_id WHERE spk_status = "delivered" AND 
				 (
				 spk_id LIKE "%'.$teks.'%" OR
				 spk_no LIKE "%'.$teks.'%" OR
				 spk_inv_mp LIKE "%'.$teks.'%" OR
				 spk_prod_name LIKE "%'.$teks.'%" OR 
				 spk_qty_finish LIKE "%'.$teks.'%" OR
				 spk_store_name LIKE "%'.$teks.'%" OR
				 spk_datetime_in LIKE "%'.$teks.'%" OR
				 spk_datetime_out LIKE "%'.$teks.'%" OR
				 prod_name_mp LIKE "%'.$teks.'%"
				 )
				 ORDER BY spk_id DESC LIMIT 10 OFFSET '. $offset.' ')->result_array();
				 
			$data['row_count'] = $this->db->query('SELECT * FROM tb_spk LEFT JOIN tb_product ON tb_spk.spk_prod_id = tb_product.prod_id WHERE spk_status = "delivered" AND 
				(
				spk_id LIKE "%'.$teks.'%" OR
				spk_no LIKE "%'.$teks.'%" OR
				spk_inv_mp LIKE "%'.$teks.'%" OR
				spk_prod_name LIKE "%'.$teks.'%" OR
				spk_qty_finish LIKE "%'.$teks.'%" OR
				spk_store_name LIKE "%'.$teks.'%" OR
				spk_datetime_in LIKE "%'.$teks.'%" OR
				spk_datetime_out LIKE "%'.$teks.'%" OR
				prod_name_mp LIKE "%'.$teks.'%"
				)
				ORDER BY spk_id DESC')->num_rows();
			
			$data['title'] = 'SISPRINT - SPK Selesai Search for = '.$teks;
			$data['template'] = 'spk/s2';
			$data['current_offset'] = $offset;
			$data['sidebar_active'] = "sidebar_spk_done";
			$data['collapse_active'] = "spk-nav";
			$this->load->view('backend/index', $data);
		
		} else {
			$data['arr_spk'] = $this->spk_model->GetSpk_done(10,$offset);
			$data['row_count'] = $this->db->query('SELECT * FROM tb_spk WHERE spk_status = "delivered"')->num_rows();
			$data['title'] = 'SISPRINT - SPK Selesai';
			$data['template'] = 'spk/s2';
			$data['current_offset'] = $offset;
			$data['search_q'] = '';
			$data['sidebar_active'] = "sidebar_spk_done";
			$data['collapse_active'] = "spk-nav";
			$this->load->view('backend/index', $data);
		}
	}
	

	function do_done()
	{
		$spk_id	= $this->uri->segment(4);
		date_default_timezone_set('Asia/Jakarta');
		$time_now 	  = date('Y-m-d H:i:s');


		$data = array
		(
			'spk_status'=> 'Done',
			'spk_time_done' => $time_now
		);

		CreateLog('INFO','update data id '.$spk_id);
		$this->spk_model->UpdateSpk($spk_id,$data);

		redirect('backend/spk/process');
		
	}


	function do_process()
	{
		$spk_id	= $this->uri->segment(4);
		date_default_timezone_set('Asia/Jakarta');
		$time_now 	  = date('Y-m-d H:i:s');

		$data = array
		(
			'spk_status'=> 'Process',
			'spk_time_process' => $time_now
		);

		CreateLog('INFO','update data id '.$spk_id);
		$this->spk_model->UpdateSpk($spk_id,$data);

		redirect('backend/spk/layout');
		
	}

	public function add()
	{
		$this->form_validation->set_rules('spk_inv_mp', 'No Invoice MP','required');
		
		if($this->form_validation->run() == FALSE)
		{	
		
			//sidebar prop
			$data['sidebar_active'] = "sidebar_spk";
			$data['collapse_active'] = "spk-nav";

			
			$data['title'] = 'Add SPK';
			$data['template'] = 'spk/add';
			$this->load->view('backend/index',$data);

		}
		else
		{

			if($this->input->post('spk_prod_id')){
				$spk_prod_id = $this->input->post('spk_prod_id');
			}else{
				$spk_prod_id = 0;
			}

			if($this->input->post('spk_prod_var_id')){
				$spk_prod_var_id = $this->input->post('spk_prod_var_id');
			}else{
				$spk_prod_var_id = 0;
			}
			

			$spk_image = ($_FILES['file_image']['name']? $this->upload_file('file_image') : "");
			$spk_uid = GenUid('tb_spk',FALSE);

			$this->db->select('material_name');
			$this->db->where('material_id',$this->input->post('spk_material_id'));
			$row_material = $this->db->get('tb_material')->row();

			$inv_ = trim($this->input->post('spk_inv_mp'));

			$inv_mp = str_replace("/","-",$inv_);

			$data = array
				(
				
					'spk_uid'					=> $spk_uid,
					'spk_no'					=> 'PL'.$spk_uid,
					'spk_prod_name'				=> $this->input->post('spk_prod_name'),
					'spk_prod_name_mp'			=> $this->input->post('spk_prod_name_mp'),
					'spk_source'				=> $this->input->post('spk_source'),
					'spk_inv_mp'				=> $inv_mp,
					'spk_datetime_in'			=> date("Y-m-d H:i:s"),
					'spk_datetime_out'			=> $this->input->post('spk_datetime_out'),
					'spk_prod_id'				=> $spk_prod_id,	
					'spk_prod_var_id'			=> $spk_prod_var_id,	
					'spk_prod_mp_sku'			=> $this->input->post('spk_prod_mp_sku'),		
					'spk_prod_mp_sku_var'		=> $this->input->post('prod_var_sku_var'),		
					'spk_finish_size'			=> $this->input->post('spk_finish_size'),		
					'spk_qty_finish'			=> $this->input->post('spk_qty_finish'),				
					'spk_qty_design'			=> $this->input->post('spk_qty_design'),				
					'spk_material_name'			=> $row_material->material_name,		
					'spk_material_id'			=> $this->input->post('spk_material_id'),	
					'spk_paper_size_id'			=> $this->input->post('spk_paper_size_id'),	
					'spk_print_side'			=> $this->input->post('spk_print_side'),	
					'spk_qty_material'			=> $this->input->post('spk_qty_material'),	
					'spk_lamination'			=> $this->input->post('spk_lamination'),	
					'spk_lamination_side'		=> $this->input->post('spk_lamination_side'),	
					'spk_instruction'			=> trim($this->input->post('spk_instruction')),
					'spk_catatan'				=> trim($this->input->post('spk_catatan')),
					'spk_cutting'				=> $this->input->post('spk_cutting'),						
					'spk_image'					=> $spk_image,
					'spk_user'					=> $this->session->userdata('user_id'),
					'spk_store_name'			=> $this->input->post('spk_store_name'),	
					'spk_type'					=> $this->input->post('spk_type'),	
					'spk_proof'					=> $this->input->post('spk_proof'),	
					'spk_approve'				=> $this->input->post('spk_approve'),	
					'spk_status'				=> 'New',
					'spk_no_resi'				=> $this->input->post('spk_resi')
				);
			// create folder
		

			//load library
			$this->load->library('zend');
			//load in folder Zend
			$this->zend->load('Zend/Barcode');
			$code = 'PL'.$spk_uid;
			//generate barcode
			$barcodeOptions = array(
				'text' => $code, 
				'barHeight'=> 10, 
				'factor'=>5,
				'fontSize'=>3
				
			);
			

			//$imageResource = Zend_Barcode::factory('code128', 'image',$barcodeOptions, array())->draw();
			//imagejpeg($imageResource, CreateFolder($this->input->post('spk_inv_mp'),'PL'.$spk_uid).'\\'.$code.'.jpg');

			// QR CODE
			$this->load->library('ciqrcode');
			$params['data'] = $code;
			$params['level'] = 'L';
			$params['size'] = 10;
			$params['savename'] = CreateFolder($inv_mp,'PL'.$spk_uid).'\\'.$code.'.png';
			$this->ciqrcode->generate($params);

			// convert to jpg
			$image = imagecreatefrompng(GetImg($inv_mp,'PL'.$spk_uid).'\\'.$code.'.png');
			imagejpeg($image, GetImg($inv_mp,'PL'.$spk_uid).'\\'.$code.'.jpg', 70);
			imagedestroy($image);
			unlink(GetImg($inv_mp,'PL'.$spk_uid).'\\'.$code.'.png');

			//copy color code
			$path = GetImg($inv_mp,'PL'.$spk_uid);
			InsertColorCode($this->input->post('spk_lamination'),$path);
			

			unlink(GetImg($inv_mp,'PL'.$spk_uid).'\\'.$code.'.png');


			CreateLog('INFO','insert data');
			$this->spk_model->CreateSpk($data);
			redirect('backend/spk');
		}	
	}

	public function AjaxSearchBySKU()
	{
		$sku_mp = trim($this->input->post('sku_mp'));

		$this->db->where('prod_sku_mp',$sku_mp);
		$qr_prod = $this->db->get('tb_product');
		$row_prod = $qr_prod->row();


		if($qr_prod->num_rows()>0)
		{
			$d_spk_type 	= DropdownSPKType($row_prod->prod_type, 'spk_type');
			$data = array(
				'stat'			=> 1,
				'prod_name'		=> $row_prod->prod_name,
				'prod_name_mp'	=> $row_prod->prod_name_mp,
				'prod_id'		=> $row_prod->prod_id,
				'd_spk_type'	=> $d_spk_type
				);
		}else{
			$data = array(
				'stat'			=> 0,
				'prod_name'		=> '',
				'prod_name_mp'	=> '',
				'prod_id'	=> ''
				);

		}

		echo json_encode($data);

	}


	public function AjaxSearchBySKUVar()
	{
		$sku_var = trim($this->input->post('sku_var'));

		$expl = explode('-',$sku_var);

		$sku_induk = $expl[0];
		$sku_var   = $sku_var;

		// get data product
		$this->db->where('prod_sku_mp',$sku_induk);
		$qr_prod = $this->db->get('tb_product');
		$row_prod = $qr_prod->row();

		// get data varian
		$this->db->where('prod_var_sku_var',$sku_var);
		$qr_prod_var = $this->db->get('tb_prod_var');
		$row_prod_var = $qr_prod_var->row();

		// insert finishing into instruksi
		$ex_fin = explode('|',$row_prod_var->prod_var_finishing);

		if($ex_fin){
			foreach($ex_fin as $fin)
			{
				$r_fin[] = getDataTableById('tb_finishing','fin_name','fin_id',$fin); 
			}
	
			$data_fin = implode(' | ',$r_fin);
		}else{
			$data_fin = '';
		}




		if($qr_prod->num_rows()>0)
		{
			$d_material 	= DropdownMaterial($row_prod_var->prod_var_material_id, 'spk_material_id',FALSE);
			$d_paper_size 	= DropdownPaperSize($row_prod_var->prod_var_paper_size_id, 'spk_paper_size_id',FALSE);
			$d_print_side 	= DropdownPrintSide($row_prod_var->prod_var_print_side, 'spk_print_side');
			$d_laminasi 	= DropdownLaminasi($row_prod_var->prod_var_lamination, 'spk_lamination');
			$d_cutting 		= DropdownCutting($row_prod_var->prod_var_cutting, 'spk_cutting');
			$d_spk_type 	= DropdownSPKType($row_prod->prod_type, 'spk_type');
			$data = array(
				'stat'			=> 1,
				'd_material'	=> $d_material,
				'd_paper_size'	=> $d_paper_size,
				'd_print_side'	=> $d_print_side,
				'd_laminasi'	=> $d_laminasi,
				'd_cutting'		=> $d_cutting,
				'd_spk_type'	=> $d_spk_type,
				'prod_var_finish_size' => $row_prod_var->prod_var_finish_size,
				'prod_name'		=> $row_prod->prod_name,
				'prod_name_mp'	=> $row_prod->prod_name_mp,
				'prod_id'		=> $row_prod->prod_id,
				'prod_var_id'	=> $row_prod_var->prod_var_id,
				'prod_var_kel'	=> $row_prod_var->prod_var_kel,
				'prod_var_multiply'	=> $row_prod_var->prod_var_multiply,
				'spk_prod_mp_sku'	=> $sku_induk,
				'spk_instruction'	=> $data_fin
				);
		}else{
			$data = array(
				'stat'			=> 0,
				'prod_name'		=> '',
				'prod_name_mp'	=> '',
				'prod_id'	=> ''
				);

		}

		echo json_encode($data);

	}

	function AjaxCheckInvMp()
	{
		$inv_ = trim($this->input->post('inv_mp'));

		$inv_mp = str_replace("/","-",$inv_);

		$qr_check = $this->db->query("SELECT * FROM tb_spk
				WHERE 
				spk_inv_mp = '$inv_mp';");
		$res_check = $qr_check->result_array();

		//echo '<pre>';
		if($res_check){
			// show notif
			CreateLog('NOTIF','chcek data spk '.$inv_mp. 'exist');
			$data = array('inv_mp'=>$inv_mp,'count_data'=>count($res_check));
			echo json_encode($data);
		}

		else{
			CreateLog('NOTIF','chcek data spk '.$inv_mp. 'NOT exist');
			$data = array('inv_mp'=>$inv_mp,'count_data'=>count($res_check));
			echo json_encode($data);
		}

	}


	function AjaxShowData()
	{
		$inv_mp = trim($this->input->post('inv_mp'));

		$qr_check = $this->db->query("SELECT * FROM tb_spk
				WHERE 
				spk_inv_mp = '$inv_mp';");
		$res_check = $qr_check->result_array();

		//echo '<pre>';
		if($res_check){
			CreateLog('NOTIF','chcek data spk '.$inv_mp. 'exist');
			$data['arr_spk'] = $res_check;
			$this->load->view('backend/spk/check_inv_mp',$data);
		}

		else{
			CreateLog('NOTIF','chcek data spk '.$inv_mp. 'NOT exist');
			echo 'Data Kosong';
		}

	}
	
	function AjaxCheckBatchName()
	{
		$batch_name = trim($this->input->post('batch_name'));
		$this->db->where('batch_spk_name',$batch_name);
		$qr_check = $this->db->get('tb_batch_spk')->row();

		if($qr_check){
			//exist
			$data = array('flag' => 1,'stat' => 'exitst', 'alert'=>'Batch name '.$batch_name.' sudah ada, Auto generate nama baru');
			echo json_encode($data);

		}else{
			//not exist
			$data = array('flag' => 0,'stat' => 'no', 'alert'=>'Batch name '.$batch_name.' belum ada, Lanjut proses scan');
			echo json_encode($data);
		}
		
	}

	function AjaxInputDeadline()
	{
		$batch_spk_date_deadline = $this->input->post('batch_spk_date_deadline');
		$batch_id = $this->input->post('batch_id');

		$data = array
		(
			'batch_spk_date_deadline'=> $batch_spk_date_deadline
		);

		CreateLog('INFO','update data batch spk '.$batch_id);
		$this->db->where('batch_spk_id',$batch_id);
		$this->db->update('tb_batch_spk',$data);

		$data = array('flag' => 1,'stat' => 'success');
		echo json_encode($data);

	}


	function cetak_spk()
	{
		$spk_id	= $this->uri->segment(4);

		date_default_timezone_set('Asia/Jakarta');
		$time_now 	  = date('Y-m-d H:i:s');

		if($this->uri->segment(5) == 'cetak_process')
		
		{
			$data = array
			(
				'spk_time_layout'=> $time_now,
				'spk_status'	 => 'Layout'
			);

			CreateLog('INFO','update data id '.$spk_id);
			$this->spk_model->UpdateSpk($spk_id,$data);
		}


		
	
		$qr = $this->db->select('*');
		$qr = $this->db->from('tb_spk');
		$qr = $this->db->join('tb_product', 'tb_spk.spk_prod_id = tb_product.prod_id', 'left');
		$qr = $this->db->join('tb_user', 'tb_spk.spk_user = tb_user.user_id', 'left');
		$qr = $this->db->join('tb_material', 'tb_spk.spk_material_id = tb_material.material_id', 'left');
		$qr = $this->db->join('tb_paper_size', 'tb_spk.spk_paper_size_id = tb_paper_size.paper_size_id', 'left');
		$qr = $this->db->where('spk_id',$spk_id);
		$qr = $this->db->get();
		$row_spk = $qr->row();

		$file_pdf = $row_spk->spk_no;

		
	
		error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
        $pdf =  new PDF_Code128('P','cm',array(10.5,14.8));

		// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
		$pdf->SetMargins(0.5,0.5,0.5,0.5);

		
		//$this->fpdf->SetAutoPageBreak('auto',1);
		/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
		di footer, nanti kita akan membuat page number dengan format : number page / total page
		*/
		$pdf->AliasNbPages();
		$pdf->SetAutoPageBreak(false);
		
		// AddPage merupakan fungsi untuk membuat halaman baru
		$pdf->AddPage();
		
		//$pdf->SetFont('helvetica','',10);
		//$pdf->Cell(0,0.5,'Surat Perintah Kerja (SPK)',0,0,'C');


		$pdf->Ln(0.2);
		
		//A set
		$pdf->Ln();
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(1.5, 0.5, 'Date In',1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2.5, 0.5, $row_spk->spk_datetime_in,1,'LR','L');
		$pdf->Cell(0.4, 0.5, '',0,'LR','L');

		if($row_spk->spk_proof == 1){
			$pdf->SetFont('helvetica','B',6);
			$pdf->Cell(1.8,0.5,'PROOF PRINT',1,'LR','C');
		}else{
			$pdf->Cell(1.8,0.5,'',1,'LR','C');
		}

		if($row_spk->spk_approve == 1){
			$pdf->SetFont('helvetica','B',6);
			$pdf->Cell(2.1,0.5,'CUST. APPROVAL',1,'LR','C');
		}else{
			$pdf->Cell(2.1,0.5,'',1,'LR','C');
		}


		$pdf->SetFont('helvetica','B',6);
		$pdf->Cell(1.2, 0.5, $row_spk->spk_type,1,'LR','C');

		$pdf->Ln();
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(1.5, 0.5, 'Deadline',1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2.5, 0.5, $row_spk->spk_datetime_out,1,'LR','L');




		$pdf->Ln();
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(1.5, 0.5, 'User',1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2.5, 0.5, $row_spk->user_name,1,'LR','L');

		$pdf->Ln();
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(1.5, 0.5, 'From',1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2.5, 0.5, 'PRINTLAGI',1,'LR','L');

		$pdf->Cell(0.38, 0, '',0,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2, 0.5, 'SPK : '. $row_spk->spk_no,0,'LR','L');

		$pdf->Ln();
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(1.5, 0.5, 'Source',1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2.5, 0.5, $row_spk->spk_source,1,'LR','L');
		$pdf->Ln();
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(1.5, 0.5, 'To Store',1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2.5, 0.5, $row_spk->spk_store_name,1,'LR','L');
		$pdf->Cell(0.38, 0.5, '',0,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2, 0.7, 'INV : '. $row_spk->spk_inv_mp,0,'LR','L');


		$pdf->setFillColor(0,0,0); 
		$pdf->Code128(5,1.6,$row_spk->spk_no,5,0.7);
		$pdf->Ln(1);
		
		$pdf->Code128(5,2.9,$row_spk->spk_inv_mp,5,0.5);
		$pdf->Ln(-0.3);

		if($row_spk->spk_prod_mp_sku_var){$teks = $row_spk->spk_prod_mp_sku_var; } else {$teks = "-";}
		

		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2, 0.5, 'Nama Produk',1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(7.5, 0.5, $row_spk->spk_prod_name,1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Ln();
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2, 0.5, 'Produk MP',1,'LR','L');
		$pdf->SetFont('helvetica','I',5);
		$pdf->Cell(7.5, 0.5, $row_spk->spk_prod_name_mp,1,'LR','L');
		$pdf->Ln();
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2, 0.5, 'SKU MP',1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2.5, 0.5,$row_spk->spk_prod_mp_sku,1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2, 0.5,'SKU Varian',1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(3, 0.5,$teks,1,'LR','L');
		$pdf->Ln();

		$char = strlen($row_spk->spk_instruction);

		if($char <= 72)
		{
			$h1 = 0.5;
			$h2 = 0.5;
		}elseif ($char >= 73 && $char <= 144){
			$h1 = 0.6;
			$h2 = 0.3;
		}
		elseif ($char >= 145){
			$h1 = 0.9;
			$h2 = 0.3;
		}	



		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2, 0.5, 'Nama Folder',1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2.5, 0.5, $row_spk->spk_no,1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2, 0.5, 'Nama File',1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(3, 0.5,$row_spk->spk_no.'.pdf' ,1,'LR','L');
		$pdf->Ln();
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2, 0.5, 'Jumlah Jadi',1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2.5, 0.5, $row_spk->spk_qty_finish,1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2, 0.5, 'Ukuran Jadi',1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(3, 0.5,$row_spk->spk_finish_size ,1,'LR','L');
		$pdf->Ln();
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2, 0.5, 'Nama Bahan',1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2.5, 0.5, $row_spk->material_name,1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2, 0.5, 'Jumlah Bahan',1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(1, 0.5,$row_spk->spk_qty_material ,1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(1, 0.5, 'Ukuran',1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(1, 0.5,$row_spk->paper_size_name ,1,'LR','L');
		
		$pdf->Ln();
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2, 0.5, 'Cetak',1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2.5, 0.5, $row_spk->spk_print_side,1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2, 0.5, 'Cutting',1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(3, 0.5, $row_spk->spk_cutting,1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Ln();
		$pdf->Cell(2, 0.5, 'Laminasi',1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2.5, 0.5, $row_spk->spk_lamination,1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2, 0.5, 'Sisi Laminasi',1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(3, 0.5,$row_spk->spk_lamination_side ,1,'LR','L');
		$pdf->Ln();

		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2, $h1, 'Finishing',1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->MultiCell(7.5,$h2,$row_spk->spk_instruction, 'LRTB', 'L', 0);
		$pdf->Ln();

		$pdf->SetFont('helvetica','',5);
		$pdf->Cell(9.5, 0.3, 'Instruksi Tambahan :',0,'TLR','T');
		$pdf->Ln();
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(9.5, 2, $row_spk->spk_catatan,1,'TLR','T');
		$pdf->SetFont('helvetica','I',5);
		$pdf->Ln();
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2.2, 1, 'Admin Sign',1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2.6, 1, '',1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2.2, 1, 'CGO Sign',1,'LR','L');
		$pdf->SetFont('helvetica','',6);
		$pdf->Cell(2.5, 1, '',1,'LR','L');
		$pdf->Ln();

		$pdf->SetFont('helvetica','I',5);
		/* setting cell untuk waktu pencetakan */
		$pdf->write(0.4, 'SISPRINT | Nama File : '.$file_pdf.' | Printed on : '.mysqlDateNow().' | Created by : '.$this->session->userdata('user_display_name').' | '.$pdf->PageNo());

		/*
		$pdf->SetFont('helvetica','I',5);
		$pdf->Cell(9.5, 1, 'Potong Disini',0,'LR','L');

		$pdf->Line(0.5, 11.5,  10,  11.5);
		$pdf->Ln();
		$pdf->SetFont('helvetica','',7);
		$pdf->Cell(1.5, 0.5, 'Date In',1,'LR','L');
		$pdf->SetFont('helvetica','B',7);
		$pdf->Cell(2.5, 0.5, $row_spk->spk_datetime_in,1,'LR','L');
		$pdf->Cell(0.4, 0.5, '',0,'LR','L');
		$pdf->Ln();
		$pdf->SetFont('helvetica','',7);
		$pdf->Cell(1.5, 0.5, 'Deadline',1,'LR','L');
		$pdf->SetFont('helvetica','B',7);
		$pdf->Cell(2.5, 0.5, $row_spk->spk_datetime_out,1,'LR','L');
		$pdf->SetFont('helvetica','B',10);
		$pdf->Cell(0.38, 0.5, '',0,'LR','L');
		$pdf->Cell(2, 0.5, 'NO SPK : '. $row_spk->spk_no,0,'LR','L');
		$pdf->Ln();
		$pdf->SetFont('helvetica','',7);
		$pdf->Cell(1.5, 0.5, 'User',1,'LR','L');
		$pdf->SetFont('helvetica','B',7);
		$pdf->Cell(2.5, 0.5, $row_spk->user_name,1,'LR','L');

		$pdf->Ln();
		$pdf->SetFont('helvetica','',7);
		$pdf->Cell(1.5, 0.5, 'From',1,'LR','L');
		$pdf->SetFont('helvetica','B',7);
		$pdf->Cell(2.5, 0.5, 'PRINTLAGI',1,'LR','L');
		$pdf->Cell(0.38, 0.5, '',0,'LR','L');
		$pdf->SetFont('helvetica','B',10);
		$pdf->Cell(2, 0.5, 'INV MP : '. $row_spk->spk_inv_mp,0,'LR','L');
		
		$pdf->Ln();

		

		$pdf->Code128(5,11.9,$row_spk->spk_no,5,0.5);
		$pdf->Ln(1.3);
		
		$pdf->Code128(5,12.9,$row_spk->spk_inv_mp,5,0.5);
		$pdf->Ln(-0.4);

		*/
		
		/* setting font untuk footer */
		//$pdf->SetFont('helvetica','I',5);
		/* setting cell untuk waktu pencetakan */
		//$pdf->write(-1, 'SISPRINT | Nama File : '.$file_pdf.' | Printed on : '.mysqlDateNow().' | Created by : '.$this->session->userdata('user_display_name').' | '.$pdf->PageNo());
		/* setting cell untuk page number */
		//$this->fpdf->Cell(9.5, 0.5, 'Page '.$this->fpdf->PageNo().'/{nb}',0,0,'R');
		/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
		$pdf->Output($file_pdf,"I");
	}




	public function edit()
	{
		$this->form_validation->set_rules('prod_name', 'Product Name','required');
		//$this->form_validation->set_rules('prod_code', 'Code','required');
		//exit();
		
		if($this->form_validation->run() == FALSE)
		{	
			
			$prod_id = $this->uri->segment(4);
			$data['row_data']=$this->product_model->GetProduct(FALSE,$prod_id,FALSE,FALSE);
		
			//sidebar prop
			$data['sidebar_active'] = "sidebar_product";
			$data['collapse_active'] = "product-nav";
			$data['title'] = 'Edit Product - '.$data['row_data']->prod_name;
			$data['template'] = 'product/edit';
			$this->load->view('backend/index',$data);

		}
		else
		{
			$prod_id = $this->uri->segment(4);
			$data = $this->product_model->GetProduct(FALSE,$prod_id,FALSE,FALSE);

			if($_FILES['file_mockup']['name']){
				unlink($data->prod_img_mockup_url);
			}
			if($_FILES['file_banner']['name']){
				unlink($data->prod_img_banner_url);
			}
			if($_FILES['file_design']['name']){
				unlink($data->prod_img_design_url);
			}

			$prod_img_mockup_url = ($_FILES['file_mockup']['name']? $this->upload_file('file_mockup') : $data->prod_img_mockup_url);
			$prod_img_banner_url = ($_FILES['file_banner']['name']? $this->upload_file('file_banner') : $data->prod_img_banner_url);
			$prod_img_design_url = ($_FILES['file_design']['name']? $this->upload_file('file_design') : $data->prod_img_design_url);

			$data = array
				(
				'prod_name'				=> $this->input->post('prod_name'),
				'prod_code'				=> $this->input->post('prod_code'),
				'prod_sku'				=> $this->input->post('prod_sku'),
				'prod_desc'				=> $this->input->post('prod_desc'),
				'prod_price'			=> $this->input->post('prod_price'),
				'prod_price_disc'		=> $this->input->post('prod_price_disc'),
				'prod_img_mockup_url'	=> $prod_img_mockup_url,
				'prod_img_banner_url'	=> $prod_img_banner_url,
				'prod_img_design_url'	=> $prod_img_design_url,
				'prod_status'			=> $this->input->post('prod_status'),
				'prod_cat_id'			=> $this->input->post('prod_cat_id'),
				'prod_niche_id'			=> $this->input->post('prod_niche_id'),
				'prod_mp_link_1'		=> $this->input->post('prod_mp_link_1'),
				'prod_mp_link_2'		=> $this->input->post('prod_mp_link_2'),
				'prod_dummy_sold'		=> $this->input->post('prod_dummy_sold')
				);

			CreateLog('INFO','update data id '.$prod_id);
			$this->product_model->UpdateProduct($prod_id,$data);
			redirect('backend/product');
		}	
	}

	public function delete()
	{
		$spk_id = $this->uri->segment(4);
		$data = $this->spk_model->GetSpk(FALSE,$spk_id,FALSE,FALSE);

		//echo $_SERVER['DOCUMENT_ROOT'].'/'.$data->prod_img_mockup_url;
		//exit();
		unlink($data->spk_image);
		$this->spk_model->DeleteSpk($spk_id);
		CreateLog('INFO','delete data id '.$spk_id);
		$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Delete Success</div>');
		redirect('backend/spk');
	}

	private function upload_file($file)
	{
		$config['upload_path']          = $this->config->item("upload_path_photo");
		$config['allowed_types']        = '*';
		$config['upload_path_temp']     = $this->config->item("upload_path_temp");
		$config['max_size'] = 5000;


		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		//print_r($_FILES['file_mockup']);

		//exit();
		if (!$this->upload->do_upload($file)) 
		{
			print_r($_FILES[$file]);
			echo $this->upload->display_errors();
			exit();
		} 
		else 
		{
			$uploaded_data = $this->upload->data();
			$path = $config['upload_path'].''. $uploaded_data['file_name'];
			return $path;
		}

	}
	
	

}
?>