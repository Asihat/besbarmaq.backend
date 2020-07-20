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

}
