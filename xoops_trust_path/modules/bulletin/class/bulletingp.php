<?php
class BulletinGP{

	function checkRight($gperm_name, $gperm_itemid, $gperm_groupid, $gperm_modid = 1)
	{
		$criteria = new CriteriaCompo(new Criteria('gperm_modid', $gperm_modid));
		$criteria->add(new Criteria('gperm_name', $gperm_name));
		$gperm_itemid = intval($gperm_itemid);
		if ($gperm_itemid > 0) {
			$criteria->add(new Criteria('gperm_itemid', $gperm_itemid));
		}
		if (is_array($gperm_groupid)) {
			$criteria2 = new CriteriaCompo();
			foreach ($gperm_groupid as $gid) {
				$criteria2->add(new Criteria('gperm_groupid', $gid), 'OR');
			}
			$criteria->add($criteria2);
		} else {
			$criteria->add(new Criteria('gperm_groupid', $gperm_groupid));
		}
		if ($this->getCount($criteria) > 0) {
			return true;
		}
		return false;
	}

	function getCount($criteria = null)
	{
		global $xoopsDB;
		$sql = 'SELECT COUNT(*) FROM '.$xoopsDB->prefix('group_permission');
		if (isset($criteria) && is_subclass_of($criteria, 'criteriaelement')) {
			$sql .= ' '.$criteria->renderWhere();
		}
		$result = $xoopsDB->query($sql);
		if (!$result) {
			return 0;
		}
		list($count) = $xoopsDB->fetchRow($result);
		return $count;
	}


	function group_perm($perm_itemid){

		global $xoopsUser,$xoopsModule;	
		
		if ($xoopsUser) {
			$groups = $xoopsUser->getGroups();
		} else {
			$groups = XOOPS_GROUP_ANONYMOUS;
		}
		
		$module_id = $xoopsModule->getVar('mid');
//		$gperm_handler =& xoops_gethandler('groupperm');
		if ($this->checkRight('bulletin_permit', $perm_itemid, $groups, $module_id)) {
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