<?php
namespace Pbxg33k\TorrentClient\Client;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Uri;
use Pbxg33k\TorrentClient\Exception\ConnectionException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Psr\Log\LoggerInterface;

abstract class AbstractClient
{
    const PREG_HOST = '~^(http(s)?\:\/\/?)?([A-Za-z0-9\.]+)(\:)?([0-9]+)?\/?$~';

    protected $connection;

    protected $authOptions;

    /**
     * @var string
     */
    protected $address;

    /**
     * @var integer
     */
    protected $port;

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @return mixed
     */
    public function getAuthOptions()
    {
        return $this->authOptions;
    }

    /**
     * @param mixed $authOptions
     *
     * @return AbstractClient
     */
    public function setAuthOptions($authOptions)
    {
        $this->authOptions = $authOptions;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     *
     * @return AbstractClient
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param int $port
     *
     * @return AbstractClient
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param ClientInterface $client
     *
     * @return AbstractClient
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @param LoggerInterface $logger
     *
     * @return AbstractClient
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;

        return $this;
    }

    /**
     * @param string $uri
     * @param string $options
     *
     * @return ResponseInterface
     * @throws ConnectionException
     */
    protected function GET($uri, $options)
    {
        $this->logger->debug('GET REQUEST FOR ' . $uri, [$uri, $options]);

        /** @var UriInterface $uri */
        $this->createUri($uri);

        $this->logger->info('Peforming GET request', [
            'scheme' => $uri->getScheme(),
            'host'   => $uri->getHost(),
            'port'   => $uri->getPort(),
            'path'   => $uri->getPath(),
            'query'  => $uri->getQuery()
        ]);

        try {
            return $this->client->request('get', $uri, $options);
        } catch (\Exception $e) {
            throw new ConnectionException('Request error', 0, $e);
        }
    }

    /**
     * @param $uri
     *
     * @return $this|Uri|UriInterface|static
     * @throws \Exception
     */
    protected function createUri(&$uri)
    {
        if(!$uri instanceof UriInterface) {
            $uri = new Uri($uri);
            $parsed_host = parse_url($this->getAddress());

            if(!$uri->getHost()) {
                if(!$parsed_host['host']) {
                    throw new \Exception('Host not defined');
                }
                $uri = $uri->withHost($parsed_host['host']);
            }

            if(!$uri->getScheme()) {
                if(!$parsed_host['scheme']) {
                    /** @var UriInterface $uri */
                    $uri = $uri->withScheme('http');
                } else {
                    /** @var UriInterface $uri */
                    $uri = $uri->withScheme('http');
                }
            }

            if($this->getPort()) {
                /** @var UriInterface $uri */
                $uri = $uri->withPort($this->getPort());
            } else {
                if($parsed_host['port']) {
                    /** @var UriInterface $uri */
                    $uri = $uri->withPort($parsed_host['port']);
                }
            }
        }

        return $uri;
    }
}