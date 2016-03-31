<?php

class TransactionManager
{
    private $isTransactionStarted = false;
    static private $instance;

    public function start()
    {
        global $wpdb;

        if (!$this->isTransactionStarted) {
            $wpdb->query('BEGIN');
            $this->isTransactionStarted = true;
        }
    }

    public function commit()
    {
        global $wpdb;

        $this->start();

        try {
            $wpdb->query('COMMIT');
            $this->isTransactionStarted = false;
        } catch (Exception $e) {
            $wpdb->query('ROLLBACK');
            $this->isTransactionStarted = false;
        }
    }

    static public function getInstance()
    {
        if (empty(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}