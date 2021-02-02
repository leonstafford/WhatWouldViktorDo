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

    $auditor = new Auditor($this->project_dir->url());

    $this->assertFalse($auditor->hasReadme());
});

it('passes when README.md is in project', function () {
    $this->project_dir = vfsStream::setup('project_dir');

    file_put_contents($this->project_dir->url() . '/README.md', 'anything');

    $auditor = new Auditor(vfsStream::url('project_dir'));

    $this->assertTrue($auditor->hasReadme());
});
