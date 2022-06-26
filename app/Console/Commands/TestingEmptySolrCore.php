<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Solarium\Client as SolrClient;
use Solarium\Core\Client\Adapter\Curl as SolrClientAdapter;
use Symfony\Component\EventDispatcher\EventDispatcher;

class TestingEmptySolrCore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testing:empty-solr-core';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes all documents from solr core';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Using Solarium version: ' . SolrClient::VERSION);

        // define and open solr client
        $adapter = new SolrClientAdapter();
        $eventDispatcher = new EventDispatcher();
        $config = config('solrEndpoints.testing');
        $solrClient = new SolrClient($adapter, $eventDispatcher, $config);

        // generate update command
        $updateCmd = $solrClient->createUpdate();

        // add the delete query and a commit command to the update query
        $updateCmd->addDeleteQuery('*:*');
        $updateCmd->addCommit();

        // execute update
        $result = $solrClient->update($updateCmd);

        // show results
        $this->info('Status: ' . $result->getStatus());
        $this->info('Query Time: ' . $result->getQueryTime());

        return 0;
    }
}
