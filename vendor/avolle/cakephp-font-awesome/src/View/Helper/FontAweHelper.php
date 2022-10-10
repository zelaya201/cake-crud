<?php
declare(strict_types=1);

namespace Avolle\FontAwesome\View\Helper;

use Cake\View\Helper;

/**
 * FontAwe helper
 *
 * @property \Cake\View\Helper\HtmlHelper $Html CakePHP Core Html Helper
 */
class FontAweHelper extends Helper
{
    /**
     * FontAwesome Solid icon type
     */
    public const SOLID = 'fas';

    /**
     * FontAwesome Regular icon type
     */
    public const REGULAR = 'far';

    /**
     * FontAwesome Light icon type
     */
    public const LIGHT = 'fal';

    /**
     * FontAwesome Duotone icon type
     */
    public const DUO = 'fad';

    /**
     * FontAwesome Brand icon type
     */
    public const BRAND = 'fab';

    /**
     * FontAwesome Thin icon type
     */
    public const THIN = 'fat';

    /**
     * Base link for getting a FontAwesome kit. Kit identifier will be added by using sprintf()
     */
    public const KIT_URL = 'https://kit.fontawesome.com/%s.js';

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * List of helpers used by this helper
     *
     * @var array
     */
    protected $helpers = ['Html'];

    /**
     * Template for FontAwesome icon class attribute
     *
     * @var string
     */
    protected string $iconClassTemplate = '%s fa-%s';

    /**
     * Create a FontAwesome Solid icon with optional title appended
     *
     * @param string $icon FontAwesome icon
     * @param string|null $title Anchor text
     * @param array $options Attributes to pass to icon element <i />
     * @return string Finished FontAwesome Solid icon and optional title
     */
    public function solid(string $icon, ?string $title = '', array $options = []): string
    {
        return $this->icon(self::SOLID, $icon, $title, $options);
    }

    /**
     * Create a link with a FontAwesome Solid icon
     *
     * @param string $icon FontAwesome icon
     * @param string|array $url Html url as string or array
     * @param string|null $title Anchor text included with icon
     * @param array $options Attributes to pass to anchor element (pass icon attributes through $options['icon'])
     * @return string Finished anchor element with FontAwesome Solid icon and title
     */
    public function solidLink(string $icon, $url, ?string $title = '', array $options = []): string
    {
        return $this->link(self::SOLID, $icon, $url, $title, $options);
    }

    /**
     * Create a FontAwesome Regular icon with optional title appended
     *
     * @param string $icon FontAwesome icon
     * @param string|null $title Anchor text
     * @param array $options Attributes to pass to icon element <i />
     * @return string Finished FontAwesome Regular icon and optional title
     */
    public function regular(string $icon, ?string $title = '', array $options = []): string
    {
        return $this->icon(self::REGULAR, $icon, $title, $options);
    }

    /**
     * Create a link with a FontAwesome Regular icon
     *
     * @param string $icon FontAwesome icon
     * @param string|array $url Html url as string or array
     * @param string|null $title Anchor text included with icon
     * @param array $options Attributes to pass to anchor element (pass icon attributes through $options['icon'])
     * @return string Finished anchor element with FontAwesome Regular icon and title
     */
    public function regularLink(string $icon, $url, ?string $title = '', array $options = []): string
    {
        return $this->link(self::REGULAR, $icon, $url, $title, $options);
    }

    /**
     * Create a FontAwesome Light icon with optional title appended
     *
     * @param string $icon FontAwesome icon
     * @param string|null $title Anchor text
     * @param array $options Attributes to pass to icon element <i />
     * @return string Finished FontAwesome Light icon and optional title
     */
    public function light(string $icon, ?string $title = '', array $options = []): string
    {
        return $this->icon(self::LIGHT, $icon, $title, $options);
    }

    /**
     * Create a link with a FontAwesome Light icon
     *
     * @param string $icon FontAwesome icon
     * @param string|array $url Html url as string or array
     * @param string|null $title Anchor text included with icon
     * @param array $options Attributes to pass to anchor element (pass icon attributes through $options['icon'])
     * @return string Finished anchor element with FontAwesome Light icon and title
     */
    public function lightLink(string $icon, $url, ?string $title = '', array $options = []): string
    {
        return $this->link(self::LIGHT, $icon, $url, $title, $options);
    }

    /**
     * Create a FontAwesome Duotone icon with optional title appended
     *
     * @param string $icon FontAwesome icon
     * @param string|null $title Anchor text
     * @param array $options Attributes to pass to icon element <i />
     * @return string Finished FontAwesome Duotone icon and optional title
     */
    public function duo(string $icon, ?string $title = '', array $options = []): string
    {
        return $this->icon(self::DUO, $icon, $title, $options);
    }

    /**
     * Create a link with a Duotone icon
     *
     * @param string $icon FontAwesome icon
     * @param string|array $url Html url as string or array
     * @param string|null $title Anchor text included with icon
     * @param array $options Attributes to pass to anchor element (pass icon attributes through $options['icon'])
     * @return string Finished anchor element with FontAwesome Duotone icon and title
     */
    public function duoLink(string $icon, $url, ?string $title = '', array $options = []): string
    {
        return $this->link(self::DUO, $icon, $url, $title, $options);
    }

    /**
     * Create a FontAwesome Brand icon with optional title appended
     *
     * @param string $icon FontAwesome icon
     * @param string|null $title Anchor text
     * @param array $options Attributes to pass to icon element <i />
     * @return string Finished FontAwesome Brand icon and optional title
     */
    public function brand(string $icon, ?string $title = '', array $options = []): string
    {
        return $this->icon(self::BRAND, $icon, $title, $options);
    }

    /**
     * Create a link with a Brand icon
     *
     * @param string $icon FontAwesome icon
     * @param string|array $url Html url as string or array
     * @param string|null $title Anchor text included with icon
     * @param array $options Attributes to pass to anchor element (pass icon attributes through $options['icon'])
     * @return string Finished anchor element with FontAwesome Brand icon and title
     */
    public function brandLink(string $icon, $url, ?string $title = '', array $options = []): string
    {
        return $this->link(self::BRAND, $icon, $url, $title, $options);
    }

    /**
     * Create a FontAwesome Thin icon with optional title appended
     *
     * @param string $icon FontAwesome icon
     * @param string|null $title Anchor text
     * @param array $options Attributes to pass to icon element <i />
     * @return string Finished FontAwesome Thin icon and optional title
     */
    public function thin(string $icon, ?string $title = '', array $options = []): string
    {
        return $this->icon(self::THIN, $icon, $title, $options);
    }

    /**
     * Create a link with a Thin icon
     *
     * @param string $icon FontAwesome icon
     * @param string|array $url Html url as string or array
     * @param string|null $title Anchor text included with icon
     * @param array $options Attributes to pass to anchor element (pass icon attributes through $options['icon'])
     * @return string Finished anchor element with FontAwesome Thin icon and title
     */
    public function thinLink(string $icon, $url, ?string $title = '', array $options = []): string
    {
        return $this->link(self::THIN, $icon, $url, $title, $options);
    }

    /**
     * Format the FontAwesome icon with an optional title appended
     *
     * @param string $type FontAwesome icon type (solid, regular, light, duo)
     * @param string $icon FontAwesome icon
     * @param string|null $title Title that is appended after icon
     * @param array $options Attributes to pass to icon <i />
     * @return string Finished FontAwesome icon with optional title appended
     */
    public function icon(string $type, string $icon, ?string $title = '', array $options = []): string
    {
        $class = sprintf($this->iconClassTemplate, $type, $icon);
        $title = $this->escapeTitle($title ?? '', $options);
        unset($options['escapeTitle']);

        if (isset($options['class'])) {
            $class .= ' ' . $options['class'];
        }
        $options['class'] = $class;

        $tag = $this->Html->tag('i', '', $options);
        if (!empty($title)) {
            return $tag . ' ' . $title;
        }

        return $tag;
    }

    /**
     * Create a link with a FontAwesome icon and title
     *
     * @param string $type FontAwesome icon type (solid, regular, light, duo)
     * @param string $icon FontAwesome icon
     * @param string|array $url Anchor text
     * @param string|null $title Html url as string or array
     * @param array $options Attributes to pass to anchor element (pass icon attributes through $options['icon'])
     * @return string Finished anchor element with FontAwesome icon and title
     */
    public function link(string $type, string $icon, $url, ?string $title = '', array $options = []): string
    {
        $options += ['escape' => false];
        $title = $this->icon($type, $icon, $title, $options['icon'] ?? []);
        unset($options['icon']);

        return $this->Html->link($title, $url, $options);
    }

    /**
     * Create a script tag that loads the FontAwesome script
     *
     * @param string|null $script Script name or absolute url
     * @param string $path Script path (do not use if loading script from absolute url)
     * @return string|null Script tag with FontAwesome script
     */
    public function script(?string $script = 'all', string $path = ''): ?string
    {
        if (empty($script)) {
            $script = 'all';
        }

        return $this->Html->script($path . $script);
    }

    /**
     * Create a script tag that loads a kit from FontAwesome
     *
     * @param string $kitIdentifier Kit identifier generated by FontAwesome
     * @return string|null Script tag using a FontAwesome kit
     * @see https://fontawesome.com/kits/
     */
    public function scriptKit(string $kitIdentifier): ?string
    {
        return $this->Html->script(sprintf(self::KIT_URL, $kitIdentifier), [
            'crossorigin' => 'anonymous',
        ]);
    }

    /**
     * Check if title should be escaped, and do if it should
     *
     * @param string $title Title to consider escaping
     * @param array $options Options
     * @return string
     * @author CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
     * @desc Extracted from CakePHP {@see \Cake\View\Helper\HtmlHelper::link()} so we can escape title, but not icon
     */
    protected function escapeTitle(string $title, array $options = []): string
    {
        $escapeTitle = true;

        if (isset($options['escapeTitle'])) {
            $escapeTitle = $options['escapeTitle'];
        } elseif (isset($options['escape'])) {
            $escapeTitle = $options['escape'];
        }

        if ($escapeTitle === true) {
            return h($title);
        } elseif (is_string($escapeTitle)) {
            /** @psalm-suppress PossiblyInvalidArgument */
            return htmlentities($title, ENT_QUOTES, $escapeTitle);
        }

        return $title;
    }
}
