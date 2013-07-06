<?php
$extensionClassPath = t3lib_extMgm::extPath('wt_twitter') . 'Classes/';

return array(
	'tx_wttwitter_twitter_api' => $extensionClassPath . 'Twitter/Api.php',
	'tx_wttwitter_utility_compatibility' => $extensionClassPath . 'Utility/Compatibility.php'
);

?>