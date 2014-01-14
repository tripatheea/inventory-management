<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	private $data;
	
	function __construct()
	{
			parent::__construct();
			
			// Libraries and helpers and models.
			$this->load->helper('url');
			$this->load->helper('permission_manager');
			$this->load->library('validation');
			$this->load->model('sharedDB_model');
			$this->data = permission_manager();
	}

	function index()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['title']		= 'Welcome';
			
			$this->load->view('templates/header', $data);
			$this->load->view('welcome', $data);
			$this->load->view('templates/footer', $data);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */