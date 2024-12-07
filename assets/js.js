/**
 * Найти строку, которая содержит подстроку, начинающуюся с одного из нескольких вхождений,
 * и вернуть эту подстроку без поисковой части.
 * @param {string} text - Исходный текст.
 * @param {string} startPhrases - Фразы, разделенные символом |, с которых может начинаться подстрока.
 * @returns {string | null} - Найденная подстрока без поисковой части или null, если ничего не найдено.
 */
function findSubstringStartingWith(text, startPhrases) {
    const regex = new RegExp(`(${startPhrases})`, 'i'); // Создаем регулярное выражение для поиска
    const lines = text.split('\n');

    for (const line of lines) {
        const match = line.match(regex);
        if (match) {
            return line.substring(match.index + match[0].length).trim(); // Убираем поисковую часть
        }
    }
    return null;
}


/**
 * Найти строку, которая содержит подстроку, заканчивающуюся на определённое вхождение,
 * и вернуть эту подстроку без поисковой части.
 * @param {string} text - Исходный текст.
 * @param {string} endPhrase - Фраза, на которой заканчивается подстрока.
 * @returns {string | null} - Найденная подстрока без поисковой части или null, если ничего не найдено.
 */
function findSubstringEndingWith(text, endPhrase) {
    const lines = text.split('\n');
    for (const line of lines) {
        const endIndex = line.indexOf(endPhrase);
        if (endIndex !== -1) {
            return line.substring(0, endIndex).trim(); // Возвращает подстроку без поисковой части
        }
    }
    return null;
}


/**
 * Найти n строк до или после строки с ключевой фразой.
 * @param {string} text - Исходный текст.
 * @param {string} keyPhrase - Ключевая фраза.
 * @param {number} n - Количество строк до/после.
 * @param {boolean} isBefore - Если true, ищет строки до; если false, ищет строки после.
 * @returns {string[]} - Найденные строки или пустой массив, если ничего не найдено.
 */
function findLinesAroundKeyPhrase(text, keyPhrase, n, isBefore = true) {
    const lines = text.split('\n');
    const index = lines.findIndex(line => line.includes(keyPhrase));
    if (index === -1) return [];

if (isBefore) {
    return lines.slice(Math.max(0, index - n), index);
} else {
      return lines.slice(index + 1, index + 1 + n);
  }
}

/**
 * Найти n строк, расположенных между двумя ключевыми фразами.
 * @param {string} text - Исходный текст.
 * @param {string} startPhrase - Фраза начала.
 * @param {string} endPhrase - Фраза конца.
 * @param {number} n - Количество строк между фразами.
 * @returns {string[]} - Найденные строки или пустой массив, если ничего не найдено.
 */
function findLinesBetweenPhrases(text, startPhrase, endPhrase, n) {
    const lines = text.split('\n');
    const startIndex = lines.findIndex(line => line.includes(startPhrase));
    const endIndex = lines.findIndex(line => line.includes(endPhrase));
    if (startIndex === -1 || endIndex === -1 || startIndex >= endIndex) return [];

    return lines.slice(startIndex + 1, Math.min(endIndex, startIndex + 1 + n));
}
