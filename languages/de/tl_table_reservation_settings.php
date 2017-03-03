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
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['subject']        = array('Betreff', 'Bitte geben Sie den Betreff an, der in der Antwort-Mail angezeigt wird.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['content']        = array('HTML-Inhalt', 'Hier können Sie den HTML-Inhalt der Bestätigungs-Mail eingeben. Verfügbare Variablen:<br>Anrede: {{reservation::salutation}}<br>Vorname: {{reservation::firstname}}<br>Nachname: {{reservation::lastname}}<br>Adresse: {{reservation::address}}<br>Telefon: {{reservation::phone}}<br>E-Mail: {{reservation::email}}<br>Anreise: {{reservation::arrival}}<br>Abreise: {{reservation::departure}}<br>Zimmer: {{reservation::tables}}<br>Bemerkungen: {{reservation::remarks}}<br>Gesamtpreis: {{reservation::total}}');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['text']           = array('Text-Inhalt', 'Hier können Sie den Text-Inhalt der Bestätigungs-Mail eingeben. Verfügbare Variablen:<br>Anrede: {{reservation::salutation}}<br>Vorname: {{reservation::firstname}}<br>Nachname: {{reservation::lastname}}<br>Adresse: {{reservation::address}}<br>Telefon: {{reservation::phone}}<br>E-Mail: {{reservation::email}}<br>Anreise: {{reservation::arrival}}<br>Abreise: {{reservation::departure}}<br>Zimmer: {{reservation::tables}}<br>Bemerkungen: {{reservation::remarks}}<br>Gesamtpreis: {{reservation::total}}');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['addFile']        = array('Dateien anhängen', 'Der Reservierungsbestätigung eine oder mehrere Dateien anhängen.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['files']          = array('Dateianhänge', 'Bitte wählen Sie die anzuhängenden Dateien aus der Dateiübersicht.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['template']       = array('E-Mail-Template', 'Hier können Sie das E-Mail-Template auswählen.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['sendText']       = array('Als Text senden', 'Die Bestätigung als reinen Text ohne HTML-Inhalt versenden.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['externalImages'] = array('Externe Bilder', 'Bilder in HTML-E-Mail nicht einbetten.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['senderName']     = array('Absendername', 'Hier können Sie den Namen des Absenders eingeben.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['sender']         = array('Absenderadresse', 'Hier können Sie eine individuelle Absenderadresse eingeben.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['bCc']            = array('E-Mail Adresse für Kopie', 'Hier können Sie eine E-Mail-Adresse eintragen, an die eine Kopie der Reservierungsbestätigung geschickt wird.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['useSMTP']        = array('Eigener SMTP-Server', 'Einen eigenen SMTP-Server für den E-Mail-Versand verwenden.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['smtpHost']       = array('SMTP-Hostname', 'Bitte geben Sie den Hostnamen des SMTP-Servers ein.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['smtpUser']       = array('SMTP-Benutzername', 'Hier können Sie den SMTP-Benutzernamen eingeben.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['smtpPass']       = array('SMTP-Passwort', 'Hier können Sie das SMTP-Passwort eingeben.');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['smtpEnc']        = array('SMTP-Verschlüsselung', 'Hier können Sie eine Verschlüsselungsmethode auswählen (SSL oder TLS).');
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['smtpPort']       = array('SMTP-Portnummer', 'Bitte geben Sie die Portnummer des SMTP-Servers ein.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['title_legend']      = 'Betreff';
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['html_legend']       = 'HTML-Inhalt';
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['text_legend']       = 'Text-Inhalt';
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['attachment_legend'] = 'Dateianhänge';
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['template_legend']   = 'Template-Einstellungen';
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['expert_legend']     = 'Experten-Einstellungen';
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['smtp_legend']       = 'SMTP-Einstellungen';

/**
 * Reference
 */

/**
 * Buttons
 */

/**
 * Miscellaneous
 */
$GLOBALS['TL_LANG']['MSC']['table_reservation']['editRecord']                                  = 'E-Mail-Einstellungen bearbeiten';
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['default_subject']   = 'Ihre Reservierung beim Hotel Mustermann';
$GLOBALS['TL_LANG']['tl_table_reservation_settings']['default_html_text'] = '<p>{{reservation::salutation}},<br><br>
    vielen Dank für Ihre Reservierung im Hotel Mustermann.
    Gern bestätigen wir Ihre Online-Reservierung, wie folgt:<br><br>
    Vorname: {{reservation::firstname}}<br>
    Nachname: {{reservation::lastname}}<br>
    Adresse: {{reservation::address}}<br>
    Telefon: {{reservation::phone}}<br>
    E-Mail: {{reservation::email}}<br>
    Anreise: {{reservation::arrival}}<br>
    Abreise: {{reservation::departure}}<br>
    Zimmer: {{reservation::tables}}<br>
    Bemerkungen: {{reservation::remarks}}<br><br>
    Daraus ergibt sich ein Gesamtpreis in Höhe von {{reservation::total}}. Der Zimmerpreis versteht sich inklusive Frühstück, Service und der gesetzlichen Mehrwertsteuer.<br>
    Bitte übermitteln Sie uns Ihre Kreditkarten-Details, um Ihre Reservierung zu garantieren.<br><br>
    Eine kostenlose Stornierung dieser Reservierung ist bis 24 Stunden vor Anreise möglich.<br>
    Änderungen oder Stornierungen wollen Sie dem Hotel bitte per E-Mail oder Telefax übermitteln.<br><br>
    Wir wünschen Ihnen eine angenehme Anreise!<br><br><br>
    Mit freundlichen Grüßen<br>
    Die Reservierung<br><br>
    ---<br>
    Gispack Int. Ltd.<br>
    Göttiner Landstraße 36<br>
    14776 Brandenburg an der Havel<br><br>
    Telefon: (03381) 61 98 160<br>                                                                                                                                                                                                            
    Telefax: (03381) 61 98 163 <br>                                                                                                                                                                                                           
    E-Mail: info@gispack.com</p>';