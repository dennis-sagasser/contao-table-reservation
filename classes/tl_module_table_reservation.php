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

/**
 * Class tl_module_table_reservation
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
class tl_module_table_reservation extends Backend
{
    /**
     * Get all table categories and return them as array
     *
     * @return array Array of table categories
     */
    public function getTableCategories()
    {
        $this->import('BackendUser', 'User');

        if (!$this->User->isAdmin) {
            return array();
        }

        $arrTableCategories = array();
        $objTableCategories = $this->Database->execute("SELECT id, tablecategory FROM tl_table_category ORDER BY tablecategory");

        while ($objTableCategories->next()) {
            if ($this->User->isAdmin) {
                $arrTableCategories[$objTableCategories->id] = $objTableCategories->tablecategory;
            }
        }

        return $arrTableCategories;
    }

    /**
     * Show a hint if a JavaScript library needs to be included in the page layout
     *
     * @param object $dc Data container object
     *
     */
    public function showJsLibraryHint($dc)
    {
        if ($_POST || Input::get('act') != 'edit') {
            return;
        }

        $objModule = ModuleModel::findByPk($dc->id);
        if ($objModule === null) {
            echo 'null' . $dc->id;
            return;
        }

        switch ($objModule->type) {
            case 'table_reservation':
                Message::addInfo($GLOBALS['TL_LANG']['tl_module']['info']);
                break;
        }
    }
}