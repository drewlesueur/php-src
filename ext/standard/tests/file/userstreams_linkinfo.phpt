--TEST--
User-space streams: linkinfo()
--FILE--
<?php
class test_wrapper {
  function url_stat($url, $flags) {
    var_dump($flags);
    if ("test://a" === $url) {
      return ["dev" => 64512];
    } else {
      return false;
    }
  }
}
stream_wrapper_register('test', 'test_wrapper');

var_dump(STREAM_URL_STAT_LINK | STREAM_URL_STAT_QUIET);
var_dump(linkinfo("test://a"));
var_dump(linkinfo("test://b"));
--EXPECTF--
int(3)
int(3)
int(64512)
int(3)

Warning: linkinfo(): No such file or directory in %s on line %d
int(-1)
