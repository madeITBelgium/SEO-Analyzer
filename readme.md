# PHP SEO Analyzer
[![Build Status](https://travis-ci.org/madeITBelgium/SEO-Analyzer.svg?branch=master)](https://travis-ci.org/madeITBelgium/SEO-Analyzer)
[![Coverage Status](https://coveralls.io/repos/github/madeITBelgium/SEO-Analyzer/badge.svg?branch=master)](https://coveralls.io/github/madeITBelgium/SEO-Analyzer?branch=master)
[![Latest Stable Version](https://poser.pugx.org/madeITBelgium/SEO-Analyzer/v/stable.svg)](https://packagist.org/packages/madeITBelgium/SEO-Analyzer)
[![Latest Unstable Version](https://poser.pugx.org/madeITBelgium/SEO-Analyzer/v/unstable.svg)](https://packagist.org/packages/madeITBelgium/SEO-Analyzer)
[![Total Downloads](https://poser.pugx.org/madeITBelgium/SEO-Analyzer/d/total.svg)](https://packagist.org/packages/madeITBelgium/SEO-Analyzer)
[![License](https://poser.pugx.org/madeITBelgium/SEO-Analyzer/license.svg)](https://packagist.org/packages/madeITBelgium/SEO-Analyzer)

With this (Laravel) package you can analyze the on-page SEO.

# Installation

Require this package in your `composer.json` and update composer.

```php
"madeitbelgium/seo-analyzer": "~1.0"
```

# Documentation
## Usage
```php
use \MadeITBelgium\SeoAnalyzer\Facade\SEO();

SEO::analyze('https://www.madeit.be');
```

The complete documentation can be found at: [http://www.madeit.be/](http://www.madeit.be/)


# Support
Support github or mail: tjebbe.lievens@madeit.be

# Contributing
Please try to follow the psr-2 coding style guide. http://www.php-fig.org/psr/psr-2/

# License
This package is licensed under LGPL. You are free to use it in personal and commercial projects. The code can be forked and modified, but the original copyright author should always be included!
