<?php
class Media extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->library('Pdf'); // MEMANGGIL LIBRARY YANG KITA BUAT TADI
		$this->load->library('PdfMerge'); // MEMANGGIL LIBRARY YANG KITA BUAT TADI
		$this->load->model('media_model');
		if(!$this->session->userdata('user_id') && !$this->session->userdata('user_display_name') ):
			redirect('login');
		elseif($this->session->userdata('user_rule')=='Frontend'):
			redirect('no_access');
		endif;
	}

	function index()
	{

		$data['title'] = 'Media';

		//sidebar prop

		$data['sidebar_active'] = "sidebar_media";
		$data['collapse_active'] = "media-nav";

		//data
		$this->load->library('pagination');
		$offset = $this->uri->segment(4);
		$config['base_url'] = site_url().'/backend/media/index';
		$config['total_rows'] = count($this->media_model->GetMedia('all',FALSE,FALSE,FALSE));
		$config['uri_segment'] = '4';

		$this->media_model->GetMedia();
		
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
		$data['template'] = 'media/index';
		$data['arr_data'] = $this->media_model->GetMedia('all',FALSE,$config['per_page'],$offset);
		$this->pagination->initialize($config);
		$this->load->view('backend/index',$data);
		

	}

	public function add()
	{

		$file_data = ($_FILES['file_media']['name']? $this->upload_file('file_media') : "");
		$data = array
			(
			'media_url'			=> $file_data['upload_path'],
			'media_name'		=> $file_data['file_name'],
			'media_type'		=> $file_data['file_type'],
			);
		$this->media_model->CreateMedia($data);
		CreateLog('INFO','insert media '.$file_data['upload_path']);
		redirect('backend/media');
		
	}


	public function delete()
	{
		$media_id = $this->uri->segment(4);
		$data = $this->media_model->GetMedia(FALSE,$media_id,FALSE,FALSE);

		//echo $_SERVER['DOCUMENT_ROOT'].'/'.$data->prod_img_mockup_url;
		//exit();
		unlink($data->media_url);
		CreateLog('INFO','delete media '.$data->media_url);
		$this->media_model->DeleteMedia($media_id);
		$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Delete Success</div>');
		redirect('backend/media');
	}

	function gen_pdf()
	{
		error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
		$merge = new FPDF_Merge();

		$dir = "public\pdf";

		// Open a directory, and read its contents
		if (is_dir($dir)){
			if ($dh = opendir($dir)){
				while (($file = readdir($dh)) !== false){
					if($file != "." && $file != ".."){
						//echo "" . $file . "<br>";
						$merge->add('public\\pdf\\'.$file);
					}
				
				}
				closedir($dh);
			}
		}
		$merge->output();
	}

	private function upload_file($file)
	{
		$config['upload_path']          = $this->config->item("upload_path_media");
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
			$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-danger">Please Select File</div>');
			redirect('backend/media');
			
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