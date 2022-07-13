<?php

namespace App\Controllers;

use App\Models\User;
use CodeIgniter\View\Table;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $model = new User();
        $id = session()->get('id');
        $profilData = $model->select('nomor_peserta, nama_ketua, nama_anggota, email_ketua, email_anggota,'
            . 'nisn_ketua, nisn_anggota, wa_ketua, wa_anggota, sekolah, kota, provinsi,'
            . 'user_roles.name as status')
            ->join('user_roles', 'users.role_id = user_roles.id')
            ->find($id);

        $header = [
            'No. Peserta', 'Nama Ketua', 'Nama Anggota', 'Email Ketua', 'Email Anggota', 'NISN/NIM Ketua', 'NISN/NIM Anggota',
            'WA Ketua', 'WA Anggota', 'Sekolah', 'Kota', 'Provinsi', 'Status',
        ];

        $tableData = array_map(function ($data, $head) {
            return [$head, ': ' . ($data ? $data : '-')];
        }, $profilData, $header);

        $template = [
            'table_open'    =>  '<table class="table table-borderless table-sm">',
        ];
        $table = new Table($template);

        return view('dashboard/peserta', [
            'title'    =>    'Dashboard',
            'table' =>  $table->generate($tableData),
        ]);
    }

    public function admin()
    {
        $model = new User();
        $roles = $model->select('user_roles.name as role, COUNT(users.id) as jumlah')
            ->join('user_roles', 'users.role_id = user_roles.id')
            ->where('role_id != 1')
            ->groupBy('role_id')
            ->findAll();
        $peserta = $model->select("COUNT(id) as jumlah, DATE_FORMAT(created_at, '%e-%b') as tanggal")
            ->where('role_id !=', 1)
            ->groupBy("DATE_FORMAT(created_at, '%e %b')")
            ->findAll();

        array_walk($peserta, function (&$data) {
            $data = ['x' => $data['tanggal'], 'y' => $data['jumlah']];
        });

        return view('dashboard/admin', [
            'title' => 'Dashboard ',
            'roles' => $roles,
            'peserta'   => json_encode($peserta),
        ]);
    }

    public function listUser()
    {
        $model = new User();
        $query = $model->select('users.id, nama_ketua, nama_anggota, email_ketua, email_anggota,'
            . 'nomor_peserta, nisn_ketua, nisn_anggota, wa_ketua, wa_anggota, sekolah, kota, provinsi,'
            . ' bukti_nisn_ketua, bukti_nisn_anggota, bukti_bayar, user_roles.name as role')
            ->join('user_roles', 'users.role_id = user_roles.id');
        $kategori = $this->request->getGet('kategori');
        $search = $this->request->getGet('search');

        if ($search) {
            $query = $query->where("(nama_ketua LIKE '%" . $search . "%' OR nama_anggota LIKE '%" . $search . "%' OR email_ketua LIKE '%" . $search . "%' OR email_ketua LIKE '%" . $search . "%')");
        }
        if ($kategori) {
            $query = $query->where('role_id', $kategori);
        }
        $userData = $query->paginate(25);

        array_walk($userData, function (&$item) {
            $item['bukti_nisn_ketua'] = "<a role='button' class='btn btn-primary" . ($item['bukti_nisn_ketua'] ? "' target='_blank" : "disabled' aria-disabled='true'") . "' href='" . ($item['bukti_nisn_ketua'] ?? "#'") . "'>Buka</a>";
            $item['bukti_nisn_anggota'] = "<a role='button' class='btn btn-primary" . ($item['bukti_nisn_anggota'] ? "' target='_blank" : "disabled' aria-disabled='true'") . "' href='" . ($item['bukti_nisn_anggota'] ?? "#'") . "'>Buka</a>";
            $item['bukti_bayar'] = "<a role='button' class='btn btn-primary" . ($item['bukti_bayar'] ? "' target='_blank" : "disabled' aria-disabled='true'") . "' href='" . ($item['bukti_bayar'] ?? "#'") . "'>Buka</a>";
            $item['action'] = "<a role='button' class='btn btn-primary btn-sm mr-2 mb-2' href='" . url_to('Admin::editProfil', $item['id']) . "'>Edit</a>"
                . "<a role='button' class='btn btn-danger btn-sm' href='" . url_to('Admin::deleteUser', $item['id']) . "'>Delete</a>";
        });

        $template = [
            'table_open'    =>    '<table class="table table-hover table-striped table-responsive table-sm">',
            'cell_start'    =>  '<td class="pt-2">'
        ];
        $table = new Table($template);
        $table->setHeading('Id', 'Nama Ketua', 'Nama Anggota', 'Email Ketua', 'Email Anggota', 'No. Peserta', 'NISN Ketua', 'NISN Anggota', 'WA Ketua', 'WA Anggota', 'Sekolah', 'Kota', 'Provinsi', 'Bukti NISN Ketua', 'Bukti NISN Anggota', 'Bukti Bayar', 'Status', 'Action');

        $roles = $model->builder('user_roles')->select()->get()->getResultArray();

        $data = [
            'title' =>  'List User',
            'table' =>  $table->generate($userData),
            'pager' =>  $model->pager,
            'roles'    =>    $roles,
            'req'   =>  $this->request,
        ];

        return view('dashboard/list_user', $data);
    }

    public function editProfil()
    {
        $model = new User();
        $id = session()->get('id');
        $profilData = $model->select('nama_ketua, nama_anggota, email_ketua, email_anggota,'
            . ' nisn_ketua, nisn_anggota, wa_ketua, wa_anggota, sekolah, kota, provinsi, role_id')->find($id);
        $roles = $model->builder('user_roles')->select()->where('id !=', 1)->get()->getResultArray();

        return view('dashboard/edit_peserta', [
            'title' =>  'Edit Profil',
            'user'    =>    $profilData,
            'roles' =>  $roles,
        ]);
    }

    public function changePassword()
    {
        return view('dashboard/ubah_password', [
            'title'    =>    'Ubah Password'
        ]);
    }

    public function pembayaran()
    {
        return view('dashboard/petunjuk_bayar', [
            'title'    =>    'Petunjuk Pembayaran'
        ]);
    }

    public function buktiBayar()
    {
        return view('dashboard/bukti_pembayaran', [
            'title'    =>    'Upload Bukti Bayar'
        ]);
    }
}
