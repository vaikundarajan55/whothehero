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
                                            <h5 class="m-b-10">Add Category</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Add New Category</a></li>
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
                                        <h5><i class="fa fa-home"></i> Add Category List</h5>
                                    </div>
                                    <div class="card-body">
                                       
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="<?= base_url('categoryaddNew') ?>" method="post"  enctype="multipart/form-data">
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Category Name</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control" id="cat_name" placeholder="Category Title" name="cat_name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputPassword3" class="col-sm-3 col-form-label">Category Image</label>
                                                        <div class="col-sm-7">
                                                            <input type="file" class="form-control" id="cat_image" 
                                                            name="cat_image" placeholder="Category Image">
                                                        </div>
                                                    </div>
                                                   <div class="form-group row">
                                                        <div class="col-sm-3"></div>
                                                        <div class="col-sm-7 text-center">
                                                            <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i>Add</button>
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
   <?php echo view('admin/layout/footer'); ?>
