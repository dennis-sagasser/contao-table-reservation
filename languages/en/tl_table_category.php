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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_table_category']['table_category'] = ['Table category', 'Please enter the description of the table category.'];
$GLOBALS['TL_LANG']['tl_table_category']['maxcount']       = ['Maximum amount of persons', 'Please enter the maximum number of possible seat reservations.'];
$GLOBALS['TL_LANG']['tl_table_category']['description']    = ['Description', 'Here you can enter a short description for the table category.'];
$GLOBALS['TL_LANG']['tl_table_category']['published']      = ['Publish table category', 'Show the table category in the frontend.'];
$GLOBALS['TL_LANG']['tl_table_category']['start']          = ['Show from', 'Show the table category from this day in the frontend.'];
$GLOBALS['TL_LANG']['tl_table_category']['stop']           = ['Show until', 'Show the table category up to this day in the frontend.'];

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_table_category']['table_category_legend'] = 'Table category and description';
$GLOBALS['TL_LANG']['tl_table_category']['publish_legend']        = 'Publish';

/**
 * Reference
 */

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_table_category']['new']           = ['Create table category', 'Create a new table category'];
$GLOBALS['TL_LANG']['tl_table_category']['edit']          = ['Edit', 'Edit table category ID %s'];
$GLOBALS['TL_LANG']['tl_table_category']['copy']          = ['Copy', 'Copy table category ID %s'];
$GLOBALS['TL_LANG']['tl_table_category']['delete']        = ['Delete', 'Remove table category ID %s'];
$GLOBALS['TL_LANG']['tl_table_category']['show']          = ['Show', 'Show data set ID %s'];
$GLOBALS['TL_LANG']['tl_table_category']['create']        = ['Seat reservation calendar', 'Open the calendar to show and edit the seat reservation.'];
$GLOBALS['TL_LANG']['tl_table_category']['reset']         = ['Reset', 'Reset the seat reservation for table category.'];
$GLOBALS['TL_LANG']['tl_table_category']['resetConfirm']  = 'The entire occupancy for table category ID %s will be removed';
$GLOBALS['TL_LANG']['tl_table_category']['toggle']        = ['Toggle visibility', 'Toggle the visibility for table category ID %s.'];
$GLOBALS['TL_LANG']['tl_table_category']['deleteConfirm'] = 'Really remove table category ID %s?\nCaution: All seat reservations for this table category will be removed.';