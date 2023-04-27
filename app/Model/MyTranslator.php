<?php

/**
 * Nette Forms localization example.
 */

namespace App\Model;

use Nette\Localization\Translator;

class MyTranslator implements Translator
{
    const file = __DIR__ . '/../localization.ini';
    private array $table;
    public function __construct()
    {
        $this->table = parse_ini_file(self::file, false, INI_SCANNER_RAW);
    }
    /**
     * Translates the given string.
     */
    public function translate($message, ...$parameters): string
    {
        return $this->table[$message] ?? $message;
    }
}