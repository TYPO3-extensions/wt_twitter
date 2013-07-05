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
final class Tx_WtTwitter_Twitter_Api {

	const consumerKey = '2G3ws4mSXwMLmiKX3erUA';

	const consumerSecret = 'XgMWWvWa3HPNkGKiZUrYMOqfqGyw9sCdyG9Rc2Rzw';

	/**
	 * @return string
	 */
	public static function getAccessTokenUrl() {
		return 'https://api.twitter.com/oauth/access_token';
	}

	/**
	 * @return string
	 */
	public static function getAuthorizeUrl() {
		return 'https://api.twitter.com/oauth/authorize';
	}

	/**
	 * @return string
	 */
	public static function getRequestTokenUrl() {
		return 'https://api.twitter.com/oauth/request_token';
	}

	/**
	 * @return string
	 */
	public static function getSearchTweetsUrl() {
		return 'https://api.twitter.com/1.1/search/tweets.json';
	}

	/**
	 * @return string
	 */
	public static function getUserTimelineUrl() {
		return 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	}

	/**
	 * @param string $oAuthToken
	 * @param array $additionalParameter
	 *
	 * @return array
	 */
	public static function getOAuthParameter($oAuthToken, array $additionalParameter = array()) {
		$oAuthParameter = array(
			'oauth_consumer_key' => self::consumerKey,
			'oauth_nonce' => md5(microtime() . mt_rand()),
			'oauth_signature_method' => 'HMAC-SHA1',
			'oauth_timestamp' => time(),
			'oauth_token' => $oAuthToken,
			'oauth_version' => '1.0'
		);

		return array_merge($oAuthParameter, $additionalParameter);
	}

	/**
	 * @param array $oAuthParameter
	 * @param string $url
	 * @param string $method
	 * @param string $consumerSecret
	 * @param string $oAuthTokenSecret
	 * @param array $additionalParameter
	 *
	 * @return array
	 */
	public static function createSignature(array $oAuthParameter, $url, $method, $consumerSecret, $oAuthTokenSecret, array $additionalParameter = array()) {
		$encodedParameter = array();
		$parameter = array_merge($oAuthParameter, $additionalParameter);
		foreach ($parameter as $key => $value) {
			$encodedParameter[rawurlencode($key)] = rawurlencode($value);
		}
		unset($key, $value);
		ksort($encodedParameter);

		$requestParts = array();
		foreach ($encodedParameter as $key => $value) {
			$requestParts[] = $key . '=' . $value;
		}
		unset($key, $value);

		$parameterString = implode('&', $requestParts);

		$signatureBaseString = strtoupper($method) . '&' . rawurlencode($url) . '&' . rawurlencode($parameterString);
		$signingKey = rawurlencode($consumerSecret) . '&' . rawurlencode($oAuthTokenSecret);

		$oAuthParameter['oauth_signature'] = base64_encode(hash_hmac('sha1', $signatureBaseString, $signingKey, TRUE));

		return $oAuthParameter;
	}

	/**
	 * @param array $parameterArray
	 *
	 * @return string
	 */
	public static function implodeArrayForHeader(array $parameterArray) {
		$parts = array();
		foreach ($parameterArray as $key => $value) {
			$parts[] = $key . '="' . rawurlencode($value) . '"';
		}

		return implode(', ', $parts);
	}

	/**
	 * @param array $parameterArray
	 *
	 * @return string
	 */
	public static function implodeArrayForUrl(array $parameterArray) {
		$parts = array();
		foreach ($parameterArray as $key => $value) {
			$parts[] = $key . '=' . rawurlencode($value);
		}

		return implode('&', $parts);
	}

	/**
	 * @param string $oAuthToken
	 * @param string $oAuthTokenSecret
	 * @param string $query
	 * @param string $count
	 *
	 * @return array
	 */
	public static function getTweetsFromSearch($oAuthToken, $oAuthTokenSecret, $query, $count) {
		$tweets = array();
		$parameter = array(
			'q' => $query,
		);

		$url = self::getSearchTweetsUrl();

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_URL, $url . '?' . Tx_WtTwitter_Twitter_Api::implodeArrayForUrl($parameter));

		$oAuthParameter = Tx_WtTwitter_Twitter_Api::createSignature(
			Tx_WtTwitter_Twitter_Api::getOAuthParameter(
				$oAuthToken
			),
			$url,
			'GET',
			Tx_WtTwitter_Twitter_Api::consumerSecret,
			$oAuthTokenSecret,
			$parameter
		);

		$header = array(
			'Authorization: OAuth ' . self::implodeArrayForHeader($oAuthParameter),
			'Content-Length:',
			'Content-Type:',
			'Expect:'
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		$response = curl_exec($ch);
		if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200) {
			$responseObject = json_decode($response);
			$tweets = $responseObject->statuses;
			$tweets = array_slice($tweets, 0, $count);
			foreach ($tweets as &$value) {
				$value->profile_image_url = $value->user->profile_image_url;
				$value->from_user = $value->user->screen_name;
			}
			unset($value);

		}
		curl_close($ch);

		return $tweets;
	}

	/**
	 * @param string $oAuthToken
	 * @param string $oAuthTokenSecret
	 * @param string $screenName
	 * @param integer $showRetweets
	 * @param string $count
	 *
	 * @return array
	 */
	public static function getTweetsFromUserTimeline($oAuthToken, $oAuthTokenSecret, $screenName, $showRetweets, $count) {
		$tweets = array();
		$parameter = array();
		if (Tx_WtTwitter_Utility_Compatibility::testInt($screenName)) {
			$parameter['user_id'] = $screenName;
		} else {
			$parameter['screen_name'] = $screenName;
		}
		if ($showRetweets) {
			$parameter['include_rts'] = 'true';
		} else {
			$parameter['include_rts'] = 'false';
		}

		$url = self::getUserTimelineUrl();

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_URL, $url . '?' . Tx_WtTwitter_Twitter_Api::implodeArrayForUrl($parameter));

		$oAuthParameter = Tx_WtTwitter_Twitter_Api::createSignature(
			Tx_WtTwitter_Twitter_Api::getOAuthParameter(
				$oAuthToken
			),
			$url,
			'GET',
			Tx_WtTwitter_Twitter_Api::consumerSecret,
			$oAuthTokenSecret,
			$parameter
		);

		$header = array(
			'Authorization: OAuth ' . self::implodeArrayForHeader($oAuthParameter),
			'Content-Length:',
			'Content-Type:',
			'Expect:'
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		$response = curl_exec($ch);
		if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200) {
			$tweets = json_decode($response);
			$tweets = array_slice($tweets, 0, $count);
			foreach ($tweets as &$value) {
				$value->profile_image_url = $value->user->profile_image_url;
				$value->from_user = $value->user->screen_name;
			}
			unset($value);

		}
		curl_close($ch);

		return $tweets;
	}
}

?>