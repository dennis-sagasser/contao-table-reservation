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
$GLOBALS['TL_LANG']['tl_table_reservation_list']['arrival']    = ['Date and time', 'Please enter date and time for reservation.'];
$GLOBALS['TL_LANG']['tl_table_reservation_list']['departure']  = ['Departure', 'Please select date and time for reservation.'];
$GLOBALS['TL_LANG']['tl_table_reservation_list']['seats']      = ['Seats', 'Please select number of persons and table category.'];
$GLOBALS['TL_LANG']['tl_table_reservation_list']['count']      = ['Number of persons', 'Please select number of persons.'];
$GLOBALS['TL_LANG']['tl_table_reservation_list']['category']   = ['Table category', 'Please select table category.'];
$GLOBALS['TL_LANG']['tl_table_reservation_list']['salutation'] = ['Salutation', 'Please select gender.'];
$GLOBALS['TL_LANG']['tl_table_reservation_list']['firstname']  = ['First name', 'Please enter the guest first name.'];
$GLOBALS['TL_LANG']['tl_table_reservation_list']['lastname']   = ['Last name', 'Please enter the guest last name.'];
$GLOBALS['TL_LANG']['tl_table_reservation_list']['email']      = ['E-Mail', 'Please enter the guest email address.'];
$GLOBALS['TL_LANG']['tl_table_reservation_list']['phone']      = ['Phone number', 'Please enter the guest phone number.'];
$GLOBALS['TL_LANG']['tl_table_reservation_list']['remarks']    = ['Remarks', 'Here you can specify remarks for the reservation.'];

$GLOBALS['TL_LANG']['tl_table_reservation_list']['new']           = ['Create reservation', 'Create a new reservation entry'];
$GLOBALS['TL_LANG']['tl_table_reservation_list']['edit']          = ['Edit details', 'Edit reservations details for entry %s'];
$GLOBALS['TL_LANG']['tl_table_reservation_list']['copy']          = ['Copy details', 'Copy reservations details for entry %s'];
$GLOBALS['TL_LANG']['tl_table_reservation_list']['show']          = ['Show details', 'Show reservations details for entry %s'];
$GLOBALS['TL_LANG']['tl_table_reservation_list']['delete']        = ['Delete reservation', 'Delete reservation #%s'];
$GLOBALS['TL_LANG']['tl_table_reservation_list']['deleteConfirm'] = 'Really remove reservation #%s?';

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_table_reservation_list']['reservation_legend'] = 'Reservation data';
$GLOBALS['TL_LANG']['tl_table_reservation_list']['guest_legend']       = 'Guest data';

/**
 * Filter
 */
$GLOBALS['TL_LANG']['tl_table_reservation_list']['timeSlot']  = 'Time slot';
$GLOBALS['TL_LANG']['tl_table_reservation_list']['all']       = 'All reservations';
$GLOBALS['TL_LANG']['tl_table_reservation_list']['future']    = 'Future reservations';
$GLOBALS['TL_LANG']['tl_table_reservation_list']['past']      = 'Expired reservations';
$GLOBALS['TL_LANG']['tl_table_reservation_list']['today']     = 'Today';
$GLOBALS['TL_LANG']['tl_table_reservation_list']['thisWeek']  = 'This week';
$GLOBALS['TL_LANG']['tl_table_reservation_list']['thisMonth'] = 'This month';
$GLOBALS['TL_LANG']['tl_table_reservation_list']['thisYear']  = 'This year';