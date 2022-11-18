<?php

function is_logged_in()
{
    $ci = get_instance();

    if (!$ci->session->userdata('phone')) {
        redirect('auth');
    } else {
        $data['user'] = $ci->db->get_where('user', ['tlp' => $ci->session->userdata('phone')])->row_array();
    }

    function check_access($role_id, $menu_id)
    {
        $ci = get_instance();

        $result = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);

        if ($result->num_rows() > 0) {
            return "checked='checked'";
        }
    }
    function check_staff($id)
    {
        $ci = get_instance();

        $result = $ci->db->get_where('m_personil_pers', ['id' => $id, 'isactive' => 1]);

        if ($result->num_rows() > 0) {
            return "checked='checked'";
        }
    }
    function check_client($dokter_id, $status)
    {
        $ci = get_instance();

        $result = $ci->db->get_where('client', ['dokter_id' => $dokter_id, 'status' => 1]);

        if ($result->num_rows() > 0) {
            return "checked='checked'";
        }
    }
}
