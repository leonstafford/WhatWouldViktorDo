<?php

/**
 * AuditorTest.php
 *
 * @package           WhatWouldViktorDo
 * @author            Leon Stafford <me@ljs.dev>
 * @license           The Unlicense
 * @link              https://unlicense.org
 */

declare(strict_types=1);

namespace WhatWouldViktorDo;

use org\bovigo\vfs\vfsStream,
    org\bovigo\vfs\vfsStreamDirectory;

it('fails when no README.md in project', function () {
    $this->project_dir = vfsStream::setup('project_dir');

    $auditor   = new Auditor($this->project_dir);
    $exitCode = $auditor->hasReadme();

    $this->assertEquals(1, $exitCode);
});
