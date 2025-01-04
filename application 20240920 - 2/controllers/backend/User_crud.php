<?php
class User_crud extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->model('product_model');
		if(!$this->session->userdata('user_id') && !$this->session->userdata('user_display_name') ):
			redirect('login');
		elseif($this->session->userdata('user_rule')!='sysadmin'):
			redirect('no_access');
		endif;
	}

	function index()
	{
		CreateLog('INFO','load page');
		$data['title'] = 'SISPRINT - Product user_crud';

		//sidebar prop

		$data['sidebar_active'] = "sidebar_user";
		$data['collapse_active'] = "product-nav";

		//data
		$this->load->library('pagination');
		$offset = $this->uri->segment(4);
		$config['base_url'] = site_url().'/backend/user_crud/index';
		$config['total_rows'] = count($this->product_model->Getuser_crud('all',FALSE,FALSE,FALSE));
		$config['uri_segment'] = '4';

		$this->product_model->Getuser_crud();
		
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
		$data['template'] = 'user_crud/index';
		$data['arr_cat'] = $this->product_model->Getuser_crud('all',FALSE,$config['per_page'],$offset);
		$this->pagination->initialize($config);
		$this->load->view('backend/index',$data);
		

	}

	public function add()
	{
		$this->form_validation->set_rules('user_name', 'user Name','required');
		//$this->form_validation->set_rules('prod_code', 'Code','required');
		//exit();
		
		if($this->form_validation->run() == FALSE)
		{	
		
			//sidebar prop
			$data['sidebar_active'] = "sidebar_user";
			$data['collapse_active'] = "product-nav";

			$data['title'] = 'SISPRINT - Add user';
			$data['template'] = 'user/add';
			$this->load->view('backend/index',$data);

		}
		else
		{
			$pass = md5($this->input->post('user_password'));
			$data = array
				(
				'user_name'				=> $this->input->post('user_name'),
				'user_display_name'				=> $this->input->post('user_display_name'),  
				'user_email'  			=> $this->input->post('user_email'),				//req
				'user_password'  			=> $pass,
				'user_role'  			=> $this->input->post('user_role')
				);

			$this->product_model->CreateUser($data);
			CreateLog('INFO','add save user');
			redirect('backend/user_crud');
		}	
	}

	public function edit()
	{
		$this->form_validation->set_rules('user_name', 'User Name','required');
		//$this->form_validation->set_rules('prod_code', 'Code','required');
		//exit();
		
		if($this->form_validation->run() == FALSE)
		{	
		
			$user_id = $this->uri->segment(4);
			$data['row_data'] = $this->product_model->GetUser_crud(FALSE,$user_id,FALSE,FALSE);
			//sidebar prop
			$data['sidebar_active'] = "sidebar_user";
			$data['collapse_active'] = "product-nav";

			$data['title'] = 'SISPRINT - Edit User - '.$data['row_data']->user_name;
			$data['template'] = 'user_crud/edit';
			$this->load->view('backend/index',$data);

		}
		else
		{
			$user_id = $this->uri->segment(4);
			$data = $this->product_model->GetUser_crud(FALSE,$user_id,FALSE,FALSE);
			$pass = md5($this->input->post('user_password'));

			$data = array
				(
				'user_name'				=> $this->input->post('user_name'),
				'user_display_name'				=> $this->input->post('user_display_name'),  
				'user_email'  			=> $this->input->post('user_email'),				//req
				'user_password'  			=> $pass,
				'user_role'  			=> $this->input->post('user_role')
				);

			$this->product_model->Updateuser($user_id,$data);
			CreateLog('INFO','Save Edit user :'.$user_id);
			redirect('backend/user_crud');
		}	
	}


	

	public function delete()
	{
		$prod_id = $this->uri->segment(4);
		$data = $this->product_model->GetUser_crud(FALSE,$prod_id,FALSE,FALSE);

		//echo $_SERVER['DOCUMENT_ROOT'].'/'.$data->prod_img_mockup_url;
		//exit();
		
        /*
        unlink($data->cat_img_url);
		CreateLog('INFO','Delete User :'.$prod_id.' Delete image'.$data->cat_img_url);
        */

		$this->product_model->DeleteUser($prod_id);
		$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Delete Success</div>');
		redirect('backend/user_crud');
        
	}



    /* 
    public function edit_prod_desc()
	{
		$cat_id 		= $this->input->post('cat_id');
		$save_to_all 	= $this->input->post('save_to_all');

		//echo $save_to_all;

		
		if($save_to_all == 1):

			$data = array
			(
			'cat_prod_desc'			=> $this->input->post('cat_prod_desc'),
			);
	
			$this->product_model->Updatematerial($cat_id,$data);
			CreateLog('INFO','Save Edit material on cat_prod_desc :'.$cat_id);

			//update all product by prod_cat_id
			$data = array
			(
				'prod_desc'			=> $this->input->post('cat_prod_desc'),
			);
			CreateLog('INFO','Replace all product desc where prod_cat_id :'.$cat_id);
			$this->db->where('prod_cat_id',$cat_id);
			$this->db->update('tb_product',$data);

		else:
			$data = array
			(
			'cat_prod_desc'			=> $this->input->post('cat_prod_desc'),
			);
	
			$this->product_model->Updatematerial($cat_id,$data);
			CreateLog('INFO','Save Edit material on cat_prod_desc :'.$cat_id);
		endif;

		redirect('backend/material');

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
			CreateLog('ERROR','upload file error '.$this->upload->display_errors());
			echo $this->upload->display_errors();
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
*/
}
?>