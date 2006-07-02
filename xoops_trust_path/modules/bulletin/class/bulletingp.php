<?
class BulletinGP{
	
	function group_perm($perm_itemid){

		global $xoopsUser,$xoopsModule;	
		
		if ($xoopsUser) {
			$groups = $xoopsUser->getGroups();
		} else {
			$groups = XOOPS_GROUP_ANONYMOUS;
		}
		
		$module_id = $xoopsModule->getVar('mid');
		$gperm_handler =& xoops_gethandler('groupperm');
		if ($gperm_handler->checkRight('bulletin_permit', $perm_itemid, $groups, $module_id)) {
			return true;
		}
		return false;
	}

	function getAdminUsers(){

		global $xoopsDB, $xoopsModule;	
		$mid = $xoopsModule->mid();

		$groups = array();
		$rs = $xoopsDB->query( "SELECT gperm_groupid FROM ".$xoopsDB->prefix('group_permission')." WHERE  gperm_itemid='$mid' AND gperm_name='module_admin'" ) ;
		while( list( $id ) = $xoopsDB->fetchRow( $rs ) ) {
			$groups[] = $id ;
		}

		$users = array();
		foreach( $groups as $groupid ){
			$sql = 'SELECT uid FROM '.$xoopsDB->prefix('groups_users_link').' WHERE groupid='.intval($groupid);
			$result = $xoopsDB->query($sql);
			while ($myrow = $xoopsDB->fetchArray($result)) {
				$users[] = $myrow['uid'];
			}
		}
		
		$users = array_unique($users);
		
		sort($users);
		
		return $users;
	}

}
?>