<?php

namespace App\Console\Commands;

use Faker\Factory as FakerFactory;
use Illuminate\Console\Command;
use Illuminate\Foundation\Testing\WithFaker;
use Solarium\Client as SolrClient;
use Solarium\Core\Client\Adapter\Curl as SolrClientAdapter;
use Symfony\Component\EventDispatcher\EventDispatcher;

class TestingFillSolrCore extends Command
{
    use WithFaker;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testing:fill-solr-core';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fills a testing solr core with data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->faker = FakerFactory::create();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $authors = [];
        for ($i = 0; $i < 500; $i++) {
            array_push($authors, $this->faker->name());
        }

        $countries = [];
        for ($i = 0; $i < 10; $i++) {
            array_push($countries, $this->faker->country());
        }

        $formats = [];
        for ($i = 0; $i < 20; $i++) {
            array_push($formats, $this->faker->word());
        }

        $topics = [];
        for ($i = 0; $i < 50; $i++) {
            array_push($topics, $this->faker->word());
        }

        $this->info('Using Solarium version: ' . SolrClient::VERSION);

        // define and open solr client
        $adapter = new SolrClientAdapter();
        $eventDispatcher = new EventDispatcher();
        $config = config('solrEndpoints.testing');
        $solrClient = new SolrClient($adapter, $eventDispatcher, $config);

        // generate update command
        $updateCmd = $solrClient->createUpdate();

        // add documents
        for ($i = 1; $i <= 1000; $i++) {
            $document = $updateCmd->createDocument();
            $document->id = $i;
            $document->pubyear = strval(rand(1900, 2022));
            $document->title = $this->faker->sentence();
            $document->country = $countries[rand(0, count($countries) - 1)];
            $document->format = $formats[rand(0, count($formats) - 1)];
            $document->topic = $topics[rand(0, count($topics) - 1)];

            $authorList = [];
            for ($j = 0; $j < rand(1, 5); $j++) {
                array_push($authorList, $authors[rand(0, count($authors) - 1)]);
            }
            $document->authors = $authorList;

            $updateCmd->addDocument($document);
        }

        // add commit cmd
        $updateCmd->addCommit();

        // add optimize cmd
        $updateCmd->addOptimize();

        // execute update
        $result = $solrClient->update($updateCmd);

        // show results
        $this->info('Status: ' . $result->getStatus());
        $this->info('Query Time: ' . $result->getQueryTime());

        return 0;
    }
}
