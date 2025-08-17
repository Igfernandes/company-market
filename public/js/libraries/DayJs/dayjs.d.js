// @ts-check

/**
 * Instância do Dayjs retornada por dayjs().
 * @typedef {Object} DayjsInstance
 * @property {() => boolean} isValid
 * @property {(unit?: string) => DayjsInstance} startOf
 * @property {(unit?: string) => DayjsInstance} endOf
 * @property {(value: number, unit: string) => DayjsInstance} add
 * @property {(value: number, unit: string) => DayjsInstance} subtract
 * @property {(unit: string) => number} get
 * @property {(unit: string, value: number) => DayjsInstance} set
 * @property {(formatStr?: string) => string} format
 * @property {(d: string|number|Date|null, unit?: string) => boolean} isBefore
 * @property {(d: string|number|Date|null, unit?: string) => boolean} isAfter
 * @property {(d: string|number|Date|null, unit?: string) => boolean} isSame
 * @property {(d: string|number|Date|null, unit?: string, float?: boolean) => number} diff
 * @property {() => number} valueOf
 * @property {() => number} unix
 * @property {() => Date} toDate
 * @property {() => string} toISOString
 * @property {() => string} toJSON
 * @property {() => string} toString
 * @property {() => DayjsInstance} clone
 * @property {(locale?: string) => string} locale
 */

/**
 * Função principal do Day.js.
 * Pode ser chamada como `dayjs()`, `dayjs(new Date())`, `dayjs("2025-01-01")`, etc.
 *
 * @param {string|number|Date|null} [date]
 * @param {string|object} [formatOrLocale]
 * @param {boolean} [strict]
 * @returns {DayjsInstance} Instância do Dayjs
 */
function dayjs(date, formatOrLocale, strict) {
   // return the real dayjs instance
  return /** @type {DayjsInstance} */ ({});
}
