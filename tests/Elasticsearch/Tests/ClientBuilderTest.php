<?php
/**
 * Elasticsearch PHP client
 *
 * @link      https://github.com/elastic/elasticsearch-php/
 * @copyright Copyright (c) Elasticsearch B.V (https://www.elastic.co)
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @license   https://www.gnu.org/licenses/lgpl-2.1.html GNU Lesser General Public License, Version 2.1
 *
 * Licensed to Elasticsearch B.V under one or more agreements.
 * Elasticsearch B.V licenses this file to you under the Apache 2.0 License or
 * the GNU Lesser General Public License, Version 2.1, at your option.
 * See the LICENSE file in the project root for more information.
 */


declare(strict_types = 1);

namespace Digistorm\Tests;

use Digistorm\Client;
use Digistorm\ClientBuilder;
use Digistorm\Common\Exceptions\ElasticsearchException;
use Digistorm\Tests\ClientBuilder\DummyLogger;
use PHPUnit\Framework\TestCase;

class ClientBuilderTest extends TestCase
{

    public function testClientBuilderThrowsExceptionForIncorrectLoggerClass()
    {
        $this->expectException(\TypeError::class);
        ClientBuilder::create()->setLogger(new DummyLogger);
    }

    public function testClientBuilderThrowsExceptionForIncorrectTracerClass()
    {
        $this->expectException(\TypeError::class);
        ClientBuilder::create()->setTracer(new DummyLogger);
    }

    public function testElasticClientMetaHeaderIsSentByDefault()
    {
        $client = ClientBuilder::create()
            ->build();
        $this->assertInstanceOf(Client::class, $client);

        try {
            $result = $client->info();
        } catch (ElasticsearchException $e) {
            $request = $client->transport->getLastConnection()->getLastRequestInfo();
            $this->assertTrue(isset($request['request']['headers']['x-elastic-client-meta']));
            $this->assertEquals(
                1,
                preg_match(
                    '/^[a-z]{1,}=[a-z0-9\.\-]{1,}(?:,[a-z]{1,}=[a-z0-9\.\-]+)*$/',
                    $request['request']['headers']['x-elastic-client-meta'][0]
                )
            );
        }
    }

    public function testElasticClientMetaHeaderIsSentWhenEnabled()
    {
        $client = ClientBuilder::create()
            ->setElasticMetaHeader(true)
            ->build();
        $this->assertInstanceOf(Client::class, $client);

        try {
            $result = $client->info();
        } catch (ElasticsearchException $e) {
            $request = $client->transport->getLastConnection()->getLastRequestInfo();
            $this->assertTrue(isset($request['request']['headers']['x-elastic-client-meta']));
            $this->assertEquals(
                1,
                preg_match(
                    '/^[a-z]{1,}=[a-z0-9\.\-]{1,}(?:,[a-z]{1,}=[a-z0-9\.\-]+)*$/',
                    $request['request']['headers']['x-elastic-client-meta'][0]
                )
            );
        }
    }

    public function testElasticClientMetaHeaderIsNotSentWhenDisabled()
    {
        $client = ClientBuilder::create()
            ->setElasticMetaHeader(false)
            ->build();
        $this->assertInstanceOf(Client::class, $client);

        try {
            $result = $client->info();
        } catch (ElasticsearchException $e) {
            $request = $client->transport->getLastConnection()->getLastRequestInfo();
            $this->assertFalse(isset($request['request']['headers']['x-elastic-client-meta']));
        }
    }
}
