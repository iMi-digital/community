<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Tymoteusz Motylewski <t.motylewski@gmail.com>
*
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * 
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @author Tymoteusz Motylewski <t.motylewski@gmail.com>
 */
class Tx_Community_Service_Notification_PrivateMessageService extends Tx_Community_Service_Notification_BaseHandler {




	protected $view;

	/**
	 * 
	 *
	 *
	 */
	public function send(Tx_Community_Domain_Model_User $sender, $recipients, $configuration) {

		$message = t3lib_div::makeInstance('Tx_Community_Domain_Model_Message');
		$message->setSent(true);
		$message->setSentDate(time());
		$message->setSender($sender);
		$message->setRecipient($recipients[0]);

		$view = t3lib_div::makeInstance('Tx_Fluid_View_StandaloneView');

		if($configuration['template'] !== ""){
			$templatePath = t3lib_div::getFileAbsFileName($configuration['template']);
			$view->setTemplatePathAndFilename($templatePath);
			$view->assign('sender', $sender);
			$content = $configuration['message'];
			$view->assign('message', $content);
			$messageContent = $view->render();
			$message->setMessage($messageContent);
			$this->repositoryService->get('message')->add($message);

		} else {
		 //TODO:throw exception	
		}





	}


}
?>