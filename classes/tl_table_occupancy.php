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
 * Class tl_table_occupancy
 *
 * @category  Contao
 * @package   TableReservation
 * @author    Dennis Sagasser <sagasser@gispack.com>
 * @copyright 2017 Dennis Sagasser
 * @license   http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * @link      https://contao.org
 */
class tl_table_occupancy extends \Backend
{
    /**
     * @var object $objModuleModel Module model object
     */
    protected $objModuleModel = null;

    /**
     * Parent call of the constructor.
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->objModuleModel = \ModuleModel::findByType('table_reservation');
    }

    /**
     * Returns array of time slot titles.
     *
     * @return array
     */
    public function getTimeSlotTitles()
    {
        return $this->Database->prepare("
                SELECT title FROM tl_table_slots WHERE published='1'
                ")->execute()->fetchEach('title');
    }

    /**
     * Returns array of time slot names.
     *
     * @return array
     */
    public function getTimeSlotNames()
    {
        return $this->Database->prepare("
                SELECT name FROM tl_table_slots WHERE published='1'
                ")->execute()->fetchEach('name');
    }

    /**
     * Generates a year calendar widget to edit number of seats for every day in year.
     *
     * @param \DataContainer $dc Data container object
     *
     * @return string
     */
    public function generateCalendarWidget(\DataContainer $dc)
    {
        $intYear        = \Input::get('intYear');
        $intCurrentYear = isset($intYear) ?
            \Input::get('intYear') :
            (int)\Date::parse('Y');

        $strBuffer = '<div><table class="calendarWidget">';
        $strBuffer .= '<caption><h3>';
        $strBuffer .= '<a href=' . \Environment::get('requestUri') . '&intYear=' . ($intCurrentYear - 1) . '>«</a>';
        $strBuffer .= '&nbsp;' . $GLOBALS['TL_LANG']['tl_table_occupancy']['year'][0];
        $strBuffer .= '&nbsp;' . $intCurrentYear . '&nbsp;';
        $strBuffer .= '<a href=' . \Environment::get('uri') . '&intYear=' . ($intCurrentYear + 1) . '>»</a>';
        $strBuffer .= '</h3></caption>';

        $intCurrentMonth = 0;
        $intParentId     = intval($dc->activeRecord->pid);

        $strDayTimesRow = '';

        if (!empty($this->objModuleModel->table_showTimeSlots)) {
            foreach ($this->getTimeSlotTitles() as $strSlotTitle) {
                $strDayTimesRow .= '<div style="height:18px;display:table;vertical-align:middle;white-space:nowrap">';
                $strDayTimesRow .= $strSlotTitle;
                $strDayTimesRow .= '</div>';
            }

        } else {
            $strMorningSrc = 'system/modules/table_reservation/assets/images/sunrise16.png';
            $strNoonSrc    = 'system/modules/table_reservation/assets/images/sun16.png';
            $strEveningSrc = 'system/modules/table_reservation/assets/images/moon16.png';

            $strMorningAlt = $GLOBALS['TL_LANG']['tl_table_occupancy']['morningAlt'];
            $strNoonAlt    = $GLOBALS['TL_LANG']['tl_table_occupancy']['noonAlt'];
            $strEveningAlt = $GLOBALS['TL_LANG']['tl_table_occupancy']['eveningAlt'];

            $strMorningAttr = 'title="' . $GLOBALS['TL_LANG']['tl_table_occupancy']['morningTitle'] . '"';
            $strNoonAltAttr = 'title="' . $GLOBALS['TL_LANG']['tl_table_occupancy']['noonTitle'] . '"';
            $strEveningAttr = 'title="' . $GLOBALS['TL_LANG']['tl_table_occupancy']['eveningTitle'] . '"';

            $strDayTimesRow .= \Image::getHtml($strMorningSrc, $strMorningAlt, $strMorningAttr);
            $strDayTimesRow .= \Image::getHtml($strNoonSrc, $strNoonAlt, $strNoonAltAttr);
            $strDayTimesRow .= \Image::getHtml($strEveningSrc, $strEveningAlt, $strEveningAttr);

        }

        while ($intCurrentMonth < 12) {
            $strMonthNameShort = $GLOBALS['TL_LANG']['MONTHS_SHORT'][$intCurrentMonth];
            $strBuffer         .= '<tr>';
            $strBuffer         .= '<td class="shortMonthColumn">';
            $strBuffer         .= '<div class="shortMonthName">' . $strMonthNameShort . '</div><br>';
            $strBuffer         .= $strDayTimesRow;
            $strBuffer         .= $this->datesMonth(++$intCurrentMonth, $intCurrentYear, $intParentId);
            $strBuffer         .= '</td>';
            $strBuffer         .= '</tr>';
        }

        $strBuffer .= '</table></div>';

        return $strBuffer;
    }

    /**
     * Creates the month rows and fills the calendar.
     *
     * @param int $intMonth Month
     * @param int $intYear Year
     * @param int $intParentId Parent ID
     *
     * @return string
     */
    function datesMonth($intMonth, $intYear, $intParentId)
    {
        $intCountDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $intMonth, $intYear);
        $strCurrentMonth     = str_pad($intMonth, 2, "0", STR_PAD_LEFT);

        for ($i = 1; $i <= $intCountDaysInMonth; $i++) {

            $strCurrentDay  = str_pad($i, 2, "0", STR_PAD_LEFT);
            $strCurrentDate = $intYear . '-' . $strCurrentMonth . '-' . $strCurrentDay;

            $objWidgetDate           = new \FormTextField();
            $objWidgetDate->value    = $strCurrentDate;
            $objWidgetDate->name     = $strCurrentDate . '[date]';
            $objWidgetDate->disabled = $strCurrentDate === date('Y-m-d') ? '' : 'disabled';
            $objWidgetDate->style    = 'display:none';

            $strTimeSlots = '';

            if (!empty($this->objModuleModel->table_showTimeSlots && !empty($this->getTimeSlotNames()))) {
                $objCounts = $this->Database->prepare("   
                SELECT  " . implode(',', $this->getTimeSlotNames()) . "
                FROM    tl_table_occupancy 
                WHERE   date=? 
                AND     pid=?")
                    ->execute($strCurrentDate, $intParentId);

                foreach ($this->getTimeSlotNames() as $slotName) {

                    $objWidgetSlot            = new \FormTextField();
                    $objWidgetSlot->id        = 'count' . $slotName . '_' . $strCurrentDate;
                    $objWidgetSlot->class     = empty($objCounts->countSlot) ? 'emptyInput' : 'filledInput';
                    $objWidgetSlot->value     = $objCounts->$slotName;
                    $objWidgetSlot->name      = $strCurrentDate . '[' . $slotName . ']';
                    $objWidgetSlot->maxlength = 2;
                    $objWidgetSlot->disabled  = ($strCurrentDate === date('Y-m-d')) ? false : true;
                    $strTimeSlots             .= $objWidgetSlot->generate();
                }
            } else {
                $objCounts = $this->Database->prepare("   
                SELECT  countMorning, countNoon, countEvening
                FROM    tl_table_occupancy 
                WHERE   date=? 
                AND     pid=?")
                    ->execute($strCurrentDate, $intParentId);

                $objWidgetMorning            = new \FormTextField();
                $objWidgetMorning->id        = 'countMorning_' . $strCurrentDate;
                $objWidgetMorning->class     = empty($objCounts->countMorning) ? 'emptyInput' : 'filledInput';
                $objWidgetMorning->value     = $objCounts->countMorning;
                $objWidgetMorning->name      = $strCurrentDate . '[countMorning]';
                $objWidgetMorning->maxlength = 2;
                $objWidgetMorning->disabled  = ($strCurrentDate === date('Y-m-d')) ? false : true;

                $objWidgetNoon            = new \FormTextField();
                $objWidgetNoon->id        = 'countNoon_' . $strCurrentDate;
                $objWidgetNoon->class     = empty($objCounts->countNoon) ? 'emptyInput' : 'filledInput';
                $objWidgetNoon->value     = $objCounts->countNoon;
                $objWidgetNoon->name      = $strCurrentDate . '[countNoon]';
                $objWidgetNoon->maxlength = 2;
                $objWidgetNoon->disabled  = ($strCurrentDate === date('Y-m-d')) ? false : true;

                $objWidgetEvening            = new \FormTextField();
                $objWidgetEvening->id        = 'countEvening_' . $strCurrentDate;
                $objWidgetEvening->class     = empty($objCounts->countEvening) ? 'emptyInput' : 'filledInput';
                $objWidgetEvening->value     = $objCounts->countEvening;
                $objWidgetEvening->name      = $strCurrentDate . '[countEvening]';
                $objWidgetEvening->maxlength = 2;
                $objWidgetEvening->disabled  = ($strCurrentDate === date('Y-m-d')) ? false : true;
            }

            $intMktime       = mktime(0, 0, 0, $intMonth, $i, $intYear);
            $intWeekDay      = date("w", $intMktime);
            $strWeekDayShort = $GLOBALS['TL_LANG']['DAYS_SHORT'][$intWeekDay];

            $strBuffer .= '<td id="' . $strCurrentDate . '" class="tdCalendarDay">';
            $strBuffer .= '<div class="toggleInputDiv ';
            $strBuffer .= ($strCurrentDate === date('Y-m-d') ? 'active' : '') . '">';
            $strBuffer .= '<div class="dayOfWeek">' . $strWeekDayShort . '</div>';
            $strBuffer .= '<div class="dayOfMonth">' . $i . '</div></div>';

            $strBuffer .= $objWidgetDate->generate();
            $strBuffer .= !empty($this->objModuleModel->table_showTimeSlots) ?
                $strTimeSlots :
                $objWidgetMorning->generate() . $objWidgetNoon->generate() . $objWidgetEvening->generate();

            if (\Input::post('FORM_SUBMIT') == 'tl_table_occupancy') {
                $this->saveData($intMktime, $strCurrentDate, $objCounts, $intParentId);
            }
        }
        return $strBuffer;
    }

    /**
     * Stores the calendar form data in the database.
     *
     * @param int $intMktime Timestamp begin of current day
     * @param string $strCurrentDate Current date string in SQL format
     * @param object $objCounts Counts of seats for current day
     * @param int $intParentId Id of the parent category
     *
     */
    public function saveData($intMktime, $strCurrentDate, $objCounts, $intParentId)
    {
        $arrPostDate           = [];
        $arrPostDate['pid']    = $intParentId;
        $arrPostDate['tstamp'] = time();

        if (\Input::post('showPeriodOptions') &&
            $intMktime >= strtotime(\Input::post('startDate')) &&
            $intMktime <= strtotime(\Input::post('endDate'))
        ) {
            $arrPostDate['date'] = $strCurrentDate;
            if (!empty($this->objModuleModel->table_showTimeSlots)) {
                foreach ($this->getTimeSlotNames() as $strSlotName) {
                    $arrPostDate[$strSlotName] = \Input::post($strSlotName);
                }
            } else {
                $arrPostDate['countMorning'] = \Input::post('countMorning');
                $arrPostDate['countNoon']    = \Input::post('countNoon');
                $arrPostDate['countEvening'] = \Input::post('countEvening');
            }
        } else {
            $mixedPostDate = \Input::post($strCurrentDate);
            if (is_array($mixedPostDate)) {
                $arrPostDate = array_merge($mixedPostDate, $arrPostDate);
            }
        }

        if ($arrPostDate['date'] !== null && $objCounts->numRows > 0) {
            $objUpdate = $this->Database->prepare("
                UPDATE tl_table_occupancy
                %s 
                WHERE date=? 
                AND pid=?")
                ->set($arrPostDate)
                ->execute($strCurrentDate, $intParentId);
        }

        if ($arrPostDate['date'] !== null && $objCounts->numRows < 1) {
            $objInsert = $this->Database->prepare("INSERT INTO tl_table_occupancy %s")
                ->set($arrPostDate)
                ->execute();
        }
    }

    /**
     * Loads DCA fields according to the time slot option.
     *
     */
    public function loadFields()
    {
        if (!empty($this->objModuleModel->table_showTimeSlots)) {
            unset($GLOBALS['TL_DCA']['tl_table_occupancy']['fields']['countMorning']);
            unset($GLOBALS['TL_DCA']['tl_table_occupancy']['fields']['countNoon']);
            unset($GLOBALS['TL_DCA']['tl_table_occupancy']['fields']['countEvening']);


            foreach ($this->getTimeSlotNames() as $strSlotName) {
                foreach ($this->getTimeSlotTitles() as $strSlotTitle) {
                    $GLOBALS['TL_DCA']['tl_table_occupancy']['fields'][$strSlotName]['label']     = [
                        sprintf($GLOBALS['TL_LANG']['tl_table_occupancy']['countTimeSlot'][0], $strSlotTitle),
                        sprintf($GLOBALS['TL_LANG']['tl_table_occupancy']['countTimeSlot'][1], $strSlotTitle)
                    ];
                    $GLOBALS['TL_DCA']['tl_table_occupancy']['fields'][$strSlotName]['default']   = 0;
                    $GLOBALS['TL_DCA']['tl_table_occupancy']['fields'][$strSlotName]['inputType'] = 'text';
                    $GLOBALS['TL_DCA']['tl_table_occupancy']['fields'][$strSlotName]['search']    = true;
                    $GLOBALS['TL_DCA']['tl_table_occupancy']['fields'][$strSlotName]['sorting']   = true;
                    $GLOBALS['TL_DCA']['tl_table_occupancy']['fields'][$strSlotName]['filter']    = true;
                    $GLOBALS['TL_DCA']['tl_table_occupancy']['fields'][$strSlotName]['eval']      = [
                        'rgxp'     => 'digit',
                        'tl_class' => 'w50'
                    ];
                }
            }

            $GLOBALS['TL_DCA']['tl_table_occupancy']['subpalettes']['showPeriodOptions'] = str_replace(
                'countEvening',
                'countEvening,' . implode(',', $this->getTimeSlotNames()),
                $GLOBALS['TL_DCA']['tl_table_occupancy']['subpalettes']['showPeriodOptions']
            );
        }
    }

    /**
     * Redirect to edit current date when date already exists in DB.
     *
     */
    public function checkDate()
    {
        if (\Input::get('key') === 'reset') {
            $intId       = \Input::get('id');
            $objDbResult = \Database::getInstance()->prepare("
            DELETE FROM tl_table_occupancy 
            WHERE       pid=?")
                ->execute($intId);
        }

        $strCurrentDate = date('Y-m-d');
        $intParentId    = \Input::get('pid');
        $objDbResult    = \Database::getInstance()->prepare("
            SELECT  id 
            FROM    tl_table_occupancy 
            WHERE   date=? 
            AND     pid=?")
            ->execute($strCurrentDate, $intParentId);

        if ($objDbResult->numRows && (\Input::get('act') === 'create')) {
            $this->redirect($this->addToUrl('&table=tl_table_occupancy&act=edit&id=' . $objDbResult->id));
        }
    }

    /**
     * Sets the current date according to the date format settings.
     *
     * @return string
     */
    public function loadDate()
    {
        return date($GLOBALS['TL_CONFIG']['dateFormat']);
    }

    /**
     * Returns null so that the field is not saved to the DB ('doNotSaveEmpty' => true).
     *
     * @return null
     */
    public function doNotSaveDate()
    {
        return null;
    }

    /**
     * Specifies the look of every row of the reservation plan.
     *
     * @param array $arrRow Current row
     *
     * @return string
     */
    public function showCalendar($arrRow)
    {
        $strBuffer = '';

        if (!empty($this->objModuleModel->table_showTimeSlots)) {
            if (empty($this->getTimeSlotTitles())) {
                return sprintf(
                    '<span style="color:#cc3333;">%s</span>',
                    $GLOBALS['TL_LANG']['tl_table_occupancy']['noTimeSlot'][0]
                );
            }
            $strBuffer .= '<div>';
            $intCount  = 0;

            foreach ($this->getTimeSlotTitles() as $strSlotTitle) {
                foreach ($this->getTimeSlotNames() as $strSlotName) {
                    $strBuffer .= '<span style="color:#b3b3b3;">';
                    $strBuffer .= sprintf($GLOBALS['TL_LANG']['tl_table_occupancy']['countTimeSlot'][0], $strSlotTitle);
                    $strBuffer .= ': </span>[';
                    $strBuffer .= (!empty($arrRow[$strSlotName]) ?
                            $arrRow[$strSlotName] :
                            '<span style="color:#cc3333;">0</span>') . ']';
                    $intCount++;
                    $strBuffer .= ($intCount === count($this->getTimeSlotNames())) ? '' : ' <b>|</b> ';

                }
                $strBuffer .= '</div>';

                return $strBuffer;
            }
        }

        $strBuffer .= '<div>';
        $strBuffer .= '<span style="color:#b3b3b3;">';
        $strBuffer .= $GLOBALS['TL_LANG']['tl_table_occupancy']['countMorning'][0];
        $strBuffer .= ': </span>[';
        $strBuffer .= (!empty($arrRow['countMorning']) ?
            $arrRow['countMorning'] :
            '<span style="color:#cc3333;">0</span>');
        $strBuffer .= '] <b>|</b> ';
        $strBuffer .= '<span style="color:#b3b3b3;">';
        $strBuffer .= $GLOBALS['TL_LANG']['tl_table_occupancy']['countNoon'][0];
        $strBuffer .= ': </span>[';
        $strBuffer .= (!empty($arrRow['countNoon']) ?
            $arrRow['countNoon'] :
            '<span style="color:#cc3333;">0</span>');
        $strBuffer .= '] <b>|</b> ';
        $strBuffer .= '<span style="color:#b3b3b3;">';
        $strBuffer .= $GLOBALS['TL_LANG']['tl_table_occupancy']['countEvening'][0];
        $strBuffer .= ': </span>[';
        $strBuffer .= (!empty($arrRow['countEvening']) ?
            $arrRow['countEvening'] :
            '<span style="color:#cc3333;">0</span>');
        $strBuffer .= ']</div>';

        return $strBuffer;
    }
}
