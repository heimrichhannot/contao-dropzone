<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'HeimrichHannot',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Forms
	'HeimrichHannot\DropZone\FormDropZone' => 'system/modules/dropzone/forms/FormDropZone.php',

	// Classes
	'HeimrichHannot\DropZone\DropZone'     => 'system/modules/dropzone/classes/DropZone.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'jquery.dropzone' => 'system/modules/dropzone/templates/jquery',
));
