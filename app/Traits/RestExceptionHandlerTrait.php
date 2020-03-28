<?php 

namespace App\Traits;

use Exception;
use Throwable;
use Illuminate\Http\Request;

trait RestExceptionHandlerTrait
{
	protected function handleApiException($request, Throwable $exception)
	{
		$exception = $this->prepareException($exception);
		
		if ($exception instanceof \Illuminate\Http\Exception\HttpResponseException) {
			$exception = $exception->getResponse();
		}

		if ($exception instanceof \Illuminate\Http\JsonResponse) {
			$exception = $exception->getResponse();			
		}

		if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
			$exception = $this->unauthenticated($request, $exception);
		}
		
		if ($exception instanceof \Illuminate\Validation\ValidationException) {			
			$exception = $this->convertValidationExceptionToResponse($exception, $request);
		}

		return $this->customApiResponse($exception);
	}

	protected function customApiResponse($exception)
	{        
		if (method_exists($exception, 'getStatusCode')) {
			$statusCode = $exception->getStatusCode();
		} else {
			$statusCode = 500;
		}
	
		$response = [];
		switch ($statusCode) {
			case 401:
				$response['payload'] = 'Unauthorized';
				break;
			case 403:
				$response['payload'] = 'Forbidden';
				break;
			case 404:
				$response['payload'] = 'Not Found';
				break;
			case 405:
				$response['payload'] = 'Method Not Allowed';
				break;
			case 422:
				$response['payload']['message'] = $exception->original['message'];
				$response['payload']['errors'] = $exception->original['errors'];
				break;
			default:
				$response['payload'] = ($statusCode == 500) ? 'Whoops, looks like something went wrong! Please try again.' : ((method_exists($exception, 'getMessage'))? $exception->getMessage() : 'Unknown error');
				break;
		}

		if($exception instanceof \PDOException)
		{
			$response['payload'] = $this->getMessage($exception);
		}
	
		if (config('app.debug') && $statusCode != 422) {
			// $response['trace'] = $exception->getTrace();			
			if(property_exists($exception,'line'))
				$response['line'] = $exception->getLine();
			$response['payload'] = ((method_exists($exception, 'getMessage'))? $exception->getMessage() : 'Unknown error');
			$response['code'] = ((method_exists($exception, 'getCode'))? $exception->getCode() : 'Unknown code');
		}
	
		//$response['status'] = $statusCode;
		$response['error'] = config('rest.response.error.code'); 
		$response['success'] = false;
		$response['type'] = 'danger';
		$response['fade'] = false;
	
		return response()->json($response, $statusCode);
	}

	protected function getMessage(Exception $e, $msg = null){
		
		if(config('app.env') == 'local'){
			return $e->getLine() . ': ' . $e->getFile() . ' ' . $e->getMessage();
		}else{
			return is_null($msg) ? 'Oops, operation failed please try again' : $msg;
		}
	}

}