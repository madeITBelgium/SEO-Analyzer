<?php

namespace MadeITBelgium\SeoAnalyzer;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;
use IvoPetkov\HTML5DOMDocument;

/**
 * @version    1.0.0
 *
 * @copyright  Copyright (c) 2018 Made I.T. (http://www.madeit.be)
 * @author     Tjebbe Lievens <tjebbe.lievens@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class Seo
{
    private $client = null;
    private $stopWords = [
            'we', 'en', 'van', 'een', 'je', 'bij', 'voor', 'het', 'met', 'kan', 'dat', 'in', 'is',
            'de', 'of', 'kunnen', 'door', 'alle', 'ons', 'gaan', 'leuke', 'op', 'nu', 'daarnaast', 'dit',
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't',
            'u', 'v', 'w', 'x', 'y', 'z', 'terecht',
            'de', 'la',
            'get', 'aan', 'wij', 'hoe',

            'touch', 'enkele',

                    'te',
                    'om',
                    'ook',
                    'die',
                    'niet',
                    'manier',
                    'naar',
                    'ontmoet',
                    'heb',
                    'deze',
                    'nog',
                    'al',
                    'zijn',
                    'wel',

                    '-',
                    'wat',
                    'wordt',

            'able', 'about', 'above', 'abroad', 'according', 'accordingly', 'across', 'actually', 'after', 'afterwards', 'again', 'against', 'ago', 'ahead', 'ain\'t', 'all', 'allow',
            'allows', 'almost', 'alone', 'along', 'alongside', 'already', 'also', 'although', 'always', 'am', 'amid', 'amidst', 'among', 'amongst', 'an', 'and', 'another', 'any', 'anybody',
            'anyhow', 'anyone', 'anything', 'anyway', 'anyways', 'anywhere', 'apart', 'appear', 'appreciate', 'appropriate', 'are', 'aren\'t', 'around', 'as', 'aside', 'ask', 'asking',
            'associated', 'at', 'available', 'away', 'awfully', 'back', 'backward', 'backwards', 'be', 'became', 'because', 'become', 'becomes', 'becoming', 'been', 'before', 'beforehand',
            'begin', 'behind', 'being', 'believe', 'below', 'beside', 'besides', 'best', 'better', 'between', 'beyond', 'both', 'brief', 'but', 'by', 'came', 'can', 'cannot', 'cant', 'can\'t',
            'caption', 'cause', 'causes', 'certain', 'certainly', 'changes', 'clearly', 'c\'mon', 'come', 'comes', 'concerning', 'consequently', 'consider', 'considering', 'contain', 'containing',
            'contains', 'corresponding', 'could', 'couldn\'t', 'course', 'currently', 'dare', 'daren\'t', 'definitely', 'described', 'despite', 'does', 'doesn\'t', 'doing', 'done', 'don\'t',
            'did', 'didn\'t', 'different', 'directly', 'do', 'down', 'downwards', 'during', 'each', 'eight', 'eighty', 'either', 'else', 'elsewhere', 'end', 'ending', 'enough', 'entirely',
            'especially', 'etc', 'even', 'ever', 'evermore', 'every', 'everybody', 'everyone', 'everything', 'everywhere', 'ex', 'exactly', 'example', 'except', 'fairly', 'far', 'farther',
            'few', 'fewer', 'fifth', 'first', 'five', 'followed', 'following', 'follows', 'for', 'found', 'four', 'from', 'forever', 'former', 'formerly', 'forth', 'forward', 'further',
            'furthermore', 'get', 'gets', 'getting', 'given', 'gives', 'go', 'gotten', 'greetings', 'goes', 'going', 'gone', 'got', 'had', 'hadn\'t', 'half', 'happens', 'hardly', 'has',
            'hasn\'t', 'have', 'haven\'t', 'having', 'he', 'he\'d', 'he\'ll', 'hello', 'help', 'hence', 'her', 'here', 'hereafter', 'hereby', 'herein', 'here\'s', 'hereupon', 'hers',
            'herself', 'he\'s', 'hi', 'him', 'himself', 'his', 'hither', 'hopefully', 'how', 'however', 'hudred', 'i\'d', 'if', 'ignored', 'i\'ll', 'i\'m', 'immediate', 'in', 'inc.',
            'indeed', 'indicate', 'indicated', 'indicates', 'inner', 'inside', 'instead', 'into', 'inward', 'is', 'isn\'t', 'it', 'it\'d', 'it\'ll', 'its', 'it\'s', 'itself', 'i\'ve',
            'just', 'keep', 'keeps', 'kept', 'know', 'known', 'knows', 'last', 'lately', 'later', 'latter', 'latterly', 'least', 'less', 'lest', 'let', 'let\'s', 'like', 'liked', 'likely',
            'likewise', 'little', 'look', 'looking', 'looks', 'low', 'lower', 'made', 'mainly', 'make', 'makes', 'many', 'may', 'maybe', 'mayn\'t', 'me', 'mean', 'meantime', 'meanwhile',
            'merely', 'might', 'mine', 'minus', 'miss', 'more', 'moreover', 'most', 'mostly', 'mr', 'mrs', 'much', 'must', 'mustn\'t', 'my', 'myself', 'name', 'namely', 'near', 'nearly',
            'necessary', 'ne', 'needn\'t', 'needs', 'neither', 'never', 'neverf', 'neverless', 'nevertheless', 'new', 'next', 'nine', 'ninety', 'no', 'nobody', 'non', 'none', 'nonetheless',
            'nor', 'normally', 'not', 'nothing', 'notwithstanding', 'novel', 'now', 'nowhere', 'obviously', 'of', 'off', 'often', 'oh', 'ok', 'okay', 'old', 'on', 'once', 'one', 'ones',
            'one\'s', 'only', 'onto', 'opposite', 'or', 'other', 'others', 'otherwise', 'ought', 'oughtn\'t', 'our', 'ours', 'ourselves', 'out', 'outside', 'over', 'overall', 'own',
            'particular', 'particularly', 'past', 'per', 'perhaps', 'placed', 'please', 'plus', 'possible', 'presumably', 'probably', 'provided', 'provides', 'que', 'quite', 'rather',
            'really', 'reasonably', 'recent', 'recently', 'regarding', 'regardless', 'regards', 'relatively', 'respectively', 'right', 'round', 'said', 'same', 'saw', 'say', 'saying',
            'says', 'second', 'secondly', 'see', 'seeing', 'seem', 'seemed', 'seeming', 'seems', 'seen', 'self', 'selves', 'sensible', 'sent', 'serious', 'seriously', 'seven', 'several',
            'shall', 'shan\'t', 'she', 'she\'d', 'she\'ll', 'she\'s', 'should', 'shouldn\'t', 'since', 'six', 'so', 'some', 'somebody', 'someday', 'somehow', 'someone', 'something', 'sometime',
            'sometimes', 'somewhat', 'somewhere', 'soon', 'sorry', 'specified', 'specify', 'specifying', 'still', 'sub', 'such', 'sure', 'take', 'taken', 'taking', 'tell', 'tends', 'than', 'thank',
            'thanks', 'thanx', 'that', 'that\'ll', 'thats', 'that\'s', 'that\'ve', 'the', 'their', 'theirs', 'them', 'themselves', 'then', 'thence', 'there', 'thereafter', 'thereby', 'there\'d',
            'therefore', 'therein', 'there\'ll', 'there\'re', 'theres', 'there\'s', 'thereupon', 'there\'ve', 'these', 'they', 'they\'d', 'they\'ll', 'they\'re', 'they\'ve', 'thing', 'things',
            'think', 'third', 'thirty', 'this', 'thorough', 'thoroughly', 'those', 'though', 'three', 'through', 'throughout', 'thru', 'thus', 'till', 'to', 'together', 'too', 'took', 'toward',
            'towards', 'tried', 'tries', 'truly', 'try', 'trying', 'twice', 'two', 'under', 'underneath', 'undoing', 'unfortunately', 'unless', 'unlike', 'unlikely', 'until', 'unto', 'up', 'upon',
            'upwards', 'us', 'use', 'used', 'useful', 'uses', 'using', 'usually', 'value', 'various', 'versus', 'very', 'via', 'vs', 'vs.', 'want', 'wants', 'was', 'wasn\'t', 'way', 'we', 'we\'d',
            'welcome', 'well', 'we\'ll', 'went', 'were', 'we\'re', 'weren\'t', 'we\'ve', 'what', 'whatever', 'what\'ll', 'what\'s', 'what\'ve', 'when', 'whence', 'whenever', 'where', 'whereafter',
            'whereas', 'whereby', 'wherein', 'where\'s', 'whereupon', 'wherever', 'whether', 'which', 'whichever', 'while', 'whilst', 'whither', 'who', 'who\'d', 'whoever', 'whole', 'who\'ll', 'whom',
            'whomever', 'who\'s', 'whose', 'why', 'will', 'willing', 'wish', 'with', 'within', 'without', 'wonder', 'won\'t', 'would', 'wouldn\'t', 'yes', 'yet', 'you', 'you\'d', 'you\'ll', 'your',
            'you\'re', 'yours', 'yourself', 'yourselves', 'you\'ve', 'zero',

        ];

    private $baseUrl;
    private $domainUrl;
    private $domainname;
    private $loadtime = 0;

    public function __construct($client = null)
    {
        if (null === $client) {
            $this->client = new Client([
                'timeout'  => 10.0,
                'headers'  => [
                    'User-Agent' => 'Made I.T. Seo Analyzer',
                ],
                'verify' => true,
            ]);
        } else {
            $this->client = $client;
        }
    }

    public function setClient($client)
    {
        $this->client = $client;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function analyze($url)
    {
        $this->baseUrl = parse_url($url, PHP_URL_SCHEME).'://'.parse_url($url, PHP_URL_HOST).'/'.parse_url($url, PHP_URL_PATH);
        $this->domainUrl = parse_url($url, PHP_URL_SCHEME).'://'.parse_url($url, PHP_URL_HOST);
        $this->domainname = parse_url($url, PHP_URL_HOST);

        $content = $this->getPageContent($url);

        $document = $this->parseHtml($content);
        $nodes = $this->parseHtmlIntoBlocks($document);

        $titleNode = $document->querySelector('title');
        $title = $this->getTextContent($titleNode->outerHTML);

        $description = '';
        $metaNodes = $document->querySelectorAll('meta');
        foreach ($metaNodes as $node) {
            $attributes = $node->getAttributes();
            if (isset($attributes['name']) && isset($attributes['content']) && $attributes['name'] === 'description') {
                $description = $attributes['content'];
            }
        }

        $cannonical = '';
        $linkNodes = $document->querySelectorAll('link');
        foreach ($linkNodes as $node) {
            $attributes = $node->getAttributes();
            if (isset($attributes['rel']) && isset($attributes['href']) && $attributes['rel'] === 'canonical') {
                $cannonical = $attributes['href'];
            }
        }

        //Full page result
        $usableSource = $content;
        $usableText = $this->getTextContent($usableSource);

        $htmlTxtRatio = strlen($usableText) / strlen($usableSource) * 100;

        $fullPageResult = [
            'codeToTxtRatio' => [
                'total_length' => strlen($usableSource),
                'text_length'  => strlen($usableText),
                'ratio'        => $htmlTxtRatio,
            ],
            'word_count'       => $this->countWords($usableText),
            'keywords'         => $this->findKeywords($usableText),
            'longTailKeywords' => $this->getLongTailKeywords($usableText),
            'headers'          => $this->doHeaderResult($document),
            'links'            => $this->doLinkResult($document),
            'images'           => $this->doImageResult($document),
        ];

        //Usaable Node result
        $node = $this->getWebsiteUsabelNode($nodes);

        $usableSource = $node['node']->outerHTML;
        $usableText = $this->getTextContent($usableSource);

        $htmlTxtRatio = strlen($usableText) / strlen($usableSource) * 100;

        $mainTxtResult = [
            'text'           => $usableText,
            'codeToTxtRatio' => [
                'total_length' => strlen($usableSource),
                'text_length'  => strlen($usableText),
                'ratio'        => $htmlTxtRatio,
            ],
            'word_count'       => $this->countWords($usableText),
            'keywords'         => $this->findKeywords($usableText),
            'longTailKeywords' => $this->getLongTailKeywords($usableText),
            'headers'          => $this->doHeaderResult($node['node']),
            'links'            => $this->doLinkResult($node['node']),
            'images'           => $this->doImageResult($node['node']),
        ];

        $result = [
            'url'         => $url,
            'cannonical'  => $cannonical,
            'baseUrl'     => $this->baseUrl,
            'domainUrl'   => $this->domainUrl,
            'domainname'  => $this->domainname,
            'title'       => $title,
            'description' => $description,
            'loadtime'    => $this->loadtime,
            'full_page'   => $fullPageResult,
            'main_text'   => $mainTxtResult,
        ];

        return $result;
    }

    private function getPageContent($url)
    {
        $response = $this->client->request('GET', $url, [
            'on_stats' => function (TransferStats $stats) {
                $this->loadtime = $stats->getTransferTime();
            },
        ]);

        $body = (string) $response->getBody();

        return $body;
    }

    private function getTextContent($text)
    {
        $text = preg_replace(
        [
            // Remove invisible content
            '@<head[^>]*?>.*?</head>@siu',
            '@<style[^>]*?>.*?</style>@siu',
            '@<script[^>]*?.*?</script>@siu',
            '@<object[^>]*?.*?</object>@siu',
            '@<embed[^>]*?.*?</embed>@siu',
            '@<applet[^>]*?.*?</applet>@siu',
            '@<noframes[^>]*?.*?</noframes>@siu',
            '@<noscript[^>]*?.*?</noscript>@siu',
            '@<noembed[^>]*?.*?</noembed>@siu',

            // Add line breaks before & after blocks
            '@<((br)|(hr))@iu',
            '@</?((address)|(blockquote)|(center)|(del))@iu',
            '@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
            '@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
            '@</?((table)|(th)|(td)|(caption))@iu',
            '@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
            '@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
            '@</?((frameset)|(frame)|(iframe))@iu',
        ],
        [
            ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
            "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
            "\n\$0", "\n\$0",
        ],
        $text);

        // Remove all remaining tags and comments and return.
        return strip_tags($text);
    }

    private function getWebsiteUsabelNode($nodes)
    {
        $node = $this->findLargestNode($nodes);

        return $node;
    }

    private function findLargestNode($nodes)
    {
        $largestNode = null;
        $largestTxtLength = 0;
        foreach ($nodes as $token => $node) {
            $length = strlen($this->getTextContent($node['node']->outerHTML));
            if ($largestTxtLength < $length) {
                $largestTxtLength = $length;
                $largestNode = $node;
            }
        }

        $largestChildNode = $this->findLargestChildNode($largestNode['childs'], $largestTxtLength);

        if ($largestChildNode === false) {
            throw Exception("Can't find main text block.");
        }

        return $largestChildNode;
    }

    private function parseHtml($body)
    {
        $dom = new HTML5DOMDocument();
        $dom->loadHTML($body);

        return $dom;
    }

    private function parseHtmlIntoBlocks($document)
    {
        $bodyNode = $document->querySelector('body');

        $nodes = $this->loadChilds($bodyNode);

        return $nodes;
    }

    private function loadChilds($node)
    {
        $parentTagName = $node->tagName;
        $parentToken = md5($node->outerHTML);
        $qry = $node->querySelectorAll('*');

        $childs = [];
        foreach ($qry as $child) {
            if (!isset($node->tagName)) {
                continue;
            }
            if (in_array($child->tagName, ['svg', 'script'])) {
                continue;
            }

            if ($parentTagName === $child->parentNode->tagName && $parentToken === md5($child->parentNode->outerHTML)) {
                $loadedChilds = $this->loadChilds($child);
                $childs[md5($child->outerHTML)] = [
                    'node'   => $child,
                    'childs' => $loadedChilds,
                ];
            }
        }

        return $childs;
    }

    private function findLargestChildNode($nodes, $maxLength)
    {
        $largestNode = null;
        $largestTxtLength = 0;
        foreach ($nodes as $token => $node) {
            $length = strlen($this->getTextContent($node['node']->outerHTML));
            if ($largestTxtLength < $length) {
                $largestTxtLength = $length;
                $largestNode = $node;
            }
        }

        if ($maxLength / 2 < $largestTxtLength) {
            if (count($largestNode['childs']) === 0) {
                return $largestNode;
            }

            $possibleLargestNode = $this->findLargestChildNode($largestNode['childs'], $maxLength);
            if ($possibleLargestNode !== false) {
                return $possibleLargestNode;
            }

            return $largestNode;
        }

        return false;
    }

    private function countWords($content)
    {
        return count(str_word_count(strtolower($content), 1));
    }

    private function findKeywords($content, $min = 3)
    {
        $words = str_word_count(strtolower($content), 1);
        $word_count = array_count_values($words);
        arsort($word_count);

        foreach ($this->stopWords as $s) {
            unset($word_count[$s]);
        }

        $word_count = array_filter($word_count, function ($value) use ($min) {
            return $value >= $min;
        });

        return $word_count;
    }

    private function getLongTailKeywords($strs, $len = 3, $min = 2)
    {
        $keywords = [];
        if (!is_array($strs)) {
            $strs = [$strs];
        }

        foreach ($strs as $str) {
            $str = preg_replace('/[^a-z0-9\s-]+/', '', strtolower($str));
            $str = preg_split('/\s+-\s+|\s+/', $str, -1, PREG_SPLIT_NO_EMPTY);
            while (0 < $len--) {
                for ($i = 0; $i < count($str) - $len; $i++) {
                    $word = array_slice($str, $i, $len + 1);
                    if (in_array($word[0], $this->stopWords) || in_array(end($word), $this->stopWords)) {
                        continue;
                    }

                    $word = implode(' ', $word);

                    if (!isset($keywords[$len][$word])) {
                        $keywords[$len][$word] = 0;
                    }
                    $keywords[$len][$word]++;
                }
            }
        }

        $return = [];
        foreach ($keywords as &$keyword) {
            $keyword = array_filter($keyword, function ($v) use ($min) {
                return (bool) ($v > $min);
            });
            arsort($keyword);
            $return = array_merge($return, $keyword);
        }

        return $return;
    }

    private function doHeaderResult($document)
    {
        $tags = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'];
        $result = [];

        foreach ($tags as $tag) {
            $elements = $document->querySelectorAll($tag);

            $content = [];
            foreach ($elements as $element) {
                $content[] = $this->getTextContent($element->outerHTML);
            }

            $txt = implode(' ', $content);

            $result[$tag] = [
                'count'            => count($content),
                'words'            => count(str_word_count(strtolower($txt), 1)),
                'keywords'         => $this->findKeywords($txt, 1),
                'longTailKeywords' => $this->getLongTailKeywords($content, 2, 2),
            ];
        }

        return $result;
    }

    private function doLinkResult($document)
    {
        $elements = $document->querySelectorAll('a');
        $internal = 0;
        $external = 0;
        $follow = 0;
        $nofollow = 0;

        $content = [];
        foreach ($elements as $element) {
            $content[] = $this->getTextContent($element->outerHTML);
            $attributes = $element->getAttributes();
            if (isset($attributes['href'])) {
                $url = $this->fixUrl($attributes['href']);
                if ($this->isInternal($url)) {
                    $internal++;
                } else {
                    $external++;
                }

                if (isset($attributes['rel'])) {
                    if (strpos($attributes['rel'], 'nofollow') >= 0) {
                        $nofollow++;
                    } else {
                        $follow++;
                    }
                } else {
                    $follow++;
                }
            }
        }

        $txt = implode(' ', $content);

        return [
            'count'            => count($content),
            'words'            => count(str_word_count(strtolower($txt), 1)),
            'keywords'         => $this->findKeywords($txt, 1),
            'longTailKeywords' => $this->getLongTailKeywords($content, 2, 2),
            'internal'         => $internal,
            'external'         => $external,
            'follow'           => $follow,
            'nofollow'         => $nofollow,
        ];
    }

    private function doImageResult($document)
    {
        $elements = $document->querySelectorAll('img');

        $content = [];
        foreach ($elements as $element) {
            $attributes = $element->getAttributes();
            if (isset($attributes['alt'])) {
                $content[] = $this->getTextContent($attributes['alt']);
            }
        }

        $txt = implode(' ', $content);

        return [
            'count'            => count($elements),
            'count_alt'        => count($content),
            'words'            => count(str_word_count(strtolower($txt), 1)),
            'keywords'         => $this->findKeywords($txt, 1),
            'longTailKeywords' => $this->getLongTailKeywords($content, 2, 2),
        ];
    }

    private function fixUrl($url)
    {
        if (strpos($url, 'http://') === 0) {
            return $url;
        }

        if (strpos($url, 'https://') === 0) {
            return $url;
        }

        if (strpos($url, '/') === 0) {
            return $this->domainUrl.$url;
        }

        return $this->baseUrl.$url;
    }

    private function isInternal($url)
    {
        if (strpos($url, $this->domainname) > 0) {
            return true;
        }

        return false;
    }
}
