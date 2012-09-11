<script id="tmpl_<?php echo $gadget->getId() ?>" type="text/x-jquery-tmpl"></script>
<script>//<![CDATA[
$(function()
{
  $('#tmpl_<?php echo $gadget->getId() ?>').load('opSmtAPIWrapperPlugin/tmpl/<?php echo $templateSet->getTemplate_json() ?>.tmpl.js');
  $.getJSON(openpne.apiBase+'<?php echo $templateSet->getApi_name() ?>',{apiKey:openpne.apiKey},function(json)
    {
      $('#smt_api_<?php echo $gadget->getId() ?>').html($('#tmpl_<?php echo $gadget->getId() ?>').tmpl(json.data));
    });
});
//]]></script>
<div id="smt_api_<?php echo $gadget->getId() ?>" class="dparts"></div>