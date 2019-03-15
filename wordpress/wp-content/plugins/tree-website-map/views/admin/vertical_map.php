<?php
wp_enqueue_style('wm-awesome-css', plugins_url('lib/font-awesome/css/font-awesome.min.css', WM_PLUGIN_MAIN_FILE));
wp_enqueue_style('wm-jstree-proton-theme-css', plugins_url('lib/jstree-bootstrap-theme/src/themes/proton/style.css', WM_PLUGIN_MAIN_FILE));
wp_enqueue_style('jstree-css', plugins_url('lib/jstree/dist/themes/default/style.css', WM_PLUGIN_MAIN_FILE));
wp_enqueue_script('jstree-js', plugins_url('lib/jstree/dist/jstree.min.js', WM_PLUGIN_MAIN_FILE));

if (empty($mp_id)) {
	
    $mp_id = wm_create_new_vertical_map();
	
    ?>
    <div style="background: #CCEBC9 url(<?php echo plugins_url('images/success2_24.png', WM_PLUGIN_MAIN_FILE) ?>) no-repeat 10px 10px; padding: 10px 10px 10px 40px; border: solid 1px #B0DEA9; color: #508232; margin: 20px 10px;">
        Vertical map created successfully
    </div>
    <script type="text/javascript">
        window.location.href = "<?php echo get_admin_url() ?>admin.php?page=wm_edit_website_map&mpid=<?php echo $mp_id ?>";
    </script>
    <?php
}

$map = wm_read_map($mp_id);

$mp_container_width = (isset($map['mp_container_width'])) ? $map['mp_container_width'] : '0';
$mp_container_height = (isset($map['mp_container_height'])) ? $map['mp_container_height'] : '0';
$mp_font_size = (isset($map['mp_font_size'])?$map['mp_font_size']:"14");

$map['state_data'] = isset($map['state_data']) ? $map['state_data'] : '';

?>
<script type="application/javascript">
    var state_record = '<?php echo stripslashes($map['state_data']); ?>';
    if (state_record) {
        localStorage.setItem("demo_<?php echo $mp_id; ?>", state_record);
    }
</script>


<br/>
<div class="row">

    <div class="col-md-12">
        <div class="wpLogo">
            <img src="<?php echo plugins_url('images/wp-tree.png', WM_PLUGIN_MAIN_FILE) ?>" border="0"
                 style="width:32px; height:32px"/>
        </div>
        <h3>&nbsp;Vertica tree</h3>
    </div>
</div>
<!-- start process message -->
<div id="processMessageContainer" class="processMessageContainer">
    <div id="processMessage" class="processMessage successStatus">
        <span></span>
    </div>
</div>
<!-- end process message -->

<div id="wm_node_form_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="wm_modal_title">&nbsp;Edit Node</h4>
            </div>
            <div class="modal-body clearfix">
                <form id="wm_node_form">
                    <input type="hidden" id="tr_id">
                    <input type="hidden" id="tr_parent_id">

                    <div class="form-group">
                        <label for="tr_title"><?php _e('Title', 'websitemap'); ?></label>
                        <input type="text" class="form-control" id="tr_title">
                    </div>

                   <p><a target="_blank" href="https://www.wp-buy.com/product/wp-tree-pro/">upgrade</a> to our pro version to enable links & images!</p>
                 
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="wm_save_node()" class="btn btn-success"><i class="fa fa-floppy-o"></i>&nbsp;
                    <?php _e('Save', 'websitemap'); ?></button>

                <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class="fa fa-times"></i>&nbsp;<?php _e('Close', 'websitemap'); ?></button>
            </div>
        </div>

    </div>
</div>

<div class="container-fluid ">
    <div class="row">
        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12"
             style="border: solid 1px #CCCCCC; background-color:#FFF; border-radius: 1px;">
            <div class="row" style="padding: 10px 0; background-color: #f9f9f9; border-bottom:1px #f2eded solid">
                <div class="col-sm-9">
                    <div class="row">
                        
						<div class="col-sm-3">
                            <button type="button" id="wm_showNodeBtn" class="btn btn-success"
                                    onclick="wm_showVerTreeNodes();" >
                                <i class="fa fa-eye"></i> <?php _e('Show node(s)', 'websitemap') ?></button>
                        </div>
						
                        <div class="col-sm-3">
                            <button type="button" id="wm_hideNodeBtn" class="btn btn-success"
                                    onclick="wm_hideVerTreeNodes();" >
                                <i class="fa fa-eye-slash"></i> <?php _e('Hide node(s)', 'websitemap') ?></button>
                        </div>
                        
						
						<div class="col-sm-3">
                            <button type="button" id="wm_deleteNodeBtn" class="btn btn-danger"
                                    onclick="wm_delVerTreeNodes();" disabled>
                                <i class="fa fa-times"></i> <?php _e('Delete node(s)', 'websitemap') ?></button>
                        </div>
						
						
                    </div>
                </div>
            </div>
            <div id="wm_vertical_tree" class="wm-vertical-map"></div>
        </div>

        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" >
		
		<div style="border: solid 1px #CCCCCC; background-color:#f9f9f9; border-radius: 1px; padding:10px; background-color:#f2f2f2; margin-left:5px">
            <form method="post" action="" onsubmit="return false;" id="wm_vertical_tree_form">
                <input type="hidden" name="mp_id" id="mp_id" value="<?php echo $mp_id ?>"/>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <a class="btn btn-primary" style="margin-bottom: 20px;"
                           href="<?php echo get_admin_url() ?>admin.php?page=wm_website_maps">
                            <i class="fa fa-arrow-left"></i> <?php _e('Go back', 'websitemap') ?></a>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <button type="button" class="btn btn-success" onclick="wm_edit_vertical_map(true);">
                            <i class="fa fa-floppy-o"></i> <?php _e('Save and refresh', 'websitemap') ?>
                        </button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label><?php _e('Map Name', 'websitemap') ?></label>
                        <input type="text" class="form-control" name="mp_name"
                               value="<?php echo $map['mp_name'] ?>">
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label><?php _e('Number of posts in list', 'websitemap') ?></label>
                        <input type="text" class="form-control" name="mp_list_posts"
                               value="<?php echo $map['mp_list_posts'] ?>"/>
                    </div>
                </div>
                <br/>
                
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label><?php _e('Container width', 'websitemap') ?></label>
                        <input type="number" class="form-control" name="mp_container_width"
                               value="<?php echo $mp_container_width; ?>">
                        <span style="font-size: 10px;"> For auto weidth set <strong> 0 </strong></span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label><?php _e('Container height', 'websitemap') ?></label>
                        <input type="number" class="form-control" name="mp_container_height"
                               value="<?php echo $mp_container_height; ?>">
                        <span style="font-size: 10px;"> For auto height set <strong> 0 </strong></span>
                    </div>
                </div>

                <div class="row" style="margin-top: 10px;">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label><?php _e('Font-Size', 'websitemap') ?></label>
                        <input type="number" class="form-control" name="mp_font_size"
                               value="<?php echo $mp_font_size; ?>"><span style="font-size: 10px;"> default: 12px</span>
                    </div>
                </div>


                <br/>
                <p>
                    <span><b><label><?php _e('Short Code', 'Shortcode') ?></label> :</b> <input type="text" class="form-control" name="wm_website_map_shortcode"
                               value='[wm_website_map id="<?php echo $mp_id; ?>"]'></span>
					<p><i>copy and paste this short-code wherever you wat to display the map</i></p>
                </p>
            </form>
			
			</div>
	
        </div>
		
    </div>
	
</div>

<div style="margin-top:20px; padding:10px; width:600px; height:90px;color:white; background:#509250; cursor: pointer; " onclick="window.location.href='https://www.wp-buy.com/product/wp-tree-pro/'">
	<b>UPGRADE NOW</b><br /><small>If you need more features you can upgrade to our professional version now, The premium version of the tree plugin is completely different from the free version as there are a lot more features included :) </small>
	</div>
<script type="text/javascript">
    var wm_options = {
        admin_url: '<?php echo admin_url(); ?>',
        images_url: '<?php echo plugins_url('lib/horizontal-tree/images/', WM_PLUGIN_MAIN_FILE); ?>',
        plug_images_url: '<?php echo plugins_url('images/', WM_PLUGIN_MAIN_FILE); ?>',
        wp_ver: '<?php echo get_bloginfo('version'); ?>'
    };

    var formChanged = false;

    monitorFormChanges(['mp_name', 'mp_enable_thumbnail', 'mp_enable_link', 'mp_list_posts']);

    jQuery(document).ready(function () {

        setInterval(function () {
            if (formChanged) {
                wm_edit_vertical_map();
            }
        }, 10000);

        jQuery("#wm_vertical_tree").jstree({
            "core": {
                "themes": {
                    "name": "proton",
                    "responsive": true,
                    "icons": false,
                },
                "check_callback": true,
                "data": {
                    "url": function (node) {
                        return "<?php echo admin_url() ?>admin-ajax.php";
                    },
                    "data": function (node) {
                        return {
                            "action": "wm_get_vertical_tree_nodes",
                            "mp_id": jQuery('#mp_id').val(),
                            "parent": node.id,
                            "control_panel": true,
                            "check_admin": jQuery('#is_admin_side').length,
                        };
                    }
                }
            },
            "dnd": {
                "is_draggable": true
            },
            "types": {
                "default": {
                    "icon": "fa fa-folder icon-state-warning icon-lg"
                },
                "file": {
                    "icon": "fa fa-file icon-state-warning icon-lg"
                }
            },
            "checkbox": {
                "keep_selected_style": false,
                "tie_selection": false
            },
            "state": {"key": "demo_" + jQuery('#mp_id').val()},
            "plugins": ["dnd", "state", "types", "checkbox"]
        });


        jQuery("#wm_vertical_tree").bind('check_node.jstree', function (node, selected, evnt) {
            wm_changeButtonsStatus();
        });

        jQuery("#wm_vertical_tree").bind('uncheck_node.jstree', function (node, selected, evnt) {
            wm_changeButtonsStatus();
        });

        jQuery("#wm_vertical_tree").bind('move_node.jstree', function (arg1, arg2) {
            if (arg2.parent == '#') {
                alert("Tree can\'t has more than one root!");
            }

            var record_update = {};
            jQuery('#' + arg2.parent + ' ul li').each(function (index, data) {
                record_update[index] = jQuery(data).attr('id');
            });
            var get_mp_id = jQuery('#mp_id').val();

            wm_move_ver_node(arg2.node.id, arg2.old_parent, arg2.parent, arg2.old_position, arg2.position, get_mp_id, record_update);
        });

        jQuery("#mp_enable_thumbnail").checkboxpicker().change(function () {
            formChanged = true;
        });
        jQuery("#mp_enable_link").checkboxpicker().change(function () {
            formChanged = true;
        });
    });

    window.onbeforeunload = function () {
        if (formChanged) {
            return false;
        }
    }
</script>