<?php
namespace Pbxg33k\TorrentClient\Client;

use Pbxg33k\TorrentClient\Exception\AuthenticationRefusedException;
use Pbxg33k\TorrentClient\Exception\ConnectionException;

/**
 * Interface ClientInterface
 * @package Pbxg33k\TorrentClient\Client
 */
interface ClientInterface
{
    /**
     * Open a new connection to the torrent host
     *
     * @return mixed
     *
     * @throws ConnectionException if an error occurs while establishing connection
     */
    public function connect();

    /**
     * Gracefully close connection with the host and destroy connection.
     *
     * @return boolean
     */
    public function disconnect();

    /**
     * Get the connection resource
     *
     * @return mixed
     */
    public function getConnection();

    /**
     * @return mixed
     */
    public function isConnected();

    /**
     * @param $address
     *
     * @return mixed
     */
    public function setAddress($address);

    /**
     * @param $port
     *
     * @return mixed
     */
    public function setPort($port);

    /**
     * @param $authOptions
     *
     * @return mixed
     *
     * @throws AuthenticationRefusedException If authentication error occurs
     */
    public function authenticate($authOptions);

    /**
     * @return mixed
     */
    public function isAuthenticated();

    /**
     * @return mixed
     */
    public function getTorrents();

    /**
     * @return mixed
     */
    public function listTorrents();

    /**
     * @param $torrents
     *
     * @return mixed
     */
    public function updateTorrents($torrents);

    /**
     * @param $identifier
     *
     * @return mixed
     */
    public function getTorrent($identifier);

    /**
     * @param $torrent
     *
     * @return mixed
     */
    public function addTorrent($torrent);

    /**
     * @param $torrent
     *
     * @return mixed
     */
    public function updateTorrent($torrent);

    /**
     * @param $torrent
     * @param $files
     *
     * @return mixed
     */
    public function deleteTorrent($torrent, $files);
}