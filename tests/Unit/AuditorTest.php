<?php

/**
 * Unit/AuditorTest.php
 *
 * @package           WhatWouldViktorDo
 * @author            Leon Stafford <me@ljs.dev>
 * @license           The Unlicense
 * @link              https://unlicense.org
 */

declare(strict_types=1);

namespace WhatWouldViktorDo;

use org\bovigo\vfs\vfsStream;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery as m;

uses(MockeryTestCase::class);

it(
    'fails when no README.md in project',
    function () {
        $this->projectDir = vfsStream::setup('project_dir');

        $auditor = new Auditor($this->projectDir->url());

        $this->assertFalse($auditor->hasReadme());
    }
);

it(
    'passes when README.md is in project',
    function () {
        $this->projectDir = vfsStream::setup('project_dir');

        file_put_contents($this->projectDir->url() . '/README.md', 'anything');

        $auditor = new Auditor(vfsStream::url('project_dir'));

        $this->assertTrue($auditor->hasReadme());
    }
);

it(
    'fails when no LICENSE.md in project',
    function () {
        $this->projectDir = vfsStream::setup('project_dir');

        $auditor = new Auditor($this->projectDir->url());

        $this->assertFalse($auditor->hasLicense());
    }
);

it(
    'passes when LICENSE.md is in project',
    function () {
        $this->projectDir = vfsStream::setup('project_dir');

        file_put_contents($this->projectDir->url() . '/LICENSE.md', 'anything');

        $auditor = new Auditor(vfsStream::url('project_dir'));

        $this->assertTrue($auditor->hasLicense());
    }
);

it(
    'fails when any parts of audit fails',
    function () {
        $testDouble = m::mock('Auditor');
        $testDouble->shouldReceive('hasReadme')
            ->andReturn(false);

        $this->projectDir = vfsStream::setup('project_dir');
        $auditor = new Auditor(vfsStream::url('project_dir'));

        $this->assertEquals(1, $auditor->runAudit());
    }
);

it(
    'passes when all parts of audit succeed',
    function () {
        $testDouble = m::mock('Auditor');
        $testDouble->shouldReceive('hasReadme')
            ->andReturn(true);

        $this->projectDir = vfsStream::setup('project_dir');
        $auditor = new Auditor(vfsStream::url('project_dir'));

        $this->assertEquals(1, $auditor->runAudit());
    }
);
