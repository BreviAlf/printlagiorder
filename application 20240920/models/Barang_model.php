<?php 
class Barang_model extends CI_Model {
    public $material_id;
    public $material_code;
    public $material_name;
    public $material_gsm;
    public $material_price;

    public $labels = [];

    public function __construct() {
        parent::__construct();
        $this->labels = $this->_attributeLabels();
        //memuat library database
        $this->load->database();
    }

    //metode untuk menambah baris data ke dalam tabel
    public function insert() {/*
        $sql = sprintf("INSERT INTO barang VALUES('%s','%s',%f,%d)",
            $this->kode,
            $this->nama,
            $this->harga,
            $this->stok
        );
        $this->db->query($sql);
    */}

    //metode untuk mengubah baris data di dalam tabel
    public function update() {/*
        $sql = sprintf("UPDATE barang SET nama='%s', harga=%f, stok=%d ".
                       "WHERE kode='%s'",
            
            $this->nama,
            $this->harga,
            $this->stok,
            $this->kode
        );
        $this->db->query($sql);
    */}

    //metode untuk menghapus baris data dari dalam tabel
    public function delete() {/*
        $sql = sprintf("DELETE FROM barang ".
                        "WHERE kode='%s'",
                        $this->kode
        );
        $this->db->query($sql);
    */}

    //metode untuk melakukan seleksi data
    public function read() {
        $sql = "SELECT * FROM tb_material";
        $query = $this->db->query($sql);
        return $query->result();
    }

    private function _attributeLabels() {
        return [
            'material_id'=>'material_id',
            'material_code'=>'material_code',
            'material_name'=>'material_name',
            'material_gsm'=>'material_gsm',
            'material_price'=>'material_price'
        ];
    }
}