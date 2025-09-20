<?php

return [

    // 🔑 1 = Superadmin
    1 => [
        [
            'name' => 'Dashboard',
            'route' => 'dashboard',
        ],
        [
            'name' => 'Manajemen User',
            'children' => [
                ['name' => 'Daftar User', 'route' => 'users.index'],
                ['name' => 'Tambah User', 'route' => 'users.create'],
            ],
        ],
        [
            'name' => 'Pengaturan',
            'children' => [
                ['name' => 'Roles', 'route' => 'roles.index'],
                ['name' => 'Permission', 'route' => 'permissions.index'],
            ],
        ],
    ],

    // 🔑 2 = Admin
    2 => [
        [
            'name' => 'Dashboard',
            'route' => 'dashboard',
        ],
        [
            'name' => 'Karyawan',
            'children' => [
                ['name' => 'Daftar Karyawan', 'route' => 'employees.index'],
                ['name' => 'Absensi', 'route' => 'attendances.index'],
                ['name' => 'Cuti', 'route' => 'leaves.index'],
            ],
        ],
    ],

    // 🔑 3 = Mentor
    3 => [
        [
            'name' => 'Dashboard',
            'route' => 'dashboard',
        ],
        [
            'name' => 'Kelas Saya',
            'children' => [
                ['name' => 'Daftar Kelas', 'route' => 'classes.index'],
                ['name' => 'Jurnal Mengajar', 'route' => 'journals.index'],
            ],
        ],
    ],

    // 🔑 4 = Learner
    4 => [
        [
            'name' => 'Dashboard',
            'route' => 'dashboard',
        ],
        [
            'name' => 'KRS & Nilai',
            'children' => [
                ['name' => 'KRS', 'route' => 'krs.index'],
                ['name' => 'Nilai', 'route' => 'grades.index'],
            ],
        ],
        [
            'name' => 'Absensi',
            'route' => 'absensi.index',
        ],
    ],

    // 🔑 5 = Partner
    5 => [
        [
            'name' => 'Dashboard',
            'route' => 'dashboard',
        ],
        [
            'name' => 'Monitoring',
            'children' => [
                ['name' => 'Report Absensi', 'route' => 'partner.attendance'],
                ['name' => 'Report Nilai', 'route' => 'partner.grades'],
            ],
        ],
    ],

    // 🔑 6 = PIC
    6 => [
        [
            'name' => 'Dashboard',
            'route' => 'dashboard',
        ],
        [
            'name' => 'Data Mahasiswa',
            'children' => [
                ['name' => 'Daftar Mahasiswa', 'route' => 'students.index'],
                ['name' => 'Rekap Kehadiran', 'route' => 'pic.attendance'],
            ],
        ],
    ],

];
