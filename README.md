# Magestudy - Magento 2 Example extensions

## Installation Instruction  
* Copy the content of the repo to the Magento 2: app/code/Magestudy  
* Run command: php bin/magento setup:upgrade   
* Run Command: php bin/magento cache:flush  

## ConfigExample
![Sample](https://github.com/nans/Magestudy/blob/master/doc/ConfigExample.png "ConfigExample screenshot")
Shows how create and update Configuration in Magento 2 (programmatically)  
Admin panel: Menu - Stores - Settings - Configuration - Magestudy example

## ConsoleCommand
Shows how create console command in Magento 2  
Command: magestudy:first_test_command

## Controller
Shows how create controller in Magento 2  
Links:  
yourDomain/index.php/controller/hello  
yourDomain/index.php/controller/hello/world  
yourDomain/index.php/controller/test  
yourDomain/index.php/controller/test/check

## CronExample
Shows how create Cron tasks and Cron groups in Magento 2  
Result in /var/log/.debug.log: "Cron task was started at ..."

## Event
Shows how use events in Magento 2  
Links:  
yourDomain/index.php/event/example/index  
yourDomain/index.php/event/example/second

## LogRepository
Shows how use repository pattern in Magento 2

## Menu
Shows how create menu in Magento 2 admin panel  
Admin panel: Menu - MAIN LABEL

## Page
Shows how create simple page in Magento 2  
Link: yourDomain/index.php/page/test/

## Rest
Shows how create REST API in Magento 2  
Links for test in \Magestudy\Rest\Model\Shop.php

## UnitTestExample
Shows how create Unit test in Magento 2  
In \dev\tests\unit\phpunit.xml (remove .dist if file name is phpunit.xml.dist)  
Add line: <directory suffix="Test.php">../../../app/code/Magestudy/UnitTestExample/Test/Unit</directory>  
To block: testsuite  
Run command in console.

## Customjs
Shows how use RequireJS and Knockout.js (bindings) in Magento 2  
Console: yourDomain/index.php/customjs/test  
Frontend: yourDomain/index.php/customjs/test/simple

## Crud
Admin panel: Menu - CRUD  
Frontend, url: yourDomain/index.php/crud  
#### Shows how create CRUD in Magento 2:
- Validation;
- Image loading;
- Table relations;
- UI Component;
- Event;
- Custom form validation;
- Highlight rows in grid;
- Create DB schema;
- Admin menu;
- Repository pattern.

## PluginExample
Shows how use plugins in Magento 2  
Commands for test:  
magestudy:get_product  
magestudy:save_product  
magestudy:set_product_price  
magestudy:set_product_title  

Also check create new customer fom frontend and sign in.

## CustomerAttribute - Customer  
![Sample](https://github.com/nans/Magestudy/blob/master/doc/CustomerAttribute_GRID.png "CustomerAttribute screenshot")
![Sample](https://github.com/nans/Magestudy/blob/master/doc/CustomerAttribute_FIELD.png "CustomerAttribute screenshot")
Shows how add new customer (custom) attribute to grid and create/edit form.

## SystemCustomField  
![Sample](https://github.com/nans/Magestudy/blob/master/doc/SystemCustomField.png "SystemCustomField screenshot")
Shows how add custom fields in Stores->Settings->Configuration  
Backend: Stores -> Settings -> Configuration -> Magestudy example -> Field with custom model

## CustomerAccountTab  
![Sample](https://github.com/nans/Magestudy/blob/master/doc/CustomerAccountTab.png "CustomerAccountTab screenshot")  
Shows how add new tab (page, menu item) in customer account (frontend).    
"Example tab" in left menu.  

License
----
MIT
