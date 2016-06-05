		<!--BEGIN CONTAINER -->
		<div class="page-container">
			<!-- BEGIN SIDEBAR -->
			<div class="page-sidebar-wrapper">
				<div class="page-sidebar navbar-collapse collapse">
					<!-- BEGIN SIDEBAR MENU -->
					<ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
						<li class="sidebar-search-wrapper">
							<form class="sidebar-search ">
							</form>
						</li>
						<li class="start <?php echo ($menu=='dashboard')? 'active open': '';?>">
							<a href="<?php echo site_url('admin');?>">
								<i class="fa fa-dashboard"></i>
								<span class="title">Dashboard</span>
								<span class="selected"></span>
							</a>
						</li>
						<li class="last <?php echo ($menu=='wisata')? 'active open': '';?>">
							<a href="javascript:;">
								<i class="fa fa-flag"></i>
								<span class="title">Wisata Alam</span>
								<span class="arrow"></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="<?php echo site_url('admin/wisata');?>">
										Semua Wisata Alam
									</a>
								</li>
								<li>
									<a href="<?php echo site_url('admin/wisata/add');?>">
										Tambah Baru
									</a>
								</li>
								<li>
									<a href="<?php echo site_url('admin/wisata/comment');?>">
										Komentar
									</a>
								</li>
							</ul>
						</li>
						<li class="last <?php echo ($menu=='kuliner')? 'active open': '';?>">
							<a href="javascript:;">
								<i class="fa fa-cutlery"></i>
								<span class="title">Wisata Kuliner</span>
								<span class="arrow"></span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="<?php echo site_url('admin/kuliner');?>">
										Semua Wisata Kuliner
									</a>
								</li>
								<li>
									<a href="<?php echo site_url('admin/kuliner/add');?>">
										Tambah Baru
									</a>
								</li>
								<li>
									<a href="<?php echo site_url('admin/kuliner/comment');?>">
										Komentar
									</a>
								</li>
							</ul>
						</li>
						<li <?php echo ($menu=='pesan')? 'class="active open"': '';?>>
							<a href="<?php echo site_url('admin/pesan');?>">
								<i class="fa fa-inbox"></i>
								<span class="title">Pesan</span>
								<span class="selected"></span>
							</a>
						</li>
					</ul>
				<!-- END SIDEBAR MENU -->
				</div>
			</div>
			<!-- END SIDEBAR -->