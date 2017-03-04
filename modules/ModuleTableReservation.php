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

namespace Contao;

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

class ModuleTableReservation extends \Module
{
    /**
     * @var string $strTemplate Template
     */
    protected $strTemplate = 'mod_table_reservation_form';

    /**
     * @var \Session $objSession Session object
     */
    protected $objSession = null;

    /**
     * Redirect to the selected page
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
     * @return null
     */
    protected function compile()
    {
        $this->objSession           = \Session::getInstance();
        $this->Template->objSession = $this->objSession;

        $this->loadLanguageFile('tl_table_reservation');

        // Initialize form fields
        $objWidgetArrival                = new \FormCalendarField();
        $objWidgetArrival->dateImage     = true;
        $objWidgetArrival->id            = 'arrival';
        $objWidgetArrival->label         = $GLOBALS['TL_LANG']['MSC']['table_reservation']['formArrival'];
        $objWidgetArrival->name          = 'arrival';
        $objWidgetArrival->mandatory     = true;
        $objWidgetArrival->rgxp          = 'datim';
        $objWidgetArrival->dateDirection = 'geToday';
        $objWidgetArrival->draggable     = false;
        $objWidgetArrival->value         = \Input::post('arrival');

        $this->Template->objWidgetArrival = $objWidgetArrival;

        $objWidgetSubmit         = new \FormSubmit();
        $objWidgetSubmit->id     = 'submit';
        $objWidgetSubmit->slabel = $GLOBALS['TL_LANG']['MSC']['table_reservation']['formSubmit'];

        $this->Template->objWidgetSubmit = $objWidgetSubmit;

        $objModuleParams = $this->Database->prepare("
            SELECT id AS value, tablecategory AS label, maxcount
            FROM tl_table_category 
            WHERE published = '1' 
            AND (? BETWEEN start AND stop OR (start = '' AND stop = '')) 
            ORDER BY tablecategory")
            ->execute(time());

        while ($objModuleParams->next()) {
            for ($i = 0; $i <= $objModuleParams->maxcount; $i++) {
                $arrSelectOptions[$i] = array('value' => $i, 'label' => $i);
            }
            $objSelectMenu          = new \FormSelectMenu();
            $objSelectMenu->id      = $objModuleParams->value;
            $objSelectMenu->label   = $GLOBALS['TL_LANG']['MSC']['table_reservation']['count'] . ' ' . $objModuleParams->label;
            $objSelectMenu->name    = $objModuleParams->value;
            $objSelectMenu->options = $arrSelectOptions;

            $arrSelect[] = $objSelectMenu;
        }

        $this->Template->arrSelects = $arrSelect;

        $objWidgetCheckboxes            = new \FormCheckBox();
        $objWidgetCheckboxes->id        = 'tableCategory';
        $objWidgetCheckboxes->label     = $GLOBALS['TL_LANG']['MSC']['table_reservation']['formTableCategory'];
        $objWidgetCheckboxes->name      = 'tableCategory';
        $objWidgetCheckboxes->mandatory = true;
        $objWidgetCheckboxes->options   = $objModuleParams->fetchAllAssoc();
        $objWidgetCheckboxes->value     = \Input::post('tableCategory');

        $this->Template->objWidgetCheckboxes = $objWidgetCheckboxes;

        if (\Input::post('FORM_SUBMIT') === 'form_availability_submit') {
            $this->compileAvailabilityCheck($objWidgetArrival, $objWidgetCheckboxes);
        }

        if (\Input::get('FORM_PAGE') === 'page2') {

            $this->strTemplate          = 'mod_table_reservation_form_page2';
            $this->Template             = new \FrontendTemplate($this->strTemplate);
            $this->Template->objSession = $this->objSession;

            $objWidgetSalutation            = new \FormRadioButton();
            $objWidgetSalutation->id        = 'salutation';
            $objWidgetSalutation->label     = $GLOBALS['TL_LANG']['MSC']['table_reservation']['formSalutation'];
            $objWidgetSalutation->name      = 'salutation';
            $objWidgetSalutation->mandatory = true;
            $objWidgetSalutation->options   = array(array('value' => 'male', 'label' => $GLOBALS['TL_LANG']['MSC']['table_reservation']['formMale']), array('value' => 'female', 'label' => $GLOBALS['TL_LANG']['MSC']['table_reservation']['formFemale']));

            $this->Template->objWidgetSalutation = $objWidgetSalutation;

            $objWidgetFirstName            = new \FormTextField();
            $objWidgetFirstName->id        = 'firstname';
            $objWidgetFirstName->label     = $GLOBALS['TL_LANG']['MSC']['table_reservation']['formFirstname'];
            $objWidgetFirstName->name      = 'firstname';
            $objWidgetFirstName->mandatory = true;
            $objWidgetFirstName->rgxp      = 'alpha';
            $objWidgetFirstName->value     = \Input::post('firstname');

            $this->Template->objWidgetFirstName = $objWidgetFirstName;

            $objWidgetLastName            = new \FormTextField();
            $objWidgetLastName->id        = 'lastname';
            $objWidgetLastName->label     = $GLOBALS['TL_LANG']['MSC']['table_reservation']['formLastname'];
            $objWidgetLastName->name      = 'lastname';
            $objWidgetLastName->mandatory = true;
            $objWidgetLastName->rgxp      = 'alpha';
            $objWidgetLastName->value     = \Input::post('lastname');

            $this->Template->objWidgetLastName = $objWidgetLastName;


            $objWidgetEmail            = new \FormTextField();
            $objWidgetEmail->id        = 'email';
            $objWidgetEmail->label     = $GLOBALS['TL_LANG']['MSC']['table_reservation']['formEmail'];
            $objWidgetEmail->name      = 'email';
            $objWidgetEmail->mandatory = true;
            $objWidgetEmail->rgxp      = 'email';
            $objWidgetEmail->value     = \Input::post('email');

            $this->Template->objWidgetEmail = $objWidgetEmail;

            $objWidgetPhone            = new \FormTextField();
            $objWidgetPhone->id        = 'phone';
            $objWidgetPhone->label     = $GLOBALS['TL_LANG']['MSC']['table_reservation']['formPhone'];
            $objWidgetPhone->name      = 'phone';
            $objWidgetPhone->mandatory = false;
            $objWidgetPhone->rgxp      = 'phone';
            $objWidgetPhone->value     = \Input::post('phone');

            $this->Template->objWidgetPhone = $objWidgetPhone;

            $objWidgetRemarks            = new \FormTextArea();
            $objWidgetRemarks->id        = 'remarks';
            $objWidgetRemarks->label     = $GLOBALS['TL_LANG']['MSC']['table_reservation']['formRemarks'];
            $objWidgetRemarks->name      = 'remarks';
            $objWidgetRemarks->mandatory = false;
            $objWidgetRemarks->value     = \Input::post('remarks');

            $this->Template->objWidgetRemarks = $objWidgetRemarks;

            $objWidgetConfirmation            = new \FormCheckBox();
            $objWidgetConfirmation->id        = 'confirmation';
            $objWidgetConfirmation->label     = $GLOBALS['TL_LANG']['MSC']['table_reservation']['formConfirmation'];
            $objWidgetConfirmation->name      = 'confirmation';
            $objWidgetConfirmation->mandatory = true;
            $objWidgetConfirmation->options   = array(array('value' => '1', 'label' => $GLOBALS['TL_LANG']['MSC']['table_reservation']['formConfirmationText']));
            $objWidgetConfirmation->value     = \Input::post('confirmation');

            $this->Template->objWidgetConfirmation = $objWidgetConfirmation;

            $objWidgetSubmit        = new \FormSubmit();
            $objWidgetSubmit->id    = 'submit';
            $objWidgetSubmit->label = $GLOBALS['TL_LANG']['MSC']['table_reservation']['formReservationSubmit'];

            $this->Template->objWidgetSubmit = $objWidgetSubmit;
        }

        if (\Input::post('FORM_SUBMIT') === 'form_reservation_submit') {
            $this->compileReservationCheck(
                $objWidgetSalutation,
                $objWidgetFirstName,
                $objWidgetLastName,
                $objWidgetEmail,
                $objWidgetPhone,
                $objWidgetRemarks,
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
        $objSettings = $this->Database->prepare("SELECT * FROM tl_reservation_settings")->limit(1)->execute();

        if ($objSettings->useSMTP) {
            $GLOBALS['TL_CONFIG']['useSMTP']  = true;
            $GLOBALS['TL_CONFIG']['smtpHost'] = $objSettings->smtpHost;
            $GLOBALS['TL_CONFIG']['smtpUser'] = $objSettings->smtpUser;
            $GLOBALS['TL_CONFIG']['smtpPass'] = $objSettings->smtpPass;
            $GLOBALS['TL_CONFIG']['smtpEnc']  = $objSettings->smtpEnc;
            $GLOBALS['TL_CONFIG']['smtpPort'] = $objSettings->smtpPort;
        }

        // Add default sender address
        if ($objSettings->sender == '') {
            list($objSettings->senderName, $objSettings->sender) = class_exists("StringUtil") ?
                \StringUtil::splitFriendlyEmail($GLOBALS['TL_CONFIG']['adminEmail']) :
                \String::splitFriendlyEmail($GLOBALS['TL_CONFIG']['adminEmail']);
        }

        // Add default Bcc
        if ($objSettings->bCc == '') {
            list($objSettings->senderName, $objSettings->bCc) = class_exists("StringUtil") ?
                \StringUtil::splitFriendlyEmail($GLOBALS['TL_CONFIG']['adminEmail']) :
                \String::splitFriendlyEmail($GLOBALS['TL_CONFIG']['adminEmail']);
        }

        $arrAttachments            = array();
        $blnAttachmentsFormatError = false;

        // Add attachments
        if ($objSettings->addFile) {
            $files = deserialize($objSettings->files);

            if (!empty($files) && is_array($files)) {
                $objFiles = \FilesModel::findMultipleByUuids($files);

                if ($objFiles === null) {
                    if (!\Validator::isUuid($files[0])) {
                        $blnAttachmentsFormatError = true;
                        \Message::addError($GLOBALS['TL_LANG']['ERR']['version2format']);
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
        $strHtml = $this->replaceInsertTags($objSettings->content, false);
        $strText = $this->replaceInsertTags($objSettings->text, false);

        // Convert relative URLs
        if ($objSettings->externalImages) {
            $strHtml = $this->convertRelativeUrls($strHtml);
        }

        // Send newsletter
        if (!$blnAttachmentsFormatError) {
            // Send newsletter
            $objEmail = $this->generateEmailObject($objSettings, $arrAttachments);
            $this->sendConfirmation($objEmail, $objSettings, \Input::post('email'), $strText, $strHtml);
        }
    }

    /**
     * Generate the e-mail object and return it
     *
     * @param \Database\Result $objSettings Database result
     * @param array $arrAttachments E-mail attachments
     *
     * @return \Email
     */
    protected function generateEmailObject(\Database\Result $objSettings, $arrAttachments)
    {
        $objEmail = new \Email();

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
     * @param \Email $objEmail E-mail object
     * @param \Database\Result $objSettings Database result
     * @param string $strRecipient Recipient
     * @param string $strText Plain text
     * @param string $strHtml HTML text
     * @param string $css CSS
     *
     * @return string CSS
     */
    protected function sendConfirmation(\Email $objEmail, \Database\Result $objSettings, $strRecipient, $strText, $strHtml, $css = null)
    {
        // Prepare the text content
        $objEmail->text = class_exists("StringUtil") ?
            \StringUtil::parseSimpleTokens($strText, $strRecipient) :
            \String::parseSimpleTokens($strText, $strRecipient);

        // Add the HTML content
        if (!$objSettings->sendText) {
            // Default template
            if ($objSettings->template == '') {
                $objSettings->template = 'mail_default';
            }

            // Load the mail template
            $objTemplate = new \BackendTemplate($objSettings->template);
            $objTemplate->setData($objSettings->row());

            $objTemplate->title     = $objSettings->subject;
            $objTemplate->body      = class_exists("StringUtil") ?
                \StringUtil::parseSimpleTokens($strHtml, $strRecipient) :
                \String::parseSimpleTokens($strHtml, $strRecipient);
            $objTemplate->charset   = $GLOBALS['TL_CONFIG']['characterSet'];
            $objTemplate->css       = $css; // Backwards compatibility
            $objTemplate->recipient = $strRecipient;

            // Parse template
            $objEmail->html     = $objTemplate->parse();
            $objEmail->imageDir = TL_ROOT . '/';
        }

        // Deactivate invalid addresses
        try {
            $objEmail->sendTo($strRecipient);
        } catch (\Swift_RfcComplianceException $e) {
            $_SESSION['REJECTED_RECIPIENTS'][] = $strRecipient;
        }

        // Rejected recipients
        if ($objEmail->hasFailures()) {
            $_SESSION['REJECTED_RECIPIENTS'][] = $strRecipient;
        }
    }

    /**
     * Check submitted availability form and display result
     *
     * @param \Widget $objWidgetArrival Reservation time input
     * @param \Widget $objWidgetCheckboxes Table categories checkboxes
     *
     * @return null
     */
    protected function compileAvailabilityCheck(\Widget $objWidgetArrival, \Widget $objWidgetCheckboxes)
    {
        $objWidgetArrival->validate();
        $objWidgetCheckboxes->validate();

        $objArrivalDate = new \Date(strtotime(\Input::post('arrival')));

        $intDayBegin        = $objArrivalDate->dayBegin;
        $intArrivalDateTime = $objArrivalDate->tstamp;
        $strArrivalDate     = date("Y-m-d", $objArrivalDate->tstamp);

        // reservation at least 30 minutes before
        $intValidReservationTime = strtotime('+0 hours 30 minutes', time());
        $strValidReservationTime = date($GLOBALS['TL_CONFIG']['timeFormat'], $intValidReservationTime);

        ($intValidReservationTime <= $intArrivalDateTime) ?:
            $objWidgetArrival->addError(sprintf($GLOBALS['TL_LANG']['MSC']['table_reservation']['reservationTooLate'],
                $strValidReservationTime));

        // morning from 0 - 12h
        $intMorning = strtotime('+12 hours', $intDayBegin);
        // noon from 12 - 15h
        $intNoon = strtotime('+3 hours', $intMorning);
        // evening from 15 - 24h
        $intEvening = strtotime('+9 hours', $intNoon);

        switch (true) {
            case (($intArrivalDateTime > $intDayBegin) && ($intArrivalDateTime < $intMorning)):
                $strCount = 'countMorning';
                break;
            case (($intArrivalDateTime >= $intMorning) && ($intArrivalDateTime < $intNoon)):
                $strCount = 'countNoon';
                break;
            case (($intArrivalDateTime >= $intNoon) && ($intArrivalDateTime < $intEvening)):
                $strCount = 'countEvening';
                break;
            default:
                $strCount = null;
        }

        $arrPostTableCategory = is_array(\Input::post('tableCategory')) ?
            \Input::post('tableCategory') : array(\Input::post('tableCategory'));

        foreach ($arrPostTableCategory as $intTableCategory) {
            (intval(\Input::post($intTableCategory)) < 1) ?
                $objWidgetCheckboxes->addError($GLOBALS['TL_LANG']['MSC']['table_reservation']['countError']) :
                $arrResultRow = $this->Database->prepare("
                    SELECT
                      tmp1.countMorning,
                      tmp1.countNoon,
                      tmp1.countEvening,
                      tmp2.tablecategory
                    FROM
                      (SELECT
                      o.pid,
                      o.date,
                      o.countMorning,
                      o.countNoon,
                      o.countEvening,
                      t.id
                      FROM tl_table_occupancy o, tl_table_category t
                      WHERE date = ?
                          AND pid = ?
                          AND o.pid = t.id) tmp1
                      RIGHT JOIN
                        (SELECT DISTINCT tablecategory
                        FROM tl_table_category t, tl_table_occupancy o
                        WHERE t.id = o.pid
                             AND t.id = ?) tmp2 ON tmp1.pid = tmp1.id")
                    ->execute($strArrivalDate, $intTableCategory, $intTableCategory)->fetchAssoc();

            empty($arrResultRow[$strCount]) ?
                $objWidgetCheckboxes->addError(
                    sprintf($GLOBALS['TL_LANG']['MSC']['table_reservation']['noSeatsForTableCategory'], $arrResultRow['tablecategory'])) :
                (intval(\Input::post($intTableCategory)) > intval($arrResultRow[$strCount])) ?
                    $objWidgetCheckboxes->addError(
                        sprintf($GLOBALS['TL_LANG']['MSC']['table_reservation']['maxCountError'], $arrResultRow['tablecategory'],
                            $arrResultRow[$strCount])) :
                    $arrSeats[] = sprintf(("%d %s %s"), intval(\Input::post($intTableCategory)), $GLOBALS['TL_LANG']['MSC']['table_reservation']['count'], $arrResultRow['tablecategory']);

            $arrTableCategories[] = $intTableCategory;
            $arrCountSeats[]      = [
                "intCount"     => intval(\Input::post($intTableCategory)),
                "strTimeOfDay" => $strCount
            ];

        }

        if (!$objWidgetCheckboxes->hasErrors() && !$objWidgetArrival->hasErrors()) {

            $arrCategoriesCount = array_combine($arrTableCategories, $arrCountSeats);

            $this->Template->infoMessage = $GLOBALS['TL_LANG']['MSC']['table_reservation']['reservationPossible'];
            $this->Template->arrSeats    = $arrSeats;

            $strReserveNowUrl                 = $this->addToUrl('FORM_PAGE=page2');
            $this->Template->strReserveNowUrl = $strReserveNowUrl;

            $this->objSession->set('arrival', \Input::post('arrival'));
            $this->objSession->set('seats', $arrSeats);
            $this->objSession->set('tstampArrival', $intArrivalDateTime);
            $this->objSession->set('arrCategoriesCount', $arrCategoriesCount);
        } else {
            $this->Template->errorMessage = $GLOBALS['TL_LANG']['MSC']['table_reservation']['reservationNotPossible'];
        }
    }

    /**
     * Check submitted reservation form and display result
     *
     * @param \Widget $objWidgetSalutation Salutation radio button
     * @param \Widget $objWidgetFirstName Firstname input
     * @param \Widget $objWidgetLastName Lastname input
     * @param \Widget $objWidgetEmail Email input
     * @param \Widget $objWidgetPhone Phone input
     * @param \Widget $objWidgetRemarks Remarks textarea
     * @param \Widget $objWidgetConfirmation Confirmation checkbox
     *
     * @return null
     */
    protected function compileReservationCheck(
        \Widget $objWidgetSalutation,
        \Widget $objWidgetFirstName,
        \Widget $objWidgetLastName,
        \Widget $objWidgetEmail,
        \Widget $objWidgetPhone,
        \Widget $objWidgetRemarks,
        \Widget $objWidgetConfirmation
    )
    {
        $objWidgetSalutation->validate();
        $objWidgetFirstName->validate();
        $objWidgetLastName->validate();
        $objWidgetEmail->validate();
        $objWidgetPhone->validate();
        $objWidgetRemarks->validate();
        $objWidgetConfirmation->validate();

        if (!$objWidgetSalutation->hasErrors() &&
            !$objWidgetFirstName->hasErrors() &&
            !$objWidgetLastName->hasErrors() &&
            !$objWidgetEmail->hasErrors() &&
            !$objWidgetPhone->hasErrors() &&
            !$objWidgetRemarks->hasErrors() &&
            !$objWidgetConfirmation->hasErrors()
        ) {

            $intCurrentTstamp   = $this->objSession->get('tstampArrival');
            $arrCategoriesCount = $this->objSession->get('arrCategoriesCount');

            $strCurrentDate = date('Y-m-d', $intCurrentTstamp);

            foreach ($arrCategoriesCount as $intTableCategory => $arrCount) {

// todo: escape dynamic column name
//                $arrSet[$arrCount["strTimeOfDay"]] = sprintf("%s-%d", $arrCount["strTimeOfDay"], $arrCount['intCount']);
                $strColumnCount = $arrCount["strTimeOfDay"];

                $objSetTableCount = $this->Database->prepare("
                            UPDATE tl_table_occupancy
                            SET $strColumnCount = $strColumnCount - ?
                            WHERE pid = ?
                            AND date = ?
                            AND $strColumnCount > 0")
//                    ->set($arrSet)
                    ->execute($arrCount["intCount"], $intTableCategory, $strCurrentDate);
            }

            $this->strTemplate           = 'mod_table_reservation_form_success';
            $this->Template              = new \FrontendTemplate($this->strTemplate);
            $this->Template->infoMessage = $GLOBALS['TL_LANG']['MSC']['table_reservation']['formReservationSuccess'];
            $this->send();

            $objInsertReservation = $this->Database->prepare("
                    INSERT INTO tl_table_reservation_list
                    (arrival, tstamp, seats, lastname, firstname, phone, email, remarks)
                    VALUES(?, ?, ?, ?, ?, ?, ?, ?)")
                ->execute($this->objSession->get('tstampArrival'),
                    time(),
                    $this->objSession->get('seats'),
                    \Input::post('lastname'),
                    \Input::post('firstname'),
                    \Input::post('phone'),
                    \Input::post('email'),
                    \Input::post('remarks'));

            $this->objSession->remove('tstampArrival');
            $this->objSession->remove('arrCategoriesCount');
            $this->objSession->remove('arrival');
            $this->objSession->remove('seats');
        }
    }

}
