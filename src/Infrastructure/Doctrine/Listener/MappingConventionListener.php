<?php

namespace App\Infrastructure\Doctrine\Listener;


use App\Domain\Common\Traits\CreatedAt;
use App\Domain\Common\Traits\Entity;
use App\Domain\Common\Traits\UpdatedAt;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;

class MappingConventionListener
{
    public function loadClassMetadata(LoadClassMetadataEventArgs $args)
    {
        $metadata = $args->getClassMetadata();
        $traits = $metadata->getReflectionClass()->getTraitNames();
        if (in_array(Entity::class, $traits, true) && !$metadata->hasField('id')) {
            $metadata->mapField([
                'id' => true,
                'type' => 'uuid_binary',
                'fieldName' => 'id',
                'columnName' => 'id'
            ]);

            $metadata->setIdentifier(['id']);
        }

        if (in_array(CreatedAt::class, $traits, true) && !$metadata->hasField('createdAt')) {
            $metadata->mapField([
                'type' => 'datetime_immutable',
                'fieldName' => 'createdAt',
                'columnName' => 'created_at'
            ]);
        }

        if (in_array(UpdatedAt::class, $traits, true) && !$metadata->hasField('updatedAt')) {
            $metadata->mapField([
                'type' => 'datetime_immutable',
                'fieldName' => 'updatedAt',
                'columnName' => 'updated_at',
                'nullable' => true
            ]);
        }
    }
}
