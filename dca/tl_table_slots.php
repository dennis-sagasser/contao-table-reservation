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
 * Table tl_table_slots
 */
$GLOBALS['TL_DCA']['tl_table_slots'] = [
    // Config
    'config'   => [
        'dataContainer'     => 'Table',
        'sql'               => [
            'keys' => [
                'id' => 'primary',
            ]
        ],
        'onload_callback'   => [
            ['tl_table_list', 'formatDates'],
        ],
        'onsubmit_callback' => [
            ['tl_table_slots', 'editTimeSlot'],
        ],
        'ondelete_callback' => [
            ['tl_table_slots', 'deleteTimeSlot'],
        ],
    ],
    // List
    'list'     => [
        'sorting'    => [
            'mode'        => 2,
            'flag'        => 1,
            'panelLayout' => 'filter,custom_filters;search,sort,limit',
            'fields'      => ['name ASC'],
        ],
        'label'      => [
            'fields'      => ['id', 'title', 'name', 'fromTime', 'toTime'],
            'showColumns' => true,
        ],
        'operations' => [
            'edit'   => [
                'label' => &$GLOBALS['TL_LANG']['tl_table_slots']['edit'],
                'href'  => 'act=edit',
                'icon'  => 'edit.gif'
            ],
            'delete' => [
                'label'      => &$GLOBALS['TL_LANG']['tl_table_slots']['delete'],
                'href'       => 'act=delete',
                'icon'       => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['tl_table_slots']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
            ],
            'toggle' => [
                'label'           => &$GLOBALS['TL_LANG']['tl_table_slots']['toggle'],
                'icon'            => 'visible.gif',
                'attributes'      => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback' => ['tl_table_slots', 'toggleIcon']
            ],
        ]
    ],
    // Palettes
    'palettes' => [
        'default' => 'title,name,fromTime,toTime,published'
    ],
    // Fields
    'fields'   => [
        'id'        => [
            'sql'   => "int(10) unsigned NOT NULL auto_increment",
            'label' => '#',
        ],
        'tstamp'    => [
            'inputType' => 'text',
            'sql'       => "int(10) unsigned NOT NULL",
        ],
        'title'     => [
            'label'     => &$GLOBALS['TL_LANG']['tl_table_slots']['title'],
            'sql'       => "varchar(64) NOT NULL default ''",
            'flag'      => 1,
            'search'    => true,
            'sorting'   => true,
            'filter'    => true,
            'inputType' => 'text',
            'eval'      => [
                'minlength' => 5,
                'maxlength' => 64,
                'rgxp'      => 'extnd',
                'mandatory' => true,
                'tl_class'  => 'w50',
            ],
        ],
        'name'      => [
            'label'         => &$GLOBALS['TL_LANG']['tl_table_slots']['name'],
            'sql'           => "varchar(16) NOT NULL default ''",
            'flag'          => 1,
            'search'        => true,
            'sorting'       => true,
            'filter'        => true,
            'inputType'     => 'text',
            'eval'          => [
                'minlength'         => 5,
                'maxlength'         => 64,
                'spaceToUnderscore' => true,
                'rgxp'              => 'fieldname',
                'mandatory'         => true,
                'tl_class'          => 'w50',
                'unique'            => true,
            ],
            'load_callback' => [['tl_table_slots', 'cacheTableName']],
            'save_callback' => [['tl_table_slots', 'prepareSqlColumnName']],
        ],
        'fromTime'  => [
            'label'         => &$GLOBALS['TL_LANG']['tl_table_slots']['fromTime'],
            'sql'           => "int(10) unsigned NOT NULL default '0'",
            'default'       => mktime(0, 0, 0),
            'search'        => true,
            'sorting'       => true,
            'flag'          => 6,
            'inputType'     => 'text',
            'eval'          => [
                'rgxp'       => 'time',
                'datepicker' => true,
                'mandatory'  => true,
                'tl_class'   => 'w50 wizard clr'
            ],
            'save_callback' => [
                ['tl_table_slots', 'saveFromTime']
            ],
        ],
        'toTime'    => [
            'label'         => &$GLOBALS['TL_LANG']['tl_table_slots']['toTime'],
            'sql'           => "int(10) unsigned NOT NULL default '0'",
            'default'       => mktime(23, 59, 59),
            'search'        => true,
            'sorting'       => true,
            'flag'          => 6,
            'inputType'     => 'text',
            'eval'          => [
                'rgxp'       => 'time',
                'datepicker' => true,
                'mandatory'  => true,
                'tl_class'   => 'w50 wizard'
            ],
            'save_callback' => [
                ['tl_table_slots', 'saveToTime']
            ],
        ],
        'published' => [
            'label'     => &$GLOBALS['TL_LANG']['tl_table_slots']['published'],
            'sql'       => "char(1) NOT NULL default ''",
            'filter'    => true,
            'flag'      => 2,
            'inputType' => 'checkbox',
            'eval'      => [
                'doNotCopy' => true,
                'tl_class'  => 'w50'
            ]
        ]
    ],
];