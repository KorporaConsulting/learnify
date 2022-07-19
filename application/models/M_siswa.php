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
        $this->db->join('status_mapel', 'status_mapel.id_mapel = mapel.id_mapel');
        $this->db->where('semester.semester', $semester);
        $this->db->where('status_mapel.id_user', $id_user);
        $this->db->where('mapel.is_zoom', 0);
        $this->db->group_by("mapel.id_mapel");
        $this->db->order_by("mapel.urutan", "asc");
        return  $this->db->get();
    }
    public function tampil_data_semester_zoom($semester, $id_user)
    {
        $this->db->select('*');
        $this->db->from('enroll');
        $this->db->join('semester', 'semester.id_semester = enroll.id_semester');
        $this->db->join('user', 'user.id_user = enroll.id_user');
        $this->db->join('mapel', 'mapel.id_semester = semester.id_semester');
        $this->db->where('semester.semester', $semester);
        $this->db->where('user.id_user', $id_user);
        $this->db->where('mapel.is_zoom', 1);
        $this->db->order_by("mapel.tgl_mulai", "asc");
        return  $this->db->get();
    }

    public function tampil_data_side_materi($id_mapel)
    {
        $this->db->select('*');
        $this->db->from('enroll');
        $this->db->join('semester', 'semester.id_semester = enroll.id_semester', 'left');
        $this->db->join('user', 'user.id_user = enroll.id_user', 'left');
        $this->db->join('mapel', 'mapel.id_semester = semester.id_semester', 'left');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel', 'left');
        $this->db->join('status_materi', 'status_materi.id_materi = materi.id_materi', 'status_materi.id_user = user.id_user', 'left');
        // $this->db->join('status_materi', 'status_materi.id_user = user.id_user');
        $this->db->where('mapel.id_mapel', $id_mapel);
        $this->db->where('status_materi.id_user',  $this->session->userdata('id_user'));
        $this->db->group_by("materi.id_materi");
        $this->db->order_by("materi.urutan", "asc");
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

    public function tampil_data_live($slug)
    {
        $this->db->select('*');
        $this->db->from('enroll');
        $this->db->join('semester', 'semester.id_semester = enroll.id_semester', 'left');
        $this->db->join('user', 'user.id_user = enroll.id_user', 'left');
        $this->db->join('mapel', 'mapel.id_semester = semester.id_semester', 'left');
        // $this->db->join('status_materi', 'status_materi.id_user = user.id_user');
        $this->db->where('mapel.slug_mapel', $slug);
        $this->db->where('enroll.id_user',  $this->session->userdata('id_user'));
        $this->db->order_by("mapel.urutan", "asc");
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
        // $this->db->join('user', 'user.id_user = enroll.id_user', 'left');
        $this->db->join('mapel', 'mapel.id_semester = semester.id_semester', 'left');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel', 'left');
        $this->db->join('status_materi', 'status_materi.id_materi = materi.id_materi', 'left');
        $this->db->join('file', 'file.id_materi = materi.id_materi', 'left');
        $this->db->where('mapel.id_mapel', $id_mapel);
        $this->db->where('materi.slug_materi', $slug);
        $this->db->where('enroll.id_user', $id_user);
        $this->db->group_by('status_materi.id_materi');
        return  $this->db->get();
    }

    public function tampil_data_zoom($id_mapel, $slug, $id_user)
    {
        $this->db->select('*');
        $this->db->from('enroll');
        $this->db->join('semester', 'semester.id_semester = enroll.id_semester', 'left');
        $this->db->join('user', 'user.id_user = enroll.id_user', 'left');
        $this->db->join('mapel', 'mapel.id_semester = semester.id_semester', 'left');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel', 'left');
        $this->db->join('status_materi', 'status_materi.id_materi = materi.id_materi', 'status_materi.id_user = user.id_user', 'left');
        $this->db->join('file', 'file.id_materi = materi.id_materi', 'left');
        $this->db->where('mapel.id_mapel', $id_mapel);
        $this->db->where('materi.slug_materi', $slug);
        $this->db->where('user.id_user', $id_user);
        $this->db->where('file.is_tugas', 2);
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
        $this->db->join('status_materi', 'status_materi.id_materi = materi.id_materi', 'status_materi.id_user = user.id_user', 'left');
        $this->db->join('video', 'video.id_materi = materi.id_materi', 'left');
        $this->db->where('mapel.id_mapel', $id_mapel);
        $this->db->where('materi.slug_materi', $slug);
        $this->db->where('status_materi.id_user', $id_user);
        return  $this->db->get();
    }
    public function tampil_data_quiz($id_mapel, $slug, $id_user)
    {
        $this->db->select('*');
        $this->db->from('mapel');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel', 'left');
        $this->db->join('status_materi', 'status_materi.id_materi = materi.id_materi', 'left');
        $this->db->join('quiz', 'quiz.id_materi = materi.id_materi', 'left');
        $this->db->join('tb_soal', 'tb_soal.id_quiz = quiz.id_quiz', 'left');
        $this->db->where('mapel.id_mapel', $id_mapel);
        $this->db->where('materi.slug_materi', $slug);
        $this->db->where('status_materi.id_user', $id_user);
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
        $this->db->join('status_materi', 'status_materi.id_materi = materi.id_materi', 'status_materi.id_user = user.id_user', 'left');
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
        $this->db->order_by('nilai.id_nilai', 'desc');
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
    public function check_absensi($id_mapel, $id_user)
    {
        $this->db->select('*');
        $this->db->from('absensi');
        $this->db->where('id_mapel', $id_mapel);
        $this->db->where('id_user', $id_user);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function get_total_absen()
    {
        $this->db->select('*');
        $this->db->from('enroll');
        $this->db->join('semester', 'semester.id_semester = enroll.id_semester', 'left');
        $this->db->join('user', 'user.id_user = enroll.id_user', 'left');
        $this->db->join('mapel', 'mapel.id_semester = semester.id_semester', 'left');
        $this->db->where('user.id_user',  $this->session->userdata('id_user'));
        $this->db->where('mapel.is_zoom', 1);
        $query =  $this->db->get();
        return $query->num_rows();
    }

    public function total_absen_penilaian()
    {
        $this->db->select('*');
        $this->db->from('absensi');
        $this->db->join('user', 'user.id_user = absensi.id_user', 'left');
        $this->db->join('mapel', 'mapel.id_mapel = absensi.id_mapel', 'left');
        $this->db->where('absensi.id_user',  $this->session->userdata('id_user'));
        $query =  $this->db->get();
        return $query->num_rows();
    }

    public function get_absen()
    {
        $this->db->select('*');
        $this->db->from('absensi');
        $this->db->where('id_user',  $this->session->userdata('id_user'));
        $query =  $this->db->get();
        return $query->num_rows();
    }

    public function get_akurasi_absen()
    {
        $this->db->select('*, sum(ketepatan_absensi) as akurasi');
        $this->db->from('absensi');
        $this->db->where('id_user',  $this->session->userdata('id_user'));
        return  $this->db->get();
    }

    public function nilai_quiz()
    {
        $this->db->select('mapel.nama_mapel,materi.nama_materi, max(nilai.nilai) as nilai_quiz');
        $this->db->from('mapel');
        $this->db->join('materi', 'mapel.id_mapel = materi.id_mapel');
        $this->db->join('nilai', 'materi.id_materi = nilai.id_materi');
        $this->db->where('nilai.id_user', $this->session->userdata('id_user'));
        $this->db->where('nilai.type', '0');
        $this->db->group_by('nilai.id_materi');
        return $this->db->get();
    }
    public function nilai_final($id_mapel)
    {
        $this->db->select('mapel.nama_mapel,materi.nama_materi, max(nilai.nilai) as nilai_final');
        $this->db->from('mapel');
        $this->db->join('materi', 'mapel.id_mapel = materi.id_mapel');
        $this->db->join('nilai', 'materi.id_materi = nilai.id_materi');
        $this->db->where('nilai.id_user', $this->session->userdata('id_user'));
        $this->db->where('mapel.id_mapel', $id_mapel);
        $this->db->where('nilai.type', '1');
        $this->db->group_by('nilai.id_materi');
        return $this->db->get();
    }

    public function total_status($id_user, $id_mapel)
    {
        $this->db->select('*');
        $this->db->from('status_materi');
        $this->db->join('materi', 'materi.id_materi = status_materi.id_materi');
        $this->db->where('status_materi.id_user', $id_user);
        $this->db->where('materi.id_mapel', $id_mapel);
        $query =  $this->db->get();
        return $query->num_rows();
    }
    public function done_status($id_user, $id_mapel)
    {
        $this->db->select('*');
        $this->db->from('status_materi');
        $this->db->join('materi', 'materi.id_materi = status_materi.id_materi');
        $this->db->where('status_materi.id_user', $id_user);
        $this->db->where('materi.id_mapel', $id_mapel);
        $this->db->where('status_materi.status', 1);
        $query =  $this->db->get();
        return $query->num_rows();
    }

    public function transkrip()
    {
        $this->db->select('*, max(transkrip.nilai) as nilai_final');
        $this->db->from('transkrip');
        $this->db->join('mapel', 'mapel.id_mapel = transkrip.id_mapel');
        $this->db->where('transkrip.id_user', $this->session->userdata('id_user'));
        $this->db->where('mapel.is_zoom', 0);
        $this->db->group_by('transkrip.id_mapel');
        $this->db->order_by('mapel.id_semester');
        return $this->db->get();
    }

    public function nilai_tugas($id_mapel)
    {
        $this->db->select('*, file.created_at as kumpul');
        $this->db->from('mapel');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel');
        $this->db->join('file', 'file.id_materi = materi.id_materi');
        $this->db->join('tugas', 'tugas.id_materi = materi.id_materi');
        $this->db->where('file.id_user', $this->session->userdata('id_user'));
        $this->db->where('materi.id_mapel', $id_mapel);
        $this->db->where('file.is_tugas', 1);
        $this->db->where('file.approve', 1);
        return $this->db->get();
    }

    public function check_tugas($id_mapel)
    {
        $this->db->select('*');
        $this->db->from('tugas');
        $this->db->join('materi', 'tugas.id_materi = materi.id_materi', 'left');
        $this->db->join('mapel', 'materi.id_mapel = mapel.id_mapel', 'left');
        // $this->db->join('file', 'file.id_materi = materi.id_materi', 'left');
        $this->db->where('mapel.id_mapel', $id_mapel);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function detail_transkrip()
    {
        $this->db->select('*, max(detail_transkrip.nilai) as nilai_final');
        $this->db->from('detail_transkrip');
        $this->db->join('mapel', 'mapel.id_mapel = detail_transkrip.id_mapel');
        $this->db->where('detail_transkrip.id_user', $this->session->userdata('id_user'));
        $this->db->group_by('detail_transkrip.id_mapel');
        $this->db->order_by('mapel.id_semester');
        return $this->db->get();
    }
    public function ujian()
    {
        $this->db->select('*, max(nilai.nilai) as nilai_final');
        $this->db->from('nilai');
        $this->db->join('materi', 'materi.id_materi = nilai.id_materi', 'left');
        $this->db->join('quiz', 'quiz.id_materi = materi.id_materi', 'left');
        $this->db->join('mapel', 'materi.id_mapel = mapel.id_mapel', 'left');
        $this->db->where('nilai.id_user', $this->session->userdata('id_user'));
        $this->db->group_by('nilai.id_materi');
        $this->db->order_by('nilai.id_nilai', 'desc');
        return $this->db->get();
    }
    public function tugas()
    {
        $this->db->select('file.id_user,file.id_file, file.nama_file, desk_file, file.link, file.id_materi, file.approve, mapel.nama_mapel');
        $this->db->from('file');
        $this->db->join('materi', 'materi.id_materi = file.id_materi', 'left');
        $this->db->join('mapel', 'mapel.id_mapel = materi.id_mapel', 'left');
        $this->db->join('tugas', 'tugas.id_materi = materi.id_materi', 'left');
        $this->db->where('file.is_tugas', 1);
        $this->db->where('file.id_user', $this->session->userdata('id_user'));
        $this->db->group_by('file.id_file');
        return  $this->db->get();
    }
    public function jadwal_zoom()
    {
        $this->db->select('*');
        $this->db->from('enroll');
        $this->db->join('semester', 'semester.id_semester = enroll.id_semester');
        $this->db->join('mapel', 'mapel.id_semester = semester.id_semester');
        $this->db->join('guru', 'guru.id_guru = mapel.id_guru');
        $this->db->where('enroll.id_user', $this->session->userdata('id_user'));
        $this->db->where('mapel.is_zoom', 1);
        $this->db->order_by("mapel.urutan", "asc");
        return  $this->db->get();
    }
    public function jadwal_zoom_home($tgl_start, $tgl_end)
    {
        $this->db->select('*');
        $this->db->from('enroll');
        $this->db->join('semester', 'semester.id_semester = enroll.id_semester');
        $this->db->join('mapel', 'mapel.id_semester = semester.id_semester');
        $this->db->join('guru', 'guru.id_guru = mapel.id_guru');
        $this->db->where('enroll.id_user', $this->session->userdata('id_user'));
        $this->db->where('mapel.is_zoom', 1);
        // $this->db->where('mapel.tgl_mulai', date('Y-m-d 00:00:00'));
        $this->db->where('mapel.tgl_mulai >=', '2022-07-18 00:00:00');
        $this->db->where('mapel.tgl_mulai <=', '2022-07-18 23:59:59');
        $this->db->order_by("mapel.urutan", "asc");
        return  $this->db->get();
    }
    public function get_all_absensi()
    {
        $this->db->select('*, absensi.created_at as waktu_masuk');
        $this->db->from('absensi');
        $this->db->join('mapel', 'absensi.id_mapel = mapel.id_mapel');
        $this->db->where('id_user',  $this->session->userdata('id_user'));
        return  $this->db->get();
    }
}
