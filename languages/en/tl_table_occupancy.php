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
$GLOBALS['TL_LANG']['tl_table_occupancy']['showPeriodOptions'] = ['Activate period of time', 'Activate the option to edit several days at the same time. Caution: Already stored data will be overwritten.'];
$GLOBALS['TL_LANG']['tl_table_occupancy']['startDate']         = ['Start date', 'Please enter the start date according to the global date format.'];
$GLOBALS['TL_LANG']['tl_table_occupancy']['date']              = ['Date', ''];
$GLOBALS['TL_LANG']['tl_table_occupancy']['endDate']           = ['End date', 'Please enter the end date according to the global date format.'];
$GLOBALS['TL_LANG']['tl_table_occupancy']['countMorning']      = ['Seats morning', 'The number of available seats in the morning.'];
$GLOBALS['TL_LANG']['tl_table_occupancy']['countNoon']         = ['Seats noon', 'The number of available seats at noon.'];
$GLOBALS['TL_LANG']['tl_table_occupancy']['countEvening']      = ['Seats evening', 'The number of available seats in the evening.'];
$GLOBALS['TL_LANG']['tl_table_occupancy']['countTimeSlot']     = ['Seats %s', 'The number of available seats in time slot %s.'];
$GLOBALS['TL_LANG']['tl_table_occupancy']['noTimeSlot']        = ['No active time slot', ''];
$GLOBALS['TL_LANG']['tl_table_occupancy']['year']              = ['Year', ''];
$GLOBALS['TL_LANG']['tl_table_occupancy']['morningAlt']        = 'Morning';
$GLOBALS['TL_LANG']['tl_table_occupancy']['morningTitle']      = 'Morning';
$GLOBALS['TL_LANG']['tl_table_occupancy']['noonAlt']           = 'Midday';
$GLOBALS['TL_LANG']['tl_table_occupancy']['noonTitle']         = 'Midday';
$GLOBALS['TL_LANG']['tl_table_occupancy']['eveningAlt']        = 'Evening';
$GLOBALS['TL_LANG']['tl_table_occupancy']['eveningTitle']      = 'Evening';

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_table_occupancy']['date_legend']     = 'Period of time';
$GLOBALS['TL_LANG']['tl_table_occupancy']['calendar_legend'] = 'Annual calendar';

/**
 * Reference
 */

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_table_occupancy']['new']              = ['Edit occupancy', 'Open the calendar for the table occupancy.'];
$GLOBALS['TL_LANG']['MSC']['table_reservation']['editRecord'] = 'Edit occupancy';