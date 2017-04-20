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
$GLOBALS['TL_LANG']['tl_module']['showNotification'] = ['Activate Notification Center notification', 'Send reservation conformations via the notification center instead of the default system.'];
$GLOBALS['TL_LANG']['tl_module']['installInfo']      = ['Activate Notification Center notification', 'Install Notification Center to use this option.'];
$GLOBALS['TL_LANG']['tl_module']['ncNotification']   = ['Notification', 'Please select a notification.'];
$GLOBALS['TL_LANG']['tl_module']['showTimeSlots']    = ['Activate timeslots', 'If you enable timeslots, times are ignored and the user can select timeslots for reservation in frontend.'];
$GLOBALS['TL_LANG']['tl_module']['tableCategories']  = ['Table category', 'Please select at least one table category.'];
$GLOBALS['TL_LANG']['tl_module']['dateTimeFormat']   = ['Date and time format', 'Date and time format for the frontend calendar field. If empty, global format is used. The date and time format string will be parsed with the PHP date() function.'];
$GLOBALS['TL_LANG']['tl_module']['timeFormat']       = ['Time format', 'Time format for the frontend calendar field. If empty, global format is used. The time format string will be parsed with the PHP date() function.'];
$GLOBALS['TL_LANG']['tl_module']['leadTime']         = ['Lead time', 'Enter the time, which must be at least between reservation and arrival.'];
$GLOBALS['TL_LANG']['tl_module']['openingHours']     = ['Opening hours', 'Please specify the opening hours for the different daytimes.'];
$GLOBALS['TL_LANG']['tl_module']['weekDay']          = ['Weekday', 'Select a day for the opening hours.'];
$GLOBALS['TL_LANG']['tl_module']['dayTime']          = ['DayTime', 'Select a daytime for the opening hours.'];
$GLOBALS['TL_LANG']['tl_module']['openFrom']         = ['From', 'Specify the opening time.'];
$GLOBALS['TL_LANG']['tl_module']['openTo']           = ['To', 'Specify the closing time.'];
$GLOBALS['TL_LANG']['tl_module']['minutes'][0]       = 'Minutes';
$GLOBALS['TL_LANG']['tl_module']['hours'][0]         = 'Hours';
$GLOBALS['TL_LANG']['tl_module']['days'][0]          = 'Days';
$GLOBALS['TL_LANG']['tl_module']['weeks'][0]         = 'Weeks';
$GLOBALS['TL_LANG']['XPL']['helpInsertTags']         = [
    ['headspan', 'Inserttags for notification'],
    ['{{reservation::salutation}}', 'Salutation: Dear Mr. / Dear Mrs.'],
    ['{{reservation::firstname}}', 'First name'],
    ['{{reservation::lastname}}', 'Last name'],
    ['{{reservation::phone}}', 'Phone number'],
    ['{{reservation::email}}', 'Email address'],
    ['{{reservation::arrival}}', 'Reservation date and time'],
    ['{{reservation::seats}}', 'Number of persons for every booked category'],
    ['{{reservation::remarks}}', 'Remarks'],
    ['headspan', 'Example text'],
    ['colspan', '{{reservation::salutation}},<br><br>
    thank you very much for your reservation at Restaurant Mustermann. Please find the confirmation for your online booking below:<br><br><br>
    First name: {{reservation::firstname}}<br>
    Last Name: {{reservation::lastname}}<br>
    Address: {{reservation::address}}<br>
    Telephone: {{reservation::phone}}<br>
    E-mail: {{reservation::email}}<br>
    Date and time: {{reservation::arrival}}<br>
    Persons: {{reservation::seats}}<br>
    Remarks: {{reservation::remarks}}<br><br>
    With kindest regards<br>
    The Reservation Department<br><br>
    ---<br>
    Company<br>
    Street 1<br>
    14776 Brandenburg an der Havel<br><br>
    Telefon: (03381) 12 34 567<br>                                                                                                                                                                                                            
    Telefax: (03381) 12 34 765 <br>                                                                                                                                                                                                           
    E-Mail: info@restaurant-mustermann.com</p>'],
];
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