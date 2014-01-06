<?php
error_reporting(0);
/**
 * @version     1.0.0
 * @package     com_ids_expose
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Emman <eatwa@strathmore.edu> - http://
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View class for a list of Ids_expose.
 */
class Ids_exposeViewExposes extends JView
{
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->state		= $this->get('State');
		
		

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			throw new Exception(implode("\n", $errors));
		}
        
		$this->addToolbar();
        
        $input = JFactory::getApplication()->input;
        $view = $input->getCmd('view', '');
        Ids_exposeHelper::addSubmenu($view);
        
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		require_once JPATH_COMPONENT.'/helpers/ids_expose.php';

		$state	= $this->get('State');
		$canDo	= Ids_exposeHelper::getActions($state->get('filter.category_id'));

		JToolBarHelper::title('IDS Knowledge Services Exposer Component', 's_exposes.png');

        JToolBarHelper::addNew('exposeNew','Expose/Export data to IDS');


	}
}
