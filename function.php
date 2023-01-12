<?php 

function getPartsFromFullname ($fullname) {
    $keys = ['surname', 'name', 'patronomyc'];
    return array_combine($keys, explode(" ", $fullname));
}

function getFullnameFromParts ($surname, $name, $patronomyc) {
    return $surname . ' ' . $name . ' ' . $patronomyc;    
}

function getShortName ($fullname) {
    $partsFromFullname = getPartsFromFullname ($fullname);
    $firstLetterSurname = mb_substr($partsFromFullname['surname'], 0, 1);
    return $partsFromFullname['name'] . ' ' . $firstLetterSurname . '.';    
}

function getGenderFromName ($fullname) {
    $partsFromFullname = getPartsFromFullname ($fullname);    
    $genderType = 0;
    
    if (mb_substr($partsFromFullname['surname'], -1) === 'в') {$genderType += 1;};
    if (mb_substr($partsFromFullname['name'], -1)  === 'й') {$genderType += 1;};
    if (mb_substr($partsFromFullname['name'], -1)  === 'н') {$genderType += 1;}
    if (mb_substr($partsFromFullname['patronomyc'], -2) === 'ич') {$genderType += 1;};
    if (mb_substr($partsFromFullname['surname'], -2) === 'ва') {$genderType -= 1;};
    if (mb_substr($partsFromFullname['name'], -1)  === 'а') {$genderType -= 1;};
    if (mb_substr($partsFromFullname['patronomyc'], -3) === 'вна') {$genderType -= 1;};

    return $genderType < 0 ? 'Женщина' : ($genderType > 0 ? 'Мужчина' : 'Не определено');
}

function getGenderDescription ($persons_array) {   
    for ($i = 0; $i < count($persons_array); $i += 1) {
        foreach ($persons_array as $key => $value) {
            $fullnamePersons[$i] = $persons_array[$i]['fullname'];         
        }
    }

    function getPersonGenderMale ($fullname) {
        $gender = getGenderFromName ($fullname);
        return $gender === 'Мужчина' ? true : false;                
    }

    function getPersonGenderFemale ($fullname) {
        $gender = getGenderFromName ($fullname);
        return $gender === 'Женщина' ? true : false;                
    }

    $genderMale = array_filter($fullnamePersons, "getPersonGenderMale");
    $genderFemale = array_filter($fullnamePersons, "getPersonGenderFemale");

    $countMale = count($genderMale);
    $countFemale = count($genderFemale);
   
    $persentMale = round((($countMale * 100) / count($fullnamePersons)), 1);
    $persentFemale = round((($countFemale * 100) / count($fullnamePersons)), 1);
    $persentUndefined = round((100 - ($persentMale + $persentFemale)), 1);
    
    echo "Гендерный состав аудитории:";
    echo "<br>\n";
    echo "---------------------------------------- \n";
    echo "<br>\n";
    echo 'Мужчины - ' . $persentMale . '%';
    echo "<br>\n";
    echo 'Женщины - ' . $persentFemale . '%';
    echo "<br>\n";
    echo 'Не удалось определить - ' . $persentUndefined . '%';  
    echo "<br>\n";
    echo "<br>\n"; 
}

function getRandomPerson ($persons_array, $gender) {
    $randomInt = rand(0, count($persons_array) - 1);
    $randomPerson = $persons_array[$randomInt]['fullname'];
    $randomPersonGender = getGenderFromName($randomPerson);
    return $randomPersonGender !== $gender && $randomPersonGender !== 'Не определено' ? $randomPerson : getRandomPerson ($persons_array, $gender);             
}

function  getPerfectPartner ($surname, $name, $patronomyc, $persons_array) {
    $surname = mb_convert_case($surname, MB_CASE_TITLE);
    $name = mb_convert_case($name, MB_CASE_TITLE);
    $patronomyc = mb_convert_case($patronomyc, MB_CASE_TITLE);
    $fullname = getFullnameFromParts ($surname, $name, $patronomyc);
    $genderPerson = getGenderFromName ($fullname);     

    if ($genderPerson === 'Не определено') {
        echo "---------------------------------------- \n";
        echo "<br>\n"; 
        echo 'Не удалось определить';
        echo "<br>\n"; 
        echo "---------------------------------------- \n"; 
    } else {
        $perfectPartner = getRandomPerson ($persons_array, $genderPerson);
        $firstPartner = getShortName ($fullname);
        $secondPartner = getShortName ($perfectPartner);        
        $int = round((rand(5000, 10000) / 100), 2);
        echo "---------------------------------------- \n";
        echo "<br>\n"; 
        echo $firstPartner . ' + ' . $secondPartner . ' = ';
        echo "<br>\n"; 
        echo "\u{2661} ";
        echo 'Идеально на ' . $int . ' % ';
        echo " \u{2661}";
        echo "<br>\n"; 
        echo "---------------------------------------- \n";                
    }    
}
