<?php
/*
 * @package		Joomla.Framework
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 *
 * @component Phoca Component
 * @copyright Copyright (C) VinaGecko.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License version 2 or later;
 */
 
defined('_JEXEC') or die();
// for JInput Factory
use Joomla\CMS\Factory;
if(!class_exists('PhocaGalleryLoader')) {
    require_once(JPATH_ADMINISTRATOR . '/components/com_phocagallery/libraries/loader.php');
}

// if missing /administrator/components/com_phocagallery/libraries/phocagallery/html/category.php copy it from here (source: Phoca Gallery v4.4.3)
phocagalleryimport('phocagallery.html.category');

class JFormFieldPhocaGalleryCategory extends JFormField
{
	protected $type = 'PhocaGallery';

	protected function getInput()
	{
		$db = JFactory::getDBO();

       //build the list of categories
		$query = 'SELECT a.title AS text, a.id AS value, a.parent_id as parentid'
		. ' FROM #__phocagallery_categories AS a'
		. ' WHERE a.published = 1'
		. ' ORDER BY a.ordering';
		$db->setQuery($query);
		$phocagallerys = $db->loadObjectList();
	
		// TODO - check for other views than category edit
		// fix deprecated JRequest
		//$view 	= JRequest::getVar('view');
		$JInput = Factory::getApplication()->input;
		$view = $JInput->get('view','','string');
		$catId	= -1;
		
		if($view == 'phocagalleryc') {
			$id = $this->form->getValue('id'); // id of current category
			if((int)$id > 0) {
				$catId = $id;
			}
		}
		
		$tree = array();
		$text = '';
		$tree = PhocaGalleryCategory::CategoryTreeOption($phocagallerys, $tree, 0, $text, $catId);
		
		return JHTML::_('select.genericlist',  $tree,  $this->name, 'class="inputbox" size="4" multiple="multiple"', 'value', 'text', $this->value, $this->id );
	}
}