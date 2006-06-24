<?php

eval( ' function xoops_module_update_'.$mydirname.'( $module ) { return bulletin_onupdate_base( $module , "'.$mydirname.'" ) ; } ' ) ;


function bulletin_onupdate_base( $module , $mydirname )
{
	global $msgs, $xoopsDB, $xoopsUser, $xoopsConfig ;

	$db =& Database::getInstance() ;
	$mid = $module->getVar('mid') ;


	// transations on module update

	// TABLES (write here ALTER TABLE etc. if necessary)


	// TEMPLATES (all templates have been already removed by modulesadmin)
	$tplfile_handler =& xoops_gethandler( 'tplfile' ) ;
	$tpl_path = dirname(__FILE__).'/templates' ;
	if( $handler = @opendir( $tpl_path . '/' ) ) {
		while( ( $file = readdir( $handler ) ) !== false ) {
			if( substr( $file , 0 , 1 ) == '.' ) continue ;
			$file_path = $tpl_path . '/' . $file ;
			if( is_file( $file_path ) && substr( $file , -5 ) == '.html' ) {
				$mtime = intval( @filemtime( $file_path ) ) ;
				$tplfile =& $tplfile_handler->create() ;
				$tplfile->setVar( 'tpl_source' , file_get_contents( $file_path ) , true ) ;
				$tplfile->setVar( 'tpl_refid' , $mid ) ;
				$tplfile->setVar( 'tpl_tplset' , 'default' ) ;
				$tplfile->setVar( 'tpl_file' , $mydirname . '_' . $file ) ;
				$tplfile->setVar( 'tpl_desc' , '' , true ) ;
				$tplfile->setVar( 'tpl_module' , $mydirname ) ;
				$tplfile->setVar( 'tpl_lastmodified' , $mtime ) ;
				$tplfile->setVar( 'tpl_lastimported' , 0 ) ;
				$tplfile->setVar( 'tpl_type' , 'module' ) ;
				if( ! $tplfile_handler->insert( $tplfile ) ) {
					$msgs[] = '<span style="color:#ff0000;">ERROR: Could not insert template <b>'.htmlspecialchars($mydirname.'_'.$file).'</b> to the database.</span>';
				} else {
					$tplid = $tplfile->getVar( 'tpl_id' ) ;
					$msgs[] = 'Template <b>'.htmlspecialchars($mydirname.'_'.$file).'</b> added to the database. (ID: <b>'.$tplid.'</b>)';
					// generate compiled file
					include_once XOOPS_ROOT_PATH.'/class/template.php';
					if( ! xoops_template_touch( $tplid ) ) {
						$msgs[] = '<span style="color:#ff0000;">ERROR: Failed compiling template <b>'.htmlspecialchars($mydirname.'_'.$file).'</b>.</span>';
					} else {
						$msgs[] = 'Template <b>'.htmlspecialchars($mydirname.'_'.$file).'</b> compiled.</span>';
					}
				}
			}
		}
		closedir( $handler ) ;
	}
	include_once XOOPS_ROOT_PATH.'/class/template.php' ;
	xoops_template_clear_module_cache( $mid ) ;

	// BLOCKS
	$blocks = $module->getInfo('myblocks');
	$msgs[] = 'Rebuilding blocks...';
	if ($blocks != false) {
		$count = count($blocks);
		$showfuncs = array();
		$funcfiles = array();
		for ( $i = 1; $i <= $count; $i++ ) {
			if (isset($blocks[$i]['show_func']) && $blocks[$i]['show_func'] != '' && isset($blocks[$i]['file']) && $blocks[$i]['file'] != '') {
				$editfunc = isset($blocks[$i]['edit_func']) ? $blocks[$i]['edit_func'] : '';
				$showfuncs[] = $blocks[$i]['show_func'];
				$funcfiles[] = $blocks[$i]['file'];
				$template = '';
				if ((isset($blocks[$i]['template']) && trim($blocks[$i]['template']) != '')) {
					$blocks[$i]['template'] = preg_replace('/^'.$mydirname.'_/i', '', $blocks[$i]['template']);
					$tpl_path = dirname(__FILE__).'/templates/blocks/'.$blocks[$i]['template'] ;
					if( file_exists($tpl_path)){
						$content =& file_get_contents($tpl_path);
					}else{
						$msgs[] = '&nbsp;&nbsp;<span style="color:#ff0000;">ERROR: Does not exists template <b>'.$mydirname . '_' .trim($blocks[$i]['template']).'</b>';
					}
				}
				if (!isset($content)) {
					$content = '';
				} else {
					$template = $mydirname . '_' . $blocks[$i]['template'];
				}
				$options = '';
				if (!empty($blocks[$i]['options'])) {
					$options = $blocks[$i]['options'];
				}
				$sql = "SELECT bid, name FROM ".$xoopsDB->prefix('newblocks')." WHERE mid=".$module->getVar('mid')." AND func_num=".$i." AND show_func='".addslashes($blocks[$i]['show_func'])."' AND func_file='".addslashes($blocks[$i]['file'])."'";
				$fresult = $xoopsDB->query($sql);
				$fcount = 0;
				while ($fblock = $xoopsDB->fetchArray($fresult)) {
					$fcount++;
					$sql = "UPDATE ".$xoopsDB->prefix("newblocks")." SET name='".addslashes($blocks[$i]['name'])."', edit_func='".addslashes($editfunc)."', options='".addslashes($options)."', content='', template='".$template."', last_modified=".time()." WHERE bid=".$fblock['bid'];
					$result = $xoopsDB->query($sql);
					if (!$result) {
						$msgs[] = '&nbsp;&nbsp;ERROR: Could not update '.$fblock['name'];
					} else {
						$msgs[] = '&nbsp;&nbsp;Block <b>'.$fblock['name'].'</b> updated. Block ID: <b>'.$fblock['bid'].'</b>';
						if ($template != '') {
							$tplfile =& $tplfile_handler->find('default', 'block', $fblock['bid']);
							if (count($tplfile) == 0) {
								$tplfile_new =& $tplfile_handler->create();
								$tplfile_new->setVar('tpl_module', $mydirname);
								$tplfile_new->setVar('tpl_refid', $fblock['bid']);
								$tplfile_new->setVar('tpl_tplset', 'default');
								$tplfile_new->setVar('tpl_file', $mydirname . '_' . $blocks[$i]['template'], true);
								$tplfile_new->setVar('tpl_type', 'block');
							}
							else {
								$tplfile_new = $tplfile[0];
							}
							$tplfile_new->setVar('tpl_source', $content, true);
							$tplfile_new->setVar('tpl_desc', $blocks[$i]['description'], true);
							$tplfile_new->setVar('tpl_lastmodified', time());
							$tplfile_new->setVar('tpl_lastimported', 0);
							if (!$tplfile_handler->insert($tplfile_new)) {
								$msgs[] = '&nbsp;&nbsp;<span style="color:#ff0000;">ERROR: Could not update template <b>'.$mydirname . '_' . $blocks[$i]['template'].'</b>.</span>';
							} else {
								$msgs[] = '&nbsp;&nbsp;Template <b>'.$mydirname . '_' . $blocks[$i]['template'].'</b> updated.';
								if ($xoopsConfig['template_set'] == 'default') {
									if (!xoops_template_touch($tplfile_new->getVar('tpl_id'))) {
										$msgs[] = '&nbsp;&nbsp;<span style="color:#ff0000;">ERROR: Could not recompile template <b>'.$mydirname . '_' . $blocks[$i]['template'].'</b>.</span>';
									} else {
										$msgs[] = '&nbsp;&nbsp;Template <b>'.$mydirname . '_' . $blocks[$i]['template'].'</b> recompiled.';
									}
								}
								}
						}
					}
				}
				if ($fcount == 0) {
					$newbid = $xoopsDB->genId($xoopsDB->prefix('newblocks').'_bid_seq');
					$block_name = addslashes($blocks[$i]['name']);
					$sql = "INSERT INTO ".$xoopsDB->prefix("newblocks")." (bid, mid, func_num, options, name, title, content, side, weight, visible, block_type, isactive, dirname, func_file, show_func, edit_func, template, last_modified) VALUES (".$newbid.", ".$module->getVar('mid').", ".$i.",'".addslashes($options)."','".$block_name."', '".$block_name."', '', 0, 0, 0, 'M', 1, '".addslashes($mydirname)."', '".addslashes($blocks[$i]['file'])."', '".addslashes($blocks[$i]['show_func'])."', '".addslashes($editfunc)."', '".$template."', ".time().")";
					$result = $xoopsDB->query($sql);
					if (!$result) {
						$msgs[] = '&nbsp;&nbsp;ERROR: Could not create '.$blocks[$i]['name'];echo $sql;
					} else {
						if (empty($newbid)) {
							$newbid = $xoopsDB->getInsertId();
						}
						$groups =& $xoopsUser->getGroups();
						$gperm_handler =& xoops_gethandler('groupperm');
						foreach ($groups as $mygroup) {
							$bperm =& $gperm_handler->create();
							$bperm->setVar('gperm_groupid', $mygroup);
							$bperm->setVar('gperm_itemid', $newbid);
							$bperm->setVar('gperm_name', 'block_read');
							$bperm->setVar('gperm_modid', 1);
							if (!$gperm_handler->insert($bperm)) {
								$msgs[] = '&nbsp;&nbsp;<span style="color:#ff0000;">ERROR: Could not add block access right. Block ID: <b>'.$newbid.'</b> Group ID: <b>'.$mygroup.'</b></span>';
							} else {
								$msgs[] = '&nbsp;&nbsp;Added block access right. Block ID: <b>'.$newbid.'</b> Group ID: <b>'.$mygroup.'</b>';
							}
						}

						if ($template != '') {
							$tplfile =& $tplfile_handler->create();
							$tplfile->setVar('tpl_module', $mydirname);
							$tplfile->setVar('tpl_refid', $newbid);
							$tplfile->setVar('tpl_source', $content, true);
							$tplfile->setVar('tpl_tplset', 'default');
							$tplfile->setVar('tpl_file', $mydirname . '_' . $blocks[$i]['template'], true);
							$tplfile->setVar('tpl_type', 'block');
							$tplfile->setVar('tpl_lastimported', 0);
							$tplfile->setVar('tpl_lastmodified', time());
							$tplfile->setVar('tpl_desc', $blocks[$i]['description'], true);
							if (!$tplfile_handler->insert($tplfile)) {
								$msgs[] = '&nbsp;&nbsp;<span style="color:#ff0000;">ERROR: Could not insert template <b>'.$mydirname . '_' . $blocks[$i]['template'].'</b> to the database.</span>';
							} else {
								$newid = $tplfile->getVar('tpl_id');
								$msgs[] = '&nbsp;&nbsp;Template <b>'.$mydirname . '_' . $blocks[$i]['template'].'</b> added to the database.';
								if ($xoopsConfig['template_set'] == 'default') {
									if (!xoops_template_touch($newid)) {
										$msgs[] = '&nbsp;&nbsp;<span style="color:#ff0000;">ERROR: Template <b>'.$mydirname . '_' . $blocks[$i]['template'].'</b> recompile failed.</span>';
									} else {
										$msgs[] = '&nbsp;&nbsp;Template <b>'.$mydirname . '_' . $blocks[$i]['template'].'</b> recompiled.';
									}
								}
							}
						}
						$msgs[] = '&nbsp;&nbsp;Block <b>'.$blocks[$i]['name'].'</b> created. Block ID: <b>'.$newbid.'</b>';
						$sql = 'INSERT INTO '.$xoopsDB->prefix('block_module_link').' (block_id, module_id) VALUES ('.$newbid.', -1)';
						$xoopsDB->query($sql);
					}
				}
			}
			unset($content);
		}
		$block_arr = XoopsBlock::getByModule($module->getVar('mid'));
		foreach ($block_arr as $block) {
			if (!in_array($block->getVar('show_func'), $showfuncs) || !in_array($block->getVar('func_file'), $funcfiles)) {
				$sql = sprintf("DELETE FROM %s WHERE bid = %u", $xoopsDB->prefix('newblocks'), $block->getVar('bid'));
				if(!$xoopsDB->query($sql)) {
					$msgs[] = '&nbsp;&nbsp;<span style="color:#ff0000;">ERROR: Could not delete block <b>'.$block->getVar('name').'</b>. Block ID: <b>'.$block->getVar('bid').'</b></span>';
				} else {
					$msgs[] = '&nbsp;&nbsp;Block <b>'.$block->getVar('name').' deleted. Block ID: <b>'.$block->getVar('bid').'</b>';
					if ($block->getVar('template') != '') {
						$tplfiles =& $tplfile_handler->find(null, 'block', $block->getVar('bid'));
						if (is_array($tplfiles)) {
							$btcount = count($tplfiles);
							for ($k = 0; $k < $btcount; $k++) {
								if (!$tplfile_handler->delete($tplfiles[$k])) {
									$msgs[] = '&nbsp;&nbsp;<span style="color:#ff0000;">ERROR: Could not remove deprecated block template. (ID: <b>'.$tplfiles[$k]->getVar('tpl_id').'</b>)</span>';
								} else {
									$msgs[] = '&nbsp;&nbsp;Block template <b>'.$tplfiles[$k]->getVar('tpl_file').'</b> deprecated.';
								}
							}
						}
					}
				}
			}
		}
	}
	return true ;
}
?>