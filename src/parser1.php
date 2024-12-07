<?php
require './../vendor/autoload.php';

use Smalot\PdfParser\Parser;


try {
    $pdfFilePath = './../Mendeleev Roman.pdf';

    // Создаем объект парсера
    $parser = new Parser();

    // Парсим PDF файл
    $pdf = $parser->parseFile($pdfFilePath);

    // Извлекаем текст
    $text = $pdf->getText();

    // Выводим результат
    // print_r('<pre>');
    // print_r('$text: ');
    // print_r($text);
    // print_r('</pre>');

    // Разбиваем текст по строкам
    $lines = explode("\n", $text);
    print_r('<pre>');
    print_r('$lines: ');
    print_r($lines);
    print_r('</pre>');

    // Выводим каждую строку
    // $i=0;
    // foreach ($lines as $line)
    // {
    //     $i++;
    //     echo $pageNomer = str_pad($i, 2, '0', STR_PAD_LEFT) . ' ' . $line . '<br>';
    // }

    // Разбиваем текст на блоки с использованием регулярных выражений
    // Например, каждый блок начинается с "Раздел" или какой-то другой метки
    $blocks = preg_split('/(?=Занятость \d+)/', $text);
    print_r('<pre>');
    print_r('$blocks: ');
    print_r($blocks);
    print_r('</pre>');
    exit;

    // Выводим блоки
    foreach ($blocks as $block)
    {
        echo '<pre>' . htmlspecialchars($block) . '</pre>';
    }

} catch (Exception $e) {
    echo 'Ошибка при парсинге PDF: ', $e->getMessage();
}
