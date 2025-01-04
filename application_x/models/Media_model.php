<?php
class Media_model extends CI_Model
{
	public function __construct() {
        parent::__construct();
	}
	// Category section
	function GetMedia($query=FALSE,$id=FALSE,$limit=FALSE,$offset=FALSE)
	{
		if (!$query):
			$this->db->where('media_id',$id);
			return $this->db->get('tb_media')->row();
		elseif($query=='all'):
			$this->db->limit($limit,$offset);
			$this->db->order_by('media_id','desc');
			return $this->db->get('tb_media')->result_array();
		endif;
	}

	function CreateMedia($data)
	{
		$this->db->insert('tb_media',$data);
	}

	function UpdateMedia($id,$data)
	{
		$this->db->where('media_id',$id);
		$this->db->update('tb_media',$data);
	}

	function DeleteMedia($id)
	{
		$this->db->where('media_id',$id);
		$this->db->delete('tb_media');
	}
	// end of category section

}

