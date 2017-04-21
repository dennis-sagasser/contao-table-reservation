<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
    // Modules
    'Contao\ModuleTableReservation'      => 'system/modules/table_reservation/modules/ModuleTableReservation.php',

    // Classes
    'Contao\tl_table_list'               => 'system/modules/table_reservation/classes/tl_table_list.php',
    'Contao\tl_table_category'           => 'system/modules/table_reservation/classes/tl_table_category.php',
    'Contao\tl_table_settings'           => 'system/modules/table_reservation/classes/tl_table_settings.php',
    'Contao\tl_table_slots'              => 'system/modules/table_reservation/classes/tl_table_slots.php',
    'Contao\tl_table_occupancy'          => 'system/modules/table_reservation/classes/tl_table_occupancy.php',
    'Contao\tl_module_table_reservation' => 'system/modules/table_reservation/classes/tl_module_table_reservation.php',

    // Library
    'Contao\HooksBackend'                => 'system/modules/table_reservation/library/TableReservation/HooksBackend.php',
    'Contao\HooksFrontend'               => 'system/modules/table_reservation/library/TableReservation/HooksFrontend.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
    'mod_table_reservation_form_success' => 'system/modules/table_reservation/templates',
    'mod_table_reservation_form'         => 'system/modules/table_reservation/templates',
    'mod_table_reservation_form_page2'   => 'system/modules/table_reservation/templates',
));
