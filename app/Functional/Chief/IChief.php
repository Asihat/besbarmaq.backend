<?php


namespace App\Functional\Chief;


interface IChief
{
    public function CreateChief($rqeuest);
    public function BestChiefs($request);
    public function ChiefForHome($request);
    public function NearChiefs($request);
    public function NewChiefs($request);
    public function ChiefInformation($request);
    public function SubscribeToChief($request);
}
