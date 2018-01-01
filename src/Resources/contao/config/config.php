<?php

// ServiceLinks require FontAwesome v4.7.0
define('SERVICE_LINK_FONTAWESOME_VERSION', '4.7.0');

// !important notice
// Get the icons.yml file from https://github.com/FortAwesome/Font-Awesome/blob/master/src/icons.yml
// and save it to "system/modules/service_link/yml/icons.yml"


// Content Elements
array_insert($GLOBALS['TL_CTE'], 2, array(
    'ce_serviceLink' => array
    (
        'serviceLink' => 'Markocupic\ServiceLink'
    )
));


if (TL_MODE == 'FE')
{
    $GLOBALS['TL_JAVASCRIPT'][] = 'bundles/markocupicservicelink/js/ce_servicelink.js';
}

if (TL_MODE == 'BE')
{
    $GLOBALS['TL_JAVASCRIPT'][] = 'bundles/markocupicservicelink/js/ce_servicelinkBe.js';
    $GLOBALS['TL_CSS'][] = 'bundles/markocupicservicelink/css/service_link.css|static';
    $GLOBALS['TL_CSS'][] = 'bundles/markocupicservicelink/fa/font-awesome-' . SERVICE_LINK_FONTAWESOME_VERSION . '/css/font-awesome.min.css';
}