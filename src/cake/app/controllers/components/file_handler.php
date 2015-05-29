<?php
/**
 * $Id: file_handler.php 37 2007-01-09 02:39:06Z thepaper $
 * ========================================================================
 * file handler component for uploading files using cake
 *
 * @author  Jack Pham (www.reversefolds.com)
 *          copyright (c) 2007
 *
 * License: MIT
 * Based on code by Chris Partridge
 * (cakeforge.org/snippet/detail.php?type=snippet&id=36)
 *
 * Please send any bugfixes/modifications to jack@reversefolds.com
 * ========================================================================
 */
 

 
class FileHandlerComponent extends Object
{

	var $_filesInfo = array();          // transfored $_FILES array
	var $_lastUploadData = array();     // upload information
	var $_missingCount = 0;             // missing files from upload
	var $isError = false;       
	var $errorMessage = '';
	var $controller;

	// ----------------------------------------
	// the following members can be set through 
	// appropriate mutator methods
	// ----------------------------------------
	/** number of required upload files */
	var $_required = 1;

	/** maxium file size allowed in kb */
	var $_maxSize = 30000;

	/** 0 = friendlier error messages
	 *  1 = more specific 
	 */
	var $_debugLevel = 1;

	/** 
	 * set the default handler type to array
	 * valid values are array or db
	 */
	var $_handlerType = 'array';

	/** sub directory prefix - required for
	 *  uniqid() php versions < 5 */
	var $_prefix = 'rf';

	/**
	 * You can specify a different model to store the file 
	 * upload information. You need to create the correct model
	 * file and database table for this to work correctly.
	 */
	var $_dbModel = 'FileUpload';
	
	/** 
	 * initial database field names
	 * use setDbFields to append extra fields 
	 * (be careful with conflicting field names, since array_merge will overwrite)
	 */
	var $_dbFields = array( 
						   'file_name'	=> 'file_name', // The file name it was saved with
						   'mime_type'	=> 'mime_type', // The mime type of the file
						   'file_size'	=> 'file_size', // The size of the file
						   'subdir'	    => 'subdir'     // subdirectory uploaded to
					 );

	/**
	 * This array stores all allowed mime types, a mime type
	 * determines the type of file.
	 *
	 * The specified mime types below should be safe for uploads,
	 * however the compressed formats could be a touch unsafe.
	 *
	 * This can be overwritten by setAllowedMime()
	 */		   
	var $_allowedMime = array( 
							  'image/jpeg',                     // images
							  'image/pjpeg', 
							  'image/png', 
							  'image/gif', 
							  'image/tiff', 
							  'image/x-tiff', 

							  'application/pdf',                // pdf
							  'application/x-pdf', 
							  'application/acrobat', 
							  'text/pdf',
							  'text/x-pdf', 

							  'text/plain',                     // text
							  
							  'application/vnd.oasis.opendocument.text', 			 // open office
							  'application/vnd.oasis.opendocument.spreadsheet',
							  'application/vnd.oasis.opendocument.graphics',
							  'application/vnd.oasis.opendocument.presentation',
							  'application/vnd.oasis.opendocument.formula',
							  
							  
							  
							  'video/quicktime', 				// video e mp3
							  'video/x-sgi-movie',
							  'video/mpeg',
							  'audio/mpeg',
							  'video/x-msvideo',
							  'video/x-ms-asf',
							  'video/x-ms-wmp',
							  'video/x-ms-wmv',
							  'video/x-ms-wmx',
							  'video/x-ms-wm',
								
							  
							  'application/msword',             // word
							  
							  'application/mspowerpoint',       // powerpoint
							  'application/powerpoint',
							  'application/vnd.ms-powerpoint',
							  'application/x-mspowerpoint',

							  'application/x-msexcel',          // excel
							  'application/excel',
							  'application/x-excel',

							  'application/x-compressed',       // compressed files
							  'application/x-zip-compressed',
							  'application/zip',
							  'multipart/x-zip',
							  'application/x-tar',
							  'application/x-compressed',
							  'application/x-gzip',
							  'application/x-gzip',
							  'multipart/x-gzip'
					   );


	/**
	 * component statup
	 */
	function startup(&$controller) {

		$this->controller=&$controller;

	}//startup()

	/**
	 * upload files
	 * uses uniqid() to generate subdirectory name
	 *
	 * @param string field name
	 * @param string directory
	 */
	function upload($fieldName, $dir, $tipo, $id = null) {

		
		if ($this->isError) {
			return false;
		}

		// check that the upload field exists
		if (!isset($_FILES[$fieldName])) {
			return false; 
		}

		// convert $_FILES array
		$this->_filesInfo = $this->_convertFilesArray($fieldName);

		// do some error checking
		if ($this->_validateUpload($this->_filesInfo, $dir)) {

			// make sure supplied dir ends with a DS
			if ($dir[(strlen($dir)-1)] != DS) {
				$dir .= DS;
			}

			// generate unique id for subdirectory
			$dir .= uniqid($this->_prefix) . DS;

			// create a folder for the file
			if (!mkdir($dir)) {

				$this->_setError('The folder ('.$dir.') for the file upload could not be created.');
				if ($this->_debugLevel == 0) {
					$this->_setError('There was an error uploading.  Please try again.');
				}

				return false;

			} else {

				// try uploading file(s)
				foreach ($this->_filesInfo as $file) {

					// skip any empty file uploads
					if (($file['error'] != 4) && (!$this->_uploadFile($file, $dir, $tipo, $id))) {
						return false;
					}
				}
			}

		} else {
			// invalid file(s)
			return false;
		}

		return true;

	}//upload()

	/**
	 * get last upload data
	 */
	function getLastUploadData() {

		if(empty($this->_lastUploadData)) {

			$this->_setError('No upload detected.');

		} else {
			return $this->_lastUploadData;
		}

	}//getLastUploadData()


	/** 
	 * check if number of uploaded files is less 
	 * than any required files 
	 *
	 * @param int missing files
	 *
	 * @return bool
	 */
	function _missingFiles($missing) {

		if ($this->_required > 0) {

			$totalUploaded = count($this->_filesInfo) - $missing;
	
			if ($this->_required > $totalUploaded) {

				$errMsg = $totalUploaded . ' of ' . $this->_required . ' required file(s) uploaded';
				$this->_setError($errMsg);
				return true;
			}
	
		}

		return false;
   
	}//_missingFiles()


	/**
	 * perform error checking on a list of files to upload
	 *
	 * @param array files
	 * @param string base directory to upload to
	 */
	function _validateUpload($files, $dir) {

		// check that the two method variables are set
		if (empty($files) || empty($dir)) {

			$this->_setError('You must supply a list of files and a directory on the server');
			return false;
		}

		// check given directory is writable
		if (!is_dir($dir) || !is_writable($dir)) {

			$this->_setError('The supplied upload directory does not exist or is not writable.');
			return false;
		}

		// check each file is valid
		foreach ($files as $file) {

			if (!$this->_validFile($file)) {

				return false;
			}
		}

 
		// check if number of uploaded files is less than
		// the number of $required files
		if ($this->_required > 0) {

			if ($this->_missingFiles($this->_missingCount)) {
				return false;
			}
	
		}

		return true;

	}//_validateUpload()


	/**
	 * check individual file for errors
	 *
	 * @param array formatted as a single $_FILES
	 */
	function _validFile($file) {

		$missingFiles = 0;

		$errorCode = $file['error'];

		if ($errorCode != 0) {

			switch ($errorCode) {

				case 1:
					$this->_setError('The file is too large (server)');
					if ($this->_debugLevel == 0) {
						$this->_setError('The file is too large to upload.  Please try again.');
					} 
					break;

				case 2:
					$this->_setError('The file is too large (form)');
					if ($this->_debugLevel == 0) {
						$this->_setError('The file is too large to upload.  Please try again.');
					} 
					break;

				case 3:
					$this->_setError('The file was only partially uploaded.  Please try again.');
					break;

				case 4:
					// only update count of missing files here
					// actual error checking on missing files will be done
					// in validateUpload method
					$this->_missingCount++;
					break;

				case 5:
					$this->_setError('The server\'s temporary folder is missing.');
					if ($this->_debugLevel == 0) {
						$this->_setError('There was an error uploading.  Please try again.');
					} 
					break;

				case 6:
					$this->_setError('Failed to write to temporary folder.');
					if ($this->_debugLevel == 0) {
						$this->_setError('There was an error uploading.  Please try again.');
					} 
					break;

			}


			// since uploading is potentially optional by the 
			// $required flag, skip checking missing file here 
			if (($errorCode != 0) && ($errorCode != 4)) {
				return false;
			}

		}

		// perform further checks if file exists
		if ($errorCode != 4) {

			// Check that the file is of a legal mime type
			/*if (!in_array($file['type'], $this->_allowedMime)) {

				$this->_setError('The file upload is of an illegal mime type.');

				if ($this->_debugLevel == 0) {
					$this->_setError('The file attempting to be uploaded is not allowed.  Please try again.');
				}
				return false;
			}*/

			// check that the file is smaller than the maximum file size ($_maxSize)
			if ((filesize($file['tmp_name'])/1024) > $this->_maxSize) {

				$this->_setError('The file is too large (application)');

				if ($this->_debugLevel == 0) {
					$this->_setError('The file is too large to upload.  Please try again.');
				} 

				return false;
			}
		}
		
		return true;
	
	}//_validFile()


	/**
	 * upload a single file
	 *
	 * @param array file info
	 */
	function _uploadFile($file, $dir, $tipo, $id=null) {

		$fileId = 0; // database id

		// update database if using db handler
		if ($this->_handlerType == 'db') {

			// set row values
			
			
			$this->_dbFields['file_name'] = basename($file['name']);
			$this->_dbFields['mime_type'] = $file['type'];
			$this->_dbFields['file_size'] = filesize($file['tmp_name'])/1024;
			$this->_dbFields['subdir'] = basename($dir);

			// Create database update array
			$fileDetails = array($this->_dbModel => $this->_dbFields);

			// prepare model for insertion
			$this->controller->{$this->_dbModel}->create();

			// Update database, set error on failure	
			$this->controller->{$this->_dbModel}->id = false;
			if (!$this->controller->{$this->_dbModel}->save($fileDetails)) {
			
				$this->_setError('There was an error with the database, please try again');
				return false;
			}
			else //pega ultimo id
			{
				$fileId = $this->controller->{$this->_dbModel}->id;
			}
		}
		$tipo_arquivo = '';
		if ($tipo == 'imagem' || $tipo == 'arquivo')
		{
			//pega informacoes
			$extensao = strtoupper(array_pop(explode('.', $file["name"])));
			switch(strtolower($extensao)){
				case "gif":
				case "png":
				case "jpeg":
					$tipo_arquivo = 'imagem';
				break;
				
				case "jpg":
					$extensao = "JPEG";
					$tipo_arquivo = 'imagem';
				break;
				
				case "doc":
				case "docx":
				case "odt":
				case "pdf":
				case "txt":
					$tipo_arquivo = 'documento';
				break;
				
				case "xls":
				case "xlsx":
				case "ods":
				case "sxc":
					$tipo_arquivo = 'planilha';
				break;
				
				case "ppt":
				case "pps":
					$tipo_arquivo = 'apresentacao';
				break;
				
				case "avi":
				case "mpg":
				case "mpeg":
				case "asf":
				case "flv":
				case "wmv":
					$tipo_arquivo = 'video';
				break;
				
				default:
					$tipo_arquivo = 'outro';
			}
			
			// vetor -> [0] => largura, [1] => altura
			if ($tipo == 'imagem') 
			{
				$tamanhos = getimagesize($file["tmp_name"]);
				$tamanho_arquivo = (filesize($file['tmp_name'])/1024);
			}
		}

		// move uploaded file to new directory
		if (!move_uploaded_file($file['tmp_name'], $dir . basename($file['name']))) {

			// remove database record
			$this->controller->{$this->_dbModel}->delete($fileId);
			
			$this->_setError('The uploaded file could not be moved to the new directory (' . $dir . ')');
			if ($this->_debugLevel == 0) {
				$this->_setError('There was an error uploading.  Please try again.');
			}
			return false;
		}

		// Set the data for the lastUploadData variable
		$uploadData = array
		(
			'id'		=> '',
			'imagem_id'	=> '',
			'arquivo_id' => '',
			'dir'	    => $dir,
			'file_name'	=> basename($file['name']),
			'mime_type'	=> $file['type'],
			'tipo_arquivo' => $tipo_arquivo,
			'file_size'	=> (filesize($dir . basename($file['name']))/1024)
		);

		// Add the id if using db
		if($this->_handlerType == 'db') {
			$uploadData['id'] = $fileId;
			
			//adiciona na tabela de imagens
			if ($tipo == 'imagem')
			{
				//adiciona imagem
				$dados_imagem = array
				(
					'nome_arquivo' => $uploadData['file_name'],
					'formato' => $extensao,
					'largura' => $tamanhos[0],
					'altura' => $tamanhos[1],
					'tamanho' => $tamanho_arquivo,
					'file_upload_id' => $fileId
				);
				
				// guarda a imagem no banco de dados e coloca o campo qual_imagem corretamente.
				$this->controller->Imagem->id = false;
				$this->controller->Imagem->save($dados_imagem); 
				$id_imagem = $this->controller->Imagem->id;
				$imagem = $this->controller->Imagem->findById($id_imagem);
				$imagem['Imagem']['qual_imagem'] = $id_imagem;
				$this->controller->Imagem->save($imagem);
				
				$uploadData['imagem_id'] = $id_imagem;
			}
			
			//adiciona na tabela de versoes de arquivos
			if ($tipo == 'arquivo')
			{
				//adiciona arquivo
				$dados_arquivo = array
				(
					'arquivo' => $uploadData['file_name'],
					'extensao' => $extensao,
					'tipo_arquivo' => $tipo_arquivo,
					'file_upload_id' => $fileId,
					'arquivo_id' => $id
				);
				
				
				$this->controller->Versao->deleteAll(array('arquivo_id' => $id));
				
				// guarda o arquivo no banco de dados
				$this->controller->Versao->id = false;
				$this->controller->Versao->save($dados_arquivo); 
				$id_arquivo = $this->controller->Versao->id;
				
				$uploadData['arquivo_id'] = $id_arquivo;
			}
		}

		$this->_lastUploadData[] = $uploadData;

		return true;
			
	}//_uploadFile()
	

	/**
	 * convert the $_FILES array for simpler processing
	 * 
	 * @param array $_FILES
	 */
	function _convertFilesArray($fieldName) {

		$arr = array();

		while (list($key, $value) = each($_FILES[$fieldName]['name'])) {
			$var = $value;
			$var = ereg_replace("[ÁÀÂÃ]","A",$var);
			$var = ereg_replace("[áàâãª]","a",$var);
			$var = ereg_replace("[ÉÈÊ]","E",$var);
			$var = ereg_replace("[éèê]","e",$var);
			$var = ereg_replace("[ÓÒÔÕ]","O",$var);
			$var = ereg_replace("[óòôõº]","o",$var);
			$var = ereg_replace("[ÚÙÛÜ]","U",$var);
			$var = ereg_replace("[úùûü]","u",$var);
			$var = str_replace("Ç","C",$var);
			$var = str_replace("ç","c",$var);
			
			$arr[] = array(
				'name' => $var,
				'type' => $_FILES[$fieldName]['type'][$key],
				'tmp_name' => $_FILES[$fieldName]['tmp_name'][$key],
				'error' => $_FILES[$fieldName]['error'][$key],
				'size' => $_FILES[$fieldName]['size'][$key]
			);
			
		}

		return $arr;

	}//_convertFilesArray()
   

	/**
	 * set error message, set $isError to true
	 *
	 * @param string error message
	 */
	function _setError($error) {

		$this->isError = true;
		$this->errorMessage = $error;

	}//_setError()

	/* ==============================================================
	 * the following methods allow user configuration, 
	 * overwritting default values where applicable
	 * ============================================================== */

	/**
	 * set debug level
	 *
	 * @param int 1 = debug error messages
	 *            0 = user-friendly 
	 */
	function setDebugLevel($debug) {

		$this->_debugLevel = $debug;

	}//setDebug()

	/**
	 * set allowed mime types
	 * 
	 * @param array
	 */
	function setAllowedMime($mimeTypes) {

		$this->_allowedMime = $mimeTypes;

	}//setAllowedMime()

	/**
	 * set maximum file size
	 *
	 * @param int filesize in KB
	 */
	function setMaxSize($size) {

		$this->_maxSize = $size;

	}//setMaxSize()

	/**
	 * set handler type
	 *
	 * @param string 'db' or 'array'
	 */
	function setHandlerType($type) {

		if (!in_array($type, array('db', 'array'))) {
			$this->_setError('The specified handler type is invalid.  Please use "db" or "array"');
		} else {
			$this->_handlerType = $type;
		}

	}//setHandlerType()

	/**
	 * append user-defined database fields
	 * the values should already be set when calling
	 * be careful with naming conflicts since this uses array_merge and may overwrite
	 *
	 * @param array database field names => value
	 */
	function addDbFields($dbFields) {

		$this->_dbFields = array_merge($this->_dbFields, $dbFields);

	}//addDbFields()

	/**
	 * set database model name
	 *
	 * @param str name
	 */
	function setDbModel($name) {

		$this->_dbModel = $name;

	}//setDbModel()

	/**
	 * set number of required uploads
	 *
	 * @param int required uploads
	 */
	function setRequired($required) {

		$this->_required = $required;

	}//setRequired()

	/**
	 * set a prefix for subdirectory names
	 *
	 * @param string prefix
	 */
	function setPrefix($prefix) {

		$this->_prefix = $prefix;

	}//setPrefix()

}//FileHandlerComponent
?>
