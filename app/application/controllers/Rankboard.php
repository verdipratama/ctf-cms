<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rankboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("front_model", 'front');
    }

    public function index()
    {
        $data['rank'] = $this->front->rankboard()->result();
        frontEnd_view('rankboard', $data);
    }
}