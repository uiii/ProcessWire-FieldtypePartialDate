<?php

/**
 * ProcessWire Partial Date
 *
 * Class to hold info about parital date.
 * Specially used by FieldtypePartialDate.
 * 
 * Copyright (C) 2015 by Richard Jedlička <jedlicka.r@gmail.com> (http://uiii.cz)
 * 
 * ProcessWire 2.x 
 * Copyright (C) 2013 by Ryan Cramer 
 * Licensed under GNU/GPL v2, see LICENSE.TXT
 * 
 * http://processwire.com
 *
 */

class PartialDate extends Wire
{
	protected $data = array(
		'day' => null,
		'month' => null,
		'year' => null
	);

	protected $format = array(
		'YMD' => '%d %B %Y',
		'YM' => '%B %Y',
		'Y' => '%Y',
		'MD' => '%d %B',
		'M' => '%B',
		'D' => '%d',
	);

	public function __get($key) {
		return isset($this->data[$key]) ? $this->data[$key] : parent::__get($name);
	}

	public function __set($key, $value) 
	{
		// TODO check date validity

		if(array_key_exists($key, $this->data)) { 
			$this->data[$key] = $value; 
		}
	}

	public function setFormat($dateParts, $format)
	{
		if (array_key_exists($dateParts, $this->format)) {
			$this->format[$dateParts] = $format;
		}
	}

	public function __toString()
	{
		$month = 1;
		$day = 1;
		$year = 1970;

		$dateParts = "";

		if ($this->data['year']) {
			$dateParts .= 'Y';
			$year = $this->data['year'];
		}

		if ($this->data['month']) {
			$dateParts .= 'M';
			$month = $this->data['month'];
		}

		if ($this->data['day']) {
			$dateParts .= 'D';
			$day = $this->data['day'];
		}

		return strftime($this->format[$dateParts], mktime(0, 0, 0, $month, $day, $year));
	}
}