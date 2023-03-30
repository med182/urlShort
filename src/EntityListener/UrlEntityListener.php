<?php

namespace App\EntityListener;

use App\Utils\Str;
use App\Entity\Url;
use Doctrine\ORM\Events;


use App\Repository\UrlRepository;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;

#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: Url::class)]
class UrlEntityListener
{
    private $urlRepo;
    public function __construct(UrlRepository $urlRepo)
    {
        $this->urlRepo = $urlRepo;
    }



    public function prePersist(Url $url, LifecycleEventArgs $event): void
    {
        $url->setShortened($this->getUniqueShortenedString());
    }

    public  function getUniqueShortenedString(): string
    {
        $shortened = Str::random(6);
        if ($this->urlRepo->findOneBy(['shortened' => $shortened])) {
            return $this->getUniqueShortenedString();
        }
        return $shortened;
    }
}
