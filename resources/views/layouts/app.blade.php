<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc5vCGpaA4Q/NfZ+0eXYn5N7EePcHsw2K4rFz+oN4Xk+Xo8z0tg/1cM9QXk2Vq5sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Volkhov&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex h-screen">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col">
        {{-- Topbar --}}
        <header class="h-14 bg-white border-b flex items-center justify-end px-6 shadow-sm">
            {{-- Notifikasi --}}
            <button class="relative p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                🔔
                <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>

            {{-- User Dropdown --}}
            <div class="ml-4 relative group">
                <button class="flex items-center gap-2 p-2 hover:bg-gray-100 rounded-lg">
                    <span class="font-medium text-gray-700">{{ auth()->user()->name }}</span>
                    ⌄
                </button>
                <div class="absolute right-0 mt-2 w-40 bg-white border rounded-lg shadow-md hidden group-hover:block">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </main>
    </div>

    @yield('scripts')

  <script>
    document.addEventListener("DOMContentLoaded", () => {
        const burger = document.getElementById('burger');
        const sidebar = document.getElementById('sidebar');

        burger.addEventListener('click', function () {
            sidebar.classList.toggle('active');
        });
    });
</script>

</body>

</html>
