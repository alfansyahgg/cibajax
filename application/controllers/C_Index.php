<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Index extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_Index'); // Auto load model M_Index pada fungsi construct
	}

	public function index()
	{
		$this->load->view('V_Index'); // Memanggil View V_Index
	}

	function ambilData(){
		$data = $this->M_Index->getData(); // Menampung value return dari fungsi getData ke variabel data
		echo json_encode($data); // Mengencode variabel data menjadi json format
	}

	function ambilDataByNoinduk(){
		$noinduk = $this->input->post('noinduk'); //Menangkap inputan no induk
		$data = $this->M_Index->getDataByNoinduk($noinduk); // Menampung value return dari fungsi getDataByNoinduk ke variabel data
		echo json_encode($data); // Mengencode variabel data menjadi json format
	}

	function hapusData(){
		$noinduk = $this->input->post('noinduk');
		$data = $this->M_Index->deleteData($noinduk);
		echo json_encode($data); // Mengencode variabel data menjadi json format
	}

	function tambahData(){
		$noinduk 	= $this->input->post('noinduk'); //Menangkap inputan no induk
		$nama 		= $this->input->post('nama'); //Menangkap inputan nama
		$alamat 	= $this->input->post('alamat'); //Menangkap inputan alamat
		$hobi 		= $this->input->post('hobi'); //Menangkap inputan hobi

		$data = ['noinduk' => $noinduk, 'nama' => $nama, 'hobi' => $hobi , 'alamat' => $alamat];
		$data = $this->M_Index->insertData($data);
		echo json_encode($data); // Mengencode variabel data menjadi json format
	}

	function perbaruiData(){
		$noinduk 	= $this->input->post('noinduk');
		$nama 		= $this->input->post('nama');
		$alamat 	= $this->input->post('alamat');
		$hobi 		= $this->input->post('hobi');

		$data = ['noinduk' => $noinduk, 'nama' => $nama, 'hobi' => $hobi , 'alamat' => $alamat];

		$data = $this->M_Index->updateData($noinduk,$data);
		
		echo json_encode($data); // Mengencode variabel data menjadi json format
	}
}
