<?php
class Customer_model extends CI_Model
{
	public function __construct() {
        parent::__construct();
	}
	// Customer section
	function GetCustomer($query=FALSE,$id=FALSE,$limit=FALSE,$offset=FALSE)
	{
		if (!$query):
			$this->db->where('cust_id',$id);
			return $this->db->get('tb_customer')->row();
		elseif($query=='all'):
			$qr = $this->db->select('*');
			$qr = $this->db->from('tb_customer');
			$qr = $this->db->join('tb_cust_batch', 'tb_customer.cust_cust_batch_id = tb_cust_batch.cust_batch_id', 'left');
			//$qr = $this->db->limit($limit,$offset);
			$qr = $this->db->order_by('cust_id','desc');
			$qr = $this->db->get();
			return $qr->result_array();
		endif;
	}

	function CreateCustomer($data)
	{
		$this->db->insert('tb_customer',$data);
	}

	function UpdateCustomer($id,$data)
	{
		$this->db->where('cust_id',$id);
		$this->db->update('tb_customer',$data);
	}

	function DeleteCustomer($id)
	{
		$this->db->where('cust_id',$id);
		$this->db->delete('tb_customer');
	}
	// end of category section

	// Customer Batch section
	function GetCustBatch($query=FALSE,$id=FALSE,$limit=FALSE,$offset=FALSE)
	{
		if (!$query):
			$this->db->where('cust_batch_id',$id);
			return $this->db->get('tb_cust_batch')->row();
		elseif($query=='all'):
			$this->db->limit($limit,$offset);
			$this->db->order_by('cust_batch_id','desc');
			return $this->db->get('tb_cust_batch')->result_array();
		endif;
	}

	function CreateCustBatch($data)
	{
		$this->db->insert('tb_cust_batch',$data);
	}

	function UpdateCustBatch($id,$data)
	{
		$this->db->where('cust_batch_id',$id);
		$this->db->update('tb_cust_batch',$data);
	}

	function DeleteCustBatch($id)
	{
		$this->db->where('cust_batch_id',$id);
		$this->db->delete('tb_cust_batch');
	}
	// end of category section

}

