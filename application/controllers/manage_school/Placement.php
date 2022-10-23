<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once 'application/controllers/manage_school/Base.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Placement extends SchoolBase
{
    public function __construct()
    {
        parent::__construct();
        if ($this->base_model->get_join_item('row', '*', NULL, 'users', ['users_groups'], ['users.id=users_groups.user_id'], ['inner'], ['users.id' => $this->session->userdata('user_id'), 'group_id' => 2])) {
            $this->_is_logged_in();
        }
        $this->data['title'] = "Placement";
    }

    public function index()
    {
        $this->data['tryout'] = $this->base_model->get_item('result', 'tryout_group', 'id, name');
        $tryout_group_id = $this->input->post('tryout_group');

        $this->data['all_student'] = $this->base_model->get_join_item('row', 'COUNT(*) as total', NULL, 'users', ['users_resellers'], ['users.id = users_resellers.user_id'], ['inner'], ['reseller_id' => $this->session->userdata('user_id')]);
        $this->data['saintek_student'] = $this->base_model->get_join_item('row', 'COUNT(*) as total', NULL, 'users', ['users_resellers', 'exam'], ['users.id = users_resellers.user_id', 'exam.user_id = users.id'], ['inner', 'inner'], ['exam.tryout_group_id' => $tryout_group_id, 'reseller_id' => $this->session->userdata('user_id'), 'category' => 'saintek']);
        $this->data['soshum_student'] = $this->base_model->get_join_item('row', 'COUNT(*) as total', NULL, 'users', ['users_resellers', 'exam'], ['users.id = users_resellers.user_id', 'exam.user_id = users.id'], ['inner', 'inner'], ['exam.tryout_group_id' => $tryout_group_id, 'reseller_id' => $this->session->userdata('user_id'), 'category' => 'soshum']);

        $this->data['avg_subject'] = $this->base_model->get_join_item('result', 'kategori_soal.subject, kategori_soal.category, AVG(exam_score.score) as score', NULL, 'exam_score', ['kategori_soal', 'exam', 'users', 'users_resellers'], ['exam_score.kategori_soal_id = kategori_soal.id', 'exam_score.exam_id = exam.id', 'exam.user_id = users.id', 'users.id = users_resellers.user_id'], ['inner', 'inner', 'inner', 'inner'], ['scope' => 3, 'reseller_id' => $this->session->userdata('user_id'), 'exam.tryout_group_id' => $tryout_group_id], ['kategori_soal.subject']);

        //Statistik Pilihan PTN
        $ptn_statistik_ptn1 = $this->base_model->get_join_item('result', 'ptn.nama, exam.category, COUNT(*) as total', NULL, 'ptn', ['exam', 'users', 'users_resellers'], ['ptn.id = exam.ptn1', 'exam.user_id = users.id', 'users.id = users_resellers.user_id'], ['inner', 'inner', 'inner'], ['reseller_id' => $this->session->userdata('user_id'), 'exam.tryout_group_id' => $tryout_group_id], ['ptn.nama', 'exam.category']);
        $ptn_statistik_ptn2 = $this->base_model->get_join_item('result', 'ptn.nama, exam.category, COUNT(*) as total', NULL, 'ptn', ['exam', 'users', 'users_resellers'], ['ptn.id = exam.ptn2', 'exam.user_id = users.id', 'users.id = users_resellers.user_id'], ['inner', 'inner', 'inner'], ['reseller_id' => $this->session->userdata('user_id'), 'exam.tryout_group_id' => $tryout_group_id], ['ptn.nama', 'exam.category']);
        $ptn_statistik = [];
        $this->data['result_statistik_ptn'] = [];
        if (!empty($ptn_statistik_ptn1)) {
            foreach ($ptn_statistik_ptn1 as $i) {
                array_push($ptn_statistik, $i);
            }
        }

        if (!empty($ptn_statistik_ptn2)) {
            foreach ($ptn_statistik_ptn2 as $i) {
                array_push($ptn_statistik, $i);
            }
        }

        if (!empty($ptn_statistik)) {
            foreach ($ptn_statistik as $item) {
                if (isset($this->data['result_statistik_ptn'][$item['nama']])) {
                    //Add the cost
                    if ($item['category'] == 'saintek') {
                        $this->data['result_statistik_ptn'][$item['nama']]["saintek"] += $item['total'];
                    } else {
                        $this->data['result_statistik_ptn'][$item['nama']]["soshum"] += $item['total'];
                    }
                } else {
                    //Init as array
                    if ($item['category'] == 'saintek') {
                        $this->data['result_statistik_ptn'][$item['nama']] = array("nama" => $item['nama'], "saintek" => $item['total'], "soshum" => 0);
                    } else {
                        $this->data['result_statistik_ptn'][$item['nama']] = array("nama" => $item['nama'], "saintek" => 0, "soshum" => $item['total']);
                    }
                }
            }
        }

        //Statistik Pilihan Saintek
        $saintek_statistik_ptn1 = $this->base_model->get_join_item('result', 'ptn.jurusan, COUNT(*) as total', NULL, 'ptn', ['exam', 'users', 'users_resellers'], ['ptn.id = exam.ptn1', 'exam.user_id = users.id', 'users.id = users_resellers.user_id'], ['inner', 'inner', 'inner', 'inner'], ['reseller_id' => $this->session->userdata('user_id'), 'exam.tryout_group_id' => $tryout_group_id, 'exam.category' => 'saintek'], ['ptn.jurusan']);
        $saintek_statistik_ptn2 = $this->base_model->get_join_item('result', 'ptn.jurusan, COUNT(*) as total', NULL, 'ptn', ['exam', 'users', 'users_resellers'], ['ptn.id = exam.ptn2', 'exam.user_id = users.id', 'users.id = users_resellers.user_id'], ['inner', 'inner', 'inner', 'inner'], ['reseller_id' => $this->session->userdata('user_id'), 'exam.tryout_group_id' => $tryout_group_id, 'exam.category' => 'saintek'], ['ptn.jurusan']);
        $statistik_saintek = [];
        $this->data['result_statistik_saintek'] = [];
        if (!empty($saintek_statistik_ptn1)) {
            foreach ($saintek_statistik_ptn1 as $i) {
                array_push($statistik_saintek, $i);
            }
        }

        if (!empty($saintek_statistik_ptn2)) {
            foreach ($saintek_statistik_ptn2 as $i) {
                array_push($statistik_saintek, $i);
            }
        }

        if (!empty($statistik_saintek)) {
            foreach ($statistik_saintek as $item) {
                if (isset($this->data['result_statistik_saintek'][$item['jurusan']])) {
                    //Add the cost
                    $this->data['result_statistik_saintek'][$item['jurusan']]["total"] += $item['total'];
                } else {
                    //Init as array
                    $this->data['result_statistik_saintek'][$item['jurusan']] = array("jurusan" => $item['jurusan'], "total" => $item['total']);
                }
            }
        }

        //Statistik Pilihan Soshum
        $soshum_statistik_ptn1 = $this->base_model->get_join_item('result', 'ptn.jurusan, COUNT(*) as total', NULL, 'ptn', ['exam', 'users', 'users_resellers'], ['ptn.id = exam.ptn1', 'exam.user_id = users.id', 'users.id = users_resellers.user_id'], ['inner', 'inner', 'inner', 'inner'], ['reseller_id' => $this->session->userdata('user_id'), 'exam.tryout_group_id' => $tryout_group_id, 'exam.category' => 'soshum'], ['ptn.jurusan']);
        $soshum_statistik_ptn2 = $this->base_model->get_join_item('result', 'ptn.jurusan, COUNT(*) as total', NULL, 'ptn', ['exam', 'users', 'users_resellers'], ['ptn.id = exam.ptn2', 'exam.user_id = users.id', 'users.id = users_resellers.user_id'], ['inner', 'inner', 'inner', 'inner'], ['reseller_id' => $this->session->userdata('user_id'), 'exam.tryout_group_id' => $tryout_group_id, 'exam.category' => 'soshum'], ['ptn.jurusan']);
        $statistik_soshum = [];
        $this->data['result_statistik_soshum'] = [];
        if (!empty($soshum_statistik_ptn1)) {
            foreach ($soshum_statistik_ptn1 as $i) {
                array_push($statistik_soshum, $i);
            }
        }

        if (!empty($soshum_statistik_ptn2)) {
            foreach ($soshum_statistik_ptn2 as $i) {
                array_push($statistik_soshum, $i);
            }
        }

        if (!empty($statistik_soshum)) {
            foreach ($statistik_soshum as $item) {
                if (isset($this->data['result_statistik_soshum'][$item['jurusan']])) {
                    //Add the cost
                    $this->data['result_statistik_soshum'][$item['jurusan']]["total"] += $item['total'];
                } else {
                    //Init as array
                    $this->data['result_statistik_soshum'][$item['jurusan']] = array("jurusan" => $item['jurusan'], "total" => $item['total']);
                }
            }
        }

        //output: recap
        if (in_array($this->input->post('filter'), [null, '0']) && in_array($this->input->post('filter-nilai'), [null, '0'])) {
            $exam_data = $this->base_model->get_join_item('result', 'users.id, users.username, users.first_name, exam_score.score, exam_score.kategori_soal_id, kategori_soal.category, kategori_soal.subject', NULL, 'exam_score', ['exam', 'users', 'kategori_soal', 'users_resellers'], ['exam.id=exam_score.exam_id', 'exam.user_id=users.id', 'kategori_soal.id=exam_score.kategori_soal_id', 'users.id=users_resellers.user_id'], ['inner', 'inner', 'inner', 'inner'], ['scope' => 3, 'reseller_id' => $this->session->userdata('user_id'), 'exam.tryout_group_id' => $tryout_group_id]);
        } else {
            if ($this->input->post('filter') === '0') {
                $exam_data = $this->base_model->get_join_item('result', 'users.id, users.username, users.first_name, exam_score.score, exam_score.kategori_soal_id, kategori_soal.category, kategori_soal.subject', NULL, 'exam_score', ['exam', 'users', 'kategori_soal', 'users_resellers'], ['exam.id=exam_score.exam_id', 'exam.user_id=users.id', 'kategori_soal.id=exam_score.kategori_soal_id', 'users.id=users_resellers.user_id'], ['inner', 'inner', 'inner', 'inner'], ['scope' => 3, 'reseller_id' => $this->session->userdata('user_id'), 'exam.tryout_group_id' => $tryout_group_id, 'kategori_soal.tipe' => $this->input->post('filter-nilai')]);
            } elseif ($this->input->post('filter-nilai') === '0') {
                $exam_data = $this->base_model->get_join_item('result', 'users.id, users.username, users.first_name, exam_score.score, exam_score.kategori_soal_id, kategori_soal.category, kategori_soal.subject', NULL, 'exam_score', ['exam', 'users', 'kategori_soal', 'users_resellers'], ['exam.id=exam_score.exam_id', 'exam.user_id=users.id', 'kategori_soal.id=exam_score.kategori_soal_id', 'users.id=users_resellers.user_id'], ['inner', 'inner', 'inner', 'inner'], ['scope' => 3, 'reseller_id' => $this->session->userdata('user_id'), 'exam.tryout_group_id' => $tryout_group_id, 'exam.category' => $this->input->post('filter')]);
            } else {
                $exam_data = $this->base_model->get_join_item('result', 'users.id, users.username, users.first_name, exam_score.score, exam_score.kategori_soal_id, kategori_soal.category, kategori_soal.subject', NULL, 'exam_score', ['exam', 'users', 'kategori_soal', 'users_resellers'], ['exam.id=exam_score.exam_id', 'exam.user_id=users.id', 'kategori_soal.id=exam_score.kategori_soal_id', 'users.id=users_resellers.user_id'], ['inner', 'inner', 'inner', 'inner'], ['scope' => 3, 'reseller_id' => $this->session->userdata('user_id'), 'exam.tryout_group_id' => $tryout_group_id, 'exam.category' => $this->input->post('filter'), 'kategori_soal.tipe' => $this->input->post('filter-nilai')]);
            }
        }
        $this->data['exam_data_score'] = [];
        if (!empty($exam_data)) {
            foreach ($exam_data as $v) {
                $this->data['exam_data_score'][$v['id']][1] = '';
                $this->data['exam_data_score'][$v['id']][2] = '';
                $this->data['exam_data_score'][$v['id']][3] = '';
                $this->data['exam_data_score'][$v['id']][4] = '';
                $this->data['exam_data_score'][$v['id']][6] = '';
                $this->data['exam_data_score'][$v['id']][7] = '';
                $this->data['exam_data_score'][$v['id']][8] = '';
                $this->data['exam_data_score'][$v['id']][9] = '';
                $this->data['exam_data_score'][$v['id']][10] = '';
                $this->data['exam_data_score'][$v['id']][11] = '';
                $this->data['exam_data_score'][$v['id']][12] = '';
                $this->data['exam_data_score'][$v['id']][13] = '';
                $this->data['exam_data_score'][$v['id']]['username'] = $v['username'];
                $this->data['exam_data_score'][$v['id']]['first_name'] = $v['first_name'];
                $this->data['exam_data_score'][$v['id']]['category'] = $v['category'];
            }
            foreach ($exam_data as $v) {
                $this->data['exam_data_score'][$v['id']][$v['kategori_soal_id']] = $v['score'];
            }
        }

        $this->data['output'] = ['tryout_group_id' => $this->input->post('tryout_group'), 'filter' => $this->input->post('filter'), 'filter-nilai' => $this->input->post('filter-nilai')];
        $this->schoolview('school/placement/placement', $this->data);
    }

    public function nilai_tryout()
    {
        $exam_data = $this->base_model->get_join_item('result', 'users.id, users.username, users.first_name, users.kelas, exam_score.score, exam_score.kategori_soal_id,exam_score.scope, kategori_soal.category, kategori_soal.subject, tryout_group.name as tryout_group_name', NULL, 'exam_score', ['exam', 'tryout_group', 'users', 'kategori_soal', 'users_resellers'], ['exam.id=exam_score.exam_id', 'exam.tryout_group_id=tryout_group.id', 'exam.user_id=users.id', 'kategori_soal.id=exam_score.kategori_soal_id', 'users.id=users_resellers.user_id'], ['inner', 'inner', 'inner', 'inner', 'inner'], ['scope' => 3, 'reseller_id' => $this->session->userdata('user_id'), 'exam.tryout_group_id' => $this->input->post('tryout_group_id')]);
        $exam_data_sheet = [];
        if (!empty($exam_data)) {
            foreach ($exam_data as $v) {

                switch ($v['scope']) {
                    case 1:
                        $score_scope = 'kabupeten';
                        break;
                    case 2:
                        $score_scope = 'provinsi';
                        break;
                    default:
                        $score_scope = 'nasional';
                        break;
                }

                $exam_data_sheet[$v['id']][$v['scope']][1] = '';
                $exam_data_sheet[$v['id']][$v['scope']][2] = '';
                $exam_data_sheet[$v['id']][$v['scope']][3] = '';
                $exam_data_sheet[$v['id']][$v['scope']][4] = '';
                $exam_data_sheet[$v['id']][$v['scope']][6] = '';
                $exam_data_sheet[$v['id']][$v['scope']][7] = '';
                $exam_data_sheet[$v['id']][$v['scope']][8] = '';
                $exam_data_sheet[$v['id']][$v['scope']][9] = '';
                $exam_data_sheet[$v['id']][$v['scope']][10] = '';
                $exam_data_sheet[$v['id']][$v['scope']][11] = '';
                $exam_data_sheet[$v['id']][$v['scope']][12] = '';
                $exam_data_sheet[$v['id']][$v['scope']][13] = '';
                $exam_data_sheet[$v['id']][$v['scope']]['username'] = $v['username'];
                $exam_data_sheet[$v['id']][$v['scope']]['first_name'] = $v['first_name'];
                // $exam_data_sheet[$v['id']][$v['scope']]['company'] = $v['company'];
                $exam_data_sheet[$v['id']][$v['scope']]['scope'] = $score_scope;
                $exam_data_sheet[$v['id']][$v['scope']]['tryout_group_name'] = $v['tryout_group_name'];
                $exam_data_sheet[$v['id']][$v['scope']]['kelas'] = $v['kelas'];
            }
            foreach ($exam_data as $v) {
                $exam_data_sheet[$v['id']][$v['scope']][$v['kategori_soal_id']] = $v['score'];
            }
        }
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $i = 2;
        $sheet->setCellValue('A1', 'Username/NISN');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Kelas');
        // $sheet->setCellValue('C1', 'Sekolah');
        $sheet->setCellValue('D1', 'PU');
        $sheet->setCellValue('E1', 'PBM');
        $sheet->setCellValue('F1', 'PPU');
        $sheet->setCellValue('G1', 'PK');
        $sheet->setCellValue('H1', 'Matematika');
        $sheet->setCellValue('I1', 'Biologi');
        $sheet->setCellValue('J1', 'Fisika');
        $sheet->setCellValue('K1', 'Kimia');
        $sheet->setCellValue('L1', 'Sejarah');
        $sheet->setCellValue('M1', 'Ekonomi');
        $sheet->setCellValue('N1', 'Geografi');
        $sheet->setCellValue('O1', 'Sosiologi');
        $sheet->setCellValue('P1', 'Sesi Ujian');
        if (!empty($exam_data_sheet)) {
            foreach ($exam_data_sheet as $value) {
                foreach ($value as $v) {
                    $sheet->setCellValue('A' . $i, $v['username']);
                    $sheet->setCellValue('B' . $i, $v['first_name']);
                    $sheet->setCellValue('C' . $i, $v['kelas']);
                    // $sheet->setCellValue('C' . $i, $v['company']);
                    $sheet->setCellValue('D' . $i, $v[4]);
                    $sheet->setCellValue('E' . $i, $v[1]);
                    $sheet->setCellValue('F' . $i, $v[2]);
                    $sheet->setCellValue('G' . $i, $v[3]);
                    $sheet->setCellValue('H' . $i, $v[6]);
                    $sheet->setCellValue('I' . $i, $v[9]);
                    $sheet->setCellValue('J' . $i, $v[7]);
                    $sheet->setCellValue('K' . $i, $v[8]);
                    $sheet->setCellValue('L' . $i, $v[10]);
                    $sheet->setCellValue('M' . $i, $v[13]);
                    $sheet->setCellValue('N' . $i, $v[11]);
                    $sheet->setCellValue('O' . $i, $v[12]);
                    $sheet->setCellValue('P' . $i, $v['tryout_group_name']);
                    $i++;
                }
            }
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode('data.xlsx') . '"');
        $writer->save('php://output');
    }
}
