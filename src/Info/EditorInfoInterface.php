<?php

namespace Imponeer\Contracts\Editor\Info;

/**
 * Describes editor
 *
 * @package Imponeer\Contracts\Editor\Info
 */
interface EditorInfoInterface
{

    /**
     * Gets editor name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Checks if editor could is available on the system
     *
     * @return bool
     */
    public function isAvailable(): bool;

    /**
     * Get editor version
     *
     * @return string
     */
    public function getVersion(): string;

    /**
     * Get license for editor
     *
     * @return string
     */
    public function getLicense(): string;

}