<?php echo view('layout/header'); ?>

<?php echo view('layout/sidemenu'); ?>
	
<?php echo view('layout/main-header'); ?>

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
                                            <h5 class="m-b-10">ChangePassword</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">ChangePassword</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <!-- [ form-element ] start -->
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5><i class="fa fa-home"></i> ChangePassword</h5>
                                    </div>
                                    <div class="card-body">
                                        <?php $success = session()->getFlashdata('success'); ?>
                                        <?php if (!empty($success)) : ?>
                                            <script>
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Success',
                                                    text: '<?= esc($success) ?>',
                                                    showConfirmButton: false,
                                                    timer: 2000
                                                });
                                            </script>
                                        <?php endif; ?>
                                       
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="<?= base_url('updatechangepassword') ?>" method="post"  enctype="multipart/form-data">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Change Password</label>
                                                        <div class="col-sm-7">
                                                            <input type="password"  class="form-control"  id="password" 
                                                                name="password"  placeholder="Password">
                                                            <?php if(isset($validation)) : ?>
                                                                <span class="text-danger">
                                                                    <?= $validation->getError('password'); ?>
                                                                </span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Confirm Password</label>
                                                        <div class="col-sm-7">
                                                            <input type="password"  class="form-control"  id="conformpassword" 
                                                                name="conformpassword"  placeholder="Confirm Password">
                                                            <?php if(isset($validation)) : ?>
                                                                <span class="text-danger">
                                                                    <?= $validation->getError('conformpassword'); ?>
                                                                </span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                   <div class="form-group row">
                                                        <div class="col-sm-3"></div>
                                                        <div class="col-sm-7 text-center">
                                                            <button class="btn btn-primary" type="submit">Update</button>
                                                        </div>
                                                    </div>
                                                   
                                                </form>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                               
                            </div>
                            <!-- [ form-element ] end -->
                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <?php echo view('layout/footer'); ?>
