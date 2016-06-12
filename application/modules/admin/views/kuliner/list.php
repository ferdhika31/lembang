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
								<a href="<?php echo site_url('admin/kuliner');?>"><?php echo $title;?></a>
							</li>
						</ul>
					</div>
					<!-- END PAGE HEADER-->
					<!-- BEGIN DASHBOARD STATS -->
					<div class="row">
						<div class="col-md-12">

							<div class="row" style="margin-bottom:20px;">
								<div class="col-md-2">
									<a class="btn default green" href="<?php echo site_url('admin/kuliner/add');?>">
										<i class="fa fa-plus"></i> Tambah
									</a>
								</div>
								<div class="col-md-5">
									<form action="<?php echo site_url('admin/kuliner');?>" method="get">
										<div class="input-group">
											<?php echo $stt;?>
											<input class="form-control" value="<?php echo $search;?>" placeholder="Cari berdasarkan nama tempat" name="cari" type="text">
											<span class="input-group-addon">
												<i class="fa fa-search"></i>
											</span>
											
										</div>
									</form>
								</div>
							</div>

							<div class="row" style="margin-bottom:20px;">
								<div class="col-md-6">
									<a href="<?php echo $href_all;?>">
										Semua (<?php echo $jumlahWis[0];?>)
									</a>
									| 
									<a href="<?php echo $href_approve;?>">
										Diterima (<?php echo $jumlahWis[1];?>)
									</a>
									| 
									<a href="<?php echo $href_reject;?>">
										Ditolak (<?php echo $jumlahWis[2];?>)
									</a>
									| 
									<a href="<?php echo $href_wait;?>">
										Menunggu Konfirmasi (<?php echo $jumlahWis[3];?>)
									</a>
								</div>
							</div>
							

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
													<th>Nama Wisata Alam</th>
													<th>Oleh</th>
													<th>Nilai</th>
													<th>Status</th>
													<th>Tanggal Tambah</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody>
											<?php if(empty($dataWisata)): ?>
												<tr>
													<td>Tidak ada data</td>
												</tr>
											<?php else: ?>
												<?php
												$no=1;
												foreach ($dataWisata as $result):
													$temp[] = array(
			                                            'href_delete'   => site_url('admin/kuliner/delete/'.$result['wisata_id'])
			                                        );
												?>
												<tr>
													<td><?php echo $result['no'];?></td>
													<td><?php echo $result['nama_wisata'];?></td>
													<td><?php echo $result['oleh'];?></td>
													<td><?php echo $result['nilai'];?></td>
													<td>
														<?php echo $result['stt'];?>
													</td>
													<td><?php echo $result['date_add'];?></td>
													<td>
														<a href="<?php echo $result['href_edit'];?>" class="btn default btn-xs default">
															<i class="fa fa-edit"></i> Ubah 
														</a>

														<a href="<?php echo $result['href_view'];?>" class="btn default btn-xs blue">
															<i class="fa fa-eye"></i> Lihat 
														</a>

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