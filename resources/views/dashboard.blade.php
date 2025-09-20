@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-3xl text-gray-900">📊 Dashboard</h2>
            <span class="px-4 py-2 text-sm rounded-xl bg-indigo-50 text-indigo-600 font-medium shadow-sm">
                Semester Ganjil 2025
            </span>
        </div>
        <div class="space-y-6">

            {{-- Metrics section (support role 1..6) --}}
            @switch($role)
                @case(1) {{-- Superadmin --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <x-metric-card label="Total User" :value="$metrics['users'] ?? 0" color="indigo" />
                        <x-metric-card label="Total Courses" :value="$metrics['courses'] ?? 0" color="green" />
                        <x-metric-card label="Partners" :value="$metrics['partners'] ?? 0" color="red" />
                    </div>
                    @break

                @case(2) {{-- Admin / operational --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <x-metric-card label="Total Siswa" :value="$metrics['students'] ?? 0" color="indigo" />
                        <x-metric-card label="Total Dosen" :value="$metrics['lecturers'] ?? 0" color="green" />
                        <x-metric-card label="Total Courses" :value="$metrics['courses'] ?? 0" color="red" />
                    </div>
                    @break

                @case(3) {{-- Mentor / Trainer --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <x-metric-card label="Kursus Saya" :value="$metrics['my_courses'] ?? 0" color="indigo" />
                        <x-metric-card label="Sesi Hari Ini" :value="$metrics['sessions_today'] ?? 0" color="green" />
                        <x-metric-card label="Total Mahasiswa" :value="$metrics['students'] ?? 0" color="red" />
                    </div>
                    @break

                @case(4) {{-- Learner --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <x-metric-card label="Kursus" :value="$metrics['my_courses'] ?? 0" color="indigo" />
                        <x-metric-card label="Tugas" :value="$metrics['assignments'] ?? 0" color="green" />
                        <x-metric-card label="Kehadiran (%)" :value="($metrics['attendance_percent'] ?? 0) . '%' " color="red" />
                    </div>
                    @break

                @case(5) {{-- Partner (school/organization) --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <x-metric-card label="Kursus Terdaftar" :value="$metrics['courses'] ?? 0" color="indigo" />
                        <x-metric-card label="Sekolah Terhubung" :value="$metrics['schools'] ?? 0" color="green" />
                        <x-metric-card label="Peserta" :value="$metrics['students'] ?? 0" color="red" />
                    </div>
                    @break

                @case(6) {{-- PIC Sekolah --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <x-metric-card label="Materi Upload" :value="$metrics['materials'] ?? 0" color="indigo" />
                        <x-metric-card label="Siswa Terdaftar" :value="$metrics['students'] ?? 0" color="green" />
                        <x-metric-card label="Laporan" :value="$metrics['reports'] ?? 0" color="red" />
                    </div>
                    @break

                @default
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <x-metric-card label="Item A" :value="0" color="indigo" />
                        <x-metric-card label="Item B" :value="0" color="green" />
                        <x-metric-card label="Item C" :value="0" color="red" />
                    </div>
            @endswitch

            {{-- Greeting & Jam --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white rounded-xl border shadow-sm p-6 flex items-start gap-4">
                    <div class="h-14 w-14 rounded-xl bg-indigo-50 flex items-center justify-center text-3xl">
                        🎓
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">
                            Selamat Datang, {{ auth()->user()->name }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Ini adalah dashboard Learning Management System. Gunakan menu di samping untuk mengelola data akademik.
                        </p>
                    </div>
                </div>

                <div class="rounded-xl bg-gradient-to-r from-indigo-600 to-sky-500 p-6 text-white shadow flex flex-col justify-center">
                    <span class="text-sm opacity-90">Waktu Saat Ini</span>
                    <span id="currentTime" class="mt-2 text-lg font-semibold"></span>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="rounded-2xl bg-white shadow p-6">
                <h3 class="font-semibold text-gray-900">🚀 Akses Cepat</h3>
                <div class="mt-4 flex flex-wrap gap-3">
                    <a href="#" class="px-4 py-2 rounded-lg bg-indigo-50 text-indigo-600 text-sm hover:bg-indigo-100">📘 Data Mahasiswa</a>
                    <a href="#" class="px-4 py-2 rounded-lg bg-emerald-50 text-emerald-600 text-sm hover:bg-emerald-100">👨‍🏫 Data Dosen</a>
                    <a href="#" class="px-4 py-2 rounded-lg bg-sky-50 text-sky-600 text-sm hover:bg-sky-100">📚 Mata Kuliah</a>
                    <a href="#" class="px-4 py-2 rounded-lg bg-pink-50 text-pink-600 text-sm hover:bg-pink-100">📅 Jadwal</a>
                    <a href="#" class="px-4 py-2 rounded-lg bg-yellow-50 text-yellow-600 text-sm hover:bg-yellow-100">📝 Absensi</a>
                    <a href="#" class="px-4 py-2 rounded-lg bg-purple-50 text-purple-600 text-sm hover:bg-purple-100">📊 Nilai</a>
                </div>
            </div>

            {{-- Chart Section --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                {{-- Grafik Bar --}}
                <div class="bg-white p-6 rounded-xl shadow">
                    <h2 class="text-lg font-semibold mb-3">📈 Statistik</h2>
                    <canvas id="barChart"></canvas>
                </div>

                {{-- Grafik Pie --}}
                <div class="bg-white p-6 rounded-xl shadow">
                    <h2 class="text-lg font-semibold mb-3">📊 Distribusi</h2>
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function updateClock() {
        const now = new Date();
        const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
        const dateStr = now.toLocaleDateString('id-ID', options);
        const timeStr = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute:'2-digit', second:'2-digit' });
        document.getElementById('currentTime').textContent = `${dateStr} • ${timeStr}`;
    }

    updateClock();
    setInterval(updateClock, 1000);

    // Data dari server
    let role = @json($role);
    let metrics = @json($metrics);

    let labels = [];
    let barData = [];
    let pieData = [];

    if (role === 1) { // superadmin
        labels = ["Users","Courses","Partners"];
        barData = [metrics.users ?? 0, metrics.courses ?? 0, metrics.partners ?? 0];
    } else if (role === 2) { // admin
        labels = ["Siswa","Dosen","Courses"];
        barData = [metrics.students ?? 0, metrics.lecturers ?? 0, metrics.courses ?? 0];
    } else if (role === 3) { // mentor
        labels = ["Kursus Saya","Sesi Hari Ini","Mahasiswa"];
        barData = [metrics.my_courses ?? 0, metrics.sessions_today ?? 0, metrics.students ?? 0];
    } else if (role === 4) { // learner
        labels = ["Kursus","Tugas","Kehadiran %"];
        barData = [metrics.my_courses ?? 0, metrics.assignments ?? 0, metrics.attendance_percent ?? 0];
    } else if (role === 5) { // partner
        labels = ["Kursus Terdaftar","Sekolah Terhubung","Peserta"];
        barData = [metrics.courses ?? 0, metrics.schools ?? 0, metrics.students ?? 0];
    } else if (role === 6) { // pic
        labels = ["Materi Upload","Siswa Terdaftar","Laporan"];
        barData = [metrics.materials ?? 0, metrics.students ?? 0, metrics.reports ?? 0];
    } else {
        labels = ["Item A","Item B","Item C"];
        barData = [0,0,0];
    }

    pieData = [...barData];

    // Bar Chart
    new Chart(document.getElementById("barChart"), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: "Data Statistik",
                data: barData,
                backgroundColor: ["#6366F1", "#22C55E", "#EF4444"]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });

    // Pie Chart
    new Chart(document.getElementById("pieChart"), {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: "Distribusi",
                data: pieData,
                backgroundColor: ["#3B82F6", "#10B981", "#F59E0B", "#EF4444"]
            }]
        },
        options: {
            responsive: true,
        }
    });
</script>
@endsection
