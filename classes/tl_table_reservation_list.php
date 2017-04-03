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
     * Generate custom filter select
     *
     * @return string $strBuffer Filter select
     */
    public function generateFilter()
    {
        if (\Input::get('id') > 0) {
            return '';
        }

        $objSession     = \Session::getInstance()->getData();
        $strFilterValue = isset($objSession['filter']['tl_table_reservation_list']['table_filter']) ?
            $objSession['filter']['tl_table_reservation_list']['table_filter'] :
            'future';

        $objWidgetFilter           = new \SelectMenu();
        $objWidgetFilter->id       = 'table_filter';
        $objWidgetFilter->name     = 'table_filter';
        $objWidgetFilter->value    = $strFilterValue;
        $objWidgetFilter->style    = 'width: 200px';
        $objWidgetFilter->options  = [
            ['value' => 'table_filter', 'label' => $GLOBALS['TL_LANG']['tl_table_reservation_list']['timeSlot']],
            ['value' => 'table_filter', 'label' => '---'],
            ['value' => 'all', 'label' => $GLOBALS['TL_LANG']['tl_table_reservation_list']['all']],
            ['value' => 'future', 'label' => $GLOBALS['TL_LANG']['tl_table_reservation_list']['future']],
            ['value' => 'past', 'label' => $GLOBALS['TL_LANG']['tl_table_reservation_list']['past']],
            ['value' => 'today', 'label' => $GLOBALS['TL_LANG']['tl_table_reservation_list']['today']],
            ['value' => 'thisWeek', 'label' => $GLOBALS['TL_LANG']['tl_table_reservation_list']['thisWeek']],
            ['value' => 'thisMonth', 'label' => $GLOBALS['TL_LANG']['tl_table_reservation_list']['thisMonth']],
            ['value' => 'thisYear', 'label' => $GLOBALS['TL_LANG']['tl_table_reservation_list']['thisYear']],
        ];
        $objWidgetFilter->onchange = "this.form.submit()";

        $strWidgetCheckbox = '';
        $strWidgetCheckbox .= $objWidgetFilter->generate();
        $strWidgetCheckbox .= $objWidgetFilter->generateLabel();

        $strBuffer = '<div class="tl_filter tl_subpanel">' . $strWidgetCheckbox;

        return $strBuffer . '</div>';
    }


    /**
     * Apply custom filter for reservation list
     *
     */
    public function applyFilter()
    {
        $objSession = \Session::getInstance()->getData();

        // Store filter values in the session
        foreach ($_POST as $key => $value) {
            if (substr($key, 0, 6) != 'table_') {
                continue;
            }
            log_message($key, 'debug.log');
            log_message(\Input::post($key), 'debug.log');
            // Reset the filter
            if ($key == \Input::post($key)) {
                $objSession['filter']['tl_table_reservation_list'][$key] = 'future';
            } // Apply the filter
            else {
                $objSession['filter']['tl_table_reservation_list'][$key] = \Input::post($key);
            }
        }

        \Session::getInstance()->setData($objSession);

        if (\Input::get('id') > 0 || !isset($objSession['filter']['tl_table_reservation_list'])) {
            return;
        }

        $objDate = new \Date(time());

        // Filter reservations
        foreach ($objSession['filter']['tl_table_reservation_list'] as $key => $value) {
            if (substr($key, 0, 6) != 'table_') {
                continue;
            }

            switch ($value) {
                case 'future':
                    $arrReservations = \Database::getInstance()->prepare("
                        SELECT id 
                        FROM tl_table_reservation_list 
                        WHERE arrival > ?")
                        ->execute($objDate->tstamp)->fetchEach('id');
                    break;
                case 'today':
                    $arrReservations = \Database::getInstance()->prepare("
                        SELECT id 
                        FROM tl_table_reservation_list 
                        WHERE arrival BETWEEN ? AND ?")
                        ->execute($objDate->dayBegin, $objDate->dayEnd)->fetchEach('id');
                    break;
                case 'thisWeek':
                    $arrReservations = \Database::getInstance()->prepare("
                        SELECT id 
                        FROM tl_table_reservation_list 
                        WHERE arrival BETWEEN ? AND ?")
                        ->execute($objDate->getWeekBegin(1), $objDate->getWeekEnd(0))->fetchEach('id');
                    break;
                case 'thisMonth':
                    $arrReservations = \Database::getInstance()->prepare("
                        SELECT id 
                        FROM tl_table_reservation_list 
                        WHERE arrival BETWEEN ? AND ?")
                        ->execute($objDate->monthBegin, $objDate->monthEnd)->fetchEach('id');
                    break;
                case 'thisYear':
                    $arrReservations = \Database::getInstance()->prepare("
                        SELECT id 
                        FROM tl_table_reservation_list 
                        WHERE arrival BETWEEN ? AND ?")
                        ->execute($objDate->yearBegin, $objDate->yearEnd)->fetchEach('id');
                    break;
                case 'past':
                    $arrReservations = \Database::getInstance()->prepare("
                        SELECT id 
                        FROM tl_table_reservation_list 
                        WHERE arrival < ?")
                        ->execute($objDate->tstamp)->fetchEach('id');
                    break;
                default:
                    $arrReservations = \Database::getInstance()->prepare("
                        SELECT id 
                        FROM tl_table_reservation_list ")
                        ->execute()->fetchEach('id');
                    break;
            }
        }

        if (is_array($arrReservations) && empty($arrReservations)) {
            $arrReservations = [0];
        }
        $GLOBALS['TL_DCA']['tl_table_reservation_list']['list']['sorting']['root'] = $arrReservations;
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
     * @return array $arrCount Array of dropdown options
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
     * @return array $arrCategories Array of dropdown options
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