<?php


function check_transaksi($id)
{
    $cek_transaksi = $this->db->query('SELECT last_status FROM user WHERE id_user = ' . $this->session->userdata("id_user"));
    $cek = $cek_transaksi->row();

    if ($cek->last_status == 0) {
        return false;
    } else {
        return true;
    }
}
