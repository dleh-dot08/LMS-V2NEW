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
                ['name' => 'Daftar User', 'route' => 'admin.users.index'],
                ['name' => 'Tambah User', 'route' => 'admin.users.create'],
                ['name' => 'Import User', 'route' => 'admin.users.import.form'],
            ],
        ],
        [
            'name' => 'Master Data',
            'children' => [
                ['name' => 'File Management', 'route' => 'files.index'],
                ['name' => 'School Management', 'route' => 'schools.index'],
                ['name' => 'Program Category', 'route' => 'program_categories.index'],
                ['name' => 'Program', 'route' => 'programs.index'],
                ['name' => 'Semester', 'route' => 'semesters.index'],
                ['name' => 'Class Group', 'route' => 'class-groups.index'],
            ],
        ],
        [
            'name' => 'Pengaturan',
            'children' => [
                
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
            'name' => 'Manajemen User',
            'children' => [
                ['name' => 'Daftar User', 'route' => 'admin.users.index'],
                // 'Tambah User' sengaja dihapus
            ],
        ],
        [
            'name' => 'Master Data',
            'children' => [
                ['name' => 'File Management', 'route' => 'files.index'],
                ['name' => 'School Management', 'route' => 'schools.index'],
                ['name' => 'Program Category', 'route' => 'program_categories.index'],
                ['name' => 'Program', 'route' => 'programs.index'],
                ['name' => 'Semester', 'route' => 'semesters.index'],
                ['name' => 'Class Group', 'route' => 'class-groups.index'],
            ],
        ],
        [
            'name' => 'Karyawan',
            'children' => [
                
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
                ['name' => 'Daftar Kelas', 'route' => '#'],
                ['name' => 'Jurnal Mengajar', 'route' => '#'],
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
                ['name' => 'KRS', 'route' => '#'],
                ['name' => 'Nilai', 'route' => '#'],
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
                ['name' => 'Report Absensi', 'route' => '#'],
                ['name' => 'Report Nilai', 'route' => '#'],
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
                ['name' => 'Daftar Mahasiswa', 'route' => '#'],
                ['name' => 'Rekap Kehadiran', 'route' => '#'],
            ],
        ],
    ],

];
