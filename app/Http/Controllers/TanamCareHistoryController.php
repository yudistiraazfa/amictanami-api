<?php

namespace App\Http\Controllers;

use App\Models\TanamCareHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TanamCareHistoryController extends Controller
{
    public function store(Request $request)
    {
        $userId = $request->input('user_id');
        $title = $request->input('title');
        $explanation = $request->input('explanation');
        $solution = $request->input('solution');
        $date = $request->input('date', now()->toDateTimeString());
        $imageBase64 = $request->input('image_base64');

        if (empty($userId) || empty($title) || empty($explanation) || empty($solution)) {
            return response()->json([
                'success' => false,
                'message' => 'Incomplete data.',
            ], 200);
        }

        $imagePath = null;

        if (!empty($imageBase64)) {
            $uploadDir = public_path('uploads/tanamcare');
            if (!File::exists($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true);
            }

            $imageType = 'jpg';
            $imageContent = $imageBase64;

            if (str_contains($imageBase64, ';base64,')) {
                $imageParts = explode(';base64,', $imageBase64);
                $typeAux = explode('image/', $imageParts[0]);
                $imageType = isset($typeAux[1]) ? $typeAux[1] : 'jpg';
                $imageContent = $imageParts[1];
            }

            $decodedImage = base64_decode($imageContent);
            $fileName = Str::uuid() . '.' . $imageType;
            $relativeFilePath = 'uploads/tanamcare/' . $fileName;
            $fullFilePath = public_path($relativeFilePath);

            if (file_put_contents($fullFilePath, $decodedImage) !== false) {
                $imagePath = $relativeFilePath;
            }
        }

        TanamCareHistory::create([
            'user_id' => $userId,
            'title' => $title,
            'date' => $date,
            'explanation' => $explanation,
            'solution' => $solution,
            'image_path' => $imagePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'History saved successfully.',
        ], 200);
    }

    public function index(Request $request)
    {
        $userId = $request->input('user_id');

        if (empty($userId)) {
            return response()->json([
                'success' => false,
                'message' => 'User ID required.',
            ], 200);
        }

        $histories = TanamCareHistory::where('user_id', $userId)->orderBy('id', 'desc')->get();

        $data = $histories->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'date' => $item->date,
                'explanation' => $item->explanation,
                'solution' => $item->solution,
                'image_path' => $item->image_path,
                'image_url' => $item->image_url,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }
}
