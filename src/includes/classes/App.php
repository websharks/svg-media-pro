<?php
/**
 * Application.
 *
 * @author @jaswrks
 * @copyright WP Sharks™
 */
declare(strict_types=1);
namespace WebSharks\WpSharks\SVGMedia\Pro\Classes;

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
 * Application.
 *
 * @since $v Initial release.
 */
class App extends SCoreClasses\App
{
    /**
     * Version.
     *
     * @since $v
     *
     * @type string Version.
     */
    const VERSION = '170410.12633'; //v//

    /**
     * Constructor.
     *
     * @since $v Initial release.
     *
     * @param array $instance Instance args.
     */
    public function __construct(array $instance = [])
    {
        $instance_base = [
            '©di' => [
                '©default_rule' => [
                    'new_instances' => [],
                ],
            ],

            '§specs' => [
                '§in_wp'           => false,
                '§is_network_wide' => false,

                '§type'            => 'plugin',
                '§file'            => dirname(__FILE__, 4).'/plugin.php',
            ],
            '©brand' => [
                '©acronym'     => 'SVGMe',
                '©name'        => 'SVG Media',

                '©slug'        => 'svg-media',
                '©var'         => 'svg_media',

                '©short_slug'  => 'svg-me',
                '©short_var'   => 'svg_me',

                '©text_domain' => 'svg-media',
            ],

            '§pro_option_keys' => [],
            '§default_options' => [],
        ];
        parent::__construct($instance_base, $instance);
    }

    /**
     * Early hook setup handler.
     *
     * @since $v Initial release.
     */
    protected function onSetupEarlyHooks()
    {
        parent::onSetupEarlyHooks();

        s::addAction('vs_upgrades', [$this->Utils->Installer, 'onVsUpgrades']);
        s::addAction('other_install_routines', [$this->Utils->Installer, 'onOtherInstallRoutines']);
        s::addAction('other_uninstall_routines', [$this->Utils->Uninstaller, 'onOtherUninstallRoutines']);
    }

    /**
     * Other hook setup handler.
     *
     * @since $v Initial release.
     */
    protected function onSetupOtherHooks()
    {
        parent::onSetupOtherHooks();

        if ($this->Wp->is_admin) {
            // Uncomment to enable a default menu page template.
            // add_action('admin_menu', [$this->Utils->MenuPage, 'onAdminMenu']);

            add_filter('upload_mimes', [$this->Utils->Media, 'onUploadMimes']);
            add_filter('wp_prepare_attachment_for_js', [$this->Utils->Media, 'onWpPrepareAttachmentForJs'], 10, 2);
            add_action('admin_enqueue_scripts', [$this->Utils->StylesScripts, 'onAdminEnqueueScripts']);
        }
    }
}
