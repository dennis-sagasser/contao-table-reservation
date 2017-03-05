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
	'Contao\HookMyTableInsertTags'  => 'system/modules/table_reservation/modules/HookMyTableInsertTags.php',
	'Contao\ModuleTableReservation' => 'system/modules/table_reservation/modules/ModuleTableReservation.php',
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
