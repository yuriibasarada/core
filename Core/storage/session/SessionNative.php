<?php

namespace Core\storage\session;

use Core\storage\Storage;

class SessionNative extends Storage implements SessionInterface
{
    /**
     * @var string KEY_STORAGE ключ к Харнилищу
     */
    const KEY_STORAGE = '_storage';

    /**
     * @var string KEY_TIME ключ к массиву для времени
     */
    const KEY_TIME = '_time';

    /**
     * @var string $session_id id текущей сесии
     */
    protected $session_id;

    /**
     * @var string $session_name имя текущей сесии
     * @deprecated - В следующей версии не использовать
     */
    protected $session_name;

    /**
     * Инициализация свойств класса
     *
     * SessionNative constructor.
     *
     * @param $storage
     * @param $session_id
     * @param $session_name
     */
    public function __construct($storage, $session_id, $session_name = null)
    {
        $this->session_id = $session_id;
        $this->session_name = $session_name;
        parent::__construct($storage);
    }

    /**
     * Уничтожение сессии
     *
     * @return bool
     */
    public function destroy()
    {
        $this->start();
        $this->storage = array();
        return session_destroy();
    }

    /**
     * Синхронизация сессии
     *
     * @param string $id
     * @return bool
     */
    public function start($id = '')
    {
        if (!$id) $id = $this->session_id;
        else $this->session_id = $id;

        session_id($id);
        return session_start();
    }

    /**
     * Генерация новой сессии
     *
     * @return bool
     */
    public function newSessionId()
    {
        return $this->sync(session_create_id());
    }

    /**
     * Запускает сесию и присваивает ей ключ KEY_TIME (Текущое время создания сессии)
     *
     * @param string $id
     *
     * @return bool|void
     */
    public function sync($id = '')
    {
        $this->start($id);

        // TODO Почему все сессии сохраняються под одним ключом в storage -- " _storage "
        //  а потом смешиваються со всем остальным на 107 и 109 строкой.

        $st = &$_SESSION[self::KEY_STORAGE];
        if (!isset($st)) $st = array();
        $time_now = microtime(true);
        if (isset($_SESSION[self::KEY_TIME]) && $_SESSION[self::KEY_TIME] > $time_now) {
            $new_data = array_merge($this->storage, $st);
        } else {
            $new_data = array_merge($st, $this->storage);
        }
        $_SESSION[self::KEY_TIME] = $time_now;
        $this->storage = $_SESSION[self::KEY_STORAGE] = $new_data;

        session_write_close();
    }

    /**
     * Вернуть идентификатор сессии
     *
     * @return string
     */
    public function getSessionId()
    {
        return $this->session_id;
    }
}