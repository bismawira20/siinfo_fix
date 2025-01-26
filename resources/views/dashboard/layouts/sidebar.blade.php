<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarMenuLabel">SI-INFO</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
              <svg class="bi"><use xlink:href="#house-fill"/></svg>
              Dashboard
            </a>
        </ul>
        {{-- <hr class="my-3"> --}}
        @can('user')
        <h6 class ="sidebar-heading d-flex justify-content-between align-items-center 
        px-3 mt-4 mb-1 text-muted">
          <span>USER</span>
        </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 
            {{ Request::is('dashboard/bukutamu*') ? 'active' : '' }}" 
            aria-current="page"  href="/dashboard/bukutamu">
              <svg class="bi"><use xlink:href="#people"/></svg>
              Kunjungan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2
            {{ Request::is('dashboard/post*') ? 'active' : '' }}" 
            aria-current="page" href="/dashboard/post">
              <svg class="bi"><use xlink:href="#news"/></svg>
              Berita Kunjungan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 
            {{ Request::is('dashboard/pengaduan*') ? 'active' : '' }}" 
            aria-current="page" href="/dashboard/pengaduan">
              <svg class="bi"><use xlink:href="#megaphone"/></svg>
              Pengaduan
            </a>
          </li>
          <li class="nav-item dropdown-submenu">
            <a class="nav-link d-flex align-items-center gap-2
            {{ Request::is('dashboard/pengajuan*') ? 'active' : '' }} ||
             {{ Request::is('dashboard/passphrase*') ? 'active' : '' }} ||
              {{ Request::is('dashboard/cpanel*') ? 'active' : '' }} ||
               {{ Request::is('dashboard/emaildinas*') ? 'active' : '' }} ||
                {{ Request::is('dashboard/aplikasi*') ? 'active' : '' }} ||
                 {{ Request::is('dashboard/domain*') ? 'active' : '' }}" 
              aria-current="page" href="#" id="toggleLayanan">
              <svg class="bi"><use xlink:href="#wrench"/></svg>
              Layanan
              <svg class="bi" style="width: 12px; height: 12px; margin-left: 0px; margin-top: 3px;"><use xlink:href="#chevron-down"/></svg>
            </a>
            <ul class="submenu" id="submenuLayanan">
                <li><a href="/dashboard/domain">Sub Domain, Hosting, & VPS</a></li>
                <li><a href="/dashboard/emaildinas">Email Dinas</a></li>
                <li><a href="/dashboard/pengajuan">Pengajuan TTE</a></li>
                <li><a href="/dashboard/aplikasi">Pembuatan Aplikasi</a></li>
                <li><a href="/dashboard/passphrase">Passphrase TTE</a></li>
                <li><a href="/dashboard/cpanel">CPANEL</a></li>
            </ul>      
        </li>
        </ul>
        @endcan


        {{-- Admin --}}
        @can('admin')
        <h6 class ="sidebar-heading d-flex justify-content-between align-items-center 
        px-3 mt-4 mb-1 text-muted">
          <span>ADMINISTRATOR</span>
        </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/categories*') ? 'active' : '' }}" 
            aria-current="page" href="/dashboard/categories">
              <svg class="bi"><use xlink:href="#puzzle"/></svg>
              Kategori Berita
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/bidangs*') ? 'active' : '' }}" 
            aria-current="page" href="/dashboard/bidangs">
              <svg class="bi"><use xlink:href="#puzzle"/></svg>
              Bidang
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/bukutamu/admin*') ? 'active' : '' }}" 
            aria-current="page" href="/dashboard/bukutamu/admin">
              <svg class="bi"><use xlink:href="#people"/></svg>
              Kunjungan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/post/admin*') ? 'active' : '' }}" 
            aria-current="page" href="/dashboard/post/admin">
              <svg class="bi"><use xlink:href="#news"/></svg>
              Berita
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/pengaduan/admin*') ? 'active' : '' }}" 
            aria-current="page" href="/dashboard/pengaduan/admin">
              <svg class="bi"><use xlink:href="#megaphone"/></svg>
              Pengaduan
            </a>
          </li>
          <li class="nav-item dropdown-submenu">
            <a class="nav-link d-flex align-items-center gap-2 
            {{ Request::is('dashboard/pengajuan/admin*') ? 'active' : '' }} ||
             {{ Request::is('dashboard/passphrase/admin*') ? 'active' : '' }} ||
              {{ Request::is('dashboard/cpanel/admin*') ? 'active' : '' }} ||
              {{ Request::is('dashboard/emaildinas/admin*') ? 'active' : '' }} ||
               {{ Request::is('dashboard/aplikasi/admin*') ? 'active' : '' }} ||
                {{ Request::is('dashboard/domain/admin*') ? 'active' : '' }}" 
               aria-current="page" href="#" id="toggleLayanan">
               <svg class="bi"><use xlink:href="#wrench"/></svg>
               Layanan
               <svg class="bi" style="width: 12px; height: 12px; margin-left: 0px; margin-top: 3px;"><use xlink:href="#chevron-down"/></svg>
            </a>
            <ul class="submenu" id="submenuLayanan">
                <li><a href="/dashboard/domain/admin">Sub Domain, Hosting, & VPS</a></li>
                <li><a href="/dashboard/emaildinas/admin">Email Dinas</a></li>
                <li><a href="/dashboard/pengajuan/admin">Pengajuan TTE</a></li>
                <li><a href="/dashboard/aplikasi/admin">Pembuatan Aplikasi</a></li>
                <li><a href="/dashboard/passphrase/admin">Passphrase TTE</a></li>
                <li><a href="/dashboard/cpanel/admin">CPANEL</a></li>
            </ul>      
        </li>
        </ul>
        @endcan
        
      </div>
    </div>
  </div>

  <style>
    .nav-link {
    color: inherit; /* Gunakan warna default */
}

    .nav-link.active {
    color: blue; /* Atau warna biru sesuai kebutuhan */
}

    .dropdown-submenu {
    position: relative;
}

    .submenu-arrow {
    margin-left: 10px;
    font-size: 0.7em;
    transition: transform 0.3s ease;
}

    .dropdown-submenu.active .submenu-arrow {
    transform: rotate(180deg);
}

    .submenu {
    display: none;
    list-style: none;
    padding-left: 20px;
    margin-top: 10px;
    background-color: #f8f9fa;
    border-radius: 4px;
}

    .submenu li {
    margin: 5px 0;
}

    .submenu li a {
    color: #333;
    text-decoration: none;
    font-size: 0.9em;
    padding: 5px 10px;
    display: block;
    transition: background-color 0.3s ease;
}

    .submenu li a:hover {
    background-color: #e9ecef;
    border-radius: 4px;
}

    .dropdown-submenu.active .submenu {
    display: block;
}
</style>

<!-- Tambahkan JavaScript untuk toggle submenu -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const toggleLayanan = document.getElementById('toggleLayanan');
    const submenuLayanan = document.getElementById('submenuLayanan');
    const parentItem = toggleLayanan.closest('.dropdown-submenu');

    toggleLayanan.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Toggle active class
        parentItem.classList.toggle('active');
        
        // Optional: Close other open submenus if needed
        const otherActiveItems = document.querySelectorAll('.dropdown-submenu.active');
        otherActiveItems.forEach(item => {
            if (item !== parentItem) {
                item.classList.remove('active');
            }
        });
    });

    // Optional: Close submenu when clicking outside
    document.addEventListener('click', function(e) {
        if (!parentItem.contains(e.target)) {
            parentItem.classList.remove('active');
        }
    });
});
</script>