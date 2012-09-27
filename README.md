com_cimpay
==========
Joomla! 1.7+ module to handle Authorize.net Customer Information Manager (CIM) API.

Notes
-----
The module needs work but the following features work:
* Register users to Authorize.net.
* Create transactions with a billing date.
* Collect dues.

TODO
----
* Delete Transactions from transaction list.
* Better validations for input data.
* Fix: If the user is already in Authorize.net the application does not store the user in database.
* ...

Log:
----
* [0.1.5] Added a recurring packages CRUD section for the backend.
* [0.1.4] Added a recurring services CRUD section for the backend.
* [0.1.3] Adding a recurring billing dashboard in the admin area.
* [0.1.2] Adding a transactions table in the site's view.
* [0.1.1] Adding 3 more tables to handle recurring billing.
* [0.1.0] Adding field validationMode and testing with a production server.
* [0.0.11] Listing the users from database in the backend.
* [0.0.10] Storing the authorize.net information in our database.
* [0.0.9] Adding a create customer profile form to the site part.
* [0.0.8] Frontend detect consumer.
* [0.0.7] Adding backend actions.
* [0.0.6] Adding a basic backend with language i18n.
* [0.0.5] Adding database structure.
* [0.0.4] Adding a model to the site part
* [0.0.3] Adding a menu type to the site part
* [0.0.2] Adding a mock view
* [0.0.1] Developing the Basic Component

Some Useful Information
-----------------------
http://www.authorize.net/support/merchant/Transaction_Response/Response_Reason_Codes_and_Response_Reason_Text.htm
http://forgetso.com/index.php?option=com_k2&view=item&id=10:creating-cron-jobs-with-jcron-and-the-joomla-library

Specific to PredatorUSA
-----------------------
9U:
* Transaction Generator:
* Billing Packages:
  :id               => Int
  :name             => String: Name of the package (9U Package)
  :description      => TEXT
  :period           => Montly (1st of each month)
  :amounts          => $ (Array of amounts, 100:100:100:100:100:100)

Story:
1. Sign in for 9U Training Package.
2. On Submit call transaction generator and create [period] transactions.
3. Prevent double sign ins for packages.
4. 

