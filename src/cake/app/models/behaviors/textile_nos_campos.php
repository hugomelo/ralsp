<?php
	class TextileNosCamposBehavior extends ModelBehavior
	{
		var $_textileClass;
		var $_campos;
		
		function setup(&$Model, $configuracoes)
		{
			if(isset($configuracoes['campos']))
			{
				if(!is_array($configuracoes['campos']))
					$configuracoes['campos'] = array($configuracoes['campos']);
				
				$this->_campos[$Model->alias] = $configuracoes['campos'];
				$this->_textileClass[$Model->alias] = ClassRegistry::init('Textile', 'Vendor');
			}
		}
		
		function afterFind(&$Model, $resultados)
		{
			foreach($resultados as $key=>$resultado)
			{
				if (!isset($resultado[$Model->alias]))
					continue;
				
				foreach($resultado[$Model->alias] as $campo=>$valor)
					if(in_array($campo, $this->_campos[$Model->alias]))
						$resultados[$key][$Model->alias][$campo.'_textile'] = $this->_textileClass[$Model->alias]->TextileThis($valor);
			}
			return $resultados;
		}
	}
?>
