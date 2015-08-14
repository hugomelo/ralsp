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
/*

SELECT *, MATCH (`title`, `tags_text`, `subtitle`, `summary`, `content`, `themes`) AGAINST ('papa') AS relevance 
FROM sbl_search_items WHERE MATCH (`title`, `tags_text`, `subtitle`, `summary`, `content`, `themes`) AGAINST ('papa' IN BOOLEAN MODE) 
ORDER BY relevance DESC;

*/

class UnifiedSearchShell extends Shell
{
	function main()
	{
		$this->args = array();
		$this->out();
		$this->out('Usage:');
		$this->out('./cake unified_search synch');
		$this->out('./cake unified_search synch force-update');
		$this->out();
	}
	
	function synch()
	{
		$force_update = false;
		if (isset($this->args[0]) && $this->args[0] == 'force-update')
			$force_update = true;

		$models = Configure::read('UnifiedSearch.models');
		
		foreach ($models as $model)
		{
			$this->out('Synching search itens for ' . $model);

			$Model =& ClassRegistry::init($model);
			if (!$Model->Behaviors->attached('Searcheable'))
			{
				$this->out("  {$model} has not Searcheable behavior attached!");
				$this->out('Synch failed');
			}
			else
			{
				extract($Model->synchronizeWithSearchItems($force_update));
				$this->out("  Removed entries: " . count($childless));
				$this->out("  Updated entries: " . count($outdated));
				$this->out("  Created entries: " . count($doesnt_have));
				$this->out('Synch done.');
			}

			$this->out();
		}
	}
}
