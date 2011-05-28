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

//URL
$app = JFactory::GetApplication();
//Todo: revise this part on Joomla 1.6
//$live_site = $app->isAdmin() ? $app->getSiteURL() : JURI::base();
$live_site = $app->isAdmin() ? JURI::base() : JURI::base();

$generalfox = NULL;



$generalfox .= "<div id=\"jfox_general\" style=\"display:none;\" >" .
"<fieldset><legend>What is JFox?</legend>
Version: JFox 0.7.0RC2. <br />
JFox (the new version of JoomlaFox!) is one extension for Firebug on Firefox [jfox_version.xpi], one Joomla! plugin [plg_jfox_version.tar.gz] 
and one optional component [com_jfoxconsole_version.tar.gz] that togeteder help Joomla extension developers to debug yours components, modules, plugins and templates
more easy.<br />
Oficial site: <a href=\"http://www.fititnt.org/joomlafox.html\" target=\"_blank\">http://www.fititnt.org/joomlafox.html</a><br />
Oficial forum: <a href=\"http://forum.fititnt.org/viewforum.php?f=3\" target=\"_blank\">http://forum.fititnt.org/viewforum.php?f=3</a><br />
Developer twitter: <a href=\"http://twitter.com/fititnt\" target=\"_blank\">@fititnt</a>
</fieldset>" .

"<fieldset><legend> How to edit parameters</legend>
Go to <a href=\"{$live_site}administrator/index.php?option=com_plugins\" target=\"_blank\">plugins manager</a>, choose <em>System - JFox</em> and edit parameters
to decide what tabs will be loaded and how some other information will appears<br />
</fieldset>";



$generalfox .= "
<div id=\"jfox_general\" style=\"display:none;\" >
<fieldset><legend> How to edit parameters</legend>

Edit <a href=\"$live_site/administrator/index.php?option=com_joomlafox\" target=\"_blank\">JoomlaFox! parameters</a> to decide what Tabs will be loaded<br />
For now still need do it on backend, but on nexts versions you will be able to do it on JoomlaFox Firefox/Firebug Plugin.
</fieldset>";
