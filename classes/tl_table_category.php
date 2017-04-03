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

namespace Contao;

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
        $this->import('BackendUser', 'User');

        if (strlen(Input::get('tid'))) {
            $this->toggleVisibility(Input::get('tid'), (Input::get('state') == 0));
            $this->redirect($this->getReferer());
        }

        // Check permissions AFTER checking the tid, so hacking attempts are logged
        if (!$this->User->isAdmin && !$this->User->hasAccess('tl_table_category::published', 'alexf')) {
            return '';
        }

        $href .= '&amp;id=' . Input::get('id') . '&amp;tid=' . $row['id'] . '&amp;state=' . $row[''];

        if (!$row['published']) {
            $icon = 'invisible.gif';
        }

        return '<a href="' . $this->addToUrl($href) . '" title="' . specialchars($title) . '"' . $attributes . '>' . $this->generateImage($icon, $label) . '</a> ';
    }

    /**
     * Toggle the visibility of an element
     *
     * @param integer $intId ID
     * @param boolean $blnPublished Published
     *
     * @return null
     */
    public function toggleVisibility($intId, $blnPublished)
    {
        // Check permissions to publish
        if (!$this->User->isAdmin && !$this->User->hasAccess('tl_table_category::published', 'alexf')) {
            $this->log('Not enough permissions to show/hide record ID "' . $intId . '"', 'tl_table_category toggleVisibility', TL_ERROR);
            $this->redirect('contao/main.php?act=error');
        }

        $this->createInitialVersion('tl_table_category', $intId);

        // Trigger the save_callback
        if (is_array($GLOBALS['TL_DCA']['tl_table_category']['fields']['published']['save_callback'])) {
            foreach ($GLOBALS['TL_DCA']['tl_table_category']['fields']['published']['save_callback'] as $callback) {
                $this->import($callback[0]);
                $blnPublished = $this->$callback[0]->$callback[1]($blnPublished, $this);
            }
        }

        // Update the database
        $this->Database->prepare("UPDATE tl_table_category SET tstamp=" . time() . ", published='" . ($blnPublished ? '' : '1') . "' WHERE id=?")
            ->execute($intId);
        $this->createNewVersion('tl_table_category', $intId);
    }
}    

