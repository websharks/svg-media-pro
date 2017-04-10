<?php
/**
 * Media utils.
 *
 * @author @jaswrks
 * @copyright WP Sharks™
 */
declare(strict_types=1);
namespace WebSharks\WpSharks\SVGMedia\Pro\Traits\Facades;

use WebSharks\WpSharks\SVGMedia\Pro\Classes;
use WebSharks\WpSharks\SVGMedia\Pro\Interfaces;
use WebSharks\WpSharks\SVGMedia\Pro\Traits;
#
use WebSharks\WpSharks\SVGMedia\Pro\Classes\AppFacades as a;
use WebSharks\WpSharks\SVGMedia\Pro\Classes\SCoreFacades as s;
use WebSharks\WpSharks\SVGMedia\Pro\Classes\CoreFacades as c;
#
use WebSharks\WpSharks\Core\Classes as SCoreClasses;
use WebSharks\WpSharks\Core\Interfaces as SCoreInterfaces;
use WebSharks\WpSharks\Core\Traits as SCoreTraits;
#
use WebSharks\Core\WpSharksCore\Classes as CoreClasses;
use WebSharks\Core\WpSharksCore\Classes\Core\Base\Exception;
use WebSharks\Core\WpSharksCore\Interfaces as CoreInterfaces;
use WebSharks\Core\WpSharksCore\Traits as CoreTraits;
#
use function assert as debug;
use function get_defined_vars as vars;

/**
 * Media utils.
 *
 * @since $v Initial release.
 */
trait Media
{
    /*
     * @since $v Initial release.
     *
     * @param mixed ...$args Variadic args to underlying utility.
     *
     * @see Classes\Utils\Foo::bar()
     */
    // public static function foo(...$args)
    // {
    //     return $GLOBALS[static::class]->Utils->Foo->bar(...$args);
    // }
}
