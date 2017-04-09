<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    protected function image_upload($image , $controller_name, $oldImagePath = 0,$count=0)
    {

        $extension = $image->getClientOriginalExtension();

        if($image->move(public_path().'/assets/images/'.$controller_name,time().$count.'.'.$extension))
        {

            
            $imagePath = '/assets/images/'.$controller_name.'/'.time().$count.'.'.$extension;
            if($oldImagePath)
            {
                try {
                    unlink(public_path().$oldImagePath);
                }
                catch (\Exception $e) {
                }
            }
        }
        return $imagePath;
    }



}
