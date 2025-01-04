<?php
class Niche extends CI_Controller {

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

		$data['title'] = 'Product Niche';

		//sidebar prop

		$data['sidebar_active'] = "sidebar_niche";
		$data['collapse_active'] = "product-nav";

		//data
		$this->load->library('pagination');
		$offset = $this->uri->segment(4);
		$config['base_url'] = site_url().'/backend/niche/index';
		$config['total_rows'] = count($this->product_model->GetNiche('all',FALSE,FALSE,FALSE));
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
		$data['template'] = 'niche/index';
		$data['arr_niche'] = $this->product_model->GetNiche('all',FALSE,$config['per_page'],$offset);
		$this->pagination->initialize($config);
		$this->load->view('backend/index',$data);
		

	}

	public function add()
	{
		$this->form_validation->set_rules('niche_name', 'Niche Name','required');
		//$this->form_validation->set_rules('prod_code', 'Code','required');
		//exit();
		
		if($this->form_validation->run() == FALSE)
		{	
		
			//sidebar prop
			$data['sidebar_active'] = "sidebar_niche";
			$data['collapse_active'] = "product-nav";

			$data['title'] = 'Add Niche';
			$data['template'] = 'niche/add';
			$this->load->view('backend/index',$data);

		}
		else
		{

			$niche_img_url = ($_FILES['file_image']['name']? $this->upload_file('file_image') : "");

			$data = array
				(
				'niche_name'				=> $this->input->post('niche_name'),
				'niche_desc'				=> $this->input->post('niche_desc'),
				'niche_img_url'				=> $niche_img_url,
				'niche_status'				=> $this->input->post('niche_status'),

				);

			$this->product_model->CreateNiche($data);
			redirect('backend/niche');
		}	
	}

	public function edit()
	{
		$this->form_validation->set_rules('niche_name', 'Niche Name','required');
		//$this->form_validation->set_rules('prod_code', 'Code','required');
		//exit();
		
		if($this->form_validation->run() == FALSE)
		{	
		
			$niche_id = $this->uri->segment(4);
			$data['row_data'] = $this->product_model->GetNiche(FALSE,$niche_id,FALSE,FALSE);
			//sidebar prop
			$data['sidebar_active'] = "sidebar_niche";
			$data['collapse_active'] = "product-nav";

			$data['title'] = 'Edit Niche - '.$data['row_data']->niche_name;
			$data['template'] = 'niche/edit';
			$this->load->view('backend/index',$data);

		}
		else
		{
			$niche_id = $this->uri->segment(4);
			$data = $this->product_model->GetNiche(FALSE,$niche_id,FALSE,FALSE);

			if($_FILES['file_image']['name']){
				unlink($data->niche_img_url);
			}

			$niche_img_url = ($_FILES['file_image']['name']? $this->upload_file('file_image') : $data->niche_img_url);

			$data = array
				(
				'niche_name'				=> $this->input->post('niche_name'),
				'niche_desc'				=> $this->input->post('niche_desc'),
				'niche_img_url'				=> $niche_img_url,
				'niche_status'				=> $this->input->post('niche_status'),

				);

			$this->product_model->UpdateNiche($niche_id,$data);
			redirect('backend/niche');
		}	
	}


	public function delete()
	{
		$niche_id = $this->uri->segment(4);
		$data = $this->product_model->GetCategory(FALSE,$niche_id,FALSE,FALSE);
;
		unlink($data->niche_img_url);

		$this->product_model->DeleteNiche($niche_id);
		$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Delete Success</div>');
		redirect('backend/niche');
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
}
?>