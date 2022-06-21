<?php

class M_materi extends CI_Model
{
    public function tampil_data_mapel()
    {
        $this->db->select('*');
        $this->db->from('mapel');
        $this->db->join('guru', 'guru.id_guru = mapel.id_guru');
        $this->db->join('semester', 'semester.id_semester= mapel.id_semester');
        $this->db->order_by('mapel.id_semester');
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
        $this->db->where('slug_materi', $slug);
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

    public function tampil_sort_mapel($id)
    {
        $this->db->select('*');
        $this->db->from('mapel');
        $this->db->join('guru', 'guru.id_guru = mapel.id_guru');
        $this->db->join('semester', 'semester.id_semester= mapel.id_semester');
        $this->db->where('mapel.id_semester', $id);
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
        $this->db->where('file.is_tugas', 0);
        return  $this->db->get();
    }
    public function where_tampil_tugas($id)
    {
        $this->db->select('*');
        $this->db->from('tugas');
        $this->db->join('materi', 'materi.id_materi = tugas.id_materi');
        $this->db->where('tugas.id_materi', $id);
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
    public function delete_tugas($where, $table)
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
    public function update_data_tugas($where, $data, $table)
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
    public function check_materi($materi)
    {
        $this->db->select('*');
        $this->db->from('materi');
        $this->db->where('nama_materi', $materi);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function get_list_materi($id_semester)
    {
        $this->db->select('materi.id_materi');
        $this->db->from('mapel');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel');
        // $this->db->join('semester', 'semester.id_semester = mapel.id_semester', 'left');
        $this->db->where('mapel.id_semester', $id_semester);
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
    public function status_materi($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function tampil_data_materi_admin($id_user)
    {
        $this->db->select('* ,COUNT(status_materi.status) AS materi_status');
        $this->db->from('mapel');
        // $this->db->from('enroll');
        // $this->db->join('semester', 'semester.id_semester = mapel.id_semester');
        // $this->db->join('user', 'user.id_user = enroll.id_user');
        // $this->db->join('mapel', 'mapel.id_semester = semester.id_semester');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel');
        $this->db->join('status_materi', 'status_materi.id_materi = materi.id_materi', 'status_materi.id_user = user.id_user');
        // $this->db->join('status_materi', 'status_materi.id_user = user.id_user');
        $this->db->where('status_materi.id_user', $id_user);
        // $this->db->where('mapel.slug_mapel', $slug);
        $this->db->group_by("materi.id_materi");
        $this->db->order_by("materi.urutan", "asc");
        return  $this->db->get();
    }
    public function tampil_data_course_admin($id_user)
    {
        $this->db->select('status_materi.id_user,mapel.nama_mapel,mapel.slug_mapel, count(status_materi.status) as jumlah, SUM(status_materi.status = 1 ) AS done');
        // $this->db->select('user.id_user,mapel.nama_mapel,mapel.slug, COUNT(IF(status_materi.status = 1, 1, null)) as done, COUNT(status) as jumlah');
        $this->db->from('mapel');
        // $this->db->join('semester', 'semester.id_semester = enroll.id_semester', 'left');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel');
        $this->db->join('status_materi', 'status_materi.id_materi = materi.id_materi');
        // $this->db->join('user', 'user.id_user = enroll.id_user', 'left');
        // $this->db->join('mapel', 'mapel.id_semester = semester.id_semester', 'left');
        // $this->db->join('status_materi', 'status_materi.id_user = user.id_user');
        $this->db->where('status_materi.id_user', $id_user);
        // $this->db->group_by("materi.id_materi");
        $this->db->group_by("mapel.nama_mapel");
        $this->db->order_by("mapel.urutan", "asc");

        return  $this->db->get();
    }
    public function get_row_all_status($id_user)
    {
        $this->db->select('COUNT(status_materi.status) AS materi_status');
        $this->db->from('enroll');
        $this->db->join('semester', 'semester.id_semester = enroll.id_semester');
        $this->db->join('user', 'user.id_user = enroll.id_user');
        $this->db->join('mapel', 'mapel.id_semester = semester.id_semester');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel');
        $this->db->join('status_materi', 'status_materi.id_materi = materi.id_materi', 'status_materi.id_user = user.id_user');
        // $this->db->join('status_materi', 'status_materi.id_user = user.id_user');
        $this->db->where('user.id_user', $id_user);
        $this->db->order_by("materi.urutan", "asc");
        return  $this->db->get();
    }
    public function get_row_status_done($id_user)
    {
        $this->db->select('COUNT(IF(status_materi.status = 1, status, NULL)) as done_status,');
        $this->db->from('enroll');
        $this->db->join('semester', 'semester.id_semester = enroll.id_semester');
        $this->db->join('user', 'user.id_user = enroll.id_user');
        $this->db->join('mapel', 'mapel.id_semester = semester.id_semester');
        $this->db->join('materi', 'materi.id_mapel = mapel.id_mapel');
        $this->db->join('status_materi', 'status_materi.id_materi = materi.id_materi', 'status_materi.id_user = user.id_user');
        // $this->db->join('status_materi', 'status_materi.id_user = user.id_user');
        $this->db->where('user.id_user', $id_user);
        $this->db->order_by("materi.urutan", "asc");
        return  $this->db->get();
    }

    public function tampil_data_quiz()
    {
        $this->db->select('*');
        $this->db->from('nilai');
        $this->db->join('materi', 'materi.id_materi = nilai.id_materi');
        $this->db->join('mapel', 'mapel.id_mapel = materi.id_mapel');
        $this->db->join('user', 'user.id_user = nilai.id_user');
        $this->db->where('nilai.nilai >= 70');
        $this->db->order_by("user.nama", "desc");
        return  $this->db->get();
    }
    public function histori_nilai($id_materi, $id_user)
    {
        $this->db->select('*');
        $this->db->from('nilai');
        $this->db->join('materi', 'materi.id_materi = nilai.id_materi');
        $this->db->where('nilai.id_materi', $id_materi);
        $this->db->where('nilai.id_user', $id_user);
        return $this->db->get();
    }

    public function get_user($id_user)
    {
        $this->db->select('nama');
        $this->db->from('user');
        $this->db->where('id_user', $id_user);
        return $this->db->get();
    }

    public function check_user($id_user, $semester)
    {
        $query = $this->db->query('SELECT * FROM status_materi WHERE id_user =' . $id_user . ' and semester_status_materi =' . $semester);
        return $query->num_rows();
    }
    public function check_materi_mark($id_mapel, $id_materi)
    {
        $this->db->select('*');
        $this->db->from('materi');
        $this->db->where('id_materi', $id_materi);
        $this->db->where('id_mapel', $id_mapel);
        return  $this->db->get();
    }
    public function where_tampil_tugas_user()
    {
        $this->db->select('*');
        $this->db->from('materi');
        $this->db->join('mapel', 'mapel.id_mapel = materi.id_mapel');
        $this->db->join('tugas', 'tugas.id_materi = materi.id_materi');
        $this->db->join('file', 'file.id_materi = materi.id_materi');
        $this->db->join('user', 'user.id_user = file.id_user');
        return  $this->db->get();
    }
    public function approve_tugas($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function check_file_user($id_materi, $id_user)
    {
        $this->db->select('*');
        $this->db->where('id_materi', $id_materi);
        $this->db->where('id_user', $id_user);
        $this->db->where('is_tugas', 1);
        $query = $this->db->get('file');
        return $query->num_rows();
    }
    public function check_file_user_done($id_materi, $id_user)
    {
        $this->db->select('*');
        $this->db->where('id_materi', $id_materi);
        $this->db->where('id_user', $id_user);
        $this->db->where('is_tugas', 1);
        $this->db->where('approve', 1);
        $query = $this->db->get('file');
        return $query->num_rows();
    }

    public function check_urutan($id_mapel)
    {
        $this->db->select_max('urutan');
        $this->db->where('id_mapel', $id_mapel);
        return $this->db->get('materi');
    }
    public function check_urutan_materi($id, $id_mapel)
    {
        $this->db->select('urutan');
        $this->db->from('materi');
        $this->db->where('id_mapel', $id_mapel);
        $this->db->where('id_materi', $id);
        return $this->db->get();
    }
    public function get_urutan_materi($urutan, $id_mapel)
    {
        $this->db->select('*');
        $this->db->from('materi');
        $this->db->where('id_mapel', $id_mapel);
        $this->db->where('urutan >', $urutan);
        return $this->db->get();
    }

    public function check_urutan_mapel($id_semester)
    {
        $this->db->select_max('urutan');
        $this->db->where('id_semester', $id_semester);
        return $this->db->get('mapel');
    }
    public function check_urutan_mapel_delete($id, $id_semester)
    {
        $this->db->select('urutan');
        $this->db->from('mapel');
        $this->db->where('id_mapel', $id);
        $this->db->where('id_semester', $id_semester);
        return $this->db->get();
    }
    public function get_urutan_mapel($urutan, $id_semester)
    {
        $this->db->select('*');
        $this->db->from('mapel');
        $this->db->where('id_semester', $id_semester);
        $this->db->where('urutan >', $urutan);
        return $this->db->get();
    }
}
