<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Tokyo');
	}
	
	public function index(){
		// $error_num=["error"=>3];
		$this->load->view('login');
	}

	public function login_validation(){
		$this->load->model('Get');
		$frag = $this->Get->login();

		if($frag){
			redirect("/index.php/Welcome/board");
			//  $this->board();
		}else{
			$error_num= array(
				"error" => 5,
				"test" => "nanya");
			$this->load->view('login',$error_num);
		}
	}



	public function board(){
		$this->load->model('Get');
		$data['result'] = $this->Get->log();
		$this->load->view('hitokoto',$data);
	}

	public function add(){
		$this->load->model('Get');
		$frag = $this->Get->write();
		if($frag){ 
			redirect("/index.php/Welcome/?mode=1");
		}else{
			redirect("/index.php/Welcome/?mode=2");
		}
	}

	public function edit(){
		$this->load->model('Get');
		$id = $this->input->get('id', TRUE);
		$data['result'] = $this->Get->one($id);
		$this->load->view('edit',$data);
	}

	public function edit_OK(){
		$this->load->model('Get');
		$frag = $this->Get->upd();
		if($frag){
			redirect("/index.php/Welcome/?mode=3");
		}else{
			redirect("/index.php/Welcome/?mode=4");
		}
	}

	public function delete(){
		$this->load->model('Get');

		$frag = $this->Get->del();
		if($frag){
			redirect("/index.php/Welcome/?mode=5");
		}else{
			redirect("/index.php/Welcome/?mode=6");
		}
	}
}
