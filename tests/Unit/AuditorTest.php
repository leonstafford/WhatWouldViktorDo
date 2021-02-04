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

        $this->assertFalse($auditor->hasFile('/README.md'));
    }
);

it(
    'passes when README.md is in project',
    function () {
        $this->projectDir = vfsStream::setup('project_dir');

        file_put_contents($this->projectDir->url() . '/README.md', 'anything');

        $auditor = new Auditor(vfsStream::url('project_dir'));

        $this->assertTrue($auditor->hasFile('/README.md'));
    }
);

it(
    'fails when no LICENSE in project',
    function () {
        $this->projectDir = vfsStream::setup('project_dir');

        $auditor = new Auditor($this->projectDir->url());

        $this->assertFalse($auditor->hasFile('/LICENSE'));
    }
);

it(
    'passes when LICENSE is in project',
    function () {
        $this->projectDir = vfsStream::setup('project_dir');

        file_put_contents($this->projectDir->url() . '/LICENSE', 'anything');

        $auditor = new Auditor(vfsStream::url('project_dir'));

        $this->assertTrue($auditor->hasFile('/LICENSE'));
    }
);

it(
    'fails when any parts of audit fails',
    function () {
        $testDouble = m::mock(Auditor::class, ['a_dir'])->makePartial();
        $testDouble->shouldReceive('validateProjectDir')
            ->andReturn(true);

        $testDouble->shouldReceive('hasFile')
            ->andReturn(false)
            // only once, as first failed condition prevents further
            ->once();

        $this->assertEquals(1, $testDouble->runAudit());
    }
);

it(
    'passes when all parts of audit succeed',
    function () {
        $testDouble = m::mock(Auditor::class, ['a_dir'])->makePartial();

        $testDouble->shouldReceive('validateProjectDir')
            ->andReturn(true);

        $testDouble->shouldReceive('hasFile')
            ->andReturn(true)
            ->times(2);

        $this->assertEquals(0, $testDouble->runAudit());
    }
);
