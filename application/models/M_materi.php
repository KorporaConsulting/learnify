<?php

class M_materi extends CI_Model
{
    public function tampil_data_mapel()
    {
        $this->db->select('*');
        $this->db->from('mapel');
        $this->db->join('guru', 'guru.id_guru = mapel.id_guru');
        $this->db->join('semester', 'semester.id_semester= mapel.id_semester');

        return  $this->db->get();
    }
    public function get_mapel($id)
    {
        $this->db->select('*');
        $this->db->from('mapel');
        $this->db->where('id_mapel', $id);
        return  $this->db->get();
    }
    public function get_materi($slug)
    {
        $this->db->select('*');
        $this->db->from('materi');
        $this->db->where('slug', $slug);
        return  $this->db->get();
    }

    public function tampil_data_mapel_where($id)
    {
        $this->db->select('*');
        $this->db->from('mapel');
        $this->db->join('guru', 'guru.id_guru = mapel.id_guru');
        $this->db->join('semester', 'semester.id_semester= mapel.id_semester');
        $this->db->where('mapel.id_mapel', $id);
        return  $this->db->get();
    }
    public function tampil_data_semester()
    {
        $this->db->select('*');
        $this->db->from('semester');
        return  $this->db->get();
    }

    public function check_unique_semester($id = '', $semester)
    {
        $this->db->where('semester', $semester);
        if ($id) {
            $this->db->where_not_in('id_semester', $id);
        }
        return $this->db->get('semester')->num_rows();
    }

    public function tampil_sort_mapel()
    {
        $this->db->select('*');
        $this->db->from('mapel');
        $this->db->join('guru', 'guru.id_guru = mapel.id_guru');
        $this->db->join('semester', 'semester.id_semester= mapel.id_semester');
        $this->db->order_by('urutan');

        return  $this->db->get();
    }
    public function tampil_data_materi_course($id)
    {
        $this->db->select('*');
        $this->db->from('mapel');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel');
        $this->db->join('semester', 'semester.id_semester = mapel.id_semester');
        $this->db->where('mapel.id_mapel', $id);
        $this->db->order_by('materi.urutan', 'asc');
        return  $this->db->get();
    }
    public function tampil_data_materi()
    {
        $this->db->select('*');
        $this->db->from('mapel');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel');
        $this->db->join('semester', 'semester.id_semester = mapel.id_semester');
        return  $this->db->get();
    }

    public function where_sort_data_materi($id)
    {
        $this->db->select('*');
        $this->db->from('mapel');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel');
        $this->db->where('mapel.id_mapel', $id);
        $this->db->order_by('materi.urutan');
        return  $this->db->get();
    }

    public function tampil_sort_materi()
    {
        $this->db->select('*');
        $this->db->from('mapel');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel');
        $this->db->order_by('urutan');
        return  $this->db->get();
    }

    public function where_tampil_materi($id)
    {
        $this->db->select('*');
        $this->db->from('materi');
        $this->db->where('id_materi', $id);
        return  $this->db->get();
    }
    public function where_tampil_video($id)
    {
        $this->db->select('*');
        $this->db->from('video');
        $this->db->join('materi', 'materi.id_materi = video.id_materi');
        $this->db->where('video.id_materi', $id);
        return  $this->db->get();
    }
    public function where_tampil_quiz($id)
    {
        $this->db->select('*');
        $this->db->from('tb_soal');
        $this->db->join('materi', 'materi.id_materi = tb_soal.id_materi');
        $this->db->where('tb_soal.id_materi', $id);
        return  $this->db->get();
    }
    public function where_tampil_file($id)
    {
        $this->db->select('*');
        $this->db->from('file');
        $this->db->join('materi', 'materi.id_materi = file.id_materi');
        $this->db->where('file.id_materi', $id);
        return  $this->db->get();
    }
    public function update_semester($id)
    {
        $this->db->select('*');
        $this->db->from('semester');
        $this->db->where('id_semester', $id);
        return $query = $this->db->get();
    }

    public function update_mapel($id)
    {
        $this->db->select('*');
        $this->db->from('guru');
        $this->db->join('mapel', 'guru.id_guru = mapel.id_guru');
        $this->db->where('mapel.id_mapel', $id);
        return $query = $this->db->get();
    }


    public function belajar($id = null)
    {
        $query = $this->db->get_where('materi', array('id' => $id))->row();
        return $query;
    }

    public function detail_materi($id = null)
    {
        $query = $this->db->get_where('materi', array('id' => $id))->row();
        return $query;
    }

    public function delete_materi($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function delete_mapel($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function delete_semester($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function delete_video($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function delete_file($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function update_materi($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
    public function update_data_video($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function update_data_file($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function update_data_materi($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function check_enroll($id_semester, $id_user)
    {
        $this->db->select('*');
        $this->db->from('enroll');
        $this->db->where('id_semester', $id_semester);
        $this->db->where('id_user', $id_user);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function get_list_materi($id_semester)
    {
        $this->db->select('materi.id_materi');
        $this->db->from('mapel');
        $this->db->join('semester', 'semester.id_semester = mapel.id_semester', 'left');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel', 'left');
        $this->db->where('semester.id_semester', $id_semester);
        return  $this->db->get();
    }
    public function get_check_user()
    {
        $this->db->select('status_materi.id_user');
        $this->db->from('status_materi');
        return  $this->db->get();
    }
    public function check_table_enroll()
    {
        $this->db->select('*');
        $this->db->from('enroll');
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function get_status_materi()
    {
        $this->db->select('id_user');
        $this->db->from('status_materi');
        $this->db->group_by('id_user');
        $query = $this->db->get();
        return $query;
    }
    public function get_status_materi_user($id_materi, $id_user)
    {
        $this->db->select('status');
        $this->db->from('status_materi');
        $this->db->where('id_materi', $id_materi);
        $this->db->where('id_user', $id_user);
        $query = $this->db->get();
        return $query;
    }
    public function check_table_enroll_id_user($id)
    {
        $this->db->select('*');
        $this->db->from('enroll');
        $this->db->where('id_enroll', $id);
        return $query = $this->db->get();
        // return $query->num_rows();
    }
    public function status_materi($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
