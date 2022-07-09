<?php

namespace App\Controllers;

use App\Models\User;
use CodeIgniter\View\Table;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        // $model = new User();
        // $id = session()->get('id');
        // $profilData = $model->select('name, email, sekolah, nisn, wa, kota, provinsi, image, role_id')->find($id);
        
        return view('dashboard/peserta', [
            'title'	=>	'Dashboard'
        ]);
    }

    public function admin()
    {
        // $session = session();
        // $model = new User();
        // $user = $model->select('id, name')->find($session->get('id'));
        // dd(route_to('auth/logout'));

        return view('dashboard/admin', ['title' => 'Dashboard ']);
    }

    public function listUser()
    {
        $model = new User();
        $query = $model->select('users.id, nama_ketua, nama_anggota, email_ketua, email_anggota,'
            .' nisn_ketua, nisn_anggota, wa_ketua, wa_anggota, sekolah, kota, provinsi,'
            .' bukti_nisn_ketua, bukti_nisn_anggota, bukti_bayar, user_roles.name as role')
            ->join('user_roles', 'users.role_id = user_roles.id');
        $kategori = $this->request->getGet('kategori');
        $search = $this->request->getGet('search');

        if ($search) {
            $query = $query->where("(nama_ketua LIKE '%".$search."%' nama_anggota LIKE '%".$search."%' OR email LIKE '%".$search."%')");
        }
        if ($kategori) {
            $query = $query->where('role_id', $kategori);
        }
        $userData = $query->paginate(25);

        array_walk($userData, function (&$item)
        {
            $item['bukti_nisn_ketua'] = "<a role='button' class='btn btn-primary". ($item['bukti_nisn_ketua']?"'":"disabled' aria-disabled='true'")."' href='".($item['bukti_nisn_ketua']??"#'")."'>Buka</a>";
            $item['bukti_nisn_anggota'] = "<a role='button' class='btn btn-primary". ($item['bukti_nisn_anggota']?"'":"disabled' aria-disabled='true'")."' href='".($item['bukti_nisn_anggota']??"#'")."'>Buka</a>";
            $item['bukti_bayar'] = "<a role='button' class='btn btn-primary". ($item['bukti_bayar']?"'":"disabled' aria-disabled='true'")."' href='".($item['bukti_bayar']??"#'")."'>Buka</a>";
            $item['action'] = "<a role='button' class='btn btn-primary btn-sm mr-2 mb-2' href='" . route_to('Admin::editProfil', $item['id']) . "'>Edit</a>"
                ."<a role='button' class='btn btn-danger btn-sm' href='" . route_to('Admin::deleteUser', $item['id']) . "'>Delete</a>";
        });

        $template = [
            'table_open'	=>	'<table class="table table-hover table-striped table-responsive">'
        ];
        $table = new Table($template);
        $table->setHeading('Id', 'Nama Ketua', 'Nama Anggota', 'Email Ketua', 'Email Anggota', 'NISN Ketua', 'NISN Anggota', 'WA Ketua', 'WA Anggota', 'Sekolah', 'Kota', 'Provinsi', 'Bukti NISN Ketua', 'Bukti NISN Anggota', 'Bukti Bayar', 'Status', 'Action');

        $roles = $model->builder('user_roles')->select()->get()->getResultArray();
        
        $data = [
            'title' =>  'List User',
            'table' =>  $table->generate($userData),
            'pager' =>  $model->pager,
            'roles'	=>	$roles,
            'req'   =>  $this->request,
        ];

        return view('dashboard/list_user', $data);
    }

    public function editProfil()
    {
        $model = new User();
        $id = session()->get('id');
        $profilData = $model->select('nama_ketua, nama_anggota, email_ketua, email_anggota,'
        .' nisn_ketua, nisn_anggota, wa_ketua, wa_anggota, sekolah, kota, provinsi, role_id')->find($id);
        $roles = $model->builder('user_roles')->select()->where('id !=', 1)->get()->getResultArray();

        return view('dashboard/edit_peserta',[
            'title' =>  'Edit Profil',
            'user'	=>	$profilData,
            'roles' =>  $roles,
        ]);
    }

    public function changePassword()
    {
        return view('dashboard/ubah_password',[
            'title'	=>	'Ubah Password'
        ]);
    }

    public function pembayaran()
    {
        return view('dashboard/petunjuk_bayar', [
            'title'	=>	'Petunjuk Pembayaran'
        ]);
    }

    public function buktiBayar()
    {
        return view('dashboard/bukti_pembayaran', [
            'title'	=>	'Upload Bukti Bayar'
        ]);
    }
}
