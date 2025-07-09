<?php

namespace Imponeer\Contracts\Editor\Factory;

use Imponeer\Contracts\Editor\Adapter\EditorAdapterInterface;
use Imponeer\Contracts\Editor\Exceptions\IncompatibleEditorException;
use Imponeer\Contracts\Editor\Info\EditorInfoInterface;

/**
 * Interface for describing editor factory
 *
 * @package Imponeer\Contracts\Editor\Factory
 */
interface EditorFactoryInterface
{
    /**
     * Gets info about what this factory creates
     *
     * @return EditorInfoInterface
     */
    public function getInfo(): EditorInfoInterface;

    /**
     * Create editor instance from config
     *
     * @param array $config Configuration for new editor instance
     * @param bool $checkCompatible If config check fails throws IncompatibleEditorException
     *
     * @return EditorAdapterInterface
     *
     * @throws IncompatibleEditorException
     */
    public function create(array $config, bool $checkCompatible = false): EditorAdapterInterface;

}