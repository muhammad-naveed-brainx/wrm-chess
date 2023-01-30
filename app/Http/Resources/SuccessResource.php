<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SuccessResource extends JsonResource
{
    public bool $preserveKeys = true;
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    private $message;
    private $data;
    private int $code;

    public function __construct($message, $data = null, int $code = 200)
    {
        parent::__construct($message);
        $this->message = $message;
        $this->data = $data;
        $this->code = $code;
    }

    public function toArray($request)
    {
        return [
            'status' => 'success',
            'message' => $this->message,
            'data' => $this->data,
            'code' => $this->code
        ];
    }

    public function withResponse($request, $response)
    {
        $response->setStatusCode($this->code);
    }
}
