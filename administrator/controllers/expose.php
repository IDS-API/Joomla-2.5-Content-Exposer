<?php
/**
 * @version     1.0.0
 * @package     com_ids_expose
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Emman <eatwa@strathmore.edu> - http://
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Expose controller class.
 */
class Ids_exposeControllerExpose extends JControllerForm
{

    function __construct() {
        $this->view_list = 'exposes';
        parent::__construct();
    }

}