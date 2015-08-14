<?php

/**
 *
 * Copyright 2010-2013, Preface Design LTDA (http://www.preface.com.br)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2010-2013, Preface Design LTDA (http://www.preface.com.br)
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link          https://github.com/prefacedesign/jodeljodel Jodel Jodel public repository 
 */

/**
 * Class UnifiedSearchController
 *
 * @property SblSearchItem $SblSearchItem
 * @property CnThemesColor $CnThemesColor
 */
class UnifiedSearchController extends UnifiedSearchAppController
{
	public $uses = array(
		'UnifiedSearch.SblSearchItem',
		'CnGeneral.CnThemesColor'
	);

	public $helpers = array('Paginator');

	/**
	 * Index for UnifiedSearch
	 *
	 * @access public
	 */
	public function index () {
		$searchData = array('termos' => '');
		$filterOptions = array();
		$baseParams = $this->params['url'];
		unset($baseParams['url']);
		
		if (isset($baseParams['termos'])) {
			$searchData['termos'] = $baseParams['termos'];
		}
		
		if (isset($baseParams['cores'])) {
			if ($baseParams['cores'] != 'todas') {
				$filterOptions['colors'] = explode("-",$baseParams['cores']);
			} else {
				unset($this->params['url']['cores']);
			}
		}
		
		if (isset($baseParams['tipos'])) {
			if ($baseParams['tipos'] != 'todos') {
				$filterOptions['type'] = explode("-", $baseParams['tipos']);
			} 
		}
		
		if (isset($baseParams['periodo_e_ordem'])) {
			switch ($baseParams['periodo_e_ordem']) {
				case 'mais_relevantes': {
					$filterOptions['order'] = 'relevance DESC';
					break;
				}
				case 'mais_recentes': {
					$filterOptions['order'] = 'date DESC';
					break;
				}
				case 'mais_antigos': {
					$filterOptions['order'] = 'date ASC';
					break;
				}
				case 'ultimo_mes': {
					$after = new DateTime();
					$after->sub(new DateInterval('P1M'));
					$filterOptions['after'] = $after->format('Y-m-d');
					$filterOptions['order'] = 'date DESC';
					break;
				}
				case 'ultima_semana': {
					$after = new DateTime();
					$after->sub(new DateInterval('P1W'));
					$filterOptions['after'] = $after->format('Y-m-d');
					$filterOptions['order'] = 'date DESC';
					break;
				}
				case 'ultimo_ano': {
					$after = new DateTime();
					$after->sub(new DateInterval('P1Y'));
					$filterOptions['after'] = $after->format('Y-m-d');
					$filterOptions['order'] = 'date DESC';
					break;
				}
				case 'periodo': {
					if (!empty($baseParams['ano_inicio'])) {
						$after = new DateTime(((int)$baseParams['ano_inicio']).'-01-01');
						
						if (!empty($baseParams['mes_inicio'])) {
							$after->add(new DateInterval("P".($baseParams['mes_inicio'] -1)."M"));
						}
						if (!empty($baseParams['dia_inicio'])) {
							$after->add(new DateInterval("P".($baseParams['dia_inicio'] -1)."D"));
						}
						
						$filterOptions['after'] = $after->format('Y-m-d H:i:s');
					}
					
					if (!empty($baseParams['ano_fim'])) {
						$before = new DateTime(((int)$baseParams['ano_fim'] + 1).'-01-01');
						if (!empty($baseParams['mes_fim'])) {
							$before->sub(new DateInterval("P". (13-$baseParams['mes_fim'])."M"));
						}
						if (!empty($baseParams['dia_fim'])) {
							$before->add(new DateInterval("P{$baseParams['dia_fim']}D"));
						}
						$before->sub(new DateInterval('PT1S'));
						
						$filterOptions['before'] = $before->format('Y-m-d H:i:s');
					}
					$filterOptions['order'] = 'date DESC';
				}
			}
		}
		
		$paging = array();
		if (!empty($this->params['named']['page'])) {
			$paging['page'] = $this->params['named']['page'];
		}
		
		$data = array();
		if (!empty($searchData['termos'])) {
			$data = $this->SblSearchItem->getSearchResults($searchData['termos'], $filterOptions, $paging);
		}
		$this->set(compact('data', 'searchData', 'baseParams'));

		$this->params['paging']['SblSearchItem'] = $paging;
	}
}

