<?php


namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;


class BaseController extends Controller
{
	public function handleResponse($result, $msg, $cursor=NULL)
	{
		$res = [
			'success' => true,
			'data'    => $result,
			'message' => $msg,
		];
		
		if (!is_null($cursor))
			$res['links'] = ['next' => $cursor];
		
		return response()->json($res, 200);
	}

	public function handleError($error, $error_messages = [], $code = 404)
	{
	
		$res = [
			'success' => false,
			'message' => $error,
		];
		
		if(!empty($error_messages)){
			$res['data'] = $error_messages;
		}
		
		return response()->json($res, $code);
	}
}

?>