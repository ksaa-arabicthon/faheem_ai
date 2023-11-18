<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{


    public function chat(): View
    {
        return view("chat");
    }

    public function description(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            "message" => ["required", "string", "max:300"]
        ]);
        if ( $validator->fails() ) {
            return response()
                ->json([
                    "status" => "error",
                    "message" => "Please provide message",
                    "exception" => $validator->messages()
                ], 400);
        }

        $data = $validator->safe()->all();

        try {
            $response = Http::withHeaders([
                "Authorization" => "Bearer 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",
                "OpenAI-Organization" => "org-tIQElLsl9cYFAj3M4eH94Vjd"
            ])->withBody(json_encode([
                "model" => "gpt-3.5-turbo-0613",
                "messages" => [
                    ["role" => "user", "content" => "اكتب اجابة من كلمة واحدة فقط ولا تجاوب باي جملة اخرى، ان لم تجد اجابة فاكتب لايوجد اجابة، اكتب مفردة للوصف التالي:".$data["message"]],
                ],
            ]))->timeout(6)->post("https://api.openai.com/v1/chat/completions");

            $chat = Chat::create([
                "message" => $data["message"],
                "response" => json_encode($response->json())
            ]);

            $imageGenerationResponse = Http::withHeaders([
                "Authorization" => "Bearer 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",
                "Content-Type" => "application/json"
            ])->withBody(json_encode([
                "model" => "dall-e-3",
                "prompt" => "صورة بدون تفاصيل فقط صورة حقيقة واقعية: ".$response->json()["choices"][0]["message"]["content"],
                "size" => "1024x1024",
                "quality" => "standard",
                "n" => 1,
            ]))->post("https://api.openai.com/v1/images/generations");

            $chat->update([
                "image" => json_encode($imageGenerationResponse->json())
            ]);

            return response()
                ->json([
                    "status" => "success",
                    "message" => "Answered",
                    "data" => [
                        "image" => $imageGenerationResponse->json()["data"][0]["url"],
                        "message" => $response->json()["choices"][0]["message"]["content"]
                    ],
                ]);
        } catch (\Exception $exception) {
            return response()
                ->json([
                    "status" => "error",
                    "message" => "نأسف 😢 هناك خطأ أثناء تحليل البيانات الرجاء المحاولة لاحقا",
                    "exception" => $exception->getMessage()
                ], 500);
        }
    }
}
