<?php

class M_guru extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('guru');
    }

    public function detail_guru($id = null)
    {
        $this->db->select('*');
        $this->db->from('guru');
        $this->db->join('mapel', 'mapel.id_guru = guru.id_guru');
        $this->db->where('mapel.id_guru', $id);
        return  $this->db->get();
    }

    public function delete_guru($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function update_guru($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
