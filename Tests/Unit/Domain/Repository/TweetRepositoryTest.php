<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Nicole Cordes <cordes@cps-it.de>
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
 * Test case.
 *
 * @package TYPO3
 * @subpackage tx_wttwitter
 *
 * @author Nicole Cordes <cordes@cps-it.de>
 */
class Tx_WtTwitter_Domain_Repository_TweetRepositoryTest extends Tx_Phpunit_TestCase {

	/**
	 * @var Tx_Phpunit_Interface_AccessibleObject|Tx_WtTwitter_Domain_Repository_TweetRepository
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = $this->getAccessibleMock('Tx_WtTwitter_Domain_Repository_TweetRepository', array('dummy'));
	}

	/**
	 * @return array
	 */
	public function getTweets() {
		return array(
			'Tweet without link but multiple hash tags' => array(
				unserialize('O:8:"stdClass":24:{s:10:"created_at";s:30:"Mon Jan 13 12:14:49 +0000 2014";s:2:"id";d:4.2270327764263322E+17;s:6:"id_str";s:18:"422703277642633216";s:4:"text";s:114:"Fange jetzt an Unit Tests für #wt_twitter zu schreiben, weil die Api scheinbar crappy ist! #TYPO3 #TYPO3Extension";s:6:"source";s:64:"<a href="http://www.metrotwit.com/" rel="nofollow">MetroTwit</a>";s:9:"truncated";b:0;s:21:"in_reply_to_status_id";N;s:25:"in_reply_to_status_id_str";N;s:19:"in_reply_to_user_id";N;s:23:"in_reply_to_user_id_str";N;s:23:"in_reply_to_screen_name";N;s:4:"user";O:8:"stdClass":39:{s:2:"id";i:16781789;s:6:"id_str";s:8:"16781789";s:4:"name";s:6:"Nicole";s:11:"screen_name";s:11:"IchHabRecht";s:8:"location";s:16:"Frankfurt (Oder)";s:11:"description";s:143:"Senior Entwickler online, Certified TYPO3 Integrator, TYPO3 CMS-Entwickler, Internet-Junkie, gepaart mit einer Mischung aus Mutter und Ehefrau.";s:3:"url";s:22:"http://t.co/VokoNZ8Oz6";s:8:"entities";O:8:"stdClass":2:{s:3:"url";O:8:"stdClass":1:{s:4:"urls";a:1:{i:0;O:8:"stdClass":4:{s:3:"url";s:22:"http://t.co/VokoNZ8Oz6";s:12:"expanded_url";s:47:"http://www.cps-it.de/cps-it-team/nicole-cordes/";s:11:"display_url";s:27:"cps-it.de/cps-it-team/ni…";s:7:"indices";a:2:{i:0;i:0;i:1;i:22;}}}}s:11:"description";O:8:"stdClass":1:{s:4:"urls";a:0:{}}}s:9:"protected";b:0;s:15:"followers_count";i:930;s:13:"friends_count";i:103;s:12:"listed_count";i:12;s:10:"created_at";s:30:"Wed Oct 15 13:17:53 +0000 2008";s:16:"favourites_count";i:14;s:10:"utc_offset";i:3600;s:9:"time_zone";s:6:"Berlin";s:11:"geo_enabled";b:1;s:8:"verified";b:0;s:14:"statuses_count";i:8494;s:4:"lang";s:2:"de";s:20:"contributors_enabled";b:0;s:13:"is_translator";b:0;s:24:"profile_background_color";s:6:"77B900";s:28:"profile_background_image_url";s:90:"http://a0.twimg.com/profile_background_images/317789648/twilk_background_4e5372604d6a3.jpg";s:34:"profile_background_image_url_https";s:92:"https://si0.twimg.com/profile_background_images/317789648/twilk_background_4e5372604d6a3.jpg";s:23:"profile_background_tile";b:1;s:17:"profile_image_url";s:91:"http://pbs.twimg.com/profile_images/2749415207/eb54acd60db18fb4578919bb5bd05889_normal.jpeg";s:23:"profile_image_url_https";s:92:"https://pbs.twimg.com/profile_images/2749415207/eb54acd60db18fb4578919bb5bd05889_normal.jpeg";s:18:"profile_banner_url";s:57:"https://pbs.twimg.com/profile_banners/16781789/1350595563";s:18:"profile_link_color";s:6:"0D410B";s:28:"profile_sidebar_border_color";s:6:"000000";s:26:"profile_sidebar_fill_color";s:6:"A4ED21";s:18:"profile_text_color";s:6:"000000";s:28:"profile_use_background_image";b:1;s:15:"default_profile";b:0;s:21:"default_profile_image";b:0;s:9:"following";b:0;s:19:"follow_request_sent";b:0;s:13:"notifications";b:0;}s:3:"geo";N;s:11:"coordinates";N;s:5:"place";N;s:12:"contributors";N;s:13:"retweet_count";i:0;s:14:"favorite_count";i:0;s:8:"entities";O:8:"stdClass":4:{s:8:"hashtags";a:3:{i:0;O:8:"stdClass":2:{s:4:"text";s:10:"wt_twitter";s:7:"indices";a:2:{i:0;i:30;i:1;i:41;}}i:1;O:8:"stdClass":2:{s:4:"text";s:5:"TYPO3";s:7:"indices";a:2:{i:0;i:91;i:1;i:97;}}i:2;O:8:"stdClass":2:{s:4:"text";s:14:"TYPO3Extension";s:7:"indices";a:2:{i:0;i:98;i:1;i:113;}}}s:7:"symbols";a:0:{}s:4:"urls";a:0:{}s:13:"user_mentions";a:0:{}}s:9:"favorited";b:0;s:9:"retweeted";b:0;s:4:"lang";s:2:"de";s:17:"profile_image_url";s:91:"http://pbs.twimg.com/profile_images/2749415207/eb54acd60db18fb4578919bb5bd05889_normal.jpeg";s:9:"from_user";s:11:"IchHabRecht";}'),
				array(
					'text' => 'Fange jetzt an Unit Tests für #wt_twitter zu schreiben, weil die Api scheinbar crappy ist! #TYPO3 #TYPO3Extension',
					'rewriteLinksLeave' => 'Fange jetzt an Unit Tests für #wt_twitter zu schreiben, weil die Api scheinbar crappy ist! #TYPO3 #TYPO3Extension',
					'rewriteLinksShort' => 'Fange jetzt an Unit Tests für #wt_twitter zu schreiben, weil die Api scheinbar crappy ist! #TYPO3 #TYPO3Extension',
					'rewriteLinksExpanded' => 'Fange jetzt an Unit Tests für #wt_twitter zu schreiben, weil die Api scheinbar crappy ist! #TYPO3 #TYPO3Extension',
					'linkUrlsLeave' => 'Fange jetzt an Unit Tests für #wt_twitter zu schreiben, weil die Api scheinbar crappy ist! #TYPO3 #TYPO3Extension',
					'linkUrlsShort' => 'Fange jetzt an Unit Tests für #wt_twitter zu schreiben, weil die Api scheinbar crappy ist! #TYPO3 #TYPO3Extension',
					'linkUrlsExpanded' => 'Fange jetzt an Unit Tests für #wt_twitter zu schreiben, weil die Api scheinbar crappy ist! #TYPO3 #TYPO3Extension',
					'linkHashtags' => 'Fange jetzt an Unit Tests für <a href="https://twitter.com/search?q=%23wt_twitter">#wt_twitter</a> zu schreiben, weil die Api scheinbar crappy ist! <a href="https://twitter.com/search?q=%23TYPO3">#TYPO3</a> <a href="https://twitter.com/search?q=%23TYPO3Extension">#TYPO3Extension</a>',
					'linkUsernames' => 'Fange jetzt an Unit Tests für #wt_twitter zu schreiben, weil die Api scheinbar crappy ist! #TYPO3 #TYPO3Extension',
					'replaceEntities' => 'Fange jetzt an Unit Tests für <a href="https://twitter.com/search?q=%23wt_twitter">#wt_twitter</a> zu schreiben, weil die Api scheinbar crappy ist! <a href="https://twitter.com/search?q=%23TYPO3">#TYPO3</a> <a href="https://twitter.com/search?q=%23TYPO3Extension">#TYPO3Extension</a>',
				)
			),
			'Tweet with link and hash tag' => array(
				unserialize('O:8:"stdClass":25:{s:10:"created_at";s:30:"Mon Jan 13 11:01:37 +0000 2014";s:2:"id";d:4.2268485714825626E+17;s:6:"id_str";s:18:"422684857148256256";s:4:"text";s:120:"Anrufen wird völlig überbewertet! RT @spooner_web Wer hat schon seine neue Telefonnummer? http://t.co/3pb2Mz6kJ2 #sepa";s:6:"source";s:64:"<a href="http://www.metrotwit.com/" rel="nofollow">MetroTwit</a>";s:9:"truncated";b:0;s:21:"in_reply_to_status_id";N;s:25:"in_reply_to_status_id_str";N;s:19:"in_reply_to_user_id";N;s:23:"in_reply_to_user_id_str";N;s:23:"in_reply_to_screen_name";N;s:4:"user";O:8:"stdClass":39:{s:2:"id";i:16781789;s:6:"id_str";s:8:"16781789";s:4:"name";s:6:"Nicole";s:11:"screen_name";s:11:"IchHabRecht";s:8:"location";s:16:"Frankfurt (Oder)";s:11:"description";s:143:"Senior Entwickler online, Certified TYPO3 Integrator, TYPO3 CMS-Entwickler, Internet-Junkie, gepaart mit einer Mischung aus Mutter und Ehefrau.";s:3:"url";s:22:"http://t.co/VokoNZ8Oz6";s:8:"entities";O:8:"stdClass":2:{s:3:"url";O:8:"stdClass":1:{s:4:"urls";a:1:{i:0;O:8:"stdClass":4:{s:3:"url";s:22:"http://t.co/VokoNZ8Oz6";s:12:"expanded_url";s:47:"http://www.cps-it.de/cps-it-team/nicole-cordes/";s:11:"display_url";s:27:"cps-it.de/cps-it-team/ni…";s:7:"indices";a:2:{i:0;i:0;i:1;i:22;}}}}s:11:"description";O:8:"stdClass":1:{s:4:"urls";a:0:{}}}s:9:"protected";b:0;s:15:"followers_count";i:930;s:13:"friends_count";i:103;s:12:"listed_count";i:12;s:10:"created_at";s:30:"Wed Oct 15 13:17:53 +0000 2008";s:16:"favourites_count";i:14;s:10:"utc_offset";i:3600;s:9:"time_zone";s:6:"Berlin";s:11:"geo_enabled";b:1;s:8:"verified";b:0;s:14:"statuses_count";i:8494;s:4:"lang";s:2:"de";s:20:"contributors_enabled";b:0;s:13:"is_translator";b:0;s:24:"profile_background_color";s:6:"77B900";s:28:"profile_background_image_url";s:90:"http://a0.twimg.com/profile_background_images/317789648/twilk_background_4e5372604d6a3.jpg";s:34:"profile_background_image_url_https";s:92:"https://si0.twimg.com/profile_background_images/317789648/twilk_background_4e5372604d6a3.jpg";s:23:"profile_background_tile";b:1;s:17:"profile_image_url";s:91:"http://pbs.twimg.com/profile_images/2749415207/eb54acd60db18fb4578919bb5bd05889_normal.jpeg";s:23:"profile_image_url_https";s:92:"https://pbs.twimg.com/profile_images/2749415207/eb54acd60db18fb4578919bb5bd05889_normal.jpeg";s:18:"profile_banner_url";s:57:"https://pbs.twimg.com/profile_banners/16781789/1350595563";s:18:"profile_link_color";s:6:"0D410B";s:28:"profile_sidebar_border_color";s:6:"000000";s:26:"profile_sidebar_fill_color";s:6:"A4ED21";s:18:"profile_text_color";s:6:"000000";s:28:"profile_use_background_image";b:1;s:15:"default_profile";b:0;s:21:"default_profile_image";b:0;s:9:"following";b:0;s:19:"follow_request_sent";b:0;s:13:"notifications";b:0;}s:3:"geo";N;s:11:"coordinates";N;s:5:"place";N;s:12:"contributors";N;s:13:"retweet_count";i:0;s:14:"favorite_count";i:0;s:8:"entities";O:8:"stdClass":4:{s:8:"hashtags";a:1:{i:0;O:8:"stdClass":2:{s:4:"text";s:4:"sepa";s:7:"indices";a:2:{i:0;i:113;i:1;i:118;}}}s:7:"symbols";a:0:{}s:4:"urls";a:1:{i:0;O:8:"stdClass":4:{s:3:"url";s:22:"http://t.co/3pb2Mz6kJ2";s:12:"expanded_url";s:70:"http://www.der-postillon.com/2014/01/eu-weitet-sepa-verfahren-aus.html";s:11:"display_url";s:35:"der-postillon.com/2014/01/eu-wei…";s:7:"indices";a:2:{i:0;i:90;i:1;i:112;}}}s:13:"user_mentions";a:1:{i:0;O:8:"stdClass":5:{s:11:"screen_name";s:11:"spooner_web";s:4:"name";s:11:"Spooner Web";s:2:"id";i:83329949;s:6:"id_str";s:8:"83329949";s:7:"indices";a:2:{i:0;i:37;i:1;i:49;}}}}s:9:"favorited";b:0;s:9:"retweeted";b:0;s:18:"possibly_sensitive";b:0;s:4:"lang";s:2:"de";s:17:"profile_image_url";s:91:"http://pbs.twimg.com/profile_images/2749415207/eb54acd60db18fb4578919bb5bd05889_normal.jpeg";s:9:"from_user";s:11:"IchHabRecht";}'),
				array(
					'text' => 'Anrufen wird völlig überbewertet! RT @spooner_web Wer hat schon seine neue Telefonnummer? http://t.co/3pb2Mz6kJ2 #sepa',
					'rewriteLinksLeave' => 'Anrufen wird völlig überbewertet! RT @spooner_web Wer hat schon seine neue Telefonnummer? http://t.co/3pb2Mz6kJ2 #sepa',
					'rewriteLinksShort' => 'Anrufen wird völlig überbewertet! RT @spooner_web Wer hat schon seine neue Telefonnummer? der-postillon.com/2014/01/eu-wei… #sepa',
					'rewriteLinksExpanded' => 'Anrufen wird völlig überbewertet! RT @spooner_web Wer hat schon seine neue Telefonnummer? http://www.der-postillon.com/2014/01/eu-weitet-sepa-verfahren-aus.html #sepa',
					'linkUrlsLeave' => 'Anrufen wird völlig überbewertet! RT @spooner_web Wer hat schon seine neue Telefonnummer? <a href="http://t.co/3pb2Mz6kJ2">http://t.co/3pb2Mz6kJ2</a> #sepa',
					'linkUrlsShort' => 'Anrufen wird völlig überbewertet! RT @spooner_web Wer hat schon seine neue Telefonnummer? <a href="http://www.der-postillon.com/2014/01/eu-weitet-sepa-verfahren-aus.html">der-postillon.com/2014/01/eu-wei…</a> #sepa',
					'linkUrlsExpanded' => 'Anrufen wird völlig überbewertet! RT @spooner_web Wer hat schon seine neue Telefonnummer? <a href="http://www.der-postillon.com/2014/01/eu-weitet-sepa-verfahren-aus.html">http://www.der-postillon.com/2014/01/eu-weitet-sepa-verfahren-aus.html</a> #sepa',
					'linkHashtags' => 'Anrufen wird völlig überbewertet! RT @spooner_web Wer hat schon seine neue Telefonnummer? http://t.co/3pb2Mz6kJ2 <a href="https://twitter.com/search?q=%23sepa">#sepa</a>',
					'linkUsernames' => 'Anrufen wird völlig überbewertet! RT <a href="https://twitter.com/spooner_web">@spooner_web</a> Wer hat schon seine neue Telefonnummer? http://t.co/3pb2Mz6kJ2 #sepa',
					'replaceEntities' => 'Anrufen wird völlig überbewertet! RT <a href="https://twitter.com/spooner_web">@spooner_web</a> Wer hat schon seine neue Telefonnummer? <a href="http://www.der-postillon.com/2014/01/eu-weitet-sepa-verfahren-aus.html">der-postillon.com/2014/01/eu-wei…</a> <a href="https://twitter.com/search?q=%23sepa">#sepa</a>',
				)
			),
			'Tweet with shorted link at the end and no hash tags' => array(
				unserialize('O:8:"stdClass":26:{s:10:"created_at";s:30:"Mon Jan 13 10:23:49 +0000 2014";s:2:"id";d:4.2267534346894131E+17;s:6:"id_str";s:18:"422675343468941312";s:4:"text";s:146:"RT @EddyMonrow: EDDY MONROW: Schöner Tag - Der Hit für den "Tag danach" (offizielles Video) - Videos - Unser Song für Dänemark http://t.co/…";s:6:"source";s:64:"<a href="http://www.metrotwit.com/" rel="nofollow">MetroTwit</a>";s:9:"truncated";b:0;s:21:"in_reply_to_status_id";N;s:25:"in_reply_to_status_id_str";N;s:19:"in_reply_to_user_id";N;s:23:"in_reply_to_user_id_str";N;s:23:"in_reply_to_screen_name";N;s:4:"user";O:8:"stdClass":39:{s:2:"id";i:16781789;s:6:"id_str";s:8:"16781789";s:4:"name";s:6:"Nicole";s:11:"screen_name";s:11:"IchHabRecht";s:8:"location";s:16:"Frankfurt (Oder)";s:11:"description";s:143:"Senior Entwickler online, Certified TYPO3 Integrator, TYPO3 CMS-Entwickler, Internet-Junkie, gepaart mit einer Mischung aus Mutter und Ehefrau.";s:3:"url";s:22:"http://t.co/VokoNZ8Oz6";s:8:"entities";O:8:"stdClass":2:{s:3:"url";O:8:"stdClass":1:{s:4:"urls";a:1:{i:0;O:8:"stdClass":4:{s:3:"url";s:22:"http://t.co/VokoNZ8Oz6";s:12:"expanded_url";s:47:"http://www.cps-it.de/cps-it-team/nicole-cordes/";s:11:"display_url";s:27:"cps-it.de/cps-it-team/ni…";s:7:"indices";a:2:{i:0;i:0;i:1;i:22;}}}}s:11:"description";O:8:"stdClass":1:{s:4:"urls";a:0:{}}}s:9:"protected";b:0;s:15:"followers_count";i:930;s:13:"friends_count";i:103;s:12:"listed_count";i:12;s:10:"created_at";s:30:"Wed Oct 15 13:17:53 +0000 2008";s:16:"favourites_count";i:14;s:10:"utc_offset";i:3600;s:9:"time_zone";s:6:"Berlin";s:11:"geo_enabled";b:1;s:8:"verified";b:0;s:14:"statuses_count";i:8494;s:4:"lang";s:2:"de";s:20:"contributors_enabled";b:0;s:13:"is_translator";b:0;s:24:"profile_background_color";s:6:"77B900";s:28:"profile_background_image_url";s:90:"http://a0.twimg.com/profile_background_images/317789648/twilk_background_4e5372604d6a3.jpg";s:34:"profile_background_image_url_https";s:92:"https://si0.twimg.com/profile_background_images/317789648/twilk_background_4e5372604d6a3.jpg";s:23:"profile_background_tile";b:1;s:17:"profile_image_url";s:91:"http://pbs.twimg.com/profile_images/2749415207/eb54acd60db18fb4578919bb5bd05889_normal.jpeg";s:23:"profile_image_url_https";s:92:"https://pbs.twimg.com/profile_images/2749415207/eb54acd60db18fb4578919bb5bd05889_normal.jpeg";s:18:"profile_banner_url";s:57:"https://pbs.twimg.com/profile_banners/16781789/1350595563";s:18:"profile_link_color";s:6:"0D410B";s:28:"profile_sidebar_border_color";s:6:"000000";s:26:"profile_sidebar_fill_color";s:6:"A4ED21";s:18:"profile_text_color";s:6:"000000";s:28:"profile_use_background_image";b:1;s:15:"default_profile";b:0;s:21:"default_profile_image";b:0;s:9:"following";b:0;s:19:"follow_request_sent";b:0;s:13:"notifications";b:0;}s:3:"geo";N;s:11:"coordinates";N;s:5:"place";N;s:12:"contributors";N;s:16:"retweeted_status";O:8:"stdClass":23:{s:10:"created_at";s:30:"Mon Jan 13 10:14:36 +0000 2014";s:2:"id";d:4.2267302215197491E+17;s:6:"id_str";s:18:"422673022151974912";s:4:"text";s:137:"EDDY MONROW: Schöner Tag - Der Hit für den "Tag danach" (offizielles Video) - Videos - Unser Song für Dänemark http://t.co/Xt8TdihLcZ";s:6:"source";s:72:"<a href="http://twitter.com/tweetbutton" rel="nofollow">Tweet Button</a>";s:9:"truncated";b:0;s:21:"in_reply_to_status_id";N;s:25:"in_reply_to_status_id_str";N;s:19:"in_reply_to_user_id";N;s:23:"in_reply_to_user_id_str";N;s:23:"in_reply_to_screen_name";N;s:4:"user";O:8:"stdClass":38:{s:2:"id";i:50965930;s:6:"id_str";s:8:"50965930";s:4:"name";s:11:"Eddy Monrow";s:11:"screen_name";s:10:"EddyMonrow";s:8:"location";s:7:"germany";s:11:"description";s:0:"";s:3:"url";s:22:"http://t.co/cSdSFwIKwM";s:8:"entities";O:8:"stdClass":2:{s:3:"url";O:8:"stdClass":1:{s:4:"urls";a:1:{i:0;O:8:"stdClass":4:{s:3:"url";s:22:"http://t.co/cSdSFwIKwM";s:12:"expanded_url";s:22:"http://eddy-monrow.com";s:11:"display_url";s:15:"eddy-monrow.com";s:7:"indices";a:2:{i:0;i:0;i:1;i:22;}}}}s:11:"description";O:8:"stdClass":1:{s:4:"urls";a:0:{}}}s:9:"protected";b:0;s:15:"followers_count";i:17;s:13:"friends_count";i:31;s:12:"listed_count";i:2;s:10:"created_at";s:30:"Fri Jun 26 07:40:32 +0000 2009";s:16:"favourites_count";i:0;s:10:"utc_offset";i:3600;s:9:"time_zone";s:6:"Berlin";s:11:"geo_enabled";b:0;s:8:"verified";b:0;s:14:"statuses_count";i:89;s:4:"lang";s:2:"en";s:20:"contributors_enabled";b:0;s:13:"is_translator";b:0;s:24:"profile_background_color";s:6:"EBEBEB";s:28:"profile_background_image_url";s:84:"http://a0.twimg.com/profile_background_images/20818876/em_twitterbackground_sofa.jpg";s:34:"profile_background_image_url_https";s:86:"https://si0.twimg.com/profile_background_images/20818876/em_twitterbackground_sofa.jpg";s:23:"profile_background_tile";b:0;s:17:"profile_image_url";s:76:"http://pbs.twimg.com/profile_images/283363478/eddy-monrow_twitter_normal.jpg";s:23:"profile_image_url_https";s:77:"https://pbs.twimg.com/profile_images/283363478/eddy-monrow_twitter_normal.jpg";s:18:"profile_link_color";s:6:"990000";s:28:"profile_sidebar_border_color";s:6:"DFDFDF";s:26:"profile_sidebar_fill_color";s:6:"F3F3F3";s:18:"profile_text_color";s:6:"333333";s:28:"profile_use_background_image";b:1;s:15:"default_profile";b:0;s:21:"default_profile_image";b:0;s:9:"following";b:0;s:19:"follow_request_sent";b:0;s:13:"notifications";b:0;}s:3:"geo";N;s:11:"coordinates";N;s:5:"place";N;s:12:"contributors";N;s:13:"retweet_count";i:1;s:14:"favorite_count";i:0;s:8:"entities";O:8:"stdClass":4:{s:8:"hashtags";a:0:{}s:7:"symbols";a:0:{}s:4:"urls";a:1:{i:0;O:8:"stdClass":4:{s:3:"url";s:22:"http://t.co/Xt8TdihLcZ";s:12:"expanded_url";s:58:"http://www.unser-song-fuer-daenemark.de/videos/detail/2673";s:11:"display_url";s:46:"unser-song-fuer-daenemark.de/videos/detail/…";s:7:"indices";a:2:{i:0;i:111;i:1;i:133;}}}s:13:"user_mentions";a:0:{}}s:9:"favorited";b:0;s:9:"retweeted";b:1;s:18:"possibly_sensitive";b:0;s:4:"lang";s:2:"de";}s:13:"retweet_count";i:1;s:14:"favorite_count";i:0;s:8:"entities";O:8:"stdClass":4:{s:8:"hashtags";a:0:{}s:7:"symbols";a:0:{}s:4:"urls";a:1:{i:0;O:8:"stdClass":4:{s:3:"url";s:22:"http://t.co/Xt8TdihLcZ";s:12:"expanded_url";s:58:"http://www.unser-song-fuer-daenemark.de/videos/detail/2673";s:11:"display_url";s:46:"unser-song-fuer-daenemark.de/videos/detail/…";s:7:"indices";a:2:{i:0;i:139;i:1;i:140;}}}s:13:"user_mentions";a:1:{i:0;O:8:"stdClass":5:{s:11:"screen_name";s:10:"EddyMonrow";s:4:"name";s:11:"Eddy Monrow";s:2:"id";i:50965930;s:6:"id_str";s:8:"50965930";s:7:"indices";a:2:{i:0;i:3;i:1;i:14;}}}}s:9:"favorited";b:0;s:9:"retweeted";b:1;s:18:"possibly_sensitive";b:0;s:4:"lang";s:2:"de";s:17:"profile_image_url";s:91:"http://pbs.twimg.com/profile_images/2749415207/eb54acd60db18fb4578919bb5bd05889_normal.jpeg";s:9:"from_user";s:11:"IchHabRecht";}'),
				array(
					'text' => 'EDDY MONROW: Schöner Tag - Der Hit für den "Tag danach" (offizielles Video) - Videos - Unser Song für Dänemark http://t.co/Xt8TdihLcZ',
					'rewriteLinksLeave' => 'EDDY MONROW: Schöner Tag - Der Hit für den "Tag danach" (offizielles Video) - Videos - Unser Song für Dänemark http://t.co/Xt8TdihLcZ',
					'rewriteLinksShort' => 'EDDY MONROW: Schöner Tag - Der Hit für den "Tag danach" (offizielles Video) - Videos - Unser Song für Dänemark unser-song-fuer-daenemark.de/videos/detail/…',
					'rewriteLinksExpanded' => 'EDDY MONROW: Schöner Tag - Der Hit für den "Tag danach" (offizielles Video) - Videos - Unser Song für Dänemark http://www.unser-song-fuer-daenemark.de/videos/detail/2673',
					'linkUrlsLeave' => 'EDDY MONROW: Schöner Tag - Der Hit für den "Tag danach" (offizielles Video) - Videos - Unser Song für Dänemark <a href="http://t.co/Xt8TdihLcZ">http://t.co/Xt8TdihLcZ</a>',
					'linkUrlsShort' => 'EDDY MONROW: Schöner Tag - Der Hit für den "Tag danach" (offizielles Video) - Videos - Unser Song für Dänemark <a href="http://www.unser-song-fuer-daenemark.de/videos/detail/2673">unser-song-fuer-daenemark.de/videos/detail/…</a>',
					'linkUrlsExpanded' => 'EDDY MONROW: Schöner Tag - Der Hit für den "Tag danach" (offizielles Video) - Videos - Unser Song für Dänemark <a href="http://www.unser-song-fuer-daenemark.de/videos/detail/2673">http://www.unser-song-fuer-daenemark.de/videos/detail/2673</a>',
					'linkHashtags' => 'EDDY MONROW: Schöner Tag - Der Hit für den "Tag danach" (offizielles Video) - Videos - Unser Song für Dänemark http://t.co/Xt8TdihLcZ',
					'linkUsernames' => 'EDDY MONROW: Schöner Tag - Der Hit für den "Tag danach" (offizielles Video) - Videos - Unser Song für Dänemark http://t.co/Xt8TdihLcZ',
					'replaceEntities' => 'RT <a href="https://twitter.com/EddyMonrow">@EddyMonrow</a>: EDDY MONROW: Schöner Tag - Der Hit für den "Tag danach" (offizielles Video) - Videos - Unser Song für Dänemark <a href="http://www.unser-song-fuer-daenemark.de/videos/detail/2673">unser-song-fuer-daenemark.de/videos/detail/…</a>',
				),
			),
			'Tweet with multiple user mentions' => array(
				unserialize('O:8:"stdClass":26:{s:10:"created_at";s:30:"Mon Jan 13 09:19:02 +0000 2014";s:2:"id";d:4.2265904196671078E+17;s:6:"id_str";s:18:"422659041966710784";s:4:"text";s:145:"RT @opensourcepress: Im Februar ist es soweit: Neue #Extbase-Bücher braucht (bekommt!) das Land… von @PatrickLobacher: http://t.co/nQwr0SNo…";s:6:"source";s:64:"<a href="http://www.metrotwit.com/" rel="nofollow">MetroTwit</a>";s:9:"truncated";b:0;s:21:"in_reply_to_status_id";N;s:25:"in_reply_to_status_id_str";N;s:19:"in_reply_to_user_id";N;s:23:"in_reply_to_user_id_str";N;s:23:"in_reply_to_screen_name";N;s:4:"user";O:8:"stdClass":39:{s:2:"id";i:16781789;s:6:"id_str";s:8:"16781789";s:4:"name";s:6:"Nicole";s:11:"screen_name";s:11:"IchHabRecht";s:8:"location";s:16:"Frankfurt (Oder)";s:11:"description";s:143:"Senior Entwickler online, Certified TYPO3 Integrator, TYPO3 CMS-Entwickler, Internet-Junkie, gepaart mit einer Mischung aus Mutter und Ehefrau.";s:3:"url";s:22:"http://t.co/VokoNZ8Oz6";s:8:"entities";O:8:"stdClass":2:{s:3:"url";O:8:"stdClass":1:{s:4:"urls";a:1:{i:0;O:8:"stdClass":4:{s:3:"url";s:22:"http://t.co/VokoNZ8Oz6";s:12:"expanded_url";s:47:"http://www.cps-it.de/cps-it-team/nicole-cordes/";s:11:"display_url";s:27:"cps-it.de/cps-it-team/ni…";s:7:"indices";a:2:{i:0;i:0;i:1;i:22;}}}}s:11:"description";O:8:"stdClass":1:{s:4:"urls";a:0:{}}}s:9:"protected";b:0;s:15:"followers_count";i:930;s:13:"friends_count";i:103;s:12:"listed_count";i:12;s:10:"created_at";s:30:"Wed Oct 15 13:17:53 +0000 2008";s:16:"favourites_count";i:14;s:10:"utc_offset";i:3600;s:9:"time_zone";s:6:"Berlin";s:11:"geo_enabled";b:1;s:8:"verified";b:0;s:14:"statuses_count";i:8494;s:4:"lang";s:2:"de";s:20:"contributors_enabled";b:0;s:13:"is_translator";b:0;s:24:"profile_background_color";s:6:"77B900";s:28:"profile_background_image_url";s:90:"http://a0.twimg.com/profile_background_images/317789648/twilk_background_4e5372604d6a3.jpg";s:34:"profile_background_image_url_https";s:92:"https://si0.twimg.com/profile_background_images/317789648/twilk_background_4e5372604d6a3.jpg";s:23:"profile_background_tile";b:1;s:17:"profile_image_url";s:91:"http://pbs.twimg.com/profile_images/2749415207/eb54acd60db18fb4578919bb5bd05889_normal.jpeg";s:23:"profile_image_url_https";s:92:"https://pbs.twimg.com/profile_images/2749415207/eb54acd60db18fb4578919bb5bd05889_normal.jpeg";s:18:"profile_banner_url";s:57:"https://pbs.twimg.com/profile_banners/16781789/1350595563";s:18:"profile_link_color";s:6:"0D410B";s:28:"profile_sidebar_border_color";s:6:"000000";s:26:"profile_sidebar_fill_color";s:6:"A4ED21";s:18:"profile_text_color";s:6:"000000";s:28:"profile_use_background_image";b:1;s:15:"default_profile";b:0;s:21:"default_profile_image";b:0;s:9:"following";b:0;s:19:"follow_request_sent";b:0;s:13:"notifications";b:0;}s:3:"geo";N;s:11:"coordinates";N;s:5:"place";N;s:12:"contributors";N;s:16:"retweeted_status";O:8:"stdClass":23:{s:10:"created_at";s:30:"Mon Jan 13 08:49:14 +0000 2014";s:2:"id";d:4.2265154178740634E+17;s:6:"id_str";s:18:"422651541787406336";s:4:"text";s:130:"Im Februar ist es soweit: Neue #Extbase-Bücher braucht (bekommt!) das Land… von @PatrickLobacher: http://t.co/nQwr0SNoxH #TYPO3";s:6:"source";s:3:"web";s:9:"truncated";b:0;s:21:"in_reply_to_status_id";N;s:25:"in_reply_to_status_id_str";N;s:19:"in_reply_to_user_id";N;s:23:"in_reply_to_user_id_str";N;s:23:"in_reply_to_screen_name";N;s:4:"user";O:8:"stdClass":39:{s:2:"id";i:20840382;s:6:"id_str";s:8:"20840382";s:4:"name";s:17:"Open Source Press";s:11:"screen_name";s:15:"opensourcepress";s:8:"location";s:17:"München / Munich";s:11:"description";s:136:"Open Source Press ist ein unabhängiger Fachbuchverlag in München, der auf die Themen Freie und Open Source Software spezialisiert ist.";s:3:"url";s:22:"http://t.co/Ju5Rz5CUED";s:8:"entities";O:8:"stdClass":2:{s:3:"url";O:8:"stdClass":1:{s:4:"urls";a:1:{i:0;O:8:"stdClass":4:{s:3:"url";s:22:"http://t.co/Ju5Rz5CUED";s:12:"expanded_url";s:25:"http://opensourcepress.de";s:11:"display_url";s:18:"opensourcepress.de";s:7:"indices";a:2:{i:0;i:0;i:1;i:22;}}}}s:11:"description";O:8:"stdClass":1:{s:4:"urls";a:0:{}}}s:9:"protected";b:0;s:15:"followers_count";i:1625;s:13:"friends_count";i:363;s:12:"listed_count";i:85;s:10:"created_at";s:30:"Sat Feb 14 10:27:04 +0000 2009";s:16:"favourites_count";i:0;s:10:"utc_offset";i:3600;s:9:"time_zone";s:6:"Berlin";s:11:"geo_enabled";b:0;s:8:"verified";b:0;s:14:"statuses_count";i:1423;s:4:"lang";s:2:"de";s:20:"contributors_enabled";b:0;s:13:"is_translator";b:0;s:24:"profile_background_color";s:6:"DCDDDF";s:28:"profile_background_image_url";s:92:"http://a0.twimg.com/profile_background_images/766126765/852b0fa6adcaaf2824f0848afb69a710.png";s:34:"profile_background_image_url_https";s:94:"https://si0.twimg.com/profile_background_images/766126765/852b0fa6adcaaf2824f0848afb69a710.png";s:23:"profile_background_tile";b:0;s:17:"profile_image_url";s:69:"http://pbs.twimg.com/profile_images/78232629/osp_quad_full_normal.jpg";s:23:"profile_image_url_https";s:70:"https://pbs.twimg.com/profile_images/78232629/osp_quad_full_normal.jpg";s:18:"profile_banner_url";s:57:"https://pbs.twimg.com/profile_banners/20840382/1358434787";s:18:"profile_link_color";s:6:"0084B4";s:28:"profile_sidebar_border_color";s:6:"FFFFFF";s:26:"profile_sidebar_fill_color";s:6:"EBEBEB";s:18:"profile_text_color";s:6:"333333";s:28:"profile_use_background_image";b:0;s:15:"default_profile";b:0;s:21:"default_profile_image";b:0;s:9:"following";b:0;s:19:"follow_request_sent";b:0;s:13:"notifications";b:0;}s:3:"geo";N;s:11:"coordinates";N;s:5:"place";N;s:12:"contributors";N;s:13:"retweet_count";i:6;s:14:"favorite_count";i:1;s:8:"entities";O:8:"stdClass":4:{s:8:"hashtags";a:2:{i:0;O:8:"stdClass":2:{s:4:"text";s:7:"Extbase";s:7:"indices";a:2:{i:0;i:31;i:1;i:39;}}i:1;O:8:"stdClass":2:{s:4:"text";s:5:"TYPO3";s:7:"indices";a:2:{i:0;i:121;i:1;i:127;}}}s:7:"symbols";a:0:{}s:4:"urls";a:1:{i:0;O:8:"stdClass":4:{s:3:"url";s:22:"http://t.co/nQwr0SNoxH";s:12:"expanded_url";s:61:"http://www.typoblog.de/neue-extbase-buecher-braucht-das-land/";s:11:"display_url";s:29:"typoblog.de/neue-extbase-b…";s:7:"indices";a:2:{i:0;i:98;i:1;i:120;}}}s:13:"user_mentions";a:1:{i:0;O:8:"stdClass":5:{s:11:"screen_name";s:15:"PatrickLobacher";s:4:"name";s:16:"Patrick Lobacher";s:2:"id";i:12120292;s:6:"id_str";s:8:"12120292";s:7:"indices";a:2:{i:0;i:80;i:1;i:96;}}}}s:9:"favorited";b:0;s:9:"retweeted";b:1;s:18:"possibly_sensitive";b:0;s:4:"lang";s:2:"de";}s:13:"retweet_count";i:6;s:14:"favorite_count";i:0;s:8:"entities";O:8:"stdClass":4:{s:8:"hashtags";a:2:{i:0;O:8:"stdClass":2:{s:4:"text";s:7:"Extbase";s:7:"indices";a:2:{i:0;i:52;i:1;i:60;}}i:1;O:8:"stdClass":2:{s:4:"text";s:5:"TYPO3";s:7:"indices";a:2:{i:0;i:139;i:1;i:140;}}}s:7:"symbols";a:0:{}s:4:"urls";a:1:{i:0;O:8:"stdClass":4:{s:3:"url";s:22:"http://t.co/nQwr0SNoxH";s:12:"expanded_url";s:61:"http://www.typoblog.de/neue-extbase-buecher-braucht-das-land/";s:11:"display_url";s:29:"typoblog.de/neue-extbase-b…";s:7:"indices";a:2:{i:0;i:139;i:1;i:140;}}}s:13:"user_mentions";a:2:{i:0;O:8:"stdClass":5:{s:11:"screen_name";s:15:"opensourcepress";s:4:"name";s:17:"Open Source Press";s:2:"id";i:20840382;s:6:"id_str";s:8:"20840382";s:7:"indices";a:2:{i:0;i:3;i:1;i:19;}}i:1;O:8:"stdClass":5:{s:11:"screen_name";s:15:"PatrickLobacher";s:4:"name";s:16:"Patrick Lobacher";s:2:"id";i:12120292;s:6:"id_str";s:8:"12120292";s:7:"indices";a:2:{i:0;i:101;i:1;i:117;}}}}s:9:"favorited";b:0;s:9:"retweeted";b:1;s:18:"possibly_sensitive";b:0;s:4:"lang";s:2:"de";s:17:"profile_image_url";s:91:"http://pbs.twimg.com/profile_images/2749415207/eb54acd60db18fb4578919bb5bd05889_normal.jpeg";s:9:"from_user";s:11:"IchHabRecht";}'),
				array(
					'text' => 'Im Februar ist es soweit: Neue #Extbase-Bücher braucht (bekommt!) das Land… von @PatrickLobacher: http://t.co/nQwr0SNoxH #TYPO3',
					'rewriteLinksLeave' => 'Im Februar ist es soweit: Neue #Extbase-Bücher braucht (bekommt!) das Land… von @PatrickLobacher: http://t.co/nQwr0SNoxH #TYPO3',
					'rewriteLinksShort' => 'Im Februar ist es soweit: Neue #Extbase-Bücher braucht (bekommt!) das Land… von @PatrickLobacher: typoblog.de/neue-extbase-b… #TYPO3',
					'rewriteLinksExpanded' => 'Im Februar ist es soweit: Neue #Extbase-Bücher braucht (bekommt!) das Land… von @PatrickLobacher: http://www.typoblog.de/neue-extbase-buecher-braucht-das-land/ #TYPO3',
					'linkUrlsLeave' => 'Im Februar ist es soweit: Neue #Extbase-Bücher braucht (bekommt!) das Land… von @PatrickLobacher: <a href="http://t.co/nQwr0SNoxH">http://t.co/nQwr0SNoxH</a> #TYPO3',
					'linkUrlsShort' => 'Im Februar ist es soweit: Neue #Extbase-Bücher braucht (bekommt!) das Land… von @PatrickLobacher: <a href="http://www.typoblog.de/neue-extbase-buecher-braucht-das-land/">typoblog.de/neue-extbase-b…</a> #TYPO3',
					'linkUrlsExpanded' => 'Im Februar ist es soweit: Neue #Extbase-Bücher braucht (bekommt!) das Land… von @PatrickLobacher: <a href="http://www.typoblog.de/neue-extbase-buecher-braucht-das-land/">http://www.typoblog.de/neue-extbase-buecher-braucht-das-land/</a> #TYPO3',
					'linkHashtags' => 'Im Februar ist es soweit: Neue <a href="https://twitter.com/search?q=%23Extbase">#Extbase</a>-Bücher braucht (bekommt!) das Land… von @PatrickLobacher: http://t.co/nQwr0SNoxH <a href="https://twitter.com/search?q=%23TYPO3">#TYPO3</a>',
					'linkUsernames' => 'Im Februar ist es soweit: Neue #Extbase-Bücher braucht (bekommt!) das Land… von <a href="https://twitter.com/PatrickLobacher">@PatrickLobacher</a>: http://t.co/nQwr0SNoxH #TYPO3',
					'replaceEntities' => 'RT <a href="https://twitter.com/opensourcepress">@opensourcepress</a>: Im Februar ist es soweit: Neue <a href="https://twitter.com/search?q=%23Extbase">#Extbase</a>-Bücher braucht (bekommt!) das Land… von <a href="https://twitter.com/PatrickLobacher">@PatrickLobacher</a>: <a href="http://www.typoblog.de/neue-extbase-buecher-braucht-das-land/">typoblog.de/neue-extbase-b…</a> <a href="https://twitter.com/search?q=%23TYPO3">#TYPO3</a>',
				)
			),
		);
	}

	/**
	 * @param object $tweet
	 * @return object
	 */
	protected function getTweetByStatus($tweet) {
		if ($tweet->retweeted == TRUE && is_object($tweet->retweeted_status)) {
			return $tweet->retweeted_status;
		}

		return $tweet;
	}

	/**
	 * @test
	 * @dataProvider getTweets
	 */
	public function tweetsGeneratedAsExpected($tweet, $expectedArray) {
		$tweet = $this->getTweetByStatus($tweet);
		$this->assertSame($expectedArray['text'], $tweet->text);
	}

	/**
	 * @test
	 * @dataProvider getTweets
	 */
	public function rewriteIncludedLinksWithLeaveNotChangingLinks($tweet, $expectedArray) {
		$this->fixture->_set('settings', array('rewriteLinks' => 'leave'));

		$tweet = $this->getTweetByStatus($tweet);
		$charArray = preg_split("//u", $tweet->text, -1, PREG_SPLIT_NO_EMPTY);
		$this->fixture->_callRef('rewriteIncludedLinks', $charArray, $tweet->entities);

		$this->assertSame($expectedArray['rewriteLinksLeave'], implode($charArray));
	}

	/**
	 * @test
	 * @dataProvider getTweets
	 */
	public function rewriteIncludedLinksWithShortLinks($tweet, $expectedArray) {
		$this->fixture->_set('settings', array('rewriteLinks' => 'short'));

		$tweet = $this->getTweetByStatus($tweet);
		$charArray = preg_split("//u", $tweet->text, -1, PREG_SPLIT_NO_EMPTY);
		$charArray2 = preg_split("//u", $tweet->text);
		$this->fixture->_callRef('rewriteIncludedLinks', $charArray, $tweet->entities);

		$this->assertSame($expectedArray['rewriteLinksShort'], implode($charArray));
	}

	/**
	 * @test
	 * @dataProvider getTweets
	 */
	public function rewriteIncludedLinksWithExpandedLinks($tweet, $expectedArray) {
		$this->fixture->_set('settings', array('rewriteLinks' => 'expanded'));

		$tweet = $this->getTweetByStatus($tweet);
		$charArray = preg_split("//u", $tweet->text, -1, PREG_SPLIT_NO_EMPTY);
		$this->fixture->_callRef('rewriteIncludedLinks', $charArray, $tweet->entities);

		$this->assertSame($expectedArray['rewriteLinksExpanded'], implode($charArray));
	}

	/**
	 * @test
	 * @dataProvider getTweets
	 */
	public function linkUrlsWithLeaveNotChangingText($tweet, $expectedArray) {
		$this->fixture->_set('settings', array('rewriteLinks' => 'leave', 'linkUrls' => TRUE));

		$tweet = $this->getTweetByStatus($tweet);
		$charArray = preg_split("//u", $tweet->text, -1, PREG_SPLIT_NO_EMPTY);
		$this->fixture->_callRef('linkUrls', $charArray, $tweet->entities);

		$this->assertSame($expectedArray['linkUrlsLeave'], implode($charArray));
	}

	/**
	 * @test
	 * @dataProvider getTweets
	 */
	public function linkUrlsWithShortLinks($tweet, $expectedArray) {
		$this->fixture->_set('settings', array('rewriteLinks' => 'short', 'linkUrls' => TRUE));

		$tweet = $this->getTweetByStatus($tweet);
		$charArray = preg_split("//u", $tweet->text, -1, PREG_SPLIT_NO_EMPTY);
		$this->fixture->_callRef('linkUrls', $charArray, $tweet->entities);

		$this->assertSame($expectedArray['linkUrlsShort'], implode($charArray));
	}

	/**
	 * @test
	 * @dataProvider getTweets
	 */
	public function linkUrlsWithExpandedLinks($tweet, $expectedArray) {
		$this->fixture->_set('settings', array('rewriteLinks' => 'expanded', 'linkUrls' => TRUE));

		$tweet = $this->getTweetByStatus($tweet);
		$charArray = preg_split("//u", $tweet->text, -1, PREG_SPLIT_NO_EMPTY);
		$this->fixture->_callRef('linkUrls', $charArray, $tweet->entities);

		$this->assertSame($expectedArray['linkUrlsExpanded'], implode($charArray));
	}

	/**
	 * @test
	 * @dataProvider getTweets
	 */
	public function linkHashtagsLinksMultipleHashTags($tweet, $expectedArray) {
		$this->fixture->_set('settings', array('linkHashtags' => TRUE));

		$tweet = $this->getTweetByStatus($tweet);
		$charArray = preg_split("//u", $tweet->text, -1, PREG_SPLIT_NO_EMPTY);
		$this->fixture->_callRef('linkHashtags', $charArray, $tweet->entities);

		$this->assertSame($expectedArray['linkHashtags'], implode($charArray));
	}

	/**
	 * @test
	 * @dataProvider getTweets
	 */
	public function linkUsernamesLinksMultipleUserNames($tweet, $expectedArray) {
		$this->fixture->_set('settings', array('linkUsernames' => TRUE));

		$tweet = $this->getTweetByStatus($tweet);
		$charArray = preg_split("//u", $tweet->text, -1, PREG_SPLIT_NO_EMPTY);
		$this->fixture->_callRef('linkUsernames', $charArray, $tweet->entities);

		$this->assertSame($expectedArray['linkUsernames'], implode($charArray));
	}

	/**
	 * @test
	 * @dataProvider getTweets
	 */
	public function replaceTweetEntitiesReturnsReplacedTweets($tweet, $expectedArray) {
		$this->fixture->_set('settings', array('rewriteLinks' => 'short', 'linkUrls' => TRUE, 'linkHashtags' => TRUE, 'linkUsernames' => TRUE));

		$charArray = preg_split("//u", $tweet->text, -1, PREG_SPLIT_NO_EMPTY);
		$tweets = array($tweet);
		$this->fixture->_callRef('replaceTweetEntities', $tweets);

		$this->assertSame($expectedArray['replaceEntities'], $tweet->text);
	}

}

?>