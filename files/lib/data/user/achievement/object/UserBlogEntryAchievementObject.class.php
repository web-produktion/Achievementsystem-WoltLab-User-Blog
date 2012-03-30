<?php
//wbb imports
require_once(WCF_DIR.'lib/data/user/achievement/object/AbstractAchievementObject.class.php');

/**
 * Earn achievement on photo creating.
 *
 * @author	Jean-Marc Licht
 * @copyright	2009-2012 web-produktion
 * @package     com.web-produktion.achievements.user.blog
 * @license	CC BY-NC-SA 3.0 <http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode>
 * @subpackage	data.user.achievement.object
 */
class UserBlogEntryAchievementObject extends AbstractAchievementObject{
	
	/**
	* @see AbstractAchievementObject::execute
	*/
	public function execute($eventObj){
		parent::execute($eventObj);
		
		foreach($this->availableAchievements as $achievement){
			if($this->getProgress() >= $achievement->objectQuantity){
				$achievement->awardToUser($this->user->userID);
			}
		}
	}
	
	/**
	 * @see AbstractAchievementObject::getProgress()
	 */
	public function getProgress(){
		parent::getProgress();
		
		$sql = "SELECT	COUNT(*) AS count 
			FROM 	wcf".WCF_N."_user_blog
			WHERE 	userID = ".$this->user->userID;
		$row = WCF::getDB()->getFirstRow($sql);
		return $row['count'];
	}
}
?>