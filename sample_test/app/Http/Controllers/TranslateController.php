<?php
namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TranslateController extends Controller
{
    public function index(Request $request)
    {
        // 翻訳元の文章を取得
        $sourceText = $request->input('text');

        // APIキーとエンドポイントを設定
        $apiKey = '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';
        $url = 'https://api.openai.com/v1/engines/ada/completions';

        // Guzzleを使ってAPIにリクエストを送信
        $client = new Client();
        $response = $client->post($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $apiKey,
            ],
            'json' => [
                'prompt' => $sourceText,
                'temperature' => 0.7,
                'max_tokens' => 10,
                'top_p' => 1.0,
                'frequency_penalty' => 0.0,
                'presence_penalty' => 0.0,
            ],
        ]);

        // APIのレスポンスから翻訳後の文章を取得
        $translatedText = json_decode($response->getBody()->getContents(), true)['choices'][0]['text'];
        dd($translatedText);
        // ビューを返す
        return view('translate', [
            'sourceText' => $sourceText,
            'translatedText' => $translatedText,
        ]);
    }
}

