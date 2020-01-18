<?php

namespace App\Http\Controllers;

use App\Http\Requests\LanguageFormRequest;
use App\Http\Resources\LanguageResource;
use App\Models\Language;
use App\Services\LanguageManager;
use Illuminate\Http\Resources\Json\JsonResource;

class LanguageController extends Controller
{
    public function show(Language $language): JsonResource
    {
        return new LanguageResource($language);
    }

    public function index(): JsonResource
    {
        return LanguageResource::collection(Language::all());
    }

    public function create(LanguageFormRequest $request, LanguageManager $languageManager): JsonResource
    {
        $language = $languageManager->createLanguage($request->only('name'));
        return new LanguageResource($language);
    }

    public function update(LanguageFormRequest $request, Language $language, LanguageManager $languageManager): JsonResource
    {
        return new LanguageResource($languageManager->updateLanguage($language, $request->only('name')));
    }

    public function delete(Language $language, LanguageManager $languageManager): JsonResource
    {
        return new LanguageResource($languageManager->deleteLanguage($language));
    }
}
