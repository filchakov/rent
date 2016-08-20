<?php

namespace App\Console\Commands;

use App\City;
use App\Donor;
use Illuminate\Console\Command;
use Modules\ParserModule\VkService;

class VkParser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parser:vk {city}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parser vk.com (public and group)';

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
     * @return mixed
     */
    public function handle()
    {

        $vkService = new \Modules\ParserModule\VkService();
        $donors = new Donor();

        if($this->hasArgument('city')){
            $city = City::where(['alias' => $this->argument('city')])->first();

            if(!empty($city)){
                $this->info('Run city ' . $city->name_en);

                $boards = $donors->getBoardsVk()->where(['city_id' => $city->id])->get();

                $walls = $donors->getWallsVk()->where(['city_id' => $city->id])->get();

            } else {
                $this->error('City ' . $this->argument('city') . ' not found');
                die;
            }
        }

        //$boards = $donors->getBoardsVk()->get();
        //$walls = $donors->getWallsVk()->get();

        $this->info('Parsing board');

        $bar = $this->output->createProgressBar(count($boards));

        $this->line('Boards count ' . count($boards));

        $total_row = 0;

        foreach($boards as $key => $orderBoards){
            sleep(1);

            $vkService->getBoardsClient()->setGroupId($orderBoards->feed_id)->setTopicId($orderBoards->sub_feed_id);
            $resultLeads = $vkService->getBoardsClient()->getLeads($orderBoards->offset);

            $vkService->saveLeads($orderBoards, $resultLeads);

            $orderBoards->offset += count($resultLeads);
            $orderBoards->save();

            $total_row += count($resultLeads);

            $bar->advance();
        }

        echo "\r\n";
        $this->info('New leads ' . $total_row);

        $this->info('Parsing walls');
        $this->line('Walls count ' . count($walls));

        $bar = $this->output->createProgressBar(count($walls));
        $total_row = 0;
        foreach ($walls as $key => $orderWall){
            sleep(1);

            $vkService->getWallsClient()->setOwnerId('-'.$orderWall->feed_id);

            $resultLeads = $vkService->getWallsClient()->getLeads($orderWall->offset);

            $vkService->saveLeads($orderWall, $resultLeads);

            $orderWall->offset += count($resultLeads);
            $orderWall->save();

            $total_row += count($resultLeads);

            $bar->advance();

        }
        echo "\r\n";
        $this->info('New leads ' . $total_row);
    }
}
