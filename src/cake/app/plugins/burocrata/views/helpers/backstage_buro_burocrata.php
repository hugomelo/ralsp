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

/**
 * Version of Burocrata Helper for backstage
 *
 * PHP versions 5
 *
 * @package       jodel
 * @subpackage    jodel.burocrata.views.helpers
 */
 
/**
 * Importing of main burocrata class.
 */
App::import('Helper', 'Burocrata.BuroBurocrata');

/**
 * Version of Burocrata Helper for backstage
 *
 * PHP versions 5
 *
 * @package       jodel
 * @subpackage    jodel.burocrata.views.helpers
 */
class BackstageBuroBurocrataHelper extends BuroBurocrataHelper
{
/**
 * Creates an input for related contents
 * 
 * @access public
 * @return string Input HTML + JS
 */
	public function inputMexcRelatedContent($attr = array(), $options = array(), $content = '')
	{
		$View = ClassRegistry::getObject('view');
		$fullModelName = $View->getVar('fullModelName');
		list($modelPlugin, $modelName) = pluginSplit($fullModelName);
		
		$js = "var ac = BuroCR.get(form.form.down('input.autocomplete').id.replace('input', ''));";
		$js.= "ac.autocompleter.options.defaultParams += '&data[_b][autocomplete][MexcRelatedContent][model]=$fullModelName';";
		$js.= "ac.createChoices = function(){";
		$js.= "  var ul = new Element('ul');";
		$js.= "  this.foundContent.each(function(ul,pair){";
		$js.= "    ul.insert(new Element('li').insert(pair.value.displayField));";
		$js.= "  }.bind(this, ul));";
		$js.= "  ul.insert(new Element('li').hide());";
		$js.= "  return ul;";
		$js.= "};";
		$js.= "ac.addCallbacks({onSelect: function(input, pair, element){";
		$js.= "  ac.input.hide().up().select('div.mexc_related').invoke('remove');";
		$js.= "  ac.input.insert({after: new Element('div', {className: 'mexc_related'}).update(pair.value.displayField)});";
		$js.= "  var form = ac.input.up('.buro_form');";
		$js.= "  form.down('input[name*=\'[model]\']').value = '$fullModelName';";
		$js.= "  form.down('input[name*=\'[foreign_key]\']').value = '{$View->data[$modelName]['id']}';";
		$js.= "  form.down('input[name*=\'[related_model]\']').value = pair.value.model;";
		$js.= "  form.down('input[name*=\'[related_foreign_key]\']').value = pair.value.content_id;";
		$js.= "}});";
		$js.= "";
	
		return $this->input(
			array(),
			array(
				'type' => 'relational',
				'label' => __d('mexc_new', 'form - related content label', true),
				'instructions' => __d('mexc_new', 'form - related content instructions', true),
				'options' => array(
					'type' => 'manyChildren',
					'model' => 'MexcRelated.MexcRelatedContent',
					'allow' => array('add', 'delete'),
					'callbacks' => array(
						'onShowForm' => compact('js'),
					),
					'texts' => array(
						'confirm' => array(
							'delete' => __d('mexc_related', 'confirm dissociate', true)
						),
						'title' => __d('mexc_related', 'mexc_related title', true)
					)
				)
			)
		);
	}

/**
 * 
 * 
 * @access public
 * @return string The HTML
 */
	function inputMexcEvent($options = array())
	{
		return $this->input(
			array(),
			array(
				'type' => 'relational',
				'container' => false,
				'label' => __d('mexc', 'Associação com evento', true),
				'instructions' => __d('mexc', 'Caso queira associar esta novidade a algum evento cadastrado, procure o evento desejado pelo nome e o adicione, senão simplesmente deixe em branco esta opção.', true),
				'options' => array(
					'type' => 'unitary_autocomplete',
					'model' => 'MexcEvents.MexcEvent',
					'allow' => array('relate'),
					'texts' => array(
						'reset_item' => __d('mexc','Desfazer relação com evento', true),
						'undo_reset' => __d('mexc','Voltar com o último evento escolhido', true)
					)
				)
			) + $options
		);
	}


/**
 * Creates a textile input that saves on related model.
 * (Works only if used with saveAll)
 * 
 * @access public
 * @param array $options
 * @return string The HTML for an textile input and an id (for the textile record)
 */
	function inputRelatedTextile($options = array())
	{
		$options += array('options' => array());
		extract($options['options']);
		unset($options['assocName']);
		
		if (!$assocName) {
			trigger_error('BackstageBuroBurocrataHelper::relatedTextile - Related model not set on given options [options][model]');
			return false; 
		}
		
		// Usually the Cake core will display a "missing table" or "missing connection"
		// if something went wrong on registring the model
		$ParentModel =& ClassRegistry::init($this->modelPlugin . '.' . $this->modelAlias);
		// But won't hurt test if went ok
		if (!$ParentModel) {
			trigger_error('BackstageBuroBurocrataHelper::relatedTextile - Parent model could not be found.');
			return false;
		}
		
		$availables = array_keys($ParentModel->belongsTo);
		if (!in_array($assocName, $availables) ) {
			trigger_error('BackstageBuroBurocrataHelper::relatedTextile - Related model doesn\'t make a unitary relationship. Given \''.$assocName.'\', but availables are: \''.implode('\', \'', $availables).'\'');
			return false;
		}
		
		$TextileModel = $ParentModel->{$assocName};
		
		$out = $this->input(
			array(),
			array(
				'type' => 'hidden',
				'fieldName' => $TextileModel->alias . '.' . $TextileModel->primaryKey
			)
		);
		
		$options['type'] = 'textile';
		$options['container'] = false;
		$options['fieldName'] = $TextileModel->alias . '.textile';
		
		$out .= $this->input(
			array(),
			$options
		);
		
		return $out;
	}

/**
 * Create a input to relate a record to an mexc_space
 * 
 * @access public
 * @param array $options
 * @return string An unitary_autocomplete input
 */
	function inputMexcSpace($options = array())
	{
		return $this->sinput(
			array(),
			array(
				'type' => 'relational',
				'label' => __d('mexc', 'Publicação em projeto', true),
				'error' => __d('mexc', 'Escolha se quer publicar dentro de um projeto ou deixe em branco para nenhum', true),
				'instructions' => 'Escolha se quer publicar dentro de um projeto ou deixe em branco para nenhum',
				'container' => false,
				'options' => array(
					'type' => 'unitaryAutocomplete',
					'model' => 'MexcSpace.MexcSpace',
					'allow' => array('relate'),
					'texts' => array(
						'nothing_found' => __d('mexc', 'Nem projeto não encontrado', true),
						'reset_item' => __d('mexc', 'Buscar um novo projeto', true),
						'undo_reset' => __d('mexc', 'Usar o último projeto selecionado', true)
					)
				)
			)
		);
	}

/**
 * Creates a box containing a submit button, a cancel link and some publising controls
 * 
 * @access public
 * @todo Use return intead using echo
 */
	function submitBox($htmlAttributes = array(), $options = array())
	{
		$defaultHtmlAttr = array(
			'class' => array('save_box')
		);
		$defaultOptions = array(
			'submitLabel' => __d('backstage','Save', true),
			'cancelLabel' => __d('backstage','Save box: cancel this change.',true),
			'publishControls' => false,
			'cancelUrl' => array('plugin' => 'dashboard', 'controller' => 'dash_dashboard')
		);
		$htmlAttributes = $this->_mergeAttributes($defaultHtmlAttr, $htmlAttributes);
		$options = am($defaultOptions, $options);
		
		echo $this->Bl->scontrolBox($htmlAttributes);

			if ($options['publishControls'])
			{
				$tmp = $this->Bl->anchorList(array(),array(
						'lastSeparator' => __('anchorList or', true),
						'linkList' => array(
							array('name' => __d('backstage','mark it as ready',true), 'url' => "#"),
							array('name' => __d('backstage','remove it',true), 'url' => "#")
						)
					)
				);
				echo $this->Bl->p(array('class' => 'small_text'), array('escape' => false),
						sprintf(__d('backstage','Version marked as draft. You can %s.',true), $tmp));
			}	
			echo $this->submit(array(), array('label' => $options['submitLabel']));
			
			echo $this->Bl->sp(array('class' => 'alternative_option'), array());
				echo ', ';
				echo __('anchorList or',true);
				echo ' ';
				echo $this->Bl->anchor(array(),array('url' => $options['cancelUrl']),$options['cancelLabel']);
			echo $this->ep();
			echo $this->Bl->floatBreak();
		echo $this->Bl->econtrolBox();
	}
}
