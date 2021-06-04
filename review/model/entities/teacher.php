<?php

namespace Model\Entities;

class Teacher {

    use \Library\Shared;
    use \Library\Entity;

    /**
     * Subject constructor.
     * @param string $guid
     * @param string $name
     */

    public function __construct(public string $guid, public string $name) {
        $this->db = $this->getDB();
    }

    public static function search(?string $guid = null, ?string $name = null, int $limit = 0):self|array|null {
        $result = [];
        $teachers = self::getDB() -> select(['Teacher' => []]);

        foreach (['guid', 'name'] as $var)
            if ($$var)
                $filters[$var] = $$var;
        if (!empty($filters))
            $teachers->where(['Teacher'=> $filters]);

        foreach ($teachers->many($limit) as $teacher) {
            $class = __CLASS__;
            $result[] = new $class($teacher['guid'], $teacher['name']);
        }
        return $limit == 1 ? ($result[0] ?? null) : $result;
    }

    public function save():self {
        $db = $this->db;
        if (!$this->guid) {
            $insert = [
                'guid' => $this->guid,
                'name' => $this->name,
            ];
            $this->guid = $db->insert(['Teacher' => $insert])->run(true)->storage['inserted'];
        }
        // Todo: тут надо доделать
        if ($this->_changed)
            $db -> update('Teacher', $this->_changed )
                -> where(['Teacher'=> ['guid' => $this->guid]])
                -> run();
        return $this;
    }
}