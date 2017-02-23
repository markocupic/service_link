<?php

// ServiceLinks require FontAwesome v4.7.0
define('SERVICE_LINK_FONTAWESOME_VERSION', '4.7.0');

// !important notice
// Get the icons.yml file from https://github.com/FortAwesome/Font-Awesome/blob/master/src/icons.yml
// and save it to "system/modules/service_link/yml/icons.yml"


// Content Elements
array_insert($GLOBALS['TL_CTE'], 2, array('ce_serviceLink' => array('serviceLink' => 'MCupic\ServiceLink')));


if(TL_MODE == 'BE')
{
    $GLOBALS['TL_CSS'][] = 'system/modules/service_link/assets/css/service_link.css|static';
    $GLOBALS['TL_CSS'][] = 'system/modules/service_link/assets/fa/font-awesome-' . SERVICE_LINK_FONTAWESOME_VERSION. '/css/font-awesome.min.css';
}