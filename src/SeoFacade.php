<?php

namespace MadeITBelgium\SeoAnalyzer;

use Illuminate\Support\Facades\Facade;

/**
 * @version    1.0.0
 *
 * @copyright  Copyright (c) 2018 Made I.T. (http://www.madeit.be)
 * @author     Tjebbe Lievens <tjebbe.lievens@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class SeoFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'seo-analyzer';
    }
}
