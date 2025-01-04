<?php
class report extends CI_Controller {

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

	public function index()
	{

	}

	public function export_report_csv(){
		$data['title'] = 'SISPRINT - Export Report CSV';
		//sidebar prop
		$data['collapse_active'] = "report-nav";
		$data['template'] = 'report/index';
		$this->load->view('backend/index', $data);
	}


	function get_data_spk_layout()
	{
		$ym = $this->input->post('spk_layout_date');

		if($ym){
			ini_set('max_execution_time', '150'); //300 seconds = 5 minutes
			$begin = $ym.'-01';
			$oDate = new DateTime($begin);
			$end = $oDate->format("Y-m-t");
			$this->download_send_headers("SPK_LAYOUT_" . $begin ."_".$end. ".xls");
			$this->array2xls($this->arr_data_spk_layout($begin,$end));
			die();
		}else{
			redirect('backend/report/export_report_csv');
		}
		
	}

	function get_data_spk_admin()
	{
		$ym = $this->input->post('spk_admin_date');

		if($ym){
			ini_set('max_execution_time', '150'); //300 seconds = 5 minutes
			$begin = $ym.'-01';
			$oDate = new DateTime($begin);
			$end = $oDate->format("Y-m-t");
			$this->download_send_headers("SPK_ADMIN_" . $begin ."_".$end. ".xls");
			$this->array2xls($this->arr_data_spk_admin($begin,$end));
			die();
		}else{
			redirect('backend/report/export_report_csv');
		}
		
	}

	function get_data_spk_packing()
	{
		$ym = $this->input->post('spk_packing_date');

		if($ym){
			ini_set('max_execution_time', '150'); //300 seconds = 5 minutes
			$begin = $ym.'-01';
			$oDate = new DateTime($begin);
			$end = $oDate->format("Y-m-t");
			$this->download_send_headers("SPK_PACKING_" . $begin ."_".$end. ".xls");
			$this->array2xls($this->arr_data_spk_packing($begin,$end));
			die();
		}else{
			redirect('backend/report/export_report_csv');
		}
		
	}


	///
	function get_data_spk_layout_bydate()
	{
		$date = $this->input->post('spk_layout_date_bydate');

		if($date){
			ini_set('max_execution_time', '150'); //300 seconds = 5 minutes
			$begin 	= $date.' 00:00:00';
			$end 	= $date.' 23:59:59';
			$this->download_send_headers("SPK_LAYOUT_" . $date .".xls");
			$this->array2xls($this->arr_data_spk_layout($begin,$end));
			die();
		}else{
			redirect('backend/report/export_report_csv');
		}
		
	}

	function get_data_spk_admin_bydate()
	{
		$date = $this->input->post('spk_admin_date_bydate');

		if($date){
			ini_set('max_execution_time', '150'); //300 seconds = 5 minutes
			$begin 	= $date.' 00:00:00';
			$end 	= $date.' 23:59:59';
			$this->download_send_headers("SPK_ADMIN_" . $date .".xls");
			$this->array2xls($this->arr_data_spk_admin($begin,$end));
			die();
		}else{
			redirect('backend/report/export_report_csv');
		}
		
	}

	function get_data_spk_packing_bydate()
	{
		$date = $this->input->post('spk_packing_date_bydate');

		if($date){
			ini_set('max_execution_time', '150'); //300 seconds = 5 minutes
			$begin 	= $date.' 00:00:00';
			$end 	= $date.' 23:59:59';
			$this->download_send_headers("SPK_PACKING_" . $date .".xls");
			$this->array2xls($this->arr_data_spk_packing($begin,$end));
			die();
		}else{
			redirect('backend/report/export_report_csv');
		}
		
	}


	function arr_data_spk_admin($begin,$end)
	{
		$t_begin  	= $begin.' 00:00:00';
		$t_end 		= $end.' 23:59:59';
		$arr_csv = array();
		$arr_data = $this->db->query("SELECT * 
								FROM 
								tb_spk sp
								JOIN tb_user u ON sp.spk_user = u.user_id
								WHERE sp.spk_datetime_in BETWEEN '$t_begin' AND '$t_end' ORDER BY sp.spk_datetime_in ASC;
						")->result_array();

		$arr_csv[] = array("NO_SPK",
							"NO_INVOICE",
							"SUMBER",
							"NAMA_PRODUK",
							"JML_JADI",
							"BAHAN",
							"JML_BAHAN",
							"LAMINASI",
							"CUTTING",
							"FINISH",
							"NAMA_STORE",
							"ADMIN_NAME",
							"TGL_INPUT",
			);


		foreach ($arr_data as $row){
		
			$arr_csv[] = array(
				$row['spk_no'],
				$row['spk_inv_mp'],
				$row['spk_source'],
				$row['spk_prod_name'],
				trim($row['spk_qty_finish']),
				$row['spk_material_name'],
				trim($row['spk_qty_material']),
				$row['spk_lamination'],
				$row['spk_cutting'],
				trim(preg_replace('/\s+/', ' ', $row['spk_instruction'])),
				$row['spk_store_name'],
				$row['user_name'],
				$row['spk_datetime_in']

			);
		}
		return $arr_csv;
	}


	function arr_data_spk_packing($begin,$end)
	{
		$t_begin  	= $begin.' 00:00:00';
		$t_end 		= $end.' 23:59:59';
		$arr_csv = array();
		$arr_data = $this->db->query("SELECT * 
								FROM 
								tb_packing_detail pd
								JOIN tb_packing p ON p.pack_id = pd.pack_det_pack_id
								JOIN tb_user u ON u.user_id = p.pack_user_id
								WHERE pd.pack_det_created_date BETWEEN '$t_begin' AND '$t_end' ORDER BY pd.pack_det_created_date ASC;
						")->result_array();

		$arr_csv[] = array("NO_INVOICE",
							"KURIR",
							"TGL_SCAN",
							"TGL_BUAT",
							"NAMA_PACKER"
			);


		foreach ($arr_data as $row){
		
			$arr_csv[] = array(
				$row['pack_det_inv_mp'],
				$row['pack_kurir_name'],
				$row['pack_det_created_date'],
				$row['pack_date_created'],
				$row['user_name']
			);
		}
		return $arr_csv;
	}


	function arr_data_spk_layout($begin,$end)
	{
		$t_begin  	= $begin.' 00:00:00';
		$t_end 		= $end.' 23:59:59';
		
		$arr_csv = array();
		$arr_data = $this->db->query("SELECT * 
								FROM 
								tb_batch_spk_detail bsd
								JOIN tb_batch_spk bs ON bs.batch_spk_id = bsd.batch_spk_det_spk_id 
								JOIN tb_user u ON bs.batch_spk_user_id = u.user_id
								WHERE bsd.batch_spk_det_date_created BETWEEN '$t_begin' AND '$t_end' ORDER BY bsd.batch_spk_det_date_created ASC;
						")->result_array();

		$arr_csv[] = array("NO_SPK",
							"NO_INVOICE",
							"SUMBER",
							"NAMA_PRODUK",
							"JML_JADI",
							"BAHAN",
							"JML_BAHAN",
							"LAMINASI",
							"CUTTING",
							"FINISH",
							"NAMA_STORE",
							"CGO_NAME",
							"TGL_SCAN",
							"TGL_BATCH_PROCESS"
			);


		foreach ($arr_data as $row){
			$spk_no = $row['batch_spk_det_spk_no'];
			$row_spk = $this->db->query("SELECT s.spk_id AS SPK_ID,
					s.spk_no AS NO_SPK,
					s.spk_inv_mp AS NO_INV,
					s.spk_source AS SUMBER,
					s.spk_prod_name AS NAMA_PRODUK,
					s.spk_qty_finish AS JML_JADI,
					m.material_name AS BAHAN,
					s.spk_qty_material AS JML_BAHAN,
					s.spk_lamination AS LAMINASI,
					s.spk_cutting AS CUTTING,
					s.spk_instruction FINISH,
					s.spk_proof AS PROFF,
					s.spk_store_name AS NAMA_STORE,
					s.spk_datetime_in AS TGL_BUAT,
					s.spk_user AS USER_ID,
					u.user_name AS NAMA_CGO,
					s.spk_time_delivered AS TANGGAL_KIRIM
					FROM 
					tb_spk s
					JOIN tb_user u ON u.user_id = s.spk_user
					JOIN tb_material m ON m.material_name = s.spk_material_name
					WHERE s.spk_no = '$spk_no';
					")->row();
			
			
			$arr_csv[] = array(
				$row['batch_spk_det_spk_no'],
				$row_spk->NO_INV,
				$row_spk->SUMBER,
				$row_spk->NAMA_PRODUK,
				trim($row_spk->JML_JADI),
				$row_spk->BAHAN,
				trim($row_spk->JML_BAHAN),
				$row_spk->LAMINASI,
				trim(preg_replace('/\s+/', ' ', $row_spk->FINISH)),
				$row_spk->CUTTING,
				$row_spk->NAMA_STORE,
				$row['user_name'],
				$row['batch_spk_det_date_created'],
				$row['batch_spk_date_process'],

			);
		}
		return $arr_csv;
	}






	function array2xls($array)
	{
		if (count($array) == 0) {
			return null;
		}

		$flag = false;

		//echo '<pre>';
		//print_r($array);
		foreach( $array as $row ) {
			echo implode( "\t", array_values( $row ) ) . "\r\n";
		}
		
	}

	function download_send_headers($filename) {
		// disable caching
		$now = gmdate("D, d M Y H:i:s");
		header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
		header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
		header("Last-Modified: {$now} GMT");
	
		// force download  
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
	
		// disposition / encoding on response body
		header("Content-Disposition: attachment;filename={$filename}");
		header("Content-Transfer-Encoding: binary");
	}
}



?>