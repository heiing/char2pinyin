<?php

class Pinyin
{

    private static $pool = array();
    public static function create($db_file = 'char2pinyin.utf8') {
        if (!is_file($db_file)) {
            trigger_error("{$db_file} is not found!", E_USER_ERROR);
            return null;
        }
        if (isset(static::$pool[$db_file])) {
            return static::$pool[$db_file];
        }
        $class = __CLASS__;
        $self = new $class($db_file);
        static::$pool[$db_file] = $self;
        return $self;
    }

    private $multi_suffix = '.multidefault';

    private $dic;
    private $default_index;

    private function Pinyin($db_file) {
        trigger_error("deprecated construct!", E_USER_ERROR);
        $this->parse($db_file);
    }
    private function __construct($db_file) {
        $this->parse($db_file);
    }
    private function parse($db_file) {
        $contents = trim(file_get_contents($db_file));
        $lines = explode("\n", $contents);
        $this->dic = array();
        foreach ($lines as $line) {
            list($w, $pys) = explode(' ', $line, 2);
            $this->dic[$w] = explode(' ', $pys);
        }
        $this->default_index = array();
        if (is_file($db_file . $this->multi_suffix)) {
            $contents = trim(file_get_contents($db_file . $this->multi_suffix));
            $lines = explode("\n", $contents);
            foreach ($lines as $line) {
                list($w, $idx) = explode(' ', $line, 2);
                $this->default_index[$w] = $idx;
            }
        }
    }

    public function get($char, $index = null) {
        if (!isset($this->dic[$char])) {
            return null;
        }
        if (null === $index) {
            $index = isset($this->default_index[$char]) ? $this->default_index[$char] : 0;
        }
        return isset($this->dic[$char][$index]) ? $this->dic[$char][$index] : null;
    }

    public function getAll($char) {
        if (!isset($this->dic[$char])) {
            return null;
        }
        return $this->dic[$char];
    }

}
