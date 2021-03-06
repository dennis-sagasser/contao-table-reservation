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

namespace ContaoTableReservation;

use Contao\Module;
use Contao\Session;
use Contao\Config;
use Contao\System;
use Contao\Input;
use Contao\FormSelectMenu;
use Contao\FormSubmit;
use Contao\FormCheckBox;
use Contao\FormRadioButton;
use Contao\FormTextField;
use Contao\FormTextArea;
use Contao\FormCaptcha;
use Contao\StringUtil;
use Contao\FilesModel;
use Contao\Validator;
use Contao\Message;
use Contao\Database;
use Contao\Email;
use Contao\BackendTemplate;
use Contao\Widget;
use Contao\Date;
use Contao\FrontendTemplate;
use Contao\Frontend;
use Contao\Controller;
use Contao\PageModel;

/**
 * Class ModuleTableReservation
 *
 * Generates and validates the forms for the frontend.
 *
 * @category  Contao
 * @package   TableReservation
 * @author    Dennis Sagasser <sagasser@gispack.com>
 * @copyright 2017 Dennis Sagasser
 * @license   http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * @link      https://contao.org
 */
class ModuleTableReservation extends Module
{
    /**
     * @var string $strTemplate Template
     */
    protected $strTemplate = 'mod_table_reservation_form';

    /**
     * @var Session $objSession Session object
     */
    protected $objSession = null;

    /**
     * Parse template
     *
     * @return string
     */
    public function generate()
    {
        return parent::generate();
    }

    /**
     * Generate module
     *
     */
    protected function compile()
    {
        $this->objSession           = Session::getInstance();
        $this->Template->objSession = $this->objSession;

        System::loadLanguageFile('tl_table_reservation');

        // Initialize form fields
        $objWidgetArrival = new FormTextField(
            [
                'id'        => 'arrival',
                'label'     => empty($this->table_showTimeSlots) ?
                    $GLOBALS['TL_LANG']['MSC']['table_reservation']['formArrivalDateTime'] :
                    $GLOBALS['TL_LANG']['MSC']['table_reservation']['formArrivalDate'],
                'name'      => 'arrival',
                'mandatory' => true,
//                'rgxp'      => empty($this->table_showTimeSlots) ? 'datim' : 'date',
                'value'     => Input::post('arrival'),
//                'dateFormat' => empty($this->table_showTimeSlots) ?
//                    $this->table_dateTimeFormat : Config::get('dateFormat')
            ]
        );

        $this->Template->objWidgetArrival = $objWidgetArrival;

        if (!empty($this->table_showTimeSlots)) {
            $arrTimeSlots = $this->Database->prepare("
                SELECT name, fromTime, toTime 
                FROM tl_table_slots 
                WHERE published='1'
                GROUP BY fromTime, toTime
                ")->execute()->fetchAllAssoc();

            $arrTimeSlotOptions = [['value' => '', 'label' => '-']];

            foreach ($arrTimeSlots as $arrTimeSlot) {
                $strTimeFormat = empty($this->table_timeFormat) ?
                    Config::getInstance()->get('timeFormat') : $this->table_timeFormat;

                $strLabel = sprintf(
                    '%s - %s',
                    date($strTimeFormat, $arrTimeSlot['fromTime']),
                    date($strTimeFormat, $arrTimeSlot['toTime'])
                );

                $arrTimeSlotOptions[] = ['value' => $strLabel . " - " . $arrTimeSlot['name'], 'label' => $strLabel];
            }

            $objWidgetTimeSlots = new FormSelectMenu(
                [
                    'id'        => 'timeslots',
                    'label'     => $GLOBALS['TL_LANG']['MSC']['table_reservation']['formTimeSlots'],
                    'name'      => 'timeslots',
                    'options'   => $arrTimeSlotOptions,
                    'chosen'    => true,
                    'mandatory' => true,
                    'value'     => Input::post('timeslots')
                ]
            );

            $this->Template->objWidgetTimeSlots = $objWidgetTimeSlots;

        }

        $objWidgetSubmit = new FormSubmit(
            [
                'id'     => 'submit',
                'class'  => 'btn btn-default',
                'slabel' => $GLOBALS['TL_LANG']['MSC']['table_reservation']['formSubmit'],
            ]
        );

        $this->Template->objWidgetSubmit = $objWidgetSubmit;

        $objCategorySettings = Database::getInstance()->prepare("
            SELECT id AS value, tablecategory AS label, maxcount
            FROM tl_table_category 
            WHERE published = '1' 
            AND (? BETWEEN start AND stop OR (start = '' AND stop = '')) 
            ORDER BY tablecategory")
            ->execute(time());

        $arrSelect = [];

        while ($objCategorySettings->next()) {
            $arrSelectOptions = [];
            for ($i = 0; $i <= $objCategorySettings->maxcount; $i++) {
                $arrSelectOptions[$i] = ['value' => $i, 'label' => $i];
            }
            $objSelectMenu = new FormSelectMenu(
                [
                    'id'      => $objCategorySettings->value,
                    'label'   => $GLOBALS['TL_LANG']['MSC']['table_reservation']['count'] . ' ' .
                        $objCategorySettings->label,
                    'name'    => $objCategorySettings->value,
                    'options' => $arrSelectOptions,
                ]
            );

            $arrSelect[] = $objSelectMenu;
        }

        $this->Template->arrSelects = $arrSelect;

        $objWidgetCheckboxes = new FormCheckBox(
            [
                'id'        => 'tableCategory',
                'label'     => $GLOBALS['TL_LANG']['MSC']['table_reservation']['formTableCategory'],
                'name'      => 'tableCategory',
                'options'   => $objCategorySettings->fetchAllAssoc(),
                'mandatory' => true,
                'value'     => count($objCategorySettings->fetchAllAssoc()) === 1 ? true :
                    Input::post('tableCategory')
            ]
        );

        if (empty($arrSelect)) {
            $objWidgetCheckboxes->addError(
                $GLOBALS['TL_LANG']['MSC']['table_reservation']['formNoTableCategoryPublished']
            );
        }

        $this->Template->objWidgetCheckboxes = $objWidgetCheckboxes;

        if (Input::post('FORM_SUBMIT') === 'form_availability_submit') {
            $this->compileAvailabilityCheck(
                $objWidgetArrival,
                $objWidgetTimeSlots,
                $objWidgetCheckboxes
            );
        }

        if (Input::get('FORM_PAGE') === 'page2' && $this->objSession->get('seats')) {

            $this->strTemplate           = 'mod_table_reservation_form_page2';
            $this->Template              = new FrontendTemplate($this->strTemplate);
            $this->Template->infoMessage = $GLOBALS['TL_LANG']['MSC']['table_reservation']['reservationPossible'];
            $this->Template->arrSeats    = $this->objSession->get('seats');
            $this->Template->objSession  = $this->objSession;

            $objWidgetSalutation = new FormRadioButton(
                [
                    'id'      => 'salutation',
                    'label'   => $GLOBALS['TL_LANG']['MSC']['table_reservation']['formSalutation'],
                    'name'    => 'salutation',
                    'options' => [
                        ['value' => 'male', 'label' => $GLOBALS['TL_LANG']['MSC']['table_reservation']['formMale']],
                        ['value' => 'female', 'label' => $GLOBALS['TL_LANG']['MSC']['table_reservation']['formFemale']]
                    ]
                ]
            );

            $this->Template->objWidgetSalutation = $objWidgetSalutation;

            $objWidgetFirstName = new FormTextField(
                [
                    'id'    => 'firstname',
                    'label' => $GLOBALS['TL_LANG']['MSC']['table_reservation']['formFirstname'],
                    'name'  => 'firstname',
                    'rgxp'  => 'alpha',
                    'value' => Input::post('firstname')
                ]
            );

            $this->Template->objWidgetFirstName = $objWidgetFirstName;

            $objWidgetLastName = new FormTextField(
                [
                    'id'    => 'lastname',
                    'label' => $GLOBALS['TL_LANG']['MSC']['table_reservation']['formLastname'],
                    'name'  => 'lastname',
                    'rgxp'  => 'alpha',
                    'value' => Input::post('lastname')
                ]
            );

            $this->Template->objWidgetLastName = $objWidgetLastName;


            $objWidgetEmail = new FormTextField(
                [
                    'id'        => 'email',
                    'label'     => $GLOBALS['TL_LANG']['MSC']['table_reservation']['formEmail'],
                    'name'      => 'email',
                    'mandatory' => true,
                    'rgxp'      => 'email',
                    'value'     => Input::post('email')
                ]
            );

            $this->Template->objWidgetEmail = $objWidgetEmail;

            $objWidgetPhone = new FormTextField(
                [
                    'id'        => 'phone',
                    'label'     => $GLOBALS['TL_LANG']['MSC']['table_reservation']['formPhone'],
                    'name'      => 'phone',
                    'mandatory' => false,
                    'rgxp'      => 'phone',
                    'value'     => Input::post('phone')
                ]
            );

            $this->Template->objWidgetPhone = $objWidgetPhone;

            $objWidgetRemarks = new FormTextArea(
                [
                    'id'        => 'remarks',
                    'label'     => $GLOBALS['TL_LANG']['MSC']['table_reservation']['formRemarks'],
                    'name'      => 'remarks',
                    'mandatory' => false,
                    'value'     => Input::post('remarks')
                ]
            );

            $this->Template->objWidgetRemarks = $objWidgetRemarks;

            $objWidgetCaptcha = new FormCaptcha(
                [
                    'id'        => 'captcha',
                    'label'     => $GLOBALS['TL_LANG']['MSC']['table_reservation']['formCaptcha'],
                    'name'      => 'captcha',
                    'mandatory' => true,
                    'value'     => Input::post('captcha')
                ]
            );

            $this->Template->objWidgetCaptcha = $objWidgetCaptcha;


            $objWidgetConfirmation = new FormCheckBox(
                [
                    'id'        => 'confirmation',
                    'label'     => $GLOBALS['TL_LANG']['MSC']['table_reservation']['formConfirmation'],
                    'name'      => 'confirmation',
                    'mandatory' => true,
                    'value'     => Input::post('confirmation'),
                    'options'   => [
                        [
                            'value' => '1',
                            'label' => $GLOBALS['TL_LANG']['MSC']['table_reservation']['formConfirmationText']
                        ]
                    ]
                ]
            );

            $this->Template->objWidgetConfirmation = $objWidgetConfirmation;

            $objWidgetSubmit = new FormSubmit(
                [
                    'id'    => 'submit',
                    'class' => 'btn btn-success',
                    'label' => $GLOBALS['TL_LANG']['MSC']['table_reservation']['formReservationSubmit'],
                ]
            );

            $this->Template->objWidgetSubmit = $objWidgetSubmit;
        }

        if (Input::post('FORM_SUBMIT') === 'form_reservation_submit' && $this->objSession->get('seats')) {
            $this->compileReservationCheck(
                $objWidgetSalutation,
                $objWidgetFirstName,
                $objWidgetLastName,
                $objWidgetEmail,
                $objWidgetPhone,
                $objWidgetRemarks,
                $objWidgetCaptcha,
                $objWidgetConfirmation
            );
        }
    }

    /**
     * Sends a confirmation mail to the user
     *
     */
    public function send()
    {
        if (intval($this->table_showNotification) > 0 && intval($this->table_ncNotification) > 0) {
            $objNotification = \NotificationCenter\Model\Notification::findByPk(intval($this->table_ncNotification));
            if (null !== $objNotification) {
                $objNotification->send([]);
            }
            return;
        }

        $objSettings = Database::getInstance()->prepare("SELECT * FROM tl_table_settings")->limit(1)->execute();

        if ($objSettings->numRows < 1) {
            return;
        }

        // Overwrite the SMTP configuration
        if ($objSettings->useSMTP) {
            Config::set('useSMTP', true);
            Config::set('smtpHost', $objSettings->smtpHost);
            Config::set('smtpUser', $objSettings->smtpUser);
            Config::set('smtpPass', $objSettings->smtpPass);
            Config::set('smtpEnc', $objSettings->smtpEnc);
            Config::set('smtpPort', $objSettings->smtpPort);
        }

        // Add default sender address
        if ($objSettings->sender == '') {
            list($objSettings->senderName, $objSettings->sender) = StringUtil::splitFriendlyEmail(
                Config::get('adminEmail')
            );
        }

        // Add default Bcc
        if ($objSettings->bCc == '') {
            list($objSettings->senderName, $objSettings->bCc) = StringUtil::splitFriendlyEmail(
                Config::get('adminEmail')
            );
        }

        $arrAttachments            = [];
        $blnAttachmentsFormatError = false;

        // Add attachments
        if ($objSettings->addFile) {
            $files = deserialize($objSettings->files);

            if (!empty($files) && is_array($files)) {
                $objFiles = FilesModel::findMultipleByUuids($files);

                if ($objFiles === null) {
                    if (!Validator::isUuid($files[0])) {
                        $blnAttachmentsFormatError = true;
                        Message::addError($GLOBALS['TL_LANG']['ERR']['version2format']);
                    }
                } else {
                    while ($objFiles->next()) {
                        if (is_file(TL_ROOT . '/' . $objFiles->path)) {
                            $arrAttachments[] = $objFiles->path;
                        }
                    }
                }
            }
        }

        // Replace insert tags
        $strHtml = $this->replaceInsertTags($objSettings->content);
        $strText = $this->replaceInsertTags($objSettings->text);

        // Convert relative URLs
        if ($objSettings->externalImages) {
            $strHtml = Controller::convertRelativeUrls($strHtml);
        }

        // Send newsletter
        if (!$blnAttachmentsFormatError) {
            // Send newsletter
            $objEmail = $this->generateEmailObject($objSettings, $arrAttachments);
            $this->sendConfirmation($objEmail, $objSettings, Input::post('email'), $strText, $strHtml);
        }
    }

    /**
     * Generate the e-mail object and return it
     *
     * @param Database\Result $objSettings Database result
     * @param array $arrAttachments E-mail attachments
     *
     * @return Email
     */
    protected
    function generateEmailObject(Database\Result $objSettings, $arrAttachments)
    {
        $objEmail = new Email();

        $objEmail->from    = $objSettings->sender;
        $objEmail->subject = $objSettings->subject;
        $objEmail->sendBcc($objSettings->bCc);

        // Add sender name
        if ($objSettings->senderName != '') {
            $objEmail->fromName = $objSettings->senderName;
        }

        $objEmail->embedImages = !$objSettings->externalImages;
        $objEmail->logFile     = 'reservation_' . $objSettings->id . '.log';

        // Attachments
        if (!empty($arrAttachments) && is_array($arrAttachments)) {
            foreach ($arrAttachments as $strAttachment) {
                $objEmail->attachFile(TL_ROOT . '/' . $strAttachment);
            }
        }

        return $objEmail;
    }

    /**
     * Compile the confirmation and send it
     *
     * @param Email $objEmail E-mail object
     * @param Database\Result $objSettings Database result
     * @param string $strRecipient Recipient
     * @param string $strText Plain text
     * @param string $strHtml HTML text
     * @param string $css CSS
     *
     */
    protected function sendConfirmation(
        Email $objEmail,
        Database\Result $objSettings,
        $strRecipient,
        $strText,
        $strHtml,
        $css = null
    )
    {
        $arrRecipients['email'] = $strRecipient;

        // Prepare the text content
        $objEmail->text = StringUtil::parseSimpleTokens($strText, $arrRecipients);

        // Add the HTML content
        if (!$objSettings->sendText) {
            // Default template
            if ($objSettings->template == '') {
                $objSettings->template = 'mail_default';
            }

            /** @var BackendTemplate|object $objTemplate */
            $objTemplate = new BackendTemplate($objSettings->template);
            $objTemplate->setData($objSettings->row());

            $objTemplate->title     = $objSettings->subject;
            $objTemplate->body      = StringUtil::parseSimpleTokens($strHtml, $arrRecipients);
            $objTemplate->charset   = Config::get('characterSet');
            $objTemplate->css       = $css; // Backwards compatibility
            $objTemplate->recipient = $arrRecipients['email'];

            // Parse template
            $objEmail->html     = $objTemplate->parse();
            $objEmail->imageDir = TL_ROOT . '/';
        }

        // Deactivate invalid addresses
        try {
            $objEmail->sendTo($arrRecipients['email']);
        } catch (\Swift_RfcComplianceException $e) {
            $_SESSION['REJECTED_RECIPIENTS'][] = $arrRecipients['email'];
        }

        // Rejected recipients
        if ($objEmail->hasFailures()) {
            $_SESSION['REJECTED_RECIPIENTS'][] = $arrRecipients['email'];
        }
    }

    /**
     * Check submitted availability form and display result
     *
     * @param Widget $objWidgetArrival Reservation time input
     * @param Widget $objWidgetTimeSlots Timeslots | null
     * @param Widget $objWidgetCheckboxes Table categories checkboxes
     *
     */
    protected function compileAvailabilityCheck(
        Widget $objWidgetArrival,
        Widget $objWidgetTimeSlots = null,
        Widget $objWidgetCheckboxes
    )
    {
        $objWidgetArrival->validate();
        $objWidgetCheckboxes->validate();

        $strTimeFormat = empty($this->table_timeFormat) ?
            Config::get('timeFormat') : $this->table_timeFormat;

        $objSlotNames   = new \tl_table_occupancy;
        $objArrivalDate = new Date(strtotime(Input::post('arrival')));

        $strArrivalDate       = $objArrivalDate::parse("Y-m-d", $objArrivalDate->tstamp);
        $strSlotColumns       = '';
        $strDepartureTime     = '';
        $intDepartureDateTime = 0;

        if (!empty($objWidgetTimeSlots)) {
            if (Input::post('timeslots') === '') {
                $objWidgetTimeSlots->addError($GLOBALS['TL_LANG']['MSC']['table_reservation']['timeSlotError']);

                return;
            }

            $arrTimeSlot          = explode(' - ', Input::post('timeslots'));
            $strArrivalTime       = $arrTimeSlot[0];
            $strDepartureTime     = $arrTimeSlot[1];
            $strCount             = $arrTimeSlot[2];
            $strPostArrival       = sprintf('%s %s', Input::post('arrival'), $strArrivalTime);
            $objArrivalDate       = new Date(strtotime($strPostArrival));
            $intArrivalDateTime   = $objArrivalDate->tstamp;
            $intDepartureDateTime = strtotime($strDepartureTime);
            $strSlotColumns       = ',' . implode(',', $objSlotNames->getTimeSlotNames());

        } else {
            $intArrivalDateTime = $objArrivalDate->tstamp;

            $arrLeadTime             = unserialize($this->table_leadTime);
            $strLeadTime             = sprintf("+ %s %s", $arrLeadTime['value'], $arrLeadTime['unit']);
            $intValidReservationTime = strtotime($strLeadTime, time());
            $strValidReservationTime = date($strTimeFormat, $intValidReservationTime);

            if (($intValidReservationTime > $intArrivalDateTime)) {
                $objWidgetArrival->addError(sprintf($GLOBALS['TL_LANG']['MSC']['table_reservation']['reservationTooLate'],
                    $strValidReservationTime));

                return;
            }

            $arrOpeningHours = unserialize($this->table_openingHours);
            $intArrivalTime  = strtotime($objArrivalDate->time, 0);

            foreach ($arrOpeningHours as $arrOpeningHour) {

                if (($intArrivalTime >= $arrOpeningHour['openFrom']) &&
                    ($intArrivalTime <= $arrOpeningHour['openTo']) &&
                    ($arrOpeningHour['weekDay'] === strftime('%A', $objArrivalDate->tstamp))
                ) {
                    $strCount = $arrOpeningHour['dayTime'];
                }
            }

            if (empty($strCount)) {
                $objWidgetArrival->addError($GLOBALS['TL_LANG']['MSC']['table_reservation']['closed']);

                return;
            }
        }

        $arrPostTableCategory = is_array(Input::post('tableCategory')) ?
            Input::post('tableCategory') :
            [Input::post('tableCategory')];

        $arrTableCategories = [];
        $arrCountSeats      = [];
        $arrSeats           = [];

        foreach ($arrPostTableCategory as $intTableCategory) {
            (intval(Input::post($intTableCategory)) < 1) ?
                $objWidgetCheckboxes->addError($GLOBALS['TL_LANG']['MSC']['table_reservation']['countError']) :
                $arrResultRow = Database::getInstance()->prepare("
                    SELECT
                      tmp1.*,
                      tmp2.tablecategory
                    FROM
                      (SELECT
                      pid,
                      o.date,
                      o.countMorning,
                      o.countNoon,
                      o.countEvening,
                      t.id
                      " . $strSlotColumns . "
                      FROM tl_table_occupancy o, tl_table_category t
                      WHERE o.date = ?
                          AND o.pid = ?
                          AND o.pid = t.id) tmp1
                      RIGHT JOIN
                        (SELECT DISTINCT tablecategory
                        FROM tl_table_category t, tl_table_occupancy o
                        WHERE t.id = o.pid
                             AND t.id = ?) tmp2 ON tmp1.pid = tmp1.id")
                    ->execute($strArrivalDate, $intTableCategory, $intTableCategory)
                    ->fetchAssoc();

            if (empty($arrResultRow[$strCount])) {
                $objWidgetCheckboxes->addError(
                    sprintf(
                        $GLOBALS['TL_LANG']['MSC']['table_reservation']['noSeatsForTableCategory'],
                        $arrResultRow['tablecategory']
                    ));

                return;
            }

            if (intval(Input::post($intTableCategory)) > intval($arrResultRow[$strCount])) {
                $objWidgetCheckboxes->addError(
                    sprintf(
                        $GLOBALS['TL_LANG']['MSC']['table_reservation']['maxCountError'],
                        $arrResultRow['tablecategory'],
                        $arrResultRow[$strCount]
                    ));

                return;
            }

            $arrSeats[] = [
                'count'        => intval(Input::post($intTableCategory)),
                'category'     => $intTableCategory,
                'categoryName' => $arrResultRow['tablecategory']
            ];

            $arrTableCategories[] = $intTableCategory;
            $arrCountSeats[]      = [
                "intCount"     => intval(Input::post($intTableCategory)),
                "strTimeOfDay" => $strCount
            ];

        }

        if (!$objWidgetCheckboxes->hasErrors() && !$objWidgetArrival->hasErrors()) {

            $arrCategoriesCount = array_combine($arrTableCategories, $arrCountSeats);

            $this->Template->infoMessage = $GLOBALS['TL_LANG']['MSC']['table_reservation']['reservationPossible'];
            $this->Template->arrSeats    = $arrSeats;

            $strReserveNowUrl                 = Frontend::addToUrl('FORM_PAGE=page2');
            $this->Template->strReserveNowUrl = $strReserveNowUrl;

            $strArrival  = date(
                !empty($this->table_dateTimeFormat) ?
                    $this->table_dateTimeFormat :
                    Config::get('dateFormat'),
                $intArrivalDateTime
            );
            $strDateTime = empty($objWidgetTimeSlots) ? $strArrival :
                sprintf('%s - %s', $strArrival, $strDepartureTime);

            $this->objSession->set('arrival', $strDateTime);
            $this->objSession->set('seats', $arrSeats);
            $this->objSession->set('tstampArrival', $intArrivalDateTime);
            $this->objSession->set('tstampDeparture', $intDepartureDateTime);
            $this->objSession->set('arrCategoriesCount', $arrCategoriesCount);
        } else {
            $this->Template->errorMessage = $GLOBALS['TL_LANG']['MSC']['table_reservation']['reservationNotPossible'];
        }
    }

    /**
     * Check submitted reservation form and display result
     *
     * @param Widget $objWidgetSalutation Salutation radio button
     * @param Widget $objWidgetFirstName Firstname input
     * @param Widget $objWidgetLastName Lastname input
     * @param Widget $objWidgetEmail Email input
     * @param Widget $objWidgetPhone Phone input
     * @param Widget $objWidgetRemarks Remarks textarea
     * @param Widget $objWidgetCaptcha captcha input
     * @param Widget $objWidgetConfirmation Confirmation checkbox
     *
     */
    protected function compileReservationCheck(
        Widget $objWidgetSalutation,
        Widget $objWidgetFirstName,
        Widget $objWidgetLastName,
        Widget $objWidgetEmail,
        Widget $objWidgetPhone,
        Widget $objWidgetRemarks,
        Widget $objWidgetCaptcha,
        Widget $objWidgetConfirmation
    )
    {
        $objWidgetSalutation->validate();
        $objWidgetFirstName->validate();
        $objWidgetLastName->validate();
        $objWidgetEmail->validate();
        $objWidgetPhone->validate();
        $objWidgetRemarks->validate();
        $objWidgetCaptcha->validate();
        $objWidgetConfirmation->validate();

        if (!$objWidgetSalutation->hasErrors() &&
            !$objWidgetFirstName->hasErrors() &&
            !$objWidgetLastName->hasErrors() &&
            !$objWidgetEmail->hasErrors() &&
            !$objWidgetPhone->hasErrors() &&
            !$objWidgetRemarks->hasErrors() &&
            !$objWidgetCaptcha->hasErrors() &&
            !$objWidgetConfirmation->hasErrors()
        ) {

            $intCurrentTstamp   = $this->objSession->get('tstampArrival');
            $arrCategoriesCount = $this->objSession->get('arrCategoriesCount');

            $strCurrentDate = date('Y-m-d', $intCurrentTstamp);

            foreach ($arrCategoriesCount as $intTableCategory => $arrCount) {

                $strColumnCount = $arrCount["strTimeOfDay"];

                Database::getInstance()->prepare("
                    UPDATE tl_table_occupancy
                    SET $strColumnCount = $strColumnCount - ?
                    WHERE pid = ?
                    AND date = ?
                    AND $strColumnCount > 0")
                    ->execute($arrCount["intCount"], $intTableCategory, $strCurrentDate);
            }

            $this->send();

            $arrSeats         = $this->objSession->get('seats');
            $arrSeatsCategory = [];

            foreach ($arrSeats as $arrSeat) {
                unset($arrSeat['categoryName']);
                $arrSeatsCategory[] = $arrSeat;
            }

            Database::getInstance()->prepare("
                INSERT INTO tl_table_list
                (tstamp, arrival, departure, seats, gender, lastname, firstname, phone, email, remarks)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")
                ->execute(
                    time(),
                    $this->objSession->get('tstampArrival'),
                    $this->objSession->get('tstampDeparture'),
                    $arrSeatsCategory,
                    Input::post('salutation'),
                    Input::post('lastname'),
                    Input::post('firstname'),
                    Input::post('phone'),
                    Input::post('email'),
                    Input::post('remarks'));

            $this->objSession->remove('tstampArrival');
            $this->objSession->remove('tstampDeparture');
            $this->objSession->remove('arrCategoriesCount');
            $this->objSession->remove('arrival');
            $this->objSession->remove('seats');

            if (!empty($this->jumpTo)) {
                $objPage    = PageModel::findByPK(intval($this->jumpTo));
                $strPageURL = Controller::generateFrontendUrl($objPage->row());
                Controller::redirect($strPageURL);
            }

            $this->strTemplate           = 'mod_table_reservation_form_success';
            $this->Template              = new FrontendTemplate($this->strTemplate);
            $this->Template->infoMessage = $GLOBALS['TL_LANG']['MSC']['table_reservation']['formReservationSuccess'];
        }
    }

}
