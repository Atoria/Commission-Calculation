<?php

namespace App\Http\Transformers\Response;
class  ApiResponse
{
    protected int $code;
    protected ?string $message;
    protected ?array $data;

    public function __construct(int $code, ?string $message = null, ?array $data = null)
    {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
    }

    public function toArray(): array
    {
        $response = [
            'code' => $this->code,
        ];

        if ($this->message) {
            $response['message'] = $this->message;
        }

        if ($this->data) {
            $response['data'] = $this->data;
        }

        return $response;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getData()
    {
        return $this->data;
    }
}
