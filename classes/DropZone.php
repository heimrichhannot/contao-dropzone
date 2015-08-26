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

class DropZone extends \FileUpload
{
	protected $arrData = array();

	protected $strTemplate = 'jquery.dropzone';

	public function __construct($arrAttributes)
	{
		parent::__construct();
		$this->arrData = $arrAttributes;
		$this->strName = $arrAttributes['name'];
	}

	/**
	 * Generate the markup for the default uploader
	 *
	 * @return string
	 */
	public function generateMarkup()
	{
		// Maximum file size in MB
		$this->maxFilesize = ($this->getMaximumUploadSize() / 1024 / 1024);

		// String of accepted file extensions
		$this->acceptedFiles = implode(
			',',
			array_map(
				function ($a) {
					return '.' . $a;
				},
				trimsplit(',', strtolower($this->extensions ? $this->extensions : \Config::get('uploadTypes')))
			)
		);

		$this->uploadMultiple = $this->fieldType == 'checkbox';

		return sprintf(
			'<div class="dropzone" id="ctrl_%s">
					<input type="hidden" name="action" value="fileupload">
					<div class="fallback"><input type="file" name="%s"%s></div>
					<div class="dz-container">
					<div class="dz-default dz-message">
					  <span class="dz-message-head">%s</span>
					  <span class="dz-message-body">%s</span>
					  <span class="dz-message-foot">%s</span>
					</div>
					<div class="dropzone-previews"></div>
				  </div></div>%s',
			$this->strName,
			$this->strName . ($this->uploadMultiple ? '[]' : ''),
			$this->uploadMultiple ? ' multiple' : '',
			$this->messageText[0], $this->messageText[1],$this->messageText[2],
			$this->parseJs()
		);
	}

	protected function parseJs()
	{
		$objT = new \FrontendTemplate($this->strTemplate);
		$objT->setData($this->arrData);
		$objT->id = '#ctrl_' . $this->strName;

		return $objT->parse();
	}


	/**
	 * Set an object property
	 *
	 * @param string
	 * @param mixed
	 */
	public function __set($strKey, $varValue)
	{
		$this->arrData[$strKey] = $varValue;
	}


	/**
	 * Return an object property
	 *
	 * @param string
	 *
	 * @return mixed
	 */
	public function __get($strKey)
	{
		switch ($strKey)
		{
			case 'name':
				return $this->strName;
			break;
		}



		if (isset($this->arrData[$strKey])) {
			return $this->arrData[$strKey];
		}

		return parent::__get($strKey);
	}


	/**
	 * Check whether a property is set
	 *
	 * @param string
	 *
	 * @return boolean
	 */
	public function __isset($strKey)
	{
		return isset($this->arrData[$strKey]);
	}
}
