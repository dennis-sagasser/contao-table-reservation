<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 *
 * PHP version 7
 *
 * @category    Contao
 * @package     TableReservation
 * @author      Dennis Sagasser <dennis.sagasser@gmail.com>
 * @copyright   2017 Dennis Sagasser
 * @license     LGPL-3.0+
 * @link        https://contao.org
 */

namespace Contao;

/**
 * Class tl_table_reservation_settings
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @category  Contao
 * @package   TableReservation
 * @author    Dennis Sagasser <sagasser@gispack.com>
 * @copyright 2017 Dennis Sagasser
 * @license   http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * @link      https://contao.org
 */
class tl_table_reservation_settings extends \Backend
{

    /**
     * Import the back end user object
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Only show one item for the settings and redirect to it
     *
     * @return string
     */
    public function checkConfig()
    {
        $objConfig = \Database::getInstance()->prepare("SELECT * FROM tl_table_reservation_settings")->execute();

        if (Input::get('key')) {
            return;
        }

        if (!$objConfig->numRows && !\Input::get('act')) {
            $this->redirect($this->addToUrl('act=create'));
        }

        if (!\Input::get('id') && !\Input::get('act')) {
            $this->redirect($this->addToUrl('act=edit&id=' . $objConfig->id));
        }
    }


    /**
     * Convert absolute URLs from TinyMCE to relative URLs
     *
     * @param string $strContent URL
     *
     * @return string
     */
    public function convertAbsoluteLinks($strContent)
    {
        return str_replace('src="' . \Environment::get('base'), 'src="', $strContent);
    }


    /**
     * Convert relative URLs from TinyMCE to absolute URLs
     *
     * @param string $strContent URL
     *
     * @return string
     */
    public function convertRelativeLinks($strContent)
    {
        return $this->convertRelativeUrls($strContent);
    }

    /**
     * Return all mail templates as array
     *
     * @return array
     */
    public function getMailTemplates()
    {
        return $this->getTemplateGroup('mail_');
    }
}