<?php

/**
 * PluginSmtAPIWrapperSet
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class PluginSmtAPIWrapperSet extends BaseSmtAPIWrapperSet
{
  public function preInsert($event)
  {
    $this->setTemplate_json(md5(date()));
  }
  
  public function preSave($event)
  {
    file_put_contents('opSmtAPIWrapperPlugin/tmpl/'.$this->getTemplate_json().'.tmpl.js', $this->getTemplate());
  }
  
  public function preDelete($event)
  {
    if(file_exists('opSmtAPIWrapperPlugin/tmpl/'.$this->getTemplate_json().'.tmpl.js'))
    {
      unlink('opSmtAPIWrapperPlugin/tmpl/'.$this->getTemplate_json().'.tmpl.js');
    }
  }
}