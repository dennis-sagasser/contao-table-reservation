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
 * Callbacks
 */
$GLOBALS['TL_DCA']['tl_module']['config']['onload_callback'][] = ['tl_module_table_reservation', 'showJsLibraryHint'];

$GLOBALS['TL_DCA']['tl_module']['config']['onload_callback'][] = ['tl_table_reservation_list', 'formatDates'];

/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['table_reservation'] = '{title_legend},name,headline,type;{config_legend},table_dateTimeFormat,table_timeFormat,table_openingHours,table_showTimeSlots,table_leadTime,table_categories;{redirect_legend},jumpTo;{expert_legend:hide},guests,cssID,space';

/**
 * Subpalettes
 */

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['table_dateTimeFormat'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_module']['dateTimeFormat'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => ['rgxp' => 'extnd', 'decodeEntities' => true, 'tl_class' => 'w50'],
    'sql'       => "varchar(32) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_module']['fields']['table_timeFormat'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_module']['timeFormat'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => ['rgxp' => 'extnd', 'decodeEntities' => true, 'tl_class' => 'w50'],
    'sql'       => "varchar(32) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_module']['fields']['table_openingHours'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_module']['openingHours'],
    'exclude'   => true,
    'inputType' => 'multiColumnWizard',
    'eval'      => [
        'columnFields' => [
            'weekDay'  => [
                'label'            => &$GLOBALS['TL_LANG']['tl_module']['weekDay'],
                'exclude'          => true,
                'inputType'        => 'select',
                'options_callback' => [
                    'tl_module_table_reservation', 'getDays',
                ],
                'eval'             => [
                    'style'              => 'width:200px',
                    'includeBlankOption' => true,
                    'chosen'             => true
                ]
            ],
            'dayTime'  => [
                'label'            => &$GLOBALS['TL_LANG']['tl_module']['dayTime'],
                'exclude'          => true,
                'inputType'        => 'select',
                'options_callback' => [
                    'tl_module_table_reservation', 'getDayTimes',
                ],
                'eval'             => [
                    'style'              => 'width:200px',
                    'includeBlankOption' => true,
                    'chosen'             => true
                ]
            ],
            'openFrom' => [
                'label'     => &$GLOBALS['TL_LANG']['tl_module']['openFrom'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => [
                    'rgxp'       => 'time',
                    'datepicker' => true,
                    'tl_class'   => 'wizard',
                    'style'      => 'width:50px'
                ],
                'sql'       => "varchar(10) NOT NULL default ''"
            ],
            'openTo'   => [
                'label'     => &$GLOBALS['TL_LANG']['tl_module']['openTo'],
                'exclude'   => true,
                'inputType' => 'text',
                'eval'      => [
                    'rgxp'       => 'time',
                    'datepicker' => true,
                    'tl_class'   => 'wizard',
                    'style'      => 'width:50px'
                ],
                'sql'       => "varchar(10) NOT NULL default ''"
            ]
        ],
        'tl_class'     => 'clr long'
    ],
    'sql'       => "blob NULL"
];

$GLOBALS['TL_DCA']['tl_module']['fields']['table_showTimeSlots'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_module']['showTimeSlots'],
    'exclude'   => false,
    'inputType' => 'checkbox',
    'eval'      => ['mandatory' => false, 'isBoolean' => true, 'submitOnChange' => true, 'tl_class' => 'w50'],
    'sql'       => "char(1) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_module']['fields']['table_leadTime'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_module']['leadTime'],
    'exclude'   => true,
    'inputType' => 'timePeriod',
    'options'   => ['minutes', 'hours', 'days', 'weeks'],
    'reference' => &$GLOBALS['TL_LANG']['tl_module'],
    'eval'      => ['mandatory' => true, 'rgxp' => 'natural', 'minval' => 0, 'tl_class' => 'w50'],
    'sql'       => "varchar(64) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_module']['fields']['table_categories'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_module']['tableCategories'],
    'exclude'          => true,
    'inputType'        => 'checkbox',
    'options_callback' => ['tl_module_table_reservation', 'getTableCategories'],
    'eval'             => ['mandatory' => true, 'multiple' => true],
    'sql'              => "blob NULL"
];