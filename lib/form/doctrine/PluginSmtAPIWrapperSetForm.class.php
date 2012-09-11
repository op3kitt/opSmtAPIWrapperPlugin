<?php

/**
 * PluginSmtAPIWrapperSet form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginSmtAPIWrapperSetForm extends BaseSmtAPIWrapperSetForm
{
  public function setup()
  {
    parent::setup();
    
    unset($this['id'], $this['template_json'], $this['created_at'], $this['updated_at']);
    
    $this->setWidget('template', new sfWidgetFormTextArea(array(), array('cols' => 60, 'rows' => 8)));
    //$this->setWidget('template_json', new sfWidgetFormInputHidden());
  }
}
