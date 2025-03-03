<?php
class Login extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->library('session');
	}

	function index()
	{
		if($this->session->userdata('user_id')):
			redirect('backend/spk');
		else:
			$data['title'] = 'Login';
			$data['notif'] = "";
			$this->load->view('login',$data);
		endif;

	}

	function doLogout(){
		
		
		CreateLog('INFO','logout '.$this->session->userdata('user_name').' - ID '.$this->session->userdata('user_id'));
		$this->session->unset_userdata('user_display_name');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_rule');
		
		redirect('backend');
	}

	function doLogin()
	{
		$this->form_validation->set_rules('user_name', 'Username', 'required');
		$this->form_validation->set_rules('user_password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE):
			$data['title'] = 'Login';
			$data['notif'] = "";
			$this->load->view('login',$data);
		else:
			$username = $this->input->post('user_name');
			$password = md5($this->input->post('user_password'));
			$this->db->where('user_name',$username);
			$this->db->where('user_password',$password);
			$res = $this->db->get('tb_user')->result();
			if (count($res) > 0):
				$this->session->set_userdata('user_id',$res[0]->user_id );
				$this->session->set_userdata('user_display_name',$res[0]->user_display_name);
				$this->session->set_userdata('user_rule',$res[0]->user_role);
				$this->session->set_userdata('user_name',$res[0]->user_name);
				if($res[0]->user_role == 'Administrator' || $res[0]->user_role == 'sysadmin'):
					CreateLog('INFO','login success '.$username);
					redirect('backend/spk');
				else:
					CreateLog('INFO','login success no access '.$username);
					redirect('no_access');
				endif;
			else:
				$notif = '<div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
						<p>Username / password salah </p>
						<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
							<audio id="myAudio">
							<source src="'.site_url().'/assets/audio/danger.mp3" type="audio/mpeg">
							Your browser does not support the audio element.
						</audio>';
				$data['notif'] = $notif;
				CreateLog('INFO','login wrong password '.$username);
				$data['title'] = 'Login';
				$this->load->view('login',$data);
			endif;
		endif;
	}
}
?>