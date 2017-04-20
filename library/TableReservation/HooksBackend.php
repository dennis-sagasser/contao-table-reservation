<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2014 Leo Feyer
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
 * PHP version 5
 *
 * @category  Contao
 * @package   RoomReservation
 * @author    Dennis Sagasser <sagasser@gispack.com>
 * @copyright 2014 Dennis Sagasser
 * @license   http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * @link      https://contao.org
 */

namespace Contao;

/**
 * Class HooksBackend
 *
 * Specifies backend hooks for the table reservation.
 *
 * @category  Contao
 * @package   RoomReservation
 * @author    Dennis Sagasser <sagasser@gispack.com>
 * @copyright 2014 Dennis Sagasser
 * @license   http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * @link      https://contao.org
 */
class HooksBackend extends \Backend
{
    /**
     * Loads the time slot DCA fields dynamically.
     *
     * @param string $strName Name of DCA Table
     *
     */
    public function myLoadDataContainer($strName)
    {
        if ($strName === 'tl_table_occupancy' && $this->Database->tableExists('tl_table_reservation_slots')) {
            $arrSlotNames = $this->Database->prepare("
                SELECT name FROM tl_table_reservation_slots
                ")->execute()->fetchEach('name');

            foreach ($arrSlotNames as $strSlotName) {
                $GLOBALS['TL_DCA']['tl_table_occupancy']['fields'][$strSlotName]['sql'] = 'smallint(3) unsigned NULL';
            }
        }
    }

    /**
     * Parses the backend template and replaces the back link
     *
     * @param string $strBuffer Content of the parsed back end template
     * @param string $strTemplate The template name
     *
     * @return string
     */
    public function myParseBackendTemplate($strBuffer, $strTemplate)
    {
        if ($strTemplate == 'be_main' && (\Input::get("do") === 'table_config')) {
            $strBuffer = preg_replace(
                '/<a href=(.*?) class=\"header_back\"/',
                '<a href="javascript:history.back()" class="header_back"',
                $strBuffer
            );
        }

        return $strBuffer;
    }
}
