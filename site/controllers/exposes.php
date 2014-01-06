<?php
/**
 * @version     1.0.0
 * @package     com_ids_expose
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Emman <eatwa@strathmore.edu> - http://
 */

// No direct access.
defined('_JEXEC') or die;

require_once JPATH_COMPONENT.'/controller.php';

/**
 * Exposes list controller class.
 */
class Ids_exposeControllerExposes extends Ids_exposeController
{
	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function &getModel($name = 'Exposes', $prefix = 'Ids_exposeModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}