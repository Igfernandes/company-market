/**
 * Verifica se o número fornecido representa um mês válido.
 *
 * @param {number} month - Número do mês (1 a 12).
 * @returns {boolean} Retorna `true` se o mês estiver entre 1 e 12, caso contrário `false`.
 */
export function isMonthValid(month) {
  return month > 0 && month <= 12;
}

/**
 * Verifica se o número fornecido representa um dia válido.
 *
 * @param {number} day - Número do dia (1 a 31).
 * @returns {boolean} Retorna `true` se o dia estiver entre 1 e 31, caso contrário `false`.
 */
export function isDayValid(day) {
  return day > 0 && day <= 31;
}
