<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'protocol' 		=> 'smtp', // 'mail', 'sendmail', or 'smtp'
    'smtp_host' 	=> 'mail.sadap99.com', 
    'smtp_port' 	=> 465,
    'smtp_user' 	=> '_mainaccount@sadap99.com',
    'smtp_pass' 	=> 'mediaterpercaya99',
    'smtp_crypto' 	=> 'ssl', //can be 'ssl' or 'tls' for example
    'mailtype' 		=> 'html', //plaintext 'text' mails or 'html'
    'smtp_timeout' 	=> 7, //in seconds
    'charset'       => 'utf-8', // iso-8859-1
    'newline' 		=> '\r\n',
    'wordwrap'      => TRUE,
    'validate'      => TRUE,

);