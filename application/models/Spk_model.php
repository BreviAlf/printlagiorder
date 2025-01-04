<?php
class Spk_model extends CI_Model
{
	public function __construct() {
        parent::__construct();
	}
	
	// Product section
	function GetSpk($query=FALSE,$id=FALSE,$limit=FALSE,$offset=FALSE)
	{
		if (!$query):
			$this->db->where('spk_id',$id);
			$this->db->where_not_in('spk_parent_flag',2);
			return $this->db->get('tb_spk')->row();
		elseif($query=='all'):
			$qr = $this->db->select('*');
			$qr = $this->db->from('tb_spk');
			$qr = $this->db->join('tb_product', 'tb_spk.spk_prod_id = tb_product.prod_id', 'left');
			$qr = $this->db->where('(spk_parent_flag = 1 OR spk_parent_flag IS NULL)',  NULL, FALSE);

			//$qr = $this->db->limit($limit,$offset);
			$qr = $this->db->order_by('spk_id','desc');
			$qr = $this->db->get();
			return $qr->result_array();
		elseif($query=='new'):
			$qr = $this->db->select('*');
			$qr = $this->db->from('tb_spk');
			$qr = $this->db->join('tb_product', 'tb_spk.spk_prod_id = tb_product.prod_id', 'left');
			$qr = $this->db->where('spk_status','New');
			$qr = $this->db->where('(spk_parent_flag = 1 OR spk_parent_flag IS NULL)',  NULL, FALSE);
		
			$qr = $this->db->limit($limit,$offset);
			$qr = $this->db->order_by('spk_id','desc');
			$qr = $this->db->get();
			return $qr->result_array();
		elseif($query=='layout'):
			$qr = $this->db->select('*');
			$qr = $this->db->from('tb_spk');
			$qr = $this->db->join('tb_product', 'tb_spk.spk_prod_id = tb_product.prod_id', 'left');
			$qr = $this->db->where('spk_status','Layout');
			$qr = $this->db->where('(spk_parent_flag = 1 OR spk_parent_flag IS NULL)',  NULL, FALSE);
			//$qr = $this->db->limit($limit,$offset);
			$qr = $this->db->order_by('spk_id','desc');
			$qr = $this->db->get();
			return $qr->result_array();
		elseif($query=='process'):
			$qr = $this->db->select('*');
			$qr = $this->db->from('tb_spk');
			$qr = $this->db->join('tb_product', 'tb_spk.spk_prod_id = tb_product.prod_id', 'left');
			$qr = $this->db->where('spk_status','Process');
			$qr = $this->db->where('(spk_parent_flag = 1 OR spk_parent_flag IS NULL)',  NULL, FALSE);
			//$qr = $this->db->limit($limit,$offset);
			$qr = $this->db->order_by('spk_id','desc');
			$qr = $this->db->get();
			return $qr->result_array();
		elseif($query=='done'):
			$qr = $this->db->select('*');
			$qr = $this->db->from('tb_spk');
			$qr = $this->db->join('tb_product', 'tb_spk.spk_prod_id = tb_product.prod_id', 'left');
			$qr = $this->db->where('spk_status','Done');
			$qr = $this->db->where('(spk_parent_flag = 1 OR spk_parent_flag IS NULL)',  NULL, FALSE);
			$qr = $this->db->or_where('spk_status', 'Delivered'); 
			//$qr = $this->db->limit($limit,$offset);
			$qr = $this->db->order_by('spk_id','desc');
			$qr = $this->db->get();
			return $qr->result_array();
		endif;
	}

	function GetSpk_done($limit=FALSE,$offset)
	{
			
			$qr = $this->db->select('*');
			$qr = $this->db->from('tb_spk');
			$qr = $this->db->join('tb_product', 'tb_spk.spk_prod_id = tb_product.prod_id', 'left');
			$qr = $this->db->where('spk_status','Done');
			$qr = $this->db->or_where('spk_status', 'Delivered'); 
			$qr = $this->db->limit($limit,$offset);
			$qr = $this->db->order_by('spk_id','desc');
			$qr = $this->db->get();
			return $qr->result_array();

	}

	function CreateSpk($data)
	{
		$this->db->insert('tb_spk',$data);
	}

	function UpdateSpk($id,$data)
	{
		$this->db->where('spk_id',$id);
		$this->db->update('tb_spk',$data);
	}

	function DeleteSpk($id){
		$this->db->where('spk_id',$id);
		$this->db->delete('tb_spk');
	}
	// end of product section

	// Category section
	function GetCategory($query=FALSE,$id=FALSE,$limit=FALSE,$offset=FALSE)
	{
		if (!$query):
			$this->db->where('cat_id',$id);
			return $this->db->get('tb_category')->row();
		elseif($query=='all'):
			$this->db->limit($limit,$offset);
			$this->db->order_by('cat_id','desc');
			return $this->db->get('tb_category')->result_array();
		endif;
	}

	function CreateCategory($data)
	{
		$this->db->insert('tb_category',$data);
	}

	function UpdateCategory($id,$data)
	{
		$this->db->where('cat_id',$id);
		$this->db->update('tb_category',$data);
	}

	function DeleteCategory($id){
		$this->db->where('cat_id',$id);
		$this->db->delete('tb_category');
	}
	// end of category section


	// Niche Section
	function GetNiche($query=FALSE,$id=FALSE,$limit=FALSE,$offset=FALSE)
	{
		if (!$query):
			$this->db->where('niche_id',$id);
			return $this->db->get('tb_niche')->row();
		elseif($query=='all'):
			$this->db->limit($limit,$offset);
			$this->db->order_by('niche_id','desc');
			return $this->db->get('tb_niche')->result_array();
		endif;
	}

	function CreateNiche($data)
	{
		$this->db->insert('tb_niche',$data);
	}

	function UpdateNiche($id,$data)
	{
		$this->db->where('niche_id',$id);
		$this->db->update('tb_niche',$data);
	}

	function DeleteNiche($id){
		$this->db->where('niche_id',$id);
		$this->db->delete('tb_niche');
	}
	// end of niche section

}

