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
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['subject']        = array('Subject', 'Please enter the subject of the email response.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['content']        = array('HTML-Content', 'Here you can enter the HTML content of the confirmation mail. Available variables:<br>Salutation: {{reservation::salutation}}<br>First name: {{reservation::firstname}}<br>Last name: {{reservation::lastname}}<br>Address: {{reservation::address}}<br>Phone number: {{reservation::phone}}<br>E-Mail: {{reservation::email}}<br>Arrival: {{reservation::arrival}}<br>Departure: {{reservation::departure}}<br>Table(s): {{reservation::tables}}<br>Remarks: {{reservation::remarks}}<br>Total: {{reservation::total}}');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['text']           = array('Text-Content', 'Here you can enter the text content of the confirmation mail. Available variables:<br>Salutation: {{reservation::salutation}}<br>First name: {{reservation::firstname}}<br>Last name: {{reservation::lastname}}<br>Address: {{reservation::address}}<br>Phone number: {{reservation::phone}}<br>E-Mail: {{reservation::email}}<br>Arrival: {{reservation::arrival}}<br>Departure: {{reservation::departure}}<br>Table(s): {{reservation::tables}}<br>Remarks: {{reservation::remarks}}<br>Total: {{reservation::total}}');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['addFile']        = array('Add attachments', 'Attach one or more files to the confirmation mail.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['files']          = array('Dateianhänge', 'Please choose the files to be attached from the files directory.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['template']       = array('E-mail template', 'Here you can choose the e-mail template.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['sendText']       = array('Als Text senden', 'Send the confirmation as plain text e-mail without the HTML content.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['externalImages'] = array('External images', 'Do not embed images in HTML confirmation mail.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['senderName']     = array('Sender name', 'Here you can enter the sender\'s name.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['sender']         = array('Sender address', 'Here you can enter a custom sender address.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['bCc']            = array('Blind carbon copy', 'Here you can enter an e-amail address for blind carbon copy.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['useSMTP']        = array('Custom SMTP server', 'Use a custom SMTP server for sending confirmations.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['smtpHost']       = array('SMTP hostname', 'Please enter the host name of the SMTP server.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['smtpUser']       = array('SMTP username', 'Here you can enter the SMTP username.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['smtpPass']       = array('SMTP password', 'Here you can enter the SMTP password.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['smtpEnc']        = array('SMTP encryption', 'Here you can choose an encryption method (SSL or TLS).');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['smtpPort']       = array('SMTP port number', 'Please enter the port number of the SMTP server.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['title_legend']      = 'Subject';
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['html_legend']       = 'HTML content';
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['text_legend']       = 'Text content';
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['attachment_legend'] = 'Attachments';
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['template_legend']   = 'Template settings';
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['expert_legend']     = 'Expert settings';
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['smtp_legend']       = 'SMTP settings';

/**
 * Reference
 */

/**
 * Buttons
 */

/**
 * Miscellaneous
 */
$GLOBALS['TL_LANG']['MSC']['table_reservation']['editRecord']                                  = 'Edit e-mail settings';
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['default_subject']   = 'Your reservation at Hotel Mustermann';
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['default_html_text'] = '{{reservation::salutation}},<br><br>
    thank you very much for your reservation at Hotel Mustermann. Please find the confirmation for your online booking below:<br><br><br>
    First name: {{reservation::firstname}}<br>
    Last Name: {{reservation::lastname}}<br>
    Address: {{reservation::address}}<br>
    Telephone: {{reservation::phone}}<br>
    E-mail: {{reservation::email}}<br>
    Date of arrival: {{reservation::arrival}}<br>
    Date of departure: {{reservation::departure}}<br>
    Table(s): {{reservation::tables}}<br>
    Remarks: {{reservation::remarks}}<br><br>
    The total amount due will be {{reservation::total}}. The table rate includes breakfast, service and V.A.T.<br>
    Please pass on your credit card details to the hotel to guarantee your reservation.<br><br>
    Cancellations free of charge are possible until 24 hours prior to arrival.<br>
    Please inform the hotel of changes or cancellations via e-mail or telefax.<br><br>
    We wish you a pleasant trip!<br><br><br>
    With kindest regards<br>
    The Reservation Department<br><br>
    ---<br>
    Gispack Int. Ltd.<br>
    Göttiner Landstraße 36<br>
    14776 Brandenburg an der Havel<br><br>
    Telefon: (03381) 61 98 160<br>
    Telefax: (03381) 61 98 163<br>
    E-Mail: info@gispack.com';

