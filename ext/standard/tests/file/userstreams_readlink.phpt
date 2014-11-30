--TEST--
User-space streams: url_readlink()
--FILE--
<?php
class test_wrapper {
  function url_readlink($url) {
    if ("test://a" === $url) {
      return "test://b";
    } else if ("test://b" === $url) {
      trigger_error($url." is not a link");
      return false;
    } else {
      return null;
    }
  }
}
stream_wrapper_register('test', 'test_wrapper');

var_dump(readlink("test://a"));
var_dump(readlink("test://b"));
var_dump(readlink("test://c"));
--EXPECTF--
string(8) "test://b"

Notice: test://b is not a link in %s on line %d
bool(false)

Warning: readlink(): test_wrapper::url_readlink failed! in %s on line %d
bool(false)