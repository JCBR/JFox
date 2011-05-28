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

//$app = JFactory::GetApplication();
//$live_site = $app->isAdmin() ? $app->getSiteURL() : JURI::base();
$live_site = JURI::base();

$phpfox = '
<div id="jfox_php" style="display:none;" >
<fieldset><legend>JFoxConsole</legend>
<iframe width=100% frameborder=0 height=100% style="margin-bottom:-3px;" src="' .  $live_site . 'index.php?option=com_jfoxconsole&format=raw"></iframe>
</fieldset>
</div>
';
 
