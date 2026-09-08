<?php echo view('admin/layout/header'); ?>

<?php echo view('admin/layout/sidemenu'); ?>
	
<?php echo view('admin/layout/main-header'); ?>
<script>
function confirmDelete(e, url) {
    e.preventDefault();

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't to Delete the Category!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}
</script>
<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
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
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard') ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!"><?php echo $headerName; ?></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                       
                        <div class="row">
                            <!-- DOM/Jquery table start -->
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>All <?php echo $headerName; ?></h5>
                                       <a href="<?php echo base_url('addcategory') ?>"> <button type="button" class="btn btn-primary float-right"  title="" data-toggle="tooltip" data-original-title="btn btn-primary"><i class="fa fa-plus"></i>Add Category</button></a>
                                    </div>
                                    <div class="card-body">
                                        <!-- ✅ ADD HERE -->
                                        <?php if (session()->getFlashdata('success')): ?>
                                            <script>
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Success',
                                                text: '<?= session()->getFlashdata('success') ?>',
                                                showConfirmButton: false,
                                                timer: 2000
                                            });
                                            </script>
                             
                             <?php endif; ?>
                                        <?php if (session()->getFlashdata('update')): ?>
                                            <script>
                                                Swal.fire({
                                                    icon: 'update',
                                                    title: 'update',
                                                    text: '<?= session()->getFlashdata('update') ?>',
                                                    showConfirmButton: false,
                                                    timer: 2000
                                                });
                                            </script>
                                        <?php endif; ?>

                                        <?php if (session()->getFlashdata('error')): ?>
                                            <script>
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Error',
                                                    text: '<?= session()->getFlashdata('error') ?>'
                                                });
                                            </script>
                                        <?php endif; ?>

                                       

                                        <div class="table-responsive dt-responsive">
                                            <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>S.NO</th>
                                                        <th>Category Name</th>
                                                        <th>Image</th>
                                                        <th style="width:80px">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   <?php 
                                                   $i =1;
                                                   foreach($categoryList as $row){ ?>
                                                        <tr>
                                                            <td><?= $i++; ?></td>

                                                            <td><?= $row->cat_name; ?></td>

                                                            <td>
                                                                <?php if(!empty($row->cat_image)){ ?>
                                                                    <img src="<?= base_url('uploads/'.$row->cat_image); ?>" width="60">
                                                                <?php } ?>
                                                            </td>

                                                            <td>
                                                                <a href="<?= base_url('editcategory/'.$row->cid); ?>" 
                                                                class="btn btn-warning btn-sm">Edit</a>

                                                                <a href="<?= base_url('delcategory/'.$row->cid); ?>" 
                                                                onclick="confirmDelete(event, this.href)" 
                                                                class="btn btn-danger btn-sm">Delete</a>
                                                            </td>
                                                        </tr>
                                                    <?php }  ?>
                                                </tbody>
                                           
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                           
                        </div>
                        <!-- [ Main Content ] end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    

<?php echo view('admin/layout/footer'); ?>
