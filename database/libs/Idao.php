<?php
// namespace databse\libs;

interface Idao
{
    public function add($data);
    public function findAll();
    public function findById($id);
    public function findBy($data);
    public function update($data);
}
