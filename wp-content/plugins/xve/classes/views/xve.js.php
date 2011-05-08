<?php if (defined('IN_XVE') !== TRUE) exit(255); ?>

<noscript><h1><?php _e_xve('You may want to activate JavaScript if you want this admin UI to actually do something.') ?></h1></noscript>

<script type="text/javascript">
	xve = {
		
		site_url: '<?php echo get_option('home') ?>',
		
		save_box: function (dom_id) {
			xve.send_request(dom_id, 'checkbox', jQuery('#' + dom_id).attr('checked') ? 1 : 0);
		},
		
		save_text: function (dom_id) {
			console.log('to bind', dom_id);
			jQuery('#' + dom_id).bind("input propertychange", function () {
				console.log('bind', dom_id);
				// If it's the propertychange event, make sure it's the value that changed.
				if (window.event && event.type == "propertychange" && event.propertyName != "value") {
					return;
				}
				
				// Clear any previously set timer before setting a fresh one
				window.clearTimeout(jQuery(this).data("timeout"));
				jQuery(this).data("timeout", setTimeout(function () {
					console.log('send');
					xve.send_request(dom_id, 'text', jQuery('#' + dom_id).val().replace(/[^0-9]/g, ''));
				}, 1000));
			});
		},
		
		send_request: function (dom_id, type, value) {
			jQuery.ajax({
				
				type: 'POST',
				
				url: xve.site_url + '/wp-admin/admin-ajax.php',
				
				data: {
					action: 'xve_save_options',
					config_id: dom_id,
					type: type,
					value: value
				},
				
				dataType: 'json',
				
				success: function (data){
					xve.update_status(data.status, dom_id);
				},
				
				error: function (){
					xve.update_status('fail', dom_id);
				}
				
			});
		},
		
		update_status: function (status, dom_id) {
			
			node = jQuery('#parent_' + dom_id);
			
			switch (status) {
				case 'success':
					node.animate({backgroundColor: '#0F0'}, 500);
					node.animate({backgroundColor: '#FFF'}, 500);
				break;
				
				case 'fail':
					node.animate({backgroundColor: '#F00'}, 500);
				break;
			}
		}
		
	}
</script>
