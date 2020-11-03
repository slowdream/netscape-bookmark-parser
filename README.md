# netscape-bookmark-parser
[![](https://img.shields.io/travis/shaarli/netscape-bookmark-parser/master.svg?style=flat-square&label=master)](https://travis-ci.org/shaarli/netscape-bookmark-parser)
[![](https://img.shields.io/github/release/shaarli/netscape-bookmark-parser.svg?style=flat-square)](https://github.com/shaarli/netscape-bookmark-parser/releases/latest/)
[![license](https://img.shields.io/github/license/shaarli/netscape-bookmark-parser.svg?style=flat-square)](https://opensource.org/licenses/MIT)


## About
This library provides a generic `NetscapeBookmarkParser` class that is able
of parsing Netscape bookmarks as exported by common Web browsers and
bookmarking services.

The motivations behind developing this parser are the following:
- the [Netscape format](https://msdn.microsoft.com/en-us/library/aa753582%28v=vs.85%29.aspx)
  has a very loose specification:
  no [DTD](https://en.wikipedia.org/wiki/Document_type_definition)
  nor [XSL stylesheet](https://en.wikipedia.org/wiki/XSL)
  to constrain how data is formatted
- software and web services export bookmarks using a wild variety of attribute
  names and values
- using standard SAX or DOM parsers is thus not straightforward.

How it works:
- the input bookmark file is trimmed and sanitized to improve parsing results
- the resulting data is then parsed using [PCRE](http://www.pcre.org/) patterns
  to match attributes and values corresponding to the most likely:
    - attribute names: `description` vs. `note`, `tags` vs. `labels`, `date` vs. `time`, etc.
    - data formats: `comma,separated,tags` vs. `space separated labels`,
      UNIX epochs vs. human-readable dates, newlines & carriage returns, etc.
- an associative array containing all successfully parsed links with their
  attributes is returned

### Shaarli community fork
This friendly fork is maintained by the Shaarli community at
https://github.com/shaarli/netscape-bookmark-parser and is used by the
open-source [Shaarli](https://github.com/shaarli/Shaarli) bookmarking service.
This is a community fork of the original
[netscape-bookmark-parser](https://github.com/kafene/netscape-bookmark-parser)
project by [Kafene](http://kafene.org/).

## Installation

Using [Composer](https://getcomposer.org/) ([package](https://packagist.org/packages/shaarli/netscape-bookmark-parser)):

```bash
composer require shaarli/netscape-bookmark-parser
```

## Example
Script:
```php
<?php

require_once 'vendor/autoload.php';

use Shaarli\NetscapeBookmarkParser\NetscapeBookmarkParser;

$parser = new NetscapeBookmarkParser();
$bookmarks = $parser->parseFile('./tests/input/netscape_basic.htm');
var_dump($bookmarks);
```

Output:
```
array(2) {
  [0] =>
  array(6) {
    'uri' =>
    string(19) "https://private.tld"
    'title' =>
    string(12) "Secret stuff"
    'note' =>
    string(52) "Super-secret stuff you're not supposed to know about"
    'tags' =>
    array(2) {
      [0] =>
      string(7) "private"
      [1] =>
      string(6) "secret"
    }
    'time' =>
    int(971175336)
    'pub' =>
    int(0)
  }
  [1] =>
  array(6) {
    'uri' =>
    string(17) "http://public.tld"
    'title' =>
    string(12) "Public stuff"
    'note' =>
    string(0) ""
    'tags' =>
    array(3) {
      [0] =>
      string(6) "public"
      [1] =>
      string(5) "hello"
      [2] =>
      string(5) "world"
    }
    'time' =>
    int(1456433748)
    'pub' =>
    int(1)
  }
}
```
