<?php

namespace Model\Requests;

class Schedule
{
    private array $list;
    private string $teacher;

    public function request():self {

        $result = [];
        // Сервіс розкладу ще не реалізував метод що повертає назву массив з викладачами та їх предметами
        // $response = $this->uni()->get('routine',
        // ['division' => $this->group],
        // 'account/list')->one();

        $result = [
            [
                'name' => 'Лобачев М.В.',
                'guid' => '666',
                'subjects' =>
                    [
                        [
                            'guid' => '11223344',
                            'title' => 'Управління комунікаціями в IT проектах',
                            'type' => 'practice'
                        ],
                        [
                            'guid' => '11223344',
                            'title' => 'Управління комунікаціями в IT проектах',
                            'type' => 'lecture'
                        ]
                    ]
            ],
            [
                'name' => 'Малерик Р.П.',
                'guid' => '777',
                'subjects' =>
                    [
                        [
                            'guid' => '45454545',
                            'title' => 'Проектний підхід до розробки ПЗ',
                            'type' => 'lab'
                        ],
                        [
                            'guid' => '45454545',
                            'title' => 'Проектний підхід до розробки ПЗ',
                            'type' => 'practice'
                        ]
                    ]
            ],
            [
                'name' => 'Глава М.Г.',
                'guid' => '888',
                'subjects' =>
                    [
                        [
                            'guid' => '334443334',
                            'title' => 'Алгоритмізація та програмування',
                            'type' => 'lab'
                        ],
                        [
                            'guid' => '7777777777',
                            'title' => 'Організація баз даних',
                            'type' => 'practice'
                        ]
                    ]
            ]
        ];

        $this->list = $result;
        return $this;
    }

    public function compare(string $name):string|null {
        $result = null;
        if (!empty($this->list))
            foreach ($this->list as $teacher) {
                if (strcasecmp($name, $teacher['name']) == 0) {
                    $result = $teacher['guid'];
                    $this->teacher = $teacher['name'];
                }
            }
        return $result;
    }

    public function getSubjects():array {


        $result = [$this->teacher];
        foreach ($this->list as $var) {
            if ($var['name'] == $this->teacher) {
                $result = $var['subjects'];
                break;
            }
        }


        for($i = 0; $i<count($result); $i++)
            if ($result[$i]['type'] === 'lab')
                $result[$i]['type'] = 'practice';

      return array_map('unserialize', array_unique(array_map('serialize', $result)));
    }




    public function __construct(private string $group){}

}