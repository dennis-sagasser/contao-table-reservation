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

$GLOBALS['BE_MOD']['table_reservation'] = [
    'table_config'     => [
        'tables' => ['tl_table_settings'],
        'icon'   => 'system/modules/table_reservation/assets/images/settings16.png',
    ],
    'table_categories' => [
        'tables'     => ['tl_table_category', 'tl_table_occupancy'],
        'icon'       => 'system/modules/table_reservation/assets/images/table16.png',
        'stylesheet' => 'system/modules/table_reservation/assets/css/layout.min.css',
        'javascript' => 'system/modules/table_reservation/assets/js/datepicker.js'
    ],
    'table_timeslots'  => [
        'tables' => ['tl_table_slots'],
        'icon'   => 'system/modules/table_reservation/assets/images/slots16.png',
    ],
    'table_list'       => [
        'tables' => ['tl_table_list'],
        'icon'   => 'system/modules/table_reservation/assets/images/list16.png',
    ],
];

$GLOBALS['FE_MOD']['seat_reservation']['table_reservation'] = 'ModuleTableReservation';
$GLOBALS['TL_HOOKS']['replaceInsertTags'][]                 = ['HooksFrontend', 'myReplaceInsertTags'];
$GLOBALS['TL_HOOKS']['parseBackendTemplate'][]              = ['HooksBackend', 'myParseBackendTemplate'];
$GLOBALS['TL_HOOKS']['loadDataContainer'][]                 = ['HooksBackend', 'myLoadDataContainer'];