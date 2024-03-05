<ul class="navbar-nav bg-gradient-warning sidebar sidebar-dark accordion" id="accordionSidebar">
  
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
    <div class="sidebar-brand-text mx-3">Cafe</div>
  </a>
  
  <!-- Divider -->
  <hr class="sidebar-divider my-0">
  
  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  
  <li class="nav-item"> 
    <a class="nav-link" href="{{ url('products') }}">
      <i class="fas fa-fw fa-coffee"></i>
      <span>Products</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('jenis') }}">
      <i class="fas fa-fw fa-tags"></i>
      <span>Jenis</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('stok') }}">
      <i class="fas fa-fw fa-boxes"></i>
      <span>Stok</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('pelanggan') }}">
      <i class="fas fa-fw fa-users"></i>
      <span>Pelanggan</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('pemesanan') }}">
      <i class="fas fa-fw fa-shopping-cart"></i>
      <span>Pemesanan</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('register') }}">
      <i class="fas fa-fw fa-user-plus"></i>
      <span>Register</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('login') }}">
      <i class="fas fa-fw fa-sign-out-alt"></i>
      <span>Logout</span></a>
  </li>
  
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">
  
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>

<style>
.sidebar {
    transition: margin-left 1.5s; /* Efek transisi saat mengubah margin kiri */
}

.sidebar-closed {
    margin-left: -10px; /* Menyembunyikan sidebar saat ditutup */
}
</style>

<script>
    document.getElementById("sidebarToggle").addEventListener("click", function() {
    var sidebar = document.getElementById("accordionSidebar");
    sidebar.classList.toggle("sidebar-closed"); // Toggle kelas sidebar-closed
});

</script>