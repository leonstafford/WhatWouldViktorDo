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

it('asserts true is true', function () {
    $this->assertTrue(true);

    expect(true)->toBeTrue();
});
