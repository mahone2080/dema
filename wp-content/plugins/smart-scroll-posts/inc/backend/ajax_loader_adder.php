<?php defined('ABSPATH') or die("No script kiddies please!"); 
$css_style = "style='display:none;'";
$css_style_block = "";
if(isset($options['smart_scroll_ajax_image'])){
   $ajax_image_type = $options['smart_scroll_ajax_image'];
}
if(isset($options['smart_scroll_ajax_image_url']) && $ajax_image_type != 'default_loader'){
   $ajax_image_path = esc_url($options['smart_scroll_ajax_image_url']);
}else{
  $ajax_image_path= '';
}
$ssp_default_loader = (isset($options['ssp_default_loader']) && $options['ssp_default_loader'] != '')?intval($options['ssp_default_loader']):'0';
?>
<tr class="default_loader_content" <?php if(isset($ajax_image_type) &&  $ajax_image_type == "default_loader") echo $css_style_block ; else echo $css_style; ?>> 
     <td width="200"><label class="display"><?php _e('Loader Image Preview', 'smart-scroll-posts'); ?></label></td>
     <td>
     	<ul> 
             <li>
             	<label>
				  <input type="radio" name="ssp_default_loader" value="0" <?php if($ssp_default_loader == '0') echo 'checked';?>/>
				  <img src="<?php echo SSP_IMAGE_DIR.'loader/loader.gif';?>"/>
				</label>
             </li>
             <li>
             	<label>
				  <input type="radio" name="ssp_default_loader" value="1" <?php if($ssp_default_loader == '1') echo 'checked';?>/>
				  <img src="<?php echo SSP_IMAGE_DIR.'loader/loader1.gif';?>"/>
				</label>
             </li>
              <li>
             	<label>
				  <input type="radio" name="ssp_default_loader" value="2" <?php if($ssp_default_loader == '2') echo 'checked';?>/>
				  <img src="<?php echo SSP_IMAGE_DIR.'loader/loader2.gif';?>"/>
				</label>
             </li>
              <li>
             	<label>
				  <input type="radio" name="ssp_default_loader" value="3" <?php if($ssp_default_loader == '3') echo 'checked';?>/>
				  <img src="<?php echo SSP_IMAGE_DIR.'loader/loader3.gif';?>"/>
				</label>
             </li>
              <li>
             	<label>
				  <input type="radio" name="ssp_default_loader" value="4" <?php if($ssp_default_loader == '4') echo 'checked';?>/>
				  <img src="<?php echo SSP_IMAGE_DIR.'loader/loader4.gif';?>"/>
				</label>
             </li>
              <li>
             	<label>
				  <input type="radio" name="ssp_default_loader" value="5" <?php if($ssp_default_loader == '5') echo 'checked';?>/>
				  <img src="<?php echo SSP_IMAGE_DIR.'loader/loader5.gif';?>"/>
				</label>
             </li>
              <li>
             	<label>
				  <input type="radio" name="ssp_default_loader" value="6" <?php if($ssp_default_loader == '6') echo 'checked';?>/>
				  <img src="<?php echo SSP_IMAGE_DIR.'loader/loader6.gif';?>"/>
				</label>
             </li>
              <li>
             	<label>
				  <input type="radio" name="ssp_default_loader" value="7" <?php if($ssp_default_loader == '7') echo 'checked';?>/>
				  <img src="<?php echo SSP_IMAGE_DIR.'loader/loader7.gif';?>"/>
				</label>
             </li>
              <li>
             	<label>
				  <input type="radio" name="ssp_default_loader" value="8" <?php if($ssp_default_loader == '8') echo 'checked';?>/>
				  <img src="<?php echo SSP_IMAGE_DIR.'loader/loader8.gif';?>"/>
				</label>
             </li>
     	</ul>
      </td>
</tr>
<tr class="custom_loader_content" <?php if(isset($ajax_image_type) && $ajax_image_type == "custom_loader") echo $css_style_block ; else echo $css_style; ?>> 
     <td width="200"><label class="display"><?php _e('Loader Image', 'smart-scroll-posts'); ?></label></td>
     <td>
     	 <div class="ssp-field">
           <label for="upload_image">
				<input id="ssp_upload_image" type="text" size="36" name="ssp_upload_image" value="<?php echo $ajax_image_path; ?>" />
				<input id="ssp_upload_image_button" type="button" class="button button-primary"  value="Upload Image" />
				<p class="description"><?php _e('Enter an URL or upload an image for the ajax loader.', 'smart-scroll-posts'); ?></p>
				<br/> 
				<img class="ssp-prview" src="<?php echo SSP_IMAGE_DIR.'nopreview.jpg';?>" width="100"/>
		 </label>
        </div>
      </td>
</tr>