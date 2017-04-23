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
$GLOBALS['TL_LANG']['tl_table_occupancy']['showPeriodOptions'] = ['Zeitspanne aktivieren', 'Aktiviert die Optionen, um mehrere Tage gleichzeitig zu bearbeiten. Achtung: Bereits angelegte Daten werden überschrieben.'];
$GLOBALS['TL_LANG']['tl_table_occupancy']['startDate']         = ['Startdatum', 'Bitte geben Sie das Startdatum gemäß des globalen Datumsformats ein.'];
$GLOBALS['TL_LANG']['tl_table_occupancy']['date']              = ['Datum', ''];
$GLOBALS['TL_LANG']['tl_table_occupancy']['endDate']           = ['Enddatum', 'Bitte geben Sie das Startdatum gemäß des globalen Datumsformats ein.'];
$GLOBALS['TL_LANG']['tl_table_occupancy']['countMorning']      = ['Sitzplätze Morgen', 'Die Anzahl der verfügbaren Sitplätze am Morgen.'];
$GLOBALS['TL_LANG']['tl_table_occupancy']['countNoon']         = ['Sitzplätze Mittag', 'Die Anzahl der verfügbaren Sitplätze zu Mittag.'];
$GLOBALS['TL_LANG']['tl_table_occupancy']['countEvening']      = ['Sitzplätze Abend', 'Die Anzahl der verfügbaren Sitplätze am Abend.'];
$GLOBALS['TL_LANG']['tl_table_occupancy']['countTimeSlot']     = ['Sitzplätze %s', 'Die Anzahl der verfügbaren Sitplätze im Zeitfenster %s.'];
$GLOBALS['TL_LANG']['tl_table_occupancy']['noTimeSlot']        = ['Kein Zeitfenster aktiv', ''];
$GLOBALS['TL_LANG']['tl_table_occupancy']['year']              = ['Jahr', ''];
$GLOBALS['TL_LANG']['tl_table_occupancy']['morningAlt']        = 'Vormittag';
$GLOBALS['TL_LANG']['tl_table_occupancy']['morningTitle']      = 'Tageszeit Vormittag';
$GLOBALS['TL_LANG']['tl_table_occupancy']['noonAlt']           = 'Mittagszeit';
$GLOBALS['TL_LANG']['tl_table_occupancy']['noonTitle']         = 'Tageszeit Mittag';
$GLOBALS['TL_LANG']['tl_table_occupancy']['eveningAlt']        = 'Abend';
$GLOBALS['TL_LANG']['tl_table_occupancy']['eveningTitle']      = 'Tageszeit Abend';

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_table_occupancy']['date_legend']     = 'Zeitspanne';
$GLOBALS['TL_LANG']['tl_table_occupancy']['calendar_legend'] = 'Jahreskalender';

/**
 * Reference
 */

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_table_occupancy']['new']              = ['Tischbelegung bearbeiten', 'Den Kalender für die Tischbelegung öffnen.'];
$GLOBALS['TL_LANG']['MSC']['table_reservation']['editRecord'] = 'Tischbelegung bearbeiten';