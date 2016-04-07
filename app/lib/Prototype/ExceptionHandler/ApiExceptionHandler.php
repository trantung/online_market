<?php
namespace Prototype\ExceptionHandler;

class ApiExceptionHandler {

    private function makeJsonResponse($code, $msg, $data = null) {
        return \Response::json([
                "code" => $code,
                "message" => $msg,
                "data" => $data,
        ]);
    }

    public function handleUserLoginException(){
        return $this->makeJsonResponse(401, "Username or email is wrong");
    }

    public function handleUserSessionErrorException(){
        return $this->makeJsonResponse(402, "User session is wrong");
    }

    public function handleDeviceErrorException(){
        return $this->makeJsonResponse(403, "DeviceID is wrong");
    }

    public function handleUserRegisterException(){
        return $this->makeJsonResponse(404, "Email is wrong or registered");
    }

    public function handlePasswordErrorException(){
        return $this->makeJsonResponse(405, "Password is wrong");
    }

    public function handleUploadErrorException(){
        return $this->makeJsonResponse(406, "Image upload is wrong");
    }

    public function handleEmailErrorException(){
        return $this->makeJsonResponse(407, "Email is wrong");
    }

    public function handleUserStatusErrorException(){
        return $this->makeJsonResponse(408, "Account has not been activated");
    }

}
