<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calender extends CI_Controller {

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


	public function index()
	{
		$this->display();
	}

	public function display($year=null, $month=null){
		if(!$year){
			$year = date('Y');
		}
		if(!$month){
			$month = date('m');
		}
		$this->load->model("Calendar_model");
		if($day = $this->input->post("day")){
			$text = $this->input->post("text");
			$this->Calendar_model->add_calendar_data("$year-$month-$day",$text);
		}
		$data["calendar"] = $this->Calendar_model->generate($year,$month);
		$this->load->view("welcome_message", $data);
	}
	

}
