<?php

namespace W1019;

interface CRUDInterface
{
    /**
     * получить данные
     */
    public function get(): array;

    /**
     * добавить данные
     */
    public function add(array $data): int;

    /**
     * редактирование данных
     */
    public function edit(int $id, array $data);

    /**
     * удаление данных
     */
    public function del(int $id);
}
