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
	'Markocupic',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Src
	'Markocupic\ServiceLink'      => 'system/modules/service_link/elements/ServiceLink.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_servicelink'       => 'system/modules/service_link/templates/frontend',
	'be_servicelink'       => 'system/modules/service_link/templates/backend',
));
