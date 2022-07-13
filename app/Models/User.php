<?php

namespace App\Models;

use CodeIgniter\Model;
use Faker\Generator;

class User extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_ketua', 'nama_anggota', 'email_ketua', 'email_anggota',
        'sekolah', 'nisn_ketua', 'nisn_anggota', 'wa_ketua', 'wa_anggota',
        'kota', 'provinsi', 'bukti_nisn_ketua', 'bukti_nisn_anggota',
        'bukti_bayar', 'password', 'role_id', 'is_active', 'nomor_peserta'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = '';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = ['setImageLink'];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getByEmail(string $email)
    {
        return $this->where('email_ketua', $email)->first();
    }

    public static function getImageLink(string $imageID)
    {
        return 'https://drive.google.com/uc?id=' . $imageID . '&export=view';
    }

    public function setImageLink($data)
    {
        if (($data['method'] == 'find' && !isset($data['id'])) || $data['method']=='findAll') {
            foreach($data['data'] as $key => $item) {
                if (isset($item['bukti_nisn_ketua'])) $data['data'][$key]['bukti_nisn_ketua'] = $this->getImageLink($item['bukti_nisn_ketua']);
                if (isset($item['bukti_nisn_anggota'])) $data['data'][$key]['bukti_nisn_anggota'] = $this->getImageLink($item['bukti_nisn_anggota']);
                if (isset($item['bukti_bayar'])) $data['data'][$key]['bukti_bayar'] = $this->getImageLink($item['bukti_bayar']);
            }
        }
        return $data;
    }

    public function fake(Generator &$faker)
    {
        return [
            'nama_ketua'  =>  $faker->name,
            'email_ketua' =>  $faker->email,
            'sekolah'	=>	'ITS',
            'wa_ketua'	=>	$faker->phoneNumber,
            'kota'	=>	$faker->city,
            'provinsi'	=>	'',
            'bukti_bayar'   =>  $faker->randomAscii(),
            'password'	=>	password_hash($faker->password, PASSWORD_DEFAULT),
            'role_id'	=>	$faker->numberBetween(1, 6),
        ];
    }
}
