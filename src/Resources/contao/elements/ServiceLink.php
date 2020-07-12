<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Markocupic;

/**
 * Front end content element "service_link".
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class ServiceLink extends \ContentElement
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_servicelink';

    /**
     * Check whether the target page and the article are published
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $this->strTemplate = 'be_servicelink';

            /** @var \BackendTemplate|object $objTemplate */
            $objTemplate = new \BackendTemplate($this->strTemplate);

            $this->Template = $objTemplate;
            $this->Template->faIcon = $this->faIcon;
            $this->Template->faIcon = $this->faIcon;
            $this->Template->iconClass = $this->iconClass;
            $this->Template->headline = $this->headline;
            $this->Template->serviceLinkText = $this->serviceLinkText;
            $this->Template->buttonClass = $this->buttonClass;
            $this->Template->buttonText = $this->buttonText;
        }

        return parent::generate();
    }

    /**
     * Generate the content element
     */
    protected function compile()
    {
        global $objPage;

        // Clean the RTE output
        if ($objPage->outputFormat == 'xhtml')
        {
            $this->text = \StringUtil::toXhtml($this->text);
        }
        else
        {
            $this->text = \StringUtil::toHtml5($this->text);
        }

        $this->Template->serviceLinkText = \StringUtil::encodeEmail($this->serviceLinkText);
        $this->Template->buttonJumpTo = $this->buttonJumpTo;
    }
}
