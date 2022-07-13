<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class Auth extends BaseController
{



    public function login()
    {
        $model = new User();
        if ($this->validate('login')) {
            $user = $model->getByEmail($this->request->getPost('email'));
            if (!$user) {
                return redirect()->back()->with('msg', 'email not found');
            }
            if (password_verify($this->request->getPost('password'), $user['password'])) {
                session()->set([
                    'id'    =>  $user['id'],
                    'nama_ketua'  =>  $user['nama_ketua'],
                    'role_id'   => $user['role_id'],
                ]);
                return redirect('dashboard');
            } else {
                return redirect()->back()->with('msg', 'Email dan password tidak sesuai');
            }
        } else {
            return redirect()->back()->with('msg', 'Email atau Password tidak sesuai');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function register()
    {
        $model = new User();

        if ($this->validate('registration')) {
            if ($model->getByEmail($this->request->getPost('email_ketua'))) {
                return redirect()->back()->with('msg', 'E-mail sudah terdaftar');
            }
            $data = $this->request->getPost();
            $data['role_id'] = 2;
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $model->save($data);
            return redirect('login')->with('success', 'Registrasi berhasil. Silakan login');
        } else {
            return redirect()->back()->with('msg', $this->validator->listErrors());
        }
    }

    public function forgotPassword()
    {
        $model = new User();

        if ($this->validate([
            'email_ketua'    =>    'required|valid_email',
            'wa_ketua'    =>    'required'
        ], [
            'email_ketua'    =>    [
                'required'    =>    'Email tidak boleh kosong',
                'valid_email'   =>  'Mohon cek kembali penulisan email anda'
            ],
            'wa_ketua'    =>    [
                'required'  =>  'Nomor WA tidak boleh kosong'
            ]
        ])) {
            $data = $model->select('id, email_ketua, wa_ketua')->where('email_ketua', $this->request->getPost('email_ketua'))->first();

            if (!$data) {
                return redirect()->back()->with('msg', 'Email tidak ditemukan, mohon cek kembali email anda!');
            }

            if ( !$data['wa_ketua'] == $this->request->getPost('wa_ketua') ) {
                return redirect()->back()->with('msg', 'Email dan Nomor WA tidak sesuai');
            } else {
                session()->set('reset_id', $data['id']);
                return redirect()->to('resetpassword');
            }
        } else {
            return redirect()->back()->with('msg', $this->validator->listErrors());
        }
    }

    public function resetPassword()
    {
        $model = new User();
        $data = $this->request->getPost();

        if (!$data['id'] == session()->get('reset_id')) {
            return redirect()->back();
        }

        if ($this->validate('reset_pass')) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            if ($model->save($data)) {
                session()->remove('reset_id');
                session()->set($model->select('id, nama_ketua, role_id')->find($data['id']));
                return redirect('dashboard');
            } else {
                return redirect()->back()->with('msg', 'Reset password gagal. Mohon hubungi panitia untuk tindakan lebih lanjut');
            }
        } else {
            return redirect()->back()->with('msg', $this->validator->listErrors());
        }
        
    }
}
