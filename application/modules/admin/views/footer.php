		</div>
		<!-- END CONTAINER -->
		<!-- BEGIN FOOTER -->
		<div class="page-footer">
			<div class="page-footer-inner">
				<?php echo $this->config->item('footer');?>
			</div>
			<div class="page-footer-tools">
				<span class="go-top">
					<i class="fa fa-angle-up"></i>
				</span>
			</div>
		</div>
		<!-- END FOOTER -->

		<?php
		if(!empty($add_script)):
			foreach ($add_script as $add_script):
		?>
		<script src="<?php echo $add_script;?>"></script>
		<?php
			endforeach;
		endif;
		?>

		<script src="<?php echo base_url('assets/admin/js/jquery-1.11.0.min.js');?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/admin/plugins/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>

		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script src="<?php echo base_url('assets/admin/global/scripts/metronic.js');?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/admin/admin/layout/scripts/layout.js');?>" type="text/javascript"></script>
		<!-- END PAGE LEVEL SCRIPTS -->

		<script>
			jQuery(document).ready(function() {  
				Metronic.init(); // init metronic core components 
				Layout.init(); // init layout
			});
		</script>
		<script type="text/javascript">
            $('#timepicker').timepicker({
                minuteStep: 1,
                template: false,
                appendWidgetTo: 'body',
                showSeconds: false,
                showMeridian: false,
                defaultTime: 'current'
            });

            var datana;

            datana = [];

            $.get("<?php echo site_url('admin/pesan/getUser');?>", function(data){
            	for(var i=0;i<data.length;i++){
            		datana.push(data[i].username);
            	}
			}, "json" );

            $("#select2_tags").change(function() {
                
            }).select2({
                tags: datana
            });

            
        </script>

		<!-- END JAVASCRIPTS -->
	</body>

<!-- END BODY -->
</html>