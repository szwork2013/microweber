<script>

if(typeof __smart_field_opener !== 'function'){
      __smart_field_opener = function(e){

        if(mw.tools.hasClass(e.target.className, 'mw-ui-field') || mw.tools.hasClass(e.target.className, 'mw-custom-fields-from-page-title-text')){
            mw.tools.toggle('.custom_fields_selector', '#smart_field_opener');
        }

      }
}


</script>


<?

  $for = 'module';
 if(isset($params['for'])){
	$for = $params['for'];
 }

 $live_edit = false;
  if(isset($params['live_edit'])){
	$live_edit = $params['live_edit'];
 }

  if(isset($params['rel_id'])){
	 $params['for_module_id'] = $params['rel_id'];
 }

   if(!isset($params['for_module_id'])){
	 if(isset($params['id'])){
		 $params['for_module_id'] = $params['id'];
	 }


	 if(isset($params['data-id'])){
		 $params['for_module_id'] = $params['data-id'];
	 }
 }


 $diff = false;

  if(isset($params['save_to_content_id'])){
		 //
			 $diff = get_custom_fields($for,$params['save_to_content_id'],1,false,false);

		  }

// d($params );
?>
<?
$data = array();
 if(isset($params['for_module_id'])): ?>
<?
if(isset($params['default-fields'])){
	make_default_custom_fields($for,$params['for_module_id'],$params['default-fields']);
}

	$more = get_custom_fields($for,$params['for_module_id'],1,false,false);

 //d($more);
 // d($diff);
 $custom_custom_field_names_for_content = array();
if(isarr( $diff) and isarr($more) ){
 $i=0;
	 foreach($more as $item2){

	 foreach($diff as $item1){
			  if(isset($item1['copy_of_field'])){
				  if($item1['copy_of_field'] == $item2['id']){
				//print $item1['copy_of_field'];
				 unset($more[$i]);
				  }
			  }

		  }
		 $i++;
	 }

// foreach($diff as $item1){
//	 $i=0;
//	 $custom_custom_field_names_for_content[] = $item1['custom_field_name'];
//	  foreach($more as $item2){
//
//	 if(in_array($item2['custom_field_name'], $custom_custom_field_names_for_content) or intval($item2['copy_of_field']) == intval($item1['id']) or $item1['custom_field_name'] == $item2['custom_field_name']){
////d($item2['custom_field_name']);
//		 unset($more[$i]);
//	 } else {
//		$data[] =  $item2;
//	 }
//	 //	 $custom_custom_field_names_for_content[] = $item2['custom_field_name'];
//
//	 $i++;
// 		}
// }
}
 if(!empty($data)){
	//$more = $data;
 }
?>
 
<? if(!empty( $more)):  ?>

<div class="mw-ui-field mw-tag-selector mw-custom-fields-tags" onclick="__smart_field_opener(event)">
  <? if(isset($params['save_to_content_id']) and isset($params["rel_id"]) and intval(($params["rel_id"]) > 0)): ?>
  <? $p = get_content_by_id($params["rel_id"]); ?>
  <? if(isset($p['title'])): ?>
  <div class="mw-custom-fields-from-page-title"> <span class="mw-custom-fields-from-page-title-text">
    <?php _e("From"); ?>
    <strong><? print $p['title'] ?></strong></span> </div>
  <? endif; ?>
  <? endif; ?>
  <? foreach( $more as $field): ?>

  <? if(isset($params['save_to_content_id'])): ?>
  <a class="mw-ui-btn mw-ui-btn-small mw-field-type-<? print $field['custom_field_type']; ?>" href="javascript:;"
    onmouseup="mw.custom_fields.copy_field_by_id('<? print $field['id'] ?>', 'content', '<? print intval($params['save_to_content_id']); ?>');"><span class="ico ico-<?php print $field['custom_field_type']; ?>"></span><? print ($field['title']); ?>
  </a>
  <? else: ?>

  <a class="mw-ui-btn mw-ui-btn-small mw-field-type-<? print $field['custom_field_type']; ?>" href="javascript:;"
    data-id="<? print $field['id'] ?>"
    id="custom-field-<? print $field['id'] ?>"
    onmouseup="mw.custom_fields.edit('.mw-admin-custom-field-edit-item','<? print $field['id'] ?>', false, event);">


    <span class="ico ico-<?php print $field['custom_field_type'] ?>"></span>
    <span onclick="mw.custom_fields.del(<? print $field['id'] ?>, this.parentNode);" class="mw-ui-btnclose"></span>

    <? print ($field['title']); ?>



  </a>

  <? endif; ?>
  <? endforeach; ?>
</div>
<? else : ?>
<? if(!isset($params['save_to_content_id'])): ?>
<div class="mw-ui-field mw-tag-selector mw-custom-fields-tags" onclick="__smart_field_opener(event)">
  <div class="mw-custom-fields-from-page-title"> <span class="mw-custom-fields-from-page-title-text">
    <?php _e("You dont have any custom fields"); ?>.
    </span> </div>
</div>
<? endif; ?>
<? endif; ?>
<? endif; ?>