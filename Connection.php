<?php

namespace wisder\yii\elasticsearch;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use yii\base\Component;

class Connection extends Component
{
    public $hosts;

    /**
     * @var Client
     */
    private $client;

    public function getClient()
    {
        if (!$this->client) {
            $this->client = ClientBuilder::create()
                ->setHosts($this->hosts)
                ->build();
        }

        return $this->client;
    }
}
