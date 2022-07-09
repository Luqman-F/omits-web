<?php

namespace App\Controllers;

use Google\Client;
use Google\Service\Drive;
use App\Controllers\BaseController;
use App\Models\User;
use Google\Service\Drive\DriveFile;
use Google\Service\Drive\Permission;
use CodeIgniter\HTTP\Files\UploadedFile;

class Peserta extends BaseController
{
    public function editProfil()
    {
        $model = new User();
        $data = $this->request->getPost();
        $nisn_ketua = $this->request->getFile('bukti_nisn_ketua');
        $nisn_anggota = $this->request->getFile('bukti_nisn_anggota');

        if (!$this->validate('profil')) {
            return redirect()->back()->with('msg', $this->validator->listErrors());
        }

        if (! ($nisn_ketua->isValid() && $nisn_anggota->isValid())) {
            return redirect()->back()->with('msg', $nisn_ketua->getErrorString(). '<br>'. $nisn_anggota->getErrorString());
        }
        
        $id_nisn_ketua = $this->upload($nisn_ketua);
        $id_nisn_anggota = $this->upload($nisn_anggota);

        if (! ($id_nisn_ketua && $id_nisn_anggota)) {
            return redirect()->back()->with('msg', 'Terjadi error saat upload file, silakan coba lagi');
        }
        $data['id'] = session('id');
        $data['bukti_nisn_ketua'] = $id_nisn_ketua;
        $data['bukti_nisn_anggota'] = $id_nisn_anggota;
        $model->save($data);

        return redirect()->back()->with('success', 'Profil berhasil disimpan');
    }

    public function uploadPembayaran()
    {
        $model = new User();

        if ($this->validate([
            'bukti_bayar'	=>	'uploaded[bukti_bayar]|max_size[bukti_bayar,2048]|is_image[bukti_bayar]'
        ], [
            'bukti_bayar'	=>	[
                'uploaded'	=>  'Terjadi kesalahan saat upload, silakah coba lagi',
                'max_size'	=>	'File tidak boleh lebih dari 2 MB',
                'is_image'	=>	'File yang diupload bukan gambar',
            ]
        ])) {
            $file = $this->request->getFile('bukti_bayar');
            $img_id = $this->upload($file);

            $model->save([
                'id'	=>	session()->get('id'),
                'bukti_bayar'	=>	$img_id,
            ]);

            return redirect()->back()->with('success', 'Bukti pembayaran berhasil disimpan');
        } else {
            return redirect()->back()->with('msg', $this->validator->listErrors());
        }
    }

    public function upload(UploadedFile $file)
    {
        $mime = $file->getMimeType();
        $file_path = $file->store();
        $content = file_get_contents( WRITEPATH . 'uploads/' . $file_path);

        $meta_data = new DriveFile([
            'name'	=>	$file_path,
        ]) ;
        
        $client = new Client();
        $client->setAuthConfig(APPPATH . 'cred.json');
        $client->addScope(Drive::DRIVE);

        $service = new Drive($client);
        $uploaded = $service->files->create($meta_data, [
            'data'	=>	$content,
            'mimeType'  =>  $mime,
            'uploadType'    => 'multipart',
            'fields'	=>	'id',
        ]);
        unlink(WRITEPATH . 'uploads/' . $file_path);
        
        if (!$uploaded) {
            return null;
        }

        $id = $uploaded->getId();

        $permission = new Permission();
        $permission->setType('anyone');
        $permission->setRole('reader');
        $service->permissions->create($id, $permission);


        return $id;

    }

    public function changePassword()
    {
        $model = new User();
        $oldPass = $model->select('password')->find(session('id'))['password'];
        if (!password_verify($this->request->getPost('old_pass'), $oldPass)) {
            return redirect()->back()->with('msg', 'Password lama yang anda masukkan salah');
        }

        if (!$this->validate([
            'password'	=>	'min_length[8]',
            'confirm_pass'  =>  'matches[password]'
        ],[
            'password'	=>	[
                'min_length'    =>  'Password minimal 8 karakter'
            ],
            'confirm_pass'	=>	[
                'matches'	=>	'Password baru dan konfirmasi password tidak sama'
            ]
        ])) {
            return redirect()->back()->with('msg', $this->validator->listErrors());
        } else {
            $data = [
                'id'	=>	session('id'),
                'password'  =>  password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ];
            $model->save($data);
            return redirect()->back()->with('success', 'Password berhasil diubah');
        }
    }

}
