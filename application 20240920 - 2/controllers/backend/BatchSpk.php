<?php
class BatchSpk extends CI_Controller {

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

		$data['title'] = 'SISPRINT - SPK New Batch';
		//sidebar prop
		$data['sidebar_active'] = "sidebar_bspk";
		$data['collapse_active'] = "bspk-nav";
		
		CreateLog('INFO','load page');
		$data['urut'] = $this->uri->segment(4);
		$data['template'] = 'batchspk/add';
		$this->load->view('backend/index',$data);
	}


	public function add()
	{
		$this->form_validation->set_rules('batch_spk_name', 'Nama SPK','required');
		
		if($this->form_validation->run() == FALSE)
		{	
		
			$data['title'] = 'SISPRINT - SPK New Batch';
			//sidebar prop
			$data['sidebar_active'] = "sidebar_bspk";
			$data['collapse_active'] = "bspk-nav";
			
			CreateLog('INFO','load page');
			$data['urut'] = $this->uri->segment(4);
			$data['template'] = 'batchspk/add';
			$this->load->view('backend/index',$data);

		}
		else
		{
			$batch_spk_uid = GenUidBatch('tb_batch_spk',FALSE);

			$data = array
				(
				
					'batch_spk_uid'				=> $batch_spk_uid,
					'batch_spk_no'				=> 'PLG-'.$batch_spk_uid,
					'batch_spk_name'			=> $this->input->post('batch_spk_name'),
					'batch_spk_date_deadline'	=> '0000-00-00 00:00:00',
					'batch_spk_user_id'			=> $this->session->userdata('user_id'),
					'batch_spk_status'			=> 'Created',
				);

			CreateLog('INFO','insert data');
			$this->db->insert('tb_batch_spk',$data);
			$batch_spk_id = $this->db->insert_id();
			redirect('backend/batchspk/detail/'.$batch_spk_id);
		}	
	}



	function detail()
	{	

		$batch_spk_id = $this->uri->segment(4);
		$this->db->where('batch_spk_id',$batch_spk_id);
		$data['data_batch'] = $this->db->get('tb_batch_spk')->row();

		if($data['data_batch']->batch_spk_status == 'Created'){
			$data['input'] = "";
		}else{
			$data['input'] = "disabled";
		}
		
		$data['title'] = 'SCAN SPK Batch NO : '. $data['data_batch']->batch_spk_no;
		//sidebar prop
		$data['sidebar_active'] = "sidebar_bspk";
		$data['collapse_active'] = "bspk-nav";

		

		$this->db->where('batch_spk_det_spk_id',$batch_spk_id);
		$data_spk_det = $this->db->get('tb_batch_spk_detail')->result_array(); 
		$data['arr_spk_det'] = $data_spk_det;
		
		CreateLog('INFO','load page');
		$data['batch_spk_id'] = $this->uri->segment(4);
		$data['notif'] = "";
		$data['total_spk'] = count($data_spk_det);
		$data['template'] = 'batchspk/add_spk';
		$this->load->view('backend/index',$data);
	}


	

	public function AjaxInsertSPK()
	{
		$batch_spk_id = $this->input->post('batch_spk_id');
		$batch_spk_no = $this->input->post('spk_no');

		//load library
		$this->load->library('zend');
		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		$code = $batch_spk_no;
		//generate barcode
		$barcodeOptions = array(
			'text' => $code, 
			'barHeight'=> 10, 
			'factor'=>5,
			'fontSize'=>3
			
		);
		

		// param for root
		$this->load->library('ciqrcode');
		$params2['data'] = $code;
		$params2['level'] = 'L';
		$params2['size'] = 10;
		$params2['savename'] = './public/temp_qr/'.$batch_spk_no.'.png';
		$this->ciqrcode->generate($params2);
		
		// get invoice mp by spk no
		$this->db->where('spk_no',$batch_spk_no);
		$data_spk = $this->db->get('tb_spk')->row();

		// spk found
		if($data_spk)
		{
			$this->db->where('batch_spk_det_spk_no',$batch_spk_no);
			$data_spk_detail = $this->db->get('tb_batch_spk_detail')->result_array();

			if(count($data_spk_detail) > 0)
			{

				$notif = '<div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
				SPK : '. $batch_spk_no. ' SUDAH DI SCAN
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';

				$this->db->where('batch_spk_det_spk_id',$batch_spk_id);
				$data_spk_det = $this->db->get('tb_batch_spk_detail')->result_array(); 

				$data['arr_spk_det'] = $data_spk_det;
				$data['notif'] = $notif;
				$data['total_spk'] = count($data_spk_det);
				$this->load->view('backend/batchspk/detailspk',$data);
			}
			else
			{
				
				$data = array
				(
					'batch_spk_det_spk_id'		=> $batch_spk_id,
					'batch_spk_det_spk_no'		=> $batch_spk_no,
					'batch_spk_det_spk_inv_mp'	=> $data_spk->spk_inv_mp
				);

				CreateLog('INFO','insert data');
				$this->db->insert('tb_batch_spk_detail',$data);

				
				//get batch name
				$this->db->where('batch_spk_id',$batch_spk_id);
				$qr_bacth = $this->db->get('tb_batch_spk')->row();
				$batch_name = $qr_bacth->batch_spk_name;

				//copy folder to batch
				CreateFolderBatch($batch_name);
				copyDirectory(GetImg($data_spk->spk_inv_mp,$batch_spk_no),GetFolderBatch($batch_name).'\\'.$data_spk->spk_inv_mp.'\\'.$batch_name.'_'.$batch_spk_no.'_'.$data_spk->spk_inv_mp,$data_spk->spk_inv_mp);

				$del_notif = "";
				//$iterator = new \FilesystemIterator(GetFolderInv($data_spk->spk_inv_mp));
				//$isDirEmpty = !$iterator->valid();
				//if($isDirEmpty){
				//	$del_notif =  'REMOVE ' .GetFolderInv($data_spk->spk_inv_mp);
				//	rmdir(GetFolderInv($data_spk->spk_inv_mp));
				//}

				// rename file QR code kasih prefix A bir lebih gampang ditemukan 
				$from 	= GetFolderBatch($batch_name).'\\'.$data_spk->spk_inv_mp.'\\'.$batch_name.'_'.$batch_spk_no.'_'.$data_spk->spk_inv_mp.'\\'.$batch_spk_no.'.jpg';
				$to 	= GetFolderBatch($batch_name).'\\'.$data_spk->spk_inv_mp.'\\'.$batch_name.'_'.$batch_spk_no.'_'.$data_spk->spk_inv_mp.'\\'.'@_'.$batch_spk_no.'.jpg';
				rename( $from,  $to);

				$path_save = GetFolderBatch($batch_name).'\\'.$data_spk->spk_inv_mp.'\\'.$batch_name.'_'.$batch_spk_no.'_'.$data_spk->spk_inv_mp;

				$this->cetak_info($batch_spk_no,$batch_name,$path_save);


				$notif = '<div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
				SPK : '.$batch_spk_no. ' BERHASIL DI SCAN. '.$del_notif.'
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';

				$this->db->where('batch_spk_det_spk_id',$batch_spk_id);
				$data_spk_det = $this->db->get('tb_batch_spk_detail')->result_array(); 
				$data['notif'] = $notif;
				$data['total_spk'] = count($data_spk_det);
				$data['arr_spk_det'] = $data_spk_det;
				$this->load->view('backend/batchspk/detailspk',$data);
			}
				
		}
		else
		{

			$notif = '<div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
			SPK : '. $batch_spk_no. ' TIDAK ADA
			<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
		  </div>';

			$this->db->where('batch_spk_det_spk_id',$batch_spk_id);
			$data_spk_det = $this->db->get('tb_batch_spk_detail')->result_array(); 
			$data['notif'] = $notif;
			$data['total_spk'] = count($data_spk_det);
			$data['arr_spk_det'] = $data_spk_det;
			$this->load->view('backend/batchspk/detailspk',$data);
		}
			
	}


	public function AjaxDelDetSPKId()
	{
		$batch_spk_id 	= $this->input->post('batch_spk_id');
		$det_spk_id 	= $this->input->post('det_spk_id');

		// get invoice mp and no spk
		$this->db->where('batch_spk_det_batch_spk_id',$det_spk_id);
		$row_det = $this->db->get('tb_batch_spk_detail')->row();
		

		//get batch name
		$this->db->where('batch_spk_id',$batch_spk_id);
		$qr_bacth = $this->db->get('tb_batch_spk')->row();
		$batch_name = $qr_bacth->batch_spk_name;

		
		$del_notif = "";
		$dir_file = GetFolderBatch($batch_name).'\\'.$row_det->batch_spk_det_spk_inv_mp.'\\'.$batch_name.'_'.$row_det->batch_spk_det_spk_no.'_'.$row_det->batch_spk_det_spk_inv_mp;
		
		if (file_exists($dir_file)){
			$iterator = new \FilesystemIterator($dir_file);
			$isDirEmpty = !$iterator->valid();
			if(!$isDirEmpty){
				$del_notif =  '<br>REMOVE ' .$dir_file;
				deleteDirectory($dir_file);
			}
		}


		$del_notif2 = "";
		$dir_inv = GetFolderBatch($batch_name).'\\'.$row_det->batch_spk_det_spk_inv_mp;

		if (file_exists($dir_inv)){
		$iterator2 = new \FilesystemIterator($dir_inv);
		$isDirEmpty2 = !$iterator2->valid();
			if($isDirEmpty2){
				$del_notif2 =  '<br>REMOVE ' .$dir_inv;
				rmdir($dir_inv);
			}
		}

		$del_notif3 = "";
		if (file_exists(GetFolderBatch($batch_name))){
		$iterator3 = new \FilesystemIterator(GetFolderBatch($batch_name));
		$isDirEmpty3 = !$iterator3->valid();
			if($isDirEmpty3){
				$del_notif3 =  '<br>REMOVE ' .GetFolderBatch($batch_name);
				rmdir(GetFolderBatch($batch_name));
			}
		}
		


		// del tb_batch_spk_detail by batch_spk_det_batch_spk_id
		$this->db->where('batch_spk_det_batch_spk_id',$det_spk_id);
		$this->db->delete('tb_batch_spk_detail');

		$notif = '<div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
		DELETE SUCCESS '.$del_notif.''.$del_notif2.''.$del_notif3.'
		<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
	  </div>';

		$this->db->where('batch_spk_det_spk_id',$batch_spk_id);
		$data_spk_det = $this->db->get('tb_batch_spk_detail')->result_array(); 

		$data['total_spk'] = count($data_spk_det);
		$data['notif'] = $notif;
		$data['arr_spk_det'] = $data_spk_det;
		$this->load->view('backend/batchspk/detailspk',$data);
	}


	function cetak_info($spk_no,$batch_name,$path_save)
	{
		//$spk_no	= $spk_no;
		//$spk_no	= 'PL24091900005';
		//$batch_name	= 'B-01';
		//$spk_inv_mp = '2405246H9SX444';
		

		date_default_timezone_set('Asia/Jakarta');
		$time_now 	  = date('Y-m-d H:i:s');
	
		$qr = $this->db->select('*');
		$qr = $this->db->from('tb_spk');
		$qr = $this->db->join('tb_product', 'tb_spk.spk_prod_id = tb_product.prod_id', 'left');
		$qr = $this->db->join('tb_user', 'tb_spk.spk_user = tb_user.user_id', 'left');
		$qr = $this->db->join('tb_material', 'tb_spk.spk_material_id = tb_material.material_id', 'left');
		$qr = $this->db->join('tb_paper_size', 'tb_spk.spk_paper_size_id = tb_paper_size.paper_size_id', 'left');
		$qr = $this->db->where('spk_no',$spk_no);
		$qr = $this->db->get();
		$row_spk = $qr->row();

		$path_save = GetFolderBatch($batch_name).'\\'.$row_spk->spk_inv_mp.'\\'.$batch_name.'_'.$spk_no.'_'.$row_spk->spk_inv_mp;

		$file_pdf = '@_'.$row_spk->spk_no.'.pdf';
		$file_txt = '@_'.$row_spk->spk_no.'.txt';

		// check if tanpa laminasi tidak usah ditulis
		if($row_spk->spk_lamination!="Tanpa Laminasi"){
			$lamination = str_replace('Laminasi','Lam',$row_spk->spk_lamination);
		}

		// check if NoCut tidak usah ditulis
		if($row_spk->spk_cutting!="No Cut"){
			$cutting = $row_spk->spk_cutting;
		}

		// potong kris tidak usah ditulis
		$row_spk->spk_instruction;
		$ins = str_replace(trim('Potong Kris'),"",$row_spk->spk_instruction);


		//CHECK IF TOKOPEDIA >> INVOICE NYA TERLALU PANJANG explode then use yg paling belakang saja
		if($row_spk->spk_source=='Tokopedia'){
			$ex = explode("-",$row_spk->spk_inv_mp);
			$spk_inv_mp = $ex[3];
		}else{
			$spk_inv_mp = $row_spk->spk_inv_mp;
		}


	
		error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
        $pdf =  new PDF_Code128('P','cm',array(31.5,45));

		// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
		$pdf->SetMargins(0.7,0.05,0.05,0.05);

		
		$pdf->AliasNbPages();
		$pdf->SetAutoPageBreak(false);
		
		// AddPage merupakan fungsi untuk membuat halaman baru


		// check laminasi
		$this->db->where('cc_name',$row_spk->spk_lamination);
		$row_color = $this->db->get('tb_color_code')->row();
		
		
		$pdf->AddPage();
		$qr = "./public/temp_qr/".$row_spk->spk_no.'.png';
		
		//$qr = $path_save.'\\'.$row_spk->spk_no.'.jpg';

		if($row_color)
		{
			$file_color = $row_color->cc_img_path;
			$full_path = "./public/color_code/".$file_color;

			$pdf->SetFont('arial','B',10);
			$pdf->Cell(0.8, 0.3, $pdf->Image($full_path, $pdf->GetX(), $pdf->GetY(), 0.8), 0, 0, 'L', false );
			$pdf->SetFont('arial','B',10);
			$pdf->Cell(0.7, 0.3, $pdf->Image($qr, $pdf->GetX(), $pdf->GetY(), 0.8), 0, 0, 'L', false );
			$pdf->SetFont('arial','B',10);
			$pdf->Cell(0.8, 0.7,$batch_name,0,'LR','L');
			$pdf->SetFont('arial','',5);
			$pdf->Cell(1.6, 0.5, $spk_inv_mp,0,'LR','L');
			$pdf->Cell(1, 0.5, $cutting.' | '.$lamination,0,'LR','L');
			$pdf->Ln();
			$pdf->SetFont('arial','B',10);
			$pdf->Cell(2.3, 0.1,'',0,'LR','L');
			$pdf->SetFont('arial','',5);
			$pdf->Cell(1.6, -0.1, $row_spk->spk_no,0,'LR','L');//
			$pdf->Cell(1, -0.1, $ins,0,'LR','L');//
		}
		else
		{
			$pdf->SetFont('arial','B',10);
			$pdf->Cell(0.7, 0.3, $pdf->Image($qr, $pdf->GetX(), $pdf->GetY(), 0.8), 0, 0, 'L', false );
			$pdf->SetFont('arial','B',10);
			$pdf->Cell(0.8, 0.7,$batch_name,0,'LR','L');
			$pdf->SetFont('arial','',5);
			$pdf->Cell(1.6, 0.5, $spk_inv_mp,0,'LR','L');
			$pdf->Cell(1, 0.5, $cutting.' | '.$lamination,0,'LR','L');
			$pdf->Ln();
			$pdf->SetFont('arial','B',10);
			$pdf->Cell(1.5, 0.1,'',0,'LR','L');
			$pdf->SetFont('arial','',5);
			$pdf->Cell(1.6, -0.1, $row_spk->spk_no,0,'LR','L');//
			$pdf->Cell(1, -0.1, $ins,0,'LR','L');//
		}
		//$pdf->Output($file_pdf,"I");
		
		$pdf->Output($path_save.'\\'.$file_pdf,'F');

		// LETS CREATE TXT FILE INFO
		$myfile = fopen($path_save.'\\'.$file_txt, "w") or die("Unable to open file!");
		$txt = $batch_name.' '.$row_spk->spk_no.' '.$spk_inv_mp."\n";
		$txt .= $cutting.' | '.$lamination."\n";
		$txt .= $ins;
		
		fwrite($myfile, $txt);
		
		fclose($myfile);
	}

	function update()
	{

		//$batch_spk_id = $this->input->post('batch_spk_id');
		$batch_spk_id	= $this->uri->segment(4);
		date_default_timezone_set('Asia/Jakarta');
		$time_now 	  = date('Y-m-d H:i:s');

		// process SPK
		// loop data spk batch

		$this->db->where('batch_spk_det_spk_id',$batch_spk_id);
		$arr_det_spk = $this->db->get('tb_batch_spk_detail')->result_array();

		foreach($arr_det_spk as $row_det_spk)
		{
			$updateArray[] = array(
				'spk_no'			=>$row_det_spk['batch_spk_det_spk_no'],
				'spk_status' 		=> 'Process',
				'spk_time_process'  => $time_now
			);
		}

		if($updateArray){
			$this->db->update_batch('tb_spk',$updateArray, 'spk_no'); 
			CreateLog('INFO','update batch data id '.$batch_spk_id);

			$data = array
					(
						'batch_spk_date_process'	=> $time_now,
						'batch_spk_status'				=> 'Process',
					);
			$this->db->where('batch_spk_id',$batch_spk_id);
			$this->db->update('tb_batch_spk',$data);

			$this->load->helper('url');

			//echo anchor(site_url().'backend/batchspk/cetak_batch/'.$batch_spk_id, 'title="Pakainfo Jaydeep"', array('target' => '_blank', 'class' => 'new_window'));

			redirect('backend/batchspk/cetak_batch/'.$batch_spk_id);
		}else{
			redirect('backend/batchspk/detail/'.$batch_spk_id);
		}
		

		

	}





	function cetak_batch()
	{
		$batch_spk_id	= $this->uri->segment(4);

		// QR DATA BATCH
		$this->db->where('batch_spk_id',$batch_spk_id);
		$row_batch = $this->db->get('tb_batch_spk')->row();

		
		// QR DATA SPK
		$qr = $this->db->select('*');
		$qr = $this->db->from('tb_batch_spk_detail');
		$qr = $this->db->join('tb_spk','tb_batch_spk_detail.batch_spk_det_spk_no = tb_spk.spk_no','left');
		$qr = $this->db->join('tb_user', 'tb_spk.spk_user = tb_user.user_id', 'left');
		$qr = $this->db->where('batch_spk_det_spk_id',$batch_spk_id);
		$qr = $this->db->order_by('tb_batch_spk_detail.batch_spk_det_spk_inv_mp','asc');
		$qr = $this->db->get();
		$arr_spk = $qr->result_array();

		$file_pdf = $row_batch->batch_spk_no;

		
		// group by material
		$qr_material = $this->db->query("SELECT
		tb_spk.spk_material_name,tb_spk.spk_print_side, SUM(tb_spk.spk_qty_material) as total
		FROM
		tb_batch_spk_detail
		INNER JOIN tb_batch_spk ON tb_batch_spk_detail.batch_spk_det_spk_id = tb_batch_spk.batch_spk_id
		INNER JOIN tb_spk ON tb_batch_spk_detail.batch_spk_det_spk_no = tb_spk.spk_no
		LEFT JOIN tb_product ON tb_spk.spk_prod_id = tb_product.prod_id
		LEFT OUTER JOIN tb_prod_var ON tb_spk.spk_prod_var_id = tb_prod_var.prod_var_id
		WHERE
		tb_batch_spk_detail.batch_spk_det_spk_id = $batch_spk_id
		GROUP BY
		tb_spk.spk_material_name,tb_spk.spk_print_side 
		");

		$arr_material = $qr_material->result_array();

		// group by cuttting
		
		$qr_cutting = $this->db->query("SELECT
		tb_spk.spk_cutting,SUM(tb_spk.spk_qty_material) as total
		FROM
		tb_batch_spk_detail
		INNER JOIN tb_batch_spk ON tb_batch_spk_detail.batch_spk_det_spk_id = tb_batch_spk.batch_spk_id
		INNER JOIN tb_spk ON tb_batch_spk_detail.batch_spk_det_spk_no = tb_spk.spk_no
		LEFT JOIN tb_product ON tb_spk.spk_prod_id = tb_product.prod_id
		LEFT OUTER JOIN tb_prod_var ON tb_spk.spk_prod_var_id = tb_prod_var.prod_var_id
		WHERE
		tb_batch_spk_detail.batch_spk_det_spk_id = $batch_spk_id
		GROUP BY
		tb_spk.spk_cutting");

		$arr_cutting = $qr_cutting->result_array();

		// group by lamination
		$qr_lam = $this->db->query("SELECT tb_spk.spk_lamination,SUM(tb_spk.spk_qty_material) as total
		FROM
		tb_batch_spk_detail
		INNER JOIN tb_batch_spk ON tb_batch_spk_detail.batch_spk_det_spk_id = tb_batch_spk.batch_spk_id
		INNER JOIN tb_spk ON tb_batch_spk_detail.batch_spk_det_spk_no = tb_spk.spk_no
		LEFT JOIN tb_product ON tb_spk.spk_prod_id = tb_product.prod_id
		LEFT OUTER JOIN tb_prod_var ON tb_spk.spk_prod_var_id = tb_prod_var.prod_var_id
		WHERE
		tb_batch_spk_detail.batch_spk_det_spk_id = $batch_spk_id AND
		tb_spk.spk_lamination != 'Tanpa Laminasi'
		GROUP BY
		tb_spk.spk_lamination");

		$arr_lam = $qr_lam->result_array();

	
		error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
        $pdf =  new PDF_Code128('P','cm',array(10.5,14.8));

		// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
		$pdf->SetMargins(0.5,0.5,0.5,0.5);

		
		//$this->fpdf->SetAutoPageBreak('auto',1);
		/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
		di footer, nanti kita akan membuat page number dengan format : number page / total page
		*/
		$pdf->AliasNbPages();
		$pdf->SetAutoPageBreak(true,0.5);
		
		// AddPage merupakan fungsi untuk membuat halaman baru
		$pdf->AddPage();
		
		//$pdf->SetFont('arial','B',10);
		//$pdf->Cell(0,0.5,'Surat Perintah Kerja (SPK)',0,0,'C');


		//$pdf->Ln(1);

		//A set
		$pdf->SetFont('arial','I',6);
		$pdf->Cell(1.5, 0.4, 'Name',1,'LR','L');
		$pdf->SetFont('arial','',6);
		$pdf->Cell(2.5, 0.4, $row_batch->batch_spk_name,1,'LR','L');
		$pdf->Cell(0.4, 0.4, '',0,'LR','L');
		$pdf->Ln();
		$pdf->SetFont('arial','I',6);
		$pdf->Cell(1.5, 0.4, 'Created By',1,'LR','L');
		$pdf->SetFont('arial','',6);
		$pdf->Cell(2.5, 0.4,getDataTableById('tb_user','user_name','user_id',$row_batch->batch_spk_user_id),1,'LR','L');
		$pdf->Cell(0.4, 0.4, '',0,'LR','L');
		$pdf->Cell(1.5, 0.4, '',0,'LR','L');
		$pdf->SetFont('arial','',6);
		$pdf->Cell(0, 0.4, $row_batch->batch_spk_no,0,'LR','L');
		$pdf->Ln();
		$pdf->SetFont('arial','I',6);
		$pdf->Cell(1.5, 0.4, 'Date In',1,'LR','L');
		$pdf->SetFont('arial','',6);
		$pdf->Cell(2.5, 0.4, $row_batch->batch_spk_date_process,1,'LR','L');
		$pdf->Cell(0.4, 0.4, '',0,'LR','L');
		$pdf->Ln();
		$pdf->SetFont('arial','I',6);
		$pdf->Cell(1.5, 0.4, 'Deadline',1,'LR','L');
		$pdf->SetFont('arial','',6);
		$pdf->Cell(2.5, 0.4, $row_batch->batch_spk_date_deadline,1,'LR','L');

		$pdf->Ln();
		$pdf->SetFont('arial','I',6);
		$pdf->Cell(1.5, 0.4, 'JML SPK',1,'LR','L');
		$pdf->SetFont('arial','B',8);
		$pdf->Cell(2.5, 0.4, count($arr_spk),1,'LR','L');
		$pdf->Ln();


		
		$pdf->Code128(5,0.5,$row_batch->batch_spk_no,5,0.5);
		$pdf->Ln();
		
		/// MATERIAL
		$pdf->SetFont('arial','I',5);
		$pdf->Cell(4, 0.3, 'Material',1,'LR','L');
		$pdf->SetFont('arial','I',5);
		$pdf->Cell(0.7, 0.3, 'Qty',1,'LR','C');
		$pdf->Ln();

		foreach ($arr_material as $row_material)
		{
			$pdf->SetFont('arial','',5);
			$pdf->Cell(4, 0.3, $row_material['spk_material_name'].' '.$row_material['spk_print_side'],1,'LR','L');
			$pdf->SetFont('arial','',5);
			$pdf->Cell(0.7, 0.3, $row_material['total'],1,'LR','R');
			$pdf->Ln();
		}

		$pdf->Ln();


		/// CUTTING
		$pdf->SetFont('arial','I',5);
		$pdf->Cell(4, 0.3, 'Cutting',1,'LR','L');
		$pdf->SetFont('arial','I',5);
		$pdf->Cell(0.7, 0.3, 'Qty',1,'LR','C');
		$pdf->Ln();

		foreach ($arr_cutting as $row_cutting)
		{
			$pdf->SetFont('arial','',5);
			$pdf->Cell(4, 0.3, $row_cutting['spk_cutting'],1,'LR','L');
			$pdf->SetFont('arial','',5);
			$pdf->Cell(0.7, 0.3, $row_cutting['total'],1,'LR','R');
			$pdf->Ln();
		}

		$pdf->Ln();

		/// LAMINASI
		$pdf->SetFont('arial','I',5);
		$pdf->Cell(4, 0.3, 'Laminasi',1,'LR','L');
		$pdf->SetFont('arial','I',5);
		$pdf->Cell(0.7, 0.3, 'Qty',1,'LR','C');
		$pdf->Ln();

		foreach ($arr_lam as $row_lam)
		{
			$pdf->SetFont('arial','',5);
			$pdf->Cell(4, 0.3, $row_lam['spk_lamination'],1,'LR','L');
			$pdf->SetFont('arial','',5);
			$pdf->Cell(0.7, 0.3, $row_lam['total'],1,'LR','R');
			$pdf->Ln();
		}

		$pdf->Ln();

		


		/// DATA FINISHING
		$arr_finish = array();
		foreach ($arr_spk as $row_spk_finish)
		{	
			// explode
			if(trim($row_spk_finish['spk_instruction'])!="")
			{
				$ex_finish = explode(' | ',trim($row_spk_finish['spk_instruction']));
				$qty 	 = $row_spk_finish['spk_qty_material'];

				for ($i = 0 ; $i < $qty; $i++)
				{
					if(count($ex_finish) > 1){
						foreach($ex_finish as $val){
							$arr_f[] = trim($val);
						}
					}
					else
					{
						$arr_f[] = trim($row_spk_finish['spk_instruction']);
					}
					
				}
			}
			else
			{
				$arr_f[] = array();
			}
				

		}
		//echo '<pre>';
		//print_r($arr_f);

		//exit();
		
		$arr_finish = array_count_values($arr_f);

		$pdf->SetFont('arial','I',5);
		$pdf->Cell(4, 0.3, 'Finishing',1,'LR','L');
		$pdf->SetFont('arial','I',5);
		$pdf->Cell(0.7, 0.3, 'Qty',1,'LR','C');
		$pdf->Ln();

		foreach ($arr_finish as $key => $value)
		{
			$pdf->SetFont('arial','',5);
			$pdf->Cell(4, 0.3, $key,1,'LR','L');
			$pdf->SetFont('arial','',5);
			$pdf->Cell(0.7, 0.3, $value,1,'LR','R');
			$pdf->Ln();
		}
	
		$pdf->Ln();
	
		/// DATA SPK
		$pdf->SetFont('arial','I',5);
		$pdf->Cell(2.2, 0.3, 'INV - MP',1,'LR','L');
		$pdf->SetFont('arial','I',5);
		$pdf->Cell(1.8, 0.3, 'SPK NO',1,'LR','L');
		$pdf->SetFont('arial','I',5);
		$pdf->Cell(3, 0.3, 'Product',1,'LR','L');
		$pdf->SetFont('arial','I',5);
		$pdf->Cell(0.7, 0.3, 'LBR',1,'LR','C');
		$pdf->SetFont('arial','I',5);
		$pdf->Cell(0.7, 0.3, 'PCS',1,'LR','C');
		$pdf->SetFont('arial','I',5);
		$pdf->Cell(0.5, 0.3, 'C',1,'LR','L');
		$pdf->Ln();

		foreach ($arr_spk as $row_spk)
		{
			$pdf->SetFont('arial','',5);
			$pdf->Cell(2.2, 0.3, $row_spk['spk_inv_mp'],1,'LR','L');
			$pdf->SetFont('arial','',5);
			$pdf->Cell(1.8, 0.3, $row_spk['spk_no'],1,'LR','L');
			$pdf->SetFont('arial','',5);
			$pdf->Cell(3, 0.3, $row_spk['spk_prod_name'],1,'LR','L');
			$pdf->SetFont('arial','',5);
			$pdf->Cell(0.7, 0.3, $row_spk['spk_qty_material'],1,'LR','R');
			$pdf->SetFont('arial','',5);
			$pdf->Cell(0.7, 0.3, $row_spk['spk_qty_finish'],1,'LR','R');
			$pdf->SetFont('arial','',5);
			$pdf->Cell(0.5, 0.3, '',1,'LR','L');
			$pdf->Ln();
		}


		/* setting font untuk footer */
		$pdf->SetFont('arial','I',5);
		/* setting cell untuk waktu pencetakan */
		$pdf->write(1, 'SISPRINT | Nama File : '.$file_pdf.' | Printed on : '.mysqlDateNow().' | Printed by : '.$this->session->userdata('user_display_name').' | '.$pdf->PageNo());
		/* setting cell untuk page number */
		/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
		$pdf->Output($file_pdf,"I");
	}


	function done()
	{

		$data['title'] = 'SISPRINT - SCAN DONE';
		//sidebar prop
		$data['sidebar_active'] = "sidebar_bspk_done";
		$data['collapse_active'] = "bspk-nav";
		
		CreateLog('INFO','load page');
		$data['urut'] = $this->uri->segment(4);
		$data['template'] = 'batchspk/add_scan';
		$this->load->view('backend/index',$data);
	}


	function AjaxUpdateQty()
	{
		date_default_timezone_set('Asia/Jakarta');
		$time_now 	  = date('Y-m-d H:i:s');

		$spk_no 	= $this->input->post('spk_no');
		$qty_new 	= $this->input->post('qty_new');

		// update data
		$data_update_batch_detail = array
		(
			'batch_spk_det_done'			=> $time_now,
			'batch_spk_det_material_qty'	=> $qty_new,
			'batch_spk_det_done_user_id'	=> $this->session->userdata('user_id')
		);
		
		$this->db->where('batch_spk_det_spk_no',$spk_no);
		$this->db->update('tb_batch_spk_detail',$data_update_batch_detail);
		$this->db->trans_complete();
		// was there any update or error?
		if ($this->db->affected_rows() == '1') {
			echo 'success';
		} else {
			// any trans error?
			if ($this->db->trans_status() === FALSE) {
				echo 'error';
			}
			echo 'success';
		}
	
	}

	function AjaxDeleteAll()
	{
		date_default_timezone_set('Asia/Jakarta');
		$time_now 	  = date('Y-m-d H:i:s');

		$spk_no 	= $this->input->post('spk_no');

		// update data
		$data_update_batch_detail = array
		(
			'batch_spk_det_done'			=> '0000-00-00 00:00:00',
			'batch_spk_det_material_qty'	=> 0,
			'batch_spk_det_done_user_id'	=> $this->session->userdata('user_id')
		);
		
		$this->db->where('batch_spk_det_spk_no',$spk_no);
		$this->db->update('tb_batch_spk_detail',$data_update_batch_detail);

		$qr_spk_updated = $this->db->query("SELECT *
		FROM
		tb_spk
		LEFT OUTER JOIN tb_batch_spk_detail ON tb_spk.spk_no = tb_batch_spk_detail.batch_spk_det_spk_no
		WHERE tb_spk.spk_no = '$spk_no'");

		$data['input'] = $spk_no;
		$data['notif'] = "";
		$data['row_spk'] = $qr_spk_updated->row();
		$this->load->view('backend/batchspk/data_scan',$data);
	}


	function AjaxDeleteOne()
	{
		date_default_timezone_set('Asia/Jakarta');
		$time_now 	  = date('Y-m-d H:i:s');

		$spk_no 	= $this->input->post('spk_no');

		$qr_spk = $this->db->query("SELECT *
						FROM
						tb_spk
						LEFT OUTER JOIN tb_batch_spk_detail ON tb_spk.spk_no = tb_batch_spk_detail.batch_spk_det_spk_no
						WHERE tb_spk.spk_no = '$spk_no'");

						// update tb_batch_spk_detail
		$qty = $qr_spk->row()->batch_spk_det_material_qty-1;
		$data_update_batch_detail = array
		(
			'batch_spk_det_done'			=> '0000-00-00 00:00:00',
			'batch_spk_det_material_qty'	=> $qty,
			'batch_spk_det_done_user_id'	=> $this->session->userdata('user_id')
		);
		
		$this->db->where('batch_spk_det_spk_no',$spk_no);
		$this->db->update('tb_batch_spk_detail',$data_update_batch_detail);

		$qr_spk_updated = $this->db->query("SELECT *
		FROM
		tb_spk
		LEFT OUTER JOIN tb_batch_spk_detail ON tb_spk.spk_no = tb_batch_spk_detail.batch_spk_det_spk_no
		WHERE tb_spk.spk_no = '$spk_no'");

		$data['input'] = $spk_no;
		$data['notif'] = "";
		$data['row_spk'] = $qr_spk_updated->row();
		$this->load->view('backend/batchspk/data_scan',$data);
	}

	function AjaxInputscan()
	{
		$inputscan = trim($this->input->post('inputscan'));


		date_default_timezone_set('Asia/Jakarta');
		$time_now 	  = date('Y-m-d H:i:s');

		if($inputscan){
			if($inputscan == "")
			{
				$notif = '<div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
				<p>SPK : '. $inputscan. ' <br><strong>KOSONG</strong></p>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
					<audio id="myAudio">
					<source src="'.site_url().'/assets/audio/danger.mp3" type="audio/mpeg">
					Your browser does not support the audio element.
				</audio>';
				$data['input'] = $inputscan;
				$data['notif'] = $notif;
				$data['row_spk'] = '';
			}
			else
			{
				//check tb_spk
				$qr_scan_1 = $this->db->query("SELECT tb_spk.spk_id,tb_spk.spk_uid,
				tb_spk.spk_no
				FROM tb_spk WHERE tb_spk.spk_no = '$inputscan'");
				if($qr_scan_1->num_rows() != 0)
				{
					// check tb_batch_spk_detail
					$qr_scan_2 = $this->db->query("SELECT *
						FROM
						tb_batch_spk_detail
						WHERE batch_spk_det_spk_no = '$inputscan'");

					if($qr_scan_2->num_rows() != 0)
					{
						$qr_spk = $this->db->query("SELECT *
						FROM
						tb_spk
						LEFT OUTER JOIN tb_batch_spk_detail ON tb_spk.spk_no = tb_batch_spk_detail.batch_spk_det_spk_no
						WHERE tb_spk.spk_no = '$inputscan'");

						// update tb_batch_spk_detail
						$qty = $qr_spk->row()->batch_spk_det_material_qty+1;
						$data_update_batch_detail = array
						(
							'batch_spk_det_done'			=> $time_now,
							'batch_spk_det_material_qty'	=> $qty,
							'batch_spk_det_done_user_id'	=> $this->session->userdata('user_id')
						);
						
						$this->db->where('batch_spk_det_spk_no',$inputscan);
						$this->db->update('tb_batch_spk_detail',$data_update_batch_detail);

						// update tb_spk
						$data_spk = array
						(
							'spk_time_done'		=> $time_now,
							'spk_status'		=> 'Done'
						);
						
						$this->db->where('spk_no',$inputscan);
						$this->db->update('tb_spk',$data_spk);

						$notif = '<div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
								<p>SPK : '. $inputscan. ' <br><strong>SCAN BERHASIL!!</strong></p>
								<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
							<audio id="myAudio">
							<source src="'.site_url().'/assets/audio/success.mp3" type="audio/mpeg">
							Your browser does not support the audio element.
						</audio>';

						$qr_spk_updated = $this->db->query("SELECT *
						FROM
						tb_spk
						LEFT OUTER JOIN tb_batch_spk_detail ON tb_spk.spk_no = tb_batch_spk_detail.batch_spk_det_spk_no
						WHERE tb_spk.spk_no = '$inputscan'");

						$data['input'] = $inputscan;
						$data['notif'] = $notif;
						$data['row_spk'] = $qr_spk_updated->row();

					}
					else
					{
						$notif = '<div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
						<p>SPK : '. $inputscan. ' <br><strong>TIDAK ADA DI BATCH!!</strong></p>
						<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
							<audio id="myAudio">
							<source src="'.site_url().'/assets/audio/danger.mp3" type="audio/mpeg">
							Your browser does not support the audio element.
						</audio>';
						$data['input'] = $inputscan;
						$data['notif'] = $notif;
						$data['row_spk'] = '';
					}

				}
				else
				{
					$notif = '<div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
					<p>SPK : '. $inputscan. ' <br><strong>BELUM DI INPUT!!</strong></p>
					<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						<audio id="myAudio">
						<source src="'.site_url().'/assets/audio/danger.mp3" type="audio/mpeg">
						Your browser does not support the audio element.
					</audio>';
					$data['input'] = $inputscan;
					$data['notif'] = $notif;
					$data['row_spk'] = '';
				}
	
			}

		}else{
			$notif = '<div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
			<p>SPK : '. $inputscan. ' <br><strong>KOSONG!!</strong></p>
			<button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				<audio id="myAudio">
				<source src="'.site_url().'/assets/audio/danger.mp3" type="audio/mpeg">
				Your browser does not support the audio element.
			</audio>';
			$data['input'] = $inputscan;
			$data['notif'] = $notif;
			$data['row_spk'] = '';
		}

		$this->load->view('backend/batchspk/data_scan',$data);


	}


	function do_done()
	{
		$spk_id	= $this->uri->segment(4);

		$data = array
		(
			'spk_status'=> 'Done'
		);

		CreateLog('INFO','update data id '.$spk_id);
		$this->spk_model->UpdateSpk($spk_id,$data);

		redirect('backend/spk/process');
		
	}


	function do_process()
	{
		$spk_id	= $this->uri->segment(4);

		$data = array
		(
			'spk_status'=> 'Process'
		);

		CreateLog('INFO','update data id '.$spk_id);
		$this->spk_model->UpdateSpk($spk_id,$data);

		redirect('backend/spk/layout');
		
	}

	
	public function AjaxSearchBySKU()
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
				'prod_id'		=> $row_prod->prod_id
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