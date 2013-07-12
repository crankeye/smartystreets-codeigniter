<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Smarty Streets CodeIgniter Library
 *
 * A CodeIgniter library which integrates with the Smarty Streets address verification APIs
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Open Software License version 3.0
 *
 * This source file is subject to the Open Software License (OSL 3.0) that is
 * bundled with this package in the files license.txt.  It is
 * also available through the world wide web at this URL:
 * http://opensource.org/licenses/OSL-3.0
 *
 * @package  Smarty Streets CodeIgniter Library
 * @author   Neal Lambert
 * @license  http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * @link   https://github.com/crankeye/smartystreets-codeigniter
 * @docs   http://smartystreets.com/kb
 */

class SmartyStreets {

  var $auth_id         = '';
  var $auth_token      = '';
  var $secure          = TRUE;
  var $api_liveaddress = 'api.smartystreets.com/street-address/';
  var $api_lookups     = 'api.smartystreets.com/zipcode/';
  
  /**
   * Constructor - Sets SmartyStreets Preferences
   *
   * The constructor can be passed an array of config values
   */
  function SmartyStreets($config = array())
  {
    $this->initialize($config);

    log_message('debug', 'SmartyStreets Class Initialized');
  }
  
  /**
   * Initialize preferences
   *
   * @access  public
   * @param   array
   * @return  void
   */
  function initialize($config = array())
  {
    if(count($config) > 0)
    {
      foreach($config as $key => $val)
      {
        if(isset($this->$key))
        {
          $this->$key = $val;
        }
      }
    }
  }

  /**
   * LiveAddress Address Standardization / Verification Request
   * Verify or standardize and address.
   * 
   * @docs   http://smartystreets.com/kb/liveaddress-api/rest-endpoint
   * @param  $addresss array  An array of addresses. Each address can contain any of the items from the documentation.
   *                           Generally most addresses will be formatted as such:
   *                             array (
   *                                'street'     => '1234 Fake St.', //*REQUIRED
   *                                'street2'    => 'Suite #123',
   *                                'city'       => 'Coolsville',
   *                                'state'      => 'FL',
   *                                'zipcode'    => '12345',
   *                             ),
   *                             array (
   *                                'street'     => '4321 Real St.', //*REQUIRED
   *                                'street2'    => 'Apt #1',
   *                                'city'       => 'Hottsville',
   *                                'state'      => 'TX',
   *                                'zipcode'    => '54321',
   *                             );
   * @param  $api     string Optional REST API URL override
   * @access public
   * @return simple xml object
   */
   
  function liveaddress($addresses = array(), $api = '')
  {
    $results = array();

    //VERIFY INPUT IS AN ARRAY
    if(!is_array($addresses))
        return array('error' => 'The addresses parameter much be an array which contains a single or multiple address arrays.');

    //VERIFY EACH ADDRESS IS AN ARRAY
    foreach($addresses as $address)
    {
      if(!is_array($address))
        return array('error' => 'The addresses parameter much be an array which contains a single or multiple address arrays.');
    }

    //PROCESS EACH ADDRESS
    foreach($addresses as $key => $address)
    {
      //URL ENCODE EACH PARAMETER
      foreach($address as &$parameter)
        urlencode($parameter);

      unset($parameter);

      //MAKE REQUEST
      $results[$key] = $this->_request((!empty($api) ? $api : $this->api_liveaddress), $address);
    }

    //RETURN RESULTS
    return (!empty($results) ? $results : FALSE);
  }

  /**
   * City / State / Zip Code Lookup Request
   * Allows you to identify cities iwth ZIP codes and vice versa.
   * 
   * @docs   http://smartystreets.com/kb/liveaddress-api/zipcode-api
   * @param  $addresss array An array of lookups which contains a city, state, or zipcode. e.g.
   *                             array (
   *                                'city'       => 'Coolsville'
   *                              ),
   *                              array (
   *                                'state'      => 'FL'
   *                              ),
   *                              array (
   *                                'zipcode'     => '12345'
   *                              );
   * @param  $api string Optional REST API URL override
   * @access public
   * @return simple xml object
   */

  function lookup($addresses = array(), $api = '')
  {
    return $this->liveaddress($addresses, $this->api_lookups);
  }
  
   /**
   * Request
   * Make a request to the SmartyStreets API
   * 
   * @access private
   * @return array()
   */
  function _request($api = '',$parameters = array())
  {
    //ADD AUTHORIZATION PARAMETERS
    $parameters['auth-id']    = $this->auth_id;
    $parameters['auth-token'] = $this->auth_token;

    //BUILD URL
    $url = ($this->secure ? 'https://' : 'http://').$api.'?'.http_build_query($parameters);
   
   //GET REQUEST
    return json_decode(file_get_contents($url),true);
  }
}

/* End of file SmartyStreets.php */
/* Location: ./system/application/libraries/SmartyStreets.php */