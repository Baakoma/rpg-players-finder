<?php

namespace App\Http\Controllers;

use App\Http\Requests\LanguageRequest;
use App\Http\Resources\LanguageResource;
use App\Models\Language;
use App\Services\LanguageManager;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\{Auth, Log};

class LanguageController extends Controller
{
    public function show(Language $language): JsonResource
    {
        Log::info('User '.Auth::id().' viewed language '.$language->id);
        return new LanguageResource($language);
    }

    public function index(): JsonResource
    {
        Log::info('User '.Auth::id().' indexed languages');
        return LanguageResource::collection(Language::all());
    }

    public function create(LanguageRequest $request, LanguageManager $languageManager): JsonResource
    {
        return new LanguageResource($languageManager->createLanguage($request->input('name')));
    }

    public function update(LanguageRequest $request, Language $language, LanguageManager $languageManager): JsonResource
    {
        return new LanguageResource($languageManager->updateLanguage($language, $request->input('name')));
    }

    public function delete(Language $language, LanguageManager $languageManager): JsonResource
    {
        return new LanguageResource($languageManager->deleteLanguage($language));
    }
}
