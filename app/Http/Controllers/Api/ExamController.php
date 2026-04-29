<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamSession;
use App\Models\Participant;
use App\Models\ExamActivityLog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class ExamController extends Controller
{
    /**
     * Join an exam session.
     */
    public function join(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'public_key' => 'required|string',
            'android_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Find active session
        $session = ExamSession::where('public_key', $request->public_key)
            ->where(function ($query) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>', now());
            })
            ->first();

        if (!$session) {
            return response()->json([
                'success' => false,
                'message' => 'Sesi ujian tidak ditemukan atau sudah berakhir.'
            ], 404);
        }

        // Register or retrieve participant
        $participant = Participant::updateOrCreate(
            [
                'session_id' => $session->id,
                'android_id' => $request->android_id
            ],
            [
                'name' => $request->name,
                'joined_at' => now()
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Berhasil bergabung ke sesi ujian.',
            'data' => [
                'participant_id' => $participant->id,
                'session_id' => $session->id,
                'student_name' => $participant->name
            ]
        ]);
    }

    /**
     * Log student cheating activity.
     */
    public function logActivity(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'participant_id' => 'required|exists:participants,id',
            'type' => 'required|in:screen_off,background_app_opened,force_exit,normal_ping',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mencatat log.',
                'errors' => $validator->errors()
            ], 422);
        }

        ExamActivityLog::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Log aktivitas berhasil dicatat.'
        ]);
    }

    /**
     * Validate Private Key to exit the application.
     */
    public function validateExit(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'private_key' => 'required|string',
            'session_id' => 'required|exists:exam_sessions,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Input tidak valid.',
                'errors' => $validator->errors()
            ], 422);
        }

        $session = ExamSession::where('id', $request->session_id)
            ->where('private_key', $request->private_key)
            ->first();

        if (!$session) {
            return response()->json([
                'success' => false,
                'message' => 'Kode keluar salah atau tidak valid untuk sesi ini.'
            ], 403);
        }

        return response()->json([
            'success' => true,
            'message' => 'Akses keluar diizinkan.'
        ]);
    }
}
