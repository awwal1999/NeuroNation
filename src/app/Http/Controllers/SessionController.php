<?php

namespace App\Http\Controllers;

use App\Services\SessionService;

class SessionController extends BaseController
{
    protected SessionService $sessionService;

    public function __construct(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
    }
    public function history() {
        try {
            $userId = auth()->user()->id;
            $response = $this->sessionService->getSessionHistory($userId);
            return $this->sendResponse($response, 'Session history retrieved successfully.');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return $this->sendError('Failed to retrieve session history.', ['error' => $e->getMessage()]);
        }

    }
}
