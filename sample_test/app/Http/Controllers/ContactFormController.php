<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;

use Illuminate\Http\Request;

use App\Models\ContactForm;
use App\Services\CheckFormService;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreControllerRequest;
use Illuminate\Support\Facades\DB;
class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = ContactForm::select("id", "name", "title", "created_at")->paginate(20);
        return view("contacts/index",compact("contacts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("contacts/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreControllerRequest $request)
    {
        $sourceText = $request->contact;

        // APIキーとエンドポイントを設定
        $apiKey = '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';
        $url = 'https://api.openai.com/v1/chat/completions';

        // Guzzleを使ってAPIにリクエストを送信
        $client = new Client();
       /* $response = $client->post($url, [
           
        ]);*/
        $messages = [
            [
                'role' => 'user',
                'content' => "『".$request->contact."』を日本語に翻訳して"
            ],
        ];
        $response = $client->post('https://api.openai.com/v1/chat/completions', [
           'headers' => [
                'Authorization' => 'Bearer '.$apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-3.5-turbo',
                "messages" => $messages,
                'temperature' => 0.7,
                'max_tokens' => 50,
                'n' => 1,
                'stop' => '',
            ],
        ]);

        // APIのレスポンスから翻訳後の文章を取得
        $translatedText = json_decode($response->getBody()->getContents(), true)['choices'][0]['message']["content"];
        // ビューを返す
        /*return view('translate', [
            'sourceText' => $sourceText,
            'translatedText' => $translatedText,
        ]);*/
        ContactForm::create([
            'name' => $request->name,
            'title' => $request->title,
            'email' => $request->email,
            'url' => $request->url,
            'gender' => $request->gender,
            'age' => $request->age,
            'contact' => $translatedText
        ]);
        return to_route("contacts.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = ContactForm::find($id);
        $contact->age = CheckFormService::checkAge($contact);
        $contact->gender = CheckFormService::checkGender($contact);
        
        
        return view("contacts.show", compact("contact"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = ContactForm::find($id);
        return view("contacts.edit", compact("contact"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact = ContactForm::find($id);
        $contact->name = $request->name;
        $contact->title = $request->title;
        $contact->email = $request->email;
        $contact->url = $request->url;
        $contact->gender = $request->gender;
        $contact->age = $request->age;
        $contact->contact= $request->contact;
        $contact->save();

        return to_route("contacts.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $contact = ContactForm::find($id);
        $contact->delete();

        return to_route("contacts.index");
    }
}
