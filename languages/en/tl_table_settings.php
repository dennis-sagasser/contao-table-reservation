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
$GLOBALS['TL_LANG']['tl_table_settings']['subject']        = ['Subject', 'Please enter the subject of the email response.'];
$GLOBALS['TL_LANG']['tl_table_settings']['content']        = ['HTML-Content', 'Here you can enter the HTML content of the confirmation mail. Available variables:<br>Salutation: {{reservation::salutation}}<br>First name: {{reservation::firstname}}<br>Last name: {{reservation::lastname}}<br>Phone number: {{reservation::phone}}<br>E-Mail: {{reservation::email}}<br>Date and time: {{reservation::arrival}}<br>Seat(s): {{reservation::seats}}<br>Remarks: {{reservation::remarks}}'];
$GLOBALS['TL_LANG']['tl_table_settings']['text']           = ['Text-Content', 'Here you can enter the text content of the confirmation mail. Available variables:<br>Salutation: {{reservation::salutation}}<br>First name: {{reservation::firstname}}<br>Last name: {{reservation::lastname}}<br>Phone number: {{reservation::phone}}<br>E-Mail: {{reservation::email}}<br>Date and time: {{reservation::arrival}}<br>Seat(s): {{reservation::seats}}<br>Remarks: {{reservation::remarks}}'];
$GLOBALS['TL_LANG']['tl_table_settings']['addFile']        = ['Add attachments', 'Attach one or more files to the confirmation mail.'];
$GLOBALS['TL_LANG']['tl_table_settings']['files']          = ['Dateianhänge', 'Please choose the files to be attached from the files directory.'];
$GLOBALS['TL_LANG']['tl_table_settings']['template']       = ['E-mail template', 'Here you can choose the e-mail template.'];
$GLOBALS['TL_LANG']['tl_table_settings']['sendText']       = ['Als Text senden', 'Send the confirmation as plain text e-mail without the HTML content.'];
$GLOBALS['TL_LANG']['tl_table_settings']['externalImages'] = ['External images', 'Do not embed images in HTML confirmation mail.'];
$GLOBALS['TL_LANG']['tl_table_settings']['senderName']     = ['Sender name', 'Here you can enter the sender\'s name.'];
$GLOBALS['TL_LANG']['tl_table_settings']['sender']         = ['Sender address', 'Here you can enter a custom sender address.'];
$GLOBALS['TL_LANG']['tl_table_settings']['bCc']            = ['Blind carbon copy', 'Here you can enter an e-amail address for blind carbon copy.'];
$GLOBALS['TL_LANG']['tl_table_settings']['useSMTP']        = ['Custom SMTP server', 'Use a custom SMTP server for sending confirmations.'];
$GLOBALS['TL_LANG']['tl_table_settings']['smtpHost']       = ['SMTP hostname', 'Please enter the host name of the SMTP server.'];
$GLOBALS['TL_LANG']['tl_table_settings']['smtpUser']       = ['SMTP username', 'Here you can enter the SMTP username.'];
$GLOBALS['TL_LANG']['tl_table_settings']['smtpPass']       = ['SMTP password', 'Here you can enter the SMTP password.'];
$GLOBALS['TL_LANG']['tl_table_settings']['smtpEnc']        = ['SMTP encryption', 'Here you can choose an encryption method (SSL or TLS).'];
$GLOBALS['TL_LANG']['tl_table_settings']['smtpPort']       = ['SMTP port number', 'Please enter the port number of the SMTP server.'];

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_table_settings']['title_legend']      = 'Subject';
$GLOBALS['TL_LANG']['tl_table_settings']['html_legend']       = 'HTML content';
$GLOBALS['TL_LANG']['tl_table_settings']['text_legend']       = 'Text content';
$GLOBALS['TL_LANG']['tl_table_settings']['attachment_legend'] = 'Attachments';
$GLOBALS['TL_LANG']['tl_table_settings']['template_legend']   = 'Template settings';
$GLOBALS['TL_LANG']['tl_table_settings']['expert_legend']     = 'Expert settings';
$GLOBALS['TL_LANG']['tl_table_settings']['smtp_legend']       = 'SMTP settings';

/**
 * Reference
 */

/**
 * Buttons
 */

/**
 * Miscellaneous
 */
$GLOBALS['TL_LANG']['MSC']['table_reservation']['editRecord'] = 'Edit e-mail settings';
$GLOBALS['TL_LANG']['tl_table_settings']['default_subject']   = 'Your reservation at Restaurant Mustermann';
$GLOBALS['TL_LANG']['tl_table_settings']['default_html_text'] = '{{reservation::salutation}},<br><br>
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
    Firma<br>
    Fiktive Straße 1<br>
    14776 Brandenburg an der Havel<br><br>
    Telefon: (03381) 12 34 567<br>                                                                                                                                                                                                            
    Telefax: (03381) 12 34 765 <br>                                                                                                                                                                                                           
    E-Mail: info@restaurant-mustermann.com</p>';
