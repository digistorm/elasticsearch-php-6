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

use Digistorm;
use Digistorm\Client;
use Digistorm\ClientBuilder;
use Digistorm\Common\Exceptions\MaxRetriesException;
use Mockery as m;

/**
 * Class ClientTest
 *
 * @subpackage Tests
 */
class ClientTest extends \PHPUnit\Framework\TestCase
{
    public function tearDown(): void
    {
        m::close();
    }

    public function testConstructorIllegalPort()
    {
        $this->expectException(\Digistorm\Common\Exceptions\InvalidArgumentException::class);
        $this->expectExceptionMessage('Could not parse URI');

        $client = Digistorm\ClientBuilder::create()->setHosts(['localhost:abc'])->build();
    }

    public function testFromConfig()
    {
        $params = [
            'hosts' => [
                'localhost:9200'
            ],
            'retries' => 2,
            'handler' => ClientBuilder::multiHandler()
        ];
        $client = ClientBuilder::fromConfig($params);

        $this->assertInstanceOf(Client::class, $client);
    }

    public function testFromConfigBadParam()
    {
        $params = [
            'hosts' => [
                'localhost:9200'
            ],
            'retries' => 2,
            'imNotReal' => 5
        ];

        $this->expectException(\Digistorm\Common\Exceptions\RuntimeException::class);
        $this->expectExceptionMessage('Unknown parameters provided: imNotReal');

        $client = ClientBuilder::fromConfig($params);
    }

    public function testFromConfigBadParamQuiet()
    {
        $params = [
            'hosts' => [
                'localhost:9200'
            ],
            'retries' => 2,
            'imNotReal' => 5
        ];
        $client = ClientBuilder::fromConfig($params, true);

        $this->assertInstanceOf(Client::class, $client);
    }

    public function testIndexCannotBeNullForDelete()
    {
        $client = ClientBuilder::create()->build();

        $this->expectException(Digistorm\Common\Exceptions\InvalidArgumentException::class);
        $this->expectExceptionMessage('index cannot be null.');

        $client->delete(
            [
            'index' => null,
            'type' => 'test',
            'id' => 'test'
            ]
        );
    }

    public function testTypeCannotBeNullForDelete()
    {
        $client = ClientBuilder::create()->build();

        $this->expectException(Digistorm\Common\Exceptions\InvalidArgumentException::class);
        $this->expectExceptionMessage('type cannot be null.');

        $client->delete(
            [
            'index' => 'test',
            'type' => null,
            'id' => 'test'
            ]
        );
    }

    public function testIdCannotBeNullForDelete()
    {
        $client = ClientBuilder::create()->build();

        $this->expectException(Digistorm\Common\Exceptions\InvalidArgumentException::class);
        $this->expectExceptionMessage('id cannot be null.');

        $client->delete(
            [
            'index' => 'test',
            'type' => 'test',
            'id' => null
            ]
        );
    }

    public function testIndexCannotBeEmptyStringForDelete()
    {
        $client = ClientBuilder::create()->build();

        $this->expectException(Digistorm\Common\Exceptions\InvalidArgumentException::class);
        $this->expectExceptionMessage('index cannot be an empty string');

        $client->delete(
            [
            'index' => '',
            'type' => 'test',
            'id' => 'test'
            ]
        );
    }

    public function testTypeCannotBeEmptyStringForDelete()
    {
        $client = ClientBuilder::create()->build();

        $this->expectException(Digistorm\Common\Exceptions\InvalidArgumentException::class);
        $this->expectExceptionMessage('type cannot be an empty string');

        $client->delete(
            [
            'index' => 'test',
            'type' => '',
            'id' => 'test'
            ]
        );
    }

    public function testIdCannotBeEmptyStringForDelete()
    {
        $client = ClientBuilder::create()->build();

        $this->expectException(Digistorm\Common\Exceptions\InvalidArgumentException::class);
        $this->expectExceptionMessage('id cannot be an empty string');

        $client->delete(
            [
            'index' => 'test',
            'type' => 'test',
            'id' => ''
            ]
        );
    }

    public function testIndexCannotBeArrayOfEmptyStringsForDelete()
    {
        $client = ClientBuilder::create()->build();

        $this->expectException(Digistorm\Common\Exceptions\InvalidArgumentException::class);
        $this->expectExceptionMessage('index cannot be an array of empty strings');

        $client->delete(
            [
            'index' => ['', '', ''],
            'type' => 'test',
            'id' => 'test'
            ]
        );
    }

    public function testTypeCannotBeArrayOfEmptyStringsForDelete()
    {
        $client = ClientBuilder::create()->build();

        $this->expectException(Digistorm\Common\Exceptions\InvalidArgumentException::class);
        $this->expectExceptionMessage('type cannot be an array of empty strings');

        $client->delete(
            [
            'index' => 'test',
            'type' => ['', '', ''],
            'id' => 'test'
            ]
        );
    }

    public function testIndexCannotBeArrayOfNullsForDelete()
    {
        $client = ClientBuilder::create()->build();

        $this->expectException(Digistorm\Common\Exceptions\InvalidArgumentException::class);
        $this->expectExceptionMessage('index cannot be an array of empty strings');

        $client->delete(
            [
            'index' => [null, null, null],
            'type' => 'test',
            'id' => 'test'
            ]
        );
    }

    public function testTypeCannotBeArrayOfNullsForDelete()
    {
        $client = ClientBuilder::create()->build();

        $this->expectException(Digistorm\Common\Exceptions\InvalidArgumentException::class);
        $this->expectExceptionMessage('type cannot be an array of empty strings');

        $client->delete(
            [
            'index' => 'test',
            'type' => [null, null, null],
            'id' => 'test'
            ]
        );
    }

    public function testMaxRetriesException()
    {
        $client = Digistorm\ClientBuilder::create()
            ->setHosts(["localhost:1"])
            ->setRetries(0)
            ->build();

        $searchParams = [
            'index' => 'test',
            'type' => 'test',
            'body' => [
                'query' => [
                    'match_all' => []
                ]
            ]
        ];

        $client = Digistorm\ClientBuilder::create()
            ->setHosts(["localhost:1"])
            ->setRetries(0)
            ->build();

        try {
            $client->search($searchParams);
            $this->fail("Should have thrown CouldNotConnectToHost");
        } catch (Digistorm\Common\Exceptions\Curl\CouldNotConnectToHost $e) {
            // All good
            $previous = $e->getPrevious();
            $this->assertInstanceOf(MaxRetriesException::class, $previous);
        } catch (\Exception $e) {
            throw $e;
        }


        $client = Digistorm\ClientBuilder::create()
            ->setHosts(["localhost:1"])
            ->setRetries(0)
            ->build();

        try {
            $client->search($searchParams);
            $this->fail("Should have thrown TransportException");
        } catch (Digistorm\Common\Exceptions\TransportException $e) {
            // All good
            $previous = $e->getPrevious();
            $this->assertInstanceOf(MaxRetriesException::class, $previous);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function testInlineHosts()
    {
        $client = Digistorm\ClientBuilder::create()->setHosts(
            [
            'localhost:9200'
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("localhost:9200", $host->getHost());
        $this->assertSame("http", $host->getTransportSchema());


        $client = Digistorm\ClientBuilder::create()->setHosts(
            [
            'http://localhost:9200'
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("localhost:9200", $host->getHost());
        $this->assertSame("http", $host->getTransportSchema());

        $client = Digistorm\ClientBuilder::create()->setHosts(
            [
            'http://foo.com:9200'
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("foo.com:9200", $host->getHost());
        $this->assertSame("http", $host->getTransportSchema());

        $client = Digistorm\ClientBuilder::create()->setHosts(
            [
            'https://foo.com:9200'
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("foo.com:9200", $host->getHost());
        $this->assertSame("https", $host->getTransportSchema());


        $client = Digistorm\ClientBuilder::create()->setHosts(
            [
            'https://user:pass@foo.com:9200'
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("foo.com:9200", $host->getHost());
        $this->assertSame("https", $host->getTransportSchema());
        $this->assertSame("user:pass", $host->getUserPass());
    }

    public function testExtendedHosts()
    {
        $client = Digistorm\ClientBuilder::create()->setHosts(
            [
            [
                'host' => 'localhost',
                'port' => 9200,
                'scheme' => 'http'
            ]
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("localhost:9200", $host->getHost());
        $this->assertSame("http", $host->getTransportSchema());


        $client = Digistorm\ClientBuilder::create()->setHosts(
            [
            [
                'host' => 'foo.com',
                'port' => 9200,
                'scheme' => 'http'
            ]
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("foo.com:9200", $host->getHost());
        $this->assertSame("http", $host->getTransportSchema());


        $client = Digistorm\ClientBuilder::create()->setHosts(
            [
            [
                'host' => 'foo.com',
                'port' => 9200,
                'scheme' => 'https'
            ]
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("foo.com:9200", $host->getHost());
        $this->assertSame("https", $host->getTransportSchema());


        $client = Digistorm\ClientBuilder::create()->setHosts(
            [
            [
                'host' => 'foo.com',
                'scheme' => 'http'
            ]
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("foo.com:9200", $host->getHost());
        $this->assertSame("http", $host->getTransportSchema());


        $client = Digistorm\ClientBuilder::create()->setHosts(
            [
            [
                'host' => 'foo.com'
            ]
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("foo.com:9200", $host->getHost());
        $this->assertSame("http", $host->getTransportSchema());


        $client = Digistorm\ClientBuilder::create()->setHosts(
            [
            [
                'host' => 'foo.com',
                'port' => 9500,
                'scheme' => 'https'
            ]
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("foo.com:9500", $host->getHost());
        $this->assertSame("https", $host->getTransportSchema());


        try {
            $client = Digistorm\ClientBuilder::create()->setHosts(
                [
                [
                    'port' => 9200,
                    'scheme' => 'http'
                ]
                ]
            )->build();
            $this->fail("Expected RuntimeException from missing host, none thrown");
        } catch (Digistorm\Common\Exceptions\RuntimeException $e) {
            // good
        }

        // Underscore host, questionably legal, but inline method would break
        $client = Digistorm\ClientBuilder::create()->setHosts(
            [
            [
                'host' => 'the_foo.com'
            ]
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("the_foo.com:9200", $host->getHost());
        $this->assertSame("http", $host->getTransportSchema());


        // Special characters in user/pass, would break inline
        $client = Digistorm\ClientBuilder::create()->setHosts(
            [
            [
                'host' => 'foo.com',
                'user' => 'user',
                'pass' => 'abc#$@?%!abc'
            ]
            ]
        )->build();
        $host = $client->transport->getConnection();
        $this->assertSame("foo.com:9200", $host->getHost());
        $this->assertSame("http", $host->getTransportSchema());
        $this->assertSame("user:abc#$@?%!abc", $host->getUserPass());
    }
}
