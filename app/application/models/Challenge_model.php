<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Challenge_model extends CI_Model
{

    // ------------------------------------------------------------------------

    public function __construct()
    {
        parent::__construct();
    }

    // ------------------------------------------------------------------------

    // ------------------------------------------------------------------------

    public function get_chall()
    {
        $this->db->select("*");
        $this->db->from("chall_items");
        $this->db->order_by("id", 'DESC');
        return $this->db->get();
    }

    // ------------------------------------------------------------------------

}

/* End of file Content_model.php */
/* Location: ./application/models/Content_model.php */