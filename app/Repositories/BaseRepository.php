<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 19-Jan-19
 * Time: 6:34 PM
 */

namespace App\Repositories;


/**
 * Class BaseRepository.
 */
class BaseRepository
{
    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->query()->get();
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function getPaginate($limit)
    {
        return $this->query()->paginate($limit);
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->query()->count();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function find($id)
    {
        return $this->query()->find($id);
    }

    /**
     * @return mixed
     */
    public function query()
    {
        return call_user_func(static::MODEL . '::query');
    }
}
