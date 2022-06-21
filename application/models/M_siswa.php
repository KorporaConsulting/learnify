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
        $this->db->join('semester', 'semester.id_semester = enroll.id_semester', 'left');
        $this->db->join('user', 'user.id_user = enroll.id_user', 'left');
        $this->db->join('mapel', 'mapel.id_semester = semester.id_semester', 'left');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel', 'left');
        $this->db->join('status_materi', 'status_materi.id_materi = materi.id_materi', 'status_materi.id_user = user.id_user', 'left');
        // $this->db->join('status_materi', 'status_materi.id_user = user.id_user');
        $this->db->where('mapel.slug_mapel', $slug);
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

    public function tampil_data_file($id_mapel, $slug, $id_user)
    {
        $this->db->select('*');
        $this->db->from('enroll');
        $this->db->join('semester', 'semester.id_semester = enroll.id_semester', 'left');
        $this->db->join('user', 'user.id_user = enroll.id_user', 'left');
        $this->db->join('mapel', 'mapel.id_semester = semester.id_semester', 'left');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel', 'left');
        $this->db->join('file', 'file.id_materi = materi.id_materi', 'left');
        $this->db->where('mapel.id_mapel', $id_mapel);
        $this->db->where('materi.slug_materi', $slug);
        $this->db->where('user.id_user', $id_user);
        return  $this->db->get();
    }

    public function tampil_data_video($id_mapel, $slug, $id_user)
    {
        $this->db->select('*');
        $this->db->from('enroll');
        $this->db->join('semester', 'semester.id_semester = enroll.id_semester', 'left');
        $this->db->join('user', 'user.id_user = enroll.id_user', 'left');
        $this->db->join('mapel', 'mapel.id_semester = semester.id_semester', 'left');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel', 'left');
        $this->db->join('video', 'video.id_materi = materi.id_materi', 'left');
        $this->db->where('mapel.id_mapel', $id_mapel);
        $this->db->where('materi.slug_materi', $slug);
        $this->db->where('user.id_user', $id_user);
        return  $this->db->get();
    }
    public function tampil_data_quiz($id_mapel, $slug, $id_user)
    {
        $this->db->select('*');
        $this->db->from('enroll');
        $this->db->join('semester', 'semester.id_semester = enroll.id_semester', 'left');
        $this->db->join('user', 'user.id_user = enroll.id_user', 'left');
        $this->db->join('mapel', 'mapel.id_semester = semester.id_semester', 'left');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel', 'left');
        $this->db->join('tb_soal', 'tb_soal.id_materi = materi.id_materi', 'left');
        $this->db->where('mapel.id_mapel', $id_mapel);
        $this->db->where('materi.slug_materi', $slug);
        $this->db->where('user.id_user', $id_user);
        return  $this->db->get();
    }
    public function tampil_data_tugas($id_mapel, $slug, $id_user)
    {
        $this->db->select('*');
        $this->db->from('enroll');
        $this->db->join('semester', 'semester.id_semester = enroll.id_semester', 'left');
        $this->db->join('user', 'user.id_user = enroll.id_user', 'left');
        $this->db->join('mapel', 'mapel.id_semester = semester.id_semester', 'left');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel', 'left');
        $this->db->join('tugas', 'tugas.id_materi = materi.id_materi', 'left');
        // $this->db->join('file', 'file.id_materi = materi.id_materi', 'left');
        $this->db->where('mapel.id_mapel', $id_mapel);
        $this->db->where('materi.slug_materi', $slug);
        $this->db->where('user.id_user', $id_user);
        $this->db->group_by('tugas.id_tugas');
        return  $this->db->get();
    }

    public function tampil_data_list_tugas($id_mapel, $slug, $id_user)
    {
        $this->db->select('file.id_user,file.id_file, file.nama_file, desk_file, file.link, file.id_materi, file.approve');
        $this->db->from('enroll');
        $this->db->join('semester', 'semester.id_semester = enroll.id_semester', 'left');
        // $this->db->join('user', 'user.id_user = enroll.id_user', 'left');
        $this->db->join('mapel', 'mapel.id_semester = semester.id_semester', 'left');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel', 'left');
        $this->db->join('tugas', 'tugas.id_materi = materi.id_materi', 'left');
        $this->db->join('file', 'file.id_materi = materi.id_materi', 'left');
        $this->db->where('file.is_tugas', 1);
        $this->db->where('mapel.id_mapel', $id_mapel);
        $this->db->where('materi.slug_materi', $slug);
        $this->db->where('file.id_user', $id_user);
        $this->db->group_by('file.id_file');
        return  $this->db->get();
    }


    public function tampil_data_course($slug)
    {
        $this->db->select('*');
        $this->db->from('mapel');
        $this->db->where('slug_mapel', $slug);
        return  $this->db->get();
    }
    public function get_nama_materi($slug)
    {
        $this->db->select('*');
        $this->db->from('materi');
        $this->db->where('slug_materi', $slug);
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
    public function histori_nilai($id)
    {
        $this->db->select('*');
        $this->db->from('nilai');
        $this->db->join('materi', 'materi.id_materi = nilai.id_materi');
        $this->db->where('nilai.id_materi', $id);
        $this->db->where('nilai.id_user', $this->session->userdata('id_user'));
        return $this->db->get();
    }
    public function get_materi($slug)
    {
        $this->db->select('*');
        $this->db->from('materi');
        $this->db->where('slug_materi', $slug);
        return  $this->db->get();
    }
    public function check_tugas_user($id_materi, $id_user)
    {
        $this->db->select('*');
        $this->db->from('file');
        $this->db->where('id_materi', $id_materi);
        $this->db->where('id_user', $id_user);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function tampil_data_user($id_user)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id_user', $id_user);
        return $this->db->get();
    }
    public function get_semester_mapel($slug)
    {
        $this->db->select('*');
        $this->db->from('mapel');
        $this->db->join('semester', 'semester.id_semester = mapel.id_semester');
        $this->db->where('mapel.slug_mapel', $slug);
        return  $this->db->get();
    }
    public function get_urutan($id_mapel, $slug)
    {
        $this->db->select('materi.urutan');
        $this->db->from('mapel');
        $this->db->join('materi', 'mapel.id_mapel = materi.id_mapel');
        $this->db->where('materi.id_mapel', $id_mapel);
        $this->db->where('materi.slug_materi', $slug);
        return  $this->db->get();
    }
    public function get_urutan_previous($id_mapel, $urutan)
    {
        $this->db->select('*');
        $this->db->from('materi');
        $this->db->where('id_mapel', $id_mapel);
        $this->db->where('urutan', $urutan);
        return  $this->db->get();
    }
    public function get_nama_file($id_materi)
    {
        $this->db->select('id_file');
        $this->db->from('file');
        $this->db->where('id_materi', $id_materi);
        return  $this->db->get();
    }
    public function get_nama_video($id_materi)
    {
        $this->db->select('id_video');
        $this->db->from('video');
        $this->db->where('id_materi', $id_materi);
        return  $this->db->get();
    }
    public function get_nama_quiz($id_materi)
    {
        $this->db->select('id_soal');
        $this->db->from('tb_soal');
        $this->db->where('id_materi', $id_materi);
        return  $this->db->get();
    }
    public function get_nama_tugas($id_materi)
    {
        $this->db->select('id_tugas');
        $this->db->from('tugas');
        $this->db->where('id_materi', $id_materi);
        return  $this->db->get();
    }
    public function get_slug_course($id_mapel)
    {
        $this->db->select('slug_mapel');
        $this->db->from('mapel');
        $this->db->where('id_mapel', $id_mapel);
        return  $this->db->get();
    }
}
