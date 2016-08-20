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
         * 
         * https://oauth.vk.com/access_token?client_id=5550387&client_secret=52dLOFHQTKwDztYT4lry&code=606b7f1f96b33865da&redirect_uri=https://rent.local/kiev/vk
         *
        {
            access_token: "6954323cae6ec55d5e91a7d162507f5b200a0c1d24701d13b1d14ae4b0f98421d0aecf46aace2f2082235",
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
