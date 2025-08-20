/**
 * @typedef {Object} IntlTelInputOptions
 * @property {string[]} [onlyCountries] Lista de países permitidos (ISO2).
 * @property {string[]} [excludeCountries] Lista de países bloqueados.
 * @property {boolean} [allowDropdown=true] Se deve exibir o dropdown de bandeiras.
 * @property {boolean} [autoPlaceholder=true] Se deve gerar placeholder automático.
 * @property {string} [initialCountry=""] País inicial (ex: "br").
 * @property {boolean} [separateDialCode=false] Se deve mostrar o código do país separado.
 * @property {boolean} [nationalMode=true] Se deve exibir o número no formato nacional.
 * @property {boolean} [formatOnDisplay=true] Se deve formatar automaticamente.
 * @property {boolean} [autoInsertDialCode=true] Se deve inserir automaticamente o DDI.
 * @property {boolean} [showSelectedDialCode=false] Se deve exibir o DDI ao lado da bandeira.
 * @property {boolean} [strictMode=false] Habilita validação mais rígida.
 * @property {string[]} [preferredCountries=["us","gb"]] Lista de países preferidos.
 * @property {Function} [customPlaceholder] Função custom de placeholder.
 */

/**
 * @typedef {Object} CountryData
 * @property {string} name Nome do país
 * @property {string} iso2 Código ISO2 (ex: "br")
 * @property {string} dialCode Código de discagem (ex: "55")
 * @property {string} priority Ordem de prioridade
 * @property {string} areaCodes Códigos de área (se houver)
 */

/**
 * @typedef {Object} NumberInfo
 * @property {boolean} isValid Se o número é válido
 * @property {string} number Número formatado
 * @property {string} e164 Número no formato E.164
 * @property {string} international Número no formato internacional
 * @property {string} national Número no formato nacional
 * @property {string} type Tipo do número (fixo, móvel, etc.)
 */

/**
 * Representa a instância do IntlTelInput
 * @typedef {Object} IntlTelInputInstance
 * @property {function(string=):boolean} isValidNumber Verifica se o número é válido.
 * @property {function():string} getNumber Retorna o número no formato E.164.
 * @property {function(string):void} setNumber Define o número.
 * @property {function():CountryData} getSelectedCountryData Retorna dados do país selecionado.
 * @property {function(string):void} setCountry Define o país atual.
 * @property {function():string} getSelectedCountryData Retorna país selecionado.
 * @property {function(string,any=):any} getNumberType Retorna tipo do número.
 * @property {function():void} destroy Destroi a instância.
 */

