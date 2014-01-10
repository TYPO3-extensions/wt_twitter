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
 * Repository for tweets
 *
 * @author Nicole Cordes <cordes@cps-it.de>
 * @package TYPO3
 * @subpackage wt_twitter
 */
class Tx_WtTwitter_Domain_Repository_TweetRepository {

	/**
	 * The content object
	 *
	 * @var tslib_cObj
	 */
	protected $contentObject = NULL;

	/**
	 * The extension configuration
	 *
	 * @var array
	 */
	protected $extensionConfiguration = array();

	/**
	 * The flash messages container
	 *
	 * @var Tx_Extbase_MVC_Controller_FlashMessages
	 */
	protected $flashMessageContainer = NULL;

	/**
	 * The plugin settings
	 *
	 * @var array
	 */
	protected $settings = array();

	/**
	 * Constructor function
	 */
	public function __construct() {
		$this->extensionConfiguration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['wt_twitter']);
		$this->contentObject = t3lib_div::makeInstance('tslib_cObj');
	}

	/**
	 * @param Tx_Extbase_MVC_Controller_FlashMessages $flashMessageContainer
	 * @return void
	 */
	public function injectFlashMessageContainer(Tx_Extbase_MVC_Controller_FlashMessages $flashMessageContainer) {
		$this->flashMessageContainer = $flashMessageContainer;
	}

	/**
	 * @param array $settings
	 * @param NULL $response
	 * @return array
	 */
	public function getTweetsFromUserTimeline($settings, &$response = NULL) {
		$tweets = array();
		$this->settings = $settings;

		if ($this->isTwitterSigned() && $this->isCurlActivated()) {
			$parameter = array();

			// Get screen name
			if (Tx_WtTwitter_Utility_Compatibility::testInt($this->settings['account'])) {
				$parameter['user_id'] = $this->settings['account'];
			} else {
				$parameter['screen_name'] = $this->settings['account'];
			}

			// Enable retweets
			if ($this->settings['showRetweets']) {
				$parameter['include_rts'] = 'true';
			} else {
				$parameter['include_rts'] = 'false';
			}

			// Exclude retweets
			if ($this->settings['excludeReplies']) {
				$parameter['exclude_replies'] = 'true';
			} else {
				$parameter['exclude_replies'] = 'false';
			}

			$tweets = $this->callApi(Tx_WtTwitter_Twitter_Api::getStatusesUserTimelineUrl(), 'GET', $parameter, $response);
		}

		$this->postProcessTweets($tweets);

		return $tweets;
	}

	/**
	 * @param array $settings
	 * @param NULL $response
	 * @return array
	 */
	public function getTweetsFromSearch($settings, &$response = NULL) {
		$tweets = array();
		$this->settings = $settings;

		if ($this->isTwitterSigned()&& $this->isCurlActivated()) {
			$parameter = array(
				'q' => $this->settings['hashtag']
			);

			$result = $this->callApi(Tx_WtTwitter_Twitter_Api::getSearchTweetsUrl(), 'GET', $parameter, $response);
			$tweets = $result->statuses;
		}

		$this->postProcessTweets($tweets);

		return $tweets;
	}

	/**
	 * @param $settings
	 * @param NULL $response
	 * @return array
	 */
	public function getListsFromUser($settings, &$response = NULL) {
		$lists = array();
		$this->settings = $settings;

		if ($this->isTwitterSigned()&& $this->isCurlActivated()) {
			$parameter = array(
				'count' => ((int) $this->settings['limit'] > 0 ? $this->settings['limit'] : '1000'),
				'cursor' => '-1'
			);

			// Get screen name
			if (Tx_WtTwitter_Utility_Compatibility::testInt($this->settings['account'])) {
				$parameter['user_id'] = $this->settings['account'];
			} else {
				$parameter['screen_name'] = $this->settings['account'];
			}

			$result = $this->callApi(Tx_WtTwitter_Twitter_Api::getListsOwnershipsUrl(), 'GET', $parameter, $response);
			$lists = $result->lists;

			usort($lists, function($a, $b) use ($settings) {
				switch ($settings['orderby']) {
					case 'subscriberCount':
						$valueA = (int) $a->subscriber_count;
						$valueB = (int) $b->subscriber_count;
						break;
					case 'memberCount':
						$valueA = (int) $a->member_count;
						$valueB = (int) $b->member_count;
						break;
					default:
						$dateA = new DateTime($a->created_at);
						$valueA = $dateA->getTimestamp();
						$dateB = new DateTime($b->created_at);
						$valueB = $dateB->getTimestamp();
				}

				if ($valueA === $valueB) {
					return 0;
				}

				return ($valueA > $valueB) ? -1 : 1;
			});
		}

		return $lists;
	}

	/**
	 * @param $settings
	 * @param NULL $response
	 * @return array
	 */
	public function getListsForUser($settings, &$response = NULL) {
		$lists = array();
		$this->settings = $settings;
		$cursor = -1;

		if ($this->isTwitterSigned()&& $this->isCurlActivated()) {
			$parameter = array();

			// Get screen name
			if (Tx_WtTwitter_Utility_Compatibility::testInt($this->settings['account'])) {
				$parameter['user_id'] = $this->settings['account'];
			} else {
				$parameter['screen_name'] = $this->settings['account'];
			}

			while (!empty($cursor) && ($this->settings['limit'] == 0 || $this->settings['limit'] > count($lists))) {
				$parameter['cursor'] = $cursor;
				$result = $this->callApi(Tx_WtTwitter_Twitter_Api::getListsMembershipsUrl(), 'GET', $parameter, $response);
				$lists = array_merge($lists, (array) $result->lists);
				$cursor = $result->next_cursor_str;
			}

			usort($lists, function($a, $b) use ($settings) {
				switch ($settings['orderby']) {
					case 'subscriberCount':
						$valueA = (int) $a->subscriber_count;
						$valueB = (int) $b->subscriber_count;
						break;
					case 'memberCount':
						$valueA = (int) $a->member_count;
						$valueB = (int) $b->member_count;
						break;
					default:
						$dateA = new DateTime($a->created_at);
						$valueA = $dateA->getTimestamp();
						$dateB = new DateTime($b->created_at);
						$valueB = $dateB->getTimestamp();
				}

				if ($valueA === $valueB) {
					return 0;
				}

				return ($valueA > $valueB) ? -1 : 1;
			});
		}

		$this->sliceArray($lists, $this->settings['limit']);

		return $lists;
	}

	/**
	 * @return boolean
	 */
	protected function isTwitterSigned() {
		if (empty($this->extensionConfiguration['oauth_token']) || empty($this->extensionConfiguration['oauth_token_secret'])) {
			$this->flashMessageContainer->add(
				'Please authorize your Twitter account in the extension settings.',
				'Twitter account not authorize',
				t3lib_FlashMessage::ERROR
			);

			return FALSE;
		}

		return TRUE;
	}

	/**
	 * @return boolean
	 */
	protected function isCurlActivated() {
		if (!$GLOBALS['TYPO3_CONF_VARS']['SYS']['curlUse'] || !function_exists('curl_init')) {
			$this->flashMessageContainer->add(
				'Please enable the use of curl in TYPO3 Install Tool by activation of TYPO3_CONF_VARS[SYS][curlUse] and check PHP integration.',
				'No curl available',
				t3lib_FlashMessage::ERROR
			);

			return FALSE;
		}

		return TRUE;
	}

	/**
	 * @param string $url
	 * @param string $method
	 * @param array $parameter
	 * @param NULL $response
	 * @return array
	 */
	protected function callApi($url, $method, $parameter, &$response) {
		$tweets = Tx_WtTwitter_Twitter_Api::processRequest(
			$this->extensionConfiguration['oauth_token'],
			$this->extensionConfiguration['oauth_token_secret'],
			$url,
			$method,
			$parameter,
			$response
		);

		return $tweets;
	}

	/**
	 * @param $tweets
	 * @return void
	 */
	protected function postProcessTweets(&$tweets) {
		$this->sliceArray($tweets, $this->settings['limit']);
		$this->addOldUserInformation($tweets);
		$this->rewriteIncludedLinks($tweets);
		$this->linkUrls($tweets);
		$this->linkHashtags($tweets);
		$this->linkUsernames($tweets);
	}

	/**
	 * @param array $array
	 * @param integer $count
	 * @return void
	 */
	protected function sliceArray(&$array, $count) {
		if (!empty($count) && count($array) > $count) {
			$array = array_slice($array, 0, $count);
		}
	}

	/**
	 * @param array $tweets
	 * @return void
	 */
	protected function addOldUserInformation(&$tweets) {
		if (is_array($tweets)) {
			foreach ($tweets as $tweet) {
				$tweet->profile_image_url = $tweet->user->profile_image_url;
				$tweet->from_user = $tweet->user->screen_name;
			}
			unset($tweet);
		}
	}

	/**
	 * @param object $url
	 * @return string
	 */
	protected function getVisibleUrl($url) {
		switch ($this->settings['rewriteLinks']) {
			case 'short':
				return $url->display_url;
			case 'extended':
				return $url->expanded_url;
			default:
				return $url->url;
		}
	}

	/**
	 * @param array $tweets
	 * @return void
	 */
	protected function rewriteIncludedLinks($tweets) {
		if (is_array($tweets) && $this->settings['rewriteLinks'] != 'leave') {
			foreach ($tweets as $tweet) {
				if ($tweet->entities && $tweet->entities->urls && is_array($tweet->entities->urls)) {
					foreach ($tweet->entities->urls as $url) {
						$newUrl = $this->getVisibleUrl($url);
						$tweet->text = str_replace($url->url, $newUrl, $tweet->text);
					}
					unset($url);
				}
			}
			unset($tweet);
		}
	}

	/**
	 * @param array $tweets
	 * @return void
	 */
	protected function linkUrls(&$tweets) {
		if (is_array($tweets) && !empty($this->settings['linkUrls'])) {
			foreach ($tweets as $tweet) {
				if ($tweet->entities && $tweet->entities->urls && is_array($tweet->entities->urls)) {
					foreach ($tweet->entities->urls as $url) {
						$urlInText = $this->getVisibleUrl($url);
						$typolinkConfiguration = array(
							'parameter' => $url->expanded_url,
						);
						$tweet->text = str_replace($urlInText, $this->contentObject->typolink($urlInText, $typolinkConfiguration), $tweet->text);
					}
					unset($url);
				}
			}
		}
		unset($tweet);
	}

	/**
	 * @param array $tweets
	 * @return void
	 */
	protected function linkHashtags(&$tweets) {
		if (is_array($tweets) && !empty($this->settings['linkHashtags'])) {
			foreach ($tweets as $tweet) {
				if ($tweet->entities && $tweet->entities->hashtags && is_array($tweet->entities->hashtags)) {
					foreach ($tweet->entities->hashtags as $hashtag) {
						$hastagText = '#' . $hashtag->text;
						$typolinkConfiguration = array(
							'parameter' => 'https://twitter.com/search?q=%23' . rawurlencode($hashtag->text),
						);
						$tweet->text = str_replace($hastagText, $this->contentObject->typolink($hastagText, $typolinkConfiguration), $tweet->text);
					}
					unset($hashtag);
				}
			}
			unset($tweet);
		}
	}

	/**
	 * @param array $tweets
	 * @return void
	 */
	protected function linkUsernames(&$tweets) {
		if (is_array($tweets) && !empty($this->settings['linkUsernames'])) {
			foreach ($tweets as $tweet) {
				if ($tweet->entities && $tweet->entities->user_mentions && is_array($tweet->entities->user_mentions)) {
					foreach ($tweet->entities->user_mentions as $username) {
						$screenName = '@' . $username->screen_name;
						$typolinkConfiguration = array(
							'parameter' => 'https://twitter.com/' . rawurlencode($username->screen_name),
						);
						$tweet->text = str_replace($screenName, $this->contentObject->typolink($screenName, $typolinkConfiguration), $tweet->text);
					}
					unset($username);
				}
			}
			unset($tweet);
		}
	}

}