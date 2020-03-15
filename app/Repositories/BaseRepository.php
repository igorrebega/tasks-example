<?php

namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use InvalidArgumentException;
use function is_array;

/**
 * Class BaseRepository
 */
abstract class BaseRepository
{
    /** @var Model|Builder $model Model Instance */
    private $model;

    /**
     * Gets a model class name
     *
     * @return string Model Class Name
     */
    abstract public function model(): string;

    /**
     * Makes a model object
     *
     * @return Model Model
     */
    public function makeModel(): Model
    {
        $model = app()->make($this->model());
        if (! $model instanceof Model) {
            throw new InvalidArgumentException(
                "Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model"
            );
        }

        $this->setModel($model);

        return $model;
    }

    /**
     * BaseRepository constructor.
     *
     * @param Model $model Model instance
     *
     * @return BaseRepository|static Repository
     */
    public function setModel(Model $model): BaseRepository
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Gets a model instance
     *
     * @return Model|mixed Model instance
     */
    public function getModel(): Model
    {
        if (null === $this->model) {
            $this->makeModel();
        }

        return $this->model;
    }

    /**
     * Gets query builder of the model
     *
     * @return Builder
     */
    public function newQuery(): Builder
    {
        return $this->getModel()->newQuery();
    }

    /**
     * Creates a record
     *
     * @param mixed[] $data Record data
     *
     * @return Model Created instance
     */
    public function create(array $data): Model
    {
        return $this->makeModel()->create($data);
    }

    /**
     * Adds multiple records to the database at once
     *
     * @param array $data Array of arrays with data
     *
     * @return bool Whether the insert was successful
     */
    public function insert(array $data): bool
    {
        return $this->newQuery()->insert($data);
    }

    /**
     * Updates a model
     *
     * @param string  $id         Model Id
     * @param mixed[] $attributes Model attributes
     *
     * @return bool True - successfully updated, otherwise - false
     * @throws Exception On any error
     */
    public function update($id, $attributes): bool
    {
        $this->setModel($this->findOrFail($id));
        $this->getModel()->fill($attributes);

        return $this->getModel()->save();
    }

    /**
     * Removes a model or a list of models
     *
     * @param string|string[] $id Model Id(s)
     *
     * @return int Number of deleted records
     */
    public function destroy($id): int
    {
        return $this->getModel()->destroy($id);
    }

    /**
     * Finds(or fails) a model with a given id
     *
     * @param string $id Model Id
     *
     * @return Model Model
     *
     * @throws ModelNotFoundException
     */
    public function findOrFail($id): Model
    {
        return $this->getModel()->findOrFail($id);
    }

    /**
     * Find a record by its identifier.
     *
     * @param string|int $id        Model id
     * @param array      $relations Model relations
     *
     * @return Model|null Model
     */
    public function find($id, $relations = null): ?Model
    {
        return $this->findBy($this->getModel()->getKeyName(), $id, $relations);
    }

    /**
     * Find a record by an attribute.
     * Fails if no model is found.
     *
     * @param string $attribute Attribute name
     * @param string $value     Attribute value
     * @param array  $relations Relations
     *
     * @return Model|null Model
     */
    public function findBy($attribute, $value, $relations = null): ?Model
    {
        $query = $this->getModel()->where($attribute, $value);

        if ($relations && is_array($relations)) {
            foreach ($relations as $relation) {
                $query->with($relation);
            }
        }

        return $query->first();
    }
}
