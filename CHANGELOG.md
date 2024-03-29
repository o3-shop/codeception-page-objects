# Change Log for O3-Shop Codeception Page Objects

All notable changes to this project will be documented in this file.
The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [v1.0.0] - 2023-03-05

# [O3-Shop]

> All changes from this moment on will be published as O3-Shop.
> Earlier code components were created by OXID eSales AG and published under the GNU General Public License v3.0.

> The version number is reset to 1.0.0. All references to version numbers refer to the new versioning.

* * * * * * * * * *

## [2.3.0] - 2022-07-19

### Added
- Page objects:
  - `Admin\Service\SystemHealth`
  - `Admin\Service\SystemInfo`
  - `Admin\Service\Tools`
- Check for page object availability in:
  - `Page\Lists\ProductList::openDetailsPage()`
- Properties with input selectors in:
  - `Admin\User\ExtendedInformationPage`
  - `Admin\User\MainUserPage`
  - `Admin\User\UserAddressPage`
- Methods:
  - `Admin\User\MainUserPage::editUserInformation()`
  - `Admin\User\UserAddressPage::editUserAddress()`
- Trait:
  - `Admin\Component\FrameLoader`

### Deprecated
- Page object:
  - `Admin\Component\AdminUserAddressesForm`
  - `Admin\Component\AdminUserExtendedInfoForm`
  - `Admin\Component\AdminUserForm`
  - `Admin\Component\FillForm`
  - `Admin\Tools`

## [2.2.0] - 2021-11-26

### Added
- Trait:
  - `Admin\Component\HeaderLinks`
- Page Object:
  - `Admin\CoreSetting\PerformanceTab`
- Methods:
  - `Admin\CoreSetting\SettingsTab`
    - `openAdministration()`,
    - `setAdminFormat()`,
    - `save()`
  - `Admin\Product\MainProductPage::save()`
- Property:
  - `Admin\Order\OrderList::$orderBillingLastNameInput`
        
## [2.1.0] - 2021-07-09

### Added
- Method:
  - `OxidEsales\Codeception\Page\Lists\ProductSearchList::seeSearchCount`
  - `OxidEsales\Codeception\Page\Lists\ProductSearchList::selectProductsPerPage`
  - `OxidEsales\Codeception\Page\Lists\ProductSearchList::selectListDisplayType`
  - `OxidEsales\Codeception\Page\Lists\ProductSearchList::openNextListPage`
  - `OxidEsales\Codeception\Page\Lists\ProductSearchList::openPreviousListPage`
  - `OxidEsales\Codeception\Page\Lists\ProductSearchList::openListPageNumber`

## [2.0.0] - 2021-03-25

### Added
- Support of codeception v4
- Add usage of codeception retry

## [1.4.0] - 2020-11-10

### Added
- Admin Product page objects:
    - Selection tab
    - Variants tab
    - Assign selection lists Popup window
- Class:
    - `OxidEsales\Codeception\Admin\CoreSetting\SettingsTab`
    - `OxidEsales\Codeception\Page\Account\MyDownloads`
    - `OxidEsales\Codeception\Admin\Languages`
    - `OxidEsales\Codeception\Admin\Tools`
    - `OxidEsales\Codeception\Admin\CMSPages`
    - `OxidEsales\Codeception\Admin\DataObject\AdminUser`
    - `OxidEsales\Codeception\Admin\DataObject\AdminUserAddresses`
    - `OxidEsales\Codeception\Admin\DataObject\AdminUserExtendedInfo`
    - `OxidEsales\Codeception\Admin\Component\FillForm`
-Trait
    - `OxidEsales\Codeception\Admin\Component\AdminUserForm`
    - `OxidEsales\Codeception\Admin\Component\AdminUserAddressesForm`
    - `OxidEsales\Codeception\Admin\Component\AdminUserExtendedInfoForm`
- Method:
    - `OxidEsales\Codeception\Admin\CoreSettings::openSettingsTab`
    - `OxidEsales\Codeception\Admin\Orders::find`
    - `OxidEsales\Codeception\Admin\Orders::openDownloadsTab`
    - `OxidEsales\Codeception\Admin\Products::openDownloadsTab`
    - `OxidEsales\Codeception\Page\Account\Component\AccountNavigation::openMyDownloadsPage`
    - `OxidEsales\Codeception\Admin\Component\AdminMenu::openLanguages`
    - `OxidEsales\Codeception\Admin\Component\AdminMenu::openTools`
    - `OxidEsales\Codeception\Admin\Component\AdminMenu::openCMSPages`
    - `OxidEsales\Codeception\Admin\Users::createNewUser`
    - `OxidEsales\Codeception\Admin\Users::editUser`
    - `OxidEsales\Codeception\Admin\Users::openExtendedTab`
    - `OxidEsales\Codeception\Admin\Users::openHistoryTab`
    - `OxidEsales\Codeception\Admin\Users::openProductsTab`
    - `OxidEsales\Codeception\Admin\Users::openPaymentTab`
    - `OxidEsales\Codeception\Admin\Users::createNewRemark`
    - `OxidEsales\Codeception\Admin\Users::deleteRemark`
    - `OxidEsales\Codeception\Admin\Users::openAddressesTab`
    - `OxidEsales\Codeception\Admin\Users::createNewAddress`
    - `OxidEsales\Codeception\Admin\Users::deleteSelectedAddress`  
    - `OxidEsales\Codeception\Admin\Users::editExtentedInfo`  

## [1.3.3] - 2020-07-06

### Added
- Methods:
    - `Page\Account\UserAddress::seeNumberOfShippingAddresses`
### Fixed
- Methods:
    - `Page\Account\UserAddress::deleteShippingAddress`
    - `Page\Component\Modal::confirmDeletion`

## [1.3.2] - 2020-04-21

### Added
- Properties:
    - `Page\Component\UserForm::$userNameField`
- Methods:
    - `Page\Component\UserForm::modifyUserName`
    - `Step\Basket::addProductToBasketAndOpenUserCheckout`
    - `Step\Basket::addProductToBasketAndOpenBasket`

### Deprecated
- Methods:
    - `Step\Basket::addProductToBasketAndOpen`

## [1.3.1] - 2020-04-09

### Added
- Review elements:
    - Classes:
        - `Page\Account\MyReviews`
    - Traits:
        - `Page\Component\Modal`
        - `Page\Component\Pagination`
    - Methods in `Page\Account\Component`:
        - `AccountNavigation::openMyReviewsPage`
        - `AccountNavigation::dontSeeMyReviewsLink`
        - `AccountNavigation::dontSeeMyReviewsPageTitle`
        - `AccountNavigation::seeNumberOnMyReviewsBadge`
        - `AccountNavigation::dontSeeGiftRegistryLink`

### Deprecated
- Properties in `Page\Account\Component`
    - `AccountNavigation:$newsletterSettingsLink`
    - `AccountNavigation:$addressSettingsLink`
    - `AccountNavigation:$giftRegistryLink`
    - `AccountNavigation:$wishListLink`
    - `AccountNavigation:$listmaniaLink`

## [1.3.0] - 2020-03-12

### Added
- New traits
    - CurrencyMenu

- New methods
    - ProductSearchList::selectSorting

- New properties
    - AccountMenu::userAccount
    - AccountNavigation::accountMenu

## [1.2.0] - 2020-02-19

### Added
- Admin page objects
    - Orders
    
- New methods
    - ThankYou::grabOrderNumber
    - AdminMenu::openOrders
    - AdminMenu::openProducts

## [1.1.1] - 2020-02-07

### Fixed
- Variant selection

## [1.1.0] - 2019-11-07

### Added
- Admin page objects
    - Admin login page
    - Admin panel
    - Core settings
    - Module list
    - Product categories

- New page objects
    - Gift Selection
    - MultiShop Home page

- New methods
    - Basket::openGiftSelection
    - OrderCheckout::editUserAddress
    - OrderCheckout::editPaymentMethod
    - OrderCheckout::validatePaymentMethod
    - OrderCheckout::validateShippingMethod
    - OrderCheckout::validateCoupon
    - OrderCheckout::validateVat
    - OrderCheckout::validateOrderItems
    - UserAccount::openOrderHistory

### Fixed
- Improved tests stability by waiting for page to be loaded in a lot of places.
- Fix ProductDetails page object to work with fixed add/remove compare links.
- Improve password filling to work with improved javascript error displaying.

## [1.0.0] -  2019-07-26

### Added
- First version of the module introduced

[v1.0.0]: https://github.com/o3-shop/codeception-page-objects/releases/tag/v1.0.0
[O3-Shop]: https://www.o3-shop.com/
[2.3.0]: https://github.com/OXID-eSales/codeception-page-object/compare/v2.2.0..v2.3.0
[2.2.0]: https://github.com/OXID-eSales/codeception-page-object/compare/v2.1.0..v2.2.0
[2.1.0]: https://github.com/OXID-eSales/codeception-page-object/compare/v2.0.0..v2.1.0
[2.0.0]: https://github.com/OXID-eSales/codeception-page-object/compare/v1.4.0..v2.0.0
[1.4.0]: https://github.com/OXID-eSales/codeception-page-object/compare/v1.3.3..v1.4.0
[1.3.3]: https://github.com/OXID-eSales/codeception-page-object/compare/v1.3.2..v1.3.3
[1.3.2]: https://github.com/OXID-eSales/codeception-page-object/compare/v1.3.1..v1.3.2
[1.3.1]: https://github.com/OXID-eSales/codeception-page-object/compare/v1.3.0..v1.3.1
[1.3.0]: https://github.com/OXID-eSales/codeception-page-object/compare/v1.2.0..v1.3.0
[1.2.0]: https://github.com/OXID-eSales/codeception-page-object/compare/v1.1.1..v1.2.0
[1.1.1]: https://github.com/OXID-eSales/codeception-page-object/compare/v1.1.0..v1.1.1
[1.1.0]: https://github.com/OXID-eSales/codeception-page-object/compare/v1.0.0..v1.1.0
[1.0.0]: https://github.com/OXID-eSales/codeception-page-object/compare/81ac79e25ab110042e4d4020fe0b42e68a475ad6..v1.0.0
