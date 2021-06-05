<?php

namespace Model\Entities;

class User
{
	use \Library\Shared;
	use \Library\Entity;
	use \Library\Uniroad;

    /**
     * User constructor.
     * @param string $guid
     * @param int|null $context
     * @param string|null $temp
     * @param string|null $chosen_teacher
     */

    public function __construct(public string $guid, public ?int $context = 0, public ?string $temp = null,
                                public ?string $chosen_teacher = null) {
        $this->db = $this->getDB();
    }

	public static function search(?string $guid = null, int $limit = 0):self|array|null {
		$result = [];
		$users = self::getDB() -> select(['User' => []]);

        if ($guid)
            $filters['guid'] = $guid;
		if(!empty($filters))
            $users->where(['User' => $filters]);

		foreach ($users->many($limit) as $user) {
				$class = __CLASS__;
				$result[] = new $class($user['guid'], $user['context'], $user['temp'], $user['chosen_teacher']);
		}
		return $limit == 1 ? ($result[0] ?? null) : $result;
	}

	public function save():self {
		$db = $this->db;
        if (self::search(guid: $this->guid, limit: 1) == []) {
            $db->insert([
                'User' => ['guid' => $this->guid]
            ])->run(true)->storage['inserted'];
        }
        else
            $db -> update('User', $this->_changed)
                -> where(['User'=> ['guid' => $this->guid]])
                -> run();
		return $this;
	}
}