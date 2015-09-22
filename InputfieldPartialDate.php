<?php

/**
 * ProcessWire Partial Date Inputfield
 *
 * Provides input for partial date
 * 
 * Copyright (C) 2015 by Richard Jedlička <jedlicka.r@gmail.com> (http://uiii.cz)
 *
 * ProcessWire 2.x 
 * Copyright (C) 2012 by Ryan Cramer 
 * Licensed under GNU/GPL v2, see LICENSE.TXT
 * 
 * http://www.processwire.com
 * http://www.ryancramer.com
 *
 */

class InputfieldPartialDate extends Inputfield
{
	public static function getModuleInfo() {
		return array(
			'title' => __('Partial Date', __FILE__), // Module Title
			'summary' => __('Inputfield that accepts partial date', __FILE__), // Module Summary
			'version' => 001
		);
	}

	public function ___render()
	{
		$years = array(null => __("year")) + range(2030, 1970);
		return $this->renderSelect($years);
	}

	protected function renderSelect($options)
	{
		$attrs = $this->getAttributes();
		unset($attrs['value']); 

		$out = "\n<select " . $this->getAttributesString($attrs) . ">";

		foreach ($options as $value => $label) {
			if (is_numeric($value)) {
				$value = $label;
			}

			$out .= "\n\t<option value=" . $value . ">" . $label . "</option>";
		}
		
		$out .= "\n</select>";

		return $out; 
	}
}