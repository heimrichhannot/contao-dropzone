<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2015 Heimrich & Hannot GmbH
 *
 * @package dropzone
 * @author  Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

/**
 * Front end form fields
 */
$GLOBALS['TL_FFL']['dropzone'] = 'HeimrichHannot\\DropZone\\FormDropZone';

if(TL_MODE == 'FE')
{
	// Add the scripts
	$GLOBALS['TL_CSS']['dropzone'] = 'assets/dropzone/' . $GLOBALS['TL_ASSETS']['DROPZONE'] . '/css/dropzone.min.css|screen|static|3.12.0';
	$GLOBALS['TL_JAVASCRIPT']['dropzone'] = 'assets/dropzone/' . $GLOBALS['TL_ASSETS']['DROPZONE'] . '/js/dropzone' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static';
}