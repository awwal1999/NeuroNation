<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class SessionService
{
    public function getSessionHistory($userId)
    {
        // last 12 sessions for logged in user
        $sessions = DB::select("
            SELECT s.id, s.total_score, s.completed_at
            FROM sessions s
            WHERE s.user_id = ?
            ORDER BY s.completed_at DESC
            LIMIT 12
        ", [$userId]);

        $history = collect($sessions)->map(function ($session) {
            return [
                'score' => $session->total_score,
                'date' => strtotime($session->completed_at)
            ];
        });

        $response = collect(['history' => $history]);

        // Optionally Add categories for the most recent session
        if (($history->isNotEmpty())) {
            $lastSessionId = $sessions[0]->id;
            $categories = DB::select("
                SELECT DISTINCT c.name
                FROM categories c
                JOIN exercises e ON c.id = e.category_id
                JOIN session_exercises se ON e.id = se.exercise_id
                WHERE se.session_id = ?
            ", [$lastSessionId]);

            $categoryNames = collect($categories)->pluck('name');
            $response->put('recently_trained', $categoryNames);
        }

        return $response;
    }
}
