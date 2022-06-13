<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!is_admin()) {
            $this->session->set_flashdata("error", "Hanya untuk role admin");
            redirect(base_url());
        }
        $this->load->model('stats_model', 'stats');
    }

    public function index()
    {
        $data = [
            'title'        => 'Home Admin',
            'chall_count'  => $this->db->get("chall_items")->num_rows(),
            'users_count'  => $this->db->get('users')->num_rows(),
            'pages_count'  => $this->db->get('site_pages')->num_rows(),
            'stats'        => $this->stats->countDays_byPage('page_master'),
            'visitor_page' => $this->stats->countAll_by('page_master')->num_rows(),
        ];
        backEnd_view('home', $data);
    }

    public function icons()
    {

        $data = [
            'title' => 'Icons',
        ];
        backEnd_view('icons', $data);
    }
}

/* End of file Admin/Home.php */
/* Location: ./application/controllers/Admin/Home.php */