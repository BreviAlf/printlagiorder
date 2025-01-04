<?php
class Broadcast_model extends CI_Model
{
	public function __construct() {
        parent::__construct();
	}
	// Category section
	function GetBroadcastBatch($query=FALSE,$id=FALSE,$limit=FALSE,$offset=FALSE)
	{
		if (!$query):
			$this->db->where('bc_batch_id',$id);
			return $this->db->get('tb_bc_batch')->row();
		elseif($query=='all'):
			$qr_bc = $this->db->query("
				SELECT
					tb_cust_batch.cust_batch_name,
					tb_cust_batch.cust_batch_id,
					tb_landing.landing_id,
					tb_landing.landing_name,
					tb_bc_batch.*
				FROM
				tb_cust_batch
				INNER JOIN tb_bc_batch ON tb_bc_batch.bc_batch_cust_batch_id = tb_cust_batch.cust_batch_id
				INNER JOIN tb_landing ON tb_landing.landing_id = tb_bc_batch.bc_batch_landing_id");
			//$qr_bc = $this->db->limit($limit,$offset);
			//$qr_bc = $this->db->order_by('bc_batch_id','desc');
			return $qr_bc->result_array();
		endif;
	}

	function CreateBroadcastBatch($data)
	{
		$this->db->insert('tb_bc_batch',$data);
	}

	function UpdateBroadcastBatch($id,$data)
	{
		$this->db->where('bc_batch_id',$id);
		$this->db->update('tb_bc_batch',$data);
	}

	function DeleteBroadcastBatch($id)
	{
		$this->db->where('bc_batch_id',$id);
		$this->db->delete('tb_bc_batch');

		// delete tb_broadcast by bc_batch_id
		//$this->db->where('media_id',$id);
		//$this->db->delete('tb_media');
	}
	// end of category section

}

