<!-- [ Header ] start -->
	<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">
		
			<div class="m-header">
				<a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
				<a href="<?php echo base_url('dashboard') ?>" class="b-brand">
					<!-- <div class="b-bg">
						<i class="fas fa-bolt"></i>
					</div>
					<span class="b-title">Dasho</span> -->
					<img src="<?php echo base_url('assets/images/logo.svg') ?>" alt="" class="logo images">
					<img src="<?php echo base_url('assets/images/logo-icon.svg') ?>" alt="" class="logo-thumb images">
				</a>
			</div>
			<a class="mobile-menu" id="mobile-header" href="#!">
				<i class="feather icon-more-horizontal"></i>
			</a>
			<div class="collapse navbar-collapse">
				
				<ul class="navbar-nav ml-auto">
					
					<li>
						<div class="dropdown drp-user">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon feather icon-settings"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right profile-notification">
								<div class="pro-head">
									<img src="<?php echo base_url('assets/images/user/avatar-1.jpg') ?>" class="img-radius" alt="User-Profile-Image">
									<span>
										<span class="h6"><?= session()->get('user_name'); ?></span>
									</span>
								</div>
								<ul class="pro-body">
									<li><a href="<?php echo base_url('logout') ?>" class="dropdown-item"><i class="feather icon-power text-danger"></i> Logout</a></li>
								</ul>
							</div>
						</div>
					</li>
				</ul>
			</div>
			
	</header>
	<!-- [ Header ] end -->
	
