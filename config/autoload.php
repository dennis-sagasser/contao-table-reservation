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
	'Contao\ModuleTableReservation' => 'system/modules/table_reservation/modules/ModuleTableReservation.php',
	'Contao\HookMyInsertTags'       => 'system/modules/table_reservation/modules/HookMyInsertTags.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_reservation_form_page2' => 'system/modules/table_reservation/templates',
	'mod_reservation_form'       => 'system/modules/table_reservation/templates',
));
