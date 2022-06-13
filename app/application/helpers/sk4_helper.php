<?php

//base url
function _backEnd($part = null)
{
    return base_url("public/assets/backend/$part");
}

function _frontEnd($theme)
{
    return base_url("theme/frontend/$theme/assets/");
}

function _storage($part = null)
{
    return base_url("public/storage/" . htmlspecialchars($part));
}

//view landing page

function backEnd_content($view)
{
    $ci = &get_instance();
    $ci->load->view("backend/$view");
}

function backEnd_view($view, $data = [])
{
    $ci                 = &get_instance();
    $data['sk4content'] = $view;
    $data['akun']       = $ci->db->get_where('users', ['id' => $ci->session->userdata('id_login')])->row();
    $ci->load->view('backend/index', $data);
}

function frontEnd_view($view, $data = [])
{
    $ci = &get_instance();
    if (is_login()) {
        $us = $ci->db->get_where('users', ['id' => $ci->session->userdata('id_login')])->row();
        if ($us->status == 'inactive') {
            redirect(base_url("verify"));
        } else if ($us->status == 'banned') {
            redirect(base_url("banned"));
        }
        $data['us'] = $us;
    }

    $websetinggs = $ci->db->get_where('websettings', ['id' => 1])->row();
    if ($websetinggs->maintenance == 'on') {
        redirect(base_url("maintenance"));
        exit;
    }

    $data['menus'] = $ci->db->get_where('site_menus', ['status' => 1])->result();
    // $data['webmaster'] = $ci->db->get_where('webmaster', ['id' => 1])->row();
    $data['websettings']  = $websetinggs;
    $getcusomt            = file_get_contents("./theme/frontend/$websetinggs->theme_active/assets/sys/custom.json");
    $getcustom            = json_decode($getcusomt, true);
    $data['custom_theme'] = $getcustom[0];
    $ci->load->view("frontend/$websetinggs->theme_active/" . $view, $data);
}

function ajax_loadview($view, $data = [])
{
    $ci                  = &get_instance();
    $websetinggs         = $ci->db->get_where('websettings', ['id' => 1])->row();
    $data['websettings'] = $websetinggs;
    $ci->load->view("frontend/$websetinggs->theme_active/" . $view, $data);
}

function _POST($par)
{
    $ci  = &get_instance();
    $par = $ci->input->post($par);
    $par = htmlspecialchars($par);
    $par = str_replace("'", "", $par);
    return $par;
}

function uploadimg($par = [])
{
    $ci = &get_instance();
    if (!is_dir("./public/storage/$par[path]/")) {
        mkdir("./public/storage/$par[path]/", 0777, true);
    }
    $ci->load->library('upload');
    $config['upload_path']   = "./public/storage/$par[path]/";
    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
    $config['encrypt_name']  = true;
    $ci->upload->initialize($config);
    if (!empty($_FILES["$par[name]"]['name'])) {
        if ($ci->upload->do_upload("$par[name]")) {
            $img = $ci->upload->data();
            if ($par['compress'] == true) {
                $config['image_library']  = 'gd2';
                $config['source_image']   = "./public/storage/$par[path]/" . $img['file_name'];
                $config['create_thumb']   = false;
                $config['maintain_ratio'] = false;
                $config['quality']        = false;
                $config['width']          = $par['width'];
                $config['height']         = $par['height'];
                $config['new_image']      = "./public/storage/thumbnails/" . $img['file_name'];
                $ci->load->library('image_lib', $config);
                $ci->image_lib->resize();
            }
            $image = $img['file_name'];
            return array('result' => 'success', 'nama_file' => $image, 'error' => '');
        } else {
            return array('result' => 'error', 'file' => '', 'error' => $ci->upload->display_errors());
        }
    } else {
        return array('result' => 'noimg');
    }
}

function sluggenerate($text, string $divider = '-')
{
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, $divider);
    $text = preg_replace('~-+~', $divider, $text);
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }
    return $text;
}

function _getSlug($par)
{
    $ci     = &get_instance();
    $string = $ci->uri->segment($par);
    $string = htmlspecialchars($string);
    $string = str_replace('.', '', $string);
    $string = urldecode($string);
    return $string;
}

function _getbox($get)
{
    $ci  = &get_instance();
    $get = $ci->input->post($get);
    if ($get == 'on') {
        return 1;
    } else {
        return 0;
    }
}

function is_login($notcokie = true)
{
    $ci = &get_instance();
    if ($ci->session->userdata('status_login')) {
        return true;
    } else {
        if ($notcokie == true) {
            if (isset($_COOKIE['velixs_id']) && isset($_COOKIE['velixs_token'])) {
                $id_users = $_COOKIE['velixs_id'];
                $password = $_COOKIE['velixs_token'];
                $query    = $ci->db->get_where("users", array('id' => $id_users));
                if ($query->num_rows() == 1) {
                    $row = $query->row();
                    if ($password == hash('ripemd160', $row->password)) {
                        $ci->session->set_userdata(array('status_login' => true, 'id_login' => $row->id));
                        return true;
                    } else {
                        unset($_COOKIE['token']);
                        unset($_COOKIE['sk4']);
                        setcookie('sk4', null, -1, '/');
                        setcookie('token', null, -1, '/');
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

function is_admin($notcokie = true)
{
    $ci = &get_instance();
    if ($ci->session->userdata('status_login')) {
        $query = $ci->db->get_where("users", array('id' => $ci->session->userdata('id_login')))->row();
        if ($query->role == 'admin') {
            return true;
        } else {
            return false;
        }
    } else {
        if ($notcokie == true) {
            if (isset($_COOKIE['velixs_id']) && isset($_COOKIE['velixs_token'])) {
                $id_users = $_COOKIE['velixs_id'];
                $password = $_COOKIE['velixs_token'];
                $query    = $ci->db->get_where("users", array('id' => $id_users));
                if ($query->num_rows() == 1) {
                    $row = $query->row();
                    if ($password == hash('ripemd160', $row->password)) {
                        $ci->session->set_userdata(array('status_login' => true, 'id_login' => $row->id));
                        return true;
                    } else {
                        unset($_COOKIE['token']);
                        unset($_COOKIE['sk4']);
                        setcookie('sk4', null, -1, '/');
                        setcookie('token', null, -1, '/');
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

function _menus($type, $link)
{
    if ($type == 'direct' || $type == 'submenu') {
        return base_url($link);
    } else {
        return 'javascript:void(0)';
    }
}

function meta_tag($par = [])
{
    return '<title>' . $par['title'] . '</title>
	<meta name="robots" content="follow, index"/>
	<meta name="keywords" content="' . $par['keywords'] . '" />
	<link rel="shortcut icon" href="' . $par['favicon'] . '">
	<meta content="' . $par['description'] . '" name="description" />
	<meta content="' . $par['author'] . '" name="author" />
	<link rel="canonical" href="' . $par['url'] . '" />
	<meta property="og:locale" content="en_US" />
	<meta property="bb:client_area" content="' . $par['url'] . '">
	<meta property="og:url" content="' . $par['url'] . '" />
	<meta property="og:title" content="' . $par['title'] . '" />
	<meta property="og:image" content="' . $par['thumb'] . '" />
	<meta property="og:site_name" content="' . $par['title'] . '" />
	<meta property="og:type" content="website" />
	<meta property="og:description" content="' . $par['description'] . '" />
	<meta name="twitter:description" content="' . $par['description'] . '" />
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:site" content="@' . $par['title'] . '" />
	<meta name="twitter:title" content="' . $par['title'] . '" />
	<meta name="twitter:image" content="' . $par['thumb'] . '" />';
}

function re_url($urls, $path = '')
{
    $ci   = &get_instance();
    $urls = base_url($urls);
    if ($path == '') {
        $url = base_url("$_SERVER[REQUEST_URI]");
    } else {
        $url = base_url($path);
    }

    $ci->session->set_userdata(array('sk4_url' => $url));
    return "$urls";
}

function format_number($angka)
{
    $hasil_rupiah = number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

function hit_visit($page, $by = 0)
{
    $ci = &get_instance();
    $ip = $ci->input->ip_address();
    if ($ci->db->get_where('sk_stats', ['by_page' => $page, 'by_id' => $by, 'ip' => $ip])->num_rows() == 0) {
        $ci->db->insert('sk_stats', [
            'by_page'    => $page,
            'by_id'      => $by,
            'ip'         => $ip,
            'created_at' => date("Y-m-d h:i:sa"),
        ]);
    }
}

function count_visitor($page, $by = 0)
{
    $ci = &get_instance();
    return $ci->db->get_where('sk_stats', ['by_page' => $page, 'by_id' => $by])->num_rows();
}

function _csrf_velix()
{
    $ci = &get_instance();
    if (!$ci->session->userdata('csrf_token')) {
        $ci->session->set_userdata(['csrf_token' => base64_encode(openssl_random_pseudo_bytes(32))]);
    }
    return $ci->session->userdata('csrf_token');
}

function _csrf_validation($token)
{
    $ci = &get_instance();
    if ($token == $ci->session->userdata('csrf_token')) {
        $ci->session->unset_userdata('csrf_token');
    } else {
        echo 'TOKEN CSRF EXPIRED';
        exit;
    }
}