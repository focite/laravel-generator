<?php

declare(strict_types=1);

namespace Focite\Generator\Contracts;

interface ServiceInterface
{
    public function getRepository(): CurdRepositoryInterface;
}
