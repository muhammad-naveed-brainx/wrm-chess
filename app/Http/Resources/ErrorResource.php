<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    private $message;
    private $error_code;

    public function __construct($message, $error_code)
    {
        parent::__construct($message);
        $this->message = $message;
        $this->error_code = $error_code;
    }

    public function toArray($request)
    {
        return [
            'status' => 'error',
            'message' => $this->message,
            'data' => null
        ];
    }

    public function withResponse($request, $response)
    {
        $response->setStatusCode($this->error_code);
    }
}
