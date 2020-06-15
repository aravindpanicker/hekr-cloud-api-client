<?php


namespace Hekr;


class Device
{
    private $ctrlKey;
    private $devTid;
    private $productPublicKey;
    private $ssid;
    private $lanIp;
    private $categoryName;
    private $productName;
    private $online;

    /**
     * Device constructor.
     * @param $ctrlKey
     * @param $devTid
     * @param $productPublicKey
     * @param $ssid
     * @param $lanIp
     * @param $categoryName
     * @param $productName
     * @param $online
     */
    public function __construct($ctrlKey, $devTid, $productPublicKey, $ssid = null, $lanIp = null, $categoryName = null, $productName = null, $online = null)
    {
        $this->ctrlKey = $ctrlKey;
        $this->devTid = $devTid;
        $this->productPublicKey = $productPublicKey;
        $this->ssid = $ssid;
        $this->lanIp = $lanIp;
        $this->categoryName = $categoryName;
        $this->productName = $productName;
        $this->online = $online;
    }

    /**
     * @return mixed
     */
    public function getCtrlKey()
    {
        return $this->ctrlKey;
    }

    /**
     * @param mixed $ctrlKey
     */
    public function setCtrlKey($ctrlKey): void
    {
        $this->ctrlKey = $ctrlKey;
    }

    /**
     * @return mixed
     */
    public function getDevTid()
    {
        return $this->devTid;
    }

    /**
     * @param mixed $devTid
     */
    public function setDevTid($devTid): void
    {
        $this->devTid = $devTid;
    }

    /**
     * @return mixed
     */
    public function getProductPublicKey()
    {
        return $this->productPublicKey;
    }

    /**
     * @param mixed $productPublicKey
     */
    public function setProductPublicKey($productPublicKey): void
    {
        $this->productPublicKey = $productPublicKey;
    }

    /**
     * @return mixed
     */
    public function getSsid()
    {
        return $this->ssid;
    }

    /**
     * @param mixed $ssid
     */
    public function setSsid($ssid): void
    {
        $this->ssid = $ssid;
    }

    /**
     * @return mixed
     */
    public function getLanIp()
    {
        return $this->lanIp;
    }

    /**
     * @param mixed $lanIp
     */
    public function setLanIp($lanIp): void
    {
        $this->lanIp = $lanIp;
    }

    /**
     * @return mixed
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     * @param mixed $categoryName
     */
    public function setCategoryName($categoryName): void
    {
        $this->categoryName = $categoryName;
    }

    /**
     * @return mixed
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @param mixed $productName
     */
    public function setProductName($productName): void
    {
        $this->productName = $productName;
    }

    /**
     * @return mixed
     */
    public function getOnline()
    {
        return $this->online;
    }

    /**
     * @param mixed $online
     */
    public function setOnline($online): void
    {
        $this->online = $online;
    }

    public function validate()
    {
        if($this->getCtrlKey() && $this->getDevTid() && $this->getProductPublicKey()) {
            return true;
        }
        return false;
    }
}