# AimaneCouissi_SalesOrderAgreements

[![Latest Stable Version](http://poser.pugx.org/aimanecouissi/module-sales-order-agreements/v)](https://packagist.org/packages/aimanecouissi/module-sales-order-agreements) [![Total Downloads](http://poser.pugx.org/aimanecouissi/module-sales-order-agreements/downloads)](https://packagist.org/packages/aimanecouissi/module-sales-order-agreements) [![Magento Version Require](https://img.shields.io/badge/magento-2.4.x-E68718)](https://packagist.org/packages/aimanecouissi/module-sales-order-agreements) [![License](http://poser.pugx.org/aimanecouissi/module-sales-order-agreements/license)](https://packagist.org/packages/aimanecouissi/module-sales-order-agreements) [![PHP Version Require](http://poser.pugx.org/aimanecouissi/module-sales-order-agreements/require/php)](https://packagist.org/packages/aimanecouissi/module-sales-order-agreements)

Adds a **Terms and Conditions** section to the Admin order view page, showing the agreements accepted at checkout.

## Installation
```bash
composer require aimanecouissi/module-sales-order-agreements
bin/magento module:enable AimaneCouissi_SalesOrderAgreements
bin/magento setup:upgrade
bin/magento cache:flush
```

## Usage
When an order is placed, the active checkout agreements for the store are saved on the order. Open any order in the Admin and a **Terms and Conditions** section is displayed on the order view page, showing the agreement name and content as accepted at checkout. If an agreement still exists in the system, a **View** link is available to open it in a new tab.

## Uninstall
```bash
bin/magento module:disable AimaneCouissi_SalesOrderAgreements
composer remove aimanecouissi/module-sales-order-agreements
bin/magento setup:upgrade
bin/magento cache:flush
```

## License
[MIT](LICENSE)
