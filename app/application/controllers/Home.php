<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = [];
        hit_visit('page_master');
        frontEnd_view('home', $data);
    }

    public function maintenance()
    {
        $data = $this->db->get_where('websettings', ['id' => 1])->row();
        if ($data->maintenance != 'on') {
            redirect(base_url());
        } else {
            $datas['websettings'] = $data;
            $this->load->view("frontend/$data->theme_active/maintenance", $datas);
        }
    }

    public function page_404()
    {
        $data                 = $this->db->get_where('websettings', ['id' => 1])->row();
        $datas['websettings'] = $data;
        $this->load->view("frontend/$data->theme_active/404", $datas);
    }

    public function page()
    {
        $slug  = $this->uri->segment(1);
        $query = $this->db->select("*")->from("site_pages")->where(['status' => 1, 'seo_slug' => $slug])->get();
        if ($query->num_rows() != 0) {
            $data['row'] = $query->row();
            hit_visit('site_pages', $data['row']->id);
            frontEnd_view("pages", $data);
        } else {
            redirect(base_url("404"));
        }
    }
}