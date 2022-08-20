<?php


namespace App\Repositories;


use App\Contracts\BaseContract;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseContract
{
    protected $entity;

    /**
     * Repository constructor.
     * @param Model $entity
     */
    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function fill(array $data): static
    {
        $this->entity->fill($data);
        return $this;
    }

    /**
     * @return bool|int
     */
    public function save(): bool|int
    {
        return $this->entity->save();
    }

    /**
     * @param string $column
     * @return $this
     */
    public function orderByDesc(string $column = 'id'): static
    {
        $this->entity->orderByDesc($column);
        return $this;
    }

    /**
     * @param string $column
     * @return $this
     */
    public function orderByAsc(string $column = 'id'): static
    {
        $this->entity->orderBy($column, 'ASC');
        return $this;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id): mixed
    {
        return $this->entity->find($id);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @param $page
     * @return mixed
     */
    public function simplePaginate(int $perPage = 15, array $columns = ['*'], string $pageName = 'page', $page = null): mixed
    {
        return $this->entity->simplePaginate($perPage, $columns, $pageName, $page);
    }

    /**
     * @param $column
     * @param $operator
     * @param $value
     * @return $this
     */
    public function where($column, $operator = null, $value = null): static
    {
        $this->entity->where($column, $operator, $value, 'and');
        return $this;
    }

    /**
     * @param $column
     * @param $operator
     * @param $value
     * @return $this
     */
    public function orWhere($column, $operator = null, $value = null): static
    {
        $this->entity->orWhere($column, $operator, $value, 'or');
        return $this;
    }
}
