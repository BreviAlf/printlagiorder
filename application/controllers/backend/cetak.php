<?php

class Cetak extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->helper('bantuan_helper');
		$this->load->model('Listing_model');
		$this->load->library('fpdf');
		if(!$this->session->userdata('user_id') && !$this->session->userdata('user_display_name') ):
			redirect('backend');
		elseif($this->session->userdata('user_rule')=='Frontend'):
			redirect('backend/no_access');
		endif;

	}

	function index()
	{
		$data['urut'] = $this->uri->segment(4);
		$data['heading'] = 'Master Data';
		$data['title'] = $data['heading'].' - Listing';
		$data['template'] = 'm_listing/index';
		$this->load->view('backend/index',$data);
	}

	function head()
	{}

	function detail()
	{


		//define('FPDF_FONTPATH',$this->config->item('fonts_path'));

		$file_pdf = 'cetak_detail';

		/* Kita akan membuat header dari halaman pdf yang kita buat*/

		// query
		$id_listing	= $this->uri->segment(4);
		$row_data = $this->Listing_model->getListing(FALSE,$id_listing,FALSE,FALSE);

		$this->db->where('id_listing',$id_listing);
		$arr_files = $this->db->get('tb_files')->result_array();

		//date_default_timezone_set('Asia/Jakarta');
		$this->fpdf->FPDF("P","cm","A4");

		// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
		$this->fpdf->SetMargins(1,2,1);

		
		//$this->fpdf->SetAutoPageBreak('auto',1);
		/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
		di footer, nanti kita akan membuat page number dengan format : number page / total page
		*/
		$this->fpdf->AliasNbPages();
		$this->fpdf->SetAutoPageBreak(true,2);
		
		// AddPage merupakan fungsi untuk membuat halaman baru
		$this->fpdf->AddPage();
		
		// insert logo
		$this->fpdf->Image(base_url().'assets/image/logo.png',16.7,0,0,0);
		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('helvetica','',6);
		$this->fpdf->Ln();
		$this->fpdf->Cell(15.6, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(19,0.3,'Ray White Cipete',0,0,'L');
		$this->fpdf->Ln();
		$this->fpdf->Cell(15.6, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(19,0.3,'Jl. Cipete Raya No. 9C Jakarta Selatan',0,0,'L');
		$this->fpdf->Ln();
		$this->fpdf->Cell(15.6, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(19,0.3,'T : (62-21) 7500 956',0,0,'L');
		$this->fpdf->Ln();
		$this->fpdf->Cell(15.6, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(19,0.3,'E :raywhite.cipete@gmail.com',0,0,'L');
		$this->fpdf->Ln();
		$this->fpdf->Cell(15.6, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(19,0.3,'W : cipete.raywhite.co.id',0,0,'L');
		// Setting Font : String Family, String Style, Font size
		$this->fpdf->SetFont('helvetica','B',12);

		$this->fpdf->Ln(1);
		$this->fpdf->Cell(19,0.5,'Daftar Listing',0,0,'C');


		$this->fpdf->Ln(2);
		
		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Tanggal Listing',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, indDate($row_data->date_listing),0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Tanggal Expired',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, indDate(GetExpired($row_data->date_listing,getOption('expired'))),0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Jenis Listing',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->jenis_listing,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Nama Vendor',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->vendor_name,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'No Telp / HP',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5,$row_data->phone_1,0,'LR','L');
		$this->fpdf->Ln();

		$this->db->where('kab_prov_id',$row_data->prov);
		$this->db->where('kab_id',$row_data->kab);
		$row_kab = $this->db->get('tb_kabupaten')->row();

		if($row_kab->kab_name){
		  $kab = $row_kab->kab_name.', ';
		}else{
		  $kab = '';
		}

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Alamat Lengkap',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5,$row_data->address_full,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Kab / Provinsi',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5,$kab.''.getDataTableById('tb_prov','prov_name','prov_id',$row_data->prov),0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Alamat Singkat',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5,$row_data->addres_show,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Area',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5,$row_data->area,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'ME 1',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5,$row_data->me_1,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'ME 2',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5,$row_data->me_2,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'ME 3',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5,$row_data->me_3,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Tipe',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->type,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Luas Tanah',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->luas_tanah,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Luas Bangunan',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5,$row_data->luas_bangunan,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Kamar Tidur',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->jml_kt,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Kamar Mandi',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->jml_km,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Garasi',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->garasi,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Sertifikat',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->sertifikat,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Ket. Properti',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->ket_prop,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Ket. Listing',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->ket_listing,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Harga Jual',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, FormatRupiah($row_data->price_sell),0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Harga Sewa',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5,FormatRupiah($row_data->price_rent),0,'LR','L');
		$this->fpdf->Ln();
		
		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('helvetica','B',8);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','C');
		$this->fpdf->Cell(1 , 0.7, 'No' , 1, 'LR', 'C');
		$this->fpdf->Cell(5 , 0.7, 'Nama File' , 1, 'LR', 'C');
		$this->fpdf->Cell(12 , 0.7, 'Preview' , 1, 'LR', 'C');

		$i = 1;
		
		/* generate query files */
		foreach($arr_files as $row_files)
		{
			$file_path = base_url().''.$row_files['full_path'];
			

			$this->fpdf->Ln();
			$this->fpdf->SetFont('helvetica','',8);
			$this->fpdf->Cell(1, 5, '',0,'LR','C');
			$this->fpdf->Cell(1 , 5, $i, 1, 'LR', 'L');
			$this->fpdf->Cell(5 , 5, $row_files['user_rename'], 1, 'LR', 'L');
			if(@is_array(getimagesize($file_path))){
				$this->fpdf->Cell(12 , 5, $this->fpdf->Image($file_path, $this->fpdf->GetX()+0.25, $this->fpdf->GetY()+0.25, 0,4) , 1, 'LR', 'L');
			}else{
				$this->fpdf->Cell(12 , 5,$file_path, 1, 'LR', 'L');
			}	
			$i++;
		}

		// fungsi Ln untuk membuat baris baru
		$this->fpdf->Ln();
		 // Position at 1.5 cm from bottom
		$this->fpdf->SetY(-2);
		/* setting font untuk footer */
		$this->fpdf->SetFont('helvetica','',5);
		/* setting cell untuk waktu pencetakan */
		$this->fpdf->Cell(0,0, 'Dokumen ini dicetak otomatis | Nama File : '.$file_pdf.' | Printed on : '.mysqlDateNow().' | Created by : '.$this->session->userdata('user_display_name').' | '.$this->fpdf->PageNo(),0,'LR','R');
		/* setting cell untuk page number */
		//$this->fpdf->Cell(9.5, 0.5, 'Page '.$this->fpdf->PageNo().'/{nb}',0,0,'R');
		/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
		$this->fpdf->Output($file_pdf,"I");
	}

	function client()
	{


	//	define('FPDF_FONTPATH',$this->config->item('fonts_path'));

		$file_pdf = 'cetak_clent';

		/* Kita akan membuat header dari halaman pdf yang kita buat*/

		// query
		$id_listing	= $this->uri->segment(4);
		$row_data = $this->Listing_model->getListing(FALSE,$id_listing,FALSE,FALSE);

		$this->db->where('id_listing',$id_listing);
		$arr_files = $this->db->get('tb_files')->result_array();

		//date_default_timezone_set('Asia/Jakarta');
		$this->fpdf->FPDF("P","cm","A4");

		// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
		$this->fpdf->SetMargins(1,2,1);

		
		//$this->fpdf->SetAutoPageBreak('auto',1);
		/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
		di footer, nanti kita akan membuat page number dengan format : number page / total page

		https:cipete.raywhite.co.id
		*/
		$this->fpdf->AliasNbPages();
		$this->fpdf->SetAutoPageBreak(true,2);
		
		// AddPage merupakan fungsi untuk membuat halaman baru
		$this->fpdf->AddPage();
		
		// insert logo
		$this->fpdf->Image(base_url().'assets/image/logo.png',16.7,0,0,0);
		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('helvetica','',6);
		$this->fpdf->Ln();
		$this->fpdf->Cell(15.6, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(19,0.3,'Ray White Cipete',0,0,'L');
		$this->fpdf->Ln();
		$this->fpdf->Cell(15.6, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(19,0.3,'Jl. Cipete Raya No. 9C Jakarta Selatan',0,0,'L');
		$this->fpdf->Ln();
		$this->fpdf->Cell(15.6, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(19,0.3,'T : (62-21) 7500 956',0,0,'L');
		$this->fpdf->Ln();
		$this->fpdf->Cell(15.6, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(19,0.3,'E :raywhite.cipete@gmail.com',0,0,'L');
		$this->fpdf->Ln();
		$this->fpdf->Cell(15.6, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(19,0.3,'W : cipete.raywhite.co.id',0,0,'L');
		// Setting Font : String Family, String Style, Font size
		$this->fpdf->SetFont('helvetica','B',12);

		$this->fpdf->Ln(1);
		$this->fpdf->Cell(19,0.5,'Daftar Listing',0,0,'C');


		$this->fpdf->Ln(2);
		
		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Jenis Listing',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->jenis_listing,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Alamat',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5,$row_data->addres_show,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Area',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5,$row_data->area,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Tipe',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->type,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Luas Tanah',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->luas_tanah,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Luas Bangunan',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5,$row_data->luas_bangunan,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Kamar Tidur',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->jml_kt,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Kamar Mandi',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->jml_km,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Garasi',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->garasi,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Sertifikat',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->sertifikat,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Keterangan',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->ket_prop,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Harga Jual',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, FormatRupiah($row_data->price_sell),0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Harga Sewa',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5,FormatRupiah($row_data->price_rent),0,'LR','L');
		$this->fpdf->Ln();
		
		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('helvetica','B',8);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','C');
		$this->fpdf->Cell(1 , 0.7, 'No' , 1, 'LR', 'C');
		$this->fpdf->Cell(5 , 0.7, 'Nama File' , 1, 'LR', 'C');
		$this->fpdf->Cell(12 , 0.7, 'Preview' , 1, 'LR', 'C');

		$i = 1;
		
		/* generate query files */
		foreach($arr_files as $row_files)
		{
			$file_path = base_url().''.$row_files['full_path'];
			

			$this->fpdf->Ln();
			$this->fpdf->SetFont('helvetica','',8);
			$this->fpdf->Cell(1, 5, '',0,'LR','C');
			$this->fpdf->Cell(1 , 5, $i, 1, 'LR', 'L');
			$this->fpdf->Cell(5 , 5, $row_files['user_rename'], 1, 'LR', 'L');
			if(@is_array(getimagesize($file_path))){
				$this->fpdf->Cell(12 , 5, $this->fpdf->Image($file_path, $this->fpdf->GetX()+0.25, $this->fpdf->GetY()+0.25, 0,4) , 1, 'LR', 'L');
			}else{
				$this->fpdf->Cell(12 , 5,$file_path, 1, 'LR', 'L');
			}	
			$i++;
		}

		// fungsi Ln untuk membuat baris baru
		$this->fpdf->Ln();
		 // Position at 1.5 cm from bottom
		$this->fpdf->SetY(-2);
		/* setting font untuk footer */
		$this->fpdf->SetFont('helvetica','',5);
		/* setting cell untuk waktu pencetakan */
		$this->fpdf->Cell(0,0, 'Dokumen ini dicetak otomatis | Nama File : '.$file_pdf.' | Printed on : '.mysqlDateNow().' | Created by : '.$this->session->userdata('user_display_name').' | '.$this->fpdf->PageNo(),0,'LR','R');
		/* setting cell untuk page number */
		//$this->fpdf->Cell(9.5, 0.5, 'Page '.$this->fpdf->PageNo().'/{nb}',0,0,'R');
		/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
		$this->fpdf->Output($file_pdf,"I");
	}


	function singkat()
	{


	//	define('FPDF_FONTPATH',$this->config->item('fonts_path'));

		$file_pdf = 'cetak_detail';

		/* Kita akan membuat header dari halaman pdf yang kita buat*/

		// query
		$id_listing	= $this->uri->segment(4);
		$row_data = $this->Listing_model->getListing(FALSE,$id_listing,FALSE,FALSE);

		$this->db->where('id_listing',$id_listing);
		$arr_files = $this->db->get('tb_files')->result_array();

		//date_default_timezone_set('Asia/Jakarta');
		$this->fpdf->FPDF("P","cm","A4");

		// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
		$this->fpdf->SetMargins(1,2,1);

		
		//$this->fpdf->SetAutoPageBreak('auto',1);
		/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
		di footer, nanti kita akan membuat page number dengan format : number page / total page
		*/
		$this->fpdf->AliasNbPages();
		$this->fpdf->SetAutoPageBreak(true,2);
		
		// AddPage merupakan fungsi untuk membuat halaman baru
		$this->fpdf->AddPage();
		
		// insert logo
		$this->fpdf->Image(base_url().'assets/image/logo.png',16.7,0,0,0);
		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('helvetica','',6);
		$this->fpdf->Ln();
		$this->fpdf->Cell(15.6, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(19,0.3,'Ray White Cipete',0,0,'L');
		$this->fpdf->Ln();
		$this->fpdf->Cell(15.6, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(19,0.3,'Jl. Cipete Raya No. 9C Jakarta Selatan',0,0,'L');
		$this->fpdf->Ln();
		$this->fpdf->Cell(15.6, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(19,0.3,'T : (62-21) 7500 956',0,0,'L');
		$this->fpdf->Ln();
		$this->fpdf->Cell(15.6, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(19,0.3,'E :raywhite.cipete@gmail.com',0,0,'L');
		$this->fpdf->Ln();
		$this->fpdf->Cell(15.6, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(19,0.3,'W : cipete.raywhite.co.id',0,0,'L');
		// Setting Font : String Family, String Style, Font size
		$this->fpdf->SetFont('helvetica','B',12);

		$this->fpdf->Ln(1);
		$this->fpdf->Cell(19,0.5,'Daftar Listing',0,0,'C');


		$this->fpdf->Ln(2);
		
		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Jenis Listing',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->jenis_listing,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Alamat',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5,$row_data->addres_show,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Area',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5,$row_data->area,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'ME 1',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5,$row_data->me_1,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'ME 2',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5,$row_data->me_2,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'ME 3',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5,$row_data->me_3,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Tipe',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->type,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Luas Tanah',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->luas_tanah,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Luas Bangunan',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5,$row_data->luas_bangunan,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Kamar Tidur',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->jml_kt,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Kamar Mandi',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->jml_km,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Garasi',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->garasi,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Sertifikat',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->sertifikat,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Keterangan',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, $row_data->ket_prop,0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Harga Jual',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5, FormatRupiah($row_data->price_sell),0,'LR','L');
		$this->fpdf->Ln();

		$this->fpdf->SetFont('helvetica','B',9);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(3.5, 0.5, 'Harga Sewa',0,'LR','L');
		$this->fpdf->Cell(0.5, 0.5, ':',0,'LR','L');
		$this->fpdf->SetFont('helvetica','',9);
		$this->fpdf->Cell(9, 0.5,FormatRupiah($row_data->price_rent),0,'LR','L');
		$this->fpdf->Ln();
		
		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('helvetica','B',8);
		$this->fpdf->Cell(1, 0.5, '',0,'LR','C');
		$this->fpdf->Cell(1 , 0.7, 'No' , 1, 'LR', 'C');
		$this->fpdf->Cell(5 , 0.7, 'Nama File' , 1, 'LR', 'C');
		$this->fpdf->Cell(12 , 0.7, 'Preview' , 1, 'LR', 'C');

		$i = 1;
		
		/* generate query files */
		foreach($arr_files as $row_files)
		{
			$file_path = base_url().''.$row_files['full_path'];
			

			$this->fpdf->Ln();
			$this->fpdf->SetFont('helvetica','',8);
			$this->fpdf->Cell(1, 5, '',0,'LR','C');
			$this->fpdf->Cell(1 , 5, $i, 1, 'LR', 'L');
			$this->fpdf->Cell(5 , 5, $row_files['user_rename'], 1, 'LR', 'L');
			if(@is_array(getimagesize($file_path))){
				$this->fpdf->Cell(12 , 5, $this->fpdf->Image($file_path, $this->fpdf->GetX()+0.25, $this->fpdf->GetY()+0.25, 0,4) , 1, 'LR', 'L');
			}else{
				$this->fpdf->Cell(12 , 5,$file_path, 1, 'LR', 'L');
			}	
			$i++;
		}

		// fungsi Ln untuk membuat baris baru
		$this->fpdf->Ln();
		 // Position at 1.5 cm from bottom
		$this->fpdf->SetY(-2);
		/* setting font untuk footer */
		$this->fpdf->SetFont('helvetica','',5);
		/* setting cell untuk waktu pencetakan */
		$this->fpdf->Cell(0,0, 'Dokumen ini dicetak otomatis | Nama File : '.$file_pdf.' | Printed on : '.mysqlDateNow().' | Created by : '.$this->session->userdata('user_display_name').' | '.$this->fpdf->PageNo(),0,'LR','R');
		/* setting cell untuk page number */
		//$this->fpdf->Cell(9.5, 0.5, 'Page '.$this->fpdf->PageNo().'/{nb}',0,0,'R');
		/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
		$this->fpdf->Output($file_pdf,"I");
	}

	function export_search_smart()
	{


	//	define('FPDF_FONTPATH',$this->config->item('fonts_path'));

		$file_pdf = 'cetak_search_smart';

		/* Kita akan membuat header dari halaman pdf yang kita buat*/

		// query
		$keywords	= $this->uri->segment(4);
		$this->db->like('keywords', $keywords);
		$arr_data = $this->db->get('tb_m_listing')->result_array();

		//date_default_timezone_set('Asia/Jakarta');
		$this->fpdf->FPDF("L","cm","A4");

		// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
		$this->fpdf->SetMargins(1,2,1);

		
		//$this->fpdf->SetAutoPageBreak('auto',1);
		/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
		di footer, nanti kita akan membuat page number dengan format : number page / total page
		*/

		
		// AddPage merupakan fungsi untuk membuat halaman baru
		$this->fpdf->AddPage();
	

		// insert logo
		$this->fpdf->Image(base_url().'assets/image/logo.png',24.7,0,0,0);
		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('helvetica','',6);
		$this->fpdf->Ln();
		$this->fpdf->Cell(23.6, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(19,0.3,'Ray White Cipete',0,0,'L');
		$this->fpdf->Ln();
		$this->fpdf->Cell(23.6, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(19,0.3,'Jl. Cipete Raya No. 9C Jakarta Selatan',0,0,'L');
		$this->fpdf->Ln();
		$this->fpdf->Cell(23.6, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(19,0.3,'T : (62-21) 7500 956',0,0,'L');
		$this->fpdf->Ln();
		$this->fpdf->Cell(23.6, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(19,0.3,'E :raywhite.cipete@gmail.com',0,0,'L');
		$this->fpdf->Ln();
		$this->fpdf->Cell(23.6, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(19,0.3,'W : cipete.raywhite.co.id',0,0,'L');


		// Setting Font : String Family, String Style, Font size
		$this->fpdf->SetFont('helvetica','B',12);

		$this->fpdf->Ln(1);
		$this->fpdf->Cell(24,0.5,'Daftar Pencarian Listing',0,0,'C');


		$this->fpdf->Ln(1);
		
		$i = 1;

	/* ————– Header Halaman selesai ———————————————— 
		Type	Area	Alamat	Spesifikasi	Marketing	Sertfikat	Harga	Keterangan
		*/
		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('helvetica','B',8);
		$this->fpdf->Cell(1 , 0.7, 'No' , 1, 'LR', 'C');
		$this->fpdf->Cell(1.5 , 0.7, 'Type' , 1, 'LR', 'C');
		$this->fpdf->Cell(2 , 0.7, 'Area' , 1, 'LR', 'C');
		$this->fpdf->Cell(5 , 0.7, 'Alamat' , 1, 'LR', 'C');
		$this->fpdf->Cell(1 , 0.7, 'LT' , 1, 'LR', 'C');
		$this->fpdf->Cell(1 , 0.7, 'LB' , 1, 'LR', 'C');
		$this->fpdf->Cell(1 , 0.7, 'KT' , 1, 'LR', 'C');
		$this->fpdf->Cell(1 , 0.7, 'KM' , 1, 'LR', 'C');
		$this->fpdf->Cell(1 , 0.7, 'Grs' , 1, 'LR', 'C');
		$this->fpdf->Cell(3 , 0.7, 'Marketing' , 1, 'LR', 'C');
		$this->fpdf->Cell(1 , 0.7, 'Srt' , 1, 'LR', 'C');
		$this->fpdf->Cell(2.5 , 0.7, 'Jual' , 1, 'LR', 'C');
		$this->fpdf->Cell(2.5 , 0.7, 'Sewa' , 1, 'LR', 'C');
		$this->fpdf->Cell(5 , 0.7, 'Ket' , 1, 'LR', 'C');
		
		/* generate query files */
		foreach($arr_data as $row_data)
		{
			$marketing_1 = $row_data['me_1'];
			$marketing_2 = '';
			$marketing_3 = '';
			if($row_data['me_2']){
				$marketing_2 = '-'.$row_data['me_2'];
			}
			if($row_data['me_3']){
				$marketing_3 = '-'.$row_data['me_3'];
			}

			$marketing = $marketing_1.''.$marketing_2.''.$marketing_3;

			$this->fpdf->Ln();
			$this->fpdf->SetFont('helvetica','',8);
			$this->fpdf->Cell(1 ,0.7, $i, 1, 'LR', 'L');
			$this->fpdf->Cell(1.5 ,0.7, $row_data['type'], 1, 'LR', 'L');
			$this->fpdf->SetFont('helvetica','',6);
			$this->fpdf->Cell(2 ,0.7, $row_data['area'], 1, 'LR', 'L');
			$this->fpdf->Cell(5 ,0.7, $row_data['addres_show'], 1, 'LR', 'L');
			$this->fpdf->SetFont('helvetica','',8);
			$this->fpdf->Cell(1 ,0.7, $row_data['luas_tanah'], 1, 'LR', 'L');
			$this->fpdf->Cell(1 ,0.7, $row_data['luas_bangunan'], 1, 'LR', 'L');
			$this->fpdf->Cell(1 ,0.7, $row_data['jml_kt'], 1, 'LR', 'L');
			$this->fpdf->Cell(1 ,0.7, $row_data['jml_km'], 1, 'LR', 'L');
			$this->fpdf->Cell(1 ,0.7, $row_data['garasi'], 1, 'LR', 'L');
			$this->fpdf->SetFont('helvetica','',6);
			$this->fpdf->Cell(3 ,0.7, $marketing, 1, 'LR', 'L');
			$this->fpdf->SetFont('helvetica','',8);
			$this->fpdf->Cell(1 ,0.7, $row_data['sertifikat'], 1, 'LR', 'L');
			$this->fpdf->SetFont('helvetica','',7);
			$this->fpdf->Cell(2.5 ,0.7, FormatRupiah($row_data['price_sell']), 1, 'LR', 'R');
			$this->fpdf->Cell(2.5 ,0.7, FormatRupiah($row_data['price_rent']), 1, 'LR', 'R');
			$this->fpdf->SetFont('helvetica','',6);
			$this->fpdf->Cell(5 ,0.7, $row_data['ket_prop'], 1, 'LR', 'L');

			$i++;
		}

		// fungsi Ln untuk membuat baris baru
		$this->fpdf->Ln();
		 // Position at 1.5 cm from bottom
		$this->fpdf->SetY(-2);
		/* setting font untuk footer */
		$this->fpdf->SetFont('helvetica','',5);
		/* setting cell untuk waktu pencetakan */
		$this->fpdf->AliasNbPages();
		$this->fpdf->SetAutoPageBreak(true,1);
		$this->fpdf->Cell(0,0, 'Dokumen ini dicetak otomatis | Nama File : '.$file_pdf.' | Printed on : '.mysqlDateNow().' | Created by : '.$this->session->userdata('user_display_name').' | '.$this->fpdf->PageNo(),0,'LR','R');
		/* setting cell untuk page number */
		//$this->fpdf->Cell(9.5, 0.5, 'Page '.$this->fpdf->PageNo().'/{nb}',0,0,'R');
		/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
		$this->fpdf->Output($file_pdf,"I");
	}


	function export_search_listing()
	{
		$jenis 		= 	$this->input->post('name_jenis_listing');
		$name_type	=	$this->input->post('name_type');
		$harga_min	=	str_replace('.','',$this->input->post('harga_min'));
		$harga_max	=	str_replace('.','',$this->input->post('harga_max'));
		$luas_tanah		=	$this->input->post('luas_tanah');
		$luas_bangunan	=	$this->input->post('luas_bangunan');
		$prov_id	=	$this->input->post('prov_id');
		$kab_id		=	$this->input->post('kab_id');
		$kotkec_id	=	$this->input->post('kotkec_id');
		$area		=	$this->input->post('area');

		$harga		=	$this->input->post('harga');
		$luas		=	$this->input->post('luas');
		$lokasi		=	$this->input->post('lokasi');
		$check_mkt		=	$this->input->post('check_mkt');
		$check_date		=	$this->input->post('check_date');
		$check_stat		=	$this->input->post('check_stat');

		$name_marketing_1	= $this->input->post('name_marketing_1');
		$name_marketing_2	= $this->input->post('name_marketing_2');
		$name_marketing_3	= $this->input->post('name_marketing_3');
		$date_listing_from	= $this->input->post('date_listing_from');
		$date_listing_to	= $this->input->post('date_listing_to');
		$status_name		= $this->input->post('status_name');

		// if harga checked
		if($harga == 1){
			// if sell
			if($jenis=='Jual'){
				$this->db->where('price_sell >=', $harga_min);
				$this->db->where('price_sell <=', $harga_max);
			}else if($jenis=='Sewa'){
				$this->db->where('price_rent >=', $harga_min);
				$this->db->where('price_rent <=', $harga_max);
			}
		}

		// if luas checked
		if($luas == 1){
			// plan to add in tb_option
			if ($luas_tanah):
				$l_tanah_max = $luas_tanah + 100;
				$l_tanah_min = $luas_tanah - 100;
			else:
				$l_tanah_max = '';
				$l_tanah_min = '';
			endif;

			// plan to add in tb_option
			if ($luas_bangunan):
				$l_bangunan_max = $luas_bangunan + 100;
				$l_bangunan_min = $luas_bangunan - 100;
			else:
				$l_bangunan_max = '';
				$l_bangunan_min = '';
			endif;

			$this->db->where('luas_tanah >=', $l_tanah_min);
			$this->db->where('luas_tanah <=', $l_tanah_max);
			$this->db->where('luas_bangunan >=', $l_bangunan_min);
			$this->db->where('luas_bangunan <=', $l_bangunan_max);
		}

		// if lokasi chhecked
		if($lokasi == 1){
			$this->db->like('area', $area);

			if($prov_id){
				$this->db->where('prov', $prov_id);
			}
			if($kab_id){
				$this->db->where('kab', $kab_id);
			}
			/*
			if($kotkec_id){
				$this->db->where('kotkec', $kotkec_id);
			}
			*/
			
		}

		// if mkt checked
		if($check_mkt == 1){
			if($name_marketing_1){
				$this->db->where('me_1', $name_marketing_1);
			}
			if($name_marketing_2){
				$this->db->where('me_2', $name_marketing_2);
			}
			if($name_marketing_3){
				$this->db->where('me_3', $name_marketing_3);
			}
		}

		// if date checked
		if($check_date == 1){
			if($date_listing_from != '' && $date_listing_to != ''){
				$this->db->where('date_listing BETWEEN "'. date('Y-m-d', strtotime($date_listing_from)). '" and "'. date('Y-m-d', strtotime($date_listing_to)).'"');
			}
		}


		//if stat checked
		if($check_stat == 1){
			$this->db->where('status', $status_name);
		}
		// query search

		$this->db->where('type', $name_type);
		$this->db->where('jenis_listing', $jenis);
		$arr_data = $this->db->get('tb_m_listing')->result_array();

		//	define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		$file_pdf = 'cetak_search_listing.pdf';
		/* Kita akan membuat header dari halaman pdf yang kita buat*/

		// query

		//date_default_timezone_set('Asia/Jakarta');
		$this->fpdf->FPDF("L","cm","A4");

		// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
		$this->fpdf->SetMargins(1,2,1);

		
		//$this->fpdf->SetAutoPageBreak('auto',1);
		/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
		di footer, nanti kita akan membuat page number dengan format : number page / total page
		*/
		$this->fpdf->AliasNbPages();
		$this->fpdf->SetAutoPageBreak(true,2);
		
		// AddPage merupakan fungsi untuk membuat halaman baru
		$this->fpdf->AddPage();
		
		// insert logo
		$this->fpdf->Image(base_url().'assets/image/logo.png',24.7,0,0,0);
		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('helvetica','',6);
		$this->fpdf->Ln();
		$this->fpdf->Cell(23.6, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(19,0.3,'Ray White Cipete',0,0,'L');
		$this->fpdf->Ln();
		$this->fpdf->Cell(23.6, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(19,0.3,'Jl. Cipete Raya No. 9C Jakarta Selatan',0,0,'L');
		$this->fpdf->Ln();
		$this->fpdf->Cell(23.6, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(19,0.3,'T : (62-21) 7500 956',0,0,'L');
		$this->fpdf->Ln();
		$this->fpdf->Cell(23.6, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(19,0.3,'E :raywhite.cipete@gmail.com',0,0,'L');
		$this->fpdf->Ln();
		$this->fpdf->Cell(23.6, 0.5, '',0,'LR','L');
		$this->fpdf->Cell(19,0.3,'W : cipete.raywhite.co.id',0,0,'L');
		// Setting Font : String Family, String Style, Font size
		$this->fpdf->SetFont('helvetica','B',12);

		$this->fpdf->Ln(1);
		$this->fpdf->Cell(24,0.5,'Daftar Pencarian Listing',0,0,'C');


		$this->fpdf->Ln(1);
		
		$i = 1;

		/* ————– Header Halaman selesai ———————————————— 
		Type	Area	Alamat	Spesifikasi	Marketing	Sertfikat	Harga	Keterangan
		*/
		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('helvetica','B',8);
		$this->fpdf->Cell(1 , 0.7, 'No' , 1, 'LR', 'C');
		$this->fpdf->Cell(1.5 , 0.7, 'Type' , 1, 'LR', 'C');
		$this->fpdf->Cell(2 , 0.7, 'Area' , 1, 'LR', 'C');
		$this->fpdf->Cell(5 , 0.7, 'Alamat' , 1, 'LR', 'C');
		$this->fpdf->Cell(1 , 0.7, 'LT' , 1, 'LR', 'C');
		$this->fpdf->Cell(1 , 0.7, 'LB' , 1, 'LR', 'C');
		$this->fpdf->Cell(1 , 0.7, 'KT' , 1, 'LR', 'C');
		$this->fpdf->Cell(1 , 0.7, 'KM' , 1, 'LR', 'C');
		$this->fpdf->Cell(1 , 0.7, 'Grs' , 1, 'LR', 'C');
		$this->fpdf->Cell(3 , 0.7, 'Marketing' , 1, 'LR', 'C');
		$this->fpdf->Cell(1 , 0.7, 'Srt' , 1, 'LR', 'C');
		$this->fpdf->Cell(2.5 , 0.7, 'Jual' , 1, 'LR', 'C');
		$this->fpdf->Cell(2.5 , 0.7, 'Sewa' , 1, 'LR', 'C');
		$this->fpdf->Cell(5 , 0.7, 'Ket' , 1, 'LR', 'C');
		
		/* generate query files */
		foreach($arr_data as $row_data)
		{
			$marketing_1 = $row_data['me_1'];
			$marketing_2 = '';
			$marketing_3 = '';
			if($row_data['me_2']){
				$marketing_2 = '-'.$row_data['me_2'];
			}
			if($row_data['me_3']){
				$marketing_3 = '-'.$row_data['me_3'];
			}

			$marketing = $marketing_1.''.$marketing_2.''.$marketing_3;

			$this->fpdf->Ln();
			$this->fpdf->SetFont('helvetica','',8);
			$this->fpdf->Cell(1 ,0.7, $i, 1, 'LR', 'L');
			$this->fpdf->Cell(1.5 ,0.7, $row_data['type'], 1, 'LR', 'L');
			$this->fpdf->SetFont('helvetica','',6);
			$this->fpdf->Cell(2 ,0.7, $row_data['area'], 1, 'LR', 'L');
			$this->fpdf->Cell(5 ,0.7, $row_data['addres_show'], 1, 'LR', 'L');
			$this->fpdf->SetFont('helvetica','',8);
			$this->fpdf->Cell(1 ,0.7, $row_data['luas_tanah'], 1, 'LR', 'L');
			$this->fpdf->Cell(1 ,0.7, $row_data['luas_bangunan'], 1, 'LR', 'L');
			$this->fpdf->Cell(1 ,0.7, $row_data['jml_kt'], 1, 'LR', 'L');
			$this->fpdf->Cell(1 ,0.7, $row_data['jml_km'], 1, 'LR', 'L');
			$this->fpdf->Cell(1 ,0.7, $row_data['garasi'], 1, 'LR', 'L');
			$this->fpdf->SetFont('helvetica','',6);
			$this->fpdf->Cell(3 ,0.7, $marketing, 1, 'LR', 'L');
			$this->fpdf->SetFont('helvetica','',8);
			$this->fpdf->Cell(1 ,0.7, $row_data['sertifikat'], 1, 'LR', 'L');
			$this->fpdf->SetFont('helvetica','',7);
			$this->fpdf->Cell(2.5 ,0.7, FormatRupiah($row_data['price_sell']), 1, 'LR', 'R');
			$this->fpdf->Cell(2.5 ,0.7, FormatRupiah($row_data['price_rent']), 1, 'LR', 'R');
			$this->fpdf->SetFont('helvetica','',6);
			$this->fpdf->Cell(5 ,0.7, $row_data['ket_prop'], 1, 'LR', 'L');

			$i++;
		}

		// fungsi Ln untuk membuat baris baru
		$this->fpdf->Ln();
		 // Position at 1.5 cm from bottom
		$this->fpdf->SetY(-2);
		/* setting font untuk footer */
		$this->fpdf->SetFont('helvetica','',5);
		/* setting cell untuk waktu pencetakan */
		$this->fpdf->Cell(0,0, 'Dokumen ini dicetak otomatis | Nama File : '.$file_pdf.' | Printed on : '.mysqlDateNow().' | Created by : '.$this->session->userdata('user_display_name').' | '.$this->fpdf->PageNo(),0,'LR','R');
		/* setting cell untuk page number */
		//$this->fpdf->Cell(9.5, 0.5, 'Page '.$this->fpdf->PageNo().'/{nb}',0,0,'R');
		/* generate pdf jika semua konstruktor, data yang akan ditampilkan, dll sudah selesai */
		ob_end_clean();
		$this->fpdf->Output($file_pdf,"D");

		// Send Headers
	}

	function WordWrap(&$text, $maxwidth)
	{
	    $text = trim($text);
	    if ($text==='')
	        return 0;
	    $space = $this->fpdf->GetStringWidth(' ');
	    $lines = explode("\n", $text);
	    $text = '';
	    $count = 0;

	    foreach ($lines as $line)
	    {
	        $words = preg_split('/ +/', $line);
	        $width = 0;

	        foreach ($words as $word)
	        {
	            $wordwidth = $this->fpdf->GetStringWidth($word);
	            if ($wordwidth > $maxwidth)
	            {
	                // Word is too long, we cut it
	                for($i=0; $i<strlen($word); $i++)
	                {
	                    $wordwidth = $this->fpdf->GetStringWidth(substr($word, $i, 1));
	                    if($width + $wordwidth <= $maxwidth)
	                    {
	                        $width += $wordwidth;
	                        $text .= substr($word, $i, 1);
	                    }
	                    else
	                    {
	                        $width = $wordwidth;
	                        $text = rtrim($text)."\n".substr($word, $i, 1);
	                        $count++;
	                    }
	                }
	            }
	            elseif($width + $wordwidth <= $maxwidth)
	            {
	                $width += $wordwidth + $space;
	                $text .= $word.' ';
	            }
	            else
	            {
	                $width = $wordwidth + $space;
	                $text = rtrim($text)."\n".$word.' ';
	                $count++;
	            }
	        }
	        $text = rtrim($text)."\n";
	        $count++;
	    }
	    $text = rtrim($text);
	    return $count;
	}
	
}