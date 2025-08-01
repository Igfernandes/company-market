formatSymbol = {
    'BRL': 'R$',
    'USD': '$',
    'EUR': '€'
}

export function formatMoney(money, symbol = 'R$') {
    money = money.toFloat().toFixed(2);
    symbol = formatSymbol[symbol] || symbol;
    return `${symbol} ${money.replace('.', ',')}`;
} 

export function handleMoney(event) {
    const field = event.currentTarget;
    const money = field.value.replace(/\D/g, "");
    const symbol = field.dataset;
    return formatMoney(money, symbol);
}

