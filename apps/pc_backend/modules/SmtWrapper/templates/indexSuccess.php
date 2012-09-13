<?php if (opConfig::get('enable_jsonapi')) : ?>
<?php echo link_to(__('Create new set'), 'SmtWrapper/index') ?>
<?php if($templates) : ?>
  <table>
  <tr><th>Id</th><th><?php echo __('Set name') ?></th><th></th><th></th></tr>
  <?php foreach($templates as $template) : ?>
  <tr>
    <td><?php echo $template->getId() ?></td>
    <td><?php echo $template->getSet_name() ?></td>
    <td><?php echo link_to(__('Edit'), 'SmtWrapper/index?id=' . $template->getId()) ?></td>
    <td><?php echo link_to(__('Delete'), 'SmtWrapper/Delete?id=' . $template->getId()) ?></td>
  </tr>
  <?php endforeach ?>
  </table>
<?php endif ?>

<form action="<?php echo url_for('SmtWrapper/edit') ?>" method="POST">
  <table>
    <?php echo $form ?>
    <tr>
      <td colspan="2">
        <input type="submit" value="<?php echo __('Edit')?>" />
      </td>
    </tr>
  </table>
  <input type="hidden" name="id" value="<?php echo $id ?>" />
</form>
<?php endif ?>
<input type="button" value="<?php echo __('Html Preview') ?>" onclick="SmtAPIPreview();" />
<input type="button" value="<?php echo __('JSON Preview') ?>" onclick="SmtAPIPreviewJSON();" />
<?php 
$jsonData = array(
		  'apiKey' => $member->getApiKey(),
		  'apiBase' => app_url_for('api', 'homepage'),
		);
		?>
<script>//<![CDATA[
  var openpne = <?php echo json_encode($jsonData) ?>;
function SmtAPIPreview()
{
  $.template('preview', $('#smt_api_wrapper_set_template').val());
  $('#preview').html('');
  $.getJSON(openpne.apiBase+$('#smt_api_wrapper_set_api_name').val(),{apiKey:openpne.apiKey},function(json){
    $('#preview').html($.tmpl('preview', json.data));
  });
}

function SmtAPIPreviewJSON()
{
	  $.getJSON(openpne.apiBase+$('#smt_api_wrapper_set_api_name').val(),{apiKey:openpne.apiKey},function(json){
		    $('#preview_json').text(JSON.stringify(json.data, null, 2));
		  });
}
//]]></script>
<pre id="preview_json" style="min-height: 35px;"></pre>
<div id="preview" style="border:solid black 1px;padding: 5px;width: 300px;"></div>
<?php if(!$form->isNew()): ?>
<table>
<tr><th><?php echo __('Parameter name') ?></th><th><?php echo __('Parameter value') ?></th><th></th><th></th></tr>
<?php for($i = 0;$i < $parameters->count();$i++): ?>
<?php $pform = new SmtApiWrapperSetParameterForm($parameters->getRaw($i)); ?>
<tr>
<form action="<?php echo url_for('SmtWrapper/paramEdit?id='.$pform->getObject()->getId()) ?>" method="post">
<td>
<?php echo $pform->renderHiddenFields(); ?>
<?php echo $pform['parameter_name']->renderError(); ?>
<?php echo $pform['parameter_name']->render(); ?>
</td>
<td>
<?php echo $pform['parameter_value']->renderError(); ?>
<?php echo $pform['parameter_value']->render(); ?>
</td>
<td><input type="submit" value="<?php echo __('Edit') ?>" /></td>
<td><?php echo link_to(__('Delete'), 'SmtWrapper/paramDelete?id='.$pform->getObject()->getId()) ?></td>
</form>
</tr>
<?php endfor ?>
<?php $data = new SmtApiWrapperSetParameter(); ?>
<?php $data->setSmtApiWrapperSetId($id); ?>
<?php $pform = new SmtApiWrapperSetParameterForm($data); ?>
<tr>
<form action="<?php echo url_for('SmtWrapper/paramEdit') ?>" method="post">
<td>
<?php echo $pform->renderHiddenFields(); ?>
<?php echo $pform['parameter_name']->renderError(); ?>
<?php echo $pform['parameter_name']->render(); ?>
</td>
<td>
<?php echo $pform['parameter_value']->renderError(); ?>
<?php echo $pform['parameter_value']->render(); ?>
</td>
<td colspan="2"><input type="submit" value="<?php echo __('Add') ?>" /></td>
</form>
</tr>
</table>
<?php echo __('The following values are available for parameters.')?><br />
{member_id}:<?php echo __('Member Id')?><br />
{community_id}:<?php echo __('Community Id')?>
<?php endif ?>