<?php

declare(strict_types=1);

/*
 * This file is part of Ark Laravel.
 *
 * (c) Ark Ecosystem <info@ark.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lostlink\Ark;

use Lostlink\Ark\Client\Connection;
use Illuminate\Support\Arr;
use InvalidArgumentException;

/**
 * This is the factory class.
 *
 * @author Brian Faust <brian@ark.io>
 */
class ArkFactory
{
    /**
     * Make a new Ark client.
     *
     * @param array $config
     *
     * @return \Lostlink\Ark\Client\Connection
     */
    public function make(array $config): Connection
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    protected function getConfig(array $config): array
    {
        $keys = ['host'];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing configuration key [$key].");
            }
        }

        return Arr::only($config, ['host', 'api_version']);
    }

    /**
     * Get the Ark client.
     *
     * @param array $config
     *
     * @return \Lostlink\Ark\Client\Connection
     */
    protected function getClient(array $config): Connection
    {
        return new Connection($config);
    }
}
