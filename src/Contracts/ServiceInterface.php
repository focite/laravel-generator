<?php

declare(strict_types=1);

namespace Focite\Builder\Contracts;

interface ServiceInterface
{
    public function getRepository(): CurdRepositoryInterface;
}
