--- lib/common.php.orig	2021-12-12 02:35:51 UTC
+++ lib/common.php
@@ -247,9 +247,9 @@ if ($app['language'] == 'auto') {
 
 			$value = preg_split('/[-]+/',$value);
 			if (sizeof($value) == 2)
-				$app['lang_http'][$key] = strtolower($value[0]).'_'.strtoupper($value[1]);
+				$app['lang_http'][$key] = strtolower((string) $value[0]).'_'.strtoupper($value[1]);
 			else
-				$app['lang_http'][$key] = auto_lang(strtolower($value[0]));
+				$app['lang_http'][$key] = auto_lang(strtolower((string) $value[0]));
 		}
 
 		$app['lang_http'] = array_unique($app['lang_http']);
@@ -296,7 +296,9 @@ if ($app['language'] == 'auto') {
  * Strip slashes from GET, POST, and COOKIE variables if this
  * PHP install is configured to automatically addslashes()
  */
-if (@get_magic_quotes_gpc() && (! isset($slashes_stripped) || ! $slashes_stripped)) {
+if (@version_compare(phpversion(), '5.4.0', '<') &&
+    @get_magic_quotes_gpc() &&
+    (!isset($slashes_stripped) || !$slashes_stripped)) {
 	array_stripslashes($_REQUEST);
 	array_stripslashes($_GET);
 	array_stripslashes($_POST);
