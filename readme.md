# PHP SEO Analyzer
[![Build Status](https://travis-ci.org/madeITBelgium/SEO-Analyzer.svg?branch=master)](https://travis-ci.org/madeITBelgium/SEO-Analyzer)
[![Coverage Status](https://coveralls.io/repos/github/madeITBelgium/SEO-Analyzer/badge.svg?branch=master)](https://coveralls.io/github/madeITBelgium/SEO-Analyzer?branch=master)
[![Latest Stable Version](https://poser.pugx.org/madeITBelgium/SEO-Analyzer/v/stable.svg)](https://packagist.org/packages/madeITBelgium/SEO-Analyzer)
[![Latest Unstable Version](https://poser.pugx.org/madeITBelgium/SEO-Analyzer/v/unstable.svg)](https://packagist.org/packages/madeITBelgium/SEO-Analyzer)
[![Total Downloads](https://poser.pugx.org/madeITBelgium/SEO-Analyzer/d/total.svg)](https://packagist.org/packages/madeITBelgium/SEO-Analyzer)
[![License](https://poser.pugx.org/madeITBelgium/SEO-Analyzer/license.svg)](https://packagist.org/packages/madeITBelgium/SEO-Analyzer)

With this (Laravel) package you can analyze the on-page SEO.

This package search for the main content to optimze the SEO results for the content that matters. Ex.: A blog post webpage analyze full webpage and only the blog post text.

Webpage:
- Get title
- Get description
- Loadtime

Full page analyze
- code To Text Ratio
- Word Count
- Keywords
- Long tail keywords
- Headers (H1, H2, ...): Count, word count, keywords, long tail keywords
- Links: Count, word count, keywords, long tail keywords, internal links, external links, follow, nofollow
- images: Count, Count with alt text, Count words in alt text, keywords, long tail keywords
 
Detect main content
- code To Text Ratio
- Word Count
- Keywords
- Long tail keywords
- Headers (H1, H2, ...): Count, word count, keywords, long tail keywords
- Links: Count, word count, keywords, long tail keywords, internal links, external links, follow, nofollow
- images: Count, Count with alt text, Count words in alt text, keywords, long tail keywords
 

# Installation

Require this package in your `composer.json` and update composer.

```php
"madeitbelgium/seo-analyzer": "^0.9"
```

# Documentation
## Usage
```php
use MadeITBelgium\SeoAnalyzer\SeoFacade as SEO;

SEO::analyze('https://www.madeit.be');
```

If you already have the HTML content of the page:
```php
use MadeITBelgium\SeoAnalyzer\SeoFacade as SEO;
$html = "<html>....</html>";
SEO::analyze('https://www.madeit.be', $html);
```

The complete documentation can be found at: [http://www.madeit.be/](http://www.madeit.be/)


# Support
Support github or mail: tjebbe.lievens@madeit.be

# Contributing
Please try to follow the psr-2 coding style guide. http://www.php-fig.org/psr/psr-2/

# License
This package is licensed under LGPL. You are free to use it in personal and commercial projects. The code can be forked and modified, but the original copyright author should always be included!
