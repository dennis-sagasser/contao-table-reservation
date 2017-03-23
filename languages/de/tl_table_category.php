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
$GLOBALS['TL_LANG']['tl_table_category']['table_category'] = ['Tischkategorie', 'Bitte geben Sie die Bezeichnung der Tischkategorie ein.'];
$GLOBALS['TL_LANG']['tl_table_category']['maxcount']       = ['Maximale Personenanzahl', 'Bitte geben Sie das Maximum möglicher Online-Sitzplatzeservierungen an.'];
$GLOBALS['TL_LANG']['tl_table_category']['description']    = ['Beschreibung', 'Hier können Sie eine kurze Beschreibung für die Tischkategorie angeben.'];
$GLOBALS['TL_LANG']['tl_table_category']['published']      = ['Tischkategorie veröffentlichen', 'Die Tischkategorie auf der Website anzeigen.'];
$GLOBALS['TL_LANG']['tl_table_category']['start']          = ['Anzeigen ab', 'Die Tischkategorie erst ab diesem Tag auf der Website anzeigen.'];
$GLOBALS['TL_LANG']['tl_table_category']['stop']           = ['Anzeigen bis', 'Die Tischkategorie bis zu diesem Tag auf der Website anzeigen.'];

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_table_category']['table_category_legend'] = 'Tischkategorie und Beschreibung';
$GLOBALS['TL_LANG']['tl_table_category']['publish_legend']        = 'Veröffentlichung';

/**
 * Reference
 */

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_table_category']['new']           = ['Tischkategorie anlegen', 'Eine neue Tischkategorie anlegen'];
$GLOBALS['TL_LANG']['tl_table_category']['edit']          = ['Bearbeiten', 'Tischkategorie ID %s bearbeiten'];
$GLOBALS['TL_LANG']['tl_table_category']['copy']          = ['Kopieren', 'Tischkategorie ID %s kopieren'];
$GLOBALS['TL_LANG']['tl_table_category']['delete']        = ['Entfernen', 'Tischkategorie ID %s entfernen'];
$GLOBALS['TL_LANG']['tl_table_category']['show']          = ['Anzeigen', 'Datensatz ID %s anzeigen'];
$GLOBALS['TL_LANG']['tl_table_category']['create']        = ['Tischbelegungskalender', 'Kalender für die Sitzplatzbelegung anzeigen'];
$GLOBALS['TL_LANG']['tl_table_category']['reset']         = ['Zurücksetzen', 'Sitzplatzbelegungen zurücksetzen'];
$GLOBALS['TL_LANG']['tl_table_category']['resetConfirm']  = 'Die gesamte Belegung für Tischkategorie ID %s wird gelöscht';
$GLOBALS['TL_LANG']['tl_table_category']['toggle']        = ['Sichtbarkeit umschalten', 'Sichbarkeit für die Tischkategorie ID %s festlegen'];
$GLOBALS['TL_LANG']['tl_table_category']['deleteConfirm'] = 'Soll die Tischkategorie ID %s wirklich gelöscht werden?\nAchtung: Alle Sitzplatzbelegungen für diese Tischkategorie werden ebenfalls entfernt.';