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
        .' nisn_ketua, nisn_anggota, wa_ketua, wa_anggota, sekolah, kota, provinsi, nomor_peserta, role_id')->find($id);
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
        $role = $model->builder('user_roles')->select()->get()->getResultArray();


        $data = $model->select('id, nama_ketua, nama_anggota, email_ketua, email_anggota,'
            . ' nisn_ketua, nisn_anggota, wa_ketua, wa_anggota, sekolah, kota, provinsi,'
            . ' bukti_nisn_ketua, bukti_nisn_anggota, bukti_bayar,')
            ->findAll();


        $header = [
            'No', 'Nama Ketua', 'Nama Anggota', 'Email Ketua', 'Email Anggota', 'NISN Ketua', 'NISN Anggota', 'WA Ketua', 'WA Anggota', 'Sekolah', 'Kota', 'Provinsi', 'Bukti NISN Ketua', 'Bukti NISN Anggota', 'Bukti Bayar',
        ];

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setTitle('Rekap Peserta OMITS15th');

        $sheetIndex = 0;

        $sheet = $spreadsheet->setActiveSheetIndex($sheetIndex);
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

        $spreadsheet->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Rekap Peserta OMITS15th.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');

        exit;
    }
}
