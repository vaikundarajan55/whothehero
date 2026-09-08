<body class="">
	
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar menupos-fixed menu-dark menu-item-icon-style6 ">
		<div class="navbar-wrapper ">
			<div class="navbar-brand header-logo">
				<a href="index.html" class="b-brand">
					
					<img src="<?php echo base_url('assets/images/logo.svg') ?>" alt="" class="logo images">
					<img src="<?php echo base_url('assets/images/logo-icon.svg') ?>" alt="" class="logo-thumb images">
				</a>
				<a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
			</div>
			<div class="navbar-content scroll-div" >
				<ul class="nav pcoded-inner-navbar">
					<li data-username="dashboard" class="nav-item ">
						<a href="<?php echo base_url('dashboard') ?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span>Dashboard</a>
						
					</li>
					<li data-username="vertical horizontal box layout RTL fixed static collapse menu color icon dark background image" class="nav-item pcoded-hasmenu">
						<a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Category</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="<?php echo base_url('categorylist') ?>" >Category List</a></li>
							<li class=""><a href="<?php echo base_url('addcategory') ?>" >Add Category</a></li>
						</ul>
					</li>
					<li data-username="widget statistic data chart" class="nav-item pcoded-hasmenu">
						<a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-target"></i></span><span class="pcoded-mtext">Sub Category</span></a>
						<ul class="pcoded-submenu">
							<li class=""><a href="<?php echo base_url('subcategorylist') ?>" class="">Sub Category List</a></li>
							<li class=""><a href="<?php echo base_url('addsubcategory') ?>" class="">Add Sub Category</a></li>
						</ul>
					</li>
					<li data-username="dashboard" class="nav-item ">
						<a href="<?php echo base_url('changepassword') ?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-lock"></i></span>Change Password</a>
					</li>
					
				</ul>
			</div>
		</div>
	</nav>
