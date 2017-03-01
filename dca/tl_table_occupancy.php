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
 * Class ModuleTableReservation
 *
 * Specifies insert tags for the confirmation mail to the customer.
 *
 * @category  Contao
 * @package   TableReservation
 * @author    Dennis Sagasser <sagasser@gispack.com>
 * @copyright 2017 Dennis Sagasser
 * @license   http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * @link      https://contao.org
 */

/**
 * Table tl_table_occupancy
 */
$GLOBALS['TL_DCA']['tl_table_occupancy'] = array
(
    // Config
    'config'      => array
    (
        'dataContainer'    => 'Table',
        'ptable'           => 'tl_table_category',
        'switchToEdit'     => false,
        'enableVersioning' => false,
        'sql'              => array
        (
            'keys' => array
            (
                'id'  => 'primary',
                'pid' => 'index'
            )
        ),
        'onload_callback'  => array
        (
            array('tl_table_occupancy', 'checkDate'),
        ),
    ),
    // List
    'list'        => array
    (
        'sorting' => array
        (
            'mode'                  => 4,
            'headerFields'          => array('table_category', 'published'),
            'panelLayout'           => 'filter,limit;search,sort',
            'fields'                => array('date ASC'),
            'child_record_callback' => array('tl_table_occupancy', 'showCalendar'),
        ),
    ),
    // Palettes
    'palettes'    => array
    (
        '__selector__' => array('showPeriodOptions'),
        'default'      => '{date_legend},showPeriodOptions;{calendar_legend},calendar'
    ),
    // Subpalettes
    'subpalettes' => array
    (
        'showPeriodOptions' => 'startDate,endDate,countMorning,countNoon,countEvening'
    ),

    // Fields
    'fields'      => array
    (
        'id'                => array
        (
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),
        'pid'               => array
        (
            'foreignKey' => 'tl_table_category.table_category',
            'sql'        => "int(10) unsigned NOT NULL default '0'",
            'relation'   => array('type' => 'belongsTo', 'load' => 'eager')
        ),
        'tstamp'            => array
        (
            'default' => time(),
            'sql'     => "int(10) unsigned NOT NULL default '0'"
        ),
        'showPeriodOptions' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_occupancy']['showPeriodOptions'],
            'exclude'   => false,
            'inputType' => 'checkbox',
            'eval'      => array('mandatory' => false, 'isBoolean' => true, 'submitOnChange' => true),
            'sql'       => "char(1) NOT NULL default ''"
        ),
        'startDate'         => array
        (
            'label'         => &$GLOBALS['TL_LANG']['tl_table_occupancy']['startDate'],
            'inputType'     => 'text',
            'eval'          => array
            (
                'doNotSaveEmpty' => true,
                'rgxp'           => 'date',
                'doNotCopy'      => true,
                'datepicker'     => true,
                'tl_class'       => 'w50 wizard',
                'mandatory'      => true
            ),
            'sql'           => "int(10) unsigned NULL",
            'load_callback' => array
            (
                array('tl_table_occupancy', 'loadDate'),
            ),
            'save_callback' => array
            (
                array('tl_table_occupancy', 'doNotSaveDate'),
            ),
        ),
        'endDate'           => array
        (
            'label'         => &$GLOBALS['TL_LANG']['tl_table_occupancy']['endDate'],
            'inputType'     => 'text',
            'eval'          => array
            (
                'doNotSaveEmpty' => true,
                'rgxp'           => 'date',
                'doNotCopy'      => true,
                'datepicker'     => true,
                'tl_class'       => 'w50 wizard',
                'mandatory'      => true
            ),
            'sql'           => "int(10) unsigned NULL",
            'save_callback' => array
            (
                array('tl_table_occupancy', 'doNotSaveDate'),
            ),
        ),
        'date'              => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_occupancy']['date'],
            'default'   => date('Y-m-d'),
            'inputType' => 'text',
            'search'    => true,
            'sorting'   => true,
            'eval'      => array
            (
                'rgxp'       => 'date',
                'doNotCopy'  => true,
                'datepicker' => true,
                'tl_class'   => 'w50 wizard'
            ),
            'sql'       => "date NOT NULL"
        ),
        'countMorning'      => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_occupancy']['countMorning'],
            'default'   => 0,
            'inputType' => 'text',
            'search'    => true,
            'sorting'   => true,
            'filter'    => true,
            'eval'      => array('rgxp' => 'digit', 'tl_class' => 'w50'),
            'sql'       => "smallint(3) unsigned NULL"
        ),
        'countNoon'         => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_occupancy']['countNoon'],
            'default'   => 0,
            'inputType' => 'text',
            'search'    => true,
            'sorting'   => true,
            'filter'    => true,
            'eval'      => array('rgxp' => 'digit', 'tl_class' => 'w50'),
            'sql'       => "smallint(3) unsigned NULL"
        ),
        'countEvening'      => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_occupancy']['countEvening'],
            'default'   => 0,
            'inputType' => 'text',
            'search'    => true,
            'sorting'   => true,
            'filter'    => true,
            'eval'      => array('rgxp' => 'digit', 'tl_class' => 'w50'),
            'sql'       => "smallint(3) unsigned NULL"
        ),
        'calendar'          => array
        (
            'input_field_callback' => array
            (
                'tl_table_occupancy', 'generateCalendarWidget'
            ),
        ),
    )
);

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
     * Parent call of the constructor.
     *
     */
    public function __construct()
    {
        parent::__construct();
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

        $intYear        = Input::get('intYear');
        $intCurrentYear = isset($intYear) ? Input::get('intYear') : (int)Date::parse('Y');

        $strHtmlYearCalendar = '<div><table class="calendarWidget">';
        $strHtmlYearCalendar .= '<caption><h3><a href=' . Environment::get('requestUri') . '&intYear=' . ($intCurrentYear - 1) . '>«</a>&nbsp;' . $GLOBALS['TL_LANG']['tl_table_occupancy']['year'][0] . '&nbsp;' . $intCurrentYear . '&nbsp;<a href=' . Environment::get('uri') . '&intYear=' . ($intCurrentYear + 1) . '>»</a></h3></caption>';

        $intCurrentMonth = 0;
        $intParentId     = $dc->activeRecord->pid;

        $strMorningSrc = 'system/modules/table_reservation/assets/images/sunrise16.png';
        $strNoonSrc    = 'system/modules/table_reservation/assets/images/sun16.png';
        $strEveningSrc = 'system/modules/table_reservation/assets/images/moon16.png';

        $strMorningAlt = $GLOBALS['TL_LANG']['tl_table_occupancy']['morningAlt'];
        $strNoonAlt    = $GLOBALS['TL_LANG']['tl_table_occupancy']['noonAlt'];
        $strEveningAlt = $GLOBALS['TL_LANG']['tl_table_occupancy']['eveningAlt'];

        $strMorningAttr = 'title="' . $GLOBALS['TL_LANG']['tl_table_occupancy']['morningTitle'] . '""';
        $strNoonAltAttr = 'title="' . $GLOBALS['TL_LANG']['tl_table_occupancy']['noonTitle'] . '""';
        $strEveningAttr = 'title="' . $GLOBALS['TL_LANG']['tl_table_occupancy']['eveningTitle'] . '"';

        while ($intCurrentMonth < 12) {
            $strMonthNameShort = $GLOBALS['TL_LANG']['MONTHS_SHORT'][$intCurrentMonth];
            $strHtmlYearCalendar .= '<tr>';
            $strHtmlYearCalendar .= '<td class="shortMonthColumn"><div class="shortMonthName">' . $strMonthNameShort . '</div><br>';
            $strHtmlYearCalendar .= \Image::getHtml($strMorningSrc, $strMorningAlt, $strMorningAttr);
            $strHtmlYearCalendar .= \Image::getHtml($strNoonSrc, $strNoonAlt, $strNoonAltAttr);
            $strHtmlYearCalendar .= \Image::getHtml($strEveningSrc, $strEveningAlt, $strEveningAttr);
            $strHtmlYearCalendar .= $this->datesMonth(++$intCurrentMonth, $intCurrentYear, $intParentId);
            $strHtmlYearCalendar .= '</td>';
            $strHtmlYearCalendar .= '</tr>';
        }

        $strHtmlYearCalendar .= '</table></div>';

        return $strHtmlYearCalendar;
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

            $objDbSelectResult = $this->Database->prepare("   
                SELECT  countMorning, countNoon, countEvening
                FROM    tl_table_occupancy 
                WHERE   date=? 
                AND     pid=?")
                ->execute($strCurrentDate, $intParentId);

            $mktime          = mktime(0, 0, 0, $intMonth, $i, $intYear);
            $intWeekDay      = date("w", $mktime);
            $strWeekDayShort = $GLOBALS['TL_LANG']['DAYS_SHORT'][$intWeekDay];

            $strHtmlYearCalendar .= '<td id="' . $strCurrentDate . '" class="tdCalendarDay">';
            $strHtmlYearCalendar .= '<div class="toggleInputDiv ' . ($strCurrentDate === date('Y-m-d') ? 'active' : '') . '"><div class="dayOfWeek">' . $strWeekDayShort . '</div>';
            $strHtmlYearCalendar .= '<div class="dayOfMonth">' . $i . '</div></div>
                <input id="ctrl_date_' . $strCurrentDate . '" type="hidden" value="' . $strCurrentDate . '" name="' . $strCurrentDate . '[date]" ' . ($strCurrentDate === date('Y-m-d') ? '' : 'disabled') . '>    
                <input id="ctrl_countMorning_' . $strCurrentDate . '" type="text" value="' . $objDbSelectResult->countMorning . '" name="' . $strCurrentDate . '[countMorning]" maxlength="2" ' . ($strCurrentDate === date('Y-m-d') ? '' : 'disabled') . ' class="' . ($classInput = ($objDbSelectResult->countMorning < 1) ? 'emptyInput' : 'filledInput') . '">
                <input id="ctrl_countNoon_' . $strCurrentDate . '" type="text" value="' . $objDbSelectResult->countNoon . '" name="' . $strCurrentDate . '[countNoon]" maxlength="6" ' . ($strCurrentDate === date('Y-m-d') ? '' : 'disabled') . ' class="' . ($classInput = ($objDbSelectResult->countNoon < 1) ? 'emptyInput' : 'filledInput') . '">
                <input id="ctrl_countEvening_' . $strCurrentDate . '" type="text" value="' . $objDbSelectResult->countEvening . '" name="' . $strCurrentDate . '[countEvening]" maxlength="2" ' . ($strCurrentDate === date('Y-m-d') ? '' : 'disabled') . ' class="' . ($classInput = ($objDbSelectResult->countEvening < 1) ? 'emptyInput' : 'filledInput') . '"></td>
            ';

            if (Input::post('FORM_SUBMIT') == 'tl_table_occupancy') {

                if (Input::post('showPeriodOptions') && $mktime >= strtotime(Input::post('startDate')) && $mktime <= strtotime(Input::post('endDate'))) {

                    $postDate                 = array();
                    $postDate['date']         = $strCurrentDate;
                    $postDate['countMorning'] = Input::post('countMorning');
                    $postDate['countNoon']    = Input::post('countNoon');
                    $postDate['countEvening'] = Input::post('countEvening');

                } else {

                    $postDate = Input::post($strCurrentDate);

                }

                if ($postDate['date'] !== null && $objDbSelectResult->numRows > 0) {

                    $objDbResult = $this->Database->prepare("
                        UPDATE  tl_table_occupancy
                        SET     pid=?, tstamp=?, date=?, countMorning=?, countNoon=?, countEvening=?
                        WHERE   date=? 
                        AND     pid=?")
                        ->execute($intParentId,
                            time(),
                            $strCurrentDate,
                            $postDate['countMorning'],
                            $postDate['countNoon'],
                            $postDate['countEvening'],
                            $postDate['date'],
                            $intParentId);
                }

                if ($postDate['date'] !== null && $objDbSelectResult->numRows < 1) {

                    $objDbResult = $this->Database->prepare("
                        INSERT INTO tl_table_occupancy (pid, tstamp, date, countMorning, countNoon, countEvening)
                        VALUES(?,?,?,?,?,?)")
                        ->execute($intParentId,
                            time(),
                            $strCurrentDate,
                            $postDate['countMorning'],
                            $postDate['countNoon'],
                            $postDate['countEvening']);
                }
            }
        }
        return $strHtmlYearCalendar;
    }

    /**
     * Redirect to edit current date when date already exists in DB.
     *
     */
    public function checkDate()
    {
        if (Input::get('key') === 'reset') {
            $intId       = Input::get('id');
            $objDbResult = Database::getInstance()->prepare("
            DELETE FROM tl_table_occupancy 
            WHERE       pid=?")
                ->execute($intId);
        }

        $strCurrentDate = date('Y-m-d');
        $intParentId    = Input::get('pid');
        $objDbResult    = Database::getInstance()->prepare("
            SELECT  id 
            FROM    tl_table_occupancy 
            WHERE   date=? 
            AND     pid=?")
            ->execute($strCurrentDate, $intParentId);

        if ($objDbResult->numRows && (Input::get('act') === 'create')) {
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
        return '<div><span style="color:#b3b3b3;">' . $GLOBALS['TL_LANG']['tl_table_occupancy']['countMorning'][0] . ': </span>[' . ($arrRow['countMorning'] > 0 ? $arrRow['countMorning'] : '<span style="color:#cc3333;">' . $arrRow['countMorning'] . '</span>') . '] <b>|</b> '
            . '<span style="color:#b3b3b3;">' . $GLOBALS['TL_LANG']['tl_table_occupancy']['countNoon'][0] . ': </span>[' . ($arrRow['countNoon'] > 0 ? $arrRow['countNoon'] : '<span style="color:#cc3333;">' . $arrRow['countNoon'] . '</span>') . '] <b>|</b> '
            . '<span style="color:#b3b3b3;">' . $GLOBALS['TL_LANG']['tl_table_occupancy']['countEvening'][0] . ': </span>[' . ($arrRow['countEvening'] > 0 ? $arrRow['countEvening'] : '<span style="color:#cc3333;">' . $arrRow['countEvening'] . '</span>') . ']</div>';
    }
}
