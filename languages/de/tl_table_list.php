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
$GLOBALS['TL_LANG']['tl_table_list']['arrival']    = ['Datum und Uhrzeit', 'Bitte geben Sie Datum und Uhrzeit der Reservierung an.'];
$GLOBALS['TL_LANG']['tl_table_list']['departure']  = ['Abfahrt', 'Bitte geben Sie Datum und Uhrzeit der Reservierung an.'];
$GLOBALS['TL_LANG']['tl_table_list']['seats']      = ['Personen', 'Bitte wählen Sie die gewünschte Personenanzahl und Kategorie aus.'];
$GLOBALS['TL_LANG']['tl_table_list']['count']      = ['Personen', 'Bitte wählen Sie die gewünschte Personenanzahl aus.'];
$GLOBALS['TL_LANG']['tl_table_list']['category']   = ['Kategorie', 'Bitte wählen Sie die gewünschte Tischkategorie aus.'];
$GLOBALS['TL_LANG']['tl_table_list']['salutation'] = ['Anrede', 'Bitte wählen Sie das Geschlecht des Gastes.'];
$GLOBALS['TL_LANG']['tl_table_list']['firstname']  = ['Vorname', 'Bitte geben Sie den Vornamen des Gastes an.'];
$GLOBALS['TL_LANG']['tl_table_list']['lastname']   = ['Nachname', 'Bitte geben Sie den Nachnamen des Gastes an.'];
$GLOBALS['TL_LANG']['tl_table_list']['email']      = ['E-Mail', 'Bitte geben Sie die E-Mail-Adresse des Gastes an.'];
$GLOBALS['TL_LANG']['tl_table_list']['phone']      = ['Telefon', 'Bitte geben Sie die Telefonnummer des Gastes ein.'];
$GLOBALS['TL_LANG']['tl_table_list']['remarks']    = ['Bemerkungen', 'Hier können Sie Bemerkungen zur Reservierung angeben.'];

$GLOBALS['TL_LANG']['tl_table_list']['new']           = ['Reservierung anlegen', 'Eine neue Reservierung erstellen'];
$GLOBALS['TL_LANG']['tl_table_list']['edit']          = ['Details bearbeiten', 'Reservierungsdetails für Datensatz %s bearbeiten'];
$GLOBALS['TL_LANG']['tl_table_list']['copy']          = ['Details duplizieren', 'Reservierungsdetails für Datensatz %s duplizieren'];
$GLOBALS['TL_LANG']['tl_table_list']['show']          = ['Details anzeigen', 'Reservierungsdetails für Datensatz %s anzeigen'];
$GLOBALS['TL_LANG']['tl_table_list']['delete']        = ['Reservierung löschen', 'Reservierung %s löschen'];
$GLOBALS['TL_LANG']['tl_table_list']['deleteConfirm'] = 'Soll die Reservierung #%s wirklich gelöscht werden?';

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_table_list']['reservation_legend'] = 'Reservierungsdaten';
$GLOBALS['TL_LANG']['tl_table_list']['guest_legend']       = 'Gastdaten';

/**
 * Filter
 */
$GLOBALS['TL_LANG']['tl_table_list']['timeSlot']  = 'Zeitraum';
$GLOBALS['TL_LANG']['tl_table_list']['all']       = 'Alle Reservierungen';
$GLOBALS['TL_LANG']['tl_table_list']['future']    = 'Zukünftige Reservierungen';
$GLOBALS['TL_LANG']['tl_table_list']['past']      = 'Abgelaufene Reservierungen';
$GLOBALS['TL_LANG']['tl_table_list']['today']     = 'Heute';
$GLOBALS['TL_LANG']['tl_table_list']['thisWeek']  = 'Aktuelle Woche';
$GLOBALS['TL_LANG']['tl_table_list']['thisMonth'] = 'Aktueller Monat';
$GLOBALS['TL_LANG']['tl_table_list']['thisYear']  = 'Aktuelles Jahr';