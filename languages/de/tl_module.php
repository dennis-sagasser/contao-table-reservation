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
$GLOBALS['TL_LANG']['tl_module']['showNotification'] = ['Notification Center Benachrichtigung aktivieren', 'Verschicken Sie die Reservierungsbestätigung über das Notification Center anstatt über das Standardsystem.'];
$GLOBALS['TL_LANG']['tl_module']['installInfo']      = ['Notification Center Benachrichtigung aktivieren', 'Installieren Sie die Erweiterung Notification Center, um diese Option nutzen zu können.'];
$GLOBALS['TL_LANG']['tl_module']['ncNotification']   = ['Benachrichtigung', 'Bitte wählen Sie eine Benachrichtigung aus.'];
$GLOBALS['TL_LANG']['tl_module']['showTimeSlots']    = ['Zeitfenster aktivieren', 'Wenn Sie Zeitfenster aktivieren, werden die Zeiten ignoriert und die veröffentlichten Zeitfenster im Frontend als Auswahlmöglichkeit für die Reservierung bereitgestellt.'];
$GLOBALS['TL_LANG']['tl_module']['tableCategories']  = ['Tischkategorie', 'Bitte wählen Sie mindestens eine Tischkategorie.'];
$GLOBALS['TL_LANG']['tl_module']['dateTimeFormat']   = ['Datums- und Zeitformat', 'Datums- und Zeitformat für den Kalendar im Frontend. Falls nicht angegegeben, wird das globale Format verwendet. Der Datums- und Zeitformat-String wird mit der PHP-Funktion date() geparst.'];
$GLOBALS['TL_LANG']['tl_module']['timeFormat']       = ['Zeitformat', 'Zeitformat für den Kalendar im Frontend. Falls nicht angegegeben, wird das globale Format verwendet. Der Zeitformat-String wird mit der PHP-Funktion date() geparst.'];
$GLOBALS['TL_LANG']['tl_module']['leadTime']         = ['Vorlaufzeit', 'Tragen Sie die Zeit ein, die mindestens zwischen Reservierung und Ankunft liegen muss.'];
$GLOBALS['TL_LANG']['tl_module']['openingHours']     = ['Öffnungszeiten', 'Geben Sie die Öffnungszeiten für die verschiedenen Tageszeiten an.'];
$GLOBALS['TL_LANG']['tl_module']['weekDay']          = ['Wochentag', 'Wählen Sie den Tag für die Öffnungszeiten aus.'];
$GLOBALS['TL_LANG']['tl_module']['dayTime']          = ['Tageszeit', 'Wählen Sie die Tageszeit für die Öffnungszeiten aus.'];
$GLOBALS['TL_LANG']['tl_module']['openFrom']         = ['Von', 'Geben Sie die Öffnungszeit an.'];
$GLOBALS['TL_LANG']['tl_module']['openTo']           = ['Bis', 'Geben Sie die Schließzeit an.'];
$GLOBALS['TL_LANG']['tl_module']['minutes'][0]       = 'Minuten';
$GLOBALS['TL_LANG']['tl_module']['hours'][0]         = 'Stunden';
$GLOBALS['TL_LANG']['tl_module']['days'][0]          = 'Tage';
$GLOBALS['TL_LANG']['tl_module']['weeks'][0]         = 'Wochen';
$GLOBALS['TL_LANG']['XPL']['helpInsertTags']         = [
    ['headspan', 'Inserttags für die Benachrichtigung'],
    ['{{reservation::_salutation}}', 'Begrüßungsformel: Sehr geehrter Herr / Sehr geehrte Frau'],
    ['{{reservation::_firstname}}', 'Vorname'],
    ['{{reservation::_lastname}}', 'Nachname'],
    ['{{reservation::_phone}}', 'Telefonnummer'],
    ['{{reservation::_email}}', 'E-Mail-Adresse'],
    ['{{reservation::_arrival}}', 'Reservierungsdatum und -uhrzeit'],
    ['{{reservation::_seats}}', 'Personenanzahl für jede reservierte Kategorie'],
    ['{{reservation::_remarks}}', 'Bemerkungen'],
    ['headspan', 'Beispieltext'],
    ['colspan', '<p>{{reservation::_salutation}},<br><br>
    vielen Dank für Ihre Reservierung im Restaurant Mustermann.
    Gern bestätigen wir Ihre Online-Reservierung, wie folgt:<br><br>
    Vorname: {{reservation::_firstname}}<br>
    Nachname: {{reservation::_lastname}}<br>
    Telefon: {{reservation::_phone}}<br>
    E-Mail: {{reservation::_email}}<br>
    Datum und Uhrzeit: {{reservation::_arrival}}<br>
    Personen: {{reservation::_seats}}<br>
    Bemerkungen: {{reservation::_remarks}}<br><br>
    Mit freundlichen Grüßen<br>
    Die Reservierung<br><br>
    ---<br>
    Firma<br>
    Fiktive Straße 1<br>
    14776 Brandenburg an der Havel<br><br>
    Telefon: (03381) 12 34 567<br>                                                                                                                                                                                                            
    Telefax: (03381) 12 34 765 <br>                                                                                                                                                                                                           
    E-Mail: info@restaurant-mustermann.de</p>'],
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
$GLOBALS['TL_LANG']['tl_module']['info'] = '«MooTools laden» muss im Reiter «Mootools» des aktuellen Seitenlayouts unter «Themes» angehakt sein, um den vollen Funktionsumfang des Moduls nutzen zu können.';