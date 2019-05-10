<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class PeminjamanController extends CI_Controller { 
	function __construct()
	{
		parent::__construct();
		$this->load->model('Peminjaman');
		$this->load->model('Anggota');
		$this->load->model('Petugas');
	}
	public function index() { 
		if (!$this->session->userdata('isLoggedIn')) redirect(base_url().'login','refresh');
		$data['dataPeminjaman'] = $this->Peminjaman->getListPeminjaman();
		$this->template->load('template','peminjaman/index',$data);
	}
	public function create(){
		if (!$this->session->userdata('isLoggedIn')) redirect(base_url().'login','refresh');
		$data['dataAnggota'] = $this->Anggota->getListAnggota();
		$data['dataPetugas'] = $this->Petugas->getListPetugas();
		$this->template->load('template','peminjaman/create', $data);
	}
	public function store(){
		if (!$this->session->userdata('isLoggedIn')) redirect(base_url().'login','refresh');
		$data = array(
			'kode_anggota' => $this->input->post('kode_anggota'),
			'kode_petugas' => $this->session->userdata('kode_petugas'),
		);
		$result = $this->Peminjaman->insert($data);
		echo json_encode($result);
	}
	public function delete(){
		if (!$this->session->userdata('isLoggedIn')) redirect(base_url().'login','refresh');
		$result = $this->Peminjaman->delete($this->input->post('kode_pinjam'));
		echo json_encode($result);
	}	  
	public function edit($kode_pinjam){
		if (!$this->session->userdata('isLoggedIn')) redirect(base_url().'login','refresh');
		$data['dataAnggota'] = $this->Anggota->getListAnggota();
		$data['dataPetugas'] = $this->Petugas->getListPetugas();
		$data['dataPeminjaman'] = $this->Peminjaman->getDataPeminjaman($kode_pinjam);
		$this->template->load('template','peminjaman/edit',$data);
	}
	public function update($kode_pinjam){
		if (!$this->session->userdata('isLoggedIn')) redirect(base_url().'login','refresh');
		$result = $this->Peminjaman->update($kode_pinjam);
		echo json_encode($result);
	}
}