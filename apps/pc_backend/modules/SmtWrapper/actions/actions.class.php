<?php

/**
 * SmtWrapper actions.
 *
 * @package    OpenPNE
 * @subpackage SmtWrapper
 * @author     Your name here
 */
class SmtWrapperActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfWebRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->templates = Doctrine::getTable("SmtAPIWrapperSet")->findAll();
    $this->member = Doctrine::getTable("Member")->find(1);
    
    $id = $request->getParameter('id', null);
    if($id)
    {
      $this->form = new SmtAPIWrapperSetForm(Doctrine::getTable("SmtAPIWrapperSet")->find($id));
      $this->parameters = Doctrine::getTable('SmtAPIWrapperSetParameter')->findBySmtApiWrapperSetId($id);
    }
    else
    {
      $this->form = new SmtAPIWrapperSetForm();
    }
    $this->id = $id;
    return sfView::SUCCESS;
  }
  
  public function executeEdit(sfWebRequest $request)
  {
    $id = $request->getParameter('id', null);
    if($id)
    {
      $form = new SmtAPIWrapperSetForm(Doctrine::getTable("SmtAPIWrapperSet")->find($id));
    }
    else
    {
      $form = new SmtAPIWrapperSetForm();
    }
    $data = $request->getParameter('smt_api_wrapper_set');
    $file = $request->getFiles('smt_api_wrapper_set');
    $form->bind($data, $file);
    if($form->isValid()){
      $form->save();
      $paramaters = Doctrine::getTable('SmtAPIWrapperSetParameter')->findBySmtApiWrapperSetId($form->getObject()->getId());
      if(!$paramaters)
      {
        $parameters = sfYaml::load(realpath(__DIR__.'/../../../../../config/api_param.yml'));
        if(isset($parameters[$form->getObject()->getApi_name()]))
        {
          foreach($parameters[$form->getObject()->getApi_name()] as $parameter)
          {
            $param = new SmtAPIWrapperSetParameter();
            $param->setSmt_api_wrapper_set_id($form->getObject()->getId());
            $param->setParameter_name($parameter);
            $param->setParameter_value('');
            $param->save();
          }
        }
      }
    }
    $this->redirect('SmtWrapper/index?id='.$form->getObject()->getId());
  }
  
  public function executeDelete(sfWebRequest $request)
  {
    $id = $request->getParameter('id');
    $set = Doctrine::getTable('SmtApiWrapperSet')->find($id);
    if($set)
    {
      $set->delete();
    }
    $this->redirect('SmtWrapper/index');
  }
  
  public function executeParamDelete(sfWebRequest $request)
  {
    $id = $request->getParameter('id');
    $parameter = Doctrine::getTable('SmtApiWrapperSetParameter')->find($id);
    if($parameter)
    {
      $parameter->delete();
      $this->redirect('SmtWrapper/index?id='.$parameter->getSmtApiWrapperSetId());
    }
    else
    {
      $this->redirect('SmtWrapper/index');
    }
  }
  
  public function executeParamEdit(sfWebRequest $request)
  {
    $id = $request->getParameter('id', null);
    if($id)
    {
      $form = new SmtAPIWrapperSetParameterForm(Doctrine::getTable('SmtAPIWrapperSetParameter')->find($id));
    }
    else
    {
      $form = new SmtAPIWrapperSetParameterForm();
    }
    
    $data = $request->getParameter('smt_api_wrapper_set_parameter');
    $file = $request->getFiles('smt_api_wrapper_set_parameter');
    $form->bind($data, $file);
    if($form->isValid()){
      $form->save();
    }
    $this->redirect('SmtWrapper/index?id='.$form->getObject()->getSmtApiWrapperSetId());
  }
}
