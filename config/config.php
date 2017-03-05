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

$GLOBALS['BE_MOD']['table_reservation'] = array(
    'table_config'           => array(
        'tables' => array('tl_table_reservation_settings'),
        //'callback'     => 'ClassName',
        'icon'   => 'system/modules/table_reservation/assets/images/settings16.png',
        //'stylesheet'   => 'path/to/stylesheet.css',
        //'javascript'   => 'path/to/javascript.js'
    ),
    'table_categories'       => array(
        'tables'     => array('tl_table_category', 'tl_table_occupancy'),
        //'callback'     => 'ClassName',
        'icon'       => 'system/modules/table_reservation/assets/images/table16.png',
        'stylesheet' => 'system/modules/table_reservation/assets/css/layout.min.css',
        'javascript' => 'system/modules/table_reservation/assets/js/datepicker.js'
    ),
    'table_reservation_list' => array(
        'tables' => array('tl_table_reservation_list'),
        //'callback'     => 'ClassName',
        'icon'   => 'system/modules/table_reservation/assets/images/reservation_list16.png',
        //'stylesheet'   => 'path/to/stylesheet.css',
        //'javascript'   => 'path/to/javascript.js'
    ),
);

$GLOBALS['FE_MOD']['seat_reservation']['table_reservation'] = 'ModuleTableReservation';
$GLOBALS['TL_HOOKS']['replaceInsertTags'][]                 = array('HookMyTableInsertTags', 'myReplaceInsertTags');
$GLOBALS['TL_CSS'][]                                        = 'system/modules/table_reservation/assets/css/form.min.css';
$GLOBALS['TL_MOOTOOLS'][]                                   = '<script type="text/javascript">// <![CDATA[
    $$("view-details").addEvent("click", function() {
            $("overviewTable").toggleClass("invisible");
    });
    // ]]></script>';