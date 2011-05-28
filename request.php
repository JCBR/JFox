<?php
/**
 * @version $Id$
 * @package    joomlafox
 * @subpackage plugin
 * @author     Webdesign Engenharia {@link http://www.webdesign.eng.br}
 * @author     Emerson da Rocha Luiz {@link http://www.fititnt.org}
 * @author     Created on 20-Oct-2009
 */

defined('_JEXEC') or die('Access Denied');

//print_r(JRequest::get('POST'));
// the core that execute the code and put in one variable
$empty = 'Array()';

$requestfox = NULL;
$requestfox .='<div id="jfox_request" style="display:none;">';
//GET
if ($this->params->get('use_get', 1 )){
    ob_start();
        $jrequest = JRequest::get( 'GET' );

        if ($this->params->get('use_vardump', 0 )){
            var_dump($jrequest);
        } else {
           print_r($jrequest);
        }    

        $get = ob_get_contents();

    ob_end_clean();		
    if(strpos($get, $empty)) {
        $get = JTEXT::_('GET vars are empty');
    } else {
        $get = $get;
    }
$requestfox .='<fieldset><legend>GET</legend><pre>' .
$get .
'</pre></fieldset>';
}
//POST
if ($this->params->get('use_post', 1 )){
    ob_start();
    $jrequest = JRequest::get( 'POST' );
        if ($this->params->get('use_vardump', 0 )){
            var_dump($jrequest);
        } else {
           print_r($jrequest);
        }  
    $post = ob_get_contents();
    ob_end_clean();		
    if(strpos($post, $empty)) {
    $post = JTEXT::_('POST vars are empty');
    } else {
    $post = $post;
    }
$requestfox .='<fieldset><legend>POST</legend><pre>' .
$post .
'</pre></fieldset>';
}
//FILES
if ($this->params->get('use_files', 1 )){
    ob_start();
    $jrequest = JRequest::get( 'FILES' );
        if ($this->params->get('use_vardump', 0 )){
            var_dump($jrequest);
        } else {
           print_r($jrequest);
        }  
    $files = ob_get_contents();
    ob_end_clean();		
    if(strpos($files, $empty)) {
    $files = JTEXT::_('FILES is empty');
    } else {
    $files = $files;
    }
$requestfox .='<fieldset><legend>FILES</legend><pre>' .
$files .
'</pre></fieldset>';
}
//METHOD
if ($this->params->get('use_method', 0 )){
    ob_start();
    $jrequest = JRequest::get( 'METHOD' );
        if ($this->params->get('use_vardump', 0 )){
            var_dump($jrequest);
        } else {
           print_r($jrequest);
        }  
    $method = ob_get_contents();
    ob_end_clean();		
    if(strpos($method, $empty)) {
    $method = JTEXT::_('METHOD vars are empty');
    } else {
    $method = $method;
    }
$requestfox .='<fieldset><legend>METHOD</legend><pre>' .
$method .
'</pre></fieldset>';
}
//COOKIE
if ($this->params->get('use_method', 0 )){
    ob_start();
    $jrequest = JRequest::get( 'COOKIE' );

        if ($this->params->get('use_vardump', 0 )){
            var_dump($jrequest);
        } else {
           print_r($jrequest);
        }  
    $cookie = ob_get_contents();
    ob_end_clean();		
    if(strpos($method, $empty)) {
    $cookie = JTEXT::_('COOKIE vars are empty');
    } else {
    $cookie = $cookie;
    }
$requestfox .='<fieldset><legend>COOKIE</legend><pre>' .
$cookie .
'</pre></fieldset>';
}
if ($this->params->get('use_session', 1 )){
$session = NULL;
    ob_start();
    $getsession =& JFactory::getSession();

        if ($this->params->get('use_vardump', 0 )){
            var_dump($getsession);
        } else {
           print_r($getsession);
        }
    $session = ob_get_contents();
    ob_end_clean();

    
$requestfox .='<fieldset><legend>SESSION</legend><pre>' .
'Please wait next version' .
$session .
'</pre></fieldset>';    
}

$requestfox .='</div>';