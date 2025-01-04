<?php
class Product_model extends CI_Model
{
	public function __construct() {
        parent::__construct();
	}
	
	// Product section
	function GetProduct($query=FALSE,$id=FALSE,$limit=FALSE,$offset=FALSE)
	{
		if (!$query):
			$this->db->where('prod_id',$id);
			return $this->db->get('tb_product')->row();
		elseif($query=='all'):
			$qr = $this->db->select('*');
			$qr = $this->db->from('tb_product');
			$qr = $this->db->join('tb_category', 'tb_product.prod_cat_id = tb_category.cat_id', 'left');
			//$qr = $this->db->limit($limit,$offset);
			$qr = $this->db->order_by('prod_id','desc');
			$qr = $this->db->get();
			return $qr->result_array();
		endif;
	}

	function CreateProduct($data)
	{
		$this->db->insert('tb_product',$data);
	}

	function UpdateProduct($id,$data)
	{
		$this->db->where('prod_id',$id);
		$this->db->update('tb_product',$data);
	}

	function DeleteProduct($id){
		$this->db->where('prod_id',$id);
		$this->db->delete('tb_product');
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

	//Material section
	function GetMaterial($query=FALSE,$id=FALSE,$limit=FALSE,$offset=FALSE)
	{
		if (!$query):
			$this->db->where('material_id',$id);
			return $this->db->get('tb_material')->row();
		elseif($query=='all'):
			$this->db->limit($limit,$offset);
			$this->db->order_by('material_id','desc');
			return $this->db->get('tb_material')->result_array();
		endif;
	}

	function CreateMaterial($data)
	{
		$this->db->insert('tb_material',$data);
	}

	function UpdateMaterial($id,$data)
	{
		$this->db->where('material_id',$id);
		$this->db->update('tb_material',$data);
	}

	function DeleteMaterial($id){
		$this->db->where('material_id',$id);
		$this->db->delete('tb_material');
	}
	//end of Material

	//User_crud section
	function Getuser_crud($query=FALSE,$id=FALSE,$limit=FALSE,$offset=FALSE)
	{
		if (!$query):
			$this->db->where('user_id',$id);
			return $this->db->get('tb_user')->row();
		elseif($query=='all'):
			$this->db->limit($limit,$offset);
			$this->db->order_by('user_id','desc');
			return $this->db->get('tb_user')->result_array();
		endif;
	}

	function CreateUser($data)
	{
		$this->db->insert('tb_user',$data);
	}

	function UpdateUser($id,$data)
	{
		$this->db->where('user_id',$id);
		$this->db->update('tb_user',$data);
	}

	function DeleteUser($id){
		$this->db->where('user_id',$id);
		$this->db->delete('tb_user');
	}
	/*end of user_crud*/

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

