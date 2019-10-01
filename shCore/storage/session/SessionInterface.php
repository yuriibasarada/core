<?php

namespace shCore\storage\session;


interface SessionInterface
{
    /**
     * Запуск сесии
     * @param string $id
     * @return mixed
     */
    public function start($id = '');

    /**
     * Уничтожение сесии
     * @return mixed
     */
    public function destroy();

    /**
     * Синхронизация сесии
     * @param string $id
     * @return mixed
     */
    public function sync($id = '');

    /**
     * Генерация новой сесии
     * @return mixed
     */
    public function newSessionId();

    /**
     * Вернуть идентификатор сесии
     * @return mixed
     */
    public function getSessionId();
}