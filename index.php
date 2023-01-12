<?php

require 'function.php';

$persons = [
    [
        'fullname' => 'Иванов Иван Иванович',
        'job' => 'tester',
    ],
    [
        'fullname' => 'Степанова Наталья Степановна',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Пащенко Владимир Александрович',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Громов Александр Иванович',
        'job' => 'fullstack-developer',
    ],
    [
        'fullname' => 'Славин Семён Сергеевич',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Цой Владимир Антонович',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Быстрая Юлия Сергеевна',
        'job' => 'PR-manager',
    ],
    [
        'fullname' => 'Шматко Антонина Сергеевна',
        'job' => 'HR-manager',
    ],
    [
        'fullname' => 'аль-Хорезми Мухаммад ибн-Муса',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Бардо Жаклин Фёдоровна',
        'job' => 'android-developer',
    ],
    [
        'fullname' => 'Шварцнегер Арнольд Густавович',
        'job' => 'babysitter',
    ],
];

for ($i = 0; $i < count($persons); $i += 1) {
    foreach ($persons as $key => $value) {
        $fullnamePersons[$i] = $persons[$i]['fullname'];         
    }
}

getGenderDescription ($persons);

$key = rand(0, count($persons) - 1);
$fullnamePerson = getPartsFromFullname ($fullnamePersons[$key]); 
$surnamePerson = $fullnamePerson['surname'];
$namePerson = $fullnamePerson['name'];
$patronomycPerson = $fullnamePerson['patronomyc'];
getPerfectPartner ($surnamePerson, $namePerson, $patronomycPerson, $persons);
