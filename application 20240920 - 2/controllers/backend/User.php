<?php

class User extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->helper('bantuan_helper');
		$this->load->model('User_model');
		if(!$this->session->userdata('user_id') && !$this->session->userdata('user_display_name') ):
			redirect('backend');
		elseif($this->session->userdata('user_rule')=='Frontend'):
			redirect('backend/no_access');
		endif;
	}

	function index()
	{
		$this->load->library('pagination');
		$offset = $this->uri->segment(4);
		$config['base_url'] = site_url().'/backend/user/index';
		$config['total_rows'] = count($this->User_model->getUser('all',FALSE,FALSE,FALSE));
		$config['per_page'] = $this->config->item('per_page');
		$config['uri_segment'] = '4';
		
		$data['urut'] = $this->uri->segment(4);
		$data['title'] = 'User Manager';
		$data['template'] = 'user/index';
		$data['res'] = $this->User_model->getUser('all',FALSE,$config['per_page'],$offset);
		$this->pagination->initialize($config);
		$this->load->view('backend/index',$data);
	}

	function add()
	{
		$this->form_validation->set_rules('user_login', 'Username', 'required');
		$this->form_validation->set_rules('user_password', 'Password', 'required|min_length[6]|matches[retype_user_password]');
		$this->form_validation->set_rules('retype_user_password', 'Retype Password', 'trim|required');
		$this->form_validation->set_rules('user_display_name', 'Display Name', 'required');
		$this->form_validation->set_rules('user_email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('user_rule', 'Rule', 'required');
		
		if ($this->form_validation->run() == FALSE):
			$data['title'] = 'User';
			$data['template'] = 'user/add';
			$this->load->view('backend/index',$data);
		else:
			$data = array('user_login'=>$this->input->post('user_login'),
						  'user_password'=>md5($this->input->post('user_password')),
						  'user_display_name'=>$this->input->post('user_display_name'),
						  'user_email'=>$this->input->post('user_email'),
						  'user_rule'=>$this->input->post('user_rule')
						  );
			$this->User_model->addUser($data);
			$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Satu data berhasil ditambahkan</div>');
			redirect('backend/user');
		endif;
	}

	function edit()
	{
		$this->form_validation->set_rules('user_login', 'Username', 'required');
		$this->form_validation->set_rules('user_password', 'Password', 'required|min_length[6]|matches[retype_user_password]');
		$this->form_validation->set_rules('retype_user_password', 'Retype Password', 'trim|required');
		$this->form_validation->set_rules('user_display_name', 'Display Name', 'required');
		$this->form_validation->set_rules('user_email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('user_rule', 'Rule', 'required');

		if ($this->form_validation->run() == FALSE):
			$id = $this->uri->segment(4);
			$data['title'] = 'User';
			$data['template'] = 'user/edit';
			$data['row'] = $this->User_model->getUser(FALSE,$id,FALSE,FALSE);
			$this->load->view('backend/index',$data);
		else:
			$id = $this->uri->segment(4);
			$data = array('user_login'=>$this->input->post('user_login'),
						  'user_password'=>md5($this->input->post('user_password')),
						  'user_display_name'=>$this->input->post('user_display_name'),
						  'user_email'=>$this->input->post('user_email'),
						  'user_rule'=>$this->input->post('user_rule')
						  );
			$this->User_model->editUser($id,$data);
			$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Data berhasil diupdate</div>');
			redirect('backend/user');

		endif;
	}
	
	function delete()
	{
		$id = $this->uri->segment(4);
		$uri = $this->uri->segment(5);
		$this->User_model->deleteUser($id);
		$count = count($this->User_model->getUser('all',FALSE,FALSE,FALSE));
		$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Data berhasil dihapus</div>');
		getPage('user','delete',$uri,$count);
	}	
}

/* End of file user.php */
/* Location: ./system/application/controllers/backend/user.php */
