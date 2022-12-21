<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// variables propres Ã  l'application dans le fichier appli.php

$config['base_url']						= 'http://localhost/PACK/gipel_1311/';
$config['index_page']					= 'index.php';
$config['uri_protocol']					= 'AUTO';
$config['url_suffix']					= '';
$config['language']						= 'francais';
$config['charset']						= 'UTF-8';
$config['enable_hooks']					= FALSE;
$config['subclass_prefix']				= 'MY_';
$config['permitted_uri_chars']		= 'a-z 0-9~%.:_\-';

// Enable Query Strings
$config['allow_get_array']				= TRUE;
$config['enable_query_strings']		= FALSE;
$config['controller_trigger']			= 'c';
$config['function_trigger']			= 'm';
$config['directory_trigger']			= 'd'; // experimental not currently in use

// Error Logging Threshold
$config['log_threshold']				= 0;

// Error Logging Directory Path
$config['log_path']						= '';

// Date Format for Logs
$config['log_date_format']				= 'Y-m-d H:i:s';

// Cache Directory Path
$config['cache_path']					= '';

// Encryption Key
$config['encryption_key']				= '46VvoymIhGxBLhVwvjGleAa5Zp7xXBJY';

// Session Variables
$config['sess_cookie_name']			= 'GIPeL_session';
$config['sess_expiration']				= 14400;
$config['sess_expire_on_close']		= TRUE;
$config['sess_encrypt_cookie']		= TRUE;
$config['sess_use_database']			= TRUE;
$config['sess_table_name']				= 'session';
$config['sess_match_ip']				= FALSE;
$config['sess_match_useragent']		= TRUE;
$config['sess_time_to_update']		= 300;

// Cookie Related Variables
$config['cookie_prefix']				= "";
$config['cookie_domain']				= "";
$config['cookie_path']					= "/";
$config['cookie_secure']				= FALSE;

// Global XSS Filtering
$config['global_xss_filtering']		= FALSE;

// Cross Site Request Forgery
$config['csrf_protection']				= FALSE;
$config['csrf_token_name']				= 'csrf_test_name';
$config['csrf_cookie_name']			= 'csrf_cookie_name';
$config['csrf_expire']					= 7200;

// Output Compression
$config['compress_output']				= FALSE;

// Master Time Reference
$config['time_reference']				= 'gmt';				// local or gmt


// Rewrite PHP Short Tags
$config['rewrite_short_tags']			= FALSE;


// Reverse Proxy IPs
$config['proxy_ips']						= '';


/* End of file config.php */
/* Location: ./application/config/config.php */
