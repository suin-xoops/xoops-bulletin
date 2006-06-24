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

}
?>