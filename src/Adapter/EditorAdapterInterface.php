<?php

namespace Imponeer\Contracts\Editor\Adapter;

use Stringable;

/**
 * Interface describing editor instance that can be rendered
 *
 * @package Imponeer\Contracts\Editor\Adapter
 */
interface EditorAdapterInterface extends Stringable
{
    /**
     * Gets HTML attributes for editor container
     *
     * @return array<string, string>
     */
    public function getAttributes(): array;

    /**
     * Get style urls to be included
     *
     * @return string[]
     */
    public function getStyleURLs(): array;

    /**
     * Get script URL's to be included
     *
     * @return string[]
     */
    public function getScriptURLs(): array;

    /**
     * Get script code that needs to be added to initialize editor
     *
     * @return string
     */
    public function getScriptCode(): string;
}
