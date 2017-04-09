<?php

namespace App\Http\Controllers;

use App\Models\ResQuar;
use App\Models\Service;
use App\Models\UserVisit;
use App\Models\Violation;
use Illuminate\Http\Request;

class reportController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function violVsDays(){
        $violationsWeek=array();
        for ($i=0; $i<=6; $i++) {
            $violations = Violation::whereDay('date', '=', date('d', strtotime('today - '.$i.'day')))->count();
            $violationsDay['value']=$violations;
            $violationsDay['elapsed']=date('D', strtotime('today - '.$i.'day'));
            $violationsWeek[] = $violationsDay;
        }
        return response()->json($violationsWeek);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function violVsMonths(){
        $violationsWeek=array();
        for ($i=0; $i<=6; $i++) {
            $violations = Violation::whereMonth('date', '=', date('m', strtotime('this month - '.$i.' months')))->count();
            $violationsDay['value']=$violations;
            $violationsDay['elapsed']=date('M Y', strtotime('this month - '.$i.' months'));
            $violationsWeek[] = $violationsDay;
        }
        return response()->json($violationsWeek);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function violVsResQuars(){
        $data=array();
      $resQurs= ResQuar::has('violations')->withCount('violations')->get();

            foreach ($resQurs as $resQur) {
                $dat['x'] = $resQur->name;
                $dat['y'] = $resQur->violations_count;
                $data[] = $dat;
            }

        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function violVsServices(){
        $data=array();
        $services= Service::has('violations')->withCount('violations')->get();

        foreach ($services as $service) {
            $dat['x'] = $service->name;
            $dat['y'] = $service->violations_count;
            $data[] = $dat;
        }

        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function visitVsResQuar(){
        $data=array();
        $colors=array();
        $resQurs= ResQuar::has('userVisits')->withCount('userVisits')->get();

            foreach ($resQurs as $resQur) {
                $dat['label'] = $resQur->name;
                $dat['value'] = $resQur->user_visits_count;
                $data[] = $dat;
                $letters = '0123456789ABCDEF';
                $color = '#';
                for ($i = 0; $i < 6; $i++) {
                    $color .= $letters[rand(0, 15)];
                }
                $colors[] = $color;
            }

    $resp['data'] =$data;
    $resp['colors'] =$colors;
        return response()->json($resp);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function visitlVsDays(){
        $userVisitsWeek=array();
        $colors=array();
        for ($i=0; $i<=6; $i++) {
            $userVisit= UserVisit::whereDay('date', '=', date('d', strtotime('today - '.$i.'day')))->count();
            $userVisitDay['value']=$userVisit;
            $userVisitDay['label']=date('d/m/Y', strtotime('today - '.$i.'day'));
            $userVisitsWeek[] = $userVisitDay;
            $letters = '0123456789ABCDEF';
            $color = '#';
            for ($j = 0; $j < 6; $j++ ) {
                $color .= $letters[rand(0,15)];
            }
            $colors[] = $color;
        }

        $resp['data'] =$userVisitsWeek;
        $resp['colors'] =$colors;

        return response()->json($resp);
    }
}
