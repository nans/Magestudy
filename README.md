# Magestudy - Magento 2 Example extensions  

Branch for [Magento 2.1 - 2.3](https://github.com/nans/Magestudy/tree/2.1-2.3)  
Master branch for Magento 2.3  

## Installation Instruction  
* Copy the content of the repo to the Magento 2: app/code/Magestudy  
* Run command: php bin/magento setup:upgrade   
* Run Command: php bin/magento cache:flush  

## SimpleCrud  
Shows how create simple CRUD: grid and form (ui component) without deprecated methods  
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/SimpleCrudGrid.png "SimpleCrudGrid screenshot")  
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/SimpleCrudForm.png "SimpleCrudForm screenshot")  

## ConfigExample
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/ConfigExample.png "ConfigExample screenshot")  
Shows how create and update Configuration in Magento 2 (programmatically)  
Admin panel: Menu - Stores - Settings - Configuration - Magestudy example

## ConsoleCommand
Shows how create console command in Magento 2    
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/Magestudy_Command.png "ConsoleCommand screenshot")  
Command 1: magestudy:first_test_command  
Command 2: magestudy:fullname FirstName LastName  

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
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/Menu.png "Menu screenshot")  
Shows how create menu in Magento 2 admin panel  
Admin panel: Menu - MAIN LABEL

## Page
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/Page.png "Frontend page screenshot")  
Shows how create simple page (frontend) in Magento 2  
Link: http:://YOUR_SITE.domain/index.php/page/test/

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
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/Customjs.png "Customjs page screenshot")  
Shows how use RequireJS and Knockout.js (bindings) in Magento 2  
Result in console: yourDomain/index.php/customjs/test  
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
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/CustomerAttribute_GRID.png "CustomerAttribute screenshot")  
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/CustomerAttribute_FIELD.png "CustomerAttribute screenshot")  
Shows how add new customer (custom) attribute to grid and create/edit form.

## SystemCustomField  
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/SystemCustomField.png "SystemCustomField screenshot")  
Shows how add custom fields in Stores->Settings->Configuration  
Backend: Stores -> Settings -> Configuration -> Magestudy example -> Field with custom model

## CustomerAccountTab  
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/CustomerAccountTab.png "CustomerAccountTab screenshot")  
Shows how add new tab (page, menu item) in customer account (frontend).     

## CustomerEditButton  
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/CustomerEditButton.png "CustomerEditButton screenshot")  
Shows how add new button in customer edit page (admin panel).    
 
## CustomerEditTab  
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/CustomerEditTab.png "CustomerEditTab screenshot")  
Shows how add new tab\page\menu item in customer edit section (admin panel). 

## PaymentMethod   
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/PaymentMethod_Checkout.png "PaymentMethod screenshot")  
Shows how create new payment method in Magento 2.  
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/PaymentMethod_Front.png "PaymentMethod screenshot")  
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/PaymentMethod_Backend.png "PaymentMethod screenshot")  

## ShippingMethod  
Shows how create simple shipping method in Magento 2.  
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/Shipping_front.png "ShippingMethod screenshot")  
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/Shipping_Config.png "ShippingMethod screenshot")  

## HideCustomerMenuItem
Shows how hide/remove menu items in (frontend) customer account page in Magento 2 (programmatically)  
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/customer_menu_items.png "HideCustomerMenuItem screenshot")

## ProductEditButton
Shows how add button to product create/edit page in Magento 2  
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/product-edit-button.png "ProductEditButton screenshot")

## LoggerExample  
Shows how create custom logger and write data to new file in Magento 2  
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/custom_logger.png "LoggerExample screenshot")  
Sample of injection and using here: Magestudy\LoggerExample\Helper\Data  

## SearchCriteria  
Shows how to configure and create a SearchCriteria instance using the builder for repositories  
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/SearchCriteria.png "SearchCriteria screenshot")  
Sample here: Magestudy\SearchCriteria\Controller\Hello\Index.php  
Frontend url: .../index.php/SearchCriteria/hello/index

## ExtensionAttributes  
Shows how to use Extension Attributes  
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/ExtensionAttribute.png "ExtensionAttributes screenshot")  
Frontend url: .../index.php/ExtensionAttribute/hello/index

## ProductExtensionAttribute
Shows how to use Extension Attributes for products  
Frontend url: .../index.php/ProductExtensionAttribute/hello/index

## Widget  
Shows how create simple widget  
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/Widget.png "Widget screenshot")  
* Go to CONTENT -> Widgets -> Add Widget
* Select "Magestudy Sample Widget" as type and choose your theme
* Click on continue and fill all fields (in "Widget Options" set some data to label and limit)
* Go to CONTENT -> Pages -> Home Page: add widget to page
* Go to main page for result

## Mixins  
Shows how to use mixins in Magento 2:  
* Add new method
* Override method  
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/Mixins.png "Mixins screenshot")  
Frontend url: .../index.php/mixin/index  

License
----
MIT
