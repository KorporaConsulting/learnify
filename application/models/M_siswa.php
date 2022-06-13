<?php

class M_siswa extends CI_Model
{
    public function tampil_data()
    {
        $query = $this->db->get_where('user', array('role' => 3));
        return $query;
    }

    public function tampil_data_semester($semester, $id_user)
    {
        $this->db->select('*');
        $this->db->from('enroll');
        $this->db->join('semester', 'semester.id_semester = enroll.id_semester');
        $this->db->join('user', 'user.id_user = enroll.id_user');
        $this->db->join('mapel', 'mapel.id_semester = semester.id_semester');
        $this->db->where('semester.semester', $semester);
        $this->db->where('user.id_user', $id_user);
        $this->db->order_by("mapel.urutan", "asc");
        return  $this->db->get();
    }

    public function tampil_data_materi($slug)
    {
        $this->db->select('*');
        $this->db->from('enroll');
        $this->db->join('semester', 'semester.id_semester = enroll.id_semester');
        $this->db->join('user', 'user.id_user = enroll.id_user');
        $this->db->join('mapel', 'mapel.id_semester = semester.id_semester');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel');
        $this->db->join('status_materi', 'status_materi.id_materi = materi.id_materi', 'status_materi.id_user = user.id_user');
        // $this->db->join('status_materi', 'status_materi.id_user = user.id_user');
        $this->db->where('mapel.slug', $slug);
        $this->db->where('status_materi.id_user',  $this->session->userdata('id_user'));
        $this->db->group_by("materi.id_materi");
        $this->db->order_by("materi.urutan", "asc");
        return  $this->db->get();
    }

    public function tampil_data_isi_materi($id_materi, $id_user)
    {
        $this->db->select('*');
        $this->db->from('enroll');
        $this->db->join('semester', 'semester.id_semester = enroll.id_semester', 'left');
        $this->db->join('user', 'user.id_user = enroll.id_user', 'left');
        $this->db->join('mapel', 'mapel.id_semester = semester.id_semester', 'left');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel', 'left');
        $this->db->join('video', 'video.id_materi = materi.id_materi', 'left');
        $this->db->join('file', 'file.id_materi = materi.id_materi', 'left');
        $this->db->join('tb_soal', 'tb_soal.id_materi = materi.id_materi', 'left');
        $this->db->where('materi.id_materi', $id_materi);
        $this->db->where('user.id_user', $id_user);
        return  $this->db->get();
    }

    public function tampil_data_file($slug, $id_user)
    {
        $this->db->select('*');
        $this->db->from('enroll');
        $this->db->join('semester', 'semester.id_semester = enroll.id_semester', 'left');
        $this->db->join('user', 'user.id_user = enroll.id_user', 'left');
        $this->db->join('mapel', 'mapel.id_semester = semester.id_semester', 'left');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel', 'left');
        $this->db->join('file', 'file.id_materi = materi.id_materi', 'left');
        $this->db->where('materi.slug', $slug);
        $this->db->where('user.id_user', $id_user);
        return  $this->db->get();
    }

    public function tampil_data_video($slug, $id_user)
    {
        $this->db->select('*');
        $this->db->from('enroll');
        $this->db->join('semester', 'semester.id_semester = enroll.id_semester', 'left');
        $this->db->join('user', 'user.id_user = enroll.id_user', 'left');
        $this->db->join('mapel', 'mapel.id_semester = semester.id_semester', 'left');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel', 'left');
        $this->db->join('video', 'video.id_materi = materi.id_materi', 'left');
        $this->db->where('materi.slug', $slug);
        $this->db->where('user.id_user', $id_user);
        return  $this->db->get();
    }
    public function tampil_data_quiz($slug, $id_user)
    {
        $this->db->select('*');
        $this->db->from('enroll');
        $this->db->join('semester', 'semester.id_semester = enroll.id_semester', 'left');
        $this->db->join('user', 'user.id_user = enroll.id_user', 'left');
        $this->db->join('mapel', 'mapel.id_semester = semester.id_semester', 'left');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel', 'left');
        $this->db->join('tb_soal', 'tb_soal.id_materi = materi.id_materi', 'left');
        $this->db->where('materi.slug', $slug);
        $this->db->where('user.id_user', $id_user);
        return  $this->db->get();
    }

    public function tampil_data_course($slug)
    {
        $this->db->select('*');
        $this->db->from('mapel');
        $this->db->where('slug', $slug);
        return  $this->db->get();
    }
    public function get_nama_materi($slug)
    {
        $this->db->select('*');
        $this->db->from('materi');
        $this->db->where('slug', $slug);
        return  $this->db->get();
    }

    public function get_profile($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id_user', $id);
        return  $this->db->get();
    }

    public function detail_siswa($id = null)
    {
        $query = $this->db->get_where('user', array('id_user' => $id))->row();
        return $query;
    }

    public function delete_siswa($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function update_siswa($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
