<?php
/**
 * jSecure Authentication plugin for Joomla!
 * jSecure Authentication extention prevents access to administration (back end)
 * login page without appropriate access key.
 * 
 * @author      $Author: Ajay Lulia $
 * @copyright   Joomla Service Provider - 2012
 * @package     jSecure3.0
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version     $Id: jsecure.class.php  $
*/

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class jsecure {
		
	function sendmail($JSecureConfig,$key, $success=null){
		
		 $config   = new JConfig();
		 $to       = $JSecureConfig->emailid;	
	     $to       = ($to) ? $to :  $config->mailfrom;
		 if($to){
			$from = $config->mailfrom;
			$fromName  = $config->fromname;
			$subject   = $JSecureConfig->emailsubject;
			
			$headers = 'From: '. $fromName . ' <' . $fromEmail . '>';
			
			switch($success){
			case 1:
				$body = JText::_($key).$_SERVER['REMOTE_ADDR'] ;
				break;
			
			default:
				$body      = JText::_( 'BODY_MESSAGE' ) .$_SERVER['REMOTE_ADDR'];
				$body	  .= " ";
				$body     .= JText::_( 'USING KEY' ).$key;  
				break;
			}
			$return = JFactory::getMailer()->sendMail($from, $headers, $to, $subject, $body,1);
			if ($return !== true) {
			return new JException(JText::_('COM_JSECURE_MAIL_FAILED'), 500);
		}
		 }	
	}

	function checkUrlKey($JSecureConfig){
		
		$my =& JFactory::getUser();
		$basepath   = JPATH_ADMINISTRATOR .'/components/com_jsecure/models';
		$logFile	= $basepath.'/jsecurelog.php';
		require_once($logFile);
		$model = new jSecureModeljSecureLog();
		if(!isset($_SERVER['HTTP_REFERER']))
                   {
		if((preg_match("/administrator\/*index.?\.php$/i", $_SERVER['PHP_SELF']))) {
			$sendemaildetails = $JSecureConfig->sendemaildetails;
			if(!$my->id && $JSecureConfig->key != md5(base64_encode($_SERVER['QUERY_STRING']))) {
					if($sendemaildetails == '2' || $sendemaildetails == '3'){
						$JSecureConfig->sendemail == '1' ? jsecure::sendmail( $JSecureConfig, $_SERVER['QUERY_STRING']) : '';
					}
					
					$change_variable = 'Wrong Key = '.$_SERVER['QUERY_STRING']; 
			        
				      $insertLog = $model ->insertLog('JSECURE_EVENT_ACCESS_ADMIN_USING_WRONG_KEY', $change_variable);
				      //return false; 
                     
					//$insertLog = $model ->insertLog('JSECURE_EVENT_ACCESS_ADMIN_USING_WRONG_KEY', $change_variable);
				return false;
			} else {
				if($sendemaildetails == '1' || $sendemaildetails == '3'){
					$JSecureConfig->sendemail == '1' ? jsecure::sendmail($JSecureConfig, 'ACCESS_ADMIN_USING_CORRECT_KEY', 1): '';
				}
					
					$insertLog = $model ->insertLog('JSECURE_EVENT_ACCESS_ADMIN_USING_CORRECT_KEY');
				return true;
		    }
		}
                   }
                   else{
                   	return false;
                   }
	
	}
	
	function formAction($JSecureConfig){
							
		$oriKey           = JRequest::getVar('passkey','');
		$sendemaildetails = $JSecureConfig->sendemaildetails;
		$userkey          = md5(base64_encode(JRequest::getVar('passkey','')));
		$passkey          = $JSecureConfig->key;
		if($userkey != $passkey){
			if($sendemaildetails == '2' || $sendemaildetails == '3'){
				$JSecureConfig->sendemail == '1' ? jsecure::sendmail($JSecureConfig,$oriKey): '';
			}
			$basepath   = JPATH_ADMINISTRATOR .'/components/com_jsecure/models';
			$logFile	= $basepath.'/jsecurelog.php';
			require_once($logFile);
			$model = new jSecureModeljSecureLog();
			$change_variable = 'Wrong Key = '.JRequest::getVar('passkey',''); 
			$insertLog = $model ->insertLog('JSECURE_EVENT_ACCESS_ADMIN', $change_variable);
			return false;
		} else {
			if($sendemaildetails == '1' || $sendemaildetails == '3'){
				$JSecureConfig->sendemail == '1' ? jsecure::sendmail($JSecureConfig,$oriKey): '';
			}
		  	return true;
		}
	}	

	function checkIps($JSecureConfig){
		$basepath   = JPATH_ADMINISTRATOR .'/components/com_jsecure/models';
		$logFile	= $basepath.'/jsecurelog.php';
		require_once($logFile);
		$model = new jSecureModeljSecureLog();
        $denyaccess = 0;
        $allowaccess = 0;
		$iptype = $JSecureConfig->iptype; //url key
		$iplistB = $JSecureConfig->iplistB;
		$iplistW = $JSecureConfig->iplistW;
		$IPB = explode("\n",$iplistB);
		$IPW = explode("\n",$iplistW);
		
		foreach($IPB as $ip){
			if($ip!=""){
			if(!strpos("*",$ip)){
			$thisip = explode("*", $ip);
			$blockip = $thisip[0];
			if (substr($_SERVER['REMOTE_ADDR'], 0, strlen($blockip)) === $blockip) {
               $denyaccess = 1;
               }
			}
			}
		}
	foreach($IPW as $ip){
		if($ip!=""){
			if(!strpos("*",$ip)){
			$thisip = explode("*", $ip);
			$allowip = $thisip[0];
			if (substr($_SERVER['REMOTE_ADDR'], 0, strlen($allowip)) === $allowip) {
               $allowaccess = 1;
               }
			}
		}
		}
		switch($iptype){
			case 0:
				$posB = strpos($iplistB,$_SERVER['REMOTE_ADDR']);
				
				if ($posB === false and $denyaccess != 1)
				{
					return true;
				}
				else
				{
					$IpAddress='Ip Address:'.$_SERVER['REMOTE_ADDR'];
					$insertLog = $model ->insertLog('JSECURE_EVENT_ACCESS_ADMIN_USING_BLOCK_IP', $IpAddress);
					return false;
				}
				break;
				
			case 1:
				$posW = strpos($iplistW,$_SERVER['REMOTE_ADDR']);
				if ($posW === false and $allowaccess != 1 )
				{
   					$IpAddress='Ip Address:'.$_SERVER['REMOTE_ADDR'];
					$insertLog = $model ->insertLog('JSECURE_EVENT_ACCESS_ADMIN_USING_BLOCK_IP', $IpAddress);
					return false;
				}
				else
				{
   					return true;
				}
				break;
				
			default:
				return true;
				break;
		}
		return true;
	}

	function displayForm(){
		$document =& JFactory::getDocument();
		$document->addStyleSheet(JURI::base()."plugins/system/jsecure/css/jsecure.css");
?>
		<link href='../plugins/system/jsecure/css/jsecure.css' rel='stylesheet' type='text/css' />
		<form name="key" action="index.php" method="POST">
		<table align="center" border="0">
		<tr>
			<td class="pad">
				<fieldset class="fieldset">
					<legend><?php echo JText::_( 'ADMINISTRATION_LOGIN' );?></legend>
					<table cellpadding="5" cellspacing="0" border="0" align="center" class="innerTable">
						<tr>
							<td><?php echo JText::_( 'ENTER_KEY_VALUE' );?></td>
						</tr>
						<tr>
							<td>
							    <input type="text" name="passkey"/>
							</td>
						</tr>
						<tr>
							<td align="right">
								<input type="submit" name="submit" value="submit"/>
							</td>
						</tr>
					</table>
				</fieldset>
			</td>
		</tr>
		</table>
		</form>
<?php
	}
}
?>