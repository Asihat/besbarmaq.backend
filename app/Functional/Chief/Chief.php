<?php


namespace App\Functional\Chief;


use App\Functional\Chief\Services\BestChiefs;
use App\Functional\Chief\Services\ChiefForHome;
use App\Functional\Chief\Services\ChiefInformation;
use App\Functional\Chief\Services\CreateChief;
use App\Functional\Chief\Services\NearChiefs;
use App\Functional\Chief\Services\NewChiefs;
use App\Functional\Chief\Services\SubscribeToChief;

class Chief implements IChief
{
    use CreateChief, BestChiefs, ChiefForHome, NewChiefs, NearChiefs, ChiefInformation, SubscribeToChief;
}
