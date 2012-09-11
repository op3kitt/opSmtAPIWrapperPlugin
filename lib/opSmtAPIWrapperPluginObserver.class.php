<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * Message routing.
 *
 * @package    OpenPNE
 * @author     kit.t <yoshiyuki.tanaka@kitsystem.co.jp>
 */
class opSmtAPIWrapperPluginObserver
{
  public function listenToPostExecuteDeginEditGadget(sfEvent $event,$args = null)
  {
    if($event['actionInstance']->gadget->getName() === 'SmtAPIBox')
    {
      $event['actionInstance']->form->setWidget('value', new sfWidgetFormDoctrineChoice(array('model' => 'SmtApiWrapperSet', 'method' => 'getSet_name', 'label' => '表示セット')));
    }
  }
}