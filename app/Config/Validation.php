<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        // 'list'   => 'CodeIgniter\Validation\Views\list',
        'list'   => 'App\Views\errors\list_errors',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------

    public $login = [
        'email' => 'required',
        'password'  => 'required',
    ];

    public $login_errors = [
        'email'    =>    [
            'required'      =>  'Email tidak boleh kosong',
        ],
        'password'    =>    [
            'required'      =>  'password tidak boleh kosong'
        ]
    ];

    public $registration = [
        'nama_ketua'  =>  'required',
        'email_ketua' =>  'required|valid_email|is_unique[users.email_ketua]',
        'wa_ketua' =>  'required',
        'password'    =>    'required|min_length[8]',
        'confirm_password'  =>  'required|matches[password]',
    ];

    public $registration_errors = [
        'nama_ketua'    =>    [
            'required'      =>  'Nama tidak boleh kosong'
        ],
        'email_ketua'    =>    [
            'required'      =>  'Email tidak boleh kosong',
            'valid_email'   =>  'Mohon masukkan email yang valid',
            'is_unique'     =>  'Email sudah terdaftar'
        ],
        'wa_ketua' => [
            'required'      => 'Nomor Whatsapp tidak boleh kosong'
        ],
        'password'  =>    [
            'min_length'    =>  'Password minimal berisi 8 karakter'
        ],
        'confirm_password'  =>  [
            'matches'       =>  'Password dan konfirmasi password tidak sesuai'
        ]
    ];

    public $reset_pass = [
        'password'    =>    'min_length[8]',
        'confirm_password'    =>    'matches[password]'
    ];

    public $reset_pass_errors = [
        'password'    =>    [
            'min_length'   =>   'Password minimal berisi 8 karakter'
        ],
        'confirm_password'    =>    [
            'matches'   =>  'Password dan konfirmasi password tidak sesuai'
        ]
    ];

}
