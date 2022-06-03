<?php

namespace App\EntityListener;

use App\Entity\Project;
use App\Entity\Technology;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class TechnologyEntityListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Technology $technology, LifecycleEventArgs $event)
    {
        $technology->computeSlug($this->slugger);
    }

    public function preUpdate(Technology $technology, LifecycleEventArgs $event)
    {
        $technology->computeSlug($this->slugger);
    }
}