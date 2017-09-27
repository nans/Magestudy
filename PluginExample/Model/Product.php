<?php

namespace Magestudy\PluginExample\Model;


class Product
{
    /**
     * @var int
     */
    private $_price;

    /**
     * @var string
     */
    private $_title;

    /**
     * @var int
     */
    private $_backupCount;

    /**
     * @var array
     */
    private $_log;

    public function __construct()
    {
        $this->_price = 1000;
        $this->_title = 'Phone';
        $this->_backupCount = 0;
        $this->_log = [];
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * @param int $price
     */
    public function setPrice($price)
    {
        $this->_price = $price;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->_title = $title;
    }

    public function setBackup()
    {
        $this->_backupCount++;
    }

    public function save()
    {
        return true;
    }

    /**
     * @param string $text
     */
    public function setLog($text)
    {
        $this->_log[] = $text;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return 'Price: ' . $this->_price . "\n" .
            'Title: ' . $this->_title . "\n" .
            'Backup: ' . $this->_backupCount . "\n" .
            'Logs: ' . json_encode($this->_log);
    }
}