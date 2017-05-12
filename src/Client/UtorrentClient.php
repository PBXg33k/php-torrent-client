<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 19-Feb-17
 * Time: 15:02
 */

namespace Pbxg33k\TorrentClient\Client;


use Pbxg33k\TorrentClient\Exception\AuthenticationRefusedException;
use Pbxg33k\TorrentClient\Model\Torrent;
use Pbxg33k\TorrentClient\Traits\CacheableTrait;

class UtorrentClient extends AbstractClient implements ClientInterface
{
    const CACHE_PREFIX = 'ut_';
    use CacheableTrait;
    /**
     * @throws \Exception
     */
    public function connect()
    {
        if(!$this->address) {
            throw new \Exception('Address missing');
        }

        if(!$this->port) {
            throw new \Exception('Port missing');
        }
    }

    /**
     * Gracefully close connection with the host and destroy connection.
     *
     * @return boolean
     */
    public function disconnect()
    {
        // TODO: Implement disconnect() method.
    }

    /**
     * Get the connection resource
     *
     * @return mixed
     */
    public function getConnection()
    {
        // TODO: Implement getConnection() method.
    }

    /**
     * @return mixed
     */
    public function isConnected()
    {
        // TODO: Implement isConnected() method.
    }

    /**
     * @param $authOptions
     *
     * @return bool
     * @throws \Exception
     */
    public function authenticate($authOptions)
    {
        $this->logger->debug('Authenticating');
        if(!is_array($authOptions)) {
            throw new \Exception('authOptions is not an array');
        }

        $authKeys = [
            'username' => '',
            'password' => '',
        ];

        foreach($authKeys as $key => $val) {
            if(!isset($authOptions[$key])) {
                throw new \Exception('Missing option '. $key);
            }

            $authKeys[$key] = $authOptions[$key];
        }

        $this->authOptions = $authKeys;

        try {
            $this->getToken();
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function isAuthenticated()
    {
        // TODO: Implement isAuthenticated() method.
    }

    /**
     * @return mixed
     */
    public function getTorrents()
    {
        // TODO: Implement getTorrents() method.
    }

    /**
     * @return mixed
     */
    public function listTorrents($transform = true)
    {
        $response = $this->GETAuthenticated('?list=1');

        $decodedContent = \GuzzleHttp\json_decode($response->getBody()->getContents());
        $debugContext = [
            'build' => $decodedContent->build,
            'labels' => count($decodedContent->label),
            'torrents' => count($decodedContent->torrents),
            'torrentc' => count($decodedContent->torrentc),
            'rssfeeds' => count($decodedContent->rssfeeds),
            'rssfilter' => count($decodedContent->rssfilters)
        ];
        $this->logger->debug('RESPONSE', $debugContext);

        $torrents = [];

        if($transform) {
            foreach ($decodedContent->torrents as $rawTorrent) {
                $torrents[] = $torrent = $this->createTorrentObjectFromArray($rawTorrent);
            }
            $decodedContent->torrents = $torrents;
        }

        return \GuzzleHttp\json_encode($decodedContent);
    }

    /**
     * @param $torrents
     *
     * @return mixed
     */
    public function updateTorrents($torrents)
    {
        // TODO: Implement updateTorrents() method.
    }

    /**
     * @param $identifier
     *
     * @return mixed
     */
    public function getTorrent($identifier)
    {
        // TODO: Implement getTorrent() method.
    }

    /**
     * @param $torrent
     *
     * @return mixed
     */
    public function addTorrent($torrent)
    {
        // TODO: Implement addTorrent() method.
    }

    /**
     * @param $torrent
     *
     * @return mixed
     */
    public function updateTorrent($torrent)
    {
        // TODO: Implement updateTorrent() method.
    }

    /**
     * @param $torrent
     * @param $files
     *
     * @return mixed
     */
    public function deleteTorrent($torrent, $files)
    {
        // TODO: Implement deleteTorrent() method.
    }

    /**
     * Get a token from uTorrent
     *
     * @return mixed
     *
     * @throws AuthenticationRefusedException
     */
    public function getToken()
    {
        $response = $this->GET('token.html', ['auth' => $this->getAuthHeaders() ]);

        $rawResponse = $response->getBody()->getContents();
        if(preg_match('~<div[^>]+>([^<]+)<\/div>~i', $rawResponse, $matches)) {
            return $matches[1];
        } else {
            throw new AuthenticationRefusedException($rawResponse);
        }
    }

    public function GETAuthenticated($uri, $options = [])
    {
        if(strpos($uri,'?') !== false) {
            $uri .= '&';
        } else {
            $uri .= '?';
        }

        $uri .= 'token='.$this->getToken();

        $options['auth'] = $this->getAuthHeaders();

        return $this->GET($uri, $options);
    }

    public function GET($uri, $options)
    {
        $uri = '/gui/' . $uri;
        return parent::GET($uri, $options); // TODO: Change the autogenerated stub
    }

    protected function getAuthHeaders()
    {
        return [
            $this->authOptions['username'],
            $this->authOptions['password']
        ];
    }

    protected function createTorrentObjectFromArray($torrentArray)
    {
        if($torrentObj = $this->cacheGet(self::CACHE_PREFIX.$torrentArray[0])) {
            return $torrentObj;
        } else {
            $torrentObj = new Torrent();
            $torrentObj = $this->setTorrentPropertiesFromArray($torrentObj, $torrentArray);
        }

        return $torrentObj;
    }

    /**
     * @param Torrent $torrent
     * @param         $torrentArray
     *
     * @return Torrent
     */
    protected function setTorrentPropertiesFromArray(Torrent $torrent, $torrentArray)
    {

        $torrent
            ->setHash($torrentArray[0])
            ->setStatus($torrentArray[1])
            ->setName($torrentArray[2])
            ->setSize($torrentArray[3])
            ->setProgress($torrentArray[4])
            ->setDownloaded($torrentArray[5])
            ->setUploaded($torrentArray[6])
            ->setRatio($torrentArray[7])
            ->setUploadSpeed($torrentArray[8])
            ->setDownloadSpeed($torrentArray[9])
            ->setEta($torrentArray[10])
            ->setLabel($torrentArray[11])
            ->setPeersConnected($torrentArray[12])
            ->setPeersSwarm($torrentArray[13])
            ->setSeedsConnected($torrentArray[14])
            ->setSeedsSwarm($torrentArray[15])
            ->setAvailability($torrentArray[16])
            ->setPosition($torrentArray[17])
            ->setRemaining($torrentArray[18])
            ->setClientType('utorrent');

        //$this->logger->debug('Converting torrent array to object', $torrent->toArray());
        $this->cacheSave(self::CACHE_PREFIX . $torrent->getHash(), $torrent);

        return $torrent;
    }
}