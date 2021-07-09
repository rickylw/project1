<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view("template/nav-dashboard"); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid mt-4">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                        <h1 class="h3 mb-0 text-gray-800">Data Jari</h1>
                        <a class="btn btn-success" href="<?php echo base_url("datajari/tampilTambah") ?>">Tambah Data Jari</a>
                    </div>

                    <?php if ($this->session->flashdata('tambah-datajari-success')): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $this->session->flashdata('tambah-datajari-success'); ?>
                    </div>
                    <?php elseif ($this->session->flashdata('tambah-datajari-failed')): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $this->session->flashdata('tambah-datajari-failed'); ?>
                    </div>
                    <?php elseif ($this->session->flashdata('ubah-datajari-success')): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $this->session->flashdata('ubah-datajari-success'); ?>
                    </div>
                    <?php elseif ($this->session->flashdata('ubah-datajari-failed')): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $this->session->flashdata('ubah-datajari-failed'); ?>
                    </div>
                    <?php elseif ($this->session->flashdata('hapus-datajari-success')): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $this->session->flashdata('hapus-datajari-success'); ?>
                    </div>
                    <?php elseif ($this->session->flashdata('hapus-datajari-failed')): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $this->session->flashdata('hapus-datajari-failed'); ?>
                    </div>
                    <?php endif; ?>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="10%">Id</th>
                                        <th width="15%">NIM</th>
                                        <th width="10%">Nomor Jari</th>
                                        <th width="15%">Nama</th>
                                        <th width="10%">Kelas</th>
                                        <th width="15%">Jurusan</th>
                                        <th width="10%">Angkatan</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($datajari as $dataj): ?>
                                        <tr>
                                            <th><?php echo $dataj->id ?></th>
                                            <td><?php echo $dataj->nim ?></td>
                                            <td><?php echo $dataj->nomor_jari ?></td>
                                            <td><?php echo $dataj->nama ?></td>
                                            <td><?php echo $dataj->kelas ?></td>
                                            <td><?php echo $dataj->jurusan ?></td>
                                            <td><?php echo $dataj->angkatan ?></td>
                                            <td>
                                                <div class="row">
                                                    <form class="col-sm-6 text-center" action="<?php echo base_url('datajari/tampilUbah/'.$dataj->id) ?>" method="POST">
                                                        <button class="btn btn-primary" type="submit">Ubah</button>
                                                    </form>
                                                    <form class="col-sm-6 text-center" action="<?php echo base_url('datajari/hapus/'.$dataj->id) ?>" method="POST">
                                                        <button class="btn btn-danger" type="submit">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php $this->load->view("template/footer"); ?>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url(); ?>assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url(); ?>assets/js/demo/chart-area-demo.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/demo/chart-pie-demo.js"></script>

</body>

</html>