<?php
class Landing extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->library('session');
	}

	function index()
	{

		$landing_id = 1; // DEFAULT
		$this->db->where('landing_id',$landing_id);
		$row_landing = $this->db->get('tb_landing')->row();

		if(!$row_landing){
			redirect('landing');
		}

		$data['arr_prod_list'] = array();
		$data['page'] = 'home';
		$data['row_landing'] = $row_landing;

		$data['landing_id'] = (isset($qr_landing) ? $qr_landing->landing_id : 0);
		$data['niche_id'] = (isset($qr_landing) ? $qr_landing->niche_id : 0);
		$data['cat_id'] = (isset($qr_landing) ? $qr_landing->cat_id : 0);

		$query_landing = $this->db->query("
				SELECT 
				tb_landing.landing_id,
				tb_product.prod_name,
				tb_product.prod_id,
				tb_product.prod_name,
				tb_product.prod_img_mockup_url,
				tb_product.prod_img_banner_url,
				tb_product.prod_img_design_url,
				tb_niche.niche_name,
				tb_category.cat_name
				FROM tb_landing
				JOIN tb_prod_list on tb_prod_list.prod_list_landing_id = tb_landing.landing_id
				JOIN tb_product on tb_product.prod_id = tb_prod_list.prod_list_prod_id
				JOIN tb_category on tb_category.cat_id = tb_product.prod_cat_id
				JOIN tb_niche on tb_niche.niche_id = tb_product.prod_niche_id
				WHERE tb_prod_list.prod_list_poup_stat = 'Y'
				GROUP BY tb_landing.landing_id;"
				);

		$data['arr_landing_list'] = $query_landing->result_array();
	

		$data['uid'] = GetUid();
		$data['title'] = 'Isamu Home Page';
		$data['body'] = 'body_home';
		$this->load->view('index',$data);
	}


	function id()
	{

		//Get data landing
		$landing_id = $this->uri->segment(3);

		$this->db->where('landing_id',$landing_id);
		$row_landing = $this->db->get('tb_landing')->row();

		if(!$row_landing){
			redirect('landing');
		}

		$data['page'] = 'landing';

		// get data pop up
		$qr_landing = $this->db->query("
		SELECT
				tb_landing.landing_id,
				tb_product.prod_name,
				tb_prod_list.prod_list_landing_id,
				tb_prod_list.prod_list_id,
				tb_prod_list.prod_list_prod_id,
				tb_prod_list.prod_list_poup_stat,
				tb_category.cat_name,
				tb_category.cat_id,
				tb_niche.niche_name,
				tb_niche.niche_id

		FROM
				tb_prod_list
				INNER JOIN tb_landing ON tb_landing.landing_id = tb_prod_list.prod_list_landing_id
				INNER JOIN tb_product ON tb_product.prod_id = tb_prod_list.prod_list_prod_id
				INNER JOIN tb_category ON tb_category.cat_id = tb_product.prod_cat_id
				INNER JOIN tb_niche ON tb_niche.niche_id = tb_product.prod_niche_id
				WHERE tb_prod_list.prod_list_landing_id = $landing_id")->row();



		//get data product
		$qr_prod_list = $this->db->query("
		SELECT
				tb_landing.landing_name,
				tb_product.prod_name,
				tb_prod_list.prod_list_landing_id,
				tb_prod_list.prod_list_id,
				tb_prod_list.prod_list_prod_id,
				tb_prod_list.prod_list_poup_stat,
				tb_category.cat_name,
				tb_niche.niche_name,
				tb_product.prod_id,
				tb_product.prod_name,
				tb_product.prod_code,
				tb_product.prod_sku,
				tb_product.prod_price,
				tb_product.prod_price_disc,
				tb_product.prod_desc,
				tb_product.prod_img_id,
				tb_product.prod_img_mockup_url,
				tb_product.prod_img_banner_url,
				tb_product.prod_img_design_url,
				tb_product.prod_status,
				tb_product.prod_date_created,
				tb_product.prod_cat_id,
				tb_product.prod_niche_id,
				tb_product.prod_mp_link_1,
				tb_product.prod_mp_link_2,
				tb_product.prod_dummy_sold

		FROM
				tb_prod_list
				INNER JOIN tb_landing ON tb_landing.landing_id = tb_prod_list.prod_list_landing_id
				INNER JOIN tb_product ON tb_product.prod_id = tb_prod_list.prod_list_prod_id
				INNER JOIN tb_category ON tb_category.cat_id = tb_product.prod_cat_id
				INNER JOIN tb_niche ON tb_niche.niche_id = tb_product.prod_niche_id
				WHERE tb_prod_list.prod_list_landing_id = $landing_id");
		$data['arr_prod_list'] = $qr_prod_list->result_array();

		// get data pop up
		$qr_pop_up = $this->db->query("
		SELECT
				tb_landing.landing_name,
				tb_landing.landing_id,
				tb_product.prod_name,
				tb_prod_list.prod_list_landing_id,
				tb_prod_list.prod_list_id,
				tb_prod_list.prod_list_prod_id,
				tb_prod_list.prod_list_poup_stat,
				tb_category.cat_name,
				tb_category.cat_id,
				tb_niche.niche_name,
				tb_niche.niche_id,
				tb_product.prod_id,
				tb_product.prod_name,
				tb_product.prod_code,
				tb_product.prod_sku,
				tb_product.prod_price,
				tb_product.prod_price_disc,
				tb_product.prod_desc,
				tb_product.prod_img_id,
				tb_product.prod_img_mockup_url,
				tb_product.prod_img_banner_url,
				tb_product.prod_img_design_url,
				tb_product.prod_status,
				tb_product.prod_date_created,
				tb_product.prod_cat_id,
				tb_product.prod_niche_id,
				tb_product.prod_mp_link_1,
				tb_product.prod_mp_link_2,
				tb_product.prod_dummy_sold

		FROM
				tb_prod_list
				INNER JOIN tb_landing ON tb_landing.landing_id = tb_prod_list.prod_list_landing_id
				INNER JOIN tb_product ON tb_product.prod_id = tb_prod_list.prod_list_prod_id
				INNER JOIN tb_category ON tb_category.cat_id = tb_product.prod_cat_id
				INNER JOIN tb_niche ON tb_niche.niche_id = tb_product.prod_niche_id
				WHERE tb_prod_list.prod_list_landing_id = $landing_id AND tb_prod_list.prod_list_poup_stat = 'Y'");


		$data['row_popup'] = $qr_pop_up->row();



		$data['row_landing'] = $row_landing;

		$data['landing_id'] = (isset($qr_landing) ? $qr_landing->landing_id : '');
		$data['niche_id'] = (isset($qr_landing) ? $qr_landing->niche_id : '');
		$data['cat_id'] = (isset($qr_landing) ? $qr_landing->cat_id : '');
	

		$data['uid'] = GetUid();


		$data['title'] = 'Isamu Home Page';
		$data['body'] = 'landing/body_landing';
		$this->load->view('index',$data);
	}


	public function AddResponseEvent()
	{

		if($this->input->post('resp_type')=='btn'){
			$resp_type = 'cta_btn';
		}
		else if($this->input->post('resp_type')=='load'){
			$resp_type = 'load_page';
		}
		else if($this->input->post('resp_type')=='buy'){
			$resp_type = 'cta_buy';
		}

		$resp_type			= $resp_type;
		$resp_type_trigger	= $this->input->post('resp_type_trigger'); 
		$resp_cust_id		= GetCustByUid($this->input->post('uid'));
		$resp_cust_uid		= $this->input->post('uid');
		$resp_landing_id	= $this->input->post('landing_id'); 
		$resp_bc_id			= getDataTableById('tb_bc_batch','bc_batch_id','bc_batch_landing_id',$this->input->post('landing_id'));
		$resp_niche_id		= $this->input->post('niche_id');
		$resp_cat_id		= $this->input->post('cat_id');
		$resp_prod_id		= 0;
		$resp_country		= GetLocation('country');
		$resp_region		= GetLocation('region');
		$resp_city			= GetLocation('city');
		$resp_ip_address	= GetClientIp();
		
		$resp_date_created  = date("Y-m-d H:i:s");
		$resp_count			= 1;

		$data = array
		(
			'resp_type'	=> $resp_type,
			'resp_type_trigger'	=> $resp_type_trigger,
			'resp_cust_id'	=> $resp_cust_id,
			'resp_cust_uid'	=> $resp_cust_uid,
			'resp_landing_id'	=> $resp_landing_id,
			'resp_bc_id'	=> $resp_bc_id,
			'resp_niche_id'	=> $resp_niche_id,
			'resp_cat_id'	=> $resp_cat_id,
			'resp_prod_id'	=> $resp_prod_id,
			'resp_country'	=> $resp_country,
			'resp_region'	=> $resp_region,
			'resp_city'	=> $resp_city,
			'resp_ip_address'	=> $resp_ip_address,
			'resp_date_created'	=> $resp_date_created,
			'resp_count'	=> $resp_count,

		);
		
		if(GetIpBlocked($resp_ip_address))
		{
			$arr_resp= array('ip'=>$resp_ip_address,'status'=>'accepted');
			echo json_encode($arr_resp);
			$this->db->insert('tb_response',$data);
		}else
		{
			$arr_resp= array('ip'=>$resp_ip_address,'status'=>'blocked');
			echo json_encode($arr_resp);
		}
		
		
	}

	public function AddResponseProduct()
	{
		$resp_type_trigger	= $this->input->post('resp_type_trigger'); 
		
		if($resp_type_trigger == 'view_prod'){
			$resp_type	= 'cta_btn';
		}else{
			$resp_type	= 'cta_buy';
		}
		
		
		$resp_cust_id		= GetCustByUid($this->input->post('uid'));
		$resp_cust_uid		= $this->input->post('uid');
		$resp_landing_id	= $this->input->post('landing_id'); 
		$resp_bc_id			= getDataTableById('tb_bc_batch','bc_batch_id','bc_batch_landing_id',$this->input->post('landing_id'));
		$resp_niche_id		= $this->input->post('niche_id');
		$resp_cat_id		= $this->input->post('cat_id');
		$resp_prod_id		= $this->input->post('prod_id');
		$resp_country		= GetLocation('country');
		$resp_region		= GetLocation('region');
		$resp_city			= GetLocation('city');
		$resp_ip_address	= GetClientIp();
		
		$resp_date_created  = date("Y-m-d H:i:s");
		$resp_count			= 1;

		$data = array
		(
			'resp_type'	=> $resp_type,
			'resp_type_trigger'	=> $resp_type_trigger,
			'resp_cust_id'	=> $resp_cust_id,
			'resp_cust_uid'	=> $resp_cust_uid,
			'resp_landing_id'	=> $resp_landing_id,
			'resp_bc_id'	=> $resp_bc_id,
			'resp_niche_id'	=> $resp_niche_id,
			'resp_cat_id'	=> $resp_cat_id,
			'resp_prod_id'	=> $resp_prod_id,
			'resp_country'	=> $resp_country,
			'resp_region'	=> $resp_region,
			'resp_city'	=> $resp_city,
			'resp_ip_address'	=> $resp_ip_address,
			'resp_date_created'	=> $resp_date_created,
			'resp_count'	=> $resp_count,

		);
		if(GetIpBlocked($resp_ip_address))
		{
			$arr_resp= array('ip'=>$resp_ip_address,'status'=>'accepted');
			echo json_encode($arr_resp);
			$this->db->insert('tb_response',$data);
		}else
		{
			$arr_resp= array('ip'=>$resp_ip_address,'status'=>'blocked');
			echo json_encode($arr_resp);
		}
		
	}



	
}
?>