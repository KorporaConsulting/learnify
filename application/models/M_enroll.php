<?php

class M_enroll extends CI_Model
{
    public function tampil_data_enroll()
    {
        $this->db->select('*');
        $this->db->from('enroll');
        $this->db->join('mapel', 'mapel.id_mapel = enroll.id_mapel');
        $this->db->join('user', 'user.id_user = enroll.id_user');
        return  $this->db->get();
    }

    public function delete_enroll($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
