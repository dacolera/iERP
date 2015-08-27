<?php

namespace Application\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;

abstract class AbstractMapper extends AbstractDbMapper
{
	public function getAll()
	{
		return $this->select($this->getSelect());
	}

	public function getById($id)
	{
		return $this->select(
			$this
				->getSelect()
				->where('id', $id)
				->limit(1)
		)->current();
	}

	public function getByValues($values)
	{
		$map = $this->getHydrator()->getMap();
		if (!is_array($values)) {
			$values = [];
			$count_args = func_num_args();
			for($i=0; $i<$count_args; $i+=2) {
				$key = isset($map[func_get_arg($i)]) ? $map[func_get_arg($i)] : func_get_arg($i);
				$values[$key]  = func_get_arg($i + 1);
			}
		} else {
			foreach($values as $key => $value) {
				if(isset($map[$key])) {
					unset($values[$key]);
					$values[$map[$key]] = $value;
				}
			}
		}

		$select = $this->getSelect();
		$select->where($values);

		return $this->select($select);
	}
}