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
class opSmtAPIWrapperPluginRouting
{
  static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $routing = $event->getSubject();
    $routing->prependRoute('TemplateList',
      new sfRoute(
        '/SmtWrapper/:id',
        array('module' => 'SmtWrapper', 'action' => 'index'),
        array('id' => '\d+')
      )
    );
    $routing->prependRoute('TemplateDelete',
      new sfRoute(
        '/SmtWrapper/Delete/:id',
        array('module' => 'SmtWrapper', 'action' => 'Delete'),
        array('id' => '\d+')
      )
    );
  }
}