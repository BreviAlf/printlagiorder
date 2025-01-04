<?php
class Product extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->model('product_model');
		if(!$this->session->userdata('user_id') && !$this->session->userdata('user_display_name') ):
			redirect('login');
		elseif($this->session->userdata('user_rule')=='Frontend'):
			redirect('no_access');
		endif;
	}

	function index()
	{

		$data['title'] = 'SISPRINT - Product';
		//sidebar prop
		$data['sidebar_active'] = "sidebar_product";
		$data['collapse_active'] = "product-nav";

		//data
		$this->load->library('pagination');
		$offset = $this->uri->segment(4);
		$config['base_url'] = site_url().'/backend/product/index';
		$config['total_rows'] = count($this->product_model->GetProduct('all',FALSE,FALSE,FALSE));
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
		$data['template'] = 'product/index';
		$data['arr_product'] = $this->product_model->GetProduct('all',FALSE,$config['per_page'],$offset);
		$this->pagination->initialize($config);
		$this->load->view('backend/index',$data);
		

	}



	public function add()
	{
		$this->form_validation->set_rules('prod_name', 'Product Name','required');
		$this->form_validation->set_rules('prod_name_mp', 'Product Name MP','required');
		$this->form_validation->set_rules('prod_sku', 'SKU','required');
		$this->form_validation->set_rules('prod_sku_mp', 'SKU MP','required');
		
		if($this->form_validation->run() == FALSE)
		{	
		
			//sidebar prop
			$data['sidebar_active'] = "sidebar_product";
			$data['collapse_active'] = "product-nav";

			
			$data['title'] = 'SISPRINT - Add Product';
			$data['template'] = 'product/add';
			$this->load->view('backend/index',$data);

		}
		else
		{

			$prod_img_mockup_url = ($_FILES['file_mockup']['name']? $this->upload_file('file_mockup') : "");

			$data = array
				(
				'prod_name'				=> trim($this->input->post('prod_name')),
				'prod_name_mp'			=> trim($this->input->post('prod_name_mp')),
				'prod_sku'				=> trim($this->input->post('prod_sku')),
				'prod_sku_mp'			=> trim($this->input->post('prod_sku_mp')),
				'prod_desc'				=> trim($this->input->post('prod_desc')),
				'prod_price'			=> $this->input->post('prod_price'),
				'prod_price_disc'		=> 0,
				'prod_img_mockup_url'	=> $prod_img_mockup_url,
				'prod_status'			=> $this->input->post('prod_status'),
				'prod_cat_id'			=> $this->input->post('prod_cat_id'),
				'prod_niche_id'			=> $this->input->post('prod_niche_id'),
				'prod_mp_link_1'		=> trim($this->input->post('prod_mp_link_1')),
				'prod_mp_link_2'		=> trim($this->input->post('prod_mp_link_2')),
				'prod_dummy_sold'		=> 0
				);

			CreateLog('INFO','insert data');
			$this->product_model->CreateProduct($data);
			redirect('backend/product');
		}	
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

			$this->db->where('prod_var_prod_id',$prod_id);
			$this->db->order_by('prod_var_sku_var','asc');
			$data["arr_var"] = $this->db->get('tb_prod_var')->result_array();
		
			//sidebar prop
			$data['sidebar_active'] = "sidebar_product";
			$data['collapse_active'] = "product-nav";
			$data['title'] = 'SISPRINT - Edit Product - '.$data['row_data']->prod_name;
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

			$prod_img_mockup_url = ($_FILES['file_mockup']['name']? $this->upload_file('file_mockup') : $data->prod_img_mockup_url);

			$data = array
				(
				'prod_name'				=> trim($this->input->post('prod_name')),
				'prod_name_mp'			=> trim($this->input->post('prod_name_mp')),
				'prod_sku'				=> trim($this->input->post('prod_sku')),
				'prod_sku_mp'			=> trim($this->input->post('prod_sku_mp')),
				'prod_desc'				=> trim($this->input->post('prod_desc')),
				'prod_price'			=> $this->input->post('prod_price'),
				'prod_price_disc'		=> 0,
				'prod_img_mockup_url'	=> $prod_img_mockup_url,
				'prod_status'			=> $this->input->post('prod_status'),
				'prod_cat_id'			=> $this->input->post('prod_cat_id'),
				'prod_niche_id'			=> $this->input->post('prod_niche_id'),
				'prod_mp_link_1'		=> trim($this->input->post('prod_mp_link_1')),
				'prod_mp_link_2'		=> trim($this->input->post('prod_mp_link_2')),
				'prod_dummy_sold'		=> 0
				);

			CreateLog('INFO','update data id '.$prod_id);
			$this->product_model->UpdateProduct($prod_id,$data);
			redirect('backend/product');
		}	
	}

	public function delete()
	{
		$prod_id = $this->uri->segment(4);
		$data = $this->product_model->GetProduct(FALSE,$prod_id,FALSE,FALSE);

		//echo $_SERVER['DOCUMENT_ROOT'].'/'.$data->prod_img_mockup_url;
		//exit();
		unlink($data->prod_img_mockup_url);
		unlink($data->prod_img_banner_url);
		unlink($data->prod_img_design_url);
		$this->product_model->DeleteProduct($prod_id);
		CreateLog('INFO','delete data id '.$prod_id);
		$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Delete Success</div>');
		redirect('backend/product');
	}

	public function AjaxCheckSave()
	{
		$sku_mp = $this->input->post('sku_mp');
		$this->db->where('prod_sku_mp',$sku_mp);
		$qr_prod = $this->db->get('tb_product');
		$row_prod = $qr_prod->row();

		if($qr_prod->num_rows()>0)
		{
			$data = array(
				'stat'			=> 1,
				'prod_name'		=> $row_prod->prod_name,
				'prod_name_mp'	=> $row_prod->prod_name_mp,
				'prod_sku_mp'	=> $row_prod->prod_sku_mp
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


	public function AjaxAddVarian()
	{
		// save varian

		if($this->input->post('cfin')){
			$cfin = implode('|',$this->input->post('cfin'));
		}else{
			$cfin = "";
		}

		$this->db->select('material_name');
		$this->db->where('material_id',$this->input->post('prod_var_material_id'));
		$row_material = $this->db->get('tb_material')->row();

		$data = array
		(
			'prod_var_prod_id'			=> trim($this->input->post('prod_var_prod_id')),
			'prod_var_name'				=> trim($this->input->post('prod_var_name')),
			'prod_var_sku_var'			=> trim($this->input->post('prod_var_sku_var')),
			'prod_var_finish_size'		=> $this->input->post('prod_var_finish_size'),
			'prod_var_material_name'	=> $row_material->material_name,
			'prod_var_material_id'		=> $this->input->post('prod_var_material_id'),
			'prod_var_paper_size_id'	=> $this->input->post('prod_var_paper_size_id'),
			'prod_var_print_side'		=> $this->input->post('prod_var_print_side'),
			'prod_var_lamination'		=> $this->input->post('prod_var_lamination'),
			'prod_var_cutting'			=> $this->input->post('prod_var_cutting'),
			'prod_var_finishing'		=> $cfin,
			'prod_var_kel'				=> $this->input->post('prod_var_kel'),
			'prod_var_multiply'			=> $this->input->post('prod_var_multiply')
		);

		CreateLog('INFO','insert data');
		$this->db->insert('tb_prod_var', $data);

		$this->db->where('prod_var_prod_id',$this->input->post('prod_var_prod_id'));
		$this->db->order_by('prod_var_sku_var','asc');
		$data["arr_var"] = $this->db->get('tb_prod_var')->result_array();
		$this->load->view('backend/product/data_var',$data);
	}

	public function AjaxSaveEdit()
	{
		// save varian
		if($this->input->post('cfin')){
			$cfin = implode('|',$this->input->post('cfin'));
		}else{
			$cfin = "";
		}
		

		$this->db->select('material_name');
		$this->db->where('material_id',$this->input->post('prod_var_material_id'));
		$row_material = $this->db->get('tb_material')->row();

		$data = array
		(
			'prod_var_prod_id'			=> trim($this->input->post('prod_var_prod_id')),
			'prod_var_name'				=> trim($this->input->post('prod_var_name')),
			'prod_var_sku_var'			=> trim($this->input->post('prod_var_sku_var')),
			'prod_var_finish_size'		=> $this->input->post('prod_var_finish_size'),
			'prod_var_material_name'	=> $row_material->material_name,
			'prod_var_material_id'		=> $this->input->post('prod_var_material_id'),
			'prod_var_paper_size_id'	=> $this->input->post('prod_var_paper_size_id'),
			'prod_var_print_side'		=> $this->input->post('prod_var_print_side'),
			'prod_var_lamination'		=> $this->input->post('prod_var_lamination'),
			'prod_var_cutting'			=> $this->input->post('prod_var_cutting'),
			'prod_var_finishing'		=> $cfin,
			'prod_var_kel'				=> $this->input->post('prod_var_kel'),
			'prod_var_multiply'			=> $this->input->post('prod_var_multiply')
		);

		CreateLog('INFO','update data');
		$this->db->where('prod_var_id', $this->input->post('prod_var_id'));
		$this->db->update('tb_prod_var', $data);

		$this->db->where('prod_var_prod_id',$this->input->post('prod_var_prod_id'));
		$this->db->order_by('prod_var_sku_var','asc');
		$data["arr_var"] = $this->db->get('tb_prod_var')->result_array();
		$this->load->view('backend/product/data_var',$data);
	}

	public function AjaxDelVar()
	{
		$prod_var_id = $this->input->post('prod_var_id');
		$prod_id 	 = $this->input->post('prod_id');

		$this->db->where('prod_var_id',$prod_var_id);
		$this->db->delete('tb_prod_var');


		$this->db->where('prod_var_prod_id',$prod_id);
		$this->db->order_by('prod_var_sku_var','asc');
		$data["arr_var"] = $this->db->get('tb_prod_var')->result_array();
		$this->load->view('backend/product/data_var',$data);
	}

	public function AjaxEditVar()
	{
		$prod_var_id = $this->input->post('prod_var_id');
		$prod_id 	 = $this->input->post('prod_id');

		$this->db->where('prod_var_id',$prod_var_id);
		$data['row_var'] = $this->db->get('tb_prod_var')->row();

		$this->load->view('backend/product/edit_var',$data);

	}

	public function AjaxCopyVar()
	{
		$prod_var_id = $this->input->post('prod_var_id');
		$prod_id 	 = $this->input->post('prod_id');

		$this->db->where('prod_var_id',$prod_var_id);
		$row_cp = $this->db->get('tb_prod_var')->row();

		$randomNum=substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0,3);
		$rand_name = $row_cp->prod_var_name.' - '.$randomNum;
		$rand_sku  = $row_cp->prod_var_sku_var.'-'.$randomNum;

		// copy data insert
		$data = array
		(
			'prod_var_prod_id'			=> $row_cp->prod_var_prod_id,
			'prod_var_name'				=> $row_cp->prod_var_name,
			'prod_var_sku_var'			=> $rand_sku,
			'prod_var_finish_size'		=> $row_cp->prod_var_finish_size,
			'prod_var_material_name'	=> $row_cp->prod_var_material_name,
			'prod_var_material_id'		=> $row_cp->prod_var_material_id,
			'prod_var_paper_size_id'	=> $row_cp->prod_var_paper_size_id,
			'prod_var_print_side'		=> $row_cp->prod_var_print_side,
			'prod_var_lamination'		=> $row_cp->prod_var_lamination,
			'prod_var_cutting'			=> $row_cp->prod_var_cutting,
			'prod_var_finishing'		=> $row_cp->prod_var_finishing,
			'prod_var_kel'				=> $row_cp->prod_var_kel,
			'prod_var_multiply'			=> $row_cp->prod_var_multiply
		);

		CreateLog('INFO','insert data');
		$this->db->insert('tb_prod_var', $data);


		$this->db->where('prod_var_prod_id',$prod_id);
		$this->db->order_by('prod_var_sku_var','asc');
		$data["arr_var"] = $this->db->get('tb_prod_var')->result_array();
		$this->load->view('backend/product/data_var',$data);
	}

	public function csv_download()
	{
		$this->load->helper('download');
		$pth    =   file_get_contents(base_url()."public/sample/csv_product.csv");
		$nme    =   "csv_product.csv";
		force_download($nme, $pth);   
	}

	public function export()
	{
		$arr_data_csv = $this->db->query("
		SELECT
			tb_product.prod_id,
			tb_product.prod_code,
			tb_product.prod_sku,
			tb_product.prod_name,
			tb_product.prod_price,
			tb_product.prod_price_disc,
			tb_category.cat_name,
			tb_niche.niche_name,
			CONCAT('250') AS berat
		FROM
			tb_product
		JOIN tb_category ON tb_category.cat_id = tb_product.prod_cat_id
		JOIN tb_niche ON tb_niche.niche_id = tb_product.prod_niche_id
		")->result_array();

		$this->exportCSV($arr_data_csv,'PRODUCT');

	}



	private function exportCSV($array_csv,$file_name)
	{ 
		// file name 
		$filename = $file_name.'_'.date('Ymd_his').'.csv'; 
		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header('Content-Type: application/csv; charset=UTF-8');

		
		// file creation 
		$file = fopen('php://output', 'w');


	  
		$header = array("prod_id","prod_code","prod_sku","prod_name","prod_price","prod_price_disc","cat_name","niche_name","berat"); 
		fputcsv($file, $header);
		CreateLog('INFO','Export txt file name :'.$filename);
		foreach ($array_csv as $key=>$line){ 
		  fputcsv($file,$line); 
		}
		fclose($file); 
		//redirect('backend/broadcast');
	}

	public function upload_csv()
	{

		$filename = $_FILES['file_product']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		$path = '';

		if($ext == 'csv' || $ext == 'CSV')
		{
			$file_csv = ($_FILES['file_product']['name']? $this->upload_file_csv('file_product') : "");
			CreateLog('INFO','upload file '.$file_csv);
			if($file_csv)
			{
				if (($handle = fopen($file_csv, "r")) !== FALSE) 
				{	
					$arr_data = array();
					$first = true;
					CreateLog('INFO','loop start');
					while (($data = fgetcsv($handle, 5000, ",")) !== FALSE) 
					{
						if($first) { $first = false; continue; }
						$arr_data[] = array
						( 			
							'prod_name'			=> trim($data[0]),			
							'prod_code'			=> trim($data[1]),			
							'prod_sku'			=> trim($data[2]),			
							'prod_price'		=> trim($data[3]),			
							'prod_price_disc'	=> trim($data[4]),			
							'prod_desc'			=> trim($data[5]),		
							'prod_img_id'		=> trim($data[6]),			
							'prod_img_mockup_url'	=> 'public/photo/'.trim($data[7]),			
							'prod_img_banner_url'	=> 'public/photo/'.trim($data[8]),			
							'prod_img_design_url'	=> 'public/photo/'.trim($data[9]),			
							'prod_status'		=> 'Y',					
							'prod_cat_id'		=> trim($data[10]),			
							'prod_niche_id'		=> trim($data[11]),		
							'prod_mp_link_1'	=> trim($data[12]),			
							'prod_mp_link_2'	=> trim($data[13]),			
							'prod_dummy_sold'	=> trim($data[14])			
						);	
					
					}

					//echo '<pre>';
					fclose($handle);
					CreateLog('INFO','loop end '.count($arr_data));
					$data['file_csv'] = $file_csv;
					$data['arr_product'] = $arr_data;
					$this->load->view('backend/product/ajax_upload_csv',$data);

				}
			}
			else
			{
				echo '<div id="alert_box" class="alert alert-danger">Complete Field!!</div>';
			}
		}
		else
		{
			echo '<div id="alert_box" class="alert alert-danger">Only csv file allowed</div>';
		}
	}

	public function upload_link_shopee()
	{

		$filename = $_FILES['file_link_shopee']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		$path = '';

		if($ext == 'txt' || $ext == 'TXT')
		{
			$file_csv = ($_FILES['file_link_shopee']['name']? $this->upload_file_csv('file_link_shopee') : "");
			CreateLog('INFO','upload file txt link '.$file_csv);
			if($file_csv)
			{
				if (($handle = fopen($file_csv, "r")) !== FALSE) 
				{	
					$arr_data = array();
					CreateLog('INFO','loop start');
					while (! feof($handle)) 
					{
						$raw = trim(fgets($handle));
						$ex_1 = explode("-i",$raw);
						$ex_2 = explode("-",$ex_1[0]);
						$index = count($ex_2) - 1;
						$prod_sku = $ex_2[$index];

						$prod_data = $this->db->query("SELECT prod_id,prod_name FROM tb_product WHERE prod_sku = '$prod_sku' LIMIT 1")->row();

						if($prod_data){
							$prod_id	= $prod_data->prod_id;
							$prod_name  = $prod_data->prod_name;
						}else{
							$prod_id	= 'NOT FOUND';
							$prod_name  = 'NOT FOUND';
						}

						$arr_data[] = array
						( 			
							'prod_link'			=> $raw,					
							'prod_sku'			=> $ex_2[$index],
							'prod_id'			=> $prod_id,
							'prod_name'			=> $prod_name
						);	
					
					}

					//echo '<pre>';
					fclose($handle);
					CreateLog('INFO','loop end '.count($arr_data));

					$data['file_csv'] = $file_csv;
					$data['arr_product'] = $arr_data;
					$this->load->view('backend/product/ajax_upload_link_shopee',$data);

				}
			}
			else
			{
				echo '<div id="alert_box" class="alert alert-danger">Complete Field!!</div>';
			}
		}
		else
		{
			echo '<div id="alert_box" class="alert alert-danger">Only txt file allowed</div>';
		}
	}

	public function AjaxContinueLinkShopee()
	{

		$file_csv = $this->input->post('file_csv');
		CreateLog('INFO','upload');
		if($file_csv)
		{
			if (($handle = fopen($file_csv, "r")) !== FALSE) 
			{	
				$arr_data = array();
				CreateLog('INFO','loop start');
				while (! feof($handle)) 
				{
					$raw = trim(fgets($handle));
					$ex_1 = explode("-i",$raw);
					$ex_2 = explode("-",$ex_1[0]);
					$index = count($ex_2) - 1;
					$prod_sku = $ex_2[$index];

					$link = $raw;

					$prod_data = $this->db->query("SELECT prod_id,prod_name FROM tb_product WHERE prod_sku = '$prod_sku' LIMIT 1")->row();

					if($prod_data){
						$prod_id	= $prod_data->prod_id;
						$prod_name  = $prod_data->prod_name;

						$arr_data[] = array
						( 		
							'prod_id'			=> $prod_id,	
							'prod_mp_link_1'	=> $link,					
							'prod_mp_link_2'	=> $link
							
						);	
					}
				}

				CreateLog('INFO','update data');
				$this->db->update_batch('tb_product',$arr_data, 'prod_id'); 

				echo '<div id="alert_box" class="alert alert-success">Upload Success <br><p> Reload in <span id="countdowntimer">3 </span> Seconds</p></div>';
			}
		}
		else
		{
			echo '<div id="alert_box" class="alert alert-danger">Upload Field!!</div>';
		}

	}

	public function AjaxChangeImageSize()
	{
		$cat_id = $this->input->post('cat_id');
		$this->db->where('cat_id',$cat_id);
		$row = $this->db->get('tb_category')->row();

		$url = $row->cat_img_size_guide_url;

		echo site_url().''.$url;
	}

	public function AjaxContinueUpload()
	{

		$file_csv = $this->input->post('file_csv');
		CreateLog('INFO','upload');
		if($file_csv)
		{
			if (($handle = fopen($file_csv, "r")) !== FALSE) 
			{	
				$arr_data = array();
				$first = true;
				while (($data = fgetcsv($handle, 5000, ",")) !== FALSE) 
				{
					if($first) { $first = false; continue; }
					CreateLog('INFO','loop start ');
					$arr_data[] = array
					( 			
						'prod_name'			=> trim($data[0]),			
						'prod_code'			=> trim($data[1]),			
						'prod_sku'			=> trim($data[2]),			
						'prod_price'		=> trim($data[3]),			
						'prod_price_disc'	=> trim($data[4]),			
						'prod_desc'			=> trim($data[5]),		
						'prod_img_id'		=> trim($data[6]),			
						'prod_img_mockup_url'	=> 'public/photo/'.trim($data[7]),			
						'prod_img_banner_url'	=> 'public/photo/'.trim($data[8]),			
						'prod_img_design_url'	=> 'public/photo/'.trim($data[9]),			
						'prod_status'		=> 'Y',					
						'prod_cat_id'		=> trim($data[10]),			
						'prod_niche_id'		=> trim($data[11]),		
						'prod_mp_link_1'	=> trim($data[12]),			
						'prod_mp_link_2'	=> trim($data[13]),			
						'prod_dummy_sold'	=> trim($data[14])	
					);	
					
				}
				CreateLog('INFO','loop end '.count($arr_data));
				CreateLog('INFO','insert data');
				$this->db->insert_batch('tb_product',$arr_data);
				echo '<div id="alert_box" class="alert alert-success">Upload Success <br><p> Reload in <span id="countdowntimer">3 </span> Seconds</p></div>';

			}
		}
		else
		{
			echo '<div id="alert_box" class="alert alert-danger">Upload Field!!</div>';
		}

	}


	public function AjaxAddColor()
	{

		$color = $this->input->post('color');
		$prod_id = $this->input->post('prod_id');
		$var_1 = $this->input->post('var_1');

		// update table product

		$data = array
				(
				'prod_var_1'			=> $var_1
				);
		CreateLog('INFO','update data var_1 id '.$prod_id);
		$this->product_model->UpdateProduct($prod_id,$data);

			
		if(trim($color)):
			if(CheckInput($color)):
				// check parent
				$this->db->where('color_prod_id',$prod_id);
				$arr_color =  $this->db->get('tb_color')->result_array();
				if($arr_color){
					$parent = 'N';
				}else{
					$parent = 'Y';
				}
				
				// insert table color
				$data2 = array
						(
						'color_prod_id'			=> $prod_id,
						'color_name'			=> $color,
						'color_hex'				=> 'dummy',
						'color_add_price'		=> 0,
						'color_img_url'			=> 'dummy',
						'color_parent'			=> $parent
						);
				$this->db->insert('tb_color',$data2);
				$color_id = $this->db->insert_id();
				CreateLog('INFO','add color '.$color.'on prod id '.$prod_id);
				// check size

				if($parent == 'N'){

					$parent_color = $this->db->where('color_prod_id',$prod_id);
					$parent_color = $this->db->where('color_parent','Y');
					$parent_color = $this->db->get('tb_color')->row();

					$this->db->where('size_color_id',$parent_color->color_id);
					$arr_size = $this->db->get('tb_stock_size')->result_array();

					foreach ($arr_size as $size)
					{
						$data3 = array
						(
						'uid'					=> md5(uniqid()),
						'size_color_id'			=> $color_id,
						'size_prod_id'			=> $prod_id,
						'size_name'				=> $size['size_name'],
						'size_add_price'		=> 0,
						'size_add_weight'		=> 100,
						'size_stock'			=> 1,
						'size_ordering'			=> $size['size_ordering']
						);
						$this->db->insert('tb_stock_size',$data3);
					}

					
					CreateLog('INFO','add tb_stock_size loop from tb_stock_size where size_color_id = '.$color_id.' on prod id '.$prod_id);

				}
			endif;
		endif;
		$this->db->where('color_prod_id', $prod_id);
		$arr_data = $this->db->get('tb_color')->result_array();

		$data['arr_color'] = $arr_data;
		$data['prod_id'] = $prod_id;
		$this->load->view('backend/product/ajax_color',$data);
	}

	public function AjaxDeleteColor()
	{
		$color_id = $this->input->post('color_id');
		$prod_id = $this->input->post('prod_id');

		// check parent
		$this->db->where('color_id',$color_id);
		$this->db->where('color_parent','Y');
		$parent_color =  $this->db->get('tb_color')->row();

		if($parent_color){
			// check other color
			$this->db->where('color_prod_id', $prod_id);
			$qr_check = $this->db->get('tb_color');

			if ($qr_check->num_rows() == 1){

				$this->db->where('size_color_id',$color_id);
				$this->db->delete('tb_stock_size');
				CreateLog('INFO','parent color found DELETE tb_size_stock '.$color_id.'on prod id '.$prod_id);

				$this->db->where('color_id',$color_id);
				$this->db->delete('tb_color');
				CreateLog('INFO','delete tb_color color id'.$color_id.'on prod id '.$prod_id);
				
			}else{
				echo '<script type="text/javascript">alert("DELETE FAILED ' . $parent_color->color_name . ' is parent");</script>';
			}
			
		}
		else
		{
			$this->db->where('size_color_id',$color_id);
			$this->db->delete('tb_stock_size');
			CreateLog('INFO','parent color found DELETE tb_size_stock '.$color_id.'on prod id '.$prod_id);

			$this->db->where('color_id',$color_id);
			$this->db->delete('tb_color');
			CreateLog('INFO','delete tb_color color id'.$color_id.'on prod id '.$prod_id);

		}
		
		$this->db->where('color_prod_id', $prod_id);
		$arr_data = $this->db->get('tb_color')->result_array();

		$data['arr_color'] = $arr_data;
		$data['prod_id'] = $prod_id;
		$this->load->view('backend/product/ajax_color',$data);
	}



	public function AjaxAddSize()
	{

		$size = $this->input->post('size');
		$color_id = $this->input->post('color_id');
		$prod_id = $this->input->post('prod_id');
		$var_2 = $this->input->post('var_2');

		// update table product

		$data = array
				(
				'prod_var_2'			=> $var_2
				);
		CreateLog('INFO','update data prod_var_2 id '.$prod_id);
		$this->db->where('prod_id',$prod_id);
		$this->db->update('tb_product',$data);

		// update table color
		$this->db->where('color_prod_id',$prod_id);
		$arr_color = $this->db->get('tb_color')->result_array();
		
		if(trim($size)):
			if(CheckInput($size)):
				foreach ($arr_color as $color):
					// get count for ordering
					$this->db->where('size_color_id',$color['color_id']);
					$this->db->select_max('size_ordering');
					$res = $this->db->get('tb_stock_size');

					if($res->num_rows() > 0){
						$order = $res->row()->size_ordering + 1;
					}else{
						$order = 1;
					}

					$data2 = array
							(
							'uid'					=> md5(uniqid()),
							'size_color_id'			=> $color['color_id'],
							'size_prod_id'			=> $prod_id,
							'size_name'				=> $size,
							'size_add_price'		=> 0,
							'size_add_weight'		=> 100,
							'size_stock'			=> 1,
							'size_ordering'			=> $order,
							);
					$this->db->insert('tb_stock_size',$data2);
				endforeach;
			CreateLog('INFO','add tb_stock_size '.$size.'on prod id '.$prod_id);
			endif;
		endif;
		$data['arr_size'] = GetSize($prod_id,'Y');
		$data['prod_id'] = $prod_id;
		$this->load->view('backend/product/ajax_size',$data);
	}

	public function AjaxDeleteSize()
	{
		$color_id 	= $this->input->post('color_id');
		$uid 	= $this->input->post('uid');
		$size_name 	= $this->input->post('size_name');
		$prod_id 	= $this->input->post('prod_id');

		$this->db->where('size_prod_id',$prod_id);
		$this->db->where('size_name',$size_name);
		$this->db->delete('tb_stock_size');

		CreateLog('INFO','delete tb_stock_size name'.$size_name.'on prod id '.$prod_id);

		$data['arr_size'] = GetSize($prod_id,'Y');
		$data['prod_id'] = $prod_id;
		$this->load->view('backend/product/ajax_size',$data);
	}


	public function AjaxUpdateVar()
	{
		$type 		= $this->input->post('type');
		$prod_id 	= $this->input->post('prod_id');
		$var_1 		= $this->input->post('var_1');
		$var_2 		= $this->input->post('var_2');

		if($type == 'var_1')
		{
			$data = array
			(
				'prod_var_1'			=> $var_1
			);
			CreateLog('INFO','update data prod_var_1  '.$prod_id.' set '.$var_1);
		}
		else if ($type == 'var_2')
		{	
			$data = array
			(
				'prod_var_2'			=> $var_2
			);
			CreateLog('INFO','update data prod_var_2  '.$prod_id.' set '.$var_2);
		}
		$this->db->where('prod_id',$prod_id);
		$this->db->update('tb_product',$data);

	}


	public function AjaxLoadVarian()
	{
		$prod_id = $this->input->post('prod_id');
		$data['arr_size'] = GetAllSize($prod_id);
		$data['prod_id'] = $prod_id;
		$this->load->view('backend/product/ajax_load_varian',$data);
	}

	public function AjaxLoadSize()
	{
		$prod_id = $this->input->post('prod_id');
		$data['arr_size'] = GetSize($prod_id,'Y');
		$data['prod_id'] = $prod_id;
		$this->load->view('backend/product/ajax_size',$data);
	}


	private function upload_file($file)
	{
		$config['upload_path']          = $this->config->item("upload_path_photo");
		$config['allowed_types']        = '*';
		$config['upload_path_temp']     = $this->config->item("upload_path_temp");
		$config['max_size'] = 2000;


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

	public function AjaxUpdateSizeStock()
	{
		$prod_id = $this->input->post('prod_id');

		// lets loop post data hahahaha
		$this->db->where('size_prod_id',$prod_id);
		$arr_size = $this->db->get('tb_stock_size')->result_array();
		$update_array = array();
		foreach ($arr_size as $row)
		{
			$update_array[] = array (
				'uid' => $row['uid'],
				'size_add_price' => $this->input->post('size_add_price_'.$row['uid']),
				'size_sku' => $this->input->post('size_sku_'.$row['uid']),
				'size_stock' => $this->input->post('size_stock_'.$row['uid'])
			);
		}

		$this->db->update_batch('tb_stock_size',$update_array, 'uid'); 

		$data['prod_id'] = $prod_id;
		$this->load->view('backend/product/ajax_load_varian',$data);
	}

	private function upload_file_csv($file)
	{
		$config['upload_path']          = $this->config->item("upload_path_temp");
		$config['allowed_types']        = '*';
		$config['upload_path_temp']     = $this->config->item("upload_path_temp");
		$config['max_size'] = 2000;


		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		//print_r($_FILES['file_mockup']);

		//exit();
		if (!$this->upload->do_upload($file)) 
		{
			print_r($_FILES[$file]);
			echo $this->upload->display_errors();
			CreateLog('ERROR','upload file error '.$this->upload->display_errors());
			exit();
		} 
		else 
		{
			$uploaded_data = $this->upload->data();
			$path = $config['upload_path'].''. $uploaded_data['file_name'];
			CreateLog('INFO','upload file success '.$path);
			return $path;
		}

	}

	public function export_shopee()
	{
		$code_cat	 = $this->input->post('code_cat');
		$code_intg = $this->input->post('code_intg');
		$color_size = $this->input->post('color_size');
		$weight = $this->input->post('weight');
		$kurir_1 = $this->input->post('kurir_1');
		$kurir_2 = $this->input->post('kurir_2');
		$kurir_3 = $this->input->post('kurir_3');
	
		$size_p = $this->input->post('size_p');
		$size_l = $this->input->post('size_l');
		$size_t = $this->input->post('size_t');

		$prod_cat_id = $this->input->post('prod_cat_id');
		$prod_niche_id = $this->input->post('prod_niche_id');
		$size_guide_url = $this->input->post('size_guide_url');
		$default_weight = 500;

		$var_1 = 'Warna';
		$var_2 = 'Ukuran';
		$var_code = '';

		
		
		header('Content-Type: text/csv; charset=utf-8'); 
		header('Content-Disposition: attachment; filename=product_shopee.csv'); 
		$output = fopen("php://output", "w"); 

		fputcsv($output, array(
			'Kategori',
			'Nama Produk',
			'Deskripsi Produk',
			'SKU Induk',
			'Product Berbahaya',
			'Kode Integrasi',
			'Nama Variasi 1',
			'Varian untuk Variasi 1',
			'Foto Produk per Varian',
			'Nama Variasi 2',
			'Varian untuk Variasi 2',
			'Harga',
			'Stok',
			'Kode Variasi',
			'Foto Sampul',
			'Foto Produk 1',
			'Foto Produk 2',
			'Foto Produk 3',
			'Foto Produk 4',
			'Foto Produk 5',
			'Foto Produk 6',
			'Foto Produk 7',
			'Foto Produk 8',
			'Berat',
			'Panjang',
			'Lebar',
			'Tinggi',
			'Jasa Kirim 1',
			'Jasa Kirim 2',
			'Jasa Kirim 3'
			)
		); 

		

		if($color_size == 1)
		{
			$arr_product = $this->db->query(
				"SELECT 
				tb_product.prod_id,
				tb_product.prod_name, 
				tb_product.prod_desc, 
				tb_product.prod_sku, 
				tb_product.prod_img_mockup_url, 
				tb_product.prod_img_design_url, 
				tb_product.prod_base_weight, 
				tb_product.prod_price_disc, 
				tb_product.prod_price, 
				tb_color.color_name,
				tb_color.color_add_price,
				tb_stock_size.size_name,
				tb_stock_size.size_add_weight,
				tb_stock_size.size_add_price,
				tb_stock_size.size_stock
				from tb_product
				LEFT OUTER JOIN tb_color on tb_color.color_prod_id = tb_product.prod_id
				LEFT OUTER JOIN tb_stock_size on tb_stock_size.size_color_id = tb_color.color_id
				WHERE tb_product.prod_cat_id = $prod_cat_id AND tb_product.prod_niche_id = $prod_niche_id
				"
				)->result_array();

			$arr = array();
			foreach($arr_product as $row_product)
			{

				// custom var
				$prod_name = 'Isamu - '.$row_product['prod_name'].' | '.$row_product['color_name'].' - '.$row_product['prod_sku'];
				$var_code = $row_product['prod_sku'].''.$row_product['size_name'];
				$price = $row_product['prod_price'] + $row_product['color_add_price'] + $row_product['size_add_price'];

								
				if($weight == 1){
					$actual_weight = $row_product['prod_base_weight']+$row_product['size_add_weight'];
				}else{
					$actual_weight = $default_weight;
				}


				$arr[] = array(
					$code_cat,
					$prod_name,
					$row_product['prod_desc'],
					$row_product['prod_sku'],
					'No',
					$row_product['prod_sku'],
					$var_1,
					$row_product['color_name'],
					site_url().''.$row_product['prod_img_mockup_url'],
					$var_2,
					$row_product['size_name'],
					$price,
					$row_product['size_stock'],
					$var_code,
					site_url().''.$row_product['prod_img_mockup_url'],
					site_url().''.$row_product['prod_img_design_url'],
					$size_guide_url,
					'',
					'',
					'',
					'',
					'',
					'',
					$actual_weight,
					$size_p,
					$size_l,
					$size_t,
					$this->FlagKurir($kurir_1),
					$this->FlagKurir($kurir_2),
					$this->FlagKurir($kurir_3)
				);
	
			}
			foreach ($arr as $row)
			{ 
				fputcsv($output, $row); 
		   } 
	 
		   fclose($output); 
		}
		else
		{
			$arr = array();
			$this->db->where('prod_cat_id',$prod_cat_id);
			$this->db->where('prod_niche_id',$prod_niche_id);
			$arr_product = $this->db->get('tb_product')->result_array();

			foreach($arr_product as $row_product)
			{
				// custom var
				$prod_name = 'Isamu - '.$row_product['prod_name'].' - '.$row_product['prod_sku'];
				$var_code = $row_product['prod_sku'];
				$price = $row_product['prod_price'];


				$arr[] = array(
					$code_cat,
					$prod_name,
					$row_product['prod_desc'],
					$row_product['prod_sku'],
					'No',
					$row_product['prod_sku'],
					'',
					'',
					site_url().''.$row_product['prod_img_mockup_url'],
					'',
					'',
					$row_product['prod_price_disc'],
					10,
					$var_code,
					site_url().''.$row_product['prod_img_mockup_url'],
					site_url().''.$row_product['prod_img_design_url'],
					$size_guide_url,
					'',
					'',
					'',
					'',
					'',
					'',
					$default_weight,
					$size_p,
					$size_l,
					$size_t,
					$this->FlagKurir($kurir_1),
					$this->FlagKurir($kurir_2),
					$this->FlagKurir($kurir_3)
				);
	
			}
			foreach ($arr as $row)
			{ 
				fputcsv($output, $row); 
		   } 
	 
		   fclose($output); 
		
		}

	}


	private function FlagKurir($flag)
	{
		if($flag==1){
			return 'Aktif';
		}else{
			return 'Nonaktif';
		}

	}

	public function gen_size()
	{
		$this->db->truncate('tb_stock_size');
		$arr_product = $this->db->get('tb_color')->result_array();

		$arr_size = array('S','M','L','XL');

		$i = 1;
		foreach($arr_product as $row_product)
		{
			foreach($arr_size as $size)
			{
				$arr_data[] = array
					( 			
						'uid'			=> md5(uniqid()),
						'size_color_id'		=> $row_product['color_id'],			
						'size_prod_id'		=> $row_product['color_prod_id'],			
						'size_name'			=> $size,
						'size_add_price'	=> 0,
						'size_add_weight'	=> 500,
						'size_stock'		=> 50,
						'size_ordering'		=> $i
					);
				$i++;	
			}		

		}
		$this->db->insert_batch('tb_stock_size',$arr_data);

		echo 'GEN SIZE SUCSESS';

	}


	public function gen_color()
	{
		$arr_product = $this->db->get('tb_product')->result_array();
		
		$this->db->truncate('tb_color');
		foreach($arr_product as $row_product)
		{
			$arr_data[] = array
				( 			
					'color_prod_id'		=> $row_product['prod_id'],			
					'color_name'		=> 'White',			
					'color_hex'			=> '#FFFFFF',
					'color_add_price'	=> 0,
					'color_img_url'		=> $row_product['prod_img_mockup_url']
				);			

		}
		$this->db->insert_batch('tb_color',$arr_data);

		echo 'GEN COLOR SUCSESS';

	}

}
?>