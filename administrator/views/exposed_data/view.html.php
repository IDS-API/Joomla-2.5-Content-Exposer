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
 * View to edit
 */
class Ids_exposeViewexposed_data extends JView
{
	protected $state;
	protected $item;
	protected $form;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
	

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors));
		}

		$this->preview_data = $this->get('PreviewExposedContent');
		
		$this->addToolbar();
		
		parent::display($tpl);
		
	}

	/**
	 * Add the page title and toolbar.
	 */
	protected function addToolbar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);

		$user		= JFactory::getUser();

		JToolBarHelper::title(JText::_('Exposed Data'), 'expose.png');

		
		JToolBarHelper::save('', 'Proceed', 'JTOOLBAR_SAVE');
	
		JToolBarHelper::cancel('cancel', 'JTOOLBAR_CANCEL');
		

	}
}
