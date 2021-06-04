<?php

namespace Model\Requests;

class Account
{

    public function request(): string{
        // Сервіс аккаунтів ще не реалізував метод що повертає назву групи
        // $response = $this->uni()->get('account',
        // ['type'=> 'user', 'user'=> $this->user],
        // 'account/list')->one();
        return 'УП191';
    }

    public function __construct(private string $user){
    }
    
}