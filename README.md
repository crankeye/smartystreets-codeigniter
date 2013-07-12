Smarty Streets Codeigniter Library
========================

A Codeigniter library which integrates with the Smarty Streets shipping and address verification APIs

Installation
------------
1. Unpack the contents into your system folder.
2. Edit the /application/config/smartystreets.php and change the "auth_id" and "auth_token" provided from the "Key Management" page.

Examples
--------

### Address Standardization ###
	$this->load->library('SmartyStreets');

	//CREATE AN ARRAY OF ADDRESSES
	$addresses = array(
		'0' => array(
			'street' => '1234 Fake St.',
			'street1' => 'Apt #1234',
			'city' => 'Testingville',
			'state' => 'AZ',
			'zip5' => '12345'
		),
		'1' => array(
			'street' => '1234 Real St.',
			'street2' => 'Suite #1234',
			'city' => 'Realville',
			'state' => 'AZ',
			'zip5' => '54321'
		)
	);

	//RUN ADDRESS STANDARDIZATION REQUEST
	$verified_addresses = $this->smartystreets->liveaddress($addresses);

	//OUTPUT RESULTS
	print_r($verified_addresses);

### City/State Lookup ###
	$this->load->library('SmartyStreets');

	//CREATE AN ARRAY OF CITIES/STATES/ZIP CODE LOOKUPS
	$addresses = array(
		'0' => array(
			'city' 		=> 'Phoenix',
		),
		'1' => array(
			'state' 	=> 'AZ',
		),
		'2' => array(
			'zip' 		=> '12345',
		)
	);

	//RUN CITY/STATE LOOKUP
	$city_state_zip_lookups = $this->smartystreets->lookups($addresses);

	//OUTPUT RESULTS
	print_r($city_state_zip_lookups);

License
-------

Licensed under the Open Software License 3.0. View [OSL-3.0](http://opensource.org/licenses/OSL-3.0) license.

Documentation
----------------------

* View the [SmartStreets API Documentation](http://smartystreets.com/kb)
