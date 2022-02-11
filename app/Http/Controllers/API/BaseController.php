<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{
	/**
	 * Handle basic API responses
	 *
	 * @param      $result  The result
	 * @param      $msg     The message
	 * @param      $cursor  The cursor
	 *
	 * @return     <JSON>
	 */
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

	/**
	 * Handle basic API error responses
	 *
	 * @param      <string>  $error           The error
	 * @param      array   $error_messages  The error messages
	 * @param      int     $code            The code
	 *
	 * @return     <JSON>
	 */
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