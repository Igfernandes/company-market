import { api } from '../../data/Api';
import { Ajax } from '../../libs/Ajax/index.js';

export async function validateDocuments(fields){
    const ajax = new Ajax();
    const logs = new Array();
    const payload =  {
        field: new Array(),
        type: new Array(),
        document: new Array()
    }

    fields.forEach(field => {
        if(!field.value || !field.name || !field.dataset.document) return;

        payload.push({
            field: field.name,
            type: field.dataset.document,
            document: field.value
        })
    });

    const response = await ajax.get(`${api.documents.GET}`, null, {
        payload
    })

    for (const log of response) {
        if (log.type == 'login') {
            logs.push(`O e-mail inserido já está cadastrado`)
        } else {
            logs.push(`O ${log.type} inserido já está cadastrado`)
        }
    }

    return logs;
}
