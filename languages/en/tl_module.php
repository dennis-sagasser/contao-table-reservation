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
$GLOBALS['TL_LANG']['tl_module']['showTimeSlots']   = ['Activate timeslots', 'If you enable timeslots, the frontend user can choose a timeslot from opening times above instead of entering a fixed time.'];
$GLOBALS['TL_LANG']['tl_module']['tableCategories'] = ['Table category', 'Please choose at least one table category.'];
$GLOBALS['TL_LANG']['tl_module']['dateTimeFormat']  = ['Date and time format', 'Date and time format for the frontend calendar field. If empty, global format is used. The date and time format string will be parsed with the PHP date() function.'];
$GLOBALS['TL_LANG']['tl_module']['timeFormat']      = ['Time format', 'Time format for the frontend calendar field. If empty, global format is used. The time format string will be parsed with the PHP date() function.'];
$GLOBALS['TL_LANG']['tl_module']['leadTime']        = ['Lead time', 'Enter the time, which must be at least between reservation and arrival.'];
$GLOBALS['TL_LANG']['tl_module']['openingHours']    = ['Opening hours', 'Please specify the opening hours for the different daytimes.'];
$GLOBALS['TL_LANG']['tl_module']['weekDay']         = ['Weekday', 'Select a day for the opening hours.'];
$GLOBALS['TL_LANG']['tl_module']['dayTime']         = ['DayTime', 'Select a daytime for the opening hours.'];
$GLOBALS['TL_LANG']['tl_module']['openFrom']        = ['From', 'Specify the opening time.'];
$GLOBALS['TL_LANG']['tl_module']['openTo']          = ['To', 'Specify the closing time.'];
$GLOBALS['TL_LANG']['tl_module']['minutes'][0]      = 'Minutes';
$GLOBALS['TL_LANG']['tl_module']['hours'][0]        = 'Hours';
$GLOBALS['TL_LANG']['tl_module']['days'][0]         = 'Days';
$GLOBALS['TL_LANG']['tl_module']['weeks'][0]        = 'Weeks';

/**
 * Legends
 */

/**
 * Reference
 */

/**
 * Buttons
 */

/**
 * Info
 */
$GLOBALS['TL_LANG']['tl_module']['info'] = '«Include MooTools» on tab «Mootools» must be checked in the page layout under «Themes», in order to use the full functionality of the module .';