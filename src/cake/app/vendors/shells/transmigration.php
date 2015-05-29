<?php

class TransmigrationShell extends Shell
{
	protected $approach;
	protected $CurrentModel;
	protected $CurrentOldModel;
	
	protected $filePath = '';
	
	static $modelsToLoad = array(
		'FileUpload',
		'Imagem' => array(
			'belongsTo' => array('FileUpload')
		),
		'Foto' => array(
			'hasAndBelongsToMany' => array(
				'Imagem' => array(
					'className' => 'Imagem',
					'joinTable' => 'fotos_has_imagens',
					'foreignKey' => 'foto_id',
					'associationForeignKey'=> 'imagem_id',
					'unique' => true,
				)
			)
		),
		'Novidade'=> array(
			'hasAndBelongsToMany' => array(
				'Foto' => array(
					'className' => 'Foto',
					'joinTable' => 'novidades_has_fotos',
					'foreignKey' => 'novidade_id',
					'associationForeignKey'=> 'foto_id',
					'unique' => true	
				)
			)
		),
		'Agencia',
		'Noticia',

		'Galeria',
		'HABTMFotoGaleria' => array(
			'config' => array('table' => 'galerias_has_fotos'),
			'belongsTo' => array(
				'Foto', 'Galeria'
			)
		),

		'GdGaleria' => array(
			'config' => array(
				'table' => 'galerias',
				'ds' => 'gd'
			)
		),
		'GdFoto' => array(
			'config' => array(
				'table' => 'fotos',
				'ds' => 'gd'
			),
			'belongsTo' => array(
				'Imagem',
				'GdGaleria' => array(
					'foreignKey' => 'galeria_id'
				)
			)
		),
		
		'Evento' => array(
			'hasAndBelongsToMany' => array (
				'Foto' => array (
					'className'  => 'Foto',
					'joinTable'  => 'eventos_has_fotos'
				),
				'Galeria' => array(
					'className' => 'Galeria',
					'joinTable'  => 'eventos_has_galerias'				
				)
			)
		),
		'Eventinho' => array(
			'belongsTo' => array('Evento')
		),
		'UiTag' => array(
			'config' => array('ds' => 'ui'),
		),
		'UiPalestrante' => array(
			'config' => array('ds' => 'ui'),
		),
		'UiPalestra' => array(
			'config' => array('ds' => 'ui'),
			'hasAndBelongsToMany' => array('UiTag')
		)
	);
	
	static $map = array(
		'Novidade' => array(
			'model' => 'MexcNews.MexcNew',
			'contain' => array('Foto' => array('Imagem' => 'FileUpload')),
			'conditions' => array('Novidade.status <>' => 'antigo'),
			'columns' => array(
				'img_id' => 'lookupImg/Foto.0.Imagem.0',
				'mexc_space_id' => 'columnSetValues/tipo|museu:museu;1_olimpiada:olimpiada_1;2_olimpiada:olimpiada_2;gd_09_novidade:gd_3;gd_10_novidade:gd_4;gd_11_novidade:gd_5;unicamp_itinerante:unicamp_itinerante',
				'content_stream_id' => 'createTextContentStream/corpo',
				'mexc_event_id' => 'null/',
				'date' => 'column/data_novidade',
				'summary' => 'column/resumo',
				'title' => 'column/manchete',
				'author' => 'column/autor',
				'publishing_status' => 'columnSetValues/status|publicado:published;rascunho:draft',
				'created' => 'column/created',
				'modified' => 'column/modified',
			)
		),
		'Agencia' => array(
			'model' => 'MexcNews.MexcNewsSource',
			'contain' => false,
			'conditions' => array(),
			'columns' => array(
				'name' => 'column/nome'
			)
		),
		'Noticia' => array(
			'model' => 'MexcScientificNews.MexcScientificNew',
			'contain' => false,
			'conditions' => array('Noticia.status <>' => 'antigo'),
			'columns' => array(
				'mexc_news_source_id' => 'equivalence/Agencia|agencia_id',
				'title' => 'column/manchete',
				'date' => 'column/data_publicacao',
				'data' => 'column/resumo',
				'source_url' => 'column/link',
				'publishing_status' => 'columnSetValues/status|publicado:published;rascunho:draft',
				'created' => 'column/created',
				'modified' => 'column/modified',
			)
		),
		'Evento' => array(
			'model' => 'MexcEvents.MexcEvent',
			'contain' => array('Foto' => array('Imagem' => 'FileUpload'), 'Galeria'),
			'conditions' => array('Evento.status <>' => 'antigo', 'Evento.tipo_evento' => 'evento'),
			'columns' => array(
				'img_id' => 'lookupImg/Foto.0.Imagem.0',
				'mexc_tag_id' => 'null/', // Will be dropped soon
				'mexc_space_id' => 'value/museu',
				'content_stream_id' => 'createTextContentStream/descricao > createImagesContentStream/Foto.{[^0]}',
				'summary' => 'column/resumo',
				'how_to_participate_textile_id' => 'createTextile/como_participar',
				'place_about_textile_id' => 'createTextile/local',
				'place_name' => 'null/',
				'place_url' => 'null/',
				'name' => 'column/titulo',
				'start' => 'column/data_inicio',
				'end' => 'column/data_fim',
				'publishing_status' => 'columnSetValues/status|publicado:published;rascunho:draft',
				'created' => 'column/created',
				'modified' => 'column/modified'
			)
		),
		'Eventinho' => array(
			'model' => 'MexcEvent.MexcEventItem',
			'contain' => array('Evento'),
			'conditions' => array('Evento.status <>' => 'antigo', 'Evento.tipo_evento' => 'evento'),
			'columns' => array(
				'mexc_event_id' => 'equivalence/Evento|evento_id',
				'name' => 'column/nome',
				'description' => 'column/observacoes',
				'start' => 'compoundColumns/&dia| |&hora_comeco',
				'end' => 'compoundColumns/&dia| |&hora_fim',
				'order' => 'null/'
			)
		),
		'Galeria' => array(
			'model' => 'MexcGalleries.MexcGallery',
			'contain' => false,
			'conditions' => array('status <>' => 'antigo'),
			'columns' => array(
				'mexc_space_id' => 'value/museu',
				'mexc_image_count' => 'null/',
				'date' => 'column/data',
				'title' => 'column/nome',
				'description' => 'column/descricao',
				'mexc_event_id' => 'null/',
				'publishing_status' => 'columnSetValues/status|publicado:published;rascunho:draft',
				'created' => 'column/created',
				'modified' => 'column/modified'
			)
		),
		'GdGaleria' => array(
			'model' => 'MexcGalleries.MexcGallery',
			'contain' => false,
			'conditions' => array('status <>' => 'antigo'),
			'columns' => array(
				'mexc_space_id' => 'compoundColumns/gd_|&edicao_id',
				'mexc_image_count' => 'null/',
				'date' => 'column/data',
				'title' => 'column/nome',
				'description' => 'column/descricao',
				'mexc_event_id' => 'null/',
				'publishing_status' => 'columnSetValues/status|publicado:published;rascunho:draft',
				'created' => 'column/created',
				'modified' => 'column/modified'
			)
		),
		'HABTMFotoGaleria' => array(
			'model' => 'MexcGalleries.MexcImage',
			'identifier' => 'Foto.id',
			'contain' => array('Galeria', 'Foto' => array('Imagem' => 'FileUpload')),
			'conditions' => array(
				'HABTMFotoGaleria.galeria_id <>' => null, 
				'Galeria.status <>' => 'antigo'
			),
			'columns' => array(
				'mexc_gallery_id' => 'equivalence/Galeria|galeria_id',
				'img_id' => 'lookupImg/Foto.Imagem.0',
				'title' => 'column/Foto.titulo',
				'subtitle' => 'column/Foto.descricao'
			)
		),
		'GdFoto' => array(
			'model' => 'MexcGalleries.MexcImage',
			'contain' => array('GdGaleria', 'Imagem' => 'FileUpload'),
			'conditions' => array(
				'GdGaleria.status <>' => 'antigo'
			),
			'columns' => array(
				'mexc_gallery_id' => 'equivalence/GdGaleria|galeria_id',
				'img_id' => 'lookupImg/Imagem',
				'title' => 'column/titulo',
				'subtitle' => 'column/legenda',
				'order' => 'column/ordem'
			)
		),
		'UiPalestrante' => array(
			'model' => 'MexcLectures.MexcSpeaker',
			'contain' => false,
			'columns' => array(
				'mexc_space_id' => 'value/unicamp_itinerante',
				'content_stream_id' => 'createTextContentStream/bio',
				'name' => 'column/nome',
				'title' => 'value/',
				'description' => 'column/bio',
				'publishing_status' => 'value/published'
			)
		),
		'UiPalestra' => array(
			'model' => 'MexcLectures.MexcLecture',
			'contain' => array('UiTag'),
			'columns' => array(
				'mexc_speaker_id' => 'equivalence/UiPalestrante|ui_palestrante_id',
				'mexc_space_id' => 'value/unicamp_itinerante',
				'content_stream_id' => 'createTextContentStream/descricao',
				'name' => 'column/titulo',
				'description' => 'column/descricao',
				'publishing_status' => 'value/published',
				'tags' => 'implode/, |/UiTag/tag'
			)
		)
	);
	
	function main()
	{
		$this->out();
		$this->out('             _______                        _______');
		$this->out('    ________/      /_              ________/      /_');
		$this->out('   /          OLD   /   ___\      /          NEW   /');
		$this->out('  /                /   |    \    /                /');
		$this->out(' /                /    |____/   /                /');
		$this->out('/________________/         /   /________________/');
		$this->out();
		$this->out('Mexc Console for data migration from old site to the new site!');
		
		if (isset($this->params['test']))
			$this->approach = 't';
		elseif (isset($this->params['real']))
			$this->approach = 'r';
		else
			$this->approach = $this->in('One important thing: do you want this for (r)eal or just (t)est?', array('t','r'), 't');

		if (isset($this->params['files']))
		{
			$this->filePath = $this->params['files'];
			if (substr($this->filePath, -1) != '/')
				$this->filePath .= '/';
		}
		
		$this->out();
		$this->start();
	}
	
	function start()
	{
		ini_set('memory_limit', -1);
		$everybody = count($this->args) == 0;
		$this->loadModels();
		
		if (!$everybody)
		{
			$this->out('Yout choose to not migrate/test migration of all Models.');
			$ans = $this->in('Migrating `' . implode('`, `', $this->args) . '`. Ok?', array('y', 'n'), 'y');
			if ($ans != 'y')
				return;
			$this->out();
		}
		
		foreach (self::$map as $oldModelName => $config)
		{
			if (!$everybody && !in_array($oldModelName, $this->args))
			{
				$this->out('Skiping ' . $oldModelName);
				continue;
			}
			
			$this->out();
			$this->hr();
			$this->out();

			$migrationDesc = $oldModelName . ' to ' . $config['model'];
			$ans = $this->in('Migrating data from ' . $migrationDesc . '. Proceed?', array('y','n'), 'y');
			if ($ans != 'y')
				continue;
			
			extract($config);
			
			$this->CurrentOldModel =& $this->OldModels[$oldModelName];
			
			// Checks for migrated data
			$migrated = $this->Equivalency->find('count', array('conditions' => array(
				'model_old' => $this->CurrentOldModel->alias
			)));

			// Counts migratable data e 
			$count = $this->CurrentOldModel->find('count', compact('conditions', 'contain'));
			$this->out($count . ' entries found. Migrating...');

			// Gets the model where migrated data will be saved
			$this->CurrentModel =& ClassRegistry::init($model);
			$dbo =& $this->CurrentModel->getDataSource();
			
			sleep(1);
			
			for ($offset = 0; $offset < $count; $offset++)
			{
				$item = $this->CurrentOldModel->find('first', compact('offset', 'conditions', 'contain'));
				if (empty($item))
				{
					$this->out('vaxio');
					continue;
				}

				$eqColumnName = $this->CurrentOldModel->alias.'.'.$this->CurrentOldModel->primaryKey;
				if (isset($config['identifier']))
					$eqColumnName = $config['identifier'];
				$item_migrated = $this->Equivalency->find('first', array(
					'conditions' => array(
						'model_old' => $this->CurrentOldModel->alias,
						'id_old' => $this->column($eqColumnName, $item)
					)
				));
				
				if ($item_migrated)
				{
					list($tmpModelName, $tmpColumnName) = explode('.', $eqColumnName);
					$this->out("{$this->CurrentOldModel->alias}({$item[$tmpModelName][$tmpColumnName]}) migrated. Skiping...");
					unset($tmpModelName, $tmpColumnName);
					continue;
				}
				
				$dbo->begin($this->CurrentModel);

				$data = array();
				foreach ($columns as $columnName => $settings)
				{
					$chain = array_map('trim', explode('>', $settings));
					$out = null;

					foreach ($chain as $link)
					{
						$settings = explode('/', $link);
						$method = array_shift($settings);
						
						if (!method_exists($this, $method))
							$this->error('One of the columns need the "'.$method.'" to be evalued and there is no such method. :(');
						
						$settings = implode('/', $settings);
						$out = $this->{$method}($settings, $item, $columnName, $out);
					}
					$data[$columnName] = $out;
				}

				$this->CurrentModel->create();
				if (!$this->CurrentModel->save($data, false))
					$this->warning('Saving failed. Aborting...');
				
				$this->Equivalency->create(array(
					'model_old' => $this->CurrentOldModel->alias,
					'id_old' => $this->column($eqColumnName, $item),
					'model_new' => $model,
					'id_new' => $this->CurrentModel->id
				));
				if ($this->forReal())
					$this->Equivalency->save();
				
				$this->porcentage($count, $offset+1, $migrationDesc . ($this->forReal() ? '' : ' (test)'));
				
				if ($this->forReal())
					$dbo->commit($this->CurrentModel);
				else
					$dbo->rollback($this->CurrentModel);
			}
			
			
			$this->out();
			$this->hr();
			$this->out($migrationDesc . ' done!');
			$this->hr();
			$this->out();
		}
		
		$this->hr();
		$this->hr();
		$this->out('All my work here is done. See ya!');
		$this->hr();
		$this->hr();
	}


// ---------- Helper methods

	function error($msg)
	{
		$dbo = $this->CurrentModel->getDataSource();
		$dbo->rollBack($this->CurrentModel);
		return parent::error($msg);
	}

	protected function porcentage($total, $n, $msg)
	{
		$this->out(str_pad(number_format(100*$n/$total, 1), 6, ' ', STR_PAD_LEFT) . '% '. $msg);
	}
	
	protected function forReal()
	{
		return $this->approach == 'r';
	}
	
	protected function warning($msg)
	{
		$this->err('Warning: ' . $msg);
	}
	
	protected function loadOldModel($class, $config)
	{
		$config += array('ds' => 'old');
		return ClassRegistry::init(compact('class') + $config);
	}
	
	protected function loadModels()
	{
		$this->Equivalency =& ClassRegistry::init(array(
			'class' => 'IdEquivalency',
			'ds' => 'legacy'
		));
		
		$this->MexcTextileText =& ClassRegistry::init(array(
			'class' => 'MexcTextile.MexcTextileText',
		));
		
		$this->SfilStoredFile =& ClassRegistry::init(array(
			'class' => 'JjMedia.SfilStoredFile'
		));
		
		$singularBkp = array_intersect_key(Inflector::getInstance()->_singular, array_flip(array('rules', 'uninflected', 'irregular')));
	    Inflector::rules('singular', array(
			'rules' => array('/(.*)ns$/i' => '\1m','/(.*)ais$/i' => '\1al','/(.*)oes$/i' => '\1ao','/(.*)ores$/i' => '\1or'),
		));
		$pluralBkp = array_intersect_key(Inflector::getInstance()->_plural, array_flip(array('rules', 'uninflected', 'irregular')));
	    Inflector::rules('plural', array(
	    	'rules' => array('/(.*)m$/i' => '\1ns','/(.*)al$/i' => '\1ais','/(.*)ao$/i' => '\1oes','/(.*)or$/i' => '\1ores')
		));
		
		foreach (Set::normalize(self::$modelsToLoad) as $model_name => $links)
		{
			if (isset($this->OldModels[$model_name]))
				$this->error('There are two models with the same name: `'.$model_name.'`');

			$links = (array) $links;
			$links += array('config' => array());
			
			$this->OldModels[$model_name] = $this->loadOldModel($model_name, $links['config']);
			$this->OldModels[$model_name]->Behaviors->attach('Containable');

			unset($links['config']);
			if (is_array($links) && !empty($links))
				$this->OldModels[$model_name]->bindModel($links, false);
		}
		
		Inflector::rules('singular', $singularBkp, true);
		Inflector::rules('plural', $pluralBkp, true);
	}

	protected function fixText($text)
	{
		return preg_replace('/\xc3\x20/', 'à', $text);
	}


	
// ---------- Methods used to parse data
	
	
	
/**
 * Translates one set of values to another
 * 
 * Usage: "columnSetValues/old_value:new_value|onother_old_one:another_new_one"
 * 
 * @access protected
 * @return string Data for the target column
 */
	protected function columnSetValues($settings, $data)
	{
		list($column, $equivalence) = explode('|', $settings);
		
		$equivalences = array();
		foreach (explode(';', $equivalence) as $one_equivalence)
		{
			list($one, $two) = explode(':', $one_equivalence);
			$equivalences[$one] = $two;
		}
		if (empty($data[$this->CurrentOldModel->alias][$column]))
		{
			$this->warning('`' . $column . '` for entry id{'.$data[$this->CurrentOldModel->alias][$this->CurrentOldModel->primaryKey].'} is empty and will not generate a valid value.');
			$options = array_values($equivalences);
			$debug = $this->in('Want to dump entry data?', array('y', 'n'), 'n');
			if ($debug == 'y')
				print_r($data);
			$value = $this->in('Whitch of those ('.implode(', ', $options).') you prefer to use?', $options);
		}
		elseif (!isset($equivalences[$data[$this->CurrentOldModel->alias][$column]]))
		{
			$this->error('Not found ' . $data[$this->CurrentOldModel->alias][$column] . ' in equivalence string. Availables: '. implode(' ', array_keys($equivalences)));
		}
		else
		{
			$value = $equivalences[$data[$this->CurrentOldModel->alias][$column]];
		}
		return $value;
	}

/**
 * Always sets value to NULL
 * 
 * Usage: "null/"
 * 
 * @access protected
 * @return null
 * @see TransmigrationShell::value()
 */
	protected function null($settings, $data)
	{
		return $this->value(null, $data);
	}

/**
 * Copies the value from the specified column from older data
 * 
 * Usage: "column/Model.column_name"
 * 
 * @access protected
 * @return string Data for the target column
 */
	protected function column($settings, $data)
	{
		if (strpos($settings, '.') === false)
			$settings = $this->CurrentOldModel->alias . '.' . $settings;
		if (!Set::check($data, $settings))
			$this->error('`' . $settings . '` not found among table columns. Availables: '. implode(', ', array_keys($data[$this->CurrentOldModel->alias])));
		return $this->fixText(Set::classicExtract($data, $settings));
	}

/**
 * Sets the value to a specific (and fixed) value
 * 
 * Usage: "value/value you whan to that column"
 * 
 * @access protected
 * @return string Data for the target column
 */
	protected function value($settings, $data)
	{
		return $settings;
	}

/**
 * Tries to migrate an uploaded file using data from especified path
 * 
 * Usage "lookupImg/file.data.path"
 * 
 * @access protected
 * @return string Data for the target column
 */
	protected function lookupImg($settings, $data, $for)
	{
		$id = '';

		if (!Set::check($data, $settings))
			return $id;
		
		$file = Set::classicExtract($data, $settings);

		
		if (!isset($file['nome_arquivo']))
		{
			$this->warning('Image data not found.');
			debug($file);
		}
		
		if (strpos($for, '.') === false)
			$for = $this->CurrentModel->alias . '.' . $for;
		$scope = $this->SfilStoredFile->findTheScope($for);
		
		if (!$scope)
		{
			$this->warning('lookupImg did not found the scope for '.$for);
			return $id;
		}
		
		if (preg_match('/^\w+:\/\/.*/', $this->filePath))
			$file['nome_arquivo'] = rawurlencode($file['nome_arquivo']);
		
		$remote_file = $this->filePath . $file['FileUpload']['subdir'] . '/' . $file['nome_arquivo'];
		
		clearstatcache();
		$fp = @fopen($remote_file, 'r');
		if (!$fp)
		{
			$this->warning(String::insert('File ":remote_file" not found', compact('remote_file')));
			return $id;
		}
		else
			fclose($fp);
		
		$this->SfilStoredFile->setScope($scope);
		$this->SfilStoredFile->create(array(
			'SfilStoredFile' => array('file' => $remote_file)
		));

		unset($this->SfilStoredFile->validate['file']['location']);
		unset($this->SfilStoredFile->validate['file']['size']);
		
		if (!$this->SfilStoredFile->save())
		{
			$this->warning('SfilStoredFile could not save a record.');
			foreach ($this->SfilStoredFile->validationErrors as $error => $message)
				$this->out(String::insert('  Error (:error) - :message', compact('error', 'message')));

			$this->out();
		}
			
		return $this->SfilStoredFile->id;
	}

/**
 * Create one content stream and fills it up with content from specified column
 * 
 * Usage: "createTextContentStream/column_name"
 * 
 * @access protected
 * @return string Data for the target column
 */
	protected function createTextContentStream($settings, $data, $for)
	{
		if ($this->CurrentModel->Behaviors->attached('CsContentStreamHolder'))
		{
			$config = $this->CurrentModel->Behaviors->CsContentStreamHolder->settings[$this->CurrentModel->alias]['streams'][$for];
			if ($this->CurrentModel->{$config['assocName']}->createEmpty($config['type']))
			{
				$csId = $this->CurrentModel->{$config['assocName']}->id;
				if ($this->CurrentModel->{$config['assocName']}->CsItem)
				{
					$this->CurrentModel->{$config['assocName']}->CsItem->create();
					if (!$this->CurrentModel->{$config['assocName']}->CsItem->saveBurocrata(array(
					 	'CsItem' => array('cs_content_stream_id' => $csId, 'type' => 'pie_text'),
						'PieText' => array('text' => $this->column($settings, $data))
					)))
						$this->error('PieText could not be saved.');
				}
				return $csId;
			}
		}
		return '';
	}

/**
 * method description
 * 
 * @access public
 * @return type description
 */
	protected function createImagesContentStream($settings, $data, $for, $csId)
	{
		if ($this->CurrentModel->Behaviors->attached('CsContentStreamHolder'))
		{
			$config = $this->CurrentModel->Behaviors->CsContentStreamHolder->settings[$this->CurrentModel->alias]['streams'][$for];
			if (empty($csId))
			{
				$this->CurrentModel->{$config['assocName']}->createEmpty($config['type']);
				$csId = $this->CurrentModel->{$config['assocName']}->id;
			}
			
			if (!empty($csId) && $this->CurrentModel->{$config['assocName']}->CsItem)
			{
				$files = Set::classicExtract($data, $settings);
				foreach ($files as  $file)
				{
					if (!isset($file['Imagem'][0]['FileUpload']))
						continue;
					
					$title = $file['titulo'];
					$subtitle = $file['descricao'];
					$file_id = $this->lookupImg('', $file['Imagem'][0], 'PieImage.file_id');
					
					$this->CurrentModel->{$config['assocName']}->CsItem->create();
					if (!$this->CurrentModel->{$config['assocName']}->CsItem->saveBurocrata(array(
					 	'CsItem' => array('cs_content_stream_id' => $csId, 'type' => 'pie_image'),
						'PieImage' => compact('file_id', 'title', 'subtitle')
					)))
						$this->error('PieText could not be saved.');
				}
				return $csId;
			}
		}
		return '';
	}

/**
 * Usefull with belongsTo relationships: it seaches in the equivalence table for the new parent ID
 * 
 * Usage: "equivalence/ParentModel|old_column"
 * 
 * @access protected
 * @return string Data for the target column
 */
	protected function equivalence($settings, $data, $for)
	{
		list($model, $field) = explode('|', $settings);
		$id = $this->Equivalency->find('first', array(
			'conditions' => array(
				'id_old' => $this->column($field, $data),
				'model_old' => $model
			)
		));
		
		if (empty($id))
		{
			$this->out('Tried to locate the record where id_old = "'.$this->column($field, $data).'" AND model_old = "'.$model.'"');
			$this->error('It seems that you didn\'t run the migration for ' . $model . '. As an dependent model, you should run that migration before.');
		}
		return $id[$this->Equivalency->alias]['id_new'];
	}

/**
 * Create one textile entry and fills it up with specified column
 * 
 * Usage "createTextile/column_name"
 * 
 * @access protected
 * @return string Data for the target column
 */
	protected function createTextile($settings, $data)
	{
		$textile_data[$this->MexcTextileText->alias]['textile'] = $this->column($settings, $data);

		$this->MexcTextileText->create($textile_data);
		if (!$this->MexcTextileText->save())
			$this->error('Could not create a new Textile.');
		
		return $this->MexcTextileText->id;
	}

/**
 * Create one string composing with one or more columns and strings
 * 
 * Usage: "compoundColumns/&some_column_name|a string|&another_column_name|..."
 * 
 * @access protected
 * @return string Data for the target column
 */
	protected function compoundColumns($settings, $data)
	{
		$pieces = explode('|', $settings);
		$glued = '';
		foreach ($pieces as $piece)
		{
			if ($piece{0} == '&')
				$piece = $this->column(substr($piece,1), $data);
			$glued .= $piece;
		}
		
		return $glued;
	}

/**
 * Extracts data from a array using the path given and glues them with the glue.
 * 
 * Usage: "implode/some_glue_string|/path/to/data"
 * 
 * @access protected
 * @return string Data for the target column
 */
	protected function implode($settings, $data)
	{
		list($glue, $path) = explode('|', $settings);
		return implode($glue, Set::extract($data, $path));
	}
}
