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

// Load language file
$this->loadLanguage('plg_system_debug');
$db =& JFactory::getDBO();

ob_start();


		

			$newlineKeywords = '#\b(FROM|LEFT|INNER|OUTER|WHERE|SET|VALUES|ORDER|GROUP|HAVING|LIMIT|ON|AND)\b#i';

			$db	= JFactory::getDbo();

			echo '<h4>'.JText::sprintf('PLG_DEBUG_QUERIES_LOGGED',  $db->getTicker()).'</h4>';

			if ($log = $db->getLog()) {
				echo '<ol>';
				$selectQueryTypeTicker = array();
				$otherQueryTypeTicker = array();
				foreach ($log as $k => $sql) {
					// Start Query Type Ticker Additions
					$fromStart = stripos($sql, 'from');
					$whereStart = stripos($sql, 'where', $fromStart);

					if ($whereStart === false) {
						$whereStart = stripos($sql, 'order by', $fromStart);
					}

					if ($whereStart === false) {
						$whereStart = strlen($sql) - 1;
					}

					$fromString = substr($sql, 0, $whereStart);
					$fromString = str_replace("\t", " ", $fromString);
					$fromString = str_replace("\n", " ", $fromString);
					$fromString = trim($fromString);

					// Initialize the select/other query type counts the first time:
					if (!isset($selectQueryTypeTicker[$fromString])) {
						$selectQueryTypeTicker[$fromString] = 0;
					}

					if (!isset($otherQueryTypeTicker[$fromString])) {
						$otherQueryTypeTicker[$fromString] = 0;
					}

					// Increment the count:
					if (stripos($sql, 'select') === 0) {
						$selectQueryTypeTicker[$fromString] = $selectQueryTypeTicker[$fromString] + 1;
						unset($otherQueryTypeTicker[$fromString]);
					}
					else {
						$otherQueryTypeTicker[$fromString] = $otherQueryTypeTicker[$fromString] + 1;
						unset($selectQueryTypeTicker[$fromString]);
					}
					// Finish Query Type Ticker Additions

					$text = htmlspecialchars($sql, ENT_QUOTES);
					$text = preg_replace($newlineKeywords, '<br />&#160;&#160;\\0', $text);
					echo '<li>'.$text.'</li>';
				}

				echo '</ol>';

				if ($this->params->get('query_types', 1)) {
					// Get the totals for the query types:
					$totalSelectQueryTypes = count($selectQueryTypeTicker);
					$totalOtherQueryTypes = count($otherQueryTypeTicker);
					$totalQueryTypes = $totalSelectQueryTypes + $totalOtherQueryTypes;

					echo '<h4>'.JText::sprintf('PLG_DEBUG_QUERY_TYPES_LOGGED', $totalQueryTypes) . '</h4>';

					if ($totalSelectQueryTypes) {
						echo '<h5>'.JText::sprintf('PLG_DEBUG_SELECT_QUERIES').'</h5>';
						arsort($selectQueryTypeTicker);
						echo '<ol>';

						foreach($selectQueryTypeTicker as $table => $occurrences)
						{
							echo '<li>'.JText::sprintf('PLG_DEBUG_QUERY_TYPE_AND_OCCURRENCES', $table, $occurrences).'</li>';
						}

						echo '</ol>';
					}

					if ($totalOtherQueryTypes) {
						echo '<h5>'.JText::sprintf('PLG_DEBUG_OTHER_QUERIES').'</h5>';
						arsort($otherQueryTypeTicker);
						echo '<ol>';

						foreach($otherQueryTypeTicker as $table => $occurrences)
						{
							echo '<li>'.JText::sprintf('PLG_DEBUG_QUERY_TYPE_AND_OCCURRENCES', $table, $occurrences).'</li>';
						}
						echo '</ol>';
					}
				}
			}
		
			
		

$sqlqueries = ob_get_contents();

ob_end_clean();


//$sqlqueries = ob_get_contents();
$queriesfox = '
<div id="jfox_queries" style="display:none;" >
<fieldset><legend>SQL</legend>' .
$sqlqueries .
'</fieldset>
</div>';

if (!JDEBUG){
    $queriesfox = '
    <div id="jfox_queries" style="display:none;" >
    <fieldset><legend>SQL</legend>
    For use this fuction, you must enable go to <strong>Joomla Administrator > Global Configuration > System > Debug Settings</strong> and enable <em>Debug System</em><br />
    Please remember that even if you enable <em>Debug System</em>, you can still disable <em>System - Debug</em> plugin and use just JFox for see your queries.
    </fieldset>
    </div>';
}
