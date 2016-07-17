<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Modules\ParserModule\SosediLunService;

class LunController extends Controller
{
    protected $lunService = null;

    /**
     * LunController constructor.
     */
    public function __construct()
    {
        $this->lunService = new SosediLunService();
    }


    public function index()
    {
        return response([
            'result' => $this->getLunService()->getNewLead()
        ]);
    }

    /**
     * @return SosediLunService
     */
    public function getLunService()
    {
        return $this->lunService;
    }

    /**
     * @param null $lunService
     * @return $this
     */
    public function setLunService($lunService)
    {
        $this->lunService = $lunService;
        return $this;
    }


}
