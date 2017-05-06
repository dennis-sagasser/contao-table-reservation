<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 *
 * PHP version 7
 *
 * @category    Contao
 * @package     TableReservation
 * @author      Dennis Sagasser <dennis.sagasser@gmail.com>
 * @copyright   2017 Dennis Sagasser
 * @license     LGPL-3.0+
 * @link        https://contao.org
 */

namespace ContaoTableReservation;

use Contao\Backend;
use Contao\Input;
use Contao\Database;

/**
 * Class HooksBackend
 *
 * Specifies backend hooks for the table reservation.
 *
 * @category  Contao
 * @package   TableReservation
 * @author    Dennis Sagasser <sagasser@gispack.com>
 * @copyright 2017 Dennis Sagasser
 * @license   http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * @link      https://contao.org
 */
class HooksBackend extends Backend
{
    /**
     * Loads the time slot DCA fields dynamically.
     *
     * @param string $strName Name of DCA Table
     *
     */
    public function myLoadDataContainer($strName)
    {
        if ($strName === 'tl_table_occupancy' && Database::getInstance()->tableExists('tl_table_slots')) {
            $arrSlotNames = Database::getInstance()->prepare("
                SELECT name FROM tl_table_slots
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
        if ($strTemplate == 'be_main' && (Input::get("do") === 'table_config')) {
            $strBuffer = preg_replace(
                '/<a href=(.*?) class=\"header_back\"/',
                '<a href="javascript:history.back()" class="header_back"',
                $strBuffer
            );
        }

        return $strBuffer;
    }
}
