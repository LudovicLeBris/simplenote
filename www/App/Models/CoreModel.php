<?php

namespace App\Models;

use App\Utils\Database;

abstract class CoreModel
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $created_at;

    /**
     * @var string
     */
    protected $updated_at;

    abstract public static function find($id, $currentUser=null);
    abstract public static function findAll($currentUser=null);
    abstract public function insert();
    abstract public function update();
    abstract public function delete();

    /**
     * Generic method to save data
     *
     * @return bool
     */
    public function save()
    {
        if(empty($this->id)){
            return $this->insert();
        } else {
            return $this->update();
        }
    }

    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * Get the value of created_at
     *
     * @return  string
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @param  string  $created_at
     *
     * @return  self
     */ 
    public function setCreated_at(string $created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     *
     * @return  string
     */ 
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @param  string  $updated_at
     *
     * @return  self
     */ 
    public function setUpdated_at(string $updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}