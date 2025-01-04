<?php
class Customer extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->model('customer_model');
		if(!$this->session->userdata('user_id') && !$this->session->userdata('user_display_name') ):
			redirect('login');
		elseif($this->session->userdata('user_rule')=='Frontend'):
			redirect('no_access');
		endif;
	}

	function index()
	{

		$data['title'] = 'Customer';

		//sidebar prop
		CreateLog('INFO','load page');

		$data['sidebar_active'] = "sidebar_customer";
		$data['collapse_active'] = "customer-nav";


		//data
		$this->load->library('pagination');
		$offset = $this->uri->segment(4);
		$config['base_url'] = site_url().'/backend/customer/index';
		$config['total_rows'] = count($this->customer_model->GetCustomer('all',FALSE,FALSE,FALSE));
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
		$data['template'] = 'customer/index';
		$data['arr_data'] = $this->customer_model->GetCustomer('all',FALSE,$config['per_page'],$offset);
		$this->pagination->initialize($config);
		$this->load->view('backend/index',$data);
		

	}

	public function upload()
	{

		//check batch name
		$arr_check = array();
		$this->db->where('cust_batch_name',$this->input->post('cust_batch_name'));
		$arr_check = $this->db->get('tb_cust_batch')->result_array();
		
		if(count($arr_check) == 0)
		{
			$file_cust = ($_FILES['file_cust']['name']? $this->upload_file('file_cust') : "");
			
			if($file_cust)
			{
				// insert cust batch
				CreateLog('INFO','insert cust batch file '.$file_cust);
				$arr_batch = array
				(
					'cust_batch_name'	=> $this->input->post('cust_batch_name'),
					'cust_file_name'	=> $file_cust['file_name'],
					'cust_file_path'	=> $file_cust['upload_path']
				);
	
				$this->db->insert('tb_cust_batch',$arr_batch);
				$cust_batch_id = $this->db->insert_id();
				$arr_cust = array();
				if (($handle = fopen($file_cust['upload_path'], "r")) !== FALSE) 
				{
					// loop data
					CreateLog('INFO','insert tb_customer loop the data start '.$file_cust);

					/*
						no_hp = 0
						nama = 1
						product = 2
						jenis kelamin = 3
						province = 4
						kota kab = 5
						kecamatan = 6
						alamat lengkap = 7
					*/

					while (($data = fgetcsv($handle, 5000, ",")) !== FALSE) 
					{

						//echo $data[0]." - ".$data[2]." - ".$data[3]." - ".$data[4]." - ".$data[5]." - ".$data[6]." - ".$data[7]."<br>";

						//exit();
						$arr_cust[] = array
						(
							'cust_cust_batch_id' 	=> $cust_batch_id,
							'cust_name' 			=> trim($data[1]),
							'cust_email' 			=> '', 
							'cust_phone' 			=> '62'.trim($data[0]),
							'cust_status' 			=> 'Y',
							'cust_gender' 			=> trim($data[3]),
							'cust_product_batch' 	=> trim($data[2]),
							'cust_date_order' 		=> '1999-01-01',
							'cust_prov' 			=> trim($data[4]),
							'cust_city' 			=> trim($data[5]),
							'cust_district' 		=> trim($data[6]),
							'cust_address_full' 	=> trim($data[7]),
						);	
					
					}
					$this->db->insert_batch('tb_customer',$arr_cust);

					// update uid
					$this->db->where('cust_cust_batch_id',$cust_batch_id);
					$arr_data = $this->db->query("
						SELECT cust_id FROM tb_customer WHERE cust_cust_batch_id = $cust_batch_id
						")->result_array();

					CreateLog('INFO','Update UID');
					$updateArray = array();
					foreach ($arr_data as $row_data)
					{
						$cust_uid = GenerateUid($row_data['cust_id']);
						$updateArray[] = array(
							'cust_id'=>$row_data['cust_id'],
							'cust_uid'=>$cust_uid
						);
					}

					$this->db->update_batch('tb_customer',$updateArray, 'cust_id'); 
					fclose($handle);
					$count_data = count($arr_cust);
					CreateLog('INFO','insert tb_customer loop the data end TOTAL '.$count_data);
					// update count customer
					$arr = array
					(
						'cust_batch_count_upload'	=> $count_data
					);
					
					$this->db->where('cust_batch_id',$cust_batch_id);
					$this->db->update('tb_cust_batch',$arr);
	
				}
				$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Upload Success</div>');
				if($this->uri->segment(4)== 'batch'){
					redirect('backend/batch_customer');
				}else{
					redirect('backend/customer');
				}
				
			}
			else
			{
				$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-danger">Please complete field!!</div>');
				if($this->uri->segment(4)== 'batch'){
					redirect('backend/batch_customer');
				}else{
					redirect('backend/customer');
				}
			}
		}
		else
		{
			$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-danger">Batch name already exist!!!, please use different name</div>');
			if($this->uri->segment(4)== 'batch'){
				redirect('backend/batch_customer');
			}else{
				redirect('backend/customer');
			}
		}
	
	}


	private function upload_file($file)
	{
		$config['upload_path']          = $this->config->item("upload_path_csv");
		$config['allowed_types']        = '*';
		$config['upload_path_temp']     = $this->config->item("upload_path_temp");
		$config['max_size'] = 2000;


		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		//print_r($_FILES['file_mockup']);

		//exit();
		if (!$this->upload->do_upload($file)) 
		{
			CreateLog('ERROR','upload file error '.$this->upload->display_errors());
			echo $this->upload->display_errors();
			exit();
		} 
		else 
		{
			$res_arr = array();
			$uploaded_data = $this->upload->data();
			$path = $config['upload_path'].''. $uploaded_data['file_name'];
			$res_arr = array(
				'upload_path' => $path,
				'file_name' => $uploaded_data['file_name'],
				'file_type' => $uploaded_data['file_type']
			);
			CreateLog('INFO','upload file success '.$path);
			return $res_arr;
		}

	}
}
?>