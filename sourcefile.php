<?php
// START - #2601 - 20180926 - tanmnt - ADD
namespace App\Http\Controllers\Api\v2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;

class BannerController extends ApiBaseController
{
/**
* @param Request $request
* @author tanmnt
* @return string
*/
public function listBanner(Request $request){
try{
$limit = $request->get('litmit',0);
$offset = $request->get('offset',0);
$banners = Banner::where('status',2)->skip($offset)->take($limit)->orderBy('index','asc')->orderBy('move_at','desc')->get();
return $this->jsonOK($banners);
}catch (\Exception $e){
$this->jsonCatchException($e->getMessage());
}
}

/**
* @param Request $request
* @author tanmnt
* @return string
*/
public function viewBanner(Request $request){
try{
$id = $request->get('banner_id');
$banner = Banner::find($id);
if($banner){
$banner->view += 1;
$banner->save();
$message = [
'status' => 'success'
];
}else{
$message = [
'status' => 'error',
'message' => trans('error.banner_empty'),
];
}
return $this->jsonOK($message);
}catch (\Exception $e){
$this->jsonCatchException($e->getMessage());
}
}
}
// END - #2601 - 20180926 - tanmnt - ADD