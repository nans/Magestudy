## HideCustomerMenuItem
####Shows how hide/remove menu items in (frontend) customer account page in Magento 2 (programmatically)  
![Sample](https://github.com/nans/devdocs/blob/master/Magestudy/customer_menu_items.png "HideCustomerMenuItem screenshot")

###Remove by config
Add to block: ifconfig="Your/Config/Path"  
Show menu item when in path "Your/Config/Path" set value 1

###Remove by block code
Add to block class with new block like:  
Magestudy\HideCustomerMenuItem\Block\Frontend\CustomerLink

###For remove menu item for all customers use code like:  
< referenceBlock name="customer-account-navigation-wish-list-link" remove="true" />  
In (create customer_account.xml in your module)    
Magestudy\HideCustomerMenuItem\view\frontend\layout\customer_account.xml  

####Other links:

Account Dashboard  
< referenceBlock name="customer-account-navigation-account-link" remove="true"/>  

Account Information  
< referenceBlock name="customer-account-navigation-account-edit-link" remove="true"/>  

Address Book  
< referenceBlock name="customer-account-navigation-address-link" remove="true"/>  

My Orders  
< referenceBlock name="customer-account-navigation-orders-link" remove="true"/>  

My Downloadable Products  
< referenceBlock name="customer-account-navigation-downloadable-products-link" remove="true"/>  

Newsletter Subscriptions  
< referenceBlock name="customer-account-navigation-newsletter-subscriptions-link" remove="true"/>  

My Credit Cards  
< referenceBlock name="customer-account-navigation-my-credit-cards-link" remove="true"/>  

Billing Agreements  
< referenceBlock name="customer-account-navigation-billing-agreements-link" remove="true"/>  

My Product Reviews  
< referenceBlock name="customer-account-navigation-product-reviews-link" remove="true"/>  

My Wish List  
< referenceBlock name="customer-account-navigation-wish-list-link" remove="true"/>  

Note: remove empty space between "<" and "referenceBlock", like <referenceBlock...

License
----
MIT
