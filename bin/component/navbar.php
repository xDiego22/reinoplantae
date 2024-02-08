<nav class="navbar bg-light fixed-top">
  <div class="container-fluid">
    <span class="navbar-brand" href="#">
      <img src="assets/img/icons/icon-plant.png" alt="Bootstrap">
      Clasificacion del reino de las plantas
    </span>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="?pagina=inicio"> <img src="assets/img/icons/hogar.png" alt="home" width='30' class='me-3'>Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?pagina=planta"> <img src="assets/img/icons/planta.png" alt="planta" width='35' class='me-2'>Planta</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>