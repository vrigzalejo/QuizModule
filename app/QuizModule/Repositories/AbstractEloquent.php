<?php namespace QuizModule\Repositories;

abstract class AbstractEloquent {
	
	protected $model;
	protected $count = 10; // Static variable for get and paginate function

	public function __construct($model = NULL) {
		if(is_null($model)) {
			throw new Exception;
		}
		$this->model = $model;
	}

	public function all() {
		return $this->model->all();
	}
	/** 
	 * @param  array $data
	 * @return boolean
	 */
	public function create($data = []) {
		$model = $this->model->create($data);

		if(!$model) {
			return false;
		} 
		return true;
	}
	/**
	 * Update data using id
	 * @param  int $id   
	 * @param  array $input 
	 * @return boolean      
	 */
	public function update($id, $input = []) {

		$model = $this->getById($id);
		return $model->fill($input)->save();
	}
	/**
	 * Find data with the specified id
	 * @param  int $id 
	 * @return Model  
	 */
	public function find($id) {
		return $this->model->findOrFail($id);
	}
	/**
	 * Delete data with the specified id
	 * @param  int $id 
	 * @return Model 
	 */
	public function delete($id) {
		return $this->find($id)->delete();
	}
	/**
	 * Gets the first $count records
	 * @param  int $count 
	 * @return Model      
	 */
	public function get($count = NULL) {
		if(is_null($count)) {
			return $this->model->get();
		} else
		return $this->model->take($count)->get();
	}
	/**
	 * Get and paginate according to $count else paginate by 10
	 * @param  int $count
	 * @return Paginator 
	 */
	public function paginate($count = NULL) {
		if(is_null($count)) {
			return $this->model->paginate($this->count);
		} else
		return $this->model->paginate($count);
	}

}