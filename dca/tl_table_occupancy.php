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
