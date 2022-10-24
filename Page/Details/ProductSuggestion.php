<?php
/**
 * This file is part of O3-Shop.
 *
 * O3-Shop is free software: you can redistribute it and/or modify  
 * it under the terms of the GNU General Public License as published by  
 * the Free Software Foundation, version 3.
 *
 * O3-Shop is distributed in the hope that it will be useful, but 
 * WITHOUT ANY WARRANTY; without even the implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU 
 * General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with O3-Shop.  If not, see <http://www.gnu.org/licenses/>
 *
 * @copyright  Copyright (c) 2022 OXID eSales AG (https://www.oxid-esales.com)
 * @copyright  Copyright (c) 2022 O3-Shop (https://www.o3-shop.com)
 * @license    https://www.gnu.org/licenses/gpl-3.0  GNU General Public License 3 (GPLv3)
 */

namespace OxidEsales\Codeception\Page\Details;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

/**
 * Class for recommend page.
 * @package OxidEsales\Codeception\Page\Details
 */
class ProductSuggestion extends Page
{
    // include url of current page
    public $URL = '/en/recommend/';

    // include bread crumb of current page
    public $breadCrumb = '#breadcrumb';

    public $headerTitle = 'h1';

    public $recipientName = 'editval[rec_name]';

    public $recipientEmail = 'editval[rec_email]';

    public $senderName = 'editval[send_name]';

    public $senderEmail = 'editval[send_email]';

    public $emailSubject = 'editval[send_subject]';

    public $emailMessage = 'editval[send_message]';

    /**
     * @param mixed $param
     *
     * @return string
     */
    public function route($param)
    {
        return $this->URL.'/index.php?'.http_build_query(['anid' => $param]);
    }

    /**
     * Send suggestion email.
     * $suggestionEmailData = [
     * 'recipient_name',
     * 'recipient_email',
     * 'sender_name',
     * 'sender_email',
     * 'message',
     * 'subject'
     * ]
     *
     *
     * @param array $suggestionEmailData
     *
     * @return $this
     */
    public function sendSuggestionEmail($suggestionEmailData)
    {
        $I = $this->user;
        $I->fillField($this->recipientName, $suggestionEmailData['recipient_name']);
        $I->fillField($this->recipientEmail, $suggestionEmailData['recipient_email']);
        $I->fillField($this->senderName, $suggestionEmailData['sender_name']);
        $I->fillField($this->senderEmail, $suggestionEmailData['sender_email']);
        if (isset($suggestionEmailData['message'])) {
            $I->fillField($this->emailMessage, $suggestionEmailData['message']);
        }
        if (isset($suggestionEmailData['subject'])) {
            $I->fillField($this->emailSubject, $suggestionEmailData['subject']);
        }
        $I->click(Translator::translate('SEND'));
        return $this;
    }
}
