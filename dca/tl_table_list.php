<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2017 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 7
 *
 * @category  Contao
 * @package   TableReservation
 * @author    Dennis Sagasser <sagasser@gispack.com>
 * @copyright 2017 Dennis Sagasser
 * @license   http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * @link      https://contao.org
 */

/**
 * Table tl_table_list
 */
$GLOBALS['TL_DCA']['tl_table_list'] = [
    // Config
    'config'   => [
        'dataContainer'   => 'Table',
        'sql'             => [
            'keys' => [
                'id' => 'primary',
            ]
        ],
        'onload_callback' => [
            ['tl_table_list', 'formatDates'],
            ['tl_table_list', 'applyFilter'],
        ]
    ],
    // List
    'list'     => [
        'sorting'    => [
            'mode'           => 2,
            'panelLayout'    => 'filter,custom_filters;search,sort,limit',
            'fields'         => ['id ASC'],
            'panel_callback' => [
                'custom_filters' => ['tl_table_list', 'generateFilter'],
            ],
        ],
        'label'      => [
            'fields'         => ['arrival', 'seats', 'firstname', 'lastname'],
            'format'         => '<em>%s</em> <b>|</b> %s <b>|</b> %s %s',
            'label_callback' => [
                'tl_table_list', 'listReservations',
            ],
        ],
        'operations' => [
            'edit'   => [
                'label' => &$GLOBALS['TL_LANG']['tl_table_list']['edit'],
                'href'  => 'act=edit',
                'icon'  => 'edit.gif'
            ],
            'copy'   => [
                'label' => &$GLOBALS['TL_LANG']['tl_table_list']['copy'],
                'href'  => 'act=copy',
                'icon'  => 'copy.gif'
            ],
            'show'   => [
                'label' => &$GLOBALS['TL_LANG']['tl_table_list']['show'],
                'href'  => 'act=show',
                'icon'  => 'show.gif'
            ],
            'delete' => [
                'label'      => &$GLOBALS['TL_LANG']['tl_table_list']['delete'],
                'href'       => 'act=delete',
                'icon'       => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['tl_table_list']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
            ],
        ]
    ],
    // Palettes
    'palettes' => [
        'default' => '{reservation_legend},arrival,seats;{guest_legend},gender,lastname,firstname,phone,email,remarks;'
    ],
    // Fields
    'fields'   => [
        'id'        => [
            'sql'     => "int(10) unsigned NOT NULL auto_increment",
            'sorting' => true,
        ],
        'tstamp'    => [
            'inputType' => 'text',
            'sql'       => "int(10) unsigned NOT NULL",
        ],
        'arrival'   => [
            'label'     => &$GLOBALS['TL_LANG']['tl_table_list']['arrival'],
            'sql'       => "int(10) unsigned NOT NULL default '0'",
            'flag'      => 5,
            'search'    => true,
            'sorting'   => true,
            'filter'    => true,
            'inputType' => 'text',
            'default'   => time(),
            'eval'      => [
                'rgxp'       => 'datim',
                'datepicker' => true,
                'mandatory'  => true,
            ],
        ],
        'departure' => [
            'label' => &$GLOBALS['TL_LANG']['tl_table_list']['departure'],
            'sql'   => "int(10) unsigned NULL",
            'eval'  => [
                'rgxp' => 'datim',
            ]
        ],
        'seats'     => [
            'label'     => &$GLOBALS['TL_LANG']['tl_table_list']['seats'],
            'exclude'   => true,
            'inputType' => 'multiColumnWizard',
            'sql'       => "blob NOT NULL",
            'eval'      => [
                'mandatory'    => true,
                'columnFields' => [
                    'count'    => [
                        'label'            => &$GLOBALS['TL_LANG']['tl_table_list']['count'],
                        'inputType'        => 'select',
                        'options_callback' => [
                            'tl_table_list', 'getCount',
                        ],
                        'reference'        => &$GLOBALS['TL_LANG']['MSC'],
                        'eval'             => [
                            'mandatory'          => true,
                            'style'              => 'width:200px',
                            'includeBlankOption' => true,
                            'chosen'             => true
                        ],
                    ],
                    'category' => [
                        'label'            => &$GLOBALS['TL_LANG']['tl_table_list']['category'],
                        'inputType'        => 'select',
                        'options_callback' => [
                            'tl_table_list', 'getCatergory',
                        ],
                        'reference'        => &$GLOBALS['TL_LANG']['MSC'],
                        'eval'             => [
                            'mandatory'          => true,
                            'style'              => 'width:200px',
                            'includeBlankOption' => true,
                            'chosen'             => true
                        ],
                    ],
                ]
            ]
        ],
        'gender'    => [
            'label'     => &$GLOBALS['TL_LANG']['tl_table_list']['salutation'],
            'inputType' => 'select',
            'options'   => ['male', 'female'],
            'reference' => &$GLOBALS['TL_LANG']['MSC'],
            'eval'      => ['includeBlankOption' => true],
            'sql'       => "varchar(32) NOT NULL default ''"
        ],
        'lastname'  => [
            'inputType' => 'text',
            'label'     => &$GLOBALS['TL_LANG']['tl_table_list']['lastname'],
            'sql'       => "varchar(255) NOT NULL default ''",
            'search'    => true,
            'sorting'   => true,
            'filter'    => true,
            'eval'      => [
                'rgxp'     => 'alpha',
                'tl_class' => 'w50',
            ],
        ],
        'firstname' => [
            'inputType' => 'text',
            'label'     => &$GLOBALS['TL_LANG']['tl_table_list']['firstname'],
            'sql'       => "varchar(255) NOT NULL default ''",
            'eval'      => [
                'rgxp'     => 'alpha',
                'tl_class' => 'w50'
            ],
        ],
        'phone'     => [
            'inputType' => 'text',
            'label'     => &$GLOBALS['TL_LANG']['tl_table_list']['phone'],
            'sql'       => "varchar(255) NULL",
            'eval'      => [
                'rgxp'      => 'phone',
                'tl_class'  => 'w50',
                'mandatory' => true
            ],
        ],
        'email'     => [
            'inputType' => 'text',
            'label'     => &$GLOBALS['TL_LANG']['tl_table_list']['email'],
            'sql'       => "varchar(255) NOT NULL default ''",
            'search'    => true,
            'sorting'   => true,
            'eval'      => [
                'rgxp'     => 'email',
                'tl_class' => 'w50'
            ],
        ],
        'remarks'   => [
            'inputType' => 'textarea',
            'label'     => &$GLOBALS['TL_LANG']['tl_table_list']['remarks'],
            'sql'       => "text NULL",
        ],
    ],
];