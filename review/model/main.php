<?php

namespace Model;

class Main
{
	use \Library\Shared;
    use \Library\Uniroad;


    private $pattern = "/^[А-Яа-яЇїІіЄєҐґ]+[ ][А-Яа-яЇїІіЄєҐґ][.]?[ ]?[А-Яа-яЇїІіЄєҐґ][. ]?$/u";
    private Entities\User|null $user;


    public function uniwebhook(String $type = '', String $value = '', Int $code = 0):?array
    {
        $this->user = Entities\User::search(guid: $this->getVar('user'), limit: 1);
        if(!isset($this->user))
            $this->user = (new Entities\User(guid: $this->getVar('user')))->save();

        if($value == '/start'){
            $this->user->set(['context' => 1]);
            $this->user->set(['temp' => NULL]);
            $this->user->set(['chosen_teacher' => NULL]);
        }

        $context = Entities\Message::search(id: $this->user->context, limit: 1);

        switch ($type) {
            case 'message':
                if ($value == 'вихід') {
                    $result = ['type' => 'context', 'set' => null];
                } elseif ($this->user->context == 1 ) {
                    $result = [
                        'type' => 'message',
                        'value' => "Оберіть функцю нижче",
                        'to' => $this->user->guid,
                        'keyboard' => [
                            'inline' => true,
                            'buttons' => $context->getKeyboard()
                        ]
                    ];
                } elseif ($this->user->context == 2 || $this->user->context == 3) {
                    if (preg_match($this->pattern, $value)) {
                        $name = $this->formatName($value);
                        if ($this->user->context == 3) {
                            $rating = new Entities\Rating();
                            $teacher = $rating->getTeacher($name);
                            if (isset($teacher)) {
                                $this->user->set(['chosen_teacher' => $teacher->guid]);
                                $subjects = $rating->getSubjects();
                                if (isset($subjects)) {
                                    $this->user->set(['temp' => json_encode($subjects, JSON_UNESCAPED_UNICODE)]);
                                    $keyboard = [];
                                    $count = 100;
                                    foreach ($subjects as $sub) {
                                        $count++;
                                        $keyboard[] = [
                                            'id' => $count,
                                            'title' => $sub->title
                                        ];
                                    }
                                    $this->user->set(['context' => 11]);
                                    $message = Entities\Message::search(id: $this->user->context, limit: 1);
                                    $result = [
                                        'type' => 'message',
                                        'value' => $message->text,
                                        'to' => $this->user->guid,
                                        'keyboard' => [
                                            'inline' => true,
                                            'buttons' => [$keyboard]
                                        ]
                                    ];
                                }
                            } else
                                $result = [
                                    'type' => 'message',
                                    'value' => 'У даного викладача ще немає жодного рейтингу',
                                    'to' => $this->user->guid,
                                ];
                        } else {
                            $account = new Requests\Account($this->user->guid);
                            $group = $account->request();
                            $schedule = new Requests\Schedule($group);
                            $flag = $schedule->request()->compare($name);
                            if ($flag) {
                                $subjects = $schedule->getSubjects();
                                $this->user->set(['chosen_teacher' => $flag]);
                                $this->user->set(['temp' => json_encode($subjects, JSON_UNESCAPED_UNICODE)]);
                                $buttons = [];
                                $count = 200;
                                $text = "Оберіть дисципліну, за якою бажаєте оцінити даного викладача\n\n".
                                "Викладача можна оцінити окремо як лектора і як практика.\n" .
                                "Лектор - той, хто проводить лекційні заняття\n" .
                                "Практик - той, хто проводить практичні й лабораторні заняття\n\n";
                                foreach ($subjects as $sub) {
                                    $count++;
                                    $text .= $count-200 . '. ' . $sub['title'] .  $this->getRole($sub['type']) . "\n";
                                    $buttons[] = [
                                        'id' => $count,
                                        'title' => $count-200
                                    ];
                                }
                                $this->user->set(['context' => 10]);
                                $result = [
                                    'type' => 'message',
                                    'value' => $text,
                                    'to' => $this->user->guid,
                                    'keyboard' => [
                                        'inline' => true,
                                        'buttons' => [$buttons]
                                    ]
                                ];
                            }
                            else
                                $result = [
                                    'type' => 'message',
                                    'value' => 'У вашому розкладі не було знайдено викладача ' . $name,
                                    'to' => $this->user->guid,
                                ];
                        }
                    } else
                        $result = [
                            'type' => 'message',
                            'value' => 'Некоректний формат введення. Спробуйте ще раз',
                            'to' => $this->user->guid
                        ];
                }
                break;

            case 'click':
                if ($code == 2 || $code == 3) {
                    $this->user->set(['context' => $code]);
                    $message = Entities\Message::search(id: $this->user->context, limit: 1);
                    if ($code == 2) $name = 'Лобачев М.В.'; else $name = 'Бєлік Я.Ю.';
                    $result = [
                        'type' => 'message',
                        'value' => $message->text . "\n\nВведіть прізвище та ініціали викладача. Приклад: " . $name,
                        'to' => $this->user->guid,
                    ];
                }
                if ($this->user->context == 10) {
                    $subjects = json_decode($this->user->temp);
                    $teacher = $this->user->chosen_teacher;
                    $chosen = null;
//                    $count = 200;
//                    foreach ($subjects as $sub) {
//                        $count++;
//                        if ($count == $code){
//                            $chosen = new Entities\Subject($sub->guid, $sub->title);
//                            break;
//                        }
//                    }
//                    if($subjects['type'] == 'lecture'){
//                        // а тут треба опитування проводити за питаннями про лектора
//                    }
//                    else {
//                        // а тут треба опитування проводити за питаннями про практика
//                    }
                    $result = [
                        'type' => 'message',
                        'value' => 'А на цьому поки все, приходьте завтра',
                        'to' => $this->user->guid,
                    ];
                }
                if ($this->user->context == 11) {
                    $subjects = json_decode($this->user->temp);
                    $teacher = $this->user->chosen_teacher;

                    $count = 100;
                    $chosen = null;
                    foreach ($subjects as $sub) {
                        $count++;
                        if ($count == $code){
                            $chosen = new Entities\Subject($sub->guid, $sub->title);
                            break;
                        }
                     }

                    $rating = new Entities\Rating();
                    $text = $rating->getStatistics($teacher, $chosen);
                    $result = [
                        'type' => 'message',
                        'value' => $text,
                        'to' => $this->user->guid,
                    ];
                }
                break;
		}
		return $result;
    }

    public function evaluate(String $user, String $name, String $subject, String $role):string|array {

        // Перевіряємо в БД, чи оцінював студент даного викладача за цим предметом і роллю раніше
        // Якщо так, то повертаємо рядок з відповідним повідомленням

        // Якщо ні, то створюємо перелік питань для даної ролі
        // За допомогою ще не створеного типу 'Форма' для заповнення користувачем набору даних,
        // відправляємо відповідь до головного боту

        //Отриманний результат записуэмо до БД й перераховуэмо результат
    }

    //public function getScheduleSubjects(String $user, String $name):?array {
    public function getScheduleSubjects(String $user):?array {

        $response = $this->uni()->get('accounts', ['type'=> 'user', 'user'=> $user], 'account/list')->one();
        return json_decode($response);

//        // Виконуємо запит до сервісу аккаунтів для отримання групи користувача
//        $account = new \Requests\Account();
//        $group = $account->makeRequest($user);
//
//        // Виконуємо запит до сервісу розкладу для перевірки наявності викладача та отримання дисциплін, які він викладає
//        $schedule = new \Requests\Schedule();
//        $list = $schedule->makeRequest($group);
//        $schedule->createSubjectList($list);
//        // Якщо такий викладач викладає заданій групі, то відправляємо головному боту перелік дисциплін з
//        // вказаною ролю (лектор/практик), які викладає цей викладач, щоб користувач міг обрати, за якою дисципліною оцінити
//        return $schedule->createSubjectList($list);
    }

    public function getRatingSubjects(String $name):?array {
        $result = null;

        // Шукаєму в БД наявність рейтингу даного викладача, і повертаємо усі дисципліни (не враховуючи роль),
        // за якими його було оцінено

        // Повертає перелік дисциплін, щоб користувач міг обрати

        return $result;
    }


    public function rating(String $name, String $subject):string|array {
        $result = null;
        $rating = new \Library\Rating($name, $subject);
        $result = $rating->drawImage(); // Повертає зображення/два зображення

        return $result;
    }


	public function __construct() {
		$this->db = new \Library\MySQL('core',
			\Library\MySQL::connect(
				$this->getVar('DB_HOST', 'e'),
				$this->getVar('DB_USER', 'e'),
				$this->getVar('DB_PASS', 'e')
			) );
		$this->setDB($this->db);
		$this -> TG = new Services\Telegram(key: $this->getVar('TG_TOKEN', 'e'), emergency: 540243404);
	}
}