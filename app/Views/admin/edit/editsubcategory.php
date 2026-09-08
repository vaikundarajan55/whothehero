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
                                            <h5 class="m-b-10"><?php echo $headerName; ?></h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard') ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Edit Catetory</a></li>
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
                                        <h5>Basic component</h5>
                                    </div>
                                    <div class="card-body">
                                       
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="<?= base_url('subcateditNew') ?>" method="post"  enctype="multipart/form-data">
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Category Name</label>
                                                        <div class="col-sm-7">
                                                            <select class="form-control" id="exampleFormControlSelect1" name="cid">
                                                           <option value="">Select Category</option>
                                                            <?php foreach($categoryList as $row){ ?>
                                                                <option value="<?= $row->cid; ?>"
                                                                    <?= ($row->cid == $edisubcat->cid) ? 'selected' : ''; ?>>
                                                                    <?= $row->cat_name; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">SubCategory Name</label>
                                                       <div class="col-sm-7">
                                                            <input type="text" class="form-control" id="web_title" placeholder="SubCategory Title" name="web_title" value="<?= $edisubcat->web_title; ?>">
                                                        </div>
                                                    </div>
                                                   <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Category Image</label>

                                                        <div class="col-sm-7">
                                                            <!-- File input -->
                                                            <input type="file" name="web_image" class="form-control">
                                                            <!-- Show old image -->
                                                            <?php if (!empty($edisubcat->web_image)) { ?>
                                                                <img src="<?= base_url('uploads/'.$edisubcat->web_image); ?>" width="200" style="margin-top:10px;">
                                                            <?php } ?>
                                                            
                                                            <!-- Hidden field to keep old image -->
                                                            <input type="hidden" name="old_image" value="<?= $edisubcat->web_image; ?>">
                                                        </div>
                                                    </div>
                                                   <input type="hidden" name="sid" value="<?= $edisubcat->sid; ?>">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3"></div>
                                                        <div class="col-sm-7 text-center">
                                                            <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i>Update</button>
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
