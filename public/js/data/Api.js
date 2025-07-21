export const api = {
    hubdo: {
        default: "https://ws.hubdodesenvolvedor.com.br/v2",
        cep: "https://ws.hubdodesenvolvedor.com.br/v2/cep3/"
    },
    documents: {
        GET: '/api/documentation'
    },
    institutional: {
        GET: '/api/institution'
    },
    address: {
        DATA: '/api/address'
    }, 
    recovery: {
        GET: '/api/recovery/register'
    },
    validation: {
        cnpj: '/api/cnpj',
        cpf: '/api/cpf',
        rg: '/api/rg',
        mail: '/api/mail'
    },
    payments: {
        GET: '/api/payment',
        POST: '/api/payment/',
        PATCH: {
            status: '/api/payment/status'
        },
        status: {
            POST: '/api/payment/status'
        },
        data: {
            methods: {
                get: 'payments/data/methods'
            }
        }
    }
}