<?php 
/**
 * ====================================================================================
 *                           5G云短网址系统
 * ----------------------------------------------------------------------------------
 * @copyright This software is exclusively sold at CodeCanyon.net. If you have downloaded this
 *  from another site or received it from someone else than me, then you are engaged
 *  in an illegal activity. You must delete this software immediately or buy a proper
 *  license from www.yunziyuan.com.cn
 *
 *  Thank you for your cooperation and don't hesitate to contact me if anything :)
 * ====================================================================================
 *
 * @author 某某 (http://www.yunziyuan.com.cn)
 * @link http://www.yunziyuan.com.cn
 * @license http://www.yunziyuan.com.cn/license
 * @package 5G云短网址系统
 * @subpackage Configuration File
 */
// Database Configuration
  $dbinfo = array(
    "host" => 'RHOST',        // Your mySQL Host (usually Localhost)
    "db" => 'RDB',            // The database where you have dumped the included sql file
    "user" => 'RUSER',        // Your mySQL username
    "password" => 'RPASS',    //  Your mySQL Password 
    "prefix" => 'RPRE'      // Prefix for your tables if you are using same db for multiple scripts, e.g. short_
  );

  $config = array(
    // Your Server's Timezone - List of available timezones (Pick the closest): https://php.net/manual/en/timezones.php
    "timezone" => date_default_timezone_get(),
    // Cache Data - If you notice anomalies, disable this. You should enable this when you get high hits
    "cache" => FALSE,
    // Use CDN to host libraries for faster loading
    "cdn" => TRUE,
    // Enable Compression? Makes your website faster
    "gzip" => TRUE,
    /*
     ====================================================================================
     *  Security Key & Token - Please don't change this if your site is live.
     * ----------------------------------------------------------------------------------
     *  - Setup a security phrase - This is used to encode some important user 
     *    information such as password. The longer the key the more secure they are.
     *
     *  - If you change this, many things such as user login and even admin login will 
     *    fail.
     *
     *  - If the two config below don't have any values or have RKEY or RPUB, replace these by a random key.
     ====================================================================================
    */
    "security" => 'RKEY',  // !!!! DON'T CHANGE THIS IF YOUR SITE IS LIVE !!!!
    "public_token" => 'RPUB', // This is randomly generated and it is a public key

    "debug" => 0,   // Enable debug mode (outputs errors) - 0 = OFF, 1 = Error message, 2 = Error + Queries (Don't enable this if your site is live!)
    "demo" => 0 // Demo mode
  );


// Include core.php
include ('core.php');
?>