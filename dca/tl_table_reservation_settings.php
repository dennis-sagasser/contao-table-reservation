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
 * Table tl_table_reservation_settings
 */
$GLOBALS['TL_DCA']['tl_table_reservation_settings'] = array
(
    // Config
    'config'      => array
    (
        'dataContainer'    => 'Table',
        'onload_callback'  => array
        (
            array('tl_table_reservation_settings', 'checkConfig'),
        ),
        'enableVersioning' => true,
        'sql'              => array
        (
            'keys' => array
            (
                'id' => 'primary',
            )
        )
    ),

    // Palettes
    'palettes'    => array
    (
        '__selector__' => array('addFile', 'useSMTP'),
        'default'      => '{title_legend},subject;{html_legend},content;{text_legend:hide},text;{attachment_legend},addFile;{template_legend:hide},template;{expert_legend:hide},sendText,externalImages,senderName,sender,bCc;{smtp_legend:hide},useSMTP'
    ),

    // Subpalettes
    'subpalettes' => array
    (
        'addFile' => 'files',
        'useSMTP' => 'smtpHost,smtpUser,smtpPass,smtpEnc,smtpPort'
    ),

    // Fields
    'fields'      => array
    (
        'id'             => array
        (
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp'         => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'subject'        => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_reservation_settings']['subject'],
            'exclude'   => true,
            'search'    => true,
            'sorting'   => true,
            'flag'      => 1,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true, 'decodeEntities' => true, 'maxlength' => 128, 'tl_class' => 'w50'),
            'sql'       => "varchar(255) NOT NULL default ''",
            'default'   => $GLOBALS['TL_LANG']['tl_table_reservation_settings']['default_subject']
        ),
        'content'        => array
        (
            'label'         => &$GLOBALS['TL_LANG']['tl_table_reservation_settings']['content'],
            'exclude'       => true,
            'search'        => true,
            'inputType'     => 'textarea',
            'eval'          => array('rte' => 'tinyNews', 'helpwizard' => true),
            'explanation'   => 'insertTags',
            'default'       => $GLOBALS['TL_LANG']['tl_table_reservation_settings']['default_html_text'],
            'load_callback' => array
            (
                array('tl_table_reservation_settings', 'convertAbsoluteLinks')
            ),
            'save_callback' => array
            (
                array('tl_table_reservation_settings', 'convertRelativeLinks')
            ),
            'sql'           => "mediumtext NULL"
        ),
        'text'           => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_reservation_settings']['text'],
            'exclude'   => true,
            'search'    => true,
            'inputType' => 'textarea',
            'eval'      => array('decodeEntities' => true, 'class' => 'noresize'),
            'sql'       => "mediumtext NULL"
        ),
        'addFile'        => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_reservation_settings']['addFile'],
            'exclude'   => true,
            'filter'    => true,
            'inputType' => 'checkbox',
            'eval'      => array('submitOnChange' => true),
            'sql'       => "char(1) NOT NULL default ''"
        ),
        'files'          => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_reservation_settings']['files'],
            'exclude'   => true,
            'inputType' => 'fileTree',
            'eval'      => array('multiple' => true, 'fieldType' => 'checkbox', 'filesOnly' => true, 'mandatory' => true),
            'sql'       => "blob NULL"
        ),
        'template'       => array
        (
            'label'            => &$GLOBALS['TL_LANG']['tl_table_reservation_settings']['template'],
            'default'          => 'mail_default',
            'exclude'          => true,
            'inputType'        => 'select',
            'options_callback' => array('tl_table_reservation_settings', 'getMailTemplates'),
            'sql'              => "varchar(32) NOT NULL default ''"
        ),
        'sendText'       => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_reservation_settings']['sendText'],
            'exclude'   => true,
            'filter'    => true,
            'inputType' => 'checkbox',
            'eval'      => array('tl_class' => 'w50'),
            'sql'       => "char(1) NOT NULL default ''"
        ),
        'externalImages' => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_reservation_settings']['externalImages'],
            'exclude'   => true,
            'inputType' => 'checkbox',
            'eval'      => array('tl_class' => 'w50'),
            'sql'       => "char(1) NOT NULL default ''"
        ),
        'sender'         => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_reservation_settings']['sender'],
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'inputType' => 'text',
            'eval'      => array('rgxp' => 'email', 'maxlength' => 128, 'decodeEntities' => true, 'tl_class' => 'w50'),
            'sql'       => "varchar(128) NOT NULL default ''"
        ),
        'senderName'     => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_reservation_settings']['senderName'],
            'exclude'   => true,
            'search'    => true,
            'sorting'   => true,
            'flag'      => 11,
            'inputType' => 'text',
            'eval'      => array('decodeEntities' => true, 'maxlength' => 128, 'tl_class' => 'w50'),
            'sql'       => "varchar(128) NOT NULL default ''"
        ),
        'bCc'            => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_reservation_settings']['bCc'],
            'exclude'   => true,
            'search'    => true,
            'filter'    => true,
            'inputType' => 'text',
            'eval'      => array('rgxp' => 'email', 'maxlength' => 128, 'decodeEntities' => true, 'tl_class' => 'w50'),
            'sql'       => "varchar(128) NOT NULL default ''"
        ),
        'useSMTP'        => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_reservation_settings']['useSMTP'],
            'exclude'   => true,
            'inputType' => 'checkbox',
            'eval'      => array('submitOnChange' => true),
            'sql'       => "char(1) NOT NULL default ''"
        ),
        'smtpHost'       => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_reservation_settings']['smtpHost'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true, 'maxlength' => 64, 'nospace' => true, 'doNotShow' => true, 'tl_class' => 'long'),
            'sql'       => "varchar(64) NOT NULL default ''"
        ),
        'smtpUser'       => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_reservation_settings']['smtpUser'],
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('decodeEntities' => true, 'maxlength' => 128, 'doNotShow' => true, 'tl_class' => 'w50'),
            'sql'       => "varchar(128) NOT NULL default ''"
        ),
        'smtpPass'       => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_reservation_settings']['smtpPass'],
            'exclude'   => true,
            'inputType' => 'textStore',
            'eval'      => array('decodeEntities' => true, 'maxlength' => 32, 'doNotShow' => true, 'tl_class' => 'w50'),
            'sql'       => "varchar(32) NOT NULL default ''"
        ),
        'smtpEnc'        => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_reservation_settings']['smtpEnc'],
            'exclude'   => true,
            'inputType' => 'select',
            'options'   => array('' => '-', 'ssl' => 'SSL', 'tls' => 'TLS'),
            'eval'      => array('doNotShow' => true, 'tl_class' => 'w50'),
            'sql'       => "varchar(3) NOT NULL default ''"
        ),
        'smtpPort'       => array
        (
            'label'     => &$GLOBALS['TL_LANG']['tl_table_reservation_settings']['smtpPort'],
            'default'   => 25,
            'exclude'   => true,
            'inputType' => 'text',
            'eval'      => array('mandatory' => true, 'rgxp' => 'digit', 'nospace' => true, 'doNotShow' => true, 'tl_class' => 'w50'),
            'sql'       => "smallint(5) unsigned NOT NULL default '0'"
        ),
    )
);

/**
 * Class tl_table_reservation_settings
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
class tl_table_reservation_settings extends Backend
{

    /**
     * Import the back end user object
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Only show one item for the settings and redirect to it
     *
     * @return string
     */
    public function checkConfig()
    {
        $objConfig = Database::getInstance()->prepare("SELECT * FROM tl_table_reservation_settings")->execute();

        if (Input::get('key')) {
            return;
        }

        if (!$objConfig->numRows && !Input::get('act')) {
            $this->redirect($this->addToUrl('act=create'));
        }

        if (!Input::get('id') && !Input::get('act')) {
            $this->redirect($this->addToUrl('act=edit&id=' . $objConfig->id));
        }
    }


    /**
     * Convert absolute URLs from TinyMCE to relative URLs
     *
     * @param string $strContent URL
     *
     * @return string
     */
    public function convertAbsoluteLinks($strContent)
    {
        return str_replace('src="' . Environment::get('base'), 'src="', $strContent);
    }


    /**
     * Convert relative URLs from TinyMCE to absolute URLs
     *
     * @param string $strContent URL
     *
     * @return string
     */
    public function convertRelativeLinks($strContent)
    {
        return $this->convertRelativeUrls($strContent);
    }

    /**
     * Return all mail templates as array
     *
     * @return array
     */
    public function getMailTemplates()
    {
        return $this->getTemplateGroup('mail_');
    }
}