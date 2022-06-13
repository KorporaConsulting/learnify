<?php

class M_enroll extends CI_Model
{
    public function tampil_data_enroll()
    {
        // return  $this->db->query("SELECT DISTINCT status as status_enroll, GROUP_CONCAT(enroll.id_enroll SEPARATOR ',') as id_enroll, GROUP_CONCAT(user.nama SEPARATOR ', ') as nama_user, GROUP_CONCAT(semester.semester SEPARATOR ', ') as semester FROM enroll JOIN semester on semester.id_semester = enroll.id_semester JOIN user on user.id_user = enroll.id_user GROUP BY enroll.status");
        $this->db->select('*');
        $this->db->from('enroll');
        $this->db->join('semester', 'semester.id_semester = enroll.id_semester');
        $this->db->join('user', 'user.id_user = enroll.id_user');
        $this->db->order_by("user.nama", "asc");
        return $this->db->get();
    }

    public function delete_enroll($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
