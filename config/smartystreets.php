<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| SmartyStreets Authorization ID/Token
| -------------------------------------------------------------------------
| The SmartyStreets Authorization ID/Token for your oganization provided when
| you registered. As the "Auth Token" is URL encoded on the fly make sure to 
| use the "raw" api token.
|
*/
$config['auth_id'] 		= '';
$config['auth_token'] 	= '';

/*
| -------------------------------------------------------------------------
| SmartStreets Live Addres REST API Endpointa
| -------------------------------------------------------------------------
| Only change these if you know what you are doing.
|
*/
$config['api_liveaddress']  = 'api.smartystreets.com/street-address/';
$config['api_lookups']		= 'api.smartystreets.com/zipcode/';

/*
| -------------------------------------------------------------------------
| USE HTTPS CONNECTION
| -------------------------------------------------------------------------
| Will use the secure HTTPS protical when using the production API. Recomeneded to set to TRUE.
|
*/
$config['secure'] = TRUE;

/* End of file smartystreets.php */
/* Location: ./system/application/config/smartystreets.php */
