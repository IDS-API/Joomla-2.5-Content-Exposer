<?php

error_reporting(0);
/**
 * @version     1.0.0
 * @package     com_ids_expose
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Emman <eatwa@strathmore.edu> - http://
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

/**
 * Ids_expose model.
 */
class Ids_exposeModelexpose extends JModelAdmin
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 * @since	1.6
	 */
	protected $text_prefix = 'COM_IDS_EXPOSE';


	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
	public function getTable($type = 'Expose', $prefix = 'Ids_exposeTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		An optional array of data for the form to interogate.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	JForm	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Initialise variables.
		$app	= JFactory::getApplication();

		// Get the form.
		$form = $this->loadForm('com_ids_expose.expose', 'expose', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_ids_expose.edit.expose.data', array());

		if (empty($data)) {
			$data = $this->getItem();
            
		}

		return $data;
	}

	/**
	 * Method to get a single record.
	 *
	 * @param	integer	The id of the primary key.
	 *
	 * @return	mixed	Object on success, false on failure.
	 * @since	1.6
	 */
	public function getItem($pk = null)
	{
		if ($item = parent::getItem($pk)) {

			//Do any procesing on fields here if needed

		}

		return $item;
	}

	/**
	 * Prepare and sanitise the table prior to saving.
	 *
	 * @since	1.6
	 */
	protected function prepareTable(&$table)
	{
		jimport('joomla.filter.output');

		if (empty($table->id)) {

			// Set ordering to the last item if not set
			if (@$table->ordering === '') {
				$db = JFactory::getDbo();
				$db->setQuery('SELECT MAX(ordering) FROM expose');
				$max = $db->loadResult();
				$table->ordering = $max+1;
			}

		}
	}

	function getJoomlaArticleCategories(){
		$db =& JFactory::getDBO();
		$db->setQuery("SELECT `id`,`title` FROM `#__categories` WHERE `extension`='com_content' ORDER BY `title` ASC");
		//$select_categories[] = JHTML::_('select.option', ' ', '- '.JText::_('Select').' -', 'id', 'title');
		$categories = $db->LoadObjectList();
		//$categories = array_merge($select_categories, $categories);
		return $categories;
	}

	function getAuthors(){
		$db =& JFactory::getDBO();
		$query = "SELECT DISTINCT `created_by`,`name` FROM `#__content`,`#__users` WHERE `created_by`=`#__users`.`id` ORDER BY `name` ASC";
		$db->setQuery($query);
		$authors = $db->LoadObjectList();

		return $authors;
		
	}

	function getPreviewExposedContent($result_set){
		return $result_set;
	}

}