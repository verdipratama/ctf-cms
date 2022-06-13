<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Themes extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!is_admin()) {
            $this->session->set_flashdata("error", "Hanya untuk role admin");
            redirect(base_url());
        }
    }

    public function index()
    {
        $websetinggs = $this->db->get_where('websettings', ['id' => 1])->row();
        $data        = [
            'title'       => 'Themes',
            'scan'        => array_diff(scandir("./theme/frontend/"), array('.', '..')),
            'websetinggs' => $websetinggs,
        ];
        backEnd_view("themes/list", $data);
    }

    public function set_theme()
    {
        $theme = $this->uri->segment(4);
        $this->db->update('websettings', ['theme_active' => $theme], ['id' => 1]);
        $this->session->set_flashdata('success', 'Successfully changed the theme.');
        redirect(base_url("admin/themes"));
    }

    public function custom()
    {
        $websetinggs = $this->db->get_where('websettings', ['id' => 1])->row();
        $data        = file_get_contents("./theme/frontend/$websetinggs->theme_active/assets/sys/custom.json");
        $json        = json_decode($data, true);
        $data        = [
            'title'       => 'Custom Info',
            'row'         => $json[0],
            'websettings' => $websetinggs,
        ];
        backEnd_view("themes/custom", $data);
    }
}