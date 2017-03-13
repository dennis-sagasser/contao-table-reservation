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
 * Add Callback to show MooTools hint.
 */
$GLOBALS['TL_DCA']['tl_module']['config']['onload_callback'] = ['tl_module_table_reservation', 'showJsLibraryHint'];

/**
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['table_reservation'] = '{title_legend},name,headline,type;{config_legend},table_dateTimeFormat,table_timeFormat,table_categories;{redirect_legend},jumpTo;{expert_legend:hide},guests,cssID,space';


/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['table_dateTimeFormat'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_module']['dateTimeFormat'],
    'exclude'   => true,
    'inputType' => 'text',
//    'options_callback' => ['tl_module_table_reservation', 'getTableCategories'],
    'eval'      => ['rgxp' => 'extnd', 'decodeEntities' => true, 'tl_class' => 'w50'],
    'sql'       => "varchar(32) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_module']['fields']['table_timeFormat'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_module']['timeFormat'],
    'exclude'   => true,
    'inputType' => 'text',
//    'options_callback' => ['tl_module_table_reservation', 'getTableCategories'],
    'eval'      => ['rgxp' => 'extnd', 'decodeEntities' => true, 'tl_class' => 'w50'],
    'sql'       => "varchar(32) NOT NULL default ''"
];
$GLOBALS['TL_DCA']['tl_module']['fields']['table_categories'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_module']['tableCategories'],
    'exclude'          => true,
    'inputType'        => 'checkbox',
    'options_callback' => ['tl_module_table_reservation', 'getTableCategories'],
    'eval'             => ['mandatory' => true, 'multiple' => true],
    'sql'              => "blob NULL"
];