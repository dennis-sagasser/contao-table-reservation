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
use Contao\DataContainer;
use Contao\Input;
use Contao\Session;
use Contao\Database;
use Contao\BackendUser;
use Contao\Controller;
use Contao\System;
use Contao\Versions;
use Contao\Image;

/**
 * Class tl_table_slots
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @category  Contao
 * @package   TableReservation
 * @author    Dennis Sagasser <sagasser@gispack.com>
 * @copyright 2017 Dennis Sagasser
 * @license   http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * @link      https://contao.org
 */
class tl_table_slots extends Backend
{

    /**
     * Parent call of the constructor.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Save a copy of the current table name to check if it has changed later
     *
     * @param string $varValue
     *
     * @return string $varValue
     */
    public function cacheTableName($varValue)
    {
        Session::getInstance()->set('tl_table.name', $varValue);
        return $varValue;
    }

    /**
     * Saves the start time of the time slot with timestamp of current day
     *
     * @return string $varValue
     */
    public function saveFromTime()
    {
        return strtotime(Input::post('fromTime'));
    }

    /**
     * Saves the end time of the time slot with timestamp of current day
     *
     * @return string $varValue
     */
    public function saveToTime()
    {
        return Input::post('toTime') === '00:00' ?
            strtotime(Input::post('toTime')) - 60 :
            strtotime(Input::post('toTime'));
    }

    /**
     * Removes all special chars to get a valid sql column name
     *
     * @param string $varValue
     *
     * @return string $varValue
     */
    public function prepareSqlColumnName($varValue)
    {
        return str_replace('-', '_', str_replace(['[', ']'], '', $varValue));
    }

    /**
     * Deletes column in in the occupancy calendar according to time slot.
     *
     * @param DataContainer $dc Data Container object
     * @param int $intUndoId Id of the undo object
     */
    public function deleteTimeSlot(DataContainer $dc, $intUndoId)
    {
        if (Input::get('act') == 'delete') {
            Database::getInstance()->prepare("
                ALTER TABLE tl_table_occupancy
                DROP COLUMN `" . $dc->activeRecord->name . "`
                ")->execute();
            Database::getInstance()->prepare("DELETE FROM tl_undo WHERE id=?")
                ->execute(intval($intUndoId));
        }
    }

    /**
     * Alters column in in the occupancy calendar according to time slot.
     *
     * @param DataContainer $dc Data Container object
     */
    public function editTimeSlot(DataContainer $dc)
    {
        if (Input::get('act') == 'edit') {
            $boolColumnExists = Database::getInstance()->fieldExists(
                Session::getInstance()->get('tl_table.name'),
                'tl_table_occupancy'
            );

            if (!$boolColumnExists) {
                Database::getInstance()->prepare("
                    ALTER TABLE tl_table_occupancy
                    ADD COLUMN `" . $dc->activeRecord->name . "` SMALLINT(3) UNSIGNED NULL
                ")->execute();
            }

            if ($boolColumnExists && (Session::getInstance()->get('tl_table.name') !== $dc->activeRecord->name)) {
                Database::getInstance()->prepare("
                    ALTER TABLE tl_table_occupancy
                    CHANGE COLUMN 
                    `" . Session::getInstance()->get('tl_table.name') . "` `" . $dc->activeRecord->name . "` 
                    SMALLINT(3) UNSIGNED NULL
                ")->execute();
            }
        }
    }

    /**
     * Changes appearance of Toggle-Buttons.
     *
     * @param object $row Row object
     * @param string $href Link
     * @param string $label Label
     * @param string $title Title
     * @param string $icon Icon
     * @param string $attributes Attributes
     *
     * @return string
     */
    public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
    {
        $objBackendUser = BackendUser::getInstance();

        if (strlen(Input::get('tid'))) {
            $this->toggleVisibility(
                Input::get('tid'),
                (Input::get('state') == 0),
                $objBackendUser
            );
            Controller::redirect(System::getReferer());
        }

        // Check permissions AFTER checking the tid, so hacking attempts are logged
        if (!$objBackendUser->isAdmin && !$objBackendUser->hasAccess('tl_table_slots::published', ['alexf'])) {
            return '';
        }

        $href .= '&amp;id=' . Input::get('id') . '&amp;tid=' . $row['id'] . '&amp;state=' . $row[''];

        if (!$row['published']) {
            $icon = 'invisible.gif';
        }

        return sprintf(
            '<a href=%s title=%s%s>%s</a>',
            Controller::addToUrl($href),
            specialchars($title),
            $attributes,
            Image::getHtml($icon, $label)
        );
    }

    /**
     * Toggle the visibility of an element
     *
     * @param integer $intId ID
     * @param boolean $blnPublished Published
     * @param object $objBackendUser Backend user object
     *
     */
    public function toggleVisibility($intId, $blnPublished, $objBackendUser)
    {
        // Check permissions to publish
        if (!$objBackendUser->isAdmin && !$objBackendUser->hasAccess('tl_table_slots::published', 'alexf')) {
            System::log(
                'Not enough permissions to show/hide record ID "' . $intId . '"',
                'tl_table_slots toggleVisibility',
                TL_ERROR
            );
            Controller::redirect('contao/main.php?act=error');
        }

        $objVersions = new Versions('tl_table_slots', $intId);
        $objVersions->initialize();

        // Trigger the save_callback
        if (is_array($GLOBALS['TL_DCA']['tl_table_slots']['fields']['published']['save_callback'])) {
            foreach ($GLOBALS['TL_DCA']['tl_table_slots']['fields']['published']['save_callback'] as $callback) {
                System::importStatic($callback[0]);
                $blnPublished = $this->$callback[0]->$callback[1]($blnPublished, $this);
            }
        }

        // Update the database
        $arrSet              = [];
        $arrSet['tstamp']    = time();
        $arrSet['published'] = $blnPublished ? '' : '1';

        Database::getInstance()
            ->prepare("UPDATE tl_table_slots %s WHERE id=?")
            ->set($arrSet)
            ->execute($intId);

        $objVersions = new Versions('tl_table_slots', $intId);
        $objVersions->create();
    }
}