<?php namespace QuizModule\Repositories\Interfaces;

interface SectionInterface {

	public function all();

	public function create($input = []);

	public function update($id, $input = []);

	public function find($id);

	public function delete($id);

	public function get($count = NULL);

	public function paginate($count = NULL);
}