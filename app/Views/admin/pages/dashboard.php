<?php echo view('admin/layout/header'); ?>

<?php echo view('admin/layout/sidemenu'); ?>
	
<?php echo view('admin/layout/main-header'); ?>
	

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                        <!-- [ breadcrumb ] start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Dashboard</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Dashboard</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <!-- Project statustic start -->
                            <div class="col-xl-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card statustic-card">
                                            <div class="card-header borderless pb-0">
                                                <h5>Category</h5>
                                            </div>
                                            <div class="card-body text-center">
                                                <span class="d-block text-c-blue f-36"><?= $Catcount; ?></span>
                                                <p class="m-b-0">Total</p>
                                                <div class="progress">
                                                    <div class="progress-bar bg-c-blue" style="width:56%"></div>
                                                </div>
                                            </div>
                                            <div class="card-footer bg-c-blue border-0">
                                                <h6 class="text-white m-b-0">Count: <?= $Catcount; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card statustic-card">
                                            <div class="card-header borderless pb-0">
                                                <h5>SubCategory</h5>
                                            </div>
                                            <div class="card-body text-center">
                                                <span class="d-block text-c-green f-36"><?= $SCatcount; ?></span>
                                                <p class="m-b-0">Total</p>
                                                <div class="progress">
                                                    <div class="progress-bar bg-c-green" style="width:85%"></div>
                                                </div>
                                            </div>
                                            <div class="card-footer bg-c-green border-0">
                                                <h6 class="text-white m-b-0">Count: <?= $SCatcount; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- Project statustic end -->
                            
                            
                        </div>
                        <!-- [ Main Content ] end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo view('admin/layout/footer'); ?>