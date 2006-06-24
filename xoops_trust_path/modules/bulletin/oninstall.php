<?php

eval( ' function xoops_module_install_'.$mydirname.'( $module ) { return bulletin_oninstall_base( $module , "'.$mydirname.'" ) ; } ' ) ;


function bulletin_oninstall_base( $module , $mydirname )
{
	// transations on module install

	global $ret ;

	$db =& Database::getInstance() ;
	$mid = $module->getVar('mid') ;

	// TABLES (loading mysql.sql)
	$sql_file_path = dirname(__FILE__).'/sql/mysql.sql' ;
	$prefix_mod = $db->prefix() . '_' . $mydirname ;
	if( file_exists( $sql_file_path ) ) {
		$ret[] = "SQL file found at <b>".htmlspecialchars($sql_file_path)."</b>.<br  /> Creating tables...<br />";
		include_once XOOPS_ROOT_PATH.'/class/database/sqlutility.php' ;
		$sql_query = trim( file_get_contents( $sql_file_path ) ) ;
		SqlUtility::splitMySqlFile( $pieces , $sql_query ) ;
		$created_tables = array() ;
		foreach( $pieces as $piece ) {
			$prefixed_query = SqlUtility::prefixQuery( $piece , $prefix_mod ) ;
			if( ! $prefixed_query ) {
				$ret[] = "Invalid SQL <b>".htmlspecialchars($piece)."</b><br />";
				return false ;
			}
			if( ! $db->query( $prefixed_query[0] ) ) {
				$ret[] = '<b>'.htmlspecialchars( $db->error() ).'</b><br />' ;
				var_dump( $db->error() ) ;
				return false ;
			} else {
				if( ! in_array( $prefixed_query[4] , $created_tables ) ) {
					$ret[] = '&nbsp;&nbsp;Table <b>'.htmlspecialchars($prefix_mod.'_'.$prefixed_query[4]).'</b> created.<br />';
					$created_tables[] = $prefixed_query[4];
				} else {
					$ret[] = '&nbsp;&nbsp;Data inserted to table <b>'.htmlspecialchars($prefix_mod.'_'.$prefixed_query[4]).'</b>.</br />';
				}
			}
		}
	}

	// TEMPLATES
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
					$ret[] = '<span style="color:#ff0000;">ERROR: Could not insert template <b>'.htmlspecialchars($mydirname.'_'.$file).'</b> to the database.</span><br />';
				} else {
					$tplid = $tplfile->getVar( 'tpl_id' ) ;
					$ret[] = 'Template <b>'.htmlspecialchars($mydirname.'_'.$file).'</b> added to the database. (ID: <b>'.$tplid.'</b>)<br />';
					// generate compiled file
					include_once XOOPS_ROOT_PATH.'/class/template.php';
					if( ! xoops_template_touch( $tplid ) ) {
						$ret[] = '<span style="color:#ff0000;">ERROR: Failed compiling template <b>'.htmlspecialchars($mydirname.'_'.$file).'</b>.</span><br />';
					} else {
						$ret[] = 'Template <b>'.htmlspecialchars($mydirname.'_'.$file).'</b> compiled.</span><br />';
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
	if ($blocks != false) {
		$ret[] = 'Adding blocks...<br />';
		foreach ($blocks as $blockkey => $block) {
			// break the loop if missing block config
			if (!isset($block['file']) || !isset($block['show_func'])) {
				break;
			}
			$options = '';
			if (!empty($block['options'])) {
				$options = trim($block['options']);
			}
			// idを取得
			$newbid = $db->genId($db->prefix('newblocks').'_bid_seq');
			// edit_funtの定義
			$edit_func = isset($block['edit_func']) ? trim($block['edit_func']) : '';
			// テンプレート
			$template = '';
			if ((isset($block['template']) && trim($block['template']) != '')) {
				$block['template'] = preg_replace('/^'.$mydirname.'_/i', '', $block['template']);
				$tpl_path = dirname(__FILE__).'/templates/blocks/'.$block['template'] ;
				if( file_exists($tpl_path)){
					$content =& file_get_contents($tpl_path);
				}else{
					$ret[] = '&nbsp;&nbsp;<span style="color:#ff0000;">ERROR: Does not exists template <b>'.$mydirname . '_' .trim($block['template']).'</b><br />';
				}
			}
			//コンテント
			if (!isset($content)) {
				$content = '';
			} else {
				$template = $mydirname . '_' .trim($block['template']);
			}
			$block_name = addslashes(trim($block['name']));
			$sql = "INSERT INTO ".$db->prefix("newblocks")." (bid, mid, func_num, options, name, title, content, side, weight, visible, block_type, c_type, isactive, dirname, func_file, show_func, edit_func, template, bcachetime, last_modified) VALUES ($newbid, $mid, ".intval($blockkey).", '$options', '".$block_name."','".$block_name."', '', 0, 0, 0, 'M', 'H', 1, '".addslashes($mydirname)."', '".addslashes(trim($block['file']))."', '".addslashes(trim($block['show_func']))."', '".addslashes($edit_func)."', '".$template."', 0, ".time().")";
			if (!$db->query($sql)) {
				$ret[] = '&nbsp;&nbsp;<span style="color:#ff0000;">ERROR: Could not add block <b>'.$block['name'].'</b> to the database! Database error: <b>'.$db->error().'</b></span><br />';
			} else {
				if (empty($newbid)) {
					$newbid = $db->getInsertId();
				}
				$ret[] = '&nbsp;&nbsp;Block <b>'.$block['name'].'</b> added. Block ID: <b>'.$newbid.'</b><br />';
				$sql = 'INSERT INTO '.$db->prefix('block_module_link').' (block_id, module_id) VALUES ('.$newbid.', -1)';
				$db->query($sql);
				if ($template != '') {
					$tplfile =& $tplfile_handler->create();
					$tplfile->setVar('tpl_refid', $newbid);
					$tplfile->setVar('tpl_source', $content, true);
					$tplfile->setVar('tpl_tplset', 'default');
					$tplfile->setVar('tpl_file', $mydirname . '_' . $block['template']);
					$tplfile->setVar('tpl_module', $mydirname);
					$tplfile->setVar('tpl_type', 'block');
					$tplfile->setVar('tpl_desc', $block['description'], true);
					$tplfile->setVar('tpl_lastimported', 0);
					$tplfile->setVar('tpl_lastmodified', time());
					if (!$tplfile_handler->insert($tplfile)) {
						$ret[] = '&nbsp;&nbsp;<span style="color:#ff0000;">ERROR: Could not insert template <b>'.$mydirname . '_' .$block['template'].'</b> to the database.</span><br />';
					} else {
						$newtplid = $tplfile->getVar('tpl_id');
						$ret[] = '&nbsp;&nbsp;Template <b>'.$mydirname . '_' .$block['template'].'</b> added to the database. (ID: <b>'.$newtplid.'</b>)<br />';
						// generate compiled file
						include_once XOOPS_ROOT_PATH.'/class/template.php';
						if (!xoops_template_touch($newtplid)) {
							$ret[] = '&nbsp;&nbsp;<span style="color:#ff0000;">ERROR: Failed compiling template <b>'.$mydirname . '_' .$block['template'].'</b>.</span><br />';
						} else {
							$ret[] = '&nbsp;&nbsp;Template <b>'.$mydirname . '_' .$block['template'].'</b> compiled.</span><br />';
						}
					}
				}
			}
			unset($content);
		}
		unset($blocks);
	}


	return true ;
}

?>