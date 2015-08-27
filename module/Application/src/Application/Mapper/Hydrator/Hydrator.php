<?php

namespace Application\Mapper\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;

class Hydrator extends ClassMethods
{
    public function extract($object)
    {
        $entity = $this->getEntity();

        if (!$object instanceof $entity) {
            throw new \Exception('$object must be an instance of ' . $entity);
        }

        $data = parent::extract($object);

        unset($data['array_copy'], $data['array_copy_trait']);

        $data = $this->mapToTable($data);

        return $data;
    }

    public function hydrate(array $data, $object)
    {
        $entity = $this->getEntity();

        if (!$object instanceof $entity) {
            throw new \Exception('$object must be an instance of ' . $entity);
        }

        $data = $this->mapToObject($data);

        return parent::hydrate($data, $object);
    }

    public function mapToTable($data)
    {
        $transform = function ($letters) {
            $letter = array_shift($letters);
            return '_' . strtolower($letter);
        };

        $pregUpper = function ($attribute) use ($transform) {
            return preg_replace_callback(
                '/([A-Z])/',
                $transform,
                $attribute
            );
        };

        foreach ($this->getTemporary() as $attribute) {
            $attribute = $pregUpper($attribute);
            unset($data[$attribute]);
        }

        foreach ($this->getMap() as $attribute => $column) {
            $attribute = $this->transformToDbField($attribute);
            $data = $this->mapField($attribute, $column, $data);
        }
        return $data;
    }

    public function transformToDbField($attribute)
    {
        $transform = function ($letters) {
            $letter = array_shift($letters);
            return '_' . strtolower($letter);
        };

        return preg_replace_callback('/([A-Z])/', $transform, $attribute);
    }

    protected function mapToObject($data)
    {
        foreach ($this->getMap() as $attribute => $column) {
            $data = $this->mapField($column, $attribute, $data);
        }
        return $data;
    }

    protected function mapField($keyFrom, $keyTo, array $array)
    {
        $array[$keyTo] = $array[$keyFrom];
        unset($array[$keyFrom]);
        return $array;
    }

    /*
     * @return string
     */
    protected function getEntity()
    {
        return new \Exception('Entity not declared');
    }

    /*
     * @return array formato: array('classAttribute' => 'column')
     */
    protected function getMap()
    {
        return new \Exception('Map array not declared');
    }

    /**
     * Lista de atributos que nao seram persistidos
     * @return array formato: array('column')
     */
    protected function getTemporary()
    {
        return array();
    }
}
