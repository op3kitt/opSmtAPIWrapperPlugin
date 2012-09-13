<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * diary components.
 *
 * @package    OpenPNE
 * @subpackage diary
 * @author     Rimpei Ogawa <ogawa@tejimaya.com>
 */
class SmtWrapperComponents extends sfComponents
{
  public function executeSmtAPIBox()
  {
    $this->templateSet = Doctrine::getTable('SmtApiWrapperSet')->find($this->gadget->getConfig('value'));
    $this->parameters = Doctrine::getTable('SmtApiWrapperSetParameter')->findBySmtApiWrapperSetId($this->gadget->getConfig('value'));
  }
}
