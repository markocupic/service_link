<?php


/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @package Gallery Creator
 * @link    http://www.contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


$GLOBALS['TL_DCA']['tl_content']['palettes']['serviceLink'] = 'name,type,headline;{template_legend:hide},customTpl;{icon_legend},faIcon,iconClass;{text_legend},serviceLinkText;{button_legend},buttonText,buttonClass,buttonJumpTo;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';


/**
 * Add fields to tl_content
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['faIcon'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['faIcon'],
    'exclude' => true,
    'search' => true,
    'input_field_callback' => array('ce_serviceLink', 'generatePicker'),
    'inputType' => 'radio',
    'eval' => array('doNotShow' => true),
    'sql' => "varchar(255) NOT NULL default ''"
);


$GLOBALS['TL_DCA']['tl_content']['fields']['buttonClass'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['buttonClass'],
    'exclude' => true,
    'search' => true,
    'inputType' => 'text',
    'eval' => array('maxlength' => 200),
    'sql' => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['serviceLinkText'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['text'],
    'exclude' => true,
    'search' => true,
    'inputType' => 'textarea',
    'eval' => array('mandatory' => false, 'rte' => 'tinyMCE', 'helpwizard' => true),
    'explanation' => 'insertTags',
    'sql' => "mediumtext NULL"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['buttonText'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['buttonText'],
    'exclude' => true,
    'search' => true,
    'inputType' => 'text',
    'eval' => array('maxlength' => 200),
    'sql' => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['iconClass'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['iconClass'],
    'exclude' => true,
    'search' => true,
    'inputType' => 'text',
    'eval' => array('maxlength' => 200),
    'sql' => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['buttonJumpTo'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_content']['buttonJumpTo'],
    'exclude' => true,
    'search' => true,
    'inputType' => 'text',
    'eval' => array('mandatory' => true, 'rgxp' => 'url', 'decodeEntities' => true, 'maxlength' => 255, 'fieldType' => 'radio', 'filesOnly' => true, 'tl_class' => 'w50 wizard'),
    'wizard' => array
    (
        array('tl_content', 'pagePicker')
    ),
    'sql' => "varchar(255) NOT NULL default ''"
);


class ce_serviceLink extends Backend
{
    public function __construct()
    {
        parent::__construct();
    }

    public function generatePicker($dc)
    {

        if (Input::post('FORM_SUBMIT'))
        {
            if (Input::post('faIcon') != '')
            {
                $ContentModel = \ContentModel::findByPk($dc->id);
                $ContentModel->faIcon = Input::post('faIcon');
                $ContentModel->save();
            }
        }
        // Load Font Awesome
        $arrFaIds = $this->getFaIds();
        $html = '<fieldset id="ctrl_faIcon" class="tl_radio_container">';
        // Filter
        $html .= '<h3><label>' . $GLOBALS['TL_LANG']['tl_content']['faIconFilter'] . '</label></h3>';
        $html .= '<input type="text" id="faClassFilter" class="tl_text fa-class-filter" placeholder="filter">';

        // Build radio-button-list
        $html .= '<h3><label>Icon picker</label></h3>';
        $html .= '<div id="iconBox">';
        $i = 0;
        foreach ($arrFaIds as $faClass)
        {
            $checked = $cssClassChecked = $cssClassCheckedWithAttribute = '';
            if($dc->activeRecord->faIcon == 'fa-' . $faClass)
            {
                $checked = ' checked="checked"';
                $cssClassChecked = ' checked';

                $cssClassCheckedWithAttribute = ' class="checked"';
            }

            $html .= '<div title="fa-' . $faClass . '" class="font-awesome-icon-item' . $cssClassChecked . '" data-faClass="fa-' . $faClass . '">';
            $html .= '<input' . $cssClassCheckedWithAttribute . ' id="faIcon_' . $i . '" type="radio" name="faIcon" value="fa-' . $faClass . '"' . $checked .'>';
            $html .= '<i class="fa fa-2x fa-fw fa-' . $faClass . '"></i>';
            $html .= '<div>' . StringUtil::substr($faClass, 15) . '</div>';
            $html .= '</div>';
            $i++;
        }
        $html .= '</div>';
        $html .= '<p class="tl_help tl_tip" title="">' . $GLOBALS['TL_LANG']['tl_content']['faIcon'][1] . '</p>';

        // Javascript (Mootools)
        $html .= '
        <script>
            window.addEvent("domready", function(event) {
                if($$("#ctrl_faIcon #iconBox .checked").length){
                    // Scroll to selected icon
                    var myFx = new Fx.Scroll(document.id("iconBox")).toElement($$("#ctrl_faIcon #iconBox .checked")[0]);
                }
                $$("#iconBox input").addEvent("click", function(event){
                    $$("#ctrl_faIcon #iconBox .checked").removeClass("checked");
                    this.getParent("div").addClass("checked");
                });

                // Add event to filter input
                $$("input#faClassFilter").addEvent("input", function(event){
                    var strFilter = this.getProperty("value").trim(" ");
                    var itemCollection = $$(".font-awesome-icon-item");
                    itemCollection.each(function(el){
                        el.setStyle("display","inherit");
                        if(strFilter != "")
                        {
                            if(el.getProperty("data-faClass").contains(strFilter) === false)
                            {
                                el.setStyle("display","none");
                            }
                        }
                    });
                });
            });
        </script>
        ';

        return $html;

    }

    /**
     * Get all FontAwesomeClasses as array from icons.yml
     * Download this file at:
     * https://raw.githubusercontent.com/FortAwesome/Font-Awesome/v4.7.0/src/3.2.1/icons.yml
     * @return array
     */
    protected function getFaIds()
    {
        $ymlFileSRC = TL_ROOT .  '/system/modules/service_link/yml/icons.yml';
        /**
        $strYml = file_get_contents($ymlFileSRC);
        $pattern = '/id:([\s]*)(.*)([\s]*)/';
        if(preg_match_all ($pattern, $strYml, $matches))
        {
            return $matches[2];
        }
         *
         * */

        //$value = Symfony\Component\Yaml\Yaml::parseFile($ymlFileSRC);
        //die(print_r($value,true));

        $arrMatches = array();
        $arrFile = array_map('rtrim', file($ymlFileSRC));
        $skip = false;
        foreach($arrFile as $strLine)
        {
            $pattern = '/^([\s]*)(.*):/';
            if(preg_match ($pattern, $strLine, $match))
            {
                if($skip === false)
                {
                    $arrMatches[] = $match[2];
                    $skip = true;
                }

                if(strpos($strLine, 'unicode') !== false)
                {
                    $skip = false;
                }
            }
        }
        return $arrMatches;
    }
}