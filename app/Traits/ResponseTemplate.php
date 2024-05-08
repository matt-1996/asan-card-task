<?php

namespace App\Traits;
use Illuminate\Http\JsonResponse;
trait ResponseTemplate
{
    private $data = [];
    private $status = 200;
    private $status_message = "";

    private $success_message = "SUCCESSFUL";
    private $failed_message = "FAILED";
    private $errors = [];
    private $variables = [];

    private $stringMessage = '';

    public function setStatus(int $status) : self
    {
         $this->status = $status;

         return $this;
    }

    public function setMessage(string $message) : self
    {
        $this->stringMessage = $message;
        return $this;
    }
    public function setStatusMessage(string $status_message) : self
    {
        $this->status_message = $status_message;
        return $this;
    }

    public function setData($data) : self
    {
        $this->data = $data;
        return $this;
    }

    public function setErrors($errors) : self
    {
        $this->errors = $errors;
        return  $this;
    }

    public function setVariable(string $key,$value) : self
    {
         $this->variables[$key] = $value;
         return $this;
    }

    public function setArray($array) : self
    {
        foreach ($array as $key => $item)
            $this->setVariable($key,$item);
        return  $this;
    }

    public function response(string $platform = 'app') : JsonResponse
    {
        if ($this->status > 299)
            $this->setStatusMessage($this->failed_message);
        else
            $this->setStatusMessage($this->success_message);
        switch ($platform) {
            case 'app':
                return response()->json([
                    ...$this->variables,
                    'data' => $this->data,
                    'errors' => $this->errors,
                    'status_message' => $this->status_message,
                    'message' =>    $this->stringMessage
                ],$this->status);
                break;
            default:
                  return response()->json(['data' => $this->data,'errors' => $this->errors],$this->status);
                break;
        }
    }
}
