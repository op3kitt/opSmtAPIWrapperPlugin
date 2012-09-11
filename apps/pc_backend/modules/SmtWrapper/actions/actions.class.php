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
    }
    $this->redirect('SmtWrapper/index?id='.$form->getObject()->getId());
  }
}
