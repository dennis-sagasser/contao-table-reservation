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
 * Table tl_table_reservation_list
 */
$GLOBALS['TL_DCA']['tl_table_reservation_list'] = array
(
    // Config
    'config'   => array
    (
        'dataContainer'   => 'Table',
        'sql'             => array
        (
            'keys' => array
            (
                'id' => 'primary',
            )
        ),
        'onload_callback' => array
        (
            array('tl_table_reservation_list', 'formatDates')
        )
    ),
    // List
    'list'     => array
    (
        'sorting'    => array
        (
            'mode'        => 2,
            'panelLayout' => 'filter;search,sort,limit',
            'fields'      => array('id ASC'),
        ),
        'label'      => array
        (
            'fields' => array('arrival', 'seats', 'firstname', 'lastname'),
            'format' => '<em>%s</em> <b>|</b> %s <b>|</b> %s %s',
        ),
        'operations' => array
        (
            'edit'   => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_table_reservation_list']['edit'],
                'href'  => 'act=edit',
                'icon'  => 'edit.gif'
            ),
            'copy'   => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_table_reservation_list']['copy'],
                'href'  => 'act=copy',
                'icon'  => 'copy.gif'
            ),
            'show'   => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_table_reservation_list']['show'],
                'href'  => 'act=show',
                'icon'  => 'show.gif'
            ),
            'delete' => array
            (
                'label'      => &$GLOBALS['TL_LANG']['tl_table_reservation_list']['delete'],
                'href'       => 'act=delete',
                'icon'       => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['tl_table_reservation_list']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
            ),
        )
    ),
    // Palettes
    'palettes' => array
    (
        'default' => '{reservation_legend},arrival,seats;{guest_legend},gender,lastname,firstname,phone,email,remarks;'
    ),
    // Fields
    'fields'   => array
    (
        'id'        => array
        (
            'sql'     => "int(10) unsigned NOT NULL auto_increment",
            'sorting' => true,
        ),
        'tstamp'    => array
        (
            'inputType' => 'text',
            'sql'       => "int(10) unsigned NOT NULL",
        ),
        'arrival'   => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_reservation_list']['arrival'],
            'sql'       => "int(10) unsigned NOT NULL default '0'",
            'flag'      => 6,
            'search'    => true,
            'sorting'   => true,
            'filter'    => true,
            'inputType' => 'text',
            'default'   => time(),
            'eval'      => array
            (
                'rgxp'       => 'datim',
                'datepicker' => true,
                'mandatory'  => true,

            ),
        ),
        'seats'     => array
        (
            'inputType' => 'listWizard',
            'label'     => &$GLOBALS['TL_LANG']['tl_table_reservation_list']['seats'],
            'sql'       => "blob NOT NULL",
            'eval'      => array
            (
                'mandatory' => true,
            ),

        ),
        'gender'    => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_reservation_list']['salutation'],
            'inputType' => 'select',
            'options'   => array('male', 'female'),
            'reference' => &$GLOBALS['TL_LANG']['MSC'],
            'eval'      => array('includeBlankOption' => true),
            'sql'       => "varchar(32) NOT NULL default ''"
        ),
        'lastname'  => array
        (
            'inputType' => 'text',
            'label'     => &$GLOBALS['TL_LANG']['tl_table_reservation_list']['lastname'],
            'sql'       => "varchar(255) NOT NULL default ''",
            'search'    => true,
            'sorting'   => true,
            'filter'    => true,
            'eval'      => array
            (
                'rgxp'      => 'alpha',
                'tl_class'  => 'w50',
                'mandatory' => true,
            ),
        ),
        'firstname' => array
        (
            'inputType' => 'text',
            'label'     => &$GLOBALS['TL_LANG']['tl_table_reservation_list']['firstname'],
            'sql'       => "varchar(255) NOT NULL default ''",
            'eval'      => array
            (
                'rgxp'     => 'alpha',
                'tl_class' => 'w50'
            ),
        ),
        'phone'     => array
        (
            'inputType' => 'text',
            'label'     => &$GLOBALS['TL_LANG']['tl_table_reservation_list']['phone'],
            'sql'       => "varchar(255) NULL",
            'eval'      => array
            (
                'rgxp'      => 'phone',
                'tl_class'  => 'w50',
                'mandatory' => true

            ),
        ),
        'email'     => array
        (
            'inputType' => 'text',
            'label'     => &$GLOBALS['TL_LANG']['tl_table_reservation_list']['email'],
            'sql'       => "varchar(255) NOT NULL default ''",
            'search'    => true,
            'sorting'   => true,
            'eval'      => array
            (
                'rgxp'     => 'email',
                'tl_class' => 'w50'
            ),
        ),
        'remarks'   => array
        (
            'inputType' => 'textarea',
            'label'     => &$GLOBALS['TL_LANG']['tl_table_reservation_list']['remarks'],
            'sql'       => "text NULL",
        ),
    )
);