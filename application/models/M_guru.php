<?php

class M_guru extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('guru');
    }

    public function get_guru($id)
    {
        $this->db->select('*');
        $this->db->from('guru');
        $this->db->where('guru.id_guru', $id);
        return  $this->db->get();
    }

    public function detail_guru($id)
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
    public function jadwal_zoom($tgl_start, $tgl_end)
    {
        $this->db->select('*');
        $this->db->from('guru');
        $this->db->join('mapel', 'mapel.id_guru = guru.id_guru');
        $this->db->where('mapel.tgl_mulai >=', $tgl_start);
        $this->db->where('mapel.tgl_mulai <=', $tgl_end);
        $this->db->where('mapel.id_guru', $this->session->userdata('id_guru'));
        $this->db->where('mapel.is_zoom', 1);
        $this->db->order_by("mapel.urutan", "asc");
        return  $this->db->get();
    }

    public function tampil_data_live()
    {
        $this->db->select('*');
        $this->db->from('guru');
        $this->db->join('mapel', 'mapel.id_guru = guru.id_guru');
        $this->db->where('mapel.id_guru', $this->session->userdata('id_guru'));
        $this->db->where('mapel.is_zoom', 1);
        $this->db->order_by("mapel.urutan", "asc");
        return  $this->db->get();
    }
    public function tampil_data_course($slug)
    {
        $this->db->select('*');
        $this->db->from('mapel');
        $this->db->where('slug_mapel', $slug);
        return  $this->db->get();
    }
    public function jadwal_zoom_all()
    {
        $this->db->select('*');
        $this->db->from('guru');
        $this->db->join('mapel', 'mapel.id_guru = guru.id_guru');
        $this->db->where('mapel.id_guru', $this->session->userdata('id_guru'));
        $this->db->where('mapel.is_zoom', 1);
        $this->db->order_by("mapel.urutan", "asc");
        return  $this->db->get();
    }
}
