<?php

namespace App\Services;

use App\Models\Language;
use Illuminate\Support\Facades\{Auth, Log};

class LanguageManager
{
    public function createLanguage(array $languageData): Language
    {
        $language = new Language($languageData);
        $language->save();
        Log::info('User '.Auth::id().' created language '.$language->id);
        return $language;
    }

    public function updateLanguage(Language $language, array $updateRequest): Language
    {
        $language->update($updateRequest);
        Log::info('User '.Auth::id().' updated language '.$language->id);
        return $language;
    }

    public function deleteLanguage(Language $language): Language
    {
        $language->delete();
        Log::info('User '.Auth::id().' deleted language '.$language->id);
        return $language;
    }
}
