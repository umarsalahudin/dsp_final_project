<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Medicine;
use Response;
use App\Map;
use App\Med;
use App\Location;
use App\Medic;
use App\Loc;
use DB;
use Cornford\Googlmapper\Facades\MapperFacade;
use Illuminate\Support\Facades\Route;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function index(){
          
          $post= new Medicine;
    	return view('welcome',compact('post'));
    }
    
/*
    public function show(Request $req){
        
        if(!empty($req)){

            $data = Medicine::where([['name','Like','%'.$req->name.'%']])->get();
           // $myarray=['info'=>$data];
           // return Response::json($myarray);

            return response()->json($data);
        }
        if(empty($req)){

            $data="data Not Found";
            return Response::json($data);
        }
    }*/

    public function dspMap(Request $request){

        $lat=$request->lat;
        $lng=$request->lng;


        $maps=Map::whereBetween('lat',[$lat-10,$lat+10])->whereBetween('lng',[$lng-10,$lng+10])->get();
        return $maps;

    }



    public function searchTown (Request $request){

        $town=$request->town;
        $col=Map::where('town',$town)->first();
        $lat=$col->lat;
        $lng=$col->lng;
        return [$lat,$lng];


    }

    public function autocomplete(Request $req){
        

            $data = Medicine::where([['name','Like','%'.$req->name.'%']])->get();
           // $myarray=['info'=>$data];
           // return Response::json($myarray);

            return response()->json($data);
        
       

            
        
    }

    public function searchTownLoc(Request $req){

        $maploc=$req->maploc;

        $col=Map::where('town',$maploc)->first();
        $lat=$col->lat;
        $lng=$col->lng;
        return[$lat,$lng];

    }



    public function show(Request $req)

    {    

        if(!empty($req)){
         
            $medicine = Med::where([['name','Like','%'.$req->name.'%']])->first();
            $locData = Location::where([['town','Like','%'.$req->town.'%']])->first();

            if(empty($medicine) && empty($locData))
            {
                $name=$req->name; 
                $town=$req->town;
                $medicine=DB::table('medicines')->select('*')->where('name','=',$name)->first();
                $locData=DB::table('maps')->select('*')->where('town','=',$town)->first();

                    if(empty($medicine) || empty($locData))
                    {
                     $medicine = Medic::where([['name','Like','%'.$req->name.'%']])->first();
                     $locData = Loc::where([['town','Like','%'.$req->town.'%']])->first();
                     $myarray=['M'=>$medicine,'T'=>$locData];
                     return response()->json($myarray);   
                    } 
                   else{

                     $myarray=['M'=>$medicine,'T'=>$locData];
                     return response()->json($myarray); 
                       }
                
            }     
          else{

                $myarray=['M'=>$medicine,'T'=>$locData];
                return response()->json($myarray);
                   }  
     
        }

        if(empty($req)){

        $data="data Not Found";
        $myarray=[];
        return Response::json($data);
        }

    }
       

public function about(){

return view('index');

}



public function test(Request $req){

    $medics = Medic::where([['name','Like','%'.$req->name.'%']])->first();
    $loc = Loc::where([['town','Like','%'.$req->town.'%']])->first();
    dd($medics);
}


}
