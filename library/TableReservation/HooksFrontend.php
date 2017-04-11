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
 * Class HooksFrontend
 *
 * Specifies frontend hooks for the table reservation
 *
 * @category  Contao
 * @package   TableReservation
 * @author    Dennis Sagasser <sagasser@gispack.com>
 * @copyright 2017 Dennis Sagasser
 * @license   http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * @link      https://contao.org
 */
class HooksFrontend extends \Frontend
{
    /**
     * Replaces custom insert tags for the confirmation mail to the customer
     *
     * @param string $strTag Inserttag
     *
     * @return string
     */
    public function myReplaceInsertTags($strTag)
    {
        $objSession = Session::getInstance();
        $arrSplit   = explode('::', $strTag);

        if ($arrSplit[0] == 'reservation') {
            if (isset($arrSplit[1]) && $arrSplit[1] == 'salutation') {
                $strSalutation = (\Input::post('salutation') === 'male') ?
                    $GLOBALS['TL_LANG']['MSC']['table_reservation']['dearSir'] . ' ' . \Input::post('lastname') :
                    $GLOBALS['TL_LANG']['MSC']['table_reservation']['dearMadame'] . ' ' . \Input::post('lastname');
                return $strSalutation;
            }
            if (isset($arrSplit[1]) && $arrSplit[1] == 'firstname') {
                return \Input::post('firstname') ? \Input::post('firstname') : '-';
            }
            if (isset($arrSplit[1]) && $arrSplit[1] == 'lastname') {
                return \Input::post('lastname') ? \Input::post('lastname') : '-';
            }
            if (isset($arrSplit[1]) && $arrSplit[1] == 'email') {
                return \Input::post('email');
            }
            if (isset($arrSplit[1]) && $arrSplit[1] == 'phone') {
                return \Input::post('phone') ? \Input::post('phone') : '-';
            }
            if (isset($arrSplit[1]) && $arrSplit[1] == 'remarks') {
                return \Input::post('remarks') ? \Input::post('remarks') : '-';
            }
            if (isset($arrSplit[1]) && $arrSplit[1] == 'arrival') {
                return $objSession->get('arrival');
            }
            if (isset($arrSplit[1]) && $arrSplit[1] == 'seats') {
                $arrSeats         = $objSession->get('seats');
                $arrSeatsCategory = [];

                foreach ($arrSeats as $arrSeat) {
                    unset($arrSeat['category']);
                    $arrSeatsCategory[] = $arrSeat['count'] . " (" . $arrSeat['categoryName'] . ")";
                }

                return implode(', ', $arrSeatsCategory);
            }
        }
        return false;
    }

}
