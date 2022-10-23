<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once 'application/controllers/manage/Base.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends AdminBase
{
    public function __construct()
    {
        parent::__construct();
        $this->data['title'] = "Laporan";
    }

    public function index()
    {
        $this->data['item'] = $this->base_model->get_join_item('result', 'orders.*, users.username, users.first_name', NULL, ['orders'], ['users'], ['orders.user_id = users.id'], ['inner']);
        $this->data['exam'] = $this->base_model->get_join_item('result', 'exam.tryout_group_id, COUNT(tryout_group_id) as total, tryout_group.name as tryout_group_name', NULL, 'exam', ['tryout_group'], ['exam.tryout_group_id=tryout_group.id'], ['inner'], ['tka = 1 OR tps = 1' => NULL], ['tryout_group_id']);
        $this->data['had_exam'] = $this->base_model->get_join_item('result', 'exam.*, users.first_name, users.company', NULL, 'exam', ['users'], ['exam.user_id = users.id'], ['inner']);

        if (!empty($this->data['exam'])) {
            foreach ($this->data['exam'] as $key => $i) {
                $score_null = $this->base_model->get_join_item('row', 'COUNT(DISTINCT(exam.id)) as numrows', NULL, 'exam', ['exam_score'], ['exam.id=exam_score.exam_id'], ['inner'], ['tryout_group_id' => $i['tryout_group_id'], '(tka = 1 OR tps = 1)' => NULL]);
                if ($score_null > 0) {
                    $this->data['exam'][$key]['proses'] = $i['total'] - $score_null['numrows'] . ' nilai tryout belum diproses';
                }
            }
        }

        $this->data['exam_recap'] = $this->base_model->get_join_item('result', 'tryout_group.name, exam.tryout_group_id, exam.created, users.company, COUNT(users.id) as total, MONTH(exam.created) as month', NULL, 'exam', ['users', 'users_resellers', 'tryout_group'], ['exam.user_id = users.id', 'users.id=users_resellers.user_id', 'tryout_group.id=exam.tryout_group_id'], ['inner', 'inner', 'inner'], ['tryout_group_id' => $this->input->post('tryout_group'), 'MONTH(exam.created)' => $this->input->post('month'), '(tka = 1 OR tps = 1)' => NULL], ['reseller_id']);
        $this->data['tryout_group'] = $this->base_model->get_item('result', 'tryout_group', 'id, name');

        $this->data['selected_tryout_group'] = $this->base_model->get_item('row', 'tryout_group', 'id, name', ['id' => $this->input->post('tryout_group')]);
        $this->data['selected_month'] = [
            'name' =>$this->_get_month($this->input->post('month')),
            'number' => $this->input->post('month')
        ];
        // if (!empty($this->data['exam_recap'])) {
        //     $tryout_group = array_intersect_key($this->data['exam_recap'], array_unique(array_column($this->data['exam_recap'], 'tryout_group_id')));
        //     $tryout_month = array_intersect_key($this->data['exam_recap'], array_unique(array_column($this->data['exam_recap'], 'month')));
        // }
        // var_dump($this->data['selected_tryout_group']);die;
        $this->adminview('admin/laporan/laporan', $this->data);
    }

    public function order_update($id = NULL)
    {
        $this->data['post'] = $this->base_model->get_item('row', 'orders', '*', ['id' => $id]);
        if (!$this->data['post']) {
            show_404();
        }
        $this->base_model->update_item('orders', ['status' => 'settlement'], array('id' => $id));
        redirect('manage/laporan');
    }

    public function nilai_tryout($tryout_group_id)
    {
        $exam_data = $this->base_model->get_join_item('result', 'users.id, users.username, users.first_name, users.company, exam_score.score, exam_score.kategori_soal_id, exam_score.scope, tryout_group.name as tryout_group_name', NULL, 'exam_score', ['exam', 'users', 'tryout_group'], ['exam.id=exam_score.exam_id', 'exam.user_id=users.id','exam.tryout_group_id=tryout_group.id'], ['inner', 'inner', 'inner'], ['exam.tryout_group_id' => $tryout_group_id]);
        $exam_data_sheet = [];
        if (!empty($exam_data)) {
            foreach ($exam_data as $v) {

                switch ($v['scope']) {
                    case 1:
                        $score_scope = 'kabupaten';
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
                $exam_data_sheet[$v['id']][$v['scope']]['company'] = $v['company'];
                $exam_data_sheet[$v['id']][$v['scope']]['scope'] = $score_scope;
                $exam_data_sheet[$v['id']][$v['scope']]['tryout_group_name'] = $v['tryout_group_name'];
            }
            foreach ($exam_data as $v) {
                $exam_data_sheet[$v['id']][$v['scope']][$v['kategori_soal_id']] = $v['score'];
            }
            $exam_data = null;
        }
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $i = 2;
        $sheet->setCellValue('A1', 'Username/NISN');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Sekolah');
        $sheet->setCellValue('D1', 'Kemampuan Memahami Bacaan dan Menulis');
        $sheet->setCellValue('E1', 'Pengetahuan dan Pemahaman Umum');
        $sheet->setCellValue('F1', 'Pengetahuan Kuantitatif');
        $sheet->setCellValue('G1', 'Kemampuan Penalaran Umum');
        $sheet->setCellValue('H1', 'Matematika Saintek');
        $sheet->setCellValue('I1', 'Fisika');
        $sheet->setCellValue('J1', 'Kimia');
        $sheet->setCellValue('K1', 'Biologi');
        $sheet->setCellValue('L1', 'Sejarah');
        $sheet->setCellValue('M1', 'Geografi');
        $sheet->setCellValue('N1', 'Sosiologi');
        $sheet->setCellValue('O1', 'Ekonomi');
        $sheet->setCellValue('P1', 'Sesi Ujian');
        $sheet->setCellValue('Q1', 'Nilai Tingkat');
        if (!empty($exam_data_sheet)) {
            foreach ($exam_data_sheet as $value) {
                foreach ($value as $v) {
                    $sheet->setCellValue('A' . $i, $v['username']);
                    $sheet->setCellValue('B' . $i, $v['first_name']);
                    $sheet->setCellValue('C' . $i, $v['company']);
                    $sheet->setCellValue('D' . $i, $v[1]);
                    $sheet->setCellValue('E' . $i, $v[2]);
                    $sheet->setCellValue('F' . $i, $v[3]);
                    $sheet->setCellValue('G' . $i, $v[4]);
                    $sheet->setCellValue('H' . $i, $v[6]);
                    $sheet->setCellValue('I' . $i, $v[7]);
                    $sheet->setCellValue('J' . $i, $v[8]);
                    $sheet->setCellValue('K' . $i, $v[9]);
                    $sheet->setCellValue('L' . $i, $v[10]);
                    $sheet->setCellValue('M' . $i, $v[11]);
                    $sheet->setCellValue('N' . $i, $v[12]);
                    $sheet->setCellValue('O' . $i, $v[13]);
                    $sheet->setCellValue('P' . $i, $v['tryout_group_name']);
                    $sheet->setCellValue('Q' . $i, $v['scope']);
                    $i++;
                }
            }
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode('data.xlsx') . '"');
        $writer->save('php://output');
    }

    public function had_tryout($tryout_group = NULL, $month = NULL)
    {
        if($tryout_group == NULL && $month == NULL){
            $exam_data = $this->base_model->get_join_item('result', 'exam.*, users.username, users.first_name, users.company, tryout_group.name as tryout_group_name', NULL, 'exam', ['users', 'tryout_group'], ['exam.user_id = users.id', 'exam.tryout_group_id = tryout_group.id'], ['inner', 'inner'], ['exam.tka = 1 OR exam.tps = 1' => NULL]);
        } else {
            $exam_data = $this->base_model->get_join_item('result', 'exam.*, users.username, users.first_name, users.company, tryout_group.name as tryout_group_name', NULL, 'exam', ['users', 'tryout_group'], ['exam.user_id = users.id', 'exam.tryout_group_id = tryout_group.id'], ['inner', 'inner'], ['exam.tryout_group_id' => $tryout_group, 'MONTH(exam.created)' => $month, '(exam.tka = 1 OR exam.tps = 1)' => NULL]);
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $i = 2;
        $sheet->setCellValue('A1', 'Username');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Sekolah');
        // $sheet->setCellValue('D1', 'Sudah Mengikuti');
        $sheet->setCellValue('D1', 'Sesi Ujian');
        $sheet->setCellValue('E1', 'Ujian di Bulan');
        // $sheet->setCellValue('F1', 'Keterangan');
        if (!empty($exam_data)) {
            foreach ($exam_data as $v) {
                $tryout = '';
                $doing_tryout = '';
                if ($v['tka'] == 1 && $v['tps'] == 1) {
                    $tryout = 'TKA, TPS';
                } else if ($v['tka'] == 1 && $v['tps'] == 0) {
                    $tryout = 'TKA';
                } else if ($v['tka'] == 0 && $v['tps'] == 1) {
                    $tryout = 'TPS';
                }

                if ($v['status'] == 1) {
                    $doing_tryout = 'Sedang Ujian TKA Saintek';
                } else if ($v['status'] == 2) {
                    $doing_tryout = 'Sedang Ujian TKA Soshum';
                } else if ($v['status'] == 3) {
                    $doing_tryout = 'Sedang Ujian TKA Campuran';
                } else if ($v['status'] == 4) {
                    $doing_tryout = 'Sedang Ujian TPS';
                } else {
                    $doing_tryout = 'Tidak Sedang Ujian';
                }

                $sheet->setCellValue('A' . $i, $v['username']);
                $sheet->setCellValue('B' . $i, $v['first_name']);
                $sheet->setCellValue('C' . $i, $v['company']);
                // $sheet->setCellValue('D' . $i, $tryout);
                $sheet->setCellValue('D' . $i, $v['tryout_group_name']);
                $sheet->setCellValue('E' . $i, $this->_get_month(date('n', strtotime($v['created']))));
                // $sheet->setCellValue('F' . $i, $doing_tryout);
                $i++;
            }
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode('data.xlsx') . '"');
        $writer->save('php://output');
    }

    public function define_exam_score($tryout_group_id)
    {
        if (!$this->base_model->get_item('result', 'exam', '*', ['tryout_group_id' => $tryout_group_id])) {
            show_404();
        }
        $start_time = microtime(true);
        ini_set("memory_limit", "-1");
        set_time_limit(0);

        $this->load->model('base_model');
        $exam_data = [];
        $exam = [];
        //$mapel = $this->base_model->get_item('result', 'kategori_soal', '*');
        //fetch data to start scoring
        //score nasional scope = 3
        $exam = $this->base_model->get_join_item('result', 'user_exam.soal_id, user_exam.score, user_exam.exam_id, user_exam.kategori_soal_id, exam.user_id', NULL, 'user_exam', ['exam'], ['exam.id = user_exam.exam_id'], ['inner'], ['tryout_group_id' => $tryout_group_id, '(tka = 1 OR tps = 1)' => NULL]);
        $this->_set_exam_data($exam, 3);

        //score kabupaten scope = 1
        $get_kab = $this->base_model->get_join_item('result', 'kabupaten, COUNT(*) as total', NULL, 'user_exam', ['exam', 'users'], ['exam.id = user_exam.exam_id', 'exam.user_id = users.id'], ['inner', 'inner'], ['tryout_group_id' => $tryout_group_id, 'kabupaten IS NOT NULL' => NULL, '(tka = 1 OR tps = 1)' => NULL], ['kabupaten']);
        if (!empty($get_kab)) {
            foreach ($get_kab as $kab) {
                $exam = $this->base_model->get_join_item('result', 'user_exam.soal_id, user_exam.score, user_exam.exam_id, user_exam.kategori_soal_id, exam.user_id', NULL, 'user_exam', ['exam', 'users'], ['exam.id = user_exam.exam_id', 'exam.user_id = users.id'], ['inner', 'inner'], ['tryout_group_id' => $tryout_group_id, 'kabupaten' => $kab['kabupaten'], '(tka = 1 OR tps = 1)' => NULL]);
                $this->_set_exam_data($exam, 1);
            }
        }

        //score provinsi scope = 2
        $get_prov = $this->base_model->get_join_item('result', 'provinsi, COUNT(*) as total', NULL, 'user_exam', ['exam', 'users'], ['exam.id = user_exam.exam_id', 'exam.user_id = users.id'], ['inner', 'inner'], ['tryout_group_id' => $tryout_group_id, 'provinsi IS NOT NULL' => NULL, '(tka = 1 OR tps = 1)' => NULL], ['provinsi']);
        if (!empty($get_prov)) {
            foreach ($get_prov as $prov) {
                $exam = $this->base_model->get_join_item('result', 'user_exam.soal_id, user_exam.score, user_exam.exam_id, user_exam.kategori_soal_id, exam.user_id', NULL, 'user_exam', ['exam', 'users'], ['exam.id = user_exam.exam_id', 'exam.user_id = users.id'], ['inner', 'inner'], ['tryout_group_id' => $tryout_group_id, 'provinsi' => $prov['provinsi'], '(tka = 1 OR tps = 1)' => NULL]);
                $this->_set_exam_data($exam, 2);
            }
        }
        $execution_time = (microtime(true) - $start_time);
        redirect('manage/laporan');
    }

    public function _set_exam_data($exam, $scope)
    {
        if (!empty($exam)) {
            $v = 0;
            foreach ($exam as $i) {
                $exam_data[$i['kategori_soal_id']]['score_data'][] = [
                    'soal' => $i['soal_id'],
                    'user' => $i['user_id'],
                    'score' => $i['score'],
                    'exam_id' => $i['exam_id']
                ];
                $v++;
            }

            $x = 0;
            foreach ($exam_data as $key => $i) {
                if (empty($i['score_data'])) {
                    continue;
                }
                $this->_define_score($i['score_data'], $key, $scope);
                $x++;
            }

            $this->session->set_flashdata('message_sa', 'Nilai Tryout berhasil diproses.');
        }
    }

    public function _define_score($exam_data, $kategori, $scope)
    {
        // if (empty($exam_data)) {
        //     show_404();
        // }
        $nilai = [];
        $users_score = [];
        $nilai_mentah = [];
        //arrange score/soal
        foreach ($exam_data as $i) {
            $nilai[$i['soal']]['users'][$i['user']] = $i['score'];
            $nilai[$i['soal']]['exam'][$i['user']] = $i['exam_id'];
        }

        //process start
        foreach ($nilai as $key => $i) {
            $true_on_answer = 0; //sum answer
            $users = 0; //count users

            foreach ($i['users'] as $ukey => $v) {
                //sum on true answer based on soal
                $nilai[$key]['true_answer'] = $true_on_answer += $v;
                $users++;

                //sum answer based on users (ukey is user_id)
                $users_score[$ukey]['answer'] = !isset($users_score[$ukey]['answer']) ? ((!is_null($v)) ? 1 : 0) : (($v >= 0 && !is_null($v)) ? $users_score[$ukey]['answer'] += 1 : $users_score[$ukey]['answer'] += 0);
                $users_score[$ukey]['user_answer_true'] = !isset($users_score[$ukey]['user_answer_true']) ? ((!is_null($v) && $v == 1) ? 1 : 0) : ((!is_null($v) && $v == 1) ? $users_score[$ukey]['user_answer_true'] += 1 : $users_score[$ukey]['user_answer_true'] += 0);
            }
            //get percentage of true answer
            $nilai[$key]['true_percentage'] = $nilai[$key]['true_answer'] / $users * 100;
            $nilai[$key]['score_level'] = $this->_define_bobot($nilai[$key]['true_percentage']);
        }

        //nilai mentah based on users
        $populate_score = 0;
        foreach ($nilai as $key => $i) {
            foreach ($i['users'] as $ukey => $v) {
                $nilai_mentah[$ukey]['soal'][$key] = $users_score[$ukey]['answer'] > 0 ? $users_score[$ukey]['user_answer_true'] / $users_score[$ukey]['answer'] * $nilai[$key]['users'][$ukey] * $nilai[$key]['score_level'] : 0;
                $nilai_mentah[$ukey]['nilai_mentah'] = !isset($nilai_mentah[$ukey]['nilai_mentah']) ? (($nilai_mentah[$ukey]['soal'][$key] > 0) ? $nilai_mentah[$ukey]['soal'][$key] : 0) : $nilai_mentah[$ukey]['nilai_mentah'] + $nilai_mentah[$ukey]['soal'][$key];
                $nilai_mentah[$ukey]['exam_id'] = $nilai[$key]['exam'][$ukey];
                $populate_score += $nilai_mentah[$ukey]['soal'][$key];
            }
        }
        //population average
        $populate_avg = $populate_score / count($nilai_mentah);
        //get standar deviation
        $sample_std = [];
        foreach ($nilai_mentah as $i) {
            array_push($sample_std, $i['nilai_mentah']);
        }
        $std = $this->_calculateStdDev($sample_std);

        //last process calculate nilai
        foreach ($nilai_mentah as $key => $i) {
            if ($std == 0) continue;
            $nilai_mentah[$key]['final_score'] = round(500 + ((($i['nilai_mentah'] - $populate_avg) / $std) * 100), 2);
            if ($this->base_model->get_item('row', 'exam_score', '*', ['kategori_soal_id' => $kategori, 'exam_id' => $i['exam_id'], 'scope' => $scope])) {
                $this->base_model->update_item('exam_score', ['score' => $nilai_mentah[$key]['final_score']], ['exam_id' => $i['exam_id'], 'kategori_soal_id' => $kategori, 'scope' => $scope]);
            } else {
                $params = [
                    'kategori_soal_id' => $kategori,
                    'score' => $nilai_mentah[$key]['final_score'],
                    'created' => date('Y-m-d H:i:s'),
                    'exam_id' => $i['exam_id'],
                    'scope' => $scope
                ];
                $this->base_model->insert_item('exam_score', $params);
            }
        }

        return ['nilai' => $nilai, 'users_score' => $users_score, 'nilai_mentah' => $nilai_mentah];
    }

    public function _calculateStdDev(array $array): float
    {
        $size = count($array);
        if ($size < 2) return 0;
        $mean = array_sum($array) / $size;
        $squares = array_map(function ($x) use ($mean) {
            return pow($x - $mean, 2);
        }, $array);

        return sqrt(array_sum($squares) / ($size - 1));
    }

    public function _define_bobot($v)
    {
        switch ($v) {
            case $v <= 30:
                return 4;
            case $v <= 70:
                return 3;
            default:
                return 2;
        }
    }

    public function reset_utbk()
    {
        if ($this->base_model->count_result_item('exam') > 0) {
            $this->base_model->empty_table('exam');
            if ($this->base_model->insert_item('log_reset', ['msg' => 'Reset telah berhasil di proses'])) {
                $this->session->set_flashdata('message_sa', 'Proses reset sukses. Semua data tryout berhasil di reset. Data tryout telah kosong.');
            }
        }
        redirect('manage/laporan');
    }

    public function _get_month($month)
    {
        switch ($month) {
            case 1:
                return 'Januari';
            case 2:
                return 'Februari';
            case 3:
                return 'Maret';
            case 4:
                return 'April';
            case 5:
                return 'Mei';
            case 6:
                return 'Juni';
            case 7:
                return 'Juli';
            case 8:
                return 'Agustus';
            case 9:
                return 'September';
            case 10:
                return 'Oktober';
            case 11:
                return 'November';
            case 12:
                return 'Desember';
            default:
                return '';
        }
    }
}
