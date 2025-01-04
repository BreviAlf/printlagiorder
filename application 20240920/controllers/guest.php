<?php
class Guest extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->model('datakeb_model');
		$this->load->model('Abskeb_model');
		$this->load->model('Jemaat_model');
		if(!$this->session->userdata('user_id') && !$this->session->userdata('user_display_name') ):
			redirect('login');
		endif;
	}

	function expired()
	{
		$data['title'] 	= 'Expired';
		$this->load->view('guest/expired',$data);
	}

	function index()
	{
		$data['arr_keb'] = getKebByDate(formatDate(mysqlDateNow(),'date_only'));
		$data['arr_keg'] = getKegByDate(formatDate(mysqlDateNow(),'date_only'));
		$data['title'] = 'Guest';
		$this->load->view('guest',$data);
	}

	function keb()
	{
		$keb_id = $this->uri->segment(3);
		$ib_id  = getDataTableById('tb_kebaktian','keb_m_ib_id','keb_id',$keb_id);

		$time_ib	 	= getDataTableById('tb_m_ibadah','m_ib_end_time','m_ib_id',$ib_id);
		$date_keb		= getDataTableById('tb_kebaktian','keb_tgl','keb_id',$keb_id);
		$date_time_keb  = $date_keb.' '.$time_ib;
		// compare date
		if (CompareDateTime('now',mysqlDateNow(),$date_time_keb))
		{
			
			$data['arr_keb'] = getKebByDate(formatDate(mysqlDateNow(),'date_only'));
			$data['arr_keg'] = getKegByDate(formatDate(mysqlDateNow(),'date_only'));
			$data['row_qr_keb_ib'] = $this->datakeb_model->getDatakeb(FALSE,$keb_id,FALSE,FALSE);
			$data['count_p']	= count($this->Abskeb_model->getAbskeb('byKebIdPria',FALSE,FALSE,FALSE,$keb_id));
			$data['count_w']	= count($this->Abskeb_model->getAbskeb('byKebIdWanita',FALSE,FALSE,FALSE,$keb_id));
			$data['keb_id'] = $keb_id;
			$data['title'] = $data['row_qr_keb_ib']->m_ib_name.' - '.indDate($data['row_qr_keb_ib']->keb_tgl);
			$this->load->view('guest/index',$data);
			
		}
		else
		{	
			redirect('guest/expired');
		}

		
	}

	function searchJemaat()
	{

		$list = searchJmt($_POST['keyword']);

		foreach ($list as $rs) 
		{
			// put in bold the written text
			$m_jmt_nama = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', '<div style="font-size:18px;">'.$rs['m_jmt_nama'].'</div> <p>'.$rs['m_jmt_alamat_1'].'</p>');
			// add new option
		    echo '<li style="5px 20px 0px 20px;border-bottom: 1px dotted #ccc;" onclick="set_item(\''.str_replace("'", "\'", $rs['m_jmt_nama']).'\',\''.$rs['m_jmt_id'].'\',\''.$rs['m_jmt_alamat_1'].'\')"><a tabindex="-1" href="#">'.$m_jmt_nama.'</a></li>';

		}


	}

	function do_abs()
	{

		$this->form_validation->set_rules('hdr_m_jmt_id', 'Nama Jemaat','required');
		
		if ($this->form_validation->run() == FALSE)
		{

			$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-danger">Data Jemaat tidak terdaftar, Ketik nama terlebih dahulu</div>');
			redirect('guest/keb/'.$this->input->post('hdr_keb_keb_id'));
		}
		else
		{
			$keb_id = $this->input->post('hdr_keb_keb_id');
			$ib_id  = getDataTableById('tb_kebaktian','keb_m_ib_id','keb_id',$keb_id);

			$time_ib	 	= getDataTableById('tb_m_ibadah','m_ib_end_time','m_ib_id',$ib_id);
			$date_keb		= getDataTableById('tb_kebaktian','keb_tgl','keb_id',$keb_id);
			$date_time_keb  = $date_keb.' '.$time_ib;
			// compare date
			if (CompareDateTime('now',mysqlDateNow(),$date_time_keb))
			{
				if(cekHadir('keb',$this->input->post('hdr_m_jmt_id'),$this->input->post('hdr_keb_keb_id'))):
					$data = array
							(
								'hdr_keb_keb_id'		=>$this->input->post('hdr_keb_keb_id'),
								'hdr_m_jmt_id'			=>$this->input->post('hdr_m_jmt_id'),
								'hdr_keb_datetime'		=>mysqlDateNow()
							);
					$this->Abskeb_model->addAbskeb($data);
					$jmt_nama = getDataTableById('tb_m_jemaat','m_jmt_nama','m_jmt_id',$this->input->post('hdr_m_jmt_id'));
					$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Data Kehadiran '.$jmt_nama.' berhasil ditambahkan. Terima kasih selamat beribadah</div>');
				else:
					$jmt_nama = getDataTableById('tb_m_jemaat','m_jmt_nama','m_jmt_id',$this->input->post('hdr_m_jmt_id'));
					$message = 'Data Jemaat : '.$jmt_nama.' sudah hadir / diabsen';
					$this->session->set_flashdata('message_type_popup', "<script>window.alert(\"" . $message . "\");</script>");
					//$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-danger">Data Jemaat : '.$jmt_nama.' sudah hadir / diabsen</div>');
				endif;
				redirect('guest/keb/'.$this->input->post('hdr_keb_keb_id'));
			}
			else
			{	
				redirect('guest/expired');
			}

					
		}
			
	}

	function add_jmt()
	{
		$this->form_validation->set_rules('m_jmt_nama', 'Nama Jemaat','required');
		$this->form_validation->set_rules('m_jmt_jenkel', 'Jenis Kelamin','required');

		if ($this->form_validation->run() == FALSE)
		{
			$message = 'Data gagal disimpan. Mohon lengkapi data';
			$this->session->set_flashdata('message_type_popup', "<script>window.alert(\"" . $message . "\");</script>");
			redirect('guest/keb/'.$this->input->post('hdr_keb_keb_id'));
		}
		else
		{

			$m_jmt_tgl_lhr 		= $this->input->post('m_jmt_tgl_lhr_y').'-'.$this->input->post('m_jmt_tgl_lhr_m').'-'.$this->input->post('m_jmt_tgl_lhr_d');
			$data = array
				(
				'm_jmt_nama'			=>strtoupper($this->input->post('m_jmt_nama')),
				'm_jmt_jenkel'			=>$this->input->post('m_jmt_jenkel'),
				'm_jmt_tgl_lhr'			=>$m_jmt_tgl_lhr,
				'm_jmt_telp_1'			=>$this->input->post('m_jmt_telp_1'),
				'm_jmt_input_user_id'	=>$this->session->userdata('user_id'),
				'm_jmt_input_date_time'	=>mysqlDateNow(),

				);
			$this->Jemaat_model->addJemaat($data);
			$jmt_id = $this->db->insert_id();
			if($this->input->post('opt_absen') == 1)
			{
				$data_abs = array
						(
							'hdr_keb_keb_id'		=>$this->input->post('hdr_keb_keb_id'),
							'hdr_m_jmt_id'			=>$jmt_id,
							'hdr_keb_datetime'		=>mysqlDateNow()
						);
				$this->Abskeb_model->addAbskeb($data_abs);
				$jmt_nama = getDataTableById('tb_m_jemaat','m_jmt_nama','m_jmt_id',$jmt_id);
				$this->session->set_flashdata('message_type_2','<div id="alert_box" class="alert alert-success">Data jemaat berhasil ditambahkan <br> Data Kehadiran '.$jmt_nama.' berhasil ditambahkan. Terima kasih selamat beribadah</div>');
			}
			else
			{
				$this->session->set_flashdata('message_type_2','<div id="alert_box" class="alert alert-success">Data jemaat berhasil ditambahkan</div>');

			}
			redirect('guest/keb/'.$this->input->post('hdr_keb_keb_id'));
		}
	}
	
	
	function add_jmt_counter()
	{
		$this->form_validation->set_rules('keb_count_l', 'Jumlah Jemaat Laki - laki','required');
		$this->form_validation->set_rules('keb_count_p', 'Jumlah Jemaat Perempuan','required');

		if ($this->form_validation->run() == FALSE)
		{
			$message = 'Data gagal disimpan. Mohon lengkapi data';
			$this->session->set_flashdata('message_type_popup', "<script>window.alert(\"" . $message . "\");</script>");
			redirect('guest/keb/'.$this->input->post('hdr_keb_keb_id'));
		}
		else
		{

			$data = array
				(
				'keb_count_l'			=>$this->input->post('keb_count_l'),
				'keb_count_p'			=>$this->input->post('keb_count_p')

				);
			$this->datakeb_model->editDatakeb($this->input->post('hdr_keb_keb_id'),$data);
			$this->session->set_flashdata('message_type_popup','<div id="alert_box" class="alert alert-success">Data Counter jemaat berhasil ubah L ('.$this->input->post('keb_count_l').') P ('.$this->input->post('keb_count_p').')</div>');
			redirect('guest/keb/'.$this->input->post('hdr_keb_keb_id'));
		}
	}

	
}
?>