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

jimport('joomla.application.component.modeladmin');

/**
 * Ids_expose model.
 */
class Ids_exposeModelmapping extends JModelAdmin
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

	function getJoomlaArticleFields()
	{
		$db =& JFactory::getDBO();
		$table = array( '#__content' );
  		$result = $db->getTableFields( $table );

		foreach($result['#__content'] as $key => $value ):

			switch ($key) {
				case "title":
					$fields[] = JHTML::_('select.option',$key,'Title','article_field','field_title');
					break;
				case "alias":
					$fields[] = JHTML::_('select.option',$key,'Title alias','article_field','field_title');
					break;
				case "introtext":
					$fields[] = JHTML::_('select.option',$key,'Description','article_field','field_title');
					break;
				case "fulltext":
					$fields[] = JHTML::_('select.option',$key,'Full text','article_field','field_title');
					break;
				case "catid":
					$fields[] = JHTML::_('select.option',$key,'Category','article_field','field_title');
					break;
				case "created":
					$fields[] = JHTML::_('select.option',$key,'Date created','article_field','field_title');
					break;
				case "created_by":
					$fields[] = JHTML::_('select.option',$key,'Created by','article_field','field_title');
					break;
				case "created_by_alias":
					$fields[] = JHTML::_('select.option',$key,'Created by alias','article_field','field_title');
					break;
				case "modified":
					$fields[] = JHTML::_('select.option',$key,'Date modified','article_field','field_title');
					break;
				case "modified_by":
					$fields[] = JHTML::_('select.option',$key,'Modified by','article_field','field_title');
					break;
				case "urls":
					$fields[] = JHTML::_('select.option',$key,'URLs','article_field','field_title');
					break;
				case "metakey":
					$fields[] = JHTML::_('select.option',$key,'Meta Keywords','article_field','field_title');
					break;
				case "metadesc":
					$fields[] = JHTML::_('select.option',$key,'Meta Description','article_field','field_title');
					break;
				case "metadata":
					$fields[] = JHTML::_('select.option',$key,'Author, License, External Reference','article_field','field_title');
					break;
				case "language":
					$fields[] = JHTML::_('select.option',$key,'language','article_field','field_title');
					break;
				case "xreference":
					$fields[] = JHTML::_('select.option',$key,'External Reference','article_field','field_title');
					break;
			}
		endforeach;
		
		return $fields;
	} 

	function getIDSFields(){
		$ids_fields = array(

							'Country(ies) that the document focuses on' => 'country_name',

							'Document Language (ISO): Language of the document linked to in the url field' => 'doc_language',

							'Document Language Name: Name of language of the document linked to in the url field' => 'doc_language_name',

							'Document type: The type of document' => 'doc_type',

							'Document Medium: The file format' => 'doc_medium',

							'Et al: Are there more authors?' => 'et_al',

							'Extra: Any additional fields' => 'extra',

							'Name of the language of the document' => 'language_name',

							'Licence Type: License type of the document' => 'licence_type',

							'Publication Date: Date item was first published' => 'publication_date',

							'Publication Year: Year item was first published' => 'publication_year',

							'Publisher: Name of the publisher' => 'publisher',

							'Publisher Country (ISO):' => 'publisher_country',

							'Publisher Country Name: Name of the publisher country above' => 'publisher_country_name',

							'Region: Region(s) that the document focuses on' => 'region',

							'Relation: A related resource' => 'relation',

							'Subject: The topic or thematic focus of the item/resource' => 'subject',

							'URL: Urls of the item' => 'url'
								
							);
		foreach($ids_fields as $key => $value ):
			$fields[] = JHTML::_('select.option',$value,$key,'ids_field','field_title');
		endforeach;

		$select_ids_field[] = JHTML::_('select.option', '', '- '.JText::_('Select').' -', 'ids_field', 'field_title');
		$fields = array_merge($select_ids_field, $fields);

		return $fields;
	}


	function getK2ExtraFields(){
		$db =& JFactory::getDBO();
		$query = "SELECT `id`,`name` FROM `#__k2_extra_fields` ORDER BY `name` ASC";
  		$db->setQuery( $query );
  		$extra_fields = $db->loadObjectList();

  		foreach($extra_fields as $extra_field ):
			$k2_extra_fields[] = JHTML::_('select.option',$extra_field->id,$extra_field->name,'k2_extra_field','field_title');
		endforeach;

		$select_extra_field[] = JHTML::_('select.option', '', '- '.JText::_('Select').' -', 'k2_extra_field', 'field_title');
		$extra_fields = array_merge($select_extra_field, $k2_extra_fields);

  		return $extra_fields;
	}
}