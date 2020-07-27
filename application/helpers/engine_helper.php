<?php 
    function cek_session_akses($link,$level){
        $ci = & get_instance();
        $session = $ci->db->query("SELECT link,level_akses FROM t_menu WHERE link = '".$link."' AND level_akses='".$level."'")->num_rows();
        if ($session == '0'){
            redirect(base_url().'siteman/home');
        }
    }

    function background(){
        $ci = & get_instance();
        $bg = $ci->db->query("SELECT gambar FROM background ORDER BY id_background DESC LIMIT 1")->row_array();
        return $bg['gambar'];
    }

    function logo(){
        $ci = & get_instance();
        $logo = $ci->db->query("SELECT logo FROM t_identitas WHERE id_identitas = 1 ORDER BY id_identitas LIMIT 1")->row_array();
        return base_url().'assets/images/'.$logo['logo'];
    }

    function title(){
        $ci = & get_instance();
        $title = $ci->db->query("SELECT nama_website FROM t_identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
        return $title['nama_website'];
    }

    function description(){
        $ci = & get_instance();
        $title = $ci->db->query("SELECT meta_deskripsi FROM t_identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
        return $title['meta_deskripsi'];
    }

    function keywords(){
        $ci = & get_instance();
        $title = $ci->db->query("SELECT meta_keyword FROM t_identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
        return $title['meta_keyword'];
    }

    function favicon(){
        $ci = & get_instance();
        $fav = $ci->db->query("SELECT favicon FROM t_identitas ORDER BY id_identitas DESC LIMIT 1")->row_array();
        return base_url().'/assets/images/'.$fav['favicon'];
    }

    function get_name($k){
        $ci = & get_instance();
        $nm = $ci->db->query("SELECT nama_menu FROM t_menu WHERE id_menu = '".$k."' ORDER BY id_menu DESC LIMIT 1")->row_array();
        if ($nm!='') {
            return $nm['nama_menu'];
        }else{
            return 'Tidak Ada';
        }
        
    }

    function get_users($k){
        $ci = & get_instance();
        $nm = $ci->db->query("SELECT nama FROM t_users WHERE id_users = '".$k."' ORDER BY id_users DESC LIMIT 1")->row_array();
        if ($nm!='') {
            return $nm['nama'];
        }else{
            return 'Tidak Ada';
        }
        
    }

    function cek_session_admin(){
        $ci = & get_instance();
        $session = $ci->session->userdata('level');
        if ($session != 'admin'){
            redirect(base_url());
        }
    }

    function cek_session_user(){
        $ci = & get_instance();
        $session = $ci->session->userdata('level');
        if ($session == ''){
            redirect(base_url());
        }
    }
