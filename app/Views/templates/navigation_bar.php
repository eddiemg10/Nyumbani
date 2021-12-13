<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">

        <!-- Sidenav trigger -->
        <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSideBar"
            aria-controls="adminSideBar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!--End of trigger   -->

        <a class="navbar-brand me-3 fw-bold" href="#">NYUMBANI</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">


            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <!-- <img src="/assets/icons/user2.png" alt="user icon" width="30" class="d-inline-block"> -->

                            <?php echo "Username here"//echo session()->get('firstname')." ".session()->get('lastname') ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end"
                            aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Sign out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</nav>
</nav>

<script>
$(document).ready(function() {

    $("#sign_out").click(function(event) {
        if (!confirm(
                "Confirm you want to Log out of your account"
            )) {
            return false;
        }

    });

    $(".restricted").click(function(event) {
        let status = <?php  if(session()->get('isLoggedIn')){echo 1;}else{echo 0;} ?>

        if (status == 0) {
            $("#navbarDarkDropdownMenuLink").focus();
            return false;
        }
    });

});
</script>