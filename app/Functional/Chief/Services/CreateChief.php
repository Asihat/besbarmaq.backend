<?php


namespace App\Functional\Chief\Services;


use App\Models\ChiefDirections;
use App\Models\Chiefs;
use App\Models\Location;
use App\Models\Users;
use Illuminate\Support\Facades\Storage;

trait CreateChief
{
    public function CreateChief($request)
    {
        $token = $request->input('token');
        $description = $request->input('description');
        $gender = $request->input('gender');
        $work_time = $request->input('work_time');
        $home_cook = $request->input('home_cook');
        $chief_categories_id = $request->input('chief_categories_id');
        $location = $request->input('location');
        $longtitude = $request->input('longtitude');
        $latitude = $request->input('latitude');
        $documents = $request->file('document');

        $result['success'] = false;

        do {
            if (!$token || !$description || !$gender || !$work_time || !$home_cook || !$chief_categories_id || !$location || !$longtitude || !$latitude) {
                $result['message'] = 'PARAMETER IS MISSMATCH';
                break;
            }

            if (!Users::where('token', $token)->first()) {
                $result['message'] = 'ERROR 1';
                break;
            }

            if(!Users::where('token', $token)->where('bloked', 1)->first()) {
                $result['message'] = 'USER IS BLOKED';
                break;
            }

            if ($gender != 'male' && $gender != 'female') {
                $result['message'] = 'GENDER PARAMETER IS NOT APPROACH';
                break;
            }

            if($home_cook != 0 && $home_cook != 1) {
                $result['message'] = 'HOME COOK PARAMETER IS NOT APPROACH';
                break;
            }

            $user = Users::where('token', $token)->where('bloked', 1)->first();

            if(Chiefs::where('id', $user->id)->first()) {
                $result['message'] = 'CHIEF EXISTS';
                break;
            }

            $new_location = new Location();
            $new_location->location = $location;
            $new_location->longtitude = $longtitude;
            $new_location->latitude = $latitude;
            $new_location->save();


            $new_chief = new Chiefs();
            $new_chief->id = $user->id;
            $new_chief->description = $description;
            $new_chief->status = -1;
            $new_chief->work_time = $work_time;
            $new_chief->location_id = $new_location->id;
            $new_chief->gender = $gender;
            $new_chief->contact = 'NEW CONTACT'; //TODO CONTACT ADD DESCIGN
            $new_chief->home_cook = $home_cook;
            $new_chief->save();

            foreach ($chief_categories_id as $category_id) {
                $new_chief_direction = new ChiefDirections();
                $new_chief_direction->chief_id = $user->id;
                $new_chief_direction->category_id = $category_id;
                $new_chief_direction->save();
            }

            foreach ($documents as $document) {
                Storage::disk('documents')->put('chiefs/' . $user->id, $document);
            }


            $result['success'] = true;
            $result['message'] = 'WAIT PLEASE ADMIN WILL CONTACT WITH YOU IN RECENT TIME';

        } while (false);


        return response()->json($result);
    }
}
