<?php

namespace SLOYakuza\SecureHeaders\Builders;

final class ClearSiteDataBuilder extends Builder
{
    /**
     * Clear Site Data whitelist directives.
     */
    protected array $whitelist = [
        'cache' => true,
        'cookies' => true,
        'storage' => true,
        'executionContexts' => true,
    ];

    public function get(): string
    {
        if ($this->config['all'] ?? false) {
            return '"*"';
        }

        $targets = array_intersect_key($this->config, $this->whitelist);

        $needs = array_filter($targets);

        $directives = array_map(function (string $directive) {
            return sprintf('"%s"', $directive);
        }, array_keys($needs));

        return implode(', ', $directives);
    }
}
