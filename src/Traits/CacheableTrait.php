<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 24-Feb-17
 * Time: 01:20
 */

namespace Pbxg33k\TorrentClient\Traits;


use Symfony\Component\Cache\Adapter\AdapterInterface;

trait CacheableTrait
{
    /**
     * @var AdapterInterface
     */
    protected $cache;

    /**
     * @return AdapterInterface
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * @param AdapterInterface $cache
     *
     * @return CacheableTrait
     */
    public function setCache($cache)
    {
        $this->cache = $cache;

        return $this;
    }

    /**
     * @param     $key
     * @param     $item
     * @param int $ttl
     *
     * @return bool
     */
    public function cacheSave($key, $item, $ttl = 86400)
    {
        if($this->cache) {
            $cacheItem = $this->cache->getItem($key);
            $cacheItem->expiresAfter($ttl);
            $cacheItem->set($item);

            return $this->cache->save($cacheItem);
        } else {
            return false;
        }
    }

    /**
     * @param $key
     *
     * @return bool|\Symfony\Component\Cache\CacheItem
     */
    public function cacheGet($key)
    {
        if($this->cache) {
            $cachedItem = $this->cache->getItem($key);
            return $cachedItem->get();
        } else {
            return false;
        }
    }
}