const Ajax = function () {

    this.token = async (resp) => {

        const urlPrm = new URLSearchParams(window.location.search);
        let $data = false;

        if (resp == true) {
            $data = {
                response: 'token'
            }
        } else {
            $data = {
                response: resp
            }
        }


        let url = '/validacao/credenciais';

        let headers = {
            "Content-type": "application/json; charset=UTF-8"
        };

        let request = {
            method: "POST",
            body: JSON.stringify($data),
            headers
        };
        let page = await fetch(url, request);
        let text = await page.text();


        return new Promise(callback => {
            callback(text);
        })
    }

    this.recover = async (resp) => {

        const urlPrm = new URLSearchParams(window.location.search);
        let $data = false;

        
        $data = {
            response: resp,
            valid_email: true
        }
        


        let url = '/validacao/recover';

        let headers = {
            "Content-type": "application/json; charset=UTF-8"
        };

        let request = {
            method: "POST",
            body: JSON.stringify($data),
            headers
        };
        let page = await fetch(url, request);
        let text = await page.text();


        return new Promise(callback => {
            callback(text);
        })
    }


    this.credentails = async (action, resp) => {

        let $data = resp

    
        let url = action;

        let headers = {
            "Content-type": "application/json; charset=UTF-8"
        };

        let request = {
            method: "POST",
            body: JSON.stringify($data),
            headers
        };
        let page = await fetch(url, request);
        let text = await page.text();


        return new Promise(callback => {
            callback(text);
        })
    }
}

export {
    Ajax
}