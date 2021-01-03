<?php
defined('BASEPATH') or exit('No direct script access allowed');

class main extends CI_Controller
{
	public function index()
	{
		$this->load->helper('url');
		$this->load->database();
		$this->load->library('session');
		$this->load->library('parser');

		// print_r($this->session->userdata("sepet")); // session data print

		// test db or session
		$this->session->set_userdata("oturum", false); // true ise veri tabanına false ise session'a kaydeder.
		$this->session->set_userdata("kullanici_id", 1);

		$index_parser = array(
			"base_url" => base_url(),
		);
		$this->parser->parse('index', $index_parser);
	}
}
