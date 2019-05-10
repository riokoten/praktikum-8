<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Petugas');
	}

	public function index()
	{
		if ($this->session->userdata('isLoggedIn')) redirect(base_url().'petugas','refresh');
		$this->load->view('login');
	}

    
	public function auth() {
		if ($this->session->userdata('isLoggedIn')) redirect(base_url().'petugas','refresh');

		$user = $this->input->post('username');
		$pass = md5($this->input->post('password'));
		$petugas = $this->Petugas->getPetugasLogin($user, $pass)->row_array();
		if (is_null($petugas)) {
			$this->session->set_flashdata('login_failed', 'Username atau password salah');
			redirect($this->agent->referrer(),'refresh');
		} else {
			$petugas['last_login'] = $this->Petugas->setLastLogin($petugas['kode_petugas']);
			$petugas['isLoggedIn'] = true;
			$this->session->set_userdata($petugas);
			redirect('petugas','refresh');
		}
	}

	public function unauth(){
		$this->session->sess_destroy();
		redirect('login','refresh');
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Admin/Login.php */