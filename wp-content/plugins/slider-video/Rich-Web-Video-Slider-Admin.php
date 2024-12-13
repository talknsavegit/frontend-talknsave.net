<?php
	if(!current_user_can('manage_options'))
	{
		die('Access Denied');
	}
	global $wpdb;
	wp_enqueue_media();
	wp_enqueue_script( 'custom-header' );
	add_filter( 'upload_size_limit', 'PBP_increase_upload' );
	
	function PBP_increase_upload( )
	{
		return 100048576;
	}
	$table_name  = $wpdb->prefix . "rich_web_video_slider_font_family";
	$table_name1 = $wpdb->prefix . "rich_web_video_slider_id";
	$table_name2 = $wpdb->prefix . "rich_web_video_slider_manager";
	$table_name3 = $wpdb->prefix . "rich_web_video_slider_videos";
	$table_name4 = $wpdb->prefix . "rich_web_video_slider_effects_data";

	$Rich_Web_VS_ID =$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name1 WHERE id>%d order by id desc limit 1",0));
	$Rich_Web_VS_Dat=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name2 WHERE id>%d", 0));
	$Rich_Web_VS_Eff=$wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name4 WHERE id>%d", 0));
	if($Rich_Web_VS_ID) { $Rich_Web_VS_IDn = $Rich_Web_VS_ID[0]->Slider_ID; } else { $Rich_Web_VS_IDn = 0; }
?>
	<?php wp_nonce_field( 'edit-menu_', 'Rich_Web_VSlider_Nonce' );?>
	<?php require_once( 'Rich-Web-Video-Slider-Header.php' ); ?>
	<div class="RW_VS_Buttons_Bar" >
   		<a  class="RW_Support_btn" href="<?php echo esc_url("https://wordpress.org/support/plugin/slider-video/"); ?>"  target="_blank" >Support</a>
		<input type='button' class='Rich_Web_VSlider_Add' value='New Slider' onclick='RichWeb_Video_Slider_Add(<?php echo esc_html($Rich_Web_VS_IDn+1);?>)'/>
		<input type='submit' class='Rich_Web_VSlider_Sav' value='Save'   name='Ric_Web_VSlider_Save'/>
		<input type='submit' class='Rich_Web_VSlider_Upd' value='Update' name='Rich_Web_VSlider_Update'/>
		<input type='button' class='Rich_Web_VSlider_Can' value='Cancel' onclick='RichWeb_Video_Slider_Cancel()'/>
		<input type='text' style='display:none' id="Rich_Web_VSlider_Update_ID" name='Rich_Web_VSlider_Update_ID'>
	</div>
	<div class="Rich_Web_SliderVd_Fixed_Div"></div>
	<div class="Rich_Web_SliderVd_Absolute_Div">
		<div class="Rich_Web_SliderVd_Relative_Div">
		<i class="Rich_Web_VS_Del_Trash rich_web rich_web-trash"></i>
			<p> Are you sure you want to remove ? </p>
			<span class="Rich_Web_SliderVd_Relative_No">No</span>
			<span class="Rich_Web_SliderVd_Relative_Yes">Yes</span>
		</div>
	</div>
	<div class='Table_Data_Rich_Web_VS_Content'>
		<div class='Table_Data_VS_Rich_Web1'>
			<table class='Rich_Web_VSlider_Tit_Table'>
				<tr class='Rich_Web_VSlider_Tit_Table_Tr'>
					<td>No</td>
					<td>Slider Name</td>
					<td>Slider Option</td>
					<td>Videos</td>
					<td>Clone</td>
					<td>Edit</td>
					<td>Delete</td>
				</tr>
			</table>
			<table class='Rich_Web_VSlider_Tit_Table2' >
			<?php for($i=0;$i<count($Rich_Web_VS_Dat);$i++){ ?>
				<tr class='Rich_Web_VSlider_Tit_Table_Tr2' id="Rich_Web_VSlider_Table_Tr-<?php echo esc_html($Rich_Web_VS_Dat[$i]->id);?>">
					<td><?php echo esc_html($i+1);  ?></td>
					<td><?php echo esc_html($Rich_Web_VS_Dat[$i]->Slider_Title); ?></td>
					<?php $RichWeb_VidSl_ID = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name4 WHERE id=%s ", $Rich_Web_VS_Dat[$i]->Slider_Type));  ?>
					<td><?php echo esc_html($RichWeb_VidSl_ID[0]->slider_vid_name);?></td>
					<td><?php echo esc_html($Rich_Web_VS_Dat[$i]->Slider_Video_Quantity); ?></td>
					<td onclick="Rich_Web_VS_Copy(<?php echo esc_html($Rich_Web_VS_Dat[$i]->id);?>)"><i class='Rich_Web_VS_Files rich_web rich_web-files-o'></i></td>
					<td onclick="Rich_Web_VS_Edit(<?php echo esc_html($Rich_Web_VS_Dat[$i]->id);?>)"><i class='Rich_Web_VS_Pencil rich_web rich_web-pencil'></i></td>
					<td onclick="Rich_Web_VS_Del(<?php echo esc_html($Rich_Web_VS_Dat[$i]->id);?>)"><i class='Rich_Web_VS_Delete rich_web rich_web-trash'></i></td>
				</tr>
			<?php } ?>
			</table>
		</div>
		<div class='Table_Data_VS_Rich_Web2'>
			<table class="Rich_Web_VS_ShortTable" style="display: table;float:right;">
				<tr style="text-align:center">
					<td>Shortcode</td>
				</tr>
				<tr>
					<td>Copy &amp; paste the shortcode directly into any WordPress post or page.</td>
				</tr>
				<tr>
					<td class="Rich_Web_VSlider_ID"   unselectable="on" onselectstart="return false;"  onmousedown="return false;" onclick="rw_vs_copy(this)" onmouseout="rw_vs_copied(this)">[Rich_Web_Video id="1"]</td>
				</tr>
				<tr>
					<td>Templete Include</td>
				</tr>
				<tr>
					<td>Copy &amp; paste this code into a template file to include the slideshow within your theme.</td>
				</tr>
				<tr>
					<td class="Rich_Web_VSlider_ID_1" unselectable="on" onselectstart="return false;"  onmousedown="return false;"  onclick="rw_vs_copy(this)" onmouseout="rw_vs_copied(this)">&lt;?php echo do_shortcode("[Rich_Web_Video id="1"]");?&gt;</td>
				</tr>
			</table>
			<table class='Rich_Web_Save_VSlider_Table' style='float:left;'>
				<tr>
					<td style='width:50%'>Slider Name</td>
					<td style='width:50%'>
						<input type='text' class='Rich_Web_VSlider_Input Rich_Web_VSlider_Name' name='Video_Slider_Title' placeholder=" * Required" required/>
					</td>
				</tr>
				<tr>
					<td style='width:50%'>Slider Type</td>
					<td style='width:50%'>
						<select class='Rich_Web_VSlider_Input Rich_Web_VSlider_Type' name='Video_Slider_Type'>
							<?php for($i=0;$i<count($Rich_Web_VS_Eff);$i++){ ?>
								<option value='<?php echo esc_attr($Rich_Web_VS_Eff[$i]->id);?>'><?php echo esc_html($Rich_Web_VS_Eff[$i]->slider_vid_name);?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td class='Rich_Web_VSlider_Add_Vid' colspan='3'>Add Video</td>
				</tr>
				<tr>
					<td style='width:50%'>Video Title</td>
					<td style='width:50%'>
						<input type='text' class='Rich_Web_VSlider_Input Rich_Web_VSlider_Input2 Rich_Web_VSlider_Video_Title' id='Rich_Web_VSlider_Video_Title'/>
					</td>
				</tr>
				<tr>
					<td style='width:50%'>
						<div id="wp-content-media-buttons" class="wp-media-buttons">
							<a href="#" class="button insert-media add_media" style="border:1px solid rgba(0, 73, 107, 0.8); color:rgba(0, 73, 107, 0.8); background-color:#f4f4f4" data-editor="Rich_Web_Vid_Src_1" title="Add Video" onclick="Rich_Web_Upload_Video()">
								<span class="wp-media-buttons-icon"></span>Add Video
							</a>
						</div>
						<input type="text" style="display:none;" id="Rich_Web_Vid_Src_1" class='Rich_Web_VSlider_Input Rich_Web_VSlider_Input2'>
						<input type="text" style="display:none;" id="Rich_Web_Vid_Vid_1" class='Rich_Web_VSlider_Input Rich_Web_VSlider_Input2'>
					</td>
					<td style="width:50%">
						<input type="text" id="Rich_Web_Vid_Src_2" class="Rich_Web_VSlider_Input Rich_Web_VSlider_Input2 Rich_Web_Vid_Src_Select" readonly>
					</td>
				</tr>
				<tr>
					<td style='width:50%'>
						<div id="wp-content-media-buttons" class="wp-media-buttons">
							<a href="#" class="button insert-media add_media" style="border:1px solid rgba(0, 73, 107, 0.8); color:rgba(0, 73, 107, 0.8); background-color:#f4f4f4" data-editor="Rich_Web_Vid_ImSrc_1" title="Add Image" onclick="Rich_Web_Upload_Image()">
								<span class="wp-media-buttons-icon"></span>Add Image
							</a>
						</div>
						<input type="text" style="display:none;" id="Rich_Web_Vid_ImSrc_1" class='Rich_Web_VSlider_Input Rich_Web_VSlider_Input2'>
					</td>
					<td style="width:50%">
						<input type="text" id="Rich_Web_Vid_ImSrc_2" class="Rich_Web_VSlider_Input Rich_Web_VSlider_Input2 Rich_Web_Vid_Src_Select" readonly>
					</td>
				</tr>
				<tr>
					<td style='width:100%' colspan='2'>Video Description</td>
				</tr>
				<tr>
					<td colspan='2'>
						<textarea type='text' class='Rich_Web_VSlider_Input Rich_Web_VSlider_Input2 Rich_Web_VSlider_Desc' id='Rich_Web_VSlider_Desc'></textarea>
					</td>
				</tr>
				<tr>
					<td style='width:100%' colspan='2'>Website Link</td>
				</tr>
				<tr>
					<td>
						<input type='text' class='Rich_Web_VSlider_Input Rich_Web_VSlider_Input2 Rich_Web_VSlider_Link' id='Rich_Web_VSlider_Link'/>
					</td>
					<td>
						New Tab <input type='checkbox' id='Rich_Web_VSlider_ONT' class='Rich_Web_VSlider_ONT'>
					</td>
				</tr>
				<tr>
					<td class='Rich_Web_VSlider_Add_Vid' colspan='3' style='padding:0px;'>
						<input type='button' class='Rich_Web_VSlider_Sav_Video' onclick="Rich_Web_Sav_VSlider_Vid()" value='Save'/>
						<input type='button' class='Rich_Web_VSlider_Upd_Video' onclick="Rich_Web_Upd_VSlider_Vid()" value='Update'/>
						<input type='button' class='Rich_Web_VSlider_Res_Video' onclick="Rich_Web_Res_VSlider_Vid()" value='Reset'/>
						<input type="text" style="display:none;" id="Rich_Web_VSlider_Count" name="Rich_Web_VSlider_Count" value="0">
						<input type="text" style="display:none;" id="Rich_Web_VSlider_HidUp" value="0">
					</td>
				</tr>
			</table>
			<table class='Rich_Web_Save_VSlider_Table2'>
				<tr>
					<td>No</td>
					<td>Video</td>
					<td>Video Title</td>
					<td>Clone</td>
					<td>Edit</td>
					<td>Delete</td>
				</tr>
			</table>
			<table class='Rich_Web_Save_VSlider_Table3' onmousemove='Rich_Web_VSlider_Sortable()'></table>
		</div>
	</div>