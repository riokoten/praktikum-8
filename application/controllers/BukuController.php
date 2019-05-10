<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class BukuController extends CI_Controller { 
	function __construct()
	{
		parent::__construct();
		$this->load->model('Buku');
	}
	public function index() { 
		if (!$this->session->userdata('isLoggedIn')) redirect(base_url().'login','refresh');
		$data['dataBuku'] = $this->Buku->getListBuku();
		$this->template->load('template','buku/index',$data);
	}
	public function create(){
		if (!$this->session->userdata('isLoggedIn')) redirect(base_url().'login','refresh');
		$this->template->load('template','buku/create');
	}
	public function store(){
		if (!$this->session->userdata('isLoggedIn')) redirect(base_url().'login','refresh');
		$data = array(
			'judul_buku' => $this->input->post('judul_buku'),
			'pengarang' => $this->input->post('pengarang'),
			'penerbit' => $this->input->post('penerbit'),
			'tahun_terbit' => $this->input->post('tahun_terbit')
		);
		$result = $this->Buku->insert($data);
		echo json_encode($result);
	}
	public function delete(){
		if (!$this->session->userdata('isLoggedIn')) redirect(base_url().'login','refresh');
		$result = $this->Buku->delete($this->input->post('kode_register'));
		echo json_encode($result);
	}	  
	public function edit($kode_register){
		if (!$this->session->userdata('isLoggedIn')) redirect(base_url().'login','refresh');
		$data['dataBuku'] = $this->Buku->getDataBuku($kode_register);
		$this->template->load('template','buku/edit',$data);
	}
	public function update($kode_register){
		if (!$this->session->userdata('isLoggedIn')) redirect(base_url().'login','refresh');
		$result = $this->Buku->update($kode_register);
		echo json_encode($result);
	}
}