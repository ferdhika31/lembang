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
									<a href="<?php echo site_url('admin');?>">Beranda</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo site_url('admin/wisata');?>"><?php echo $title;?></a>
							</li>
						</ul>
					</div>
					<!-- END PAGE HEADER-->
					<!-- BEGIN DASHBOARD STATS -->
					<div class="row">
						<div class="col-md-12">

							<?php echo $notif;?>

							<!-- BEGIN SAMPLE TABLE PORTLET-->
							<div class="portlet box red">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-flag"></i><?php echo $title;?>
									</div>
									<!-- <div class="tools">
										
									</div> -->
								</div>

								<div class="portlet-body">
									<div class="table-scrollable">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th>#</th>
													<th>Oleh</th>
													<th>Komentar</th>
													<th>Pada Wisata</th>
													<th>Tanggal Tambah</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
											<?php if(empty($dataKomentar)): ?>
												<tr>
													<td>Tidak ada komentar</td>
												</tr>
											<?php else: ?>
												<?php
												$no=1;
												foreach ($dataKomentar as $result):
													$temp[] = array(
			                                            'href_delete'   => site_url('admin/wisata/comment?delete='.$result['komentar_id'])
			                                        );
												?>
												<tr>
													<td><?php echo $result['no'];?></td>
													<td><?php echo $result['oleh'];?></td>
													<td><?php echo $result['komentar'];?></td>
													<td>
														<a href="<?php echo $result['href_wisata'];?>">
															<?php echo $result['nama_wisata'];?>
														</a>
													</td>
													<td><?php echo $result['date_add'];?></td>
													<td>
														<a data-toggle="modal" data-target="#hapus<?php echo $no;?>" class="btn default btn-xs red">
															<i class="fa fa-times"></i> Hapus 
														</a>
													</td>
												</tr>
												<?php 
												$no++;
												endforeach;
												?>
											<?php endif; ?>
											</tbody>
										</table>
									</div>
									<?php echo $halaman;?>
								</div>	
								<div style='color:#fff; margin:2px;'>
									<?php echo $total;?>				
								</div>				
							</div>
						<!-- END SAMPLE TABLE PORTLET-->
						</div>
					</div>
					<!-- END DASHBOARD STATS -->
					<div class="clearfix">
					</div>
				</div>
			</div>
			<!-- END CONTENT -->

<?php
if(!empty($temp)):
	$no=1;
	foreach ($temp as $tmp):
?>

<div class="modal fade bs-modal-sm" id="hapus<?php echo $no;?>" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Konfirmasi</h4>
			</div>
			<div class="modal-body">
				Apakah benar data akan dihapus?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal">Close</button>
				<a class="btn red" href="<?= $tmp['href_delete']; ?>">Delete</a>
			</div>
		</div>
	</div>
</div>

<?php
	$no++;
	endforeach;
endif;
?>