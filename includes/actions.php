<?php
	//SEND INQUIRY EMAIL
	add_action('wp_ajax_sendmail', 'sendmail');
	add_action('wp_ajax_nopriv_sendmail', 'sendmail');
	function sendmail() {
		global $woocommerce;
		$product = new WC_Product_Factory();
		$_product = $product->get_product($_POST['id_product']);
		$product_url = get_permalink( $_POST['id_product'] );
		$product_title= get_the_title( $_POST['id_product'] );
		$product_name =(isset($_POST['inquiry_pname']) ? $_POST['inquiry_pname'] : __("No Product Name",EXTRA_WOO_TABS_TEXTDOMAN));
		
		//user posted variables
		(isset($_POST['inquiry_name']) ? $name=$_POST['inquiry_name'] : $name=__( 'No Name' , EXTRA_WOO_TABS_TEXTDOMAN));
		(isset($_POST['inquiry_email']) ? $email=$_POST['inquiry_email'] : $email=__( 'No Email' , EXTRA_WOO_TABS_TEXTDOMAN ));
		
		(isset($_POST['inquiry_website']) ? $website=$_POST['inquiry_website'] : $website=__( 'No Website' , EXTRA_WOO_TABS_TEXTDOMAN ));
		(isset($_POST['inquiry_address']) ? $address=$_POST['inquiry_address'] : $address=__( 'No Address' , EXTRA_WOO_TABS_TEXTDOMAN ));
		(isset($_POST['inquiry_description']) ? $description=$_POST['inquiry_description'] : $description=__( 'No Description' , EXTRA_WOO_TABS_TEXTDOMAN ));
		
		//php mailer variables
		$to = get_option('admin_email');
	
		$subject = __( 'Quotation Request from ' , EXTRA_WOO_TABS_TEXTDOMAN ). $name;
		$headers = __('From: ',EXTRA_WOO_TABS_TEXTDOMAN). $email . "\r\n" .
		'Reply-To: ' . $email . "\r\n";
		
		$html='
			<table style="border-collapse:collapse;background-repeat:repeat;background-color:#e6e6e6" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td style="padding-top:30px;padding-bottom:30px">
							<table style="border-collapse:collapse" align="center" bgcolor="#ffffff" cellpadding="0" cellspacing="0" width="600">                
								<tbody>
									<tr>
										<td style="padding-right:30px;padding-left:30px;color:#777;padding-top: 35px;
padding-bottom: 35px;width:25%;font-weight: bold;">
											'.__( 'Product Name' , EXTRA_WOO_TABS_TEXTDOMAN).' 
										</td>
										<td colspan="2" style="padding-right:30px;padding-left:30px;color:#777"><strong>'. $product_name .'</strong>
										</td>
									</tr>
									<tr>
										<td style="padding-right:30px;padding-left:30px;color:#777;padding-bottom:20px;width:25%;font-weight: bold;">
											'.__( 'Link' , EXTRA_WOO_TABS_TEXTDOMAN).' 
										</td>
										<td colspan="2" style="padding-right:30px;padding-left:30px;color:#777">'. $product_url .'
										</td>
									</tr>
									<tr>
										<td style="padding-right:30px;padding-left:30px;color:#777;padding-bottom:20px;width:25%;font-weight: bold;">
											'.__( 'Name' , EXTRA_WOO_TABS_TEXTDOMAN).' 
										</td>
										<td colspan="2" style="padding-right:30px;padding-left:30px;color:#777">'. $name .'
										</td>
									</tr>
									<tr>
										<td style="padding-right:30px;padding-left:30px;color:#777;padding-bottom:20px;width:25%;font-weight: bold;">
											'.__( 'Email' , EXTRA_WOO_TABS_TEXTDOMAN).' 
										</td>
										<td colspan="2" style="padding-right:30px;padding-left:30px;color:#777">
											'. $email .'
										</td>
									</tr>
									<tr>
										<td style="padding-right:30px;padding-left:30px;color:#777;padding-bottom:20px;width:25%;font-weight: bold;">
											'.__( 'Website' , EXTRA_WOO_TABS_TEXTDOMAN).'
										</td>
										<td colspan="2" style="padding-right:30px;padding-left:30px;color:#777">
											'. $website .'
										</td>
									</tr>
									<tr>
										<td style="padding-right:30px;padding-left:30px;color:#777;padding-bottom:20px;width:25%;font-weight: bold;">
											'.__( 'Address' , EXTRA_WOO_TABS_TEXTDOMAN).'
										</td>
										<td colspan="2" style="padding-right:30px;padding-left:30px;color:#777">
											'. $address .'
										</td>
									</tr>
									<tr>
										<td style="padding-right:30px;padding-left:30px;color:#777;padding-bottom:30px;width:25%;font-weight: bold;vertical-align:top">
											'.__( 'Description' , EXTRA_WOO_TABS_TEXTDOMAN).'
										</td>
										<td colspan="2" style="padding-right:30px;padding-left:30px;color:#777;padding-bottom: 35px;">
											'. $description .'
										</td>
									</tr>
								</tbody>
						</table>
					</td>
				</tr>
			</tbody></table>
			';
		
		
		$message = '<div style="background:#CCC;width:500px;height:500px">'. __( 'From: ' , EXTRA_WOO_TABS_TEXTDOMAN ). $name . "\r\n";
		$message .= __( 'For Product Name : ' , EXTRA_WOO_TABS_TEXTDOMAN ). $product_name. "\r\n";
		$message .= __( 'Email: ' , EXTRA_WOO_TABS_TEXTDOMAN ) . $email . "\r\n";
		$message .= __( 'address: ' , EXTRA_WOO_TABS_TEXTDOMAN ) . $address . "\r\n\n";
		$message .= $description . "\r\n". "</div>";
		
		$nameErr = $emailErr = "";
		
		if (isset($_POST['post_hidden'])) {
		
		  if (empty($name)) {
			$nameErr = __( "Name is required!" , EXTRA_WOO_TABS_TEXTDOMAN );
		  }
		  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = __( "Enter Correct Email!" , EXTRA_WOO_TABS_TEXTDOMAN );
		  }
		  if (empty($nameErr) && empty($emailErr)) {
			add_filter( 'wp_mail_content_type', 'set_html_content_type' );  
			$sent = wp_mail($to, $subject, $html, $headers);
			remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
		  }
		
		} 
		
		if (isset($sent) && count($sent)) {
		  echo "<h3 style='color:#060'>".__( 'Thanks for the quote request!' , EXTRA_WOO_TABS_TEXTDOMAN )."</h3>";
		} 
		else
			echo "<span style='color:red'><h3>".__( 'Error, Please Try Again!' , EXTRA_WOO_TABS_TEXTDOMAN )."</h3><br />".$nameErr.'<br />'.$emailErr.'</span>';
		exit();	
	}
	function set_html_content_type() {
	
		return 'text/html';
	}
	
	
  	//ADD REPEATABLE TEXT EDITOR
	add_action('admin_print_footer_scripts', '_hc_tinymce_footer_scripts');
	function _hc_tinymce_footer_scripts() {
		?>
		<style>
			.wp-media-buttons {float: left;}
			.mceIframeContainer {background: #fff;}
			.widget-content .wp-editor-wrap {margin-bottom: 15px;}
		</style>
		<script>
			(function($){

				// parse $_GET params from url
				function getQueryParams(qs) {
					qs = qs.split("+").join(" ");
					var params = {},
						tokens,
						re = /[?&]?([^=]+)=([^&]*)/g;
					while (tokens = re.exec(qs)) {
						params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
					}
					return params;
				}

				// on every ajax call reinit tinyMCE
				$(document).ajaxSuccess(function(evt, request, settings) {
					if (!settings.data) return;

					var $_GET = getQueryParams(settings.data);

					// new widget added
					if ($_GET['widget-id'] && !$_GET['delete_widget']) {
						var widget_id = 'widget-' + $_GET['widget-id'] + '-text';
						hc_tinymce_init(widget_id,['blabla','lll']);
					}

					// reordering widgets
					if ($_GET.action == 'widgets-order') {
						for (var prop in $_GET) {
							if (prop.indexOf('sidebars') === 0) {
								var widgets = $_GET[prop].split(',');
								if (widgets.length > 0) {
									for (var i in widgets) {
										var widget = widgets[i].replace(/widget-\d+_/, '');
										if (widget.indexOf('hc_text-') === 0) {
											hc_tinymce_init('widget-' + widget + '-text');
										}
									}
								}
							}
						}
					}
				});

			})(jQuery);
		</script>
		<?php
	}

	/**
	 * Dynamic TinyMCE
	 */
	if (!function_exists('hc_tinymce')) {
		function hc_tinymce($args) {
			?>
            <div id="target-div">
                <div id="wp-<?php echo $args['id']; ?>-wrap" class="wp-core-ui wp-editor-wrap tmce-active has-dfw">
                    <?php wp_print_styles('editor-buttons'); ?>
                    <div id="wp-<?php echo $args['id']; ?>-editor-tools" class="wp-editor-tools hide-if-no-js">
                        <div id="wp-<?php echo $args['id']; ?>-media-buttons" class="wp-media-buttons">
                            <?php do_action('media_buttons', $args['id']); ?>
                        </div>
                        <div class="wp-editor-tabs">
                            <a id="<?php echo $args['id']; ?>-html" class="wp-switch-editor switch-html" onclick="switchEditors.switchto(this);"><?php _e('Text',EXTRA_WOO_TABS_TEXTDOMAN);?></a>
                            <a id="<?php echo $args['id']; ?>-tmce" class="wp-switch-editor switch-tmce" onclick="switchEditors.switchto(this);"><?php _e('Visual',EXTRA_WOO_TABS_TEXTDOMAN);?></a>
                        </div>
                    </div>
                    <?php
                    $the_editor = apply_filters('the_editor', '<div id="wp-' . $args['id'] . '-editor-container" class="wp-editor-container"><textarea class="wp-editor-area tinymce-custom-field widefat '.$args['class'].'" rows="'.(isset($args['rows']) ? $args['rows'] : 10).'" cols="40" name="' . $args['name'] . '" id="' . $args['id'] . '">%s</textarea></div>');
                    $content = apply_filters('the_editor_content', $args['value']);
                    printf($the_editor, $content);
                    ?>
                </div>
               
                <script>hc_tinymce_init('<?php echo $args['id']; ?>');</script> 
            </div>
			<?php
		}
		add_action('admin_footer', '_hc_dummy_editor');
		function _hc_dummy_editor() { ?>
			<div class="tinymce-dummy" style="display:none">
				<?php wp_editor('', 'hc-dummy-editor', array(
					'textarea_name' => 'tinymce-dummy',
					'media_buttons' => true
				)); ?>
			</div>
			<?php
		}
		add_action('admin_head', '_hc_tinymce_script');
		function _hc_tinymce_script() { ?>
			<script>
				// call tinymce on textarea
				function hc_tinymce_init(editor_id, ignore_ids) {

					// check if DOM loaded
					if (typeof tinymce === 'undefined') {
						jQuery(document).ready(function(){
							hc_tinymce_init(editor_id);
						});
						return;
					}

					// remove editor if already exist
					if (tinymce.majorVersion == 4) {
						tinyMCE.execCommand("mceRemoveEditor", false, editor_id);
					} else {
						tinyMCE.execCommand("mceRemoveControl", false, editor_id);
					}

					// remove quick tags
					jQuery('#' + editor_id).parent().find('.quicktags-toolbar').remove();

					var ignore = ['hc-dummy-editor', 'widget-hc_text-__i__-text'],
						dummy = 'hc-dummy-editor';

					if (typeof ignore_ids != 'undefined') {
						if (jQuery.isArray(ignore_ids)) {
							ignore = ignore.concat(ignore_ids);
						} else {
							ignore.push(ignore_ids);
						}
					}

					// copy mce init
					var tinyMCENewInit = tinyMCEPreInit;

					var mceInit = jQuery.extend(true, {}, tinyMCEPreInit['mceInit'][dummy]),
						qtInit = jQuery.extend(true, {}, tinyMCEPreInit['qtInit'][dummy]);

					tinyMCENewInit['mceInit'] = {};
					tinyMCENewInit['mceInit'][editor_id] = mceInit;
					tinyMCEPreInit['mceInit'][dummy] = mceInit;
					tinyMCENewInit['mceInit'][editor_id]['elements'] = editor_id; // tinyMCE 3
					tinyMCENewInit['mceInit'][editor_id]['selector'] = '#'+editor_id; // tinyMCE 4

					tinyMCENewInit['qtInit'] = {};
					tinyMCENewInit['qtInit'][editor_id] = qtInit;
					tinyMCENewInit['qtInit'][dummy] = qtInit;
					tinyMCENewInit['qtInit'][editor_id]['id'] = editor_id;

					if (tinymce.majorVersion == 4) {

						(function(){
							var init, edId, qtId, firstInit, wrapper;

							var editorEvent = function(e) {
								jQuery('#' + this.id).val(this.getContent());
							}

							if (typeof tinymce !== 'undefined') {

								for (edId in tinyMCENewInit.mceInit) {

									if (jQuery.inArray(edId, ignore) > -1) continue;

									jQuery('#wp-' + edId + '-wrap').on('click.wp-editor', function() {
										if (this.id) {
											window.wpActiveEditor = this.id.slice(3, -5);
										}
									});

									// copy ttext from editor to textarea
									tinyMCENewInit.mceInit[edId]['setup'] = function(ed) {
										ed.on('keyup', editorEvent);
										ed.on('ExecCommand', editorEvent);
									};

									if (firstInit) {
										init = tinyMCENewInit.mceInit[edId] = tinymce.extend({}, firstInit, tinyMCENewInit.mceInit[edId]);
									} else {
										init = firstInit = tinyMCENewInit.mceInit[edId];
									}

									wrapper = tinymce.DOM.select('#wp-' + edId + '-wrap')[0];

									if ((tinymce.DOM.hasClass(wrapper, 'tmce-active') || !tinyMCENewInit.qtInit.hasOwnProperty(edId)) && !init.wp_skip_init) {

										try {
											tinymce.init(init);

											if (!window.wpActiveEditor) {
												window.wpActiveEditor = edId;
											}
										} catch(e){}
									}
								}
							}

							if (typeof quicktags !== 'undefined') {
								for (qtId in tinyMCENewInit.qtInit) {

									if (jQuery.inArray(qtId, ignore) > -1) continue;

									try {
										quicktags(tinyMCENewInit.qtInit[qtId]);

										if (! window.wpActiveEditor) {
											window.wpActiveEditor = qtId;
										}
									} catch(e){};

									// init buttons
									QTags._buttonsInit();
								}
							}
						}());

					} else { // tinyMCE 3

						(function(){
							var edId, qtId, DOM, el, i, mce = 0;

							var editorEvent = function(ed) {
								jQuery('#' + ed.id).val(tinyMCE.get(ed.id).getContent());
							}

							if (typeof tinymce == 'object') {
								DOM = tinymce.DOM;
								// mark wp_theme/ui.css as loaded
								DOM.files[tinymce.baseURI.getURI() + '/themes/advanced/skins/wp_theme/ui.css'] = true;

								for (edId in tinyMCENewInit.mceInit) {

									if (jQuery.inArray(edId, ignore) > -1) continue;

									DOM.events.add(DOM.select('#wp-' + edId + '-wrap'), 'mousedown', function(e){
										if (this.id) {
											wpActiveEditor = this.id.slice(3, -5);
										}
									});

									// copy ttext from editor to textarea
									tinyMCENewInit.mceInit[edId]['setup'] = function(ed) {
										ed.onKeyUp.add(editorEvent);
										ed.onExecCommand.add(editorEvent);
									};

									if (mce)
										try {
											tinymce.init(tinyMCENewInit.mceInit[edId])
										} catch(e){}
								}
							} else {
								if (tinyMCENewInit.qtInit) {
									for (i in tinyMCENewInit.qtInit) {
										el = tinyMCENewInit.qtInit[i].id;
										if (el) {
											document.getElementById('wp-'+el+'-wrap').onmousedown = function(){
												wpActiveEditor = this.id.slice(3, -5)
											};
										}
									}
								}
							}

							if (typeof QTags != 'undefined') {

								for (qtId in tinyMCENewInit.qtInit) {

									if (jQuery.inArray(qtId, ignore) > -1) continue;

									try {
										quicktags(tinyMCENewInit.qtInit[qtId])
									} catch(e){}

									// init buttons
									QTags._buttonsInit();

									jQuery('#' + qtId + '-tmce').click();
								}
							}
						})();

					}
				}
			</script>
			<?php
		}
	}
	
	add_action('wp_ajax_insert_tinymce', 'insert_tinymce');
	function insert_tinymce(){
			
			hc_tinymce(array(
				'id' 	=> $_POST['id'],
				'name' 	=> $_POST['name'],
				'value' => '',
				'rows' 	=> 15,
				'class' =>$_POST['class']
			)); 
		exit;
	}

?>