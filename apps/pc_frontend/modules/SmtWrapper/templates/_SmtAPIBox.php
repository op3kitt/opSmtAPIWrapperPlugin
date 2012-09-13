<script id="tmpl_<?php echo $gadget->getId() ?>" type="text/x-jquery-tmpl"></script>
<script>//<![CDATA[
$(function()
{
  var param<?php echo $gadget->getId() ?> = {apiKey : openpne.apiKey};
  <?php if($parameters): ?>
  <?php for($i = 0;$i < $parameters->count();$i++): ?>
  <?php $parameter = $parameters->getRaw($i); ?>
  param<?php echo $gadget->getId() ?>.<?php echo $parameter->getParameterName() ?> = "<?php
    if('{member_id}' == $parameter->getParameterValue())
    {
    	echo $sf_user->getMemberId();
    }
    else
    {
      echo $parameter->getParameterValue();
    }
  ?>";
  <?php endfor ?>
  <?php endif ?>
  $('#tmpl_<?php echo $gadget->getId() ?>').load('<?php echo _compute_public_path($templateSet->getTemplate_json(),'opSmtAPIWrapperPlugin/tmpl','tmpl.js');?>');
  $.getJSON(openpne.apiBase+'<?php echo $templateSet->getApi_name() ?>',param<?php echo $gadget->getId() ?>,function(json)
    {
      $('#smt_api_<?php echo $gadget->getId() ?>').html($('#tmpl_<?php echo $gadget->getId() ?>').tmpl(json.data));
    });
});
//]]></script>
<div id="smt_api_<?php echo $gadget->getId() ?>" class="dparts"></div>