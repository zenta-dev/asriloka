<nav class=" navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid ">
        <a class="navbar-brand me-5" href="index.php">
            <img width=20% src="images/logo.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active me-2" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active me-2" aria-current="page" href="facilities.php">Fasilitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active me-2" aria-current="page" href="ketentuan.php">Ketentuan</a>
                </li>
                <li class="nav-item dropdown me-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Reservasi
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="rooms.php">Rooms</a></li>
                        <li><a class="dropdown-item" href="pktLDK.php">Paket LDK</a></li>
                        <li><a class="dropdown-item" href="pktPerusahaan.php">Paket Perusahaan</a></li>
                        <li><a class="dropdown-item" href="pktCamp.php">Paket Camp</a></li>
                    </ul>
                </li>
            </ul>
            <div class="d-flex">
                <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal"
                    data-bs-target="#loginModal">
                    Login
                </button>
                <button type="button" class="btn btn-outline-dark shadow-none me-lg-2 me-3" data-bs-toggle="modal"
                    data-bs-target="#registerModal">
                    Register
                </button>
            </div>
        </div>
    </div>
</nav>

<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-item-center">
                        <i class="bi bi-person-circle fs-3 me-2"></i>User Login
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="email" class="form-control shadow-none">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control shadow-none">
                    </div>
                    <div class="d-flex align-item-center justify-content-between mb-2">
                        <button type="submit" class="btn btn-dark shadow-none">LOGIN</button>
                        <a href="javascript: void(0)" class="text-scondary text-decoration-none">Forgot
                            Password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-item-center">
                        <i class="bi bi-person-fill fs-3 me-2"></i>User Registration
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">Note : Your details
                        must match with your ID</span>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 p-0">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="number" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Picture</label>
                                <input type="file" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Date of birth</label>
                                <input type="date" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Address</label>
                                <textarea class="form-control shadow-none" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-center my-1">
                        <button type="submit" class="btn btn-dark shadow-none">REGISTER</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>