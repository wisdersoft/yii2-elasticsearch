<?php

namespace wisder\yii\elasticsearch\controllers;

use yii\helpers\Console;

class IndexController extends ElasticSearchController
{
    /**
     * @var array ElasticSearch index and their fields
     */
    public $indices;

    /**
     * Create ElasticSearch index
     *
     * @param string $index ElasticSearch index name
     */
    public function actionCreate($index)
    {
        Console::output("Creating ElasticSearch index: [$index]");

        if (!isset($this->indices[$index])) {
            Console::error("[$index] not config properly");
            exit(1);
        }

        $config = [
            'index' => $index,
            'body' => [
                'mappings' => [
                    'properties' => $this->indices[$index],
                ],
            ],
        ];

        $this->client->indices()->create($config);
    }

    /**
     * Delete the existing ElasticSearch index
     *
     * @param string $index ElasticSearch index name
     */
    public function actionDelete($index)
    {
        Console::output("Deleting ElasticSearch index: [$index]");

        $config = [
            'index' => $index,
        ];

        $this->client->indices()->delete($config);
    }
}
