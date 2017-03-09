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
 * Class ModuleTableReservation
 *
 * Specifies insert tags for the confirmation mail to the customer.
 *
 * @category  Contao
 * @package   TableReservation
 * @author    Dennis Sagasser <sagasser@gispack.com>
 * @copyright 2017 Dennis Sagasser
 * @license   http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * @link      https://contao.org
 */

/**
 * Table tl_table_category
 */
$GLOBALS['TL_DCA']['tl_table_category'] = array
(
    // Config
    'config'   => array
    (
        'dataContainer'    => 'Table',
        'ctable'           => array('tl_table_occupancy'),
        'switchToEdit'     => true,
        'enableVersioning' => true,
        'sql'              => array
        (
            'keys' => array
            (
                'id' => 'primary'
            )
        )
    ),

    // List
    'list'     => array
    (
        'sorting'           => array
        (
            'mode'        => 1,
            'fields'      => array('tablecategory'),
            'flag'        => 1,
            'panelLayout' => 'filter;search,limit'
        ),
        'label'             => array
        (
            'fields' => array('tablecategory', 'description'),
            'format' => '%s <span style="color:#b3b6b3">[%s]</span>'
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label'      => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'       => 'act=select',
                'class'      => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations'        => array
        (
            'edit'   => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_table_category']['edit'],
                'href'  => 'act=edit',
                'icon'  => 'edit.gif'
            ),
            'create' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_table_category']['create'],
                'href'  => 'table=tl_table_occupancy',
                'icon'  => 'system/modules/table_reservation/assets/images/calendar16.png'
            ),
            'reset'  => array
            (
                'label'      => &$GLOBALS['TL_LANG']['tl_table_category']['reset'],
                'href'       => 'key=reset',
                'icon'       => 'system/modules/table_reservation/assets/images/reset16.gif',
                'attributes' => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['tl_table_category']['resetConfirm'] . '\')) return false; Backend.getScrollOffset();"'
            ),
            'copy'   => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_table_category']['copy'],
                'href'  => 'act=copy',
                'icon'  => 'copy.gif',
            ),
            'delete' => array
            (
                'label'      => &$GLOBALS['TL_LANG']['tl_table_category']['delete'],
                'href'       => 'act=delete',
                'icon'       => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['tl_table_category']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
            ),
            'show'   => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_table_category']['show'],
                'href'  => 'act=show',
                'icon'  => 'show.gif'
            ),
            'toggle' => array
            (
                'label'           => &$GLOBALS['TL_LANG']['tl_table_category']['toggle'],
                'icon'            => 'visible.gif',
                'attributes'      => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback' => array('tl_table_category', 'toggleIcon')
            ),
        )
    ),

    // Palettes
    'palettes' => array
    (
        '__selector__' => array('protected', 'allowComments'),
        'default'      => '{table_category_legend},tablecategory,maxcount,description;{publish_legend},published,start,stop'
    ),

    // Subpalettes

    // Fields
    'fields'   => array
    (
        'id'            => array
        (
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp'        => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'tablecategory' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_category']['table_category'],
            'search'    => true,
            'inputType' => 'text',
            'eval'      => array
            (
                'mandatory' => true,
                'maxlength' => 255,
                'unique'    => true,
                'rgxp'      => 'alpha',
                'doNotCopy' => true,
                'tl_class'  => 'w50'
            ),
            'sql'       => "varchar(255) NOT NULL default ''"
        ),
        'maxcount'      => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_category']['maxcount'],
            'search'    => true,
            'inputType' => 'text',
            'eval'      => array
            (
                'maxlength' => 2,
                'rgxp'      => 'digit',
                'tl_class'  => 'w50'
            ),
            'sql'       => "int(2) unsigned NOT NULL default '5'"
        ),
        'description'   => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_category']['description'],
            'search'    => true,
            'inputType' => 'textarea',
            'sql'       => "text NULL"
        ),
        'published'     => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_category']['published'],
            'filter'    => true,
            'flag'      => 2,
            'inputType' => 'checkbox',
            'eval'      => array('doNotCopy' => true),
            'sql'       => "char(1) NOT NULL default ''"
        ),
        'start'         => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_category']['start'],
            'inputType' => 'text',
            'eval'      => array
            (
                'rgxp'       => 'datim',
                'datepicker' => true,
                'tl_class'   => 'w50 wizard'
            ),
            'sql'       => "varchar(10) NOT NULL default ''"
        ),
        'stop'          => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_category']['stop'],
            'inputType' => 'text',
            'eval'      => array
            (
                'rgxp'       => 'datim',
                'datepicker' => true,
                'tl_class'   => 'w50 wizard'
            ),
            'sql'       => "varchar(10) NOT NULL default ''"
        )
    )
);

