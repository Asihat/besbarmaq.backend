<?php

namespace App\Http\Controllers;

use App\Functional\Chief\IChief;
use Illuminate\Http\Request;

class ChiefController extends Controller
{
    private $_chief;

    public function __construct(IChief $chief) {
        $this->_chief = $chief;
    }

    public function CreateChief(Request $request) {
        $result = $this->_chief->CreateChief($request);
        return $result;
    }

    public function BestChiefs(Request $request) {
        $result = $this->_chief->BestChiefs($request);
        return $result;
    }

    public function NearChiefs(Request $request) {
        $result = $this->_chief->NearChiefs($request);
        return $result;
    }

    public function NewChiefs(Request $request) {
        $result = $this->_chief->NewChiefs($request);
        return $result;
    }

    public function ChiefForHome(Request $request) {
        $result = $this->_chief->ChiefForHome($request);
        return $result;
    }

    public function ChiefInformation(Request $request) {
        $result = $this->_chief->ChiefInformation($request);
        return $result;
    }

    public function SubscribeToChief(Request $request) {
        $result = $this->_chief->SubscribeToChief($request);
        return $result;
    }
}
