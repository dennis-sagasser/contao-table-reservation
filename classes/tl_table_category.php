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
use Contao\BackendUser;
use Contao\Input;
use Contao\System;
use Contao\Controller;
use Contao\Versions;
use Contao\Image;
use Contao\Database;

/**
 * Class tl_table_category
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
class tl_table_category extends Backend
{
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
        if (!$objBackendUser->isAdmin && !$objBackendUser->hasAccess('tl_table_category::published', ['alexf'])) {
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
        if (!$objBackendUser->isAdmin && !$objBackendUser->hasAccess('tl_table_category::published', 'alexf')) {
            System::log(
                'Not enough permissions to show/hide record ID "' . $intId . '"',
                'tl_table_category toggleVisibility',
                TL_ERROR
            );
            Controller::redirect('contao/main.php?act=error');
        }

        $objVersions = new Versions('tl_table_category', $intId);
        $objVersions->initialize();

        // Trigger the save_callback
        if (is_array($GLOBALS['TL_DCA']['tl_table_category']['fields']['published']['save_callback'])) {
            foreach ($GLOBALS['TL_DCA']['tl_table_category']['fields']['published']['save_callback'] as $callback) {
                System::importStatic($callback[0]);
                $blnPublished = $this->$callback[0]->$callback[1]($blnPublished, $this);
            }
        }

        // Update the database
        $arrSet              = [];
        $arrSet['tstamp']    = time();
        $arrSet['published'] = $blnPublished ? '' : '1';

        Database::getInstance()
            ->prepare("UPDATE tl_table_category %s WHERE id=?")
            ->set($arrSet)
            ->execute($intId);

        $objVersions = new Versions('tl_table_category', $intId);
        $objVersions->create();
    }
}    

