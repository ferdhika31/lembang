			<!-- BEGIN CONTENT -->
			<div class="page-content-wrapper">
				<div class="page-content">
					<!-- BEGIN PAGE HEADER-->
					<h3 class="page-title">
						<?php echo $title;?> <small><?php echo $description;?></small>
					</h3>
					<div class="page-bar">
						<ul class="page-breadcrumb">
							<li>
								<i class="fa fa-home"></i>
									<a href="<?php echo site_url('admin');?>">Home</a>
									<i class="fa fa-angle-right"></i>
								</li>
							<li>
								<a href="<?php echo site_url('admin');?>"><?php echo $title;?></a>
							</li>
						</ul>
					</div>
					<!-- END PAGE HEADER-->
					<!-- BEGIN DASHBOARD STATS -->
					<div class="row">
						<!-- Dashboard admin -->
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="dashboard-stat blue-madison">
								<div class="visual">
									<i class="fa fa-user"></i>
								</div>
								<div class="details">
									<div class="number">
										3
									</div>
									<div class="desc">
										Pengguna
									</div>
								</div>
								<a class="more" href="<?php echo site_url('admin/user');?>">
									View more <i class="m-icon-swapright m-icon-white"></i>
								</a>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="dashboard-stat red-intense">
								<div class="visual">
									<i class="fa fa-plane"></i>
								</div>
								<div class="details">
									<div class="number">
										3
									</div>
									<div class="desc">
										Pesawat
									</div>
								</div>
								<a class="more" href="<?php echo site_url('admin/pesawat');?>">
									View more <i class="m-icon-swapright m-icon-white"></i>
								</a>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="dashboard-stat green-haze">
								<div class="visual">
									<i class="fa fa-inbox"></i>
								</div>
								<div class="details">
									<div class="number">
										2
									</div>
									<div class="desc">
										Pesan
									</div>
								</div>
								<a class="more" href="<?php echo site_url('admin/pesan');?>">
									View more <i class="m-icon-swapright m-icon-white"></i>
								</a>
							</div>
						</div>
					</div>
					
					
					<!-- END DASHBOARD STATS -->
					<div class="clearfix">
					</div>
				</div>
			</div>
			<!-- END CONTENT -->
