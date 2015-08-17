## Domain core

### Hydrating models to entities

Models should use `DeSmart\DomainCore\ConvertsToEntityTrait`. It gives `toEntity()` method which tries to convert the model to entity.

#### Entity class name 

Entity class name is based on model class name. The convention here is:

```
Module\Model\SomeModel -> Module\Entity\SomeModelEntity
```

Entity class name can be changed. Simply set `$entityClassName` attribute in model definition.

#### Passing data to entity

Model is converted to array, and through [`JsonMapper`](https://github.com/netresearch/jsonmapper) all entity properties are set.

#### Passing related models to entity

`toEntity()` will also map related models to proper entites.  
It's done similar to `JsonMapper`. 

If needed some relations can be converted through a dedicated method. Simply create `[relationName]ToEntity` method inside your model.

One-to-many relations have to represented as type hinted variadic argument in entity (see example below).

#### Example

```php
<?php
class User
{
    use ConvertsToEntityTrait;

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function bio()
    {
        return $this->hasOne(Bio::class);
    }

    public function avatar()
    {
        return $this->files()
            ->where('is_avatar', 1);
    }

    public function avatarToEntity(File $avatar, UserEntity $user)
    {
        return new Avatar($file->toEntity());
    }
}

class UserEntity
{
    public function setFiles(FileEntity ...$files)
    {
        $this->files = $files;
    }

    public function setBio(BioEntity $bio) 
    {
        $this->bio = $bio;
    }

    public function setAvatar(Avatar $avatar)
    {
        $this->avatar = $avatar;
    }
}
```
