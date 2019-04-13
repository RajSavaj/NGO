<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ApiController extends Controller
{
    public function login(Request $request)
    {
      $validator = \Validator::make($request->all(),[
            'email'   => 'required',
            'pass'    => 'required',
      ]);
      if ($validator->fails()) {
      	return response()->json(["start"=>0]);
	  }
	  else
	  {
  	      $users = DB::table('user')
  	                    ->where('email', '=',$request->input('email'))
  	                    ->Where('pass','=',$request->input('pass'))
  	                    ->get();
  	      if(count($users) > 0)
  	      {
  	      	return response()->json($users[0]);
  	      }
  	      else
  	      {
  	      	 return response()->json(["status"=>"0"]);
  	      }
	  }
    }

    public function register(Request $request)
    { 
	       $validator = \Validator::make($request->all(),[
	            'name'    => 'required',
	            'type'    => 'required',
	            'latt'    => 'required',
	            'lang'    => 'required',
	            'mno'     => 'required',
	            'email'   => 'required|unique:user,email',
	            'address' => 'required',
	            'pass'	  => 'required',
	            'image'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	      ]);
	      if ($validator->fails()) {
	      	return response()->json($validator->messages());
		  }
		  else
		  {
		  		$imageName =time().'.'.request()->image->getClientOriginalExtension();
		  		request()->image->move(public_path('image'), $imageName);
		  		DB::table('user')->insert([
					'name'    => $request->input('name'),
		            'type'    => $request->input('type'),
		            'latt'    => $request->input('latt'),
		            'lang'    => $request->input('lang'),
		            'mno'     => $request->input('mno'),
		            'email'   => $request->input('email'),
		            'pass'	  => $request->input('pass'),
		            'address' => $request->input('address'),
		            'image'   => $imageName,
		            'url'	  => $request->input('url'),
		            'oname'   => $request->input('oname'),
		            'omno'    => $request->input('omno'),
				]);
			return response()->json(["status"=>"0"]);
		  }
	}

	public function addFood(Request $request)
	{
		$post=$request->all();
		$imageName =time().'.'.request()->Image->getClientOriginalExtension();
	  	request()->Image->move(public_path('image'), $imageName);

		$id=DB::table('res_item')->insertGetId([
			"R_id"=>$post['R_id'],
			"Name"=>$post['Name'],
			"Time"=>$post['Time'],
			"Status"=>0,
			"Qty"=>$post['Qty'],
			"Image"=>$imageName
		]);
		return response()->json(["id"=>$id,"Image"=>$imageName]);
	}

	public function getTodayFood(Request $request)
	{
		$post=$request->all();
		$sdate=date("Y-m-d")." 00:00:00";
		       $edate=date("Y-m-d")." 23:59:59";
		       $data=DB::table('res_item')->where('R_id',$post['R_id'])->whereBetween('Date',[$sdate,$edate])->get();
		return response()->json($data);
	}

	public function updateQty(Request $rq)
	{
		$post=$rq->all();
		$d=DB::table('res_item')->where('Id','=',$post['Id'])->update(["Qty"=>$post['Qty']]);
		return response()->json($post);
	}

	public function deleteItem(Request $request)
	{
		$post=$request->all();
		DB::table('res_item')->where('Id',$post['Id'])->delete();
		return response()->json(["status"=>'success']);
	}

	public function getRestaurants(Request $request)
	{
		$post=$request->all();
		$sdate=date("Y-m-d")." 00:00:00";
		       $edate=date("Y-m-d")." 23:59:59";
		       $data=DB::select(DB::raw("SELECT u.* FROM user u,res_item r WHERE u.uid=r.R_id AND r.Date BETWEEN '".$sdate."' AND '".$edate."' GROUP BY r.R_id"));
	    return response()->json($data);
	}
	public function todayItemDetail(Request $request)
	{
		$post=$request->all();
		$sdate=date("Y-m-d")." 00:00:00";
		       $edate=date("Y-m-d")." 23:59:59";
		$data=DB::table('res_item')->where('R_id',$post['R_id'])->whereBetween('Date',[$sdate,$edate])->get();
		return response()->json($data);
	}

	public function addOrderItem(Request $request)
	{
	   $post=$request->all();
       $rid=Input::get("R_id");
       $nid=Input::get("N_id");
       $qty=Input::get("Qty");
       $name=Input::get("Name");
       $item=Input::get("I_id");
       foreach ($item as $key => $it) 
       {
       	if($qty[$key]>0)
       	{
	       	DB::table('order_item')->insert([
		       	"I_id"=>$item[$key],
		       	"Name"=>$name[$key],
		       	"Qty"=>$qty[$key],
		       	"R_id"=>$rid,
		       	"N_id"=>$nid
	       	]);
       	}
       }
       return response()->json($post);
	}

	public function restoHistory(Request $request)
	{
		$post=$request->all();
		$sdate=date("Y-m-d")." 00:00:00";
		       $edate=date("Y-m-d")." 23:59:59";
		$data=DB::table('order_item')
		->join('res_item', 'order_item.I_id','=','res_item.id')
		->join('user','user.uid','=','order_item.N_id')
		->where('order_item.R_id',$post['R_id'])->whereBetween('res_item.Date',[$sdate,$edate])
		->select('order_item.Qty', 'order_item.Id', 'res_item.Name','res_item.Image','user.Name as ngoname','order_item.Status')
		->get();
		return response()->json($data);	
	}

	public function acceptItem(Request $request)
	{
		$post=$request->all();
		DB::table('order_item')->where('Id',$post['Id'])->update(["Status"=>$post['Status']]);
		return response()->json($post);	
	}
	public function ngoRequestStatus(Request $request)
	{
		$post=$request->all();
		$sdate=date("Y-m-d")." 00:00:00";
		       $edate=date("Y-m-d")." 23:59:59";
		$data=DB::table('order_item')
		->join('res_item', 'order_item.I_id','=','res_item.id')
		->join('user','order_item.N_id','=','user.uid')
		->where('order_item.N_id','=',$post['N_id'])
		->whereBetween('res_item.Date',[$sdate,$edate])
		->select('order_item.Qty', 'order_item.Id', 'res_item.Name','res_item.Image','user.Name AS ngoname','order_item.Status')
		->get();
		return response()->json($data);	
	}
}
