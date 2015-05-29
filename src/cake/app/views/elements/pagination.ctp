<?php

if (($this->Paginator->hasNext() || $this->Paginator->hasPrev()) && (!isset($top) || $top == false))
	echo $this->Bl->hr(array('class' => 'double'));

if (!isset($modules)) $modules = 12;

if (!empty($currentSpace))
	$this->Paginator->options(array('url' => array('space' => $currentSpace)));

echo $this->Bl->sboxContainer(array('class' => 'pagination'), array('size' => array('M' => $modules), 'type' => 'column_container'));

	$current = $this->Paginator->current();
	echo $this->Bl->sbox(array('class' => 'newer'), array('size' => array('M' => 2, 'g' => 1), 'type' => 'inner_column'));
		if ($this->Paginator->hasPrev())
		{
			if (!isset($labels['prev']))
				$labels['prev'] = __d('mexc','mais recentes', true);
			echo $this->Bl->anchor(array(), array('type' => 'to_left', 'url' => array('page' => $current-1), 'space' => $currentSpace), $labels['prev']);
		}
	echo $this->Bl->ebox();
	
	echo $this->Bl->sbox(array('class' => 'numbers'), array('size' => array('M' => $modules-4, 'g' => -4), 'type' => 'inner_column'));
		echo $this->Paginator->numbers(array('separator' => ' '));
	echo $this->Bl->ebox();

	echo $this->Bl->sbox(array('class' => 'older'), array('size' => array('M' => 2), 'type' => 'inner_column'));
		if ($this->Paginator->hasNext())
		{
			if (!isset($labels['next']))
				$labels['next'] = __d('mexc','mais antigas', true);
			echo $this->Bl->anchor(array(), array('type' => 'to_right', 'url' => array('page' => $current+1), 'space' => $currentSpace), $labels['next']);
		}
	echo $this->Bl->ebox();
	
echo $this->Bl->eboxContainer();

if (isset($top) && $top == true && ($this->Paginator->hasNext() || $this->Paginator->hasPrev()))
	echo $this->Bl->hr(array('class' => 'double'));
