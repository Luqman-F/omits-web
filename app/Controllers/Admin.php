<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Admin extends BaseController
{
    public function editProfil($id)
    {
        $model = new User();
        $data = $model->select('id, nama_ketua, nama_anggota, email_ketua, email_anggota,'
            . ' nisn_ketua, nisn_anggota, wa_ketua, wa_anggota, sekolah, kota, provinsi, nomor_peserta, role_id')->find($id);
        $roles = $model->builder('user_roles')->select()->get()->getResultArray();
        return view('dashboard/edit_admin', [
            'title' =>  'Edit Profil',
            'user'    =>    $data,
            'roles'    =>    $roles,
        ]);
    }

    public function saveProfil()
    {
        $model = new User();
        $data = $this->request->getPost();
        $data['role_id'] = (int) $data['role_id'];
        $model->save($data);
        return redirect()->back()->with('success', 'Data berhasil diubah');
    }
    public function deleteUser($id)
    {
        $model = new User();
        $model->delete($id);
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function exportToExcel()
    {
        $model = new User();
        $role = $model->builder('user_roles')->select()->where('id !=', '1')->get()->getResultArray();

        $data = $model->select('users.id, nama_ketua, nama_anggota, email_ketua, email_anggota,'
            . ' nisn_ketua, nisn_anggota, wa_ketua, wa_anggota, sekolah, kota, provinsi,'
            . ' bukti_nisn_ketua, bukti_nisn_anggota, bukti_bayar, user_roles.name as status')
            ->join('user_roles', 'users.role_id = user_roles.id')
            ->where('role_id !=', 1)
            ->findAll();



        $header = [
            'No', 'Nama Ketua', 'Nama Anggota', 'Email Ketua', 'Email Anggota', 'NISN Ketua', 'NISN Anggota', 'WA Ketua', 'WA Anggota', 'Sekolah', 'Kota', 'Provinsi', 'Bukti NISN Ketua', 'Bukti NISN Anggota', 'Bukti Bayar', 'Status',
        ];

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setTitle('Rekap Peserta OMITS15th');

        $sheetIndex = 0;
        // MASTER
        $sheet = $spreadsheet->setActiveSheetIndex($sheetIndex);
        $sheet->setTitle('MASTER');
        foreach ($header as $key => $hd) {
            $sheet->setCellValue([$key + 1, 1], $hd);
        }

        $rowIndex = 2;
        foreach ($data as $rowData) {
            $colomnIndex = 1;
            foreach ($rowData as $cellData) {
                if ($colomnIndex == 1) {
                    $sheet->setCellValue([$colomnIndex, $rowIndex], $rowIndex - 1);
                } else {
                    $sheet->setCellValue([$colomnIndex, $rowIndex], $cellData);
                }
                $colomnIndex++;
            }
            $rowIndex++;
        }
        foreach ($sheet->getColumnIterator() as $column ) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }
        // END MASTER

        foreach ($role as $value) {
            $dataPerRole[$value['name']] = $model->select('users.id, nama_ketua, nama_anggota, email_ketua, email_anggota,'
                . ' nisn_ketua, nisn_anggota, wa_ketua, wa_anggota, sekolah, kota, provinsi,'
                . ' bukti_nisn_ketua, bukti_nisn_anggota, bukti_bayar, user_roles.name as status')
                ->join('user_roles', 'users.role_id = user_roles.id')
                ->where('role_id', $value['id'])->find();
        }

        $sheetIndex++;
        foreach ($dataPerRole as $key => $value) {
            $sheet = $spreadsheet->createSheet();
            if ($key == '-') $key = 'Belum Terverifikasi';
            $sheet->setTitle($key);
            foreach ($header as $key => $hd) {
                $sheet->setCellValue([$key + 1, 1], $hd);
            }

            $rowIndex = 2;
            foreach ($value as $rowData) {
                $colomnIndex = 1;
                foreach ($rowData as $cellData) {
                    if ($colomnIndex == 1) {
                        $sheet->setCellValue([$colomnIndex, $rowIndex], $rowIndex - 1);
                    } else {
                        $sheet->setCellValue([$colomnIndex, $rowIndex], $cellData);
                    }
                    $colomnIndex++;
                }
                $rowIndex++;
            }
            foreach ($sheet->getColumnIterator() as $column ) {
                $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
            }    
            $sheetIndex++;
        }


        $spreadsheet->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Rekap Peserta OMITS15th.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');

        exit;
    }
}
