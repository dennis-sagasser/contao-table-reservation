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
$GLOBALS['TL_DCA']['tl_table_occupancy'] = [
    // Config
    'config'      => [
        'dataContainer'    => 'Table',
        'ptable'           => 'tl_table_category',
        'switchToEdit'     => false,
        'enableVersioning' => false,
        'sql'              => [
            'keys' => [
                'id'  => 'primary',
                'pid' => 'index'
            ]
        ],
        'onload_callback'  => [
            ['tl_table_occupancy', 'checkDate'],
            ['tl_table_occupancy', 'loadFields'],
        ],
    ],
    // List
    'list'        => [
        'sorting' => [
            'mode'                  => 4,
            'headerFields'          => ['tablecategory', 'published'],
            'panelLayout'           => 'filter,limit;search,sort',
            'fields'                => ['date DESC'],
            'child_record_callback' => ['tl_table_occupancy', 'showCalendar'],
        ],
    ],
    // Palettes
    'palettes'    => [
        '__selector__' => ['showPeriodOptions'],
        'default'      => '{date_legend},showPeriodOptions;{calendar_legend},calendar'
    ],
    // Subpalettes
    'subpalettes' => [
        'showPeriodOptions' => 'startDate,endDate,countMorning,countNoon,countEvening'
    ],

    // Fields
    'fields'      => [
        'id'                => [
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ],
        'pid'               => [
            'foreignKey' => 'tl_table_category.table_category',
            'sql'        => "int(10) unsigned NOT NULL default '0'",
            'relation'   => ['type' => 'belongsTo', 'load' => 'eager']
        ],
        'tstamp'            => [
            'default' => time(),
            'sql'     => "int(10) unsigned NOT NULL default '0'"
        ],
        'showPeriodOptions' => [
            'label'     => &$GLOBALS['TL_LANG']['tl_table_occupancy']['showPeriodOptions'],
            'exclude'   => false,
            'inputType' => 'checkbox',
            'eval'      => ['mandatory' => false, 'isBoolean' => true, 'submitOnChange' => true],
            'sql'       => "char(1) NOT NULL default ''"
        ],
        'startDate'         => [
            'label'         => &$GLOBALS['TL_LANG']['tl_table_occupancy']['startDate'],
            'inputType'     => 'text',
            'eval'          => [
                'doNotSaveEmpty' => true,
                'rgxp'           => 'date',
                'doNotCopy'      => true,
                'datepicker'     => true,
                'tl_class'       => 'w50 wizard',
                'mandatory'      => true
            ],
            'sql'           => "int(10) unsigned NULL",
            'load_callback' => [
                ['tl_table_occupancy', 'loadDate'],
            ],
            'save_callback' => [
                ['tl_table_occupancy', 'doNotSaveDate'],
            ],
        ],
        'endDate'           => [
            'label'         => &$GLOBALS['TL_LANG']['tl_table_occupancy']['endDate'],
            'inputType'     => 'text',
            'eval'          => [
                'doNotSaveEmpty' => true,
                'rgxp'           => 'date',
                'doNotCopy'      => true,
                'datepicker'     => true,
                'tl_class'       => 'w50 wizard',
                'mandatory'      => true
            ],
            'sql'           => "int(10) unsigned NULL",
            'save_callback' => [
                ['tl_table_occupancy', 'doNotSaveDate'],
            ],
        ],
        'date'              => [
            'label'     => &$GLOBALS['TL_LANG']['tl_table_occupancy']['date'],
            'default'   => date('Y-m-d'),
            'inputType' => 'text',
            'filter'    => true,
            'search'    => true,
            'sorting'   => true,
            'eval'      => [
                'rgxp'       => 'date',
                'doNotCopy'  => true,
                'datepicker' => true,
                'tl_class'   => 'w50 wizard'
            ],
            'sql'       => "date NOT NULL"
        ],
        'countMorning'      => [
            'label'     => &$GLOBALS['TL_LANG']['tl_table_occupancy']['countMorning'],
            'default'   => 0,
            'inputType' => 'text',
            'search'    => true,
            'sorting'   => true,
            'filter'    => true,
            'eval'      => ['rgxp' => 'digit', 'tl_class' => 'w50'],
            'sql'       => "smallint(3) unsigned NULL"
        ],
        'countNoon'         => [
            'label'     => &$GLOBALS['TL_LANG']['tl_table_occupancy']['countNoon'],
            'default'   => 0,
            'inputType' => 'text',
            'search'    => true,
            'sorting'   => true,
            'filter'    => true,
            'eval'      => ['rgxp' => 'digit', 'tl_class' => 'w50'],
            'sql'       => "smallint(3) unsigned NULL"
        ],
        'countEvening'      => [
            'label'     => &$GLOBALS['TL_LANG']['tl_table_occupancy']['countEvening'],
            'default'   => 0,
            'inputType' => 'text',
            'search'    => true,
            'sorting'   => true,
            'filter'    => true,
            'eval'      => ['rgxp' => 'digit', 'tl_class' => 'w50'],
            'sql'       => "smallint(3) unsigned NULL"
        ],
        'calendar'          => [
            'input_field_callback' => [
                'tl_table_occupancy', 'generateCalendarWidget'
            ],
        ],
    ]
];
