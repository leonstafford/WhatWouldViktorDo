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
        if ($projectDir === '') {
            $err = 'No project directory received as input';
            throw new \WhatWouldViktorDo\Exception($err);
        }

        if (! is_dir($projectDir)) {
            $err = 'Invalid project directory received as input';
            throw new \WhatWouldViktorDo\Exception($err);
        }

        $this->projectDir = $projectDir;
    }

    /**
     * Run the audit script.
     */
    public function runAudit(): int
    {
        printf('TBD Running audit...');
        return 0;
    }

    /**
     * Check for README.md.
     */
    public function hasReadme(): bool
    {
        return file_exists($this->projectDir . '/README.md');
    }
}
