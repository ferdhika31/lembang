			<script>
            tinymce.init({
                selector: "textarea#deskripsi",
                theme: "modern",
                // width: 850,
                height: 300,
                relative_urls : false,
                remove_script_host: false,
                plugins: [
                     "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                     "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                     "save table contextmenu directionality emoticons template paste textcolor"
               ],
               content_css: "css/content.css",
               toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
               style_formats: [
                    {title: "Bold text", inline: "b"},
                    {title: "Red text", inline: "span", styles: {color: "#ff0000"}},
                    {title: "Red header", block: "h1", styles: {color: "#ff0000"}},
                    {title: "Example 1", inline: "span", classes: "example1"},
                    {title: "Example 2", inline: "span", classes: "example2"},
                    {title: "Table styles"},
                    {title: "Table row 1", selector: "tr", classes: "tablerow1"}
                ],
                external_filemanager_path:"<?php echo base_url('assets/filemanager');?>/",
                filemanager_title:"Responsive Filemanager" ,
                filemanager_access_key:"dikaGanteng",
                external_plugins: { "filemanager" : "<?php echo base_url('assets/filemanager/plugin.min.js');?>" }
             }); 
            </script>

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
								<a href="<?php echo site_url('admin/wisata');?>">Wisata</a>
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
							<?php echo $notif;?>
							
							<!-- Begin: life time stats -->
							<div class="portlet box blue-steel">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-flag"></i>Data Wisata
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
										<form action="" method="post">
										<div class="tab-content">
											<div class="tab-pane active" id="general">
												<div class="form-body">
													<div class="form-group">
														<label class="control-label">Nama Wisata</label>
														<input type="text" class="form-control" name="nama" value="<?= (!empty($dataWisata['nama_wisata_kuliner']))?$dataWisata['nama_wisata_kuliner']:''; ?>" placeholder="Nama Wisata">
													</div>
													<div class="form-group">
														<label class="control-label">Alamat</label>
														<textarea class="form-control" placeholder="Alamat" name="alamat"><?= (!empty($dataWisata['alamat_wisata_kuliner']))?$dataWisata['alamat_wisata_kuliner']:''; ?></textarea>
													</div>
													<div class="form-group">
														<label class="control-label">Cover Photo</label>
														<br>
														<a data-toggle="modal" href="javascript:;" data-target="#coverImage" class="btn" type="button" id="img-thumbnail" class="img-thumbnail">
		                                    				<img src="<?= (!empty($dataWisata['cover_photo']))?base_url("assets/upload/".$dataWisata['cover_photo']):base_url("assets/upload/cover/default.jpg"); ?>" id="url_foto" height="200" width="500" alt="1" title="" />
		                                    			</a>
		                                    			<input type="hidden" id="url_fotourl_foto" name="cover" value="<?= (!empty($dataWisata['cover_photo']))?$dataWisata['cover_photo']:'cover/default.jpg'; ?>">
		                                    			<button type="button" data-toggle="modal" data-target="#coverImage" class="btn btn-primary">Pilih Cover</button>
		                                    			<button type="button" onclick="hapusCover();" title="" class="btn btn-primary">Hapus Cover</button>
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
															<div class="col-md-1">
																<input name="hari[]" value="senin"<?php echo (in_array("senin",$array_permisi))?' checked':''; ?> type="checkbox"> Senin
															</div>
															<div class="col-md-1">
																<input name="hari[]" value="selasa"<?php echo (in_array("selasa",$array_permisi))?' checked':''; ?> type="checkbox"> Selasa
															</div>
															<div class="col-md-1">
																<input name="hari[]" value="rabu"<?php echo (in_array("rabu",$array_permisi))?' checked':''; ?> type="checkbox"> Rabu
															</div>
															<div class="col-md-1">
																<input name="hari[]" value="kamis"<?php echo (in_array("kamis",$array_permisi))?' checked':''; ?> type="checkbox"> Kamis
															</div>
															<div class="col-md-1">
																<input name="hari[]" value="jumat"<?php echo (in_array("jumat",$array_permisi))?' checked':''; ?> type="checkbox"> Jumat
															</div>
															<div class="col-md-1">
																<input name="hari[]" value="sabtu"<?php echo (in_array("sabtu",$array_permisi))?' checked':''; ?> type="checkbox"> Sabtu
															</div>
															<div class="col-md-2">
																<input name="hari[]" value="minggu"<?php echo (in_array("minggu",$array_permisi))?' checked':''; ?> type="checkbox"> Minggu
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label">Jam Buka</label>
														<input class="form-control" type="text" id="buka" name="buka" value="<?php echo (!empty($dataWisata['jam_buka']))?$dataWisata['jam_buka']:'';?>" placeholder="">
													</div>
													<div class="form-group">
														<label class="control-label">Jam Tutup</label>
														<input class="form-control" type="text" id="tutup" name="tutup" value="<?php echo (!empty($dataWisata['jam_tutup']))?$dataWisata['jam_tutup']:'';?>" placeholder="">
													</div>
													<div class="form-group">
														<label class="control-label">Lat</label>
														<input class="form-control" type="text" id="lat" name="lat" value="<?php echo (!empty($dataWisata))?$dataWisata['lat']:'';?>" placeholder="">
													</div>
													<div class="form-group">
														<label class="control-label">Long</label>
														<input class="form-control" type="text" id="lon" name="lon" value="<?php echo (!empty($dataWisata))?$dataWisata['long']:'';?>" placeholder="">
													</div>
													<div class="form-group">
														<label class="control-label">Status</label>
														<select class="form-control" id="status" name="status" size="1">
															<?php
																if($dataWisata['status_wisata']==1){
																	$s1 = ' selected';
																	$s2 = '';
																	$s3 = '';
																}elseif($dataWisata['status_wisata']==2){
																	$s1 = '';
																	$s2 = ' selected';
																	$s3 = '';
																}else{
																	$s1 = '';
																	$s2 = '';
																	$s3 = ' selected';
																}
															?>
															<option<?php echo $s1;?> value="1">Terima</option>
															<option<?php echo $s2;?> value="2">Tolak</option>
															<option<?php echo $s3;?> value="3">Menunggu</option>
														</select>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="konten">
												<div class="form-body">
													<div class="form-group">
														<label class="control-label">Deskripsi Wisata</label>
														<textarea class="form-control" id="deskripsi" name="deskripsi"><?php echo (!empty($dataWisata['deskripsi_wisata_kuliner']))?$dataWisata['deskripsi_wisata_kuliner']:'';?></textarea>
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
				                                            <th class="text-center" style="width: 100px;">Actions</th>
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
					                                    			<a data-toggle="modal" href="javascript:;" data-target="#myModal<?php echo $image_row; ?>" class="btn" type="button" id="thumb-image0" class="img-thumbnail">
					                                    				<img src="<?php echo base_url("assets/upload/".$dataGaleri['url_foto']); ?>" id="url_foto<?php echo $image_row; ?>" height="100" width="100" alt="1" title="" />
					                                    			</a>
					                                    			<input type="hidden" id="url_foto<?php echo $image_row; ?>url_foto<?php echo $image_row; ?>" name="foto[<?php echo $image_row; ?>][url_foto]" value="<?php echo $dataGaleri['url_foto']; ?>">
										                        </td>

										                        <td class="text-right">
										                        	<input type="text" name="foto[<?php echo $image_row; ?>][nama_foto]" value="<?php echo $dataGaleri['nama_foto']; ?>" class="form-control" />
										                        </td>

										                      	<td class="text-right">
										                      		<input type="text" name="foto[<?php echo $image_row; ?>][deskripsi_foto]" value="<?php echo $dataGaleri['deskripsi_foto']; ?>" class="form-control" />
										                      	</td>
										                      
										                      	<td class="text-left">
										                      		<button type="button" onclick="$('#image-row<?php echo $image_row; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger">
										                      			<i class="fa fa-minus-circle"></i>
										                      		</button>
										                      	</td>
										                    </tr>
										                <?php
										                	$image_row++;
										                	endforeach;
										                endif;
										                ?>
														</tbody>
														<tfoot>
					                                    	<tr>
					                                    		<td colspan="3">
					                                    		</td>
					                                        	<td class="text-left">
					                                        		<button data-original-title="Add Image" type="button" onclick="addImage();" data-toggle="tooltip" title="" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
					                                        	</td>
					                                        </tr>
					                                    </tfoot>
													</table>
												</div>
											</div>
										</div>
										<div class="form-actions">
											<input type="submit" class="btn green" name="kirim" value="Kirim">
										</div>
										</form>
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

		<!-- Modal image cover -->
		<div class="modal fade" id="coverImage" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="bootbox-close-button close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">Pilih Gambar</h4>
					</div>
					<div class="modal-body">
						<iframe width="560" height="400" src="<?php echo base_url('assets');?>/filemanager/dialog.php?type=2&amp;field_id=url_foto&amp;relative_url=1&amp;akey=dikaGanteng" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn default" data-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>

		<div id="modalna">
        	<?php
        	if(!empty($dataModal)):
        		$modal=0;
        		foreach ($dataModal as $dataModal):
        	?>

        	<div class="modal fade" id="myModal<?php echo $modal;?>" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="bootbox-close-button close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">Pilih Gambar</h4>
						</div>
						<div class="modal-body">
							<iframe width="560" height="400" src="<?php echo base_url('assets');?>/filemanager/dialog.php?type=2&amp;field_id=url_foto&amp;relative_url=1&amp;akey=dikaGanteng" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn default" data-dismiss="modal">Tutup</button>
						</div>
					</div>
				</div>
			</div>

	        <?php
	        	$modal++;
	        	endforeach;
	        endif;
	        ?>
        </div>

<script type="text/javascript">
var image_row = <?php echo $image_row;?>;

function addImage() {
	console.log("nambah");
	html  = '<tr id="image-row' + image_row + '">';
	html += '  <td class="text-left"><a data-toggle="modal" href="javascript:;" data-target="#myModal' + image_row + '" class="img-thumbnail"><img src="<?php echo base_url("assets/upload/default.png"); ?>" name="foto[' + image_row + '][url_foto]" id="url_foto' + image_row + '" alt="" height="100" width="100" title="" /><input type="hidden" id="url_foto' + image_row + 'url_foto' + image_row + '" name="foto[' + image_row + '][url_foto]" value="default.png"></td>';
	html += '  <td class="text-right"><input type="text" name="foto[' + image_row + '][nama_foto]" value="" placeholder="Judul" class="form-control" /></td>';
  	html += '  <td class="text-right"><textarea class="form-control" name="foto[' + image_row + '][deskripsi_foto]" placeholder="Deskripsi"></textarea></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	html += '</tr>';
	
	$('#images tbody').append(html);

	html2	 = '<div class="modal fade" id="myModal' + image_row + '" tabindex="-1" role="dialog" aria-hidden="true">';
	html2	+= '<div class="modal-dialog">';
	html2	+= '	<div class="modal-content">'
	html2	+= '         <div class="block block-themed block-transparent remove-margin-b">';
	html2	+= '            <div class="block-header bg-primary-dark">';
	html2	+= '                <ul class="block-options">';
	html2	+= '                    <li>';
	html2	+= '                        <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>';
	html2	+= '                    </li>';
	html2	+= '                </ul>';
	html2	+= '                <h3 class="block-title">Pilih Gambar</h3>';
	html2	+= '            </div>';
	html2	+= '            <div class="block-content">';
	html2	+= '                <iframe width="560" height="400" src="<?php echo base_url('assets');?>/filemanager/dialog.php?type=2&amp;field_id=url_foto' + image_row + '&amp;relative_url=1&amp;akey=dikaGanteng" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>';
	html2	+= '            </div>';
	html2	+= '			<div class="modal-footer">';
	html2	+= '				<button type="button" class="btn default" data-dismiss="modal">Tutup</button>';
	html2	+= '			</div>';
	html2	+= '        </div>';
	html2	+= '    </div>';
	html2	+= '</div>';
	html2	+= '</div>';

	$('#modalna').append(html2);
	
	image_row++;
}

</script> 

<script>
	function hapusCover(){
		console.log('Hapus foto');
		$('#url_fotourl_foto').val('cover/default.jpg');
		$('#url_foto').attr('src','<?php echo base_url("assets/upload/cover/default.jpg"); ?>');
		$('#img-thumbnail').attr('src','<?php echo base_url("assets/upload/cover/default.jpg"); ?>');
	}

	function responsive_filemanager_callback(field_id){
		var url=jQuery('#'+field_id).val();

		console.log(field_id+" "+url);
		// alert('update '+field_id+" with "+url);
		// jQuery('#url_foto').val('<?php echo base_url('assets/upload');?>/'+url);
		//your code
		jQuery('#'+field_id+field_id).val(url);
		jQuery('#'+field_id).attr('src','<?php echo base_url('assets/upload');?>/'+url);
	}

	jQuery(document).ready(
		function() {  
			console.log("adw");
			jQuery("html").niceScroll({cursorcolor:"#282828"});
		}
	);
</script>