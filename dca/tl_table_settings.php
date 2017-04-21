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
 * Table tl_table_settings
 */
$GLOBALS['TL_DCA']['tl_table_settings'] = [
    // Config
    'config'      => [
        'dataContainer'    => 'Table',
        'onload_callback'  => [
            ['tl_table_settings', 'checkConfig'],
        ],
        'enableVersioning' => true,
        'sql'              => [
            'keys' => [
                'id' => 'primary',
            ]
        ]
    ],

    // Palettes
    'palettes'    => [
        '__selector__' => ['addFile', 'useSMTP'],
        'default'      => '{title_legend},subject;{html_legend},content;{text_legend:hide},text;{attachment_legend},addFile;{template_legend:hide},template;{expert_legend:hide},sendText,externalImages,senderName,sender,bCc;{smtp_legend:hide},useSMTP'
    ],

    // Subpalettes
    'subpalettes' => [
        'addFile' => 'files',
        'useSMTP' => 'smtpHost,smtpUser,smtpPass,smtpEnc,smtpPort'
    ],

    // Fields
    'fields'      => [
        'id'             => [
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ],
        'tstamp'         => [
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ],
        'subject'        => [
            'label'     => &$GLOBALS['TL_LANG']['tl_table_settings']['subject'],
            'exclude'   => true,
            'search'    => true,
            'sorting'   => true,
            'flag'      => 1,
            'inputType' => 'text',
            'eval'      => ['mandatory' => true, 'decodeEntities' => true, 'maxlength' => 128, 'tl_class' => 'w50'],
            'sql'       => "varchar(255) NOT NULL default ''",
            'default'   => $GLOBALS['TL_LANG']['tl_table_settings']['default_subject']
        ],
        'content'        => [
            'label'         => &$GLOBALS['TL_LANG']['tl_table_settings']['content'],
            'exclude'       => true,
            'search'        => true,
            'inputType'     => 'textarea',
            'eval'          => ['rte' => 'tinyNews', 'helpwizard' => true],
            'explanation'   => 'insertTags',
            'default'       => $GLOBALS['TL_LANG']['tl_table_settings']['default_html_text'],
            'load_callback' => [
                ['tl_table_settings', 'convertAbsoluteLinks']
            ],
            'save_callback' => [
                ['tl_table_settings', 'convertRelativeLinks']
            ],
            'sql'           => "mediumtext NULL"
        ],
        'text'           => [
            'label'     => &$GLOBALS['TL_LANG']['tl_table_settings']['text'],
            'exclude'   => true,
            'search'    => true,
            'inputType' => 'textarea',
            'eval'      => ['decodeEntities' => true, 'class' => 'noresize'],
            'sql'       => "mediumtext NULL"
        ],
        'addFile'        => [
            'label'     => &$GLOBALS['TL_LANG']['tl_table_settings']['addFile'],
            'exclude'   => true,
            'filter'    => true,
            'inputType' => 'checkbox',
            'eval'      => ['submitOnChange' => true],
            'sql'       => "char(1) NOT NULL default ''"
        ],
        'files'          => [
            'label'     => &$GLOBALS['TL_LANG']['tl_table_settings']['files'],
            'exclude'   => true,
            'inputType' => 'fileTree',
            'eval'      => ['multiple' => true, 'fieldType' => 'checkbox', 'filesOnly' => true, 'mandatory' => true],
            'sql'       => "blob NULL"
        ],
        'template'       => [
            'label'            => &$GLOBALS['TL_LANG']['tl_table_settings']['template'],
            'default'          => 'mail_default',
            'exclude'          => true,
            'inputType'        => 'select',
            'options_callback' => ['tl_table_settings', 'getMailTemplates'],
            'sql'              => "varchar(32) NOT NULL default ''"
        ],
        'sendText'       => [
            'label'     => &$GLOBALS['TL_LANG']['tl_table_settings']['sendText'],
            'exclude'   => true,
            'filter'    => true,
            'inputType' => 'checkbox',
            'eval'      => ['tl_class' => 'w50'],
            'sql'       => "char(1) NOT NULL default ''"
        ],
        'externalImages' => [
            'label'     => &$GLOBALS['TL_LANG']['tl_table_settings']['externalImages'],
            'exclude'   => true,
            'inputType' => 'checkbox',
            'eval'      => ['tl_class' => 'w50'],
            'sql'       => "char(1) NOT NULL default ''"
        ],
        'sender'         => [
            'label'     => &$GLOBALS['TL_LANG']['tl_table_settings']['sender'],
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'inputType' => 'text',
            'eval'      => ['rgxp' => 'email', 'maxlength' => 128, 'decodeEntities' => true, 'tl_class' => 'w50'],
            'sql'       => "varchar(128) NOT NULL default ''"
        ],
        'senderName'     => [
            'label'     => &$GLOBALS['TL_LANG']['tl_table_settings']['senderName'],
            'exclude'   => true,
            'search'    => true,
            'sorting'   => true,
            'flag'      => 11,
            'inputType' => 'text',
            'eval'      => ['decodeEntities' => true, 'maxlength' => 128, 'tl_class' => 'w50'],
            'sql'       => "varchar(128) NOT NULL default ''"
        ],
        'bCc'            => [
            'label'     => &$GLOBALS['TL_LANG']['tl_table_settings']['bCc'],
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'inputType' => 'text',
            'eval'      => ['rgxp' => 'email', 'maxlength' => 128, 'decodeEntities' => true, 'tl_class' => 'w50'],
            'sql'       => "varchar(128) NOT NULL default ''"
        ],
        'useSMTP'        => [
            'label'     => &$GLOBALS['TL_LANG']['tl_table_settings']['useSMTP'],
            'exclude'   => true,
            'inputType' => 'checkbox',
            'eval'      => ['submitOnChange' => true],
            'sql'       => "char(1) NOT NULL default ''"
        ],
        'smtpHost'       => [
            'label'     => &$GLOBALS['TL_LANG']['tl_table_settings']['smtpHost'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => ['mandatory' => true, 'maxlength' => 64, 'nospace' => true, 'doNotShow' => true, 'tl_class' => 'long'],
            'sql'       => "varchar(64) NOT NULL default ''"
        ],
        'smtpUser'       => [
            'label'     => &$GLOBALS['TL_LANG']['tl_table_settings']['smtpUser'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => ['decodeEntities' => true, 'maxlength' => 128, 'doNotShow' => true, 'tl_class' => 'w50'],
            'sql'       => "varchar(128) NOT NULL default ''"
        ],
        'smtpPass'       => [
            'label'     => &$GLOBALS['TL_LANG']['tl_table_settings']['smtpPass'],
            'exclude'   => true,
            'inputType' => 'textStore',
            'eval'      => ['decodeEntities' => true, 'maxlength' => 32, 'doNotShow' => true, 'tl_class' => 'w50'],
            'sql'       => "varchar(32) NOT NULL default ''"
        ],
        'smtpEnc'        => [
            'label'     => &$GLOBALS['TL_LANG']['tl_table_settings']['smtpEnc'],
            'exclude'   => true,
            'inputType' => 'select',
            'options'   => ['' => '-', 'ssl' => 'SSL', 'tls' => 'TLS'],
            'eval'      => ['doNotShow' => true, 'tl_class' => 'w50'],
            'sql'       => "varchar(3) NOT NULL default ''"
        ],
        'smtpPort'       => [
            'label'     => &$GLOBALS['TL_LANG']['tl_table_settings']['smtpPort'],
            'default'   => 25,
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => ['mandatory' => true, 'rgxp' => 'digit', 'nospace' => true, 'doNotShow' => true, 'tl_class' => 'w50'],
            'sql'       => "smallint(5) unsigned NOT NULL default '0'"
        ],
    ]
];