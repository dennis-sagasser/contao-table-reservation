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

/**
 * Class tl_table_reservation_list
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
class tl_table_reservation_list extends Backend
{

    /**
     * Parent call of the constructor.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Format dates according to the module settings
     *
     */
    public function formatDates()
    {
        $arrModuleParams = $this->Database->prepare("
            SELECT table_dateTimeFormat AS datimFormat, table_timeFormat AS timeFormat
            FROM tl_module 
            WHERE type='table_reservation'")
            ->limit(1)
            ->execute()
            ->fetchAssoc();

        if (!empty($arrModuleParams['datimFormat'])) {
            \Config::set('datimFormat', $arrModuleParams['datimFormat']);
        }

        if (!empty($arrModuleParams['timeFormat'])) {
            \Config::set('timeFormat', $arrModuleParams['timeFormat']);
        }
    }
}