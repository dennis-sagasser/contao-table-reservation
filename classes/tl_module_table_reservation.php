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

namespace ContaoTableReservation;

use Contao\Backend;
use Contao\BackendUser;
use Contao\Input;
use Contao\ModuleModel;
use Contao\Message;
use Contao\Database;
use Contao\ModuleLoader;
use Contao\System;

/**
 * Class tl_module_table_reservation
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
class tl_module_table_reservation extends Backend
{
    /**
     * Get notification choices
     *
     * @return array $arrChoices Array of notifications
     */
    public function getNotificationChoices()
    {

        $arrChoices       = [];
        $objNotifications = Database::getInstance()->execute("SELECT id,title FROM tl_nc_notification WHERE type='core_form' ORDER BY title");

        while ($objNotifications->next()) {
            $arrChoices[$objNotifications->id] = $objNotifications->title;
        }

        return $arrChoices;
    }

    /**
     * Get all table categories and return them as array
     *
     * @return array Array of table categories
     */
    public function getTableCategories()
    {
        $objBackendUser = BackendUser::getInstance();

        if (!$objBackendUser->isAdmin) {
            return [];
        }

        $arrTableCategories = [];
        $objTableCategories = Database::getInstance()->execute("
            SELECT id, tablecategory 
            FROM tl_table_category 
            ORDER BY tablecategory");

        while ($objTableCategories->next()) {
            if ($objBackendUser->isAdmin) {
                $arrTableCategories[$objTableCategories->id] = $objTableCategories->tablecategory;
            }
        }

        return $arrTableCategories;
    }

    /**
     * Show a hint that module must be installed to use this option
     *
     */
    public function showHints()
    {
        if (!in_array('notification_center', ModuleLoader::getActive())) {
            $strMessage = &$GLOBALS['TL_LANG']['tl_module']['installInfo'];

            $GLOBALS['TL_DCA']['tl_module']['fields']['table_showNotification']['eval']['disabled'] = true;
            $GLOBALS['TL_DCA']['tl_module']['fields']['table_showNotification']['label']            = $strMessage;
        }
    }

    /**
     * Get the keys and values for days dropdown
     *
     * * @return array $arrDays Array of dropdpwn options
     */
    public function getDays()
    {
        $arrDays      = [];
        $intTimestamp = strtotime('next Sunday');

        for ($i = 0; $i < 7; $i++) {
            $strKeys[]             = strftime('%A', $intTimestamp);
            $intTimestamp          = strtotime('+1 day', $intTimestamp);
            $arrDays[$strKeys[$i]] = $GLOBALS['TL_LANG']['DAYS'][$i];
        }

        return $arrDays;
    }

    /**
     * Get the keys and values for daytime dropdown
     *
     * * @return array $arrDayTimes Array of dropdpwn options
     */
    public function getDayTimes()
    {
        System::loadLanguageFile('tl_table_occupancy');

        $arrDayTimes = [];

        $arrDayTimes['countMorning'] = $GLOBALS['TL_LANG']['tl_table_occupancy']['morningAlt'];
        $arrDayTimes['countNoon']    = $GLOBALS['TL_LANG']['tl_table_occupancy']['noonAlt'];
        $arrDayTimes['countEvening'] = $GLOBALS['TL_LANG']['tl_table_occupancy']['eveningAlt'];

        return $arrDayTimes;
    }
}