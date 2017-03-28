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
     * List reservations row
     *
     * @param array $row
     *
     * @return string
     */
    public function listReservations($row)
    {
        $arrCountCategories = unserialize($row['seats']);

        foreach ($arrCountCategories as $arrCountCategory) {
            $objTableCategory = $this->Database->prepare("
                SELECT DISTINCT tablecategory
                FROM tl_table_category
                WHERE id = ?")->execute(intval($arrCountCategory['category']))->row();

            $array[] = sprintf('%s (%s)',
                $arrCountCategory['count'],
                $objTableCategory['tablecategory']
            );
        }

        $strCountCategory = implode(', ', $array);
        $objArrivalDate   = new \Date($row['arrival']);

        return sprintf(
            '<em>%s</em> <b>|</b> %s: %s <b>|</b> %s %s',
            $objArrivalDate->datim,
            $GLOBALS['TL_LANG']['tl_table_reservation_list']['seats'][0],
            $strCountCategory,
            $row['firstname'],
            $row['lastname']
        );
    }

    /**
     * Get the keys and values for number of persons dropdown
     *
     * * @return array $arrCount Array of dropdown options
     */
    public function getCount()
    {
        $arrMaxCount = $this->Database->prepare("
            SELECT maxcount
            FROM tl_table_category 
            WHERE published = '1' 
            AND (? BETWEEN start AND stop OR (start = '' AND stop = '')) ")
            ->execute(time())->fetchAssoc();

        for ($i = 1; $i <= intval($arrMaxCount['maxcount']); $i++) {
            $arrCount[$i] = $i;
        }

        return $arrCount;
    }

    /**
     * Get the keys and values for categories dropdown
     *
     * * @return array $arrCategories Array of dropdown options
     */
    public function getCatergory()
    {
        $objCategories = $this->Database->prepare("
            SELECT id AS value, tablecategory AS label
            FROM tl_table_category 
            WHERE published = '1' 
            AND (? BETWEEN start AND stop OR (start = '' AND stop = '')) 
            ORDER BY tablecategory")
            ->execute(time());

        while ($objCategories->next()) {
            $arrCategories[$objCategories->value] = $objCategories->label;
        }

        return $arrCategories;
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