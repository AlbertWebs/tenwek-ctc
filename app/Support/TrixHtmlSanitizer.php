<?php

namespace App\Support;

class TrixHtmlSanitizer
{
    public static function sanitize(string $html): string
    {
        $html = trim($html);
        if ($html === '') {
            return '';
        }

        $allowedTags = [
            'p', 'br', 'div', 'strong', 'em', 'b', 'i',
            'ul', 'ol', 'li',
            'blockquote',
            'h1', 'h2', 'h3', 'h4',
            'a',
        ];

        $dom = new \DOMDocument('1.0', 'UTF-8');
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="utf-8" ?>'.$html, \LIBXML_HTML_NOIMPLIED | \LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $walker = function (\DOMNode $node) use (&$walker, $allowedTags) {
            if ($node->nodeType === XML_ELEMENT_NODE) {
                $tag = strtolower($node->nodeName);
                if (! in_array($tag, $allowedTags, true)) {
                    $parent = $node->parentNode;
                    if ($parent) {
                        while ($node->firstChild) {
                            $parent->insertBefore($node->firstChild, $node);
                        }
                        $parent->removeChild($node);

                        return;
                    }
                } else {
                    if ($node->hasAttributes()) {
                        $attrs = [];
                        foreach (iterator_to_array($node->attributes) as $attr) {
                            $attrs[] = $attr->name;
                        }
                        foreach ($attrs as $attrName) {
                            $node->removeAttribute($attrName);
                        }
                    }

                    if ($tag === 'a') {
                        $href = $node->getAttribute('href');
                        $href = trim((string) $href);
                        if ($href === '' || preg_match('/^\s*javascript:/i', $href)) {
                            $node->removeAttribute('href');
                        } else {
                            $node->setAttribute('href', $href);
                            if (preg_match('/^mailto:/i', $href)) {
                                $node->removeAttribute('target');
                                $node->removeAttribute('rel');
                            } else {
                                $node->setAttribute('rel', 'noopener noreferrer');
                                $node->setAttribute('target', '_blank');
                            }
                        }
                    }
                }
            }

            $children = [];
            foreach (iterator_to_array($node->childNodes) as $child) {
                $children[] = $child;
            }
            foreach ($children as $child) {
                $walker($child);
            }
        };

        $walker($dom);

        $clean = $dom->saveHTML() ?: '';
        $clean = preg_replace('/^<\?xml[^>]*>\s*/', '', $clean) ?? $clean;

        return trim($clean);
    }
}
