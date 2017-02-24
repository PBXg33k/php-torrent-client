<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 24-Feb-17
 * Time: 01:04
 */

namespace Pbxg33k\TorrentClient\Model;


class Label
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var integer
     */
    protected $items;

    /**
     * @var array
     */
    protected $torrents;

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
     * @return Label
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param int $items
     *
     * @return Label
     */
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @return array
     */
    public function getTorrents()
    {
        return $this->torrents;
    }

    /**
     * @param array $torrents
     *
     * @return Label
     */
    public function setTorrents($torrents)
    {
        $this->torrents = $torrents;

        return $this;
    }

    public function addTorrent(Torrent $torrent)
    {
        $this->torrents[] = $torrent;

        return $this;
    }


}