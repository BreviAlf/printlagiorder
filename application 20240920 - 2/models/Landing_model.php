<?php
class Landing_model extends CI_Model
{
	public function __construct() {
        parent::__construct();
	}
	
	function GetLanding($query=FALSE,$id=FALSE,$limit=FALSE,$offset=FALSE)
	{
		if (!$query):
			$this->db->where('landing_id',$id);
			return $this->db->get('tb_landing')->row();
		elseif($query=='all'):
			$this->db->limit($limit,$offset);
			$this->db->order_by('landing_id','desc');
			return $this->db->get('tb_landing')->result_array();
		endif;
	}


	function AddLanding($data)
	{
		$this->db->insert('tb_landing',$data);
	}

	function UpdateLanding($id,$data)
	{
		$this->db->where('landing_id',$id);
		$this->db->update('tb_landing',$data);
	}

	function DeleteLanding($id){
		// delete tb_landing
		$this->db->where('landing_id',$id);
		$this->db->delete('tb_landing');

		// delete product inside tb_landing
		$this->db->where('prod_list_landing_id',$id);
		$this->db->delete('tb_prod_list');

	}
}

