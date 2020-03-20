<?php


/*
Ask With Tags
*/


if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}


qa_register_plugin_layer('qa-ask-layer.php', 'Ask With Tags Layer');
