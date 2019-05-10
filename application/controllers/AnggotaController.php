<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class AnggotaController extends CI_Controller { 
	function __construct()
	{
		parent::__construct();
		$this->load->model('Anggota');
	}
	public function index() { 
		if (!$this->session->userdata('isLoggedIn')) redirect(base_url().'login','refresh');
		$data['dataAnggota'] = $this->Anggota->getListAnggota();
		$this->template->load('template','anggota/index',$data);
	}
	public function create(){
		if (!$this->session->userdata('isLoggedIn')) redirect(base_url().'login','refresh');
		$this->template->load('template','anggota/create');
	}
	public function store(){
		if (!$this->session->userdata('isLoggedIn')) redirect(base_url().'login','refresh');
		$data = array(
			'nama' => $this->input->post('nama'),
			'prodi' => $this->input->post('prodi'),
			'jenjang' => $this->input->post('jenjang'),
			'alamat' => $this->input->post('alamat')
		);
		$result = $this->Anggota->insert($data);
		echo json_encode($result);
	}
	public function delete(){
		if (!$this->session->userdata('isLoggedIn')) redirect(base_url().'login','refresh');
		$result = $this->Anggota->delete($this->input->post('kode_anggota'));
		echo json_encode($result);
	}	  
	public function edit($kode_anggota){
		if (!$this->session->userdata('isLoggedIn')) redirect(base_url().'login','refresh');
		$data['dataAnggota'] = $this->Anggota->getDataAnggota($kode_anggota);
		$this->template->load('template','anggota/edit',$data);
	}
	public function update($kode_anggota){
		if (!$this->session->userdata('isLoggedIn')) redirect(base_url().'login','refresh');
		$result = $this->Anggota->update($kode_anggota);
		echo json_encode($result);
	}
}