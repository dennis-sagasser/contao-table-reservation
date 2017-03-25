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
$GLOBALS['TL_LANG']['tl_module']['showTimeSlots']   = ['Zeitfenster aktivieren', 'Wenn Sie Zeitfenster aktivieren, kann der Nutzer im Frontend ein bei den Öffunungszeiten oben angegebenes Zeitfenster wählen anstatt eine feste Zeitangabe zu machen.'];
$GLOBALS['TL_LANG']['tl_module']['tableCategories'] = ['Tischkategorie', 'Bitte wählen Sie mindestens eine Tischkategorie.'];
$GLOBALS['TL_LANG']['tl_module']['dateTimeFormat']  = ['Datums- und Zeitformat', 'Datums- und Zeitformat für den Kalendar im Frontend. Falls nicht angegegeben, wird das globale Format verwendet. Der Datums- und Zeitformat-String wird mit der PHP-Funktion date() geparst.'];
$GLOBALS['TL_LANG']['tl_module']['timeFormat']      = ['Zeitformat', 'Zeitformat für den Kalendar im Frontend. Falls nicht angegegeben, wird das globale Format verwendet. Der Zeitformat-String wird mit der PHP-Funktion date() geparst.'];
$GLOBALS['TL_LANG']['tl_module']['leadTime']        = ['Vorlaufzeit', 'Tragen Sie die Zeit ein, die mindestens zwischen Reservierung und Ankunft liegen muss.'];
$GLOBALS['TL_LANG']['tl_module']['openingHours']    = ['Öffnungszeiten', 'Geben Sie die Öffungszeiten für die verschiedenen Tageszeiten an.'];
$GLOBALS['TL_LANG']['tl_module']['weekDay']         = ['Wochentag', 'Wählen Sie den Tag für die Öffnungszeiten aus.'];
$GLOBALS['TL_LANG']['tl_module']['dayTime']         = ['Tageszeit', 'Wählen Sie die Tageszeit für die Öffnungszeiten aus.'];
$GLOBALS['TL_LANG']['tl_module']['openFrom']        = ['Von', 'Geben Sie die Öffnungszeit an.'];
$GLOBALS['TL_LANG']['tl_module']['openTo']          = ['Bis', 'Geben Sie die Schließzeit an.'];
$GLOBALS['TL_LANG']['tl_module']['minutes'][0]      = 'Minuten';
$GLOBALS['TL_LANG']['tl_module']['hours'][0]        = 'Stunden';
$GLOBALS['TL_LANG']['tl_module']['days'][0]         = 'Tage';
$GLOBALS['TL_LANG']['tl_module']['weeks'][0]        = 'Wochen';

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