<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Index extends CI_Model {

	function getData(){
		return $this->db->get('tb_siswa')->result(); // me-return hasil dari get tb_siswa
	}

	function getDataByNoinduk($noinduk){
		$this->db->where('noinduk',$noinduk); // where no induk
		return $this->db->get('tb_siswa')->result(); // me-return hasil dari get tb_siswa
	}

	function deleteData($noinduk){
		$this->db->where('noinduk',$noinduk); // where no induk
		$this->db->delete('tb_siswa'); // mendelete tb_siswa sesuai kondisi di atas
	}

	function insertData($data){
		$this->db->insert('tb_siswa',$data); // menginsert pada tb_siswa dengan variabel data
	}

	function updateData($noinduk,$data){
		$this->db->where('noinduk',$noinduk); // where no induk
		$this->db->update('tb_siswa',$data); //mengupdate tb_siswa sesuai kondisi di atas
	}
}
