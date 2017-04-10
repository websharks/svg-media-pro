<?php
/**
 * Media utils.
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
 * Media utils.
 *
 * @since $v Initial release.
 */
class Media extends SCoreClasses\SCore\Base\Core
{
    /**
     * On `upload_mimes` filter.
     *
     * @since $v Initial release.
     *
     * @param array $mime_types MIME types.
     *
     * @return array Filtered MIME types.
     */
    public function onUploadMimes(array $mime_types): array
    {
        return $mime_types + ['svg' => 'image/svg+xml'];
    }

    /**
     * On `wp_prepare_attachment_for_js` filter.
     *
     * @since $v Initial release.
     *
     * @param array    $response Array of prepared attachment data.
     * @param \WP_Post $WP_Post  Attachment post; e.g., `\WP_Post` instance.
     *
     * @return array Filtered response.
     */
    public function onWpPrepareAttachmentForJs(array $response, \WP_Post $WP_Post): array
    {
        if ($response['mime'] !== 'image/svg+xml') {
            return $response; // Not applicable.
        } elseif (!empty($response['sizes'])) {
            return $response; // Unnecessary.
        }
        if (!($file = get_attached_file($WP_Post->ID))) {
            return $response; // Not possible.
        } elseif (!($svg = simplexml_load_file($file))) {
            return $response; // Not possible.
        } elseif (!($svg_attrs = $svg->attributes())) {
            return $response; // Not possible.
        }
        $width  = (int) ($svg_attrs->width ?? 0);
        $height = (int) ($svg_attrs->height ?? 0);

        if (!$width || !$height) {
            $view_box = (string) ($svg_attrs->viewBox ?? '');
            $view_box = $view_box ? preg_split('/\s+/u', $view_box) : [];

            $width  = (int) ($view_box[2] ?? 0); // e.g., `0 0 w`.
            $height = (int) ($view_box[3] ?? 0); // e.g., `0 0 w h`.
        }
        if (!$width || !$height) {
            $style = (string) ($svg_attrs->style ?? '');
            preg_match('/(?:^|[;\s])width\s*\:\s*(?<width>[1-9][0-9]*)px/ui', $style, $_w);
            preg_match('/(?:^|[;\s])height\s*\:\s*(?<height>[1-9][0-9]*)px/ui', $style, $_h);

            $width  = (int) ($_w[1] ?? 0); // e.g., `width:256px`.
            $height = (int) ($_h[1] ?? 0); // e.g., `height:256px`.
        }
        if (!$width || !$height) {
            return $response; // Not possible.
        }
        $response['sizes'] = [
            'full' => [
                'width'       => $width,
                'height'      => $height,
                'url'         => $response['url'],
                'orientation' => $width > $height ? 'landscape' : 'portrait',
            ],
        ];
        return $response;
    }
}
