<?php

namespace wisder\yii\elasticsearch\controllers;

use Elasticsearch\Client;
use wisder\yii\elasticsearch\Connection;
use yii\base\InvalidConfigException;
use yii\console\Controller;
use yii\di\Instance;
use yii\helpers\Console;

abstract class ElasticSearchController extends Controller
{
    /**
     * @var Connection|string|array
     */
    public $elasticsearch = 'elasticsearch';

    /**
     * @var Client
     */
    protected $client;

    public function beforeAction($action)
    {
        if(parent::beforeAction($action)) {
            try {
                $this->elasticsearch = Instance::ensure($this->elasticsearch, Connection::class);
            } catch (InvalidConfigException $exception) {
                Console::error('ElasticSearch config err');
                return false;
            }

            $this->client = $this->elasticsearch->getClient();
            return true;
        }

        return false;
    }
}
