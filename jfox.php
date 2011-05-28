<?php
/**
 * @package		JFox
 * @author		Emerson Rocha Luiz (emerson@webdesign.eng.br)
 * @copyright   Copyright (C) 2005 - 2010 Webdesign Assessoria em Tecnologia da Informação LTDA.
 * @license		GNU General Public License version 2 or later;
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

/**
 * JFox Plugin
 *
 * @package		Joomla
 * @subpackage          JFox
 */
class plgSystemJFox extends JPlugin
{
	/**
	 * Constructor
	 *
	 * For php4 compatability we must not use the __constructor as a constructor for plugins
	 * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
	 * This causes problems with cross-referencing necessary for the observer design pattern.
	 *
	 * @access      protected
	 * @param       object  $subject The object to observe
	 * @param       array   $config  An array that holds the plugin configuration
	 * @since       1.0
	 */

        function plgSystemJFox( &$subject, $config )
	{
		parent::__construct( $subject, $config );

		// Do some extra initialisation in this constructor if required
	}


	/**
	 *Do something onAfterInitialize
	 */
	function onAfterInitialise()
	{
	    $db =& JFactory::getDBO();
	    //$db->debug(1);
	}


	/**
	 * Do something onAfterRender
	 */
	function onAfterRender()

	{

            
                
		//load user info
		$user =& JFactory::getUser();
                $app =& JFactory::getApplication();


                //Block non superadmins
                if (!JFactory::getUser()->authorise('core.admin', 'plg_jfox'))
                {
                        return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
                }
                
		$document	= JFactory::getDocument();
		$doctype	= $document->getType();

		// Only render for HTML output
		if ($doctype !== 'html') {
			return;
		}                
                
                
		// take body
		

                if ($this->params->get('enable_jfox_frontend', 1) != 1 AND $app->isSite() ){
                    return;
                }                

                if ($this->params->get('enable_jfox_backend', 1) != 1 AND $app->isAdmin() ){
                    return;
                }  
                
                    
                //load files
		$joomlafoxcontent = NULL;                                  
                
                //jfox_general
                if ($this->params->get('show_jfox_tab_general', 1) == 1){
			include_once( JPATH_PLUGINS.DS.'system'.DS.'jfox'.DS.'general.php' );
                        $joomlafoxcontent .= $generalfox; 
                } 
                //jfox_system
                if ($this->params->get('show_jfox_tab_system', 1) == 1){
			include_once( JPATH_PLUGINS.DS.'system'.DS.'jfox'.DS.'system.php' );
                        $joomlafoxcontent .= $systemfox; 
                } 
                //jfox_page
                if ($this->params->get('show_jfox_tab_page', 1) == 1){
			include_once( JPATH_PLUGINS.DS.'system'.DS.'jfox'.DS.'page.php' );
                        $joomlafoxcontent .= $pagefox; 
                } 
                //jfox_queries
                if ($this->params->get('show_jfox_tab_queries', 1) == 1){
			include_once( JPATH_PLUGINS.DS.'system'.DS.'jfox'.DS.'queries.php' );
                        $joomlafoxcontent .= $queriesfox; 
                }
                //jfox_form
                if ($this->params->get('show_jfox_tab_request', 1) == 1){
			include_once( JPATH_PLUGINS.DS.'system'.DS.'jfox'.DS.'request.php' );
                        $joomlafoxcontent .= $requestfox; 
                }
                //jfox_permissions
                if ($this->params->get('show_jfox_tab_permissions', 1) == 1){
			include_once( JPATH_PLUGINS.DS.'system'.DS.'jfox'.DS.'permissions.php' );
                        $joomlafoxcontent .= $permissionsfox; 
                }
                //jfox_php
                if ($this->params->get('show_jfox_tab_jfoxconsole', 1) == 1){
			include_once( JPATH_PLUGINS.DS.'system'.DS.'jfox'.DS.'php.php' );
                        $joomlafoxcontent .= $phpfox; 
                }                
                
                /*

		if ($user->get('gid') == 25) { //if is superadmin load content

			//check if is administrator or frontend
			$app =& JFactory::getApplication();
			$isbackend = $app->isAdmin();

			//Load params
			$params = &JComponentHelper::getParams( 'com_joomlafox' );
			$disable_all = $params->get( 'disable_all' );
			$enable_frontend = $params->get( 'enable_frontend' );
			$enable_backend = $params->get( 'enable_backend' );

			if ( !$disable_all == '1'){
				if($isbackend AND !$enable_backend == '0') {
					$showjoomlafox = TRUE;
				} elseif (!$isbackend AND !$enable_frontend == '0') {
					$showjoomlafox = TRUE;
				}
			}
			if ($showjoomlafox) {

				//Load params
				$show_general = $params->get( 'show_general' );
				$show_system = $params->get( 'show_system' );
				$show_page = $params->get( 'show_page' );
				$show_queries = $params->get( 'show_queries' );
				$show_forms = $params->get( 'show_forms' );
				$show_permissions = $params->get( 'show_permissions' );
				$show_3rddeveloper = $params->get( 'show_3rddeveloper' );
				$show_extras = $params->get( 'show_extras' );
				$show_jfoxconsole = $params->get( 'show_jfoxconsole' );

				//includes
				if ($show_general == '1'){
					include_once( JPATH_PLUGINS.DS.'system'.DS.'joomlafox'.DS.'general.php' );
				}
				if ($show_system == '1'){
					include_once( JPATH_PLUGINS.DS.'system'.DS.'joomlafox'.DS.'system.php' );
				}
				if ($show_page == '1'){
					include_once( JPATH_PLUGINS.DS.'system'.DS.'joomlafox'.DS.'page.php' );
				}
				if ($show_queries == '1'){
					include_once( JPATH_PLUGINS.DS.'system'.DS.'joomlafox'.DS.'queries.php' );
				}
				if ($show_forms == '1'){
					include_once( JPATH_PLUGINS.DS.'system'.DS.'joomlafox'.DS.'form.php' );
				}
				if ($show_permissions == '1'){
					include_once( JPATH_PLUGINS.DS.'system'.DS.'joomlafox'.DS.'permissions.php' );
				}
				if ($show_3rddeveloper == '1'){
					include_once( JPATH_PLUGINS.DS.'system'.DS.'joomlafox'.DS.'3rddeveloper.php' );
				}
				if ($show_extras == '1'){
					include_once( JPATH_PLUGINS.DS.'system'.DS.'joomlafox'.DS.'extra.php' );
				}
				if ($show_jfoxconsole == '1'){
					include_once( JPATH_PLUGINS.DS.'system'.DS.'joomlafox'.DS.'php.php' );
				}
				//include_once( JPATH_PLUGINS.DS.'system'.DS.'joomlafox'.DS.'nosuperadminuser.php' );

				//General
				$joomlafoxcontent .= $generalfox;
				//system
				$joomlafoxcontent .= $systemfox;
				//system2
				$joomlafoxcontent .= $systemfox;
				//page
				$joomlafoxcontent .= $pagefox;
				//queries
				$joomlafoxcontent .= $queriesfox;
				//form
				$joomlafoxcontent .= $requestfox;
				//permissions
				$joomlafoxcontent .= $permissionsfox;
				//3rddeveloper
				$joomlafoxcontent .= $developerfox;
				//extras
				$joomlafoxcontent .= $extrafox;
				//php
				$joomlafoxcontent .= $phpfox;

	          } else { //if is not superadmin
		          //General ( for non admin users
		          $joomlafoxcontent .= $nosuperadminuserfox;
	          }

	          //replace on on the html for output the tag </body> for ' + </body>'
	          $body = str_replace('</body>', $joomlafoxcontent .'</body>', $body);

	          JResponse::setBody($body);
		  }//if disable_all



                 */

                $body1 = JResponse::getBody();
                
                //replace on on the html for output the tag </body> for ' + </body>'
                $body = str_replace('</body>', $joomlafoxcontent .'</body>', $body1);

                JResponse::setBody($body);
                
          return true;

	}

}