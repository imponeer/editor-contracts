<?php

namespace Imponeer\Contracts\Editor\Info;

/**
 * Describes source editor
 *
 * @package Imponeer\Contracts\Editor\Info
 */
interface SourceEditorInfoInterface extends EditorInfoInterface
{
    /**
     * Get supported languages that can be highlighted in editor
     *
     * @return string[]
     */
    public function getSupportedLanguages(): array;
}
