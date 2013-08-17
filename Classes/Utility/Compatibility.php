<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Nicole Cordes <cordes@cps-it.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * @author Nicole Cordes <cordes@cps-it.de>
 * @package TYPO3
 * @subpackage wt_twitter
 */
final class Tx_WtTwitter_Utility_Compatibility {

	/**
	 * Returns parsed representation of XML file.
	 *
	 * @param string $sourcePath Source file path
	 * @param string $languageKey Language key
	 * @param string $charset Charset
	 *
	 * @return array
	 */
	public static function readLLXMLfile($sourcePath, $languageKey, $charset = '') {
		if (class_exists('t3lib_l10n_parser_Llxml')) {
			$parser = t3lib_div::makeInstance('t3lib_l10n_parser_Llxml');

			return $parser->getParsedData($sourcePath, $languageKey, $charset);
		} elseif (class_exists('t3lib_div')) {
			return t3lib_div::readLLXMLfile($sourcePath, $languageKey, $charset);
		}

		return array();
	}

	/**
	 * Tests if the input can be interpreted as integer.
	 *
	 * @param $var mixed Any input variable to test
	 *
	 * @return boolean Returns TRUE if string is an integer
	 */
	public static function testInt($var) {
		if (class_exists('t3lib_utility_Math')) {
			return t3lib_utility_Math::canBeInterpretedAsInteger($var);
		} elseif (class_exists('t3lib_div')) {
			return t3lib_div::testInt($var);
		}

		return FALSE;
	}
}