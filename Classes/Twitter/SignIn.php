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
 * Class to sign in into Twitter
 *
 * @author Nicole Cordes <cordes@cps-it.de>
 * @package TYPO3
 * @subpackage wt_twitter
 */
class Tx_WtTwitter_Twitter_SignIn {

	/**
	 * Shows the "Sign in with Twitter" button in the extension configuration
	 *
	 * @return string The rendered view
	 */
	public function showButton() {
		$content = '';

		$extensionConfiguration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['wt_twitter']);
		if (empty($extensionConfiguration['oauth_token']) || empty($extensionConfiguration['oauth_token_secret'])) {
			if ($GLOBALS['TYPO3_CONF_VARS']['SYS']['curlUse']) {
				$url = Tx_WtTwitter_Twitter_Api::getRequestTokenUrl();

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POST, 1);

				$oAuthParameter = Tx_WtTwitter_Twitter_Api::createSignature(
					Tx_WtTwitter_Twitter_Api::getOAuthParameter(
						'',
						array(
							'oauth_callback' => 'http://' . t3lib_div::getIndpEnv('HTTP_HOST') . '/' .
							t3lib_extMgm::siteRelPath('wt_twitter') . 'Classes/Twitter/Redirect.php'
						)
					),
					$url,
					'POST',
					Tx_WtTwitter_Twitter_Api::consumerSecret,
					''
				);
				$header = array(
					'Authorization: OAuth ' . Tx_WtTwitter_Twitter_Api::implodeArrayForHeader($oAuthParameter),
					'Content-Length:',
					'Content-Type:',
					'Expect:'
				);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

				$response = curl_exec($ch);
				if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200) {
					$responseArray = t3lib_div::explodeUrl2Array($response);

					$content .= '<a href="#" onclick="twitterWindow = window.open(\'' .
						Tx_WtTwitter_Twitter_Api::getAuthorizeUrl() . '?oauth_token=' . $responseArray['oauth_token'] .
						'\',\'Sign in with Twitter\',\'height=650,width=650,status=0,menubar=0,resizable=1,location=0,directories=0,scrollbars=1,toolbar=0\');">';
					$content .= '<img alt="Sign in with Twitter" height="28" src="' . t3lib_extMgm::extRelPath('wt_twitter') . 'Resources/Public/Images/sign-in-with-twitter.png" width="158" />';
					$content .= '</a>';
				} else {
					$flashMessage = t3lib_div::makeInstance('t3lib_FlashMessage',
						'Twitter couldn\'t generate the request token.<br /><br />' .
						'Headers sent:<br />' . nl2br(curl_getinfo($ch, CURLINFO_HEADER_OUT)),
						'An error occurred',
						t3lib_FlashMessage::ERROR
					);
					$content .= $flashMessage->render();
				}
				curl_close($ch);
			} else {
				$flashMessage = t3lib_div::makeInstance('t3lib_FlashMessage',
					'Please enable the use of curl in TYPO3 Install Tool by activation of TYPO3_CONF_VARS[SYS][curlUse].',
					'No curl available',
					t3lib_FlashMessage::ERROR
				);
				$content .= $flashMessage->render();
			}
		} else {
			$flashMessage = t3lib_div::makeInstance('t3lib_FlashMessage',
				'You already registered this application with your Twitter account.',
				'Already signed in',
				t3lib_FlashMessage::OK
			);
			$content .= $flashMessage->render();
		}

		return $content;
	}
}

?>