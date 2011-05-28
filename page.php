<?php
/**
 * @version $Id$
 * @package    joomlafox
 * @subpackage plugin
 * @author     Webdesign Engenharia {@link http://www.webdesign.eng.br}
 * @author     Emerson da Rocha Luiz {@link http://www.fititnt.org}
 * @author     Created on 27-Nov-2009
 */

defined('_JEXEC') or die('Access Denied');

$option = JRequest::getVar('option');
$controller = JRequest::getVar('controller');
$model = JRequest::getVar('model');
$view = JRequest::getVar('view');
$tmpl = JRequest::getVar('tmpl');
$format = JRequest::getVar('format');
$Itemid = JRequest::getInt('Itemid');
//$id = JRequest::getInt('Itemid');


//TODO: REALLY rewrite this performance part in nexts versions
jimport( 'joomla.error.profiler' );				
$getmemory = JProfiler::getMemory();

if ($getmemory < 1024){
    $memory2 = $mem_usage." bytes";
}
elseif ($getmemory < 1048576){
    $memory2 = round($mem_usage/1024,2)." kilobytes";
}
 else {
    $memory2 = round($getmemory/1048576,2)." megabytes";
}; 


$pagefox = NULL;
$pagefox .='<div id="jfox_page" style="display:none;">
<fieldset><legend>' . JTEXT::_('Information about this page') . '</legend>'
. JTEXT::_('Component') .' (option): <strong>'. $option . '</strong><br />'
. JTEXT::_('Controller') .' (option): <strong>'. $controller . '</strong><br />'
. JTEXT::_('Model') .' (option): <strong>'. $model . '</strong><br />'
. JTEXT::_('View') .' (view): <strong>'. $view . '</strong><br />'
. JTEXT::_('tmpl') .' (tmpl): <strong>'. $tmpl. '</strong><br />'
. JTEXT::_('Format') .' (format): <strong>'. $format . '</strong><br />'
. JTEXT::_('Itemid') .' (Itemid): <strong>'. $Itemid . '</strong><br />'
//. JTEXT::_('ID') .' (Itemid): <strong>'. $id . '</strong><br />'
. '</fieldset>
</fieldset>';

$pagefox .='
<fieldset><legend>' . JTEXT::_('Loaded Plugins and Modules') . '</legend>'
. 'Still not finished'
. '</fieldset>
</fieldset>';

$pagefox .='
<fieldset><legend>' . JTEXT::_('Performance') . '</legend>'
. JTEXT::_('Memory Usage by the system') . ': ' . $memory2
. '</fieldset>
</fieldset>';



$pagefox .='</div>'; //end
