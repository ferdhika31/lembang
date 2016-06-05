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
								<a href="<?php echo site_url('admin/kuliner');?>">Wisata</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<?php echo $title;?>
							</li>
						</ul>
					</div>
					<!-- END PAGE HEADER-->
					<!-- BEGIN PAGE CONTENT-->
					<div class="row">
						<div class="col-md-12">
							<!-- Begin: life time stats -->
							<div class="portlet box blue-steel">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-flag"></i>Data Wisata <?php echo $title;?>
									</div>
								</div>
								<div class="portlet-body">
									<div class="tabbable-line">
										<ul class="nav nav-tabs">
											<li class="active">
												<a href="#general" data-toggle="tab">
													General
												</a>
											</li>
											<li>
												<a href="#konten" data-toggle="tab">
													Konten
												</a>
											</li>
											<li>
												<a href="#galeri" data-toggle="tab">
													Galeri
												</a>
											</li>
											<li>
												<a href="#nilai" data-toggle="tab">
													Nilai
												</a>
											</li>
											<!-- <li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
												Orders <i class="fa fa-angle-down"></i>
												</a>
												<ul class="dropdown-menu" role="menu">
													<li>
														<a href="#overview_4" tabindex="-1" data-toggle="tab">
														Latest 10 Orders </a>
													</li>
													<li>
														<a href="#overview_4" tabindex="-1" data-toggle="tab">
														Pending Orders </a>
													</li>
												</ul>
											</li> -->
										</ul>
										<div class="tab-content">
											<div class="tab-pane active" id="general">
												<div class="form-body">
													<div class="form-group">
														<label class="control-label">Nama Wisata</label>
														<input type="text" disabled class="form-control" name="nama" value="<?= (!empty($dataWisata['nama_wisata_kuliner']))?$dataWisata['nama_wisata_kuliner']:''; ?>" placeholder="Nama Wisata">
													</div>
													<div class="form-group">
														<label class="control-label">Alamat</label>
														<textarea class="form-control" disabled placeholder="Alamat" name="alamat"><?= (!empty($dataWisata['alamat_wisata_kuliner']))?$dataWisata['alamat_wisata_kuliner']:''; ?></textarea>
													</div>
													<div class="form-group">
														<label class="control-label">Cover Photo</label>
														<br>
														<a data-toggle="modal" href="javascript:;" data-target="#coverImage" class="btn" type="button" id="img-thumbnail" class="img-thumbnail">
		                                    				<img src="<?= (!empty($dataWisata['cover_photo']))?base_url("assets/upload/".$dataWisata['cover_photo']):base_url("assets/upload/cover/default.jpg"); ?>" id="url_foto" height="200" width="500" alt="1" title="" />
		                                    			</a>
													</div>
													<div class="form-group">
														<label class="control-label">Buka Hari</label>
														<?php
															if(!empty($dataWisata['hari'])){
																$array_permisi = unserialize($dataWisata['hari']);	
															}else{
																$array_permisi = array();
															}
														?>
														<br>
														<div class="row">
														<?php
														foreach($array_permisi as $array_permisi):
														?>
															<div class="col-md-1">
																<?php echo ucwords($array_permisi);?>
															</div>
														<?php 
														endforeach;
														?>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label">Jam Buka</label>
														<input class="form-control" disabled type="text" id="buka" name="buka" value="<?php echo (!empty($dataWisata['jam_buka']))?$dataWisata['jam_buka']:'';?>" placeholder="">
													</div>
													<div class="form-group">
														<label class="control-label">Jam Tutup</label>
														<input class="form-control" disabled type="text" id="tutup" name="tutup" value="<?php echo (!empty($dataWisata['jam_tutup']))?$dataWisata['jam_tutup']:'';?>" placeholder="">
													</div>
													<div class="form-group">
														<label class="control-label">Lat</label>
														<input class="form-control" disabled type="text" id="lat" name="lat" value="<?php echo (!empty($dataWisata))?$dataWisata['lat']:'';?>" placeholder="">
													</div>
													<div class="form-group">
														<label class="control-label">Long</label>
														<input class="form-control" disabled type="text" id="lon" name="lon" value="<?php echo (!empty($dataWisata))?$dataWisata['long']:'';?>" placeholder="">
													</div>
													<div class="form-group">
														<label class="control-label">Oleh</label><br>
														<?php echo (!empty($dataWisata))?$dataWisata['nama']:'';?>
													</div>
													<div class="form-group">
														<label class="control-label">Status</label><br>
														<?php
															if($dataWisata['status_kuliner']==1){
																echo "<span class=\"label label-sm label-success\">Diterima</span>";
															}elseif($dataWisata['status_kuliner']==2){
																echo "<span class=\"label label-sm label-danger\">Ditolak</span>";
															}else{
																echo "<span class=\"label label-sm label-warning\">Menunggu Konfirmasi</span>";
															}
														?>
														
													</div>
												</div>
											</div>
											<div class="tab-pane" id="konten">
												<div class="form-body">
													<div class="form-group">
														<label class="control-label">Deskripsi Wisata</label>
														<?php echo (!empty($dataWisata['deskripsi_wisata_kuliner']))?$dataWisata['deskripsi_wisata_kuliner']:'';?>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="galeri">
												<div class="table-responsive">
													<table id="images" class="table table-striped table-hover table-bordered">
														<thead>
														<tr>
															<th class="text-center" style="width: 120px;"><i class="fa fa-picture-o"></i></th>
				                                            <th>Nama Foto</th>
				                                            <th style="width: 30%;">Deskripsi</th>
														</tr>
														</thead>
														<tbody>
														<?php
					                                    $image_row = 0; 
					                                    if(!empty($dataGaleri)):
					                                    	foreach ($dataGaleri as $dataGaleri) :
					                                    		$dataModal[] = $dataGaleri;
					                                    ?>
					                                    	<tr id="image-row<?php echo $image_row; ?>">
					                                    		<td class="text-left">
					                                    			<img src="<?php echo base_url("assets/upload/".$dataGaleri['url_foto']); ?>" id="url_foto<?php echo $image_row; ?>" height="100" width="100" alt="1" title="" />
										                        </td>

										                        <td class="text-right">
										                        	<input type="text" disabled name="foto[<?php echo $image_row; ?>][nama_foto]" value="<?php echo $dataGaleri['nama_foto']; ?>" class="form-control" />
										                        </td>

										                      	<td class="text-right">
										                      		<input type="text" disabled name="foto[<?php echo $image_row; ?>][deskripsi_foto]" value="<?php echo $dataGaleri['deskripsi_foto']; ?>" class="form-control" />
										                      	</td>
										                    </tr>
										                <?php
										                	$image_row++;
										                	endforeach;
										                else:
										                ?>
										            		<tr>
										            			<td colspan="3">Tidak ada foto.</td>
										            		</tr>
										            	<?php
										                endif;
										                ?>
														</tbody>
													</table>
												</div>
											</div>
											<div class="tab-pane" id="nilai">
												<div class="table-responsive">
													<table id="images" class="table table-striped table-hover table-bordered">
														<thead>
														<tr>
															<th>Oleh</th>
				                                            <th>Nilai</th>
				                                            <th>Pada</th>
														</tr>
														</thead>
														<tbody>
														<?php
					                                    if(!empty($dataRating)):
					                                    	foreach ($dataRating as $dataRating) :
					                                    ?>
					                                    	<tr>
					                                    		<td class="text-left">
					                                    			<?php echo $dataRating['oleh'];?>
										                        </td>

										                        <td class="text-center">
										                        	<?php echo $dataRating['nilai'];?>
										                        </td>

										                      	<td class="text-left">
										                      		<?php echo $dataRating['tanggal'];?>
										                      	</td>
										                    </tr>
										                <?php
										                	endforeach;
										                else:
										                ?>
										            		<tr>
										            			<td colspan="3">Tidak ada rating.</td>
										            		</tr>
										            	<?php
										                endif;
										                ?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
										
										</div>
										<div class="form-actions">
											<a class="btn blue" href="<?php echo site_url('admin/kuliner/edit/'.$this->uri->segment(4));?>">
												Ubah Data
											</a>

											<a class="btn green" href="<?php echo site_url('admin/kuliner/status?type=approve&id='.$this->uri->segment(4));?>">
												Terima
											</a>
											<a class="btn red" href="<?php echo site_url('admin/kuliner/status?type=reject&id='.$this->uri->segment(4));?>">
												Tolak
											</a>

										</div>
									</div>
								</div>
							</div>
							<!-- End: life time stats -->
						</div>
					</div>
					<!-- END PAGE CONTENT-->
				</div>
			</div>
			<!-- END CONTENT -->