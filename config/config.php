<?php
$this->dispatcher->connect('routing.load_configuration', array('opSmtAPIWrapperPluginRouting', 'listenToRoutingLoadConfigurationEvent'));
$this->dispatcher->connect('op_action.post_execute_design_editGadget', array('opSmtAPIWrapperPluginObserver', 'listenToPostExecuteDeginEditGadget'));