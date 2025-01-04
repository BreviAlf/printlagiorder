<?php
class Dashboard extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->library('session');
		if(!$this->session->userdata('user_id') && !$this->session->userdata('user_display_name') ):
			redirect('login');
		elseif($this->session->userdata('user_rule')=='Frontend'):
			redirect('no_access');
		endif;
	}

	function index()
	{
		$filter_date = $this->input->post("filter_date");

		if($filter_date){
			//echo $filter_date;
			//date_default_timezone_set('Asia/Jakarta');
			$data['filter_date'] = $filter_date;
			//$time_now 	  = date('Y-m-d H:i:s');
			$time_start	  = $filter_date.' 00:00:00';
			$time_end	  = $filter_date.' 23:59:59';
		}else{
			date_default_timezone_set('Asia/Jakarta');
			$data['filter_date'] = date('Y-m-d');
			$time_now 	  = date('Y-m-d H:i:s');
			$time_start	  = date('Y-m-d 00:00:00');
			$time_end	  = date('Y-m-d 23:59:59');
		}
		

		//count new created
		$qr_new = $this->db->query("SELECT COUNT(tb_spk.spk_id) as count_new 
		FROM tb_spk WHERE tb_spk.spk_datetime_in BETWEEN '$time_start' AND '$time_end'")->row();
		$data['new'] = $qr_new->count_new;

		//count layout
		$qr_layout = $this->db->query("SELECT COUNT(tb_spk.spk_id) as layout 
		FROM tb_spk WHERE tb_spk.spk_time_layout BETWEEN '$time_start' AND '$time_end'")->row();
		$data['layout'] = $qr_layout->layout;

		//count process
		$qr_process = $this->db->query("SELECT COUNT(tb_spk.spk_id) as process 
		FROM tb_spk WHERE tb_spk.spk_time_process BETWEEN '$time_start' AND '$time_end'")->row();
		$data['process'] = $qr_process->process;

		//count done
		$qr_done = $this->db->query("SELECT COUNT(tb_spk.spk_id) as done 
		FROM tb_spk WHERE tb_spk.spk_time_done BETWEEN '$time_start' AND '$time_end'")->row();
		$data['done'] = $qr_done->done;

		//count packing
		$qr_packing = $this->db->query("SELECT COUNT(tb_spk.spk_id) as packing 
		FROM tb_spk WHERE tb_spk.spk_time_packing BETWEEN '$time_start' AND '$time_end'")->row();
		$data['packing'] = $qr_packing->packing;

		//count packing by order
		$qr_pack_order = $this->db->query("SELECT COUNT(tb_packing_detail.pack_det_inv_mp) as pack_order 
		FROM tb_packing_detail WHERE tb_packing_detail.pack_det_created_date BETWEEN '$time_start' AND '$time_end'")->row();
		$data['pack_order'] = $qr_pack_order->pack_order;

		//count deliverd
		$qr_delivered = $this->db->query("SELECT COUNT(tb_spk.spk_inv_mp) as delivered 
		FROM tb_spk WHERE tb_spk.spk_time_delivered BETWEEN '$time_start' AND '$time_end'")->row();
		$data['delivered'] = $qr_delivered->delivered;

		//count deliverd
		$qr_delivered_order = $this->db->query("SELECT COUNT(DISTINCT tb_spk.spk_inv_mp) as delivered_order 
		FROM tb_spk WHERE tb_spk.spk_time_delivered BETWEEN '$time_start' AND '$time_end'")->row();
		$data['delivered_order'] = $qr_delivered_order->delivered_order;

		//count material based

		//count by user
		$qr_spk_user = $this->db->query("SELECT
				tb_user.user_name,COUNT(tb_spk.spk_id) AS count_spk
			FROM
				tb_spk
				JOIN
				tb_user
				ON 
					tb_spk.spk_user = tb_user.user_id
					WHERE tb_spk.spk_datetime_in BETWEEN '$time_start' AND '$time_end'
			GROUP BY
				tb_spk.spk_user")->result_array();
		$data['arr_create'] = $qr_spk_user;

		//print_r($data['arr_create']);


		//sum material
		$qr_material = $this->db->query("SELECT spk_material_name, SUM(tb_spk.spk_qty_material) as qty 
		FROM tb_spk WHERE tb_spk.spk_datetime_in BETWEEN '$time_start' AND '$time_end'
		GROUP BY spk_material_name")->result_array();

		$arr_mat_name = array();
		$arr_mat_qty = array();

		foreach($qr_material as $row)
		{
			$arr_mat_name[] = $row['spk_material_name'];
			$arr_mat_qty[] = $row['qty'];
		}

		$data['json_mat_name'] 	= json_encode($arr_mat_name);
		$data['json_mat_qty'] 	= json_encode($arr_mat_qty);

		// count spk_type
		$arr_type = array();
		$qr_spk_type = $this->db->query("SELECT spk_type, COUNT(tb_spk.spk_id) as count 
		FROM tb_spk WHERE tb_spk.spk_datetime_in BETWEEN '$time_start' AND '$time_end'
		GROUP BY spk_type")->result_array();

		foreach($qr_spk_type as $row)
		{
			if($row['spk_type'] === NULL ){
				$type = 'Unidentified ';
			}else{
				$type = $row['spk_type'];
			}
			$arr_type[] = array(
				'value'=>$row['count'],
				'name' =>$type);
		}

		$data['json_type'] 	= json_encode($arr_type);
		
		// group by cuttting
		$qr_cutting = $this->db->query("SELECT
		tb_spk.spk_cutting,SUM(tb_spk.spk_qty_material) as total
		FROM
		tb_spk
		WHERE tb_spk.spk_datetime_in BETWEEN '$time_start' AND '$time_end'
		GROUP BY
		tb_spk.spk_cutting");

		$data['arr_cutting'] = $qr_cutting->result_array();


		// group by lamination
		$qr_lam = $this->db->query("SELECT tb_spk.spk_lamination,SUM(tb_spk.spk_qty_material) as total
		FROM
		tb_spk
		WHERE tb_spk.spk_datetime_in BETWEEN '$time_start' AND '$time_end'
		GROUP BY
		tb_spk.spk_lamination");

		$data['arr_lam'] = $qr_lam->result_array();


		//sum material
		$arr_spk = $this->db->query("SELECT *
		FROM tb_spk WHERE tb_spk.spk_datetime_in BETWEEN '$time_start' AND '$time_end'" )->result_array();
		/// DATA FINISHING
		$arr_finish = array();
		$arr_f = array();
		foreach ($arr_spk as $row_spk_finish)
		{	
			// explode
			$ex_finish = explode(' | ',$row_spk_finish['spk_instruction']);	

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
					$arr_f[] = $row_spk_finish['spk_instruction'];
				}

			}	
		}

		
		$arr_finish = array_count_values($arr_f);
		$data['arr_finish'] = $arr_finish;

		//top material
		$arr_top = $this->db->query("SELECT *
		FROM tb_spk WHERE tb_spk.spk_datetime_in BETWEEN '$time_start' AND '$time_end'
		ORDER BY spk_qty_material DESC LIMIT 10")->result_array();

		$data['arr_top'] = $arr_top;

		//groupby product name
		$arr_group_spk = $this->db->query("SELECT 
		spk_prod_name,
		COUNT(spk_id) as count,
		SUM(spk_qty_material) as sum_mat,
		SUM(spk_qty_finish) as sum_pcs
		FROM tb_spk WHERE tb_spk.spk_datetime_in BETWEEN '$time_start' AND '$time_end'
		GROUP BY spk_prod_name
		ORDER BY spk_qty_material DESC")->result_array();

		$data['arr_group_spk'] = $arr_group_spk;


		$data['title'] = 'Dashboard';
		$data['template'] = 'dashboard';
		$this->load->view('backend/index',$data);
	}

	public function cekpdf()
	{
		

	}


}
?>