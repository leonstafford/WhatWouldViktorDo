<?php

/**
 * Auditor.php
 *
 * @package           WhatWouldViktorDo
 * @author            Leon Stafford <me@ljs.dev>
 * @license           The Unlicense
 * @link              https://unlicense.org
 */

declare(strict_types=1);

namespace WhatWouldViktorDo;

/**
 * Audits WordPress plugin project quality.
 */
class Auditor
{
    private string $projectDir;

    /**
     * Auditor constructor
     *
     * @param string $projectDir Project directory
     * @throws \WhatWouldViktorDo\Exception
     */
    public function __construct(
        string $projectDir
    ) {
        $this->projectDir = $projectDir;
    }

    /**
     * Run the audit script.
     *
     * @return int Exit code 1: error 0: success.
     */
    public function runAudit(): int
    {
        printf('Running audit...');

        $this->validateProjectDir($this->projectDir);

        return (
            $this->hasFile('/README.md') &&
            $this->hasFile('/LICENSE')
            ) ? 0 : 1;
    }

    /**
     * Validate the given project directory.
     */
    public function validateProjectDir(string $projectDir): bool
    {
        if ($projectDir === '') {
            $err = 'Empty project directory received as input';
            throw new \WhatWouldViktorDo\Exception($err);
        }

        if (! is_dir($projectDir)) {
            $err = 'Invalid project directory received as input';
            throw new \WhatWouldViktorDo\Exception($err);
        }

        return true;
    }

    /**
     * Checks a file in the project.
     */
    public function hasFile(string $path, ?string $contents = null, ?int $permissions = null): bool
    {
        return file_exists($this->projectDir . $path) &&
            (isset($contents) ? $contents === file_get_contents($this->projectDir . $path) : true) &&
            (isset($permissions) ? $permissions === fileperms($this->projectDir . $path) : true);
    }
}
