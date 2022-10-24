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

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\DataObject;

/**
 * Class AdminUserForm
 */
class AdminUser
{
    /** @var bool */
    private $active = false;

    /** @var string */
    private $username;

    /** @var string */
    private $customerNumber;

    /** @var string */
    private $ustid;

    /** @var string */
    private $birthday;

    /** @var string */
    private $birthMonth;

    /** @var string */
    private $birthYear;

    /** @var string */
    private $password;

    /** @var string */
    private $userRights;

    /**
     * @return bool
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string|null
     */
    public function getCustomerNumber(): ?string
    {
        return $this->customerNumber;
    }

    /**
     * @param string $customerNumber
     */
    public function setCustomerNumber(string $customerNumber): void
    {
        $this->customerNumber = $customerNumber;
    }

    /**
     * @return string|null
     */
    public function getUstid(): ?string
    {
        return $this->ustid;
    }

    /**
     * @param string $ustid
     */
    public function setUstid(string $ustid): void
    {
        $this->ustid = $ustid;
    }

    /**
     * @return string|null
     */
    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    /**
     * @param string $birthday
     */
    public function setBirthday(string $birthday): void
    {
        $this->birthday = $birthday;
    }

    /**
     * @return string|null
     */
    public function getBirthMonth(): ?string
    {
        return $this->birthMonth;
    }

    /**
     * @param string $birthMonth
     */
    public function setBirthMonth(string $birthMonth): void
    {
        $this->birthMonth = $birthMonth;
    }

    /**
     * @return string|null
     */
    public function getBirthYear(): ?string
    {
        return $this->birthYear;
    }

    /**
     * @param string $birthYear
     */
    public function setBirthYear(string $birthYear): void
    {
        $this->birthYear = $birthYear;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getUserRights(): ?string
    {
        return $this->userRights;
    }

    /**
     * @param string $userRights
     */
    public function setUserRights(string $userRights): void
    {
        $this->userRights = $userRights;
    }

}
