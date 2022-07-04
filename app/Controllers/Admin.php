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
        $data = $model->select('id, name, email, sekolah, nisn, wa, kota, provinsi, role_id')->find($id);
    }

    public function saveProfil()
    {
        $model = new User();
        $model->save($this->request->getPost());
        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    public function exportToExcel()
    {
        $model = new User();
        $role = $model->builder('user_roles')->select()->get()->getResultArray();

        foreach ($role as $value) {
            $data[$value['name']] = $model->select('id, name, email, sekolah, nisn, wa, kota, provinsi, image, bukti_nisn, bukti_bayar')
                ->where('role_id', $value['id'])->find();

        }
        $header = [
            'No', 'Nama', 'Email', 'Sekolah', 'Nisn', 'No. Wa', 'Kota', 'Provinsi', 'Image', 'Bukti NISN', 'Bukti Bayar'
        ];
        
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setTitle('Rekap Peserta OMITS15th');

        $sheetIndex = 0;
        foreach ($data as $key => $value) {
            $sheet = $spreadsheet->setActiveSheetIndex($sheetIndex);
            $spreadsheet->getActiveSheet($sheetIndex)->setTitle($key);
            foreach ($header as $key => $hd) {
                $sheet->setCellValue([$key+1, 1], $hd);
            }

            $rowIndex = 2;
            foreach ($value as $rowData) {
                $colomnIndex = 1;
                foreach ($rowData as $cellData) {
                    if ($colomnIndex==1) {
                        $sheet->setCellValue([$colomnIndex, $rowIndex], $rowIndex-1);
                    } else {
                        $sheet->setCellValue([$colomnIndex, $rowIndex], $cellData);
                    }
                    $colomnIndex++;
                }
                $rowIndex++;
            }
            
            $spreadsheet->createSheet();
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
