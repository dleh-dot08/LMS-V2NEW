<div class="sidebar bg-white border-r border-gray-200 w-64 min-h-screen flex flex-col" id="sidebar">
    <!-- Logo -->
    <div class="p-4 border-b border-gray-200 flex items-center justify-center">
        <span class="text-lg font-bold text-indigo-600">LMS</span>
    </div>

    <ul class="menu">
        @foreach(auth()->user()->menu() as $menu)
            @if(isset($menu['children']))
                <li class="menu-item has-dropdown">
                    <button class="dropdown-btn">
                        {{ $menu['name'] }}
                        <span class="arrow">▶</span>
                    </button>
                    <ul class="submenu">
                        @foreach($menu['children'] as $child)
                            <li class="submenu-item">
                                <a href="{{ route($child['route']) }}">
                                    {{ $child['name'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li class="menu-item">
                    <a href="{{ route($menu['route']) }}">
                        {{ $menu['name'] }}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</div>

<!-- Tombol burger -->
<div class="burger" id="burger">☰</div>


<style>
/* Sidebar style */
.sidebar {
    width: 240px;
    height: 100vh;
    background: #ffffff;
    border-right: 1px solid #e5e7eb;
    padding: 15px;
    top: 0;
    left: 0;
    overflow-y: auto;
}

.sidebar-header {
    text-align: center;
    margin-bottom: 20px;
}

.logo {
    font-size: 20px;
    font-weight: bold;
    color: #2563eb;
}

/* Menu styling */
.menu {
    list-style: none;
    margin: 0;
    padding: 0;
}

.menu-item {
    margin-bottom: 6px;
}

.menu-item a,
.dropdown-btn {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: none;
    border: none;
    outline: none;
    cursor: pointer;
    text-decoration: none;
    font-size: 15px;
    padding: 10px 12px;
    border-radius: 6px;
    color: #374151;
    transition: all 0.2s;
}

.menu-item a:hover,
.dropdown-btn:hover {
    background: #f3f4f6;
    color: #2563eb;
}

/* Dropdown arrow */
.arrow {
    font-size: 12px;
    transition: transform 0.3s;
}

.menu-item.active > a,
.menu-item.active > .dropdown-btn {
    background: #e0e7ff;
    color: #1d4ed8;
}


/* Submenu */
.submenu {
    list-style: none;
    margin: 8px 0 0 0;
    padding-left: 20px;
    display: none;
}

.submenu-item a {
    display: block;
    font-size: 14px;
    padding: 8px 10px;
    border-radius: 4px;
    color: #4b5563;
    text-decoration: none;
}

.submenu-item a:hover {
    background: #e0e7ff;
    color: #1d4ed8;
}

/* Active dropdown */
.menu-item.active .submenu {
    display: block;
}
.menu-item.active .arrow {
    transform: rotate(90deg);
}

/* === RESPONSIVE === */
@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%); /* sembunyi default */
    }
    .sidebar.active {
        transform: translateX(0); /* muncul kalau aktif */
    }
    .burger {
        display: block; /* tampilkan tombol burger */
    }
    .main-content {
        margin-left: 0; /* biar full width di mobile */
    }
}

/* Tombol burger */
.burger {
    display: none;
    position: fixed;
    top: 15px;
    left: 15px;
    font-size: 24px;
    background: #2563eb;
    color: #fff;
    padding: 8px 12px;
    border-radius: 6px;
    cursor: pointer;
    z-index: 1100;
}

/* Responsive */
@media (max-width: 768px) {
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        transform: translateX(-100%);
        transition: transform 0.3s ease-in-out;
        z-index: 1000;
    }

    .sidebar.active {
        transform: translateX(0);
    }

    .burger {
        display: block;
    }

    .main-content {
        margin-left: 0;
    }
}

</style>

<script>
// Sidebar dropdown toggle
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".dropdown-btn").forEach((btn) => {
        btn.addEventListener("click", () => {
            const parent = btn.closest(".menu-item");
            parent.classList.toggle("active");
        });
    });
});
</script>
