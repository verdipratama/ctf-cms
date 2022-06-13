<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Front_model extends CI_Model
{

    // ------------------------------------------------------------------------

    public function __construct()
    {
        parent::__construct();
    }

    // ------------------------------------------------------------------------

    public function getAllChall($category, $level)
    {
        $this->db->select('chall_items.*,chall_category.cate_title,chall_category.cate_slug');
        $this->db->from('chall_items');
        $this->db->join('chall_category', 'chall_category.cate_id = chall_items.category');
        if ($category != '') {
            $this->db->where('chall_category.cate_slug', $category);
        }
        if ($level != '') {
            $this->db->where('chall_items.level', $level);
        }
        $this->db->where('chall_items.status', 1);
        $this->db->order_by('chall_items.id', 'DESC');
        return $this->db->get();
    }

    public function challDetail($id)
    {
        $this->db->select('chall_items.*,chall_category.cate_title,users.name');
        $this->db->from('chall_items');
        $this->db->join('chall_category', 'chall_category.cate_id = chall_items.category');
        $this->db->join('users', 'users.id = chall_items.author');
        $this->db->where('chall_items.status', 1);
        $this->db->where('chall_items.id', $id);
        return $this->db->get();
    }

    public function countChallby($id)
    {
        $this->db->select("id,status,category");
        $this->db->from('chall_items');
        $this->db->where('chall_items.status', 1);
        $this->db->where('chall_items.category', $id);
        return $this->db->get()->num_rows();
    }

    public function getSolvedByChall($id_chall)
    {
        $this->db->select("chall_history.*,users.name,users.username");
        $this->db->from('chall_history');
        $this->db->join('users', 'users.id = chall_history.id_users');
        $this->db->where('chall_history.id_chall', $id_chall);
        return $this->db->get();
    }

    public function rankboard()
    {
        $this->db->select("users.*,(points - points_hint) as points_asli");
        $this->db->from("users");
        $this->db->where('status', 'active');
        $this->db->order_by("points_asli", 'DESC');
        $this->db->limit(100);
        return $this->db->get();
    }

    public function users_list($limit, $start)
    {
        $this->db->select("users.*,(points - points_hint) as points_asli");
        $this->db->from("users");
        $this->db->where('status', 'active');
        $this->db->order_by("id", 'ASC');
        $this->db->limit($limit, $start);
        return $this->db->get();
    }

    public function countUsers()
    {
        $this->db->select("users.*");
        $this->db->from("users");
        $this->db->where('status', 'active');
        return $this->db->get()->num_rows();
    }

    public function statisticCategorySolved($id)
    {
        $this->db->select('chall_history.*, chall_category.cate_title as titlecate, chall_category.cate_icon, COUNT(*) AS jumlah');
        $this->db->from('chall_history');
        $this->db->join('chall_items', 'chall_items.id = chall_history.id_chall');
        $this->db->join('chall_category', 'chall_items.category = chall_category.cate_id');
        $this->db->where("id_users", $id);
        $this->db->group_by('category');
        return $this->db->get();
    }

    public function getChallSolved($id)
    {
        $this->db->select("chall_history.*,chall_items.title as chall_title, chall_items.score");
        $this->db->from("chall_history");
        $this->db->join('chall_items', 'chall_items.id = chall_history.id_chall');
        $this->db->where('id_users', $id);
        $this->db->order_by("chall_history.id", 'DESC');
        return $this->db->get();
    }

    // ------------------------------------------------------------------------
    public function get_slug($table, $where, $val, $stats = '')
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where, $val);
        $this->db->where('status', $stats);
        $this->db->limit(1);
        return $this->db->get();
    }

    public function getcontent_limit($limit, $type)
    {
        $this->db->select('content_item.*,users.name,users.avatar');
        $this->db->from('content_item');
        $this->db->join('users', 'users.id = content_item.author');
        $this->db->where('content_item.status', 'Publish');
        $this->db->where('content_item.type', $type);
        $this->db->order_by('content_item.id', 'DESC');
        $this->db->limit($limit);
        return $this->db->get();
    }

    public function getContentByType($limit, $start, $type, $cate = '')
    {
        if ($cate != '') {
            $this->db->select('content_item.*,users.name,users.avatar');
            $this->db->from('content_item');
            $this->db->join('users', 'users.id = content_item.author');
            $this->db->where('content_item.status', 'Publish');
            $this->db->where('content_item.type', $type);
            $this->db->where('SUBSTRING_INDEX(content_item.category,",",-1)', $cate);
            $this->db->or_where('SUBSTRING_INDEX(content_item.category,",",1)', $cate);
            $this->db->order_by('content_item.id', 'DESC');
            $this->db->limit($limit, $start);
        } else {
            $this->db->select('content_item.*,users.name,users.avatar');
            $this->db->from('content_item');
            $this->db->join('users', 'users.id = content_item.author');
            $this->db->where('content_item.status', 'Publish');
            $this->db->where('content_item.type', $type);
            $this->db->order_by('content_item.id', 'DESC');
            $this->db->limit($limit, $start);
        }
        return $this->db->get();
    }

    public function getAllByType($type, $cate = '')
    {
        if ($cate != '') {
            $this->db->select('content_item.*,users.name,users.avatar');
            $this->db->from('content_item');
            $this->db->join('users', 'users.id = content_item.author');
            $this->db->where('content_item.status', 'Publish');
            $this->db->where('content_item.type', $type);
            $this->db->where('SUBSTRING_INDEX(content_item.category,",",-1)', $cate);
            $this->db->or_where('SUBSTRING_INDEX(content_item.category,",",1)', $cate);
        } else {
            $this->db->select('content_item.*,users.name,users.avatar');
            $this->db->from('content_item');
            $this->db->join('users', 'users.id = content_item.author');
            $this->db->where('content_item.status', 'Publish');
            $this->db->where('content_item.type', $type);
        }
        return $this->db->get()->num_rows();
    }

    public function getDetailContent($slug)
    {
        $this->db->select('content_item.*,users.name,users.avatar');
        $this->db->from('content_item');
        $this->db->join('users', 'users.id = content_item.author');
        $this->db->where('content_item.status', 'Publish');
        $this->db->where('content_item.seo_slug', $slug);
        $this->db->order_by('content_item.id', 'DESC');
        $this->db->limit(1);
        return $this->db->get();
    }

    public function getSearch($query)
    {
        $this->db->select('content_item.*,users.name,users.avatar');
        $this->db->from('content_item');
        $this->db->join('users', 'users.id = content_item.author');
        $this->db->where('content_item.status', 'Publish');
        $this->db->like('content_item.title', $query);
        return $this->db->get()->num_rows();
    }

    public function getContentSearch($limit, $start, $query)
    {
        $this->db->select('content_item.*,users.name,users.avatar,content_type.type_slug,content_type.input_price');
        $this->db->from('content_item');
        $this->db->join('users', 'users.id = content_item.author');
        $this->db->join('content_type', 'content_type.id = content_item.type');
        $this->db->where('content_item.status', 'Publish');
        $this->db->order_by('content_item.id', 'DESC');
        $this->db->like('content_item.title', $query);
        $this->db->limit($limit, $start);
        return $this->db->get();
    }
    // ------------------------------------------------------------------------

}

/* End of file Front_model.php */
/* Location: ./application/models/Front_model.php */