<?php

namespace App\Twig\Components;

use App\Repository\LorealRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class Search
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $query = '';

    public function __construct(private LorealRepository $lorealRepository)
    {
    }

    public function getProducts(): array
    {
        return $this->lorealRepository->findLikeName($this->query);
    }
}
