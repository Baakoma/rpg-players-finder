<?php


namespace App\Services;


use App\Models\Language;

class LanguageManager
{
    public function createLanguage(array $languageData): Language
    {
        $language = new Language($languageData);
        $language->save();
        return $language;
    }

    public function updateLanguage(Language $language, array $updateRequest): Language
    {
        $language->update($updateRequest);
        return $language;
    }

    public function deleteLanguage(Language $language): Language
    {
        $language->delete();
        return $language;
    }
}
