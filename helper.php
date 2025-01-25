<?php
/*
# ------------------------------------------------------------------------
# Vina Awesome Slider for Phoca Gallery for Joomla 3
# ------------------------------------------------------------------------
# Copyright(C) 2014 www.VinaGecko.com. All Rights Reserved.
# @license http://www.gnu.org/licenseses/gpl-3.0.html GNU/GPL
# Author: VinaGecko.com
# Websites: http://vinagecko.com
# Forum:    http://vinagecko.com/forum/
# ------------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

if(!JComponentHelper::isEnabled('com_phocagallery', true)) {
	return JError::raiseError(JText::_('Phoca Gallery Error'), JText::_('Phoca Gallery is not installed on your system'));
}

if(!class_exists('PhocaGalleryLoader')) {
    require_once( JPATH_ADMINISTRATOR . '/components/com_phocagallery/libraries/loader.php');
}

phocagalleryimport('phocagallery.path.path');
phocagalleryimport('phocagallery.path.route');
phocagalleryimport('phocagallery.library.library');
phocagalleryimport('phocagallery.text.text');
phocagalleryimport('phocagallery.access.access');
phocagalleryimport('phocagallery.file.file');
phocagalleryimport('phocagallery.file.filethumbnail');
phocagalleryimport('phocagallery.image.image');
phocagalleryimport('phocagallery.image.imagefront');
phocagalleryimport('phocagallery.render.renderfront');
phocagalleryimport('phocagallery.render.renderdetailwindow');
phocagalleryimport('phocagallery.ordering.ordering');
phocagalleryimport('phocagallery.picasa.picasa');

class modVinaAwesomeSliderPhocaHelper
{
    public static function getSildes($params)
	{
        $user = JFactory::getUser();
		$db   = JFactory::getDBO();

		$userACLArray = implode(',', $user->getAuthorisedViewLevels());
		$categories   = $params->get('category_id', NULL);
		$ordering	  = $params->get('ordering', 'a.ordering ASC');
		$noItems	  = $params->get('noItems', 5);
		
		$category = empty($categories) ? "" : ' AND cc.id IN ('. implode( ', ', $categories) .')';
		
		$query = 'SELECT a.title, a.description, a.filename'
			. ' FROM #__phocagallery_categories AS cc'
			. ' LEFT JOIN #__phocagallery AS a ON a.catid = cc.id'
			. ' WHERE a.published = 1' . $category
			. ' ORDER BY ' . $ordering
			. ' LIMIT 0, ' . $noItems;
		
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		
		return $rows;
    }
	
	public static function loadEffect($effect)
	{
		$doc = JFactory::getDocument();
		$dir = "modules/mod_vina_awesome_phoca/assets/js/effects/" . $effect;
		if(strrpos($dir,'/') != strlen($dir) -1) $dir .= '/';
		
		$files 		= JFolder::files($dir);
        $accept 	= explode(',', '.js');
        
		if(count($files))
		{
            foreach($files as $file)
            {
                $lastDot 	= strrpos($file, '.');
                $ext 		= substr($file, $lastDot);
            
                if(in_array(strtolower($ext), $accept))
                {
                    $doc->addScript($dir . $file);
                }
            }
		}
		
		return true;
	}
	
	public static function resizeImage($type, $file, $prefix, $width, $height, $module)
	{
		jimport('joomla.filesystem.folder');
		jimport('joomla.filesystem.file');
		
		// Set noimage if the image isn't exists
		if(!JFile::exists($file)) {
			$file = "modules/". $module->module ."/assets/images/noimage.jpg";
		}
		
		// Check if new image is exists
		$newFile = "cache/". $module->module ."/". $module->id ."/". date("Y") ."/". $prefix . basename($file);
		if(JFile::exists($newFile)) {
			return JURI::base() . $newFile;
		}
		else {
			JFolder::create(dirname($newFile));
		}
		
		// Instantiate our JImage object
		$image 			= new JImage($file);
		$properties 	= JImage::getImageFileProperties($file);
		$resizedImage 	= $image->resize($width, $height, true, $type);
		$mime 			= $properties->mime;
		
		if($mime == 'image/jpeg') {
			$type = IMAGETYPE_JPEG;
		}
		elseif($mime = 'image/png') {
			$type = IMAGETYPE_PNG;
		}
		elseif($mime = 'image/gif') {
			$type = IMAGETYPE_GIF;
		}
		
		// Store the resized image to a new file
		$resizedImage->toFile($newFile, $type);
		
		return JURI::base() . $newFile;
	}
	
	public static function getCopyrightText($module)
	{
		echo '<div id="vina-copyright'.$module->id.'">© Free <a href="http://vinagecko.com/joomla-modules" title="Free Joomla! 3 Modules">Joomla! 3 Modules</a>- by <a href="http://vinagecko.com/" title="Beautiful Joomla! 3 Templates and Powerful Joomla! 3 Modules, Plugins.">VinaGecko.com</a></div>';
	}
}