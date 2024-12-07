<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Парсинг PDF</title>
</head>
<body>

<input type='file' id='file-input'/>
<pre id='output'></pre>

<script src='https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js'></script>

<script>
    document.getElementById('file-input').addEventListener('change', function (e) {
        const file = e.target.files[0];

        if (file && file.type === 'application/pdf') {
            const reader = new FileReader();

            reader.onload = function () {
                const pdfData = new Uint8Array(reader.result);

                // Загрузка PDF
                pdfjsLib.getDocument(pdfData).promise.then(function (pdf) {
                    let textContent = '';
                    let arText = [];

                    // Извлечение текста с каждой страницы
                    const totalPages = pdf.numPages;
                    for (let pageNum = 1; pageNum <= totalPages; pageNum++) {
                        pdf.getPage(pageNum).then(function (page) {
                            page.getTextContent().then(function (text) {

                                arText.push(text);

                                text.items.forEach(function (item) {
                                    textContent += item.str + ' ';

                                });

                                // Выводим текст
                                document.getElementById('output').textContent = textContent;
                            });
                        });
                    }

                    console.log('arText', arText);

                }).catch(function (error) {
                    console.error('Ошибка при обработке PDF: ', error);
                });
            };

            reader.readAsArrayBuffer(file);
        } else {
            alert('Выберите файл PDF.');
        }
    });
</script>

</body>
</html>
