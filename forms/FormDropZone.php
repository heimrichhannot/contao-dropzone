<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2015 Heimrich & Hannot GmbH
 *
 * @package dropzone
 * @author  Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

namespace HeimrichHannot\DropZone;

class FormDropZone extends \Upload
{
	/**
	 * Dropzone fields
	 */
	protected $arrDropzones = array('client_logo');

	/**
	 * Upload path
	 */
	protected $varDropzoneUploadPath = '/files/jobmarket/uploads/';

	/**
	 * Initialize the FileUpload object
	 * @param array
	 */
	public function __construct($arrAttributes=null)
	{
		$GLOBALS['TL_CSS']['dropzone'] = 'assets/dropzone/' . $GLOBALS['TL_ASSETS']['DROPZONE'] . '/css/dropzone.min.css';

		// Dropzone Upload
		if(!empty($_FILES))
		{
			foreach($_FILES as $key => $file)
			{
				if(!$file['error'] && in_array($key, $this->arrDropzones))
				{
					$tempFile = $_FILES[$key]['tmp_name'];
					$targetPath = TL_ROOT . $this->varDropzoneUploadPath;
					$targetFile =  $targetPath . $_FILES[$key]['name'];
					move_uploaded_file($tempFile,$targetFile);
					$_SESSION['FILES'][$key] = $file;
					$_SESSION['FILES'][$key]['tmp_name'] = $targetFile;
					$_SESSION['FILES'][$key]['uploaded'] = 1;
				}
			}
		}

		$this->objUploader = new DropZone($arrAttributes);
		$this->objUploader->setName($this->strName);
	}
	
}