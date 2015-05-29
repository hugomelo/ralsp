<?php
	class MultiplasPersonalidadesBehavior extends ModelBehavior 
	{
		var $_personalidades, $_erro, $_campoTipo, $_campoId;
		var $_campos, $_validacoes;
		
//------------------------------------------------------------------------------------------------------------------------------------
		
		function setup(&$Model, $configuracoes)
		{
			$padrao = array(
				'campoTipo' => 'tipo_resto',
				'campoId' => 'resto_id'
			);
			
			$configuracoes = am($padrao, $configuracoes);
			
			if(empty($configuracoes['personalidades']))
				$this->_erro[$Model->alias] = true;
				
			$this->_personalidades[$Model->alias] = array();
			$this->_campoId[$Model->alias] = $configuracoes['campoId'];
			$this->_campoTipo[$Model->alias] = $configuracoes['campoTipo'];
			
			foreach($Model->_schema as $campo=>$nada)
				$this->_campos[$Model->alias][$campo][] = $Model->alias;
			
			$Model->contain_filhos = array();
				
			foreach($configuracoes['personalidades'] as $key => $personalidade)
			{
				if(!(is_string($personalidade)))
				{
					trigger_error('Nome de model especificado para o behavior MultiplasPersonalidades na classe '.$Model->alias.' não é uma string.');
					continue;
				}
				
				if($this->_erro[$Model->alias])
					break;
				
				$this->_personalidades[$Model->alias][$personalidade] = &ClassRegistry::init($personalidade);
				$this->_aliases[$Model->alias][$personalidade] = $key;
				$schema = $this->_personalidades[$Model->alias][$personalidade]->_schema;
				unset($schema[$this->_personalidades[$Model->alias][$personalidade]->primaryKey]);
				
				foreach($schema as $campoFilho=>$nada)
					$this->_campos[$Model->alias][$campoFilho][] = $personalidade;
				
				//Os filhos podem recomendar qual é o contain correto!
				if (isset($this->_personalidades[$Model->alias][$personalidade]->contain_recomendado))
				{
					$Model->contain_filhos = am($Model->contain_filhos, $this->_personalidades[$Model->alias][$personalidade]->contain_recomendado);
				}
				else
				{
					$Model->contain_filhos[] = $this->_personalidades[$Model->alias][$personalidade]->alias;
				}
			}
			
			foreach($this->_campos[$Model->alias] as $nome=>$tabelas)
			{
				if(count($tabelas) > 1 && in_array($Model->alias, $tabelas) && $nome != $this->_campoId[$Model->alias] && $nome != $this->_campoTipo[$Model->alias])
				{		
					debug($this->_campos[$Model->alias]);
					$this->_erro[$Model->alias] = true;
					trigger_error('Coluna '.$nome.' é ambígua para o behavior MultiplasPersonalidades.');
					break;
				}
			}
			
			$this->criaAssociacioes($Model, $this->_personalidades[$Model->alias]);
		}
		
		
//------------------------------------------------------------------------------------------------------------------------------------//------------------------------------------------------------------------------------------------------------------------------------
		function criaAssociacioes(&$Model, $personalidades)
		{
			$ligacoes = array();
			
			foreach(array_keys($personalidades) as $md)
			{
				$ma = array_pop(explode('.', $md));
				$ligacoes[$ma] = array(
					'className' => $md,
					'foreignKey' => $this->_campoId[$Model->alias],
					'recursive' => 2
				);
			}
			$Model->belongsTo = am($Model->belongsTo, $ligacoes);
			
			$Model->__createLinks();
		}

//------------------------------------------------------------------------------------------------------------------------------------//------------------------------------------------------------------------------------------------------------------------------------
		
		function beforeFind(&$Model, $queryData)
		{	
			$queryData['conditions'] = $this->_especifica($Model, $queryData['conditions']);
			return $queryData;
		}
		
//------------------------------------------------------------------------------------------------------------------------------------
		
		function afterFind(&$Model, $results, $primary)
		{
			// debug($results);
			// $Model->logQueries('olimpiada');
		
			$modelsPersonais = array_keys($this->_personalidades[$Model->alias]);
			
			if(!$primary)
				return $results;
			
			foreach($results as $key => $result)
			{
				foreach($modelsPersonais as $nomeModel)
				{
					$apelidoModel = array_pop(explode('.', $nomeModel));
					
					if(isset($result[$Model->alias][$this->_campoTipo[$Model->alias]]) && $this->_aliases[$Model->alias][$nomeModel] == $result[$Model->alias][$this->_campoTipo[$Model->alias]])
					{
						if(!empty($result[$apelidoModel][$this->_personalidades[$Model->alias][$nomeModel]->primaryKey]))
							$results[$key][$Model->alias] = am($result[$apelidoModel], $results[$key][$Model->alias]);
					}
					unset($results[$key][$apelidoModel]);
				}
			}
			return $results;
		}
		
//------------------------------------------------------------------------------------------------------------------------------------
		function beforeDelete(&$Model, $cascade)
		{
			$dados = $Model->find('all', array('conditions' => array('id' => $Model->id), 'callbacks' => false));
			$nomeModelFilho = array_search($dados[0][$Model->alias][$this->_campoTipo[$Model->alias]], $this->_aliases[$Model->alias]);
			if(!empty($nomeModelFilho))
			{
				$this->_personalidades[$Model->alias][$nomeModelFilho]->del($dados[0][$Model->alias][$this->_campoId[$Model->alias]]);
			}
			return true;
		}
//------------------------------------------------------------------------------------------------------------------------------------
		
		/*function filtra(&$Model, $data)
		{
			$ids = array();
			foreach($data as $n=>$results)
				if(is_numeric($n))
					$data[$n] = $this->filtra($Model, $results);
				else
					foreach($results as $model=>$valores)
						foreach($valores as $coluna=>$valor)
							if($model==$Model->alias && $coluna==$this->_campoId[$Model->alias])
							{
								//pega o filho
								debug($data);
								debug('Filtrou...');
							}
							elseif(is_array($valor))
							{
								$data[$model][$coluna] = $this->filtra($Model, $valor);
							}
			
			return $data;
		}*/
		
//------------------------------------------------------------------------------------------------------------------------------------
		
		function beforeValidate(&$Model)
		{
			$modelAlias = $this->_qualFilhoTaSalvando($Model);
			if(!$modelAlias)
				return true;
			
			// Coloca todos os campos que não são reais do model, nos dados do model filho
			$modelFilho = &$this->_personalidades[$Model->alias][$modelAlias];
			if(!$modelFilho)
				return true;
			
			$this->_poemDadosNoFilho($Model, $modelFilho);
			
			$valido = true;
			if(isset($Model->validacoes[$modelAlias]))
			{
				$modelFilho->validate = $Model->validacoes[$modelAlias];
				$valido = $modelFilho->validates();
				$Model->validationErrors = $modelFilho->validationErrors;
			}
			
			return $valido;
		}
		
//------------------------------------------------------------------------------------------------------------------------------------
		
		function beforeSave(&$Model)
		{
			$erro = false;
			$modelAlias = $this->_qualFilhoTaSalvando($Model);
			
			if($modelAlias)
			{
				$modelFilho = &$this->_personalidades[$Model->alias][$modelAlias];
				$this->_poemDadosNoFilho($Model, $modelFilho);
				
				if(!empty($modelFilho->data))
				{
					if($modelFilho->save())
					{
						$Model->data[$Model->alias][$this->_campoId[$Model->alias]] = $modelFilho->id;
					}
					else
					{
						$erro = true; // não conseguiu salvar o model filho
					}
				}
				$Model->data[$Model->alias][$this->_campoTipo[$Model->alias]] = $this->_aliases[$Model->alias][$modelAlias];
			}
			
			return !$erro;
		}
		
		function _poemDadosNoFilho(&$Model, &$modelFilho)
		{
			$dados = $Model->data;
			if(isset($dados[$Model->alias]))
			{
				$dados[$modelFilho->alias] = $dados[$Model->alias];
				unset($dados[$Model->alias]);
				foreach($this->_campos[$Model->alias] as $campo=>$modelQueTem)
					if(isset($dados[$modelFilho->alias][$campo]) && $modelQueTem[0] == $Model->alias)
						unset($dados[$modelFilho->alias][$campo]);
			
				// Se já existe, coloca o ID
				if(isset($Model->data[$Model->alias][$Model->primaryKey]))
				{
					$paiAtual = $Model->find('all',
						array(
							'conditions' => array($Model->alias . '.' . $Model->primaryKey => $Model->data[$Model->alias][$Model->primaryKey]),
							'callbacks' => false,
							'fields' => $this->_campoId[$Model->alias]
						)
					);
					
					if(isset($paiAtual[0][$Model->alias][$this->_campoId[$Model->alias]]) && !empty($paiAtual[0][$Model->alias][$this->_campoId[$Model->alias]]))
						$dados[$modelFilho->alias][$modelFilho->primaryKey] = $paiAtual[0][$Model->alias][$this->_campoId[$Model->alias]];
				}
			}
			$modelFilho->set($dados);
		}
//------------------------------------------------------------------------------------------------------------------------------------
		
		function _qualFilhoTaSalvando(&$Model)
		{
			foreach($Model->data[$Model->alias] as $campo=>$valor)
				if(isset($this->_campos[$Model->alias][$campo][0]) && $this->_campos[$Model->alias][$campo][0] != $Model->alias)
					return $this->_campos[$Model->alias][$campo][0];
				elseif(isset($Model->data[$Model->alias][$this->_campoTipo[$Model->alias]]) && in_array($Model->data[$Model->alias][$this->_campoTipo[$Model->alias]], $this->_aliases[$Model->alias]))
					return array_search($Model->data[$Model->alias][$this->_campoTipo[$Model->alias]], $this->_aliases[$Model->alias]);
			return false;
		}
		
//------------------------------------------------------------------------------------------------------------------------------------
		
		function _especifica(&$Model, $query)
		{
			if(is_array($query))
			{
				foreach($query as $campo => $subquery)
				{
					$nome_campo = explode(' ', $campo);
					$nome_campo = array_shift($nome_campo);
					if(is_array($subquery))
					{
						$query[$campo] = $this->_especifica($Model, $subquery);
					}
					else if(strpos($campo, '.') === false && isset($this->_campos[$Model->alias][$nome_campo]))
					{
						$ors = array();
						foreach($this->_campos[$Model->alias][$nome_campo] as $alias_model)
						{
							$alias_model = explode('.', $alias_model);
							$alias_model = array_pop($alias_model);
							
							$ors[$alias_model.'.'.$campo] = $query[$campo];
						}
						
						if(count($ors) == 1)
							$query = am($query, $ors);
						else
							if(isset($query['OR']))
								$query['OR'] = am($query['OR'], $ors);
							else
								$query['OR'] = $ors;
						
						unset($query[$campo]);
					}
				}
			}
			else
			{
			}
			return $query;
		}
	}
?>