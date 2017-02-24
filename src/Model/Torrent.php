<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 24-Feb-17
 * Time: 01:03
 */

namespace Pbxg33k\TorrentClient\Model;


/**
 * Class Torrent
 * @package Pbxg33k\TorrentClient\Model
 */
class Torrent
{
    /**
     * @var string
     */
    protected $hash;

    /**
     * @var integer
     */
    protected $status;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var integer
     */
    protected $size;

    /**
     * @var float
     */
    protected $progress;

    /**
     * @var integer
     */
    protected $downloaded;

    /**
     * @var integer
     */
    protected $uploaded;

    /**
     * @var float
     */
    protected $ratio;

    /**
     * @var integer
     */
    protected $downloadSpeed;

    /**
     * @var integer
     */
    protected $uploadSpeed;

    /**
     * @var integer
     */
    protected $eta;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var integer
     */
    protected $peersConnected;

    /**
     * @var integer
     */
    protected $peersSwarm;

    /**
     * @var integer
     */
    protected $seedsConnected;

    /**
     * @var integer
     */
    protected $seedsSwarm;

    /**
     * @var integer
     */
    protected $availability;

    /**
     * @var integer
     */
    protected $position;

    /**
     * @var integer
     */
    protected $remaining;

    /**
     * Torrent client type.
     *
     * @var integer
     */
    protected $clientType;

    /**
     * @internal
     * @var integer
     */
    protected $clientId;

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     *
     * @return Torrent
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return Torrent
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Torrent
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param int $size
     *
     * @return Torrent
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return float
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * @param float $progress
     *
     * @return Torrent
     */
    public function setProgress($progress)
    {
        $this->progress = $progress;

        return $this;
    }

    /**
     * @return int
     */
    public function getDownloaded()
    {
        return $this->downloaded;
    }

    /**
     * @param int $downloaded
     *
     * @return Torrent
     */
    public function setDownloaded($downloaded)
    {
        $this->downloaded = $downloaded;

        return $this;
    }

    /**
     * @return int
     */
    public function getUploaded()
    {
        return $this->uploaded;
    }

    /**
     * @param int $uploaded
     *
     * @return Torrent
     */
    public function setUploaded($uploaded)
    {
        $this->uploaded = $uploaded;

        return $this;
    }

    /**
     * @return float
     */
    public function getRatio()
    {
        return $this->ratio;
    }

    /**
     * @param float $ratio
     *
     * @return Torrent
     */
    public function setRatio($ratio)
    {
        $this->ratio = $ratio;

        return $this;
    }

    /**
     * @return int
     */
    public function getDownloadSpeed()
    {
        return $this->downloadSpeed;
    }

    /**
     * @param int $downloadSpeed
     *
     * @return Torrent
     */
    public function setDownloadSpeed($downloadSpeed)
    {
        $this->downloadSpeed = $downloadSpeed;

        return $this;
    }

    /**
     * @return int
     */
    public function getUploadSpeed()
    {
        return $this->uploadSpeed;
    }

    /**
     * @param int $uploadSpeed
     *
     * @return Torrent
     */
    public function setUploadSpeed($uploadSpeed)
    {
        $this->uploadSpeed = $uploadSpeed;

        return $this;
    }

    /**
     * @return int
     */
    public function getEta()
    {
        return $this->eta;
    }

    /**
     * @param int $eta
     *
     * @return Torrent
     */
    public function setEta($eta)
    {
        $this->eta = $eta;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return Torrent
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return int
     */
    public function getPeersConnected()
    {
        return $this->peersConnected;
    }

    /**
     * @param int $peersConnected
     *
     * @return Torrent
     */
    public function setPeersConnected($peersConnected)
    {
        $this->peersConnected = $peersConnected;

        return $this;
    }

    /**
     * @return int
     */
    public function getPeersSwarm()
    {
        return $this->peersSwarm;
    }

    /**
     * @param int $peersSwarm
     *
     * @return Torrent
     */
    public function setPeersSwarm($peersSwarm)
    {
        $this->peersSwarm = $peersSwarm;

        return $this;
    }

    /**
     * @return int
     */
    public function getSeedsConnected()
    {
        return $this->seedsConnected;
    }

    /**
     * @param int $seedsConnected
     *
     * @return Torrent
     */
    public function setSeedsConnected($seedsConnected)
    {
        $this->seedsConnected = $seedsConnected;

        return $this;
    }

    /**
     * @return int
     */
    public function getSeedsSwarm()
    {
        return $this->seedsSwarm;
    }

    /**
     * @param int $seedsSwarm
     *
     * @return Torrent
     */
    public function setSeedsSwarm($seedsSwarm)
    {
        $this->seedsSwarm = $seedsSwarm;

        return $this;
    }

    /**
     * @return int
     */
    public function getAvailability()
    {
        return $this->availability;
    }

    /**
     * @param int $availability
     *
     * @return Torrent
     */
    public function setAvailability($availability)
    {
        $this->availability = $availability;

        return $this;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     *
     * @return Torrent
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return int
     */
    public function getRemaining()
    {
        return $this->remaining;
    }

    /**
     * @param int $remaining
     *
     * @return Torrent
     */
    public function setRemaining($remaining)
    {
        $this->remaining = $remaining;

        return $this;
    }

    /**
     * @return int
     */
    public function getClientType()
    {
        return $this->clientType;
    }

    /**
     * @param int $clientType
     *
     * @return Torrent
     */
    public function setClientType($clientType)
    {
        $this->clientType = $clientType;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param mixed $clientId
     *
     * @return Torrent
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}