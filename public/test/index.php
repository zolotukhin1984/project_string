<?php

function revertWords($sentence)
{
    // Разбиваем предложение по любым знакам, кроме букв и цифр: получаем "слова"
    $words = preg_split(
        '/[^0-9a-zA-Zа-яА-ЯёЁ]+/ui',
        $sentence,
        -1,
        PREG_SPLIT_OFFSET_CAPTURE | PREG_SPLIT_NO_EMPTY
    );

    $revertedSentence = $sentence;
    // Проходимся по каждому "слову"
    foreach ($words as $key => $word) {
        // Разбиваем слово на буквы в массив
        $characters = mb_str_split($word[0]) ?: [];

        // Ищем в массиве букв позиции прописных (т.к. прописными остаются места, а не буквы)
        // И сразу делаем их строчными
        // Буквы с теми же позициями, но от конца, делаем прописными
        foreach ($characters as $position => $character) {
            if ( mb_ereg('[A-ZА-ЯЁ]', $character) ) {
                $characters[$position] = mb_strtolower($character);
                $characters[count($characters) - $position - 1]
                    = mb_strtoupper($characters[count($characters) - $position -1]);
            }
        }

        // Разворачиваем массив букв
        $characters = array_reverse($characters);

        // Склеиваем перевернутый массив обратно в слово
        $words[$key][0] = implode('', $characters);

        // Перевернутое слово вставляем на его место
        $revertedSentence = substr_replace(
            $revertedSentence,
            $words[$key][0],
            $words[$key][1],
            strlen($words[$key][0])
        );
    }

    return $revertedSentence;
}


// Я ланзу, отч у янем ьтсе яанморго яьмес!!!
echo revertWords(
    'Я узнал, что у меня есть огромная семья!!!'
);