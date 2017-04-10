<?php
/**
 * Styles/scripts.
 *
 * @author @jaswrks
 * @copyright WP Sharks™
 */
declare(strict_types=1);
namespace WebSharks\WpSharks\SVGMedia\Pro\Classes\Utils;

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
 * Styles/scripts.
 *
 * @since $v Initial release.
 */
class StylesScripts extends SCoreClasses\SCore\Base\Core
{
    /**
     * On `admin_enqueue_scripts` hook.
     *
     * @since $v Initial release.
     */
    public function onAdminEnqueueScripts()
    {
        $brand_slug = $this->App->Config->©brand['©slug'];
        $brand_var  = $this->App->Config->©brand['©var'];

        s::enqueueLibs(__METHOD__, [
            'styles' => [
                $brand_slug => [
                    'deps' => ['wp-admin'],
                    'ver'  => $this->App::VERSION,
                    'url'  => c::appUrl('/client-s/css/admin/svgs.min.css'),
                ],
            ],
        ]);
    }
}
