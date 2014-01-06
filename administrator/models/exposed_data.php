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
class Ids_exposeModelexposed_data extends JModelAdmin
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

	function getPreviewExposedContent(){
		$params = JRequest::get('post');
		$db =& JFactory::getDBO();
		
		$search_limit = $params['search_limit'];
		$published = $params['published'];
		$source = $params['source'];
		$category = $params['category'];
		$author = $params['author'];
		$order = $params['order'];
		$frequency = $params['frequency'];

		switch ($source) {
		    case "article":
		    	if($published == 0){
		    		$query = "SELECT `id`,`title`,`introtext`,`fulltext`,`created`,`created_by`,`catid` 
		        		  FROM `#__content` 
		        		  WHERE `catid`='$category' AND `created_by` ='$author' AND `state`=0
		        		  ORDER BY `title` $order LIMIT 0,$search_limit";
		    	}else{
		    		$query = "SELECT `id`,`title`,`introtext`,`fulltext`,`created`,`created_by`,`catid` 
		        		  FROM `#__content` 
		        		  WHERE `catid`='$category' AND `created_by` ='$author' AND `state`=1
		        		  ORDER BY `title` $order LIMIT 0,$search_limit";
		    	}
		        
		        break;
		    case "k2":
		        if($published == 0){
		    		$query = "SELECT `id`,`title`,`introtext`,`fulltext`,`created`,`created_by`,`catid` 
		        		  FROM `#__k2_items` 
		        		  WHERE `catid`='$category' AND `created_by` ='$author' AND `published`=0
		        		  ORDER BY `title` $order LIMIT 0,$search_limit";
		    	}else{
		    		$query = "SELECT `id`,`title`,`introtext`,`fulltext`,`created`,`created_by`,`catid` 
		        		  FROM `#__k2_items` 
		        		  WHERE `catid`='$category' AND `created_by` ='$author' AND `published`=1
		        		  ORDER BY `title` $order LIMIT 0,$search_limit";
		    	}

		        break;
		    case "docman":
		        if($published == 0){
		    		$query = "SELECT `docman_document_id` as id,`title`,`description`,`docman_category_id` as catid,`created_on` as created,`created_by`
		        		  FROM `#__docman_documents` 
		        		  WHERE `docman_category_id`='$category' AND `enabled`=0
		        		  ORDER BY `title` $order LIMIT 0,$search_limit";
		    	}else{
		    		$query = "SELECT `docman_document_id` as id,`title`,`description`,`docman_category_id` as catid,`created_on` as created,`created_by`
		        		  FROM `#__docman_documents` 
		        		  WHERE `docman_category_id`='$category' AND `enabled`=1
		        		  ORDER BY `title` $order LIMIT 0,$search_limit";
		    	}

		        break;
		    default:
		       $query = "SELECT `id`,`title`,`introtext`,`fulltext`,`created`,`created_by`,`catid` 
		        		  FROM `#__content` 
		        		  WHERE `catid`='$category' AND `created_by` ='$author' AND `state`=1
		        		  ORDER BY `title` $order LIMIT 0,$search_limit";
		}

		$db->setQuery($query);
		$result_set = $db->LoadObjectList();

		$domain = JURI::base();
		foreach ($result_set as $asset) {
			if($source == 'docman'):
				$asset->description = str_replace('<img src="images/', '<img src="'.$domain.'/images/', $asset->description);
			else:
				$asset->introtext = str_replace('<img src="images/', '<img src="'.$domain.'/images/', $asset->introtext);
			endif;
		}

		$source = array('source' => $source);

		$result_set = array_merge($result_set, $source);

		return $result_set;
	}

}