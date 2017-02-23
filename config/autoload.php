<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'MCupic',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Src
	'MCupic\ServiceLink'      => 'system/modules/service_link/src/elements/ServiceLink.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_servicelink'       => 'system/modules/service_link/templates/frontend',
	'be_servicelink'       => 'system/modules/service_link/templates/backend',
));
