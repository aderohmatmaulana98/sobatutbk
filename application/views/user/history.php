<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SobatUTBK</title>

    <link rel="icon" href="img/logo.png" type="image/gif">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

</head>

<body id="page-top" class="sidebar-toggled">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion toggled" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center text-hitam justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <img src="img/logo-2.png" class="img-fluid" width="88%">
                </div>
                <!-- <div class="sidebar-brand-text mx-3">SobatUTBK</div> -->
            </a>

            <!-- Divider -->
            <!-- <hr class="sidebar-divider bg-dark my-0"> -->

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link text-hitam" href="index.html">
                    <i class="fa fa-home text-hitam" aria-hidden="true"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link text-orange" href="statistik.html">
                    <i class="fa fa-pie-chart text-orange" aria-hidden="true"></i>
                    <span>Statistik</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link text-hitam" href="product.html">
                    <i class="fa fa-shopping-cart text-hitam" aria-hidden="true"></i>
                    <span>Product</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0 " style="background-color: #64646446;" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" class="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <div class="h3 text-hitam">Statistik</div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-dark small">Hay, Jody Septiawan</span>
                                <img class="img-profile rounded-circle" src="https://avatars2.githubusercontent.com/u/44697757?s=460&u=8b819ae96d058fe2ef0f0318b9481eeb6845df62&v=4">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->

                <div class="container-fluid mb-4">
                    <div class="row mb-4">
                        <div class="col-lg-12 menu-statistik">
                            <a href="statistik.html" class="text-hitam mr-3 ">Activity Progress</a>
                            <a href="history.html" class="text-hitam menu-statistik-active">History</a>
                        </div>
                    </div>

                    <div class="row mb-5 history">
                        <div class="col-lg-8">
                            <div class="card shadow welcome border-0 mb-4" style="border-radius: 1em;">
                                <div class="card-body">
                                    <div class="h5 text-hitam mb-4">History Tryout</div>
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr class="text-hitam">
                                                    <th>ID Tryout</th>
                                                    <th>Nama Tryout</th>
                                                    <th>Date</th>
                                                    <th>Score</th>
                                                    <th>Status</th>
                                                    <th>Konsultasi</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>003452</td>
                                                    <td>Tryout Soshum</td>
                                                    <td>22 June 2020</td>
                                                    <td>581.000</td>
                                                    <td>Complete</td>
                                                    <td>IN332942</td>
                                                    <td><img src="img/menu-3.png" class="img-fluid" alt=""></td>
                                                </tr>
                                                <tr>
                                                    <td>003452</td>
                                                    <td>Tryout Soshum</td>
                                                    <td>22 June 2020</td>
                                                    <td>581.000</td>
                                                    <td>Complete</td>
                                                    <td>IN332942</td>
                                                    <td><img src="img/menu-3.png" class="img-fluid" alt=""></td>
                                                </tr>
                                                <tr>
                                                    <td>003452</td>
                                                    <td>Tryout Soshum</td>
                                                    <td>22 June 2020</td>
                                                    <td>581.000</td>
                                                    <td>Complete</td>
                                                    <td>IN332942</td>
                                                    <td><img src="img/menu-3.png" class="img-fluid" alt=""></td>
                                                </tr>
                                                <tr>
                                                    <td>003452</td>
                                                    <td>Tryout Soshum</td>
                                                    <td>22 June 2020</td>
                                                    <td>581.000</td>
                                                    <td>Complete</td>
                                                    <td>IN332942</td>
                                                    <td><img src="img/menu-3.png" class="img-fluid" alt=""></td>
                                                </tr>
                                                <tr>
                                                    <td>003452</td>
                                                    <td>Tryout Soshum</td>
                                                    <td>22 June 2020</td>
                                                    <td>581.000</td>
                                                    <td>Complete</td>
                                                    <td>IN332942</td>
                                                    <td><img src="img/menu-3.png" class="img-fluid" alt=""></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow welcome border-0" style="border-radius: 1em;">
                                <div class="card-body">
                                    <div class="h5 text-hitam">Orders</div>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover">
                                            <thead>
                                                <tr class="text-hitam">
                                                    <th>ID Tryout</th>
                                                    <th>Nama Tryout</th>
                                                    <th>Date</th>
                                                    <th>Score</th>
                                                    <th>Status</th>
                                                    <th>Konsultasi</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>003452</td>
                                                    <td>Tryout Soshum</td>
                                                    <td>22 June 2020</td>
                                                    <td>581.000</td>
                                                    <td>Complete</td>
                                                    <td>IN332942</td>
                                                    <td><img src="img/menu-3.png" class="img-fluid" alt=""></td>
                                                </tr>
                                                <tr>
                                                    <td>003452</td>
                                                    <td>Tryout Soshum</td>
                                                    <td>22 June 2020</td>
                                                    <td>581.000</td>
                                                    <td>Complete</td>
                                                    <td>IN332942</td>
                                                    <td><img src="img/menu-3.png" class="img-fluid" alt=""></td>
                                                </tr>
                                                <tr>
                                                    <td>003452</td>
                                                    <td>Tryout Soshum</td>
                                                    <td>22 June 2020</td>
                                                    <td>581.000</td>
                                                    <td>Complete</td>
                                                    <td>IN332942</td>
                                                    <td><img src="img/menu-3.png" class="img-fluid" alt=""></td>
                                                </tr>
                                                <tr>
                                                    <td>003452</td>
                                                    <td>Tryout Soshum</td>
                                                    <td>22 June 2020</td>
                                                    <td>581.000</td>
                                                    <td>Complete</td>
                                                    <td>IN332942</td>
                                                    <td><img src="img/menu-3.png" class="img-fluid" alt=""></td>
                                                </tr>
                                                <tr>
                                                    <td>003452</td>
                                                    <td>Tryout Soshum</td>
                                                    <td>22 June 2020</td>
                                                    <td>581.000</td>
                                                    <td>Complete</td>
                                                    <td>IN332942</td>
                                                    <td><img src="img/menu-3.png" class="img-fluid" alt=""></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-2 col-xl-3">
                            <div class="card shadow" style="background-color: #2D62ED; border-radius: 2em;">
                                <div class="card-body text-light border-0">
                                    <img src="img/file.png" alt="">
                                    <div class="h1 mb-0">Disc 15%</div>
                                    <div class="mb-4">6x tryout</div>
                                    <div class="text-right">
                                        <a href="#" class="text-light">
                                            <b>Beli sekarang</b>
                                            <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-arrow-up-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="background-color: rgba(216, 216, 216, 0.514); padding: 10px; border-radius: 50%">
                                                <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0v-6z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <!-- <footer class="sticky-footer bg-dark text-light">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2019</span>
                    </div>
                </div>
            </footer> -->
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>