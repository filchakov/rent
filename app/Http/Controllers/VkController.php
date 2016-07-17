<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Modules\ParserModule\VkService;

class VkController extends Controller
{
    protected $vkService = null;

    /**
     * VkController constructor.
     */
    public function __construct()
    {
        $this->setVkService(new VkService());
    }


    public function index(){
        /**
         *
         *
         * https://oauth.vk.com/authorize?client_id=5550387&redirect_uri=https://rent.local/kiev/vk&display=page&scope=groups
         *
         *
         * https://oauth.vk.com/access_token?client_id=5550387&client_secret=52dLOFHQTKwDztYT4lry&code=34f6a90dfc1d1df4b0&redirect_uri=https://rent.local/kiev/vk
         *
        {
            access_token: "6a6f0076cb487abde8d51c5ffc06ab53be5db57079063a958ffb3f7527f7ac7b1dbc990115c5282fdfc02",
            expires_in: 86155,
            user_id: 11629455
        }
         */

        return response([
            'result' => $this->getVkService()->getNewLead()
        ]);
    }

    /**
     * @return VkService
     */
    protected function getVkService()
    {
        return $this->vkService;
    }

    /**
     * @param VkService $vkService
     * @return VkController
     */
    protected function setVkService($vkService)
    {
        $this->vkService = $vkService;
        return $this;
    }


}
