<a class="btn btn-primary" data-bs-toggle="offcanvas" href="#adminSideBar" role="button" aria-controls="adminSideBar">
    Link with href
</a>
<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSideBar"
    aria-controls="adminSideBar">
    Button with data-bs-target
</button>

<div class="offcanvas offcanvas-start sidebar-nav bg-dark text-white pt-5" tabindex="-1" id="adminSideBar"
    data-bs-backdrop="false" aria-labelledby="offcanvasExampleLabel">

    <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
            <ul CLASS="navbar-nav">


                <li class="fs-5 mb-2">
                    <div class="text-muted small fw-bolf text-uppercase px-3">
                        PROPERTIES
                    </div>
                </li>

                <li class="ms-3 mb-2">
                    <a href="#" class="nav-link">
                        <span class="me-2">
                            <i class="fas fa-chart-line"></i>
                        </span>
                        <span>My Properties</span>
                    </a>
                </li>


                <li class="my-2">
                    <hr class="dropdown-divider">
                </li>

                <li class="fs-5 mb-2">
                    <div class="text-muted small fw-bolf text-uppercase px-3">
                        VERIFICATION
                    </div>
                </li>


                <li class="my-2">
                    <hr class="dropdown-divider">
                </li>



                <li class="fs-5 mb-2">
                    <div class="text-muted small fw-bolf text-uppercase px-3">
                        USERS
                    </div>
                </li>

                <li class="ms-3 mb-2">
                    <a href="/admin/users" class="nav-link">
                        <span class="me-2">
                            <i class="fas fa-users"></i>
                        </span>
                        <span>Manage users</span>
                    </a>
                </li>

                <li class="my-2">
                    <hr class="dropdown-divider">
                </li>


            </ul>
        </nav>
    </div>
</div>


<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>