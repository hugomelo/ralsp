<?php

/**
 *
 * Copyright 2010-2012, Preface Design LTDA (http://www.preface.com.br")
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2010-2011, Preface Design LTDA (http://www.preface.com.br)
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link          https://github.com/prefacedesign/jodeljodel Jodel Jodel public repository 
 */

	$modules = Configure::read('jj.modules');

	$params = array('controller' => 'back_contents', 'action' => 'index');
	foreach($paginator->params['pass'] as $param)
		$params[] = $param;
	
	$paginator->options(
		array(
			'update'=>'backstage_custom_table', 
			'url' => $params,
			'before' => "$('backstage_custom_table').setLoading();",
			'complete' => "$('backstage_custom_table').unsetLoading();"
		)
	); 
	
	echo $this->Jodel->insertModule($modules[$moduleName]['model'], array('view', 'backstage_custom', 'config_bootstrap'), $this->data);
	$backstageSettings = $this->getVar("backstageSettings");
	
	echo $this->Bl->sdiv(array('class' => 'pagination'));
		echo $this->Paginator->first('<<');
		if ($this->Paginator->hasPrev())
			echo $this->Paginator->prev('<');	
		echo $this->Paginator->numbers(array('modulus' => 9, 'separator' => ''));
		if ($this->Paginator->hasNext())
			echo $this->Paginator->next('>');
		echo $this->Paginator->last('>>');
	echo $this->Bl->ediv();
	
	$lastCol = count($backstageSettings['columns']);
	
	$smartTableColumns = array();
	$totalSize = 0;
	$count = 1;
	foreach($backstageSettings['columns'] as $col)
	{
		$totalSize += $col['size'];
		$border_width = $hg->size(array('u'=> 1), false);
		$cell_padding_left  = $hg->size(array('m'=> 2),false);
		$cell_padding_right = $hg->size(array('m'=> 1), false);
		
		if ($count == 1)
			$size = array('M' => $col['size'], 'u' => (-$cell_padding_right - $cell_padding_left - 2 * $border_width));
		elseif ($count == $lastCol)
			$size = array('M' => $col['size'], 'm' => -2, 'u' => (-$cell_padding_right - $cell_padding_left - 2 * $border_width));
		else
			$size = array('M' => $col['size'], 'u' => (-$cell_padding_right - $cell_padding_left - $border_width));
		
		$this->Bl->TypeStyleFactory->widthGenerateClasses(array(0 => $size));
		if (isset($col['field']))
			$smartTableColumns[] = array(array('class' => $this->Bl->TypeStyleFactory->widthClassNames($size)), array(), $this->Paginator->sort($col['label'],$col['field']));
		else	
			$smartTableColumns[] = array(array('class' => $this->Bl->TypeStyleFactory->widthClassNames($size)), array(), $col['label']);
		$count++;
	}
	
	$classSize = array('M' => $totalSize, 'g' => -1);
	$this->Bl->TypeStyleFactory->widthGenerateClasses(array(0 => $classSize));
	$className = $this->Bl->TypeStyleFactory->widthClassNames($classSize);
	$className = $className[0];
	
	if (isset($backstageSettings['customRow']) && $backstageSettings['customRow'])
		echo $this->Jodel->insertModule($modules[$moduleName]['model'], array('view', 'backstage_custom', 'table'));
	else
	{
		echo $this->Bl->ssmartTable(array('class' => 'backstage '.$className), array(
			'automaticColumnNumberHeaderClasses' => true, 
			'automaticRowNumberClasses' => true, 
			'rows' => array(
				'every1of3' => array('class' => 'main_info'), 
				'every2of3' => array('class' => 'extra_info'),
				'every3of3' => array('class' => 'actions')
			),
			'columns' => array(
				1 => array('class' => 'first_col'),
				$lastCol => array('class' => 'last_col')
			)
		));
	}
			echo $this->Bl->smartTableHeaderDry($smartTableColumns);
			foreach ($this->data as $k => $item)
			{
				if (!empty($backstageSettings['customRow']))
				{
					echo $this->Jodel->insertModule($modules[$moduleName]['model'], array('view', 'backstage_custom', 'row'), $item);
					continue;
				}
				else
				{
					$smartTableRow = array();
					foreach($backstageSettings['columns'] as $key => $columnConfig)
					{
						if (isset($columnConfig['field']) && array_key_exists($columnConfig['field'], $item[$modelName]))
						{
							$columnName = $columnConfig['field'];
						}
						elseif (array_key_exists($key, $item[$modelName]))
						{
							$columnName = $key;
						}
						else
						{
							trigger_error("It was not possible to locate data for `$key` column. Make sure that the `field` parameter is properly set on backstage configuration.");
							$smartTableRow[] = ' ';
							continue;
						}
						
						$rowContent = $item[$modelName][$columnName];
						if ($columnName == 'created' || $columnName == 'modified')
							$rowContent = strftime("%d/%m/%y", strtotime($rowContent));
						elseif ($columnName == 'publishing_status')
							$rowContent = __d('dashboard', 'Dashboard status: ' . $rowContent, true);

						$smartTableRow[] = $rowContent;
					}
					$row_number = $k*3 + 2;

					$arrow = $this->Bl->sdiv(array('class' => 'arrow'))
							 . $this->Bl->anchor(array(), array('url' => ''), ' ')
							 . $this->Bl->ediv() . '&nbsp;';
					
					$smartTableRow[count($smartTableRow)-1] = $arrow . $smartTableRow[count($smartTableRow)-1];
					
					echo $this->Bl->smartTableRow(array('id' => 'row_'.$row_number), array(), $smartTableRow);
			
					//@todo Substitute this with an AJAX call.
					echo $this->Bl->smartTableRowDry(array(
						array(array(),array('colspan' => 3),' '), 
						array(array('id' => "item_info_$k"),array('colspan' => 4, 'rowspan' => 2), '')
					));
					
					
					// Does this entry has publishing and drafting capabilities?
					if (in_array('publish_draft', $backstageSettings['actions']))
					{
					
						$can_publish = true;
						if (isset($modules[$moduleName]['permissions']) && isset($modules[$moduleName]['permissions']['edit_publishing_status']))
						{
							if (!$this->JjAuth->can($modules[$moduleName]['permissions']['edit_publishing_status']))
								$can_publish = false;
						}
						if ($can_publish)
						{
							$onclick = "";
							$class = 'link_button';
						}
						else
						{
							$onclick = "return false;";
							$class = 'link_button disabled';
						}
						
						$draftLink = $ajax->link(__d('dashboard','Hide from public', true), 			
							array(
								'plugin' => 'backstage',
								'controller' => 'back_contents',
								'action' => 'set_publishing_status',
								$moduleName,
								$item[$modelName]['id'], 'draft'
							), array(
								'complete' => "if(request.responseJSON.success) {showPopup('draft_alert_ok');} else {showPopup('draft_alert_failure');}",
								'class' => $class,
								'onclick' => $onclick
							)
						);
					
						$publishLink = $ajax->link(__d('dashboard','Publish to the great public', true),
							array(
								'plugin' => 'backstage', 
								'controller' => 'back_contents',
								'action' => 'set_publishing_status',
								$moduleName,
								$item[$modelName]['id'], 'published'
							), array(
								'complete' => "if(request.responseJSON.success) {showPopup('publish_alert_ok');} else {showPopup('publish_alert_failure');}",
								'class' => $class,
								'onclick' => $onclick
							)
						);
					}
					
					$links = $this->Bl->sdiv();
					
					if (in_array('delete', $backstageSettings['actions']))
					{
						$delete_url = $this->Html->url(array('plugin' => 'backstage', 'controller' => 'back_contents', 'action' => 'delete_item', $moduleName, $item[$modelName]['id']));
						$can_delete = true;
						if (isset($modules[$moduleName]['permissions']) && isset($modules[$moduleName]['permissions']['delete']))
						{
							if (!$this->JjAuth->can($modules[$moduleName]['permissions']['delete']))
								$can_delete = false;
						}
						if ($can_delete)
						{
							$onclick = "deleteID = '". $delete_url . "'; showPopup('delete_alert_confirmation'); event.returnValue = false; return false;";
							$class = 'link_button';
						}
						else
						{
							$onclick = "return false;";
							$class = 'link_button disabled';
						}
						$links .= $this->Bl->anchor(
							array(
								'class' => $class,
								'onclick' => $onclick,
							), 
							array('url' => ''),
							__d('dashboard','Delete content', true)
						);
					}
					
					if (in_array('publish_draft', $backstageSettings['actions']))
					{
						$links .= $item[$modelName]['publishing_status'] == 'published' ? $draftLink : $publishLink;
					}
					
					// Default view action
					if (in_array('see_on_page', $backstageSettings['actions']))
					{
						$standardUrl = $this->Bl->moduleViewURL($moduleName,$item[$modelName]['id']);
						$links .= $this->Bl->anchor(
							array('class' => 'link_button'),
							array('url' => $standardUrl), 
							__d('dashboard', 'Dashboard: See on the page', true)
						);
					}
					
					if (in_array('edit', $backstageSettings['actions']))
					{ 
						$can_edit = true;
						if (isset($modules[$moduleName]['permissions']) && isset($modules[$moduleName]['permissions']['edit_draft']) && isset($modules[$moduleName]['permissions']['edit_published']))
						{
							if ($item[$modelName]['publishing_status'] == 'published')
							{
								if (!$this->JjAuth->can($modules[$moduleName]['permissions']['edit_published']))
									$can_edit = false;
							}
							else
							{
								if (!$this->JjAuth->can($modules[$moduleName]['permissions']['edit_draft']))
									$can_edit = false;
							}
						}
						
						if ($can_edit)
						{
							$onclick = "";
							$class = 'link_button';
						}
						else
						{
							$onclick = "return false;";
							$class = 'link_button disabled';
						}
						
						$links .= $this->Bl->anchor(
							array('class' => $class, 'onclick' => $onclick), 
							array('url' => array(
								'plugin' => 'backstage',
								'controller' => 'back_contents',
								'action' => 'edit',
								$moduleName,
								$item[$modelName]['id']
							)),
							__d('dashboard','Dashboard: Edit', true)
						);
					}
						 
					$links .= $this->Bl->ediv();
					
					echo $this->Bl->smartTableRowDry(array(
						array(array(),array('escape' => false, 'colspan' => 3),$links)
					));
					
					echo $this->Html->scriptBlock("
						new TableRow('row_$row_number', 3);
					");
				}
			}
			
		echo $this->Bl->esmartTable();
	

?>
